<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user() ?? [];
$conversations = $conversations ?? [];
$activeConvId = $activeConvId ?? null;
$activeRecipient = $activeRecipient ?? null;
$activeMessages = $activeMessages ?? [];
?>

<style>
/* Chat Container 5-Screen Layout */
.pg-chat-wrapper {
    display: flex;
    height: calc(100vh - 200px);
    min-height: 580px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
}

.chat-sidebar {
    width: 340px;
    min-width: 340px;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    background: #f8fafc;
}

.chat-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    min-width: 0;
}

.chat-bubble-mine {
    background: linear-gradient(135deg, #fa441d 0%, #ff5722 100%);
    color: #ffffff;
    border-radius: 18px 18px 4px 18px;
    padding: 12px 16px;
    max-width: 75%;
    box-shadow: 0 4px 12px rgba(250, 68, 29, 0.2);
}

.chat-bubble-theirs {
    background: #f1f5f9;
    color: #0f172a;
    border-radius: 18px 18px 18px 4px;
    padding: 12px 16px;
    max-width: 75%;
    border: 1px solid #e2e8f0;
}

.chat-conv-item {
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    transition: all 0.15s ease;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 12px;
}
.chat-conv-item:hover, .chat-conv-item.active {
    background: #ffffff;
    border-left: 4px solid #fa441d;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}

@media (max-width: 767.98px) {
    .pg-chat-wrapper {
        height: calc(100vh - 160px);
        border-radius: 18px;
    }
    .chat-sidebar {
        width: 100%;
        min-width: 100%;
    }
    .chat-main {
        width: 100%;
    }
}
</style>

<div class="portal-messages-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-shield-halved text-success"></i>
                <span>256-Bit Encrypted Telehealth Messenger</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= count($conversations ?? []) ?> Active Chats</span>
            </div>
            <h2 class="portal-hero-title">Messages &amp; Direct Consultations 💬</h2>
            <p class="portal-hero-subtitle">
                Real-time secure communication with verified veterinary clinics, rescue shelters, and customers.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-admin-secondary" onclick="window.location.reload()">
                <i class="fa-solid fa-arrows-rotate"></i>
                <span>Refresh Inbox</span>
            </button>
        </div>
    </div>

    <!-- 2. Chat Stream Wrapper -->
    <div class="pg-chat-wrapper">
        
        <!-- Left: Conversations Directory -->
        <div class="chat-sidebar <?= $activeConvId ? 'd-none d-md-flex' : '' ?>" id="chatSidebar">
            <div class="p-3 border-bottom bg-white">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3 text-muted">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="chatSearchInput" class="form-control bg-light border-start-0 rounded-end-pill py-2 text-dark" placeholder="Search conversations..." onkeyup="filterConversations()">
                </div>
            </div>

            <div class="overflow-y-auto flex-grow-1" id="conversationsList">
                <?php if (empty($conversations)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-regular fa-comment-dots fa-2x mb-2 text-muted"></i>
                        <p class="small m-0">No active conversations yet.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($conversations as $conv): 
                        $otherName = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_name'] : $conv['user1_name'];
                        $otherRole = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_role'] : $conv['user1_role'];
                        $isActive = (int)$conv['id'] === (int)$activeConvId;
                    ?>
                        <a href="<?= ViewHelper::url('portal/messages?conv=' . $conv['id']) ?>" class="chat-conv-item <?= $isActive ? 'active' : '' ?>">
                            <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                <?= strtoupper(substr($otherName ?? 'U', 0, 1)) ?>
                            </div>
                            <div class="flex-grow-1 overflow-hidden min-w-0">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark text-truncate" style="font-size: 13.5px;"><?= ViewHelper::e($otherName) ?></span>
                                    <span class="badge bg-light text-secondary border rounded-pill px-2 py-0 text-uppercase" style="font-size: 9px;"><?= ViewHelper::e($otherRole) ?></span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-muted text-truncate" style="font-size: 11.5px; max-width: 170px;">
                                        <?= ViewHelper::e($conv['last_message'] ?: 'Conversation initiated') ?>
                                    </span>
                                    <?php if (!empty($conv['unread_count']) && (int)$conv['unread_count'] > 0): ?>
                                        <span class="badge bg-danger rounded-pill" style="font-size: 9.5px;"><?= $conv['unread_count'] ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Active Stream -->
        <div class="chat-main <?= !$activeConvId ? 'd-none d-md-flex' : '' ?>" id="chatMainArea">
            <?php if ($activeRecipient && $activeConvId): ?>
                <!-- Active Header -->
                <div class="p-3 px-4 border-bottom bg-white d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-3">
                        <a href="<?= ViewHelper::url('portal/messages') ?>" class="btn btn-sm btn-light d-md-none rounded-circle border shadow-sm" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold text-white shadow-sm flex-shrink-0" style="width: 44px; height: 44px; background: #fa441d; font-size: 16px;">
                            <?= strtoupper(substr($activeRecipient['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark m-0" style="font-size: 15px;"><?= ViewHelper::e($activeRecipient['name']) ?></h5>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0 text-uppercase" style="font-size: 9.5px;">
                                <i class="fa-solid fa-circle me-1" style="font-size: 7px;"></i> Verified <?= ViewHelper::e($activeRecipient['role']) ?>
                            </span>
                        </div>
                    </div>

                    <!-- Audio/Video Actions -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'video', 'consultation', <?= $activeConvId ?>)">
                            <i class="fa-solid fa-video"></i>
                            <span class="d-none d-sm-inline">Video Call</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'audio', 'consultation', <?= $activeConvId ?>)">
                            <i class="fa-solid fa-phone"></i>
                            <span class="d-none d-sm-inline">Audio Call</span>
                        </button>
                    </div>
                </div>

                <!-- Messages Scroll Stream -->
                <div class="flex-grow-1 p-4 overflow-y-auto d-flex flex-column gap-3 bg-light" id="messagesBox" style="max-height: 520px;">
                    <?php if (empty($activeMessages)): ?>
                        <div class="m-auto text-center text-muted p-4">
                            <i class="fa-regular fa-comment-dots fa-3x mb-2 text-muted"></i>
                            <p class="small fw-semibold">Type a message below to begin this consultation session.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($activeMessages as $msg): 
                            $isMine = (int)$msg['sender_id'] === (int)$currentUser['id'];
                        ?>
                            <div class="d-flex flex-column <?= $isMine ? 'align-items-end' : 'align-items-start' ?>">
                                <div class="<?= $isMine ? 'chat-bubble-mine' : 'chat-bubble-theirs' ?>">
                                    <?= nl2br(ViewHelper::e($msg['message_text'] ?? $msg['message'] ?? '')) ?>
                                </div>
                                <span class="text-muted mt-1" style="font-size: 10.5px;">
                                    <?= date('h:i A', strtotime($msg['created_at'])) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Message Input Box -->
                <div class="p-3 bg-white border-top">
                    <form id="sendMessageForm" action="<?= ViewHelper::url('portal/messages/send') ?>" method="POST" class="d-flex gap-2 align-items-center">
                        <?= ViewHelper::csrfField() ?>
                        <input type="hidden" name="conversation_id" value="<?= (int)$activeConvId ?>">
                        <input type="hidden" name="receiver_id" value="<?= (int)$activeRecipient['id'] ?>">

                        <input type="text" name="message" id="messageInput" class="form-control rounded-pill px-4 py-2 bg-light border-0 shadow-none text-dark" placeholder="Type clinical note or message..." required autocomplete="off">
                        <button type="submit" class="btn btn-admin-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 42px; height: 42px;">
                            <i class="fa-solid fa-paper-plane" style="font-size: 14px;"></i>
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <!-- No Conversation Selected State -->
                <div class="m-auto text-center text-muted p-5">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: #f8fafc; color: #94a3b8; font-size: 36px;">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Select a Conversation</h5>
                    <p class="small text-muted" style="max-width: 380px; margin: 0 auto;">Choose a contact from the left list to review messages or start a new clinical audio/video consultation.</p>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<script>
function filterConversations() {
    const query = document.getElementById('chatSearchInput').value.toLowerCase();
    document.querySelectorAll('.chat-conv-item').forEach(item => {
        const text = item.textContent.toLowerCase();
        item.style.display = text.includes(query) ? 'flex' : 'none';
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const msgBox = document.getElementById('messagesBox');
    if (msgBox) {
        msgBox.scrollTop = msgBox.scrollHeight;
    }

    PetGuardAjax.bindForm('#sendMessageForm', {
        loadingText: '',
        onSuccess: () => {
            window.location.reload();
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to send message.');
        }
    });
});
</script>
