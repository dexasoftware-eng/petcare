<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user();
$isAlreadyEnded = in_array($session['status'] ?? '', ['ended', 'rejected', 'missed']);
?>

<!-- 5-Screen Responsive Calling Styles -->
<style>
.webrtc-room-wrapper {
    max-width: 1320px;
    margin: 0 auto;
}
.webrtc-call-container {
    position: relative;
    width: 100%;
    height: calc(100vh - 150px);
    min-height: 480px;
    max-height: 760px;
    background: #020617;
    border-radius: 24px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 60px -12px rgba(15, 23, 42, 0.5), 0 0 0 1px rgba(255, 255, 255, 0.08);
}
.call-header-overlay {
    position: absolute;
    top: 16px;
    left: 16px;
    right: 16px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    z-index: 20;
    pointer-events: none;
    flex-wrap: wrap;
    gap: 8px;
}
.call-header-overlay > * {
    pointer-events: auto;
}
.call-pill-badge {
    background: rgba(15, 23, 42, 0.85);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    color: #ffffff;
    padding: 7px 16px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.35);
}
.call-main-grid {
    flex-grow: 1;
    position: relative;
    display: flex;
    background: #020617;
    overflow: hidden;
}
.remote-video-wrap {
    flex-grow: 1;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #020617;
}
.remote-video-wrap video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.local-video-pip {
    position: absolute;
    bottom: 20px;
    right: 20px;
    width: 200px;
    height: 130px;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.6);
    border: 2px solid rgba(255, 255, 255, 0.25);
    z-index: 10;
    background: #1e293b;
    transition: all 0.25s ease;
}
.local-video-pip video {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.call-controls-bar {
    padding: 14px 20px;
    background: rgba(15, 23, 42, 0.95);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-top: 1px solid rgba(255, 255, 255, 0.08);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 14px;
    z-index: 30;
}
.btn-call-control {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    border: none;
    cursor: pointer;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
}
.btn-call-control.btn-light {
    background: #334155;
    color: #ffffff;
}
.btn-call-control.btn-light:hover {
    background: #475569;
    transform: translateY(-2px);
}
.btn-call-control.btn-primary {
    background: #ff7a18;
    color: #ffffff;
}
.btn-call-control.btn-primary:hover {
    background: #e66a10;
    transform: translateY(-2px);
}
.btn-call-control.btn-danger {
    background: #ef4444;
    color: #ffffff;
    width: 56px;
    height: 56px;
    font-size: 19px;
}
.btn-call-control.btn-danger:hover {
    background: #dc2626;
    transform: scale(1.06);
}

/* 5-Screen Responsive Breakpoints for Video Call */
@media (max-width: 575.98px) {
    .webrtc-call-container {
        height: calc(100vh - 165px);
        min-height: 400px;
        border-radius: 18px;
    }
    .local-video-pip {
        width: 110px;
        height: 75px;
        bottom: 12px;
        right: 12px;
        border-radius: 10px;
    }
    .call-controls-bar {
        padding: 10px 14px;
        gap: 10px;
    }
    .btn-call-control {
        width: 40px;
        height: 40px;
        font-size: 14px;
    }
    .btn-call-control.btn-danger {
        width: 46px;
        height: 46px;
        font-size: 16px;
    }
    .call-header-overlay {
        top: 10px;
        left: 10px;
        right: 10px;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .local-video-pip {
        width: 150px;
        height: 100px;
    }
}
@media (min-width: 768px) and (max-width: 991.98px) {
    .local-video-pip {
        width: 180px;
        height: 120px;
    }
}
</style>

<div class="webrtc-room-wrapper py-3">

    <?php if ($isAlreadyEnded): ?>
        <!-- Consultation Completed / Closed Summary Card -->
        <div class="admin-card p-4 p-md-5 mx-auto text-center shadow-sm" style="max-width: 650px; border-radius: 24px;">
            <div class="rounded-circle bg-light border d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 80px; height: 80px; font-size: 32px; color: #64748b;">
                <i class="fa-solid fa-phone-slash"></i>
            </div>
            <h3 class="fw-bold text-dark mb-1">Consultation Closed</h3>
            <p class="text-muted small mb-4">This clinical telemedicine session has concluded or is no longer active.</p>

            <div class="p-3 bg-light rounded-4 border text-start mb-4">
                <div class="row g-2 small">
                    <div class="col-6"><strong>Status:</strong> <span class="badge bg-secondary text-white text-uppercase"><?= ViewHelper::e($session['status']) ?></span></div>
                    <div class="col-6"><strong>Duration:</strong> <?= gmdate('H:i:s', (int)($session['duration_seconds'] ?? 0)) ?></div>
                    <div class="col-12"><strong>Session ID:</strong> <code><?= ViewHelper::e($session['session_token']) ?></code></div>
                    <div class="col-12"><strong>Participant:</strong> <?= ViewHelper::e($otherUser['name'] ?? 'Doctor / Client') ?> (<?= strtoupper(ViewHelper::e($otherUser['role'] ?? 'User')) ?>)</div>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-2">
                <a href="<?= ViewHelper::url('portal') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                    <i class="fa-solid fa-house me-1"></i> Return to Portal
                </a>
                <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
                    <i class="fa-solid fa-calendar me-1"></i> View Appointments
                </a>
            </div>
        </div>

    <?php else: ?>
        <!-- Active Telemedicine Call Container -->
        <div class="webrtc-call-container">
            
            <!-- Header Overlay with WhatsApp-Style Calling / Ringing / Connected State -->
            <div class="call-header-overlay">
                <div class="call-pill-badge" id="callStatusBadge">
                    <span class="spinner-grow spinner-grow-sm text-info" style="width: 8px; height: 8px;" role="status"></span>
                    <span>Calling...</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-dark text-white border border-secondary px-3 py-2 rounded-pill shadow-sm" style="font-size: 12px;">
                        <i class="fa-solid fa-user-doctor me-1 text-brand"></i>
                        <?= ViewHelper::e($otherUser['name'] ?? 'Consultant') ?> (<?= strtoupper(ViewHelper::e($otherUser['role'] ?? 'Doctor')) ?>)
                    </span>
                    <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1 fw-semibold shadow-sm" onclick="PetGuardCall.endCall()" style="font-size: 12px;">
                        <i class="fa-solid fa-arrow-left me-1"></i> Exit Call
                    </button>
                </div>
            </div>

            <!-- Video Stage Area -->
            <div class="call-main-grid">
                <!-- Remote Participant Video -->
                <div class="remote-video-wrap">
                    <video id="remoteVideo" autoplay playsinline></video>
                    <div class="remote-avatar-fallback text-center text-white" id="remotePlaceholder">
                        <div class="avatar-circle avatar-xl mx-auto mb-2 bg-brand text-white fw-bold d-flex align-items-center justify-content-center shadow-lg" style="width: 90px; height: 90px; font-size: 36px; border-radius: 50%;">
                            <?= strtoupper(substr($otherUser['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <h5 class="fw-bold mb-1"><?= ViewHelper::e($otherUser['name'] ?? 'Consultant') ?></h5>
                        <p class="text-muted small" id="remoteSubStatus">Waiting for secure connection...</p>
                    </div>
                </div>

                <!-- Local PiP Stream -->
                <div class="local-video-pip">
                    <video id="localVideo" autoplay playsinline muted></video>
                </div>
            </div>

            <!-- Call Toolbar Controls -->
            <div class="call-controls-bar">
                <button type="button" class="btn-call-control btn-light" id="btnToggleAudio" onclick="PetGuardCall.toggleAudio(this)" title="Mute / Unmute Microphone">
                    <i class="fa-solid fa-microphone"></i>
                </button>
                <button type="button" class="btn-call-control btn-light" id="btnToggleVideo" onclick="PetGuardCall.toggleVideo(this)" title="Turn On / Off Camera">
                    <i class="fa-solid fa-video"></i>
                </button>
                <button type="button" class="btn-call-control btn-light" id="btnToggleScreen" onclick="PetGuardCall.toggleScreenShare(this)" title="Share Screen">
                    <i class="fa-solid fa-display"></i>
                </button>
                <button type="button" class="btn-call-control btn-light" id="btnToggleFullscreen" onclick="PetGuardCall.toggleFullscreen()" title="Toggle Fullscreen">
                    <i class="fa-solid fa-expand"></i>
                </button>
                <button type="button" class="btn-call-control btn-danger" onclick="PetGuardCall.endCall()" title="End Consultation">
                    <i class="fa-solid fa-phone-slash"></i>
                </button>
            </div>
        </div>

        <!-- Related Patient / Appointment Context Card -->
        <?php if (!empty($pet)): ?>
            <div class="admin-card shadow-sm mt-4" style="border-radius: 20px; overflow: hidden;">
                <div class="p-3 p-md-4 border-bottom bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stat-card-icon icon-blue" style="width: 34px; height: 34px; font-size: 14px; border-radius: 10px;">
                            <i class="fa-solid fa-paw"></i>
                        </div>
                        <h5 class="fw-bold text-dark m-0">Connected Companion: <?= ViewHelper::e($pet['name']) ?></h5>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-bold">Active Patient Context</span>
                </div>
                <div class="p-3 p-md-4">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <?php if (!empty($pet['avatar'])): ?>
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="Pet" class="rounded-4 border shadow-sm" style="width: 68px; height: 68px; object-fit: contain; background: #fff8e5;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                            <?php else: ?>
                                <div class="rounded-4 bg-light border d-flex align-items-center justify-content-center fw-bold text-brand shadow-sm" style="width: 68px; height: 68px; font-size: 24px;">
                                    <i class="fa-solid fa-paw"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col min-w-0">
                            <h5 class="fw-bold text-dark mb-1 text-truncate"><?= ViewHelper::e($pet['name']) ?> &middot; <span class="text-muted small"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>)</span></h5>
                            <div class="d-flex gap-3 flex-wrap small text-muted">
                                <span><i class="fa-solid fa-cake-candles text-brand me-1"></i> Age: <?= ViewHelper::e($pet['age'] ?? '2 Years') ?></span>
                                <span><i class="fa-solid fa-weight-scale text-primary me-1"></i> Weight: <?= ViewHelper::e($pet['weight'] ?? '—') ?></span>
                                <span><i class="fa-solid fa-shield-virus text-success me-1"></i> Vaccines: <strong class="text-success"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to date') ?></strong></span>
                                <span><i class="fa-solid fa-fingerprint text-muted me-1"></i> Microchip: <?= ViewHelper::e($pet['microchip_id'] ?: 'Unchipped') ?></span>
                            </div>
                        </div>
                        <div class="col-12 col-md-auto">
                            <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold w-100 w-md-auto d-inline-flex align-items-center justify-content-center gap-1 shadow-sm">
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Open Medical Vault
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize WebRTC with WhatsApp-style calling/ringing states and dial tones
            const sessionToken = <?= json_encode($session['session_token']) ?>;
            const isCaller = <?= $isCaller ? 'true' : 'false' ?>;
            const callType = <?= json_encode($session['call_type'] ?? 'video') ?>;
            if (typeof PetGuardCall !== 'undefined') {
                PetGuardCall.initCallRoom(sessionToken, isCaller, callType);
            }
        });
        </script>
    <?php endif; ?>

</div>
