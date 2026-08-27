<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\Conversation;
use Models\Message;
use Models\AuditLog;

class MessageController extends Controller
{
    /**
     * Render main messaging interface
     */
    public function index(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
        }

        $conversations = Conversation::getConversationsForUser($userId);
        $activeConvId = (int)$this->request->get('conv', $conversations[0]['id'] ?? 0);
        $activeMessages = [];
        $activeRecipient = null;

        if ($activeConvId > 0) {
            $activeMessages = Message::getForConversation($activeConvId);
            Message::markAsRead($activeConvId, $userId);

            $activeConv = Conversation::find($activeConvId);
            if ($activeConv) {
                $otherUserId = (int)$activeConv['user1_id'] === $userId ? (int)$activeConv['user2_id'] : (int)$activeConv['user1_id'];
                $activeRecipient = User::find($otherUserId);
            }
        }

        $availableContacts = User::where("status = 'active' AND id != :uid", ['uid' => $userId], 'name ASC', 50);

        $userRole = Auth::user()['role'] ?? 'petowner';
        $layout = $userRole === 'admin' ? 'admin' : 'portal';
        $this->render('portal.messages.index', [
            'pageTitle' => 'Relationship Messages — Pet Guard',
            'conversations' => $conversations,
            'activeConvId' => $activeConvId,
            'activeMessages' => $activeMessages,
            'activeRecipient' => $activeRecipient,
            'availableContacts' => $availableContacts
        ], $layout);
    }

    /**
     * AJAX endpoint to fetch messages in a conversation
     */
    public function conversation(int|string $id): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->jsonError('Unauthorized', [], 401);
        }

        $convId = (int)$id;
        $conv = Conversation::find($convId);
        if (!$conv || ((int)$conv['user1_id'] !== $userId && (int)$conv['user2_id'] !== $userId)) {
            $this->jsonError('Conversation not found or unauthorized.');
        }

        $messages = Message::getForConversation($convId);
        Message::markAsRead($convId, $userId);

        $otherUserId = (int)$conv['user1_id'] === $userId ? (int)$conv['user2_id'] : (int)$conv['user1_id'];
        $recipient = User::find($otherUserId);

        $this->jsonSuccess('', [
            'messages' => $messages,
            'recipient' => User::toSafeArray($recipient),
            'conversation' => $conv
        ]);
    }

    /**
     * AJAX endpoint to send a message
     */
    public function send(): void
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->jsonError('Unauthorized', [], 401);
        }

        $convId = (int)$this->request->input('conversation_id');
        $text = trim((string)$this->request->input('message_text', $this->request->input('message', '')));

        if (empty($text)) {
            $this->jsonError('Message text cannot be empty.');
        }

        $conv = Conversation::find($convId);
        if (!$conv || ((int)$conv['user1_id'] !== $userId && (int)$conv['user2_id'] !== $userId)) {
            $this->jsonError('Conversation access denied.');
        }

        $msgId = Message::create([
            'conversation_id' => $convId,
            'sender_id' => $userId,
            'message_text' => $text,
            'is_read' => 0
        ]);

        Conversation::update($convId, [
            'last_message_at' => date('Y-m-d H:i:s')
        ]);

        $message = Message::find($msgId);
        $message['sender_name'] = Auth::name() ?? (Auth::user()['name'] ?? 'User');

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Message sent.', ['message' => $message]);
        } else {
            $this->redirect('portal/messages?conv=' . $convId);
        }
    }

    /**
     * Start conversation with an authorized user
     */
    public function start(): void
    {
        $userId = Auth::id();
        $targetUserId = (int)$this->request->input('target_user_id');
        $entityType = $this->request->input('related_entity_type', 'support');
        $entityId = $this->request->input('related_entity_id') ? (int)$this->request->input('related_entity_id') : null;
        $subject = $this->request->input('subject', 'Direct Message');

        if (!$targetUserId || $targetUserId === $userId) {
            $this->jsonError('Invalid target user.');
        }

        $conv = Conversation::findOrCreate($userId, $targetUserId, $entityType, $entityId, $subject);

        $initialText = trim((string)$this->request->input('initial_message', ''));
        if (!empty($initialText)) {
            Message::create([
                'conversation_id' => (int)$conv['id'],
                'sender_id' => $userId,
                'message_text' => $initialText,
                'is_read' => 0
            ]);
        }

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Conversation started.', ['conversation_id' => $conv['id']]);
        } else {
            $this->redirect("portal/messages?conv={$conv['id']}");
        }
    }

    /**
     * Poll total unread messages count
     */
    public function unreadCount(): void
    {
        $userId = Auth::id();
        $count = $userId ? Message::getTotalUnreadCount($userId) : 0;
        $this->jsonSuccess('', ['unread_count' => $count]);
    }
}
