<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\CallSession;
use Models\Appointment;
use Models\AdoptionApplication;
use Models\Order;
use Models\AuditLog;
use Models\Pet;

class CallController extends Controller
{
    /**
     * Request a new WebRTC call session with strict relationship authorization
     */
    public function requestCall(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->jsonError('Unauthorized', [], 401);
        }

        $caller = Auth::user();
        $receiverId = (int)$this->request->input('receiver_id');
        $callType = $this->request->input('call_type', 'video');
        $relatedType = $this->request->input('related_entity_type', 'direct');
        $relatedId = $this->request->input('related_entity_id') ? (int)$this->request->input('related_entity_id') : null;

        $receiver = User::find($receiverId);
        if (!$receiver) {
            $this->jsonError('Call recipient not found.');
        }

        if ($receiver['status'] !== 'active') {
            $this->jsonError('Recipient account is currently inactive.');
        }

        if ($userId === $receiverId) {
            $this->jsonError('You cannot start a call with yourself.');
        }

        // Relationship Authorization Logic
        $callerRole = $caller['role'] ?? 'petowner';
        $receiverRole = $receiver['role'] ?? 'petowner';

        $isAuthorized = false;

        if ($callerRole === 'admin' || $receiverRole === 'admin') {
            $isAuthorized = true;
        } elseif (($callerRole === 'petowner' && $receiverRole === 'veterinarian') || ($callerRole === 'veterinarian' && $receiverRole === 'petowner')) {
            $isAuthorized = true;
        } elseif (($callerRole === 'petowner' && $receiverRole === 'shelter') || ($callerRole === 'shelter' && $receiverRole === 'petowner')) {
            $isAuthorized = true;
        } elseif (($callerRole === 'petowner' && $receiverRole === 'vendor') || ($callerRole === 'vendor' && $receiverRole === 'petowner')) {
            $isAuthorized = true;
        } elseif (($callerRole === 'shelter' && $receiverRole === 'veterinarian') || ($callerRole === 'veterinarian' && $receiverRole === 'shelter')) {
            $isAuthorized = true;
        }

        if (!$isAuthorized) {
            $this->jsonError('Unauthorized call attempt. Calling is only permitted between parties with an active relationship.');
        }

        // Generate unique cryptographic session token
        $sessionToken = 'pg_call_' . bin2hex(random_bytes(16));

        $sessionId = CallSession::create([
            'session_token' => $sessionToken,
            'caller_id' => $userId,
            'receiver_id' => $receiverId,
            'call_type' => in_array($callType, ['audio', 'video']) ? $callType : 'video',
            'status' => 'initiating',
            'related_entity_type' => $relatedType,
            'related_entity_id' => $relatedId,
            'started_at' => date('Y-m-d H:i:s')
        ]);

        AuditLog::log('CALL_INITIATED', 'call_sessions', $sessionId, [
            'caller' => $userId,
            'receiver' => $receiverId,
            'type' => $callType
        ]);

        $this->jsonSuccess('Call session created.', [
            'session_token' => $sessionToken,
            'call_id' => $sessionId,
            'receiver_name' => $receiver['name']
        ]);
    }

    /**
     * Polling endpoint to check incoming ringing calls
     */
    public function checkIncoming(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->jsonSuccess('', ['incoming_call' => null]);
            return;
        }

        $incoming = CallSession::getActiveIncomingCallForUser($userId);
        if ($incoming && $incoming['status'] === 'initiating') {
            CallSession::update($incoming['id'], ['status' => 'ringing']);
            $incoming['status'] = 'ringing';
        }
        $this->jsonSuccess('', ['incoming_call' => $incoming]);
    }

    /**
     * Accept incoming call
     */
    public function acceptCall(string $token): void
    {
        $userId = Auth::id();
        $session = CallSession::findByToken($token);

        if (!$session || (int)$session['receiver_id'] !== $userId) {
            $this->jsonError('Call session not found or unauthorized.');
        }

        CallSession::update($session['id'], [
            'status' => 'connected',
            'started_at' => date('Y-m-d H:i:s')
        ]);

        AuditLog::log('CALL_ACCEPTED', 'call_sessions', $session['id']);
        $this->jsonSuccess('Call accepted.', ['session_token' => $token]);
    }

    /**
     * Decline incoming call
     */
    public function declineCall(string $token): void
    {
        $userId = Auth::id();
        $session = CallSession::findByToken($token);

        if (!$session) {
            $this->jsonError('Call session not found.');
        }

        CallSession::update($session['id'], [
            'status' => 'rejected',
            'ended_at' => date('Y-m-d H:i:s')
        ]);

        AuditLog::log('CALL_REJECTED', 'call_sessions', $session['id']);
        $this->jsonSuccess('Call declined.');
    }

    /**
     * End active call
     */
    public function endCall(string $token): void
    {
        $userId = Auth::id();
        $session = CallSession::findByToken($token);

        if (!$session) {
            $this->jsonError('Call session not found.');
        }

        $duration = (int)$this->request->input('duration_seconds', 0);
        CallSession::update($session['id'], [
            'status' => 'ended',
            'ended_at' => date('Y-m-d H:i:s'),
            'duration_seconds' => $duration
        ]);

        AuditLog::log('CALL_ENDED', 'call_sessions', $session['id'], ['duration' => $duration]);
        $this->jsonSuccess('Call session ended.');
    }

    /**
     * Timeout unattended call
     */
    public function timeoutCall(string $token): void
    {
        $userId = Auth::id();
        $session = CallSession::findByToken($token);
        if ($session && in_array($session['status'], ['initiating', 'ringing'])) {
            CallSession::update($session['id'], [
                'status' => 'missed',
                'ended_at' => date('Y-m-d H:i:s')
            ]);
            AuditLog::log('CALL_MISSED_TIMEOUT', 'call_sessions', $session['id']);
        }
        $this->jsonSuccess('Call timed out.');
    }

    /**
     * WebRTC Signaling exchange
     */
    public function signal(string $token): void
    {
        $userId = Auth::id();
        $session = CallSession::findByToken($token);

        if (!$session) {
            $this->jsonError('Call session not found.');
        }

        $type = $this->request->input('type');
        $isCaller = (bool)$this->request->input('is_caller', 0);

        if ($type === 'offer') {
            CallSession::update($session['id'], [
                'offer_sdp' => $this->request->input('sdp'),
                'status' => 'ringing'
            ]);
        } elseif ($type === 'answer') {
            CallSession::update($session['id'], [
                'answer_sdp' => $this->request->input('sdp'),
                'status' => 'connected'
            ]);
        } elseif ($type === 'ice-candidate') {
            $cand = $this->request->input('candidate');
            $col = $isCaller ? 'caller_ice_candidates' : 'receiver_ice_candidates';
            $existing = json_decode($session[$col] ?? '[]', true) ?: [];
            $existing[] = json_decode($cand, true) ?: $cand;
            CallSession::update($session['id'], [
                $col => json_encode($existing)
            ]);
        }

        $this->jsonSuccess('Signal received.');
    }

    /**
     * Poll signaling updates
     */
    public function pollSignal(string $token): void
    {
        $session = CallSession::findByToken($token);
        if (!$session) {
            $this->jsonError('Call session not found.');
        }

        $this->jsonSuccess('', ['session' => $session]);
    }

    /**
     * Active Call Room View with Strict Participant Authorization
     */
    public function room(string $token): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
            return;
        }

        $session = CallSession::findByToken($token);
        if (!$session) {
            Flash::error('Consultation room not found or session has expired.');
            $this->redirect('portal');
            return;
        }

        $currentUser = Auth::user();
        $isCaller = (int)$session['caller_id'] === $userId;
        $isReceiver = (int)$session['receiver_id'] === $userId;
        $isAdmin = ($currentUser['role'] ?? '') === 'admin';

        // Strict Participant Authorization Guard
        if (!$isCaller && !$isReceiver && !$isAdmin) {
            AuditLog::log('UNAUTHORIZED_CALL_ROOM_ACCESS_BLOCKED', 'call_sessions', $session['id'], [
                'attempted_by' => $userId,
                'token' => $token
            ]);
            Flash::error('Access Denied: You are not an authorized participant in this consultation room.');
            $this->redirect('portal');
            return;
        }

        $otherUserId = $isCaller ? (int)$session['receiver_id'] : (int)$session['caller_id'];
        $otherUser = User::find($otherUserId);

        // Fetch related entity context if exists
        $relatedContext = null;
        if ($session['related_entity_type'] === 'appointment' && $session['related_entity_id']) {
            $relatedContext = Appointment::find($session['related_entity_id']);
        }

        $pet = Pet::firstWhere("user_id = :uid", ['uid' => $isCaller ? $userId : $otherUserId]) ?: Pet::find(1);

        $this->render('call.room', [
            'pageTitle' => 'Encrypted Telemedicine Consultation — PetGuard',
            'session' => $session,
            'isCaller' => $isCaller,
            'otherUser' => $otherUser,
            'pet' => $pet,
            'relatedContext' => $relatedContext
        ], 'portal');
    }

    /**
     * Call History View
     */
    public function history(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
        }

        $calls = CallSession::getCallHistoryForUser($userId, 100);

        // Fetch verified practitioners for quick consultation launcher
        $vets = User::query("
            SELECT u.id, u.name, u.email, vp.clinic_name, vp.specialization
            FROM users u
            JOIN veterinarian_profiles vp ON u.id = vp.user_id
            WHERE u.status = 'active' AND u.id != :uid
            LIMIT 20
        ", ['uid' => $userId]);

        $userRole = Auth::user()['role'] ?? 'petowner';
        $layout = $userRole === 'admin' ? 'admin' : 'portal';
        $this->render('portal.calls.index', [
            'pageTitle' => 'Telemedicine & Audio Call Logs — PetGuard',
            'calls' => $calls,
            'availableVets' => $vets
        ], $layout);
    }
}
