<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user();
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-comments text-brand me-2"></i> Messages & Telehealth Support</h2>
        <p class="admin-page-subtitle">End-to-end communication with your veterinarians, rescue shelters, and vendors.</p>
    </div>
    <div>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-3" onclick="window.location.reload()">
            <i class="fa-solid fa-arrows-rotate me-1"></i> Refresh
        </button>
    </div>
</div>

<div class="pg-chat-container">
    <!-- Left Sidebar: Conversations List -->
    <div class="chat-sidebar-conversations <?= $activeConvId ? 'd-none d-md-flex' : '' ?>" id="chatSidebar">
        <div class="chat-search-header">
            <div class="input-group">
                <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                <input type="text" class="form-control bg-light border-start-0" id="chatSearchInput" placeholder="Search conversations...">
            </div>
        </div>

        <div class="overflow-y-auto flex-grow-1" id="conversationsList">
            <?php if (empty($conversations)): ?>
                <div class="p-4 text-center text-muted">
                    <i class="fa-regular fa-message fa-2x mb-2 text-muted"></i>
                    <p class="small m-0">No active conversations yet.</p>
                </div>
            <?php else: ?>
                <?php foreach ($conversations as $conv): 
                    $otherName = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_name'] : $conv['user1_name'];
                    $otherRole = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_role'] : $conv['user1_role'];
                    $isActive = (int)$conv['id'] === $activeConvId;
                ?>
                    <a href="<?= ViewHelper::url('portal/messages?conv=' . $conv['id']) ?>" class="chat-conversation-item <?= $isActive ? 'active' : '' ?>">
                        <div class="avatar-circle bg-light text-dark border fw-bold d-flex align-items-center justify-content-center flex-shrink-0" style="width: 44px; height: 44px; border-radius: 50%;">
                            <?= strtoupper(substr($otherName ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="fw-bold text-dark text-truncate" style="font-size: 14px;"><?= ViewHelper::e($otherName) ?></span>
                                <span class="badge bg-light text-dark border px-2 py-0 text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($otherRole) ?></span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small text-muted text-truncate" style="max-width: 180px;">
                                    <?= ViewHelper::e($conv['last_message'] ?: 'Conversation started') ?>
                                </span>
                                <?php if (!empty($conv['unread_count']) && (int)$conv['unread_count'] > 0): ?>
                                    <span class="badge bg-danger rounded-pill" style="font-size: 10px;"><?= $conv['unread_count'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right Side: Active Chat Message Stream -->
    <div class="chat-main-area <?= !$activeConvId ? 'd-none d-md-flex' : '' ?>" id="chatMainArea">
        <?php if ($activeRecipient && $activeConvId): ?>
            <div class="chat-active-header">
                <div class="d-flex align-items-center gap-3">
                    <a href="<?= ViewHelper::url('portal/messages') ?>" class="btn btn-sm btn-light d-md-none rounded-circle">
                        <i class="fa-solid fa-arrow-left"></i>
                    </a>
                    <div class="avatar-circle bg-brand text-white fw-bold d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; border-radius: 50%;">
                        <?= strtoupper(substr($activeRecipient['name'] ?? 'U', 0, 1)) ?>
                    </div>
                    <div>
                        <h5 class="fw-bold m-0" style="font-size: 15px;"><?= ViewHelper::e($activeRecipient['name']) ?></h5>
                        <span class="badge bg-light text-dark border rounded-pill px-2 py-0 text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($activeRecipient['role']) ?></span>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'video', 'appointment', <?= $activeConvId ?>)">
                        <i class="fa-solid fa-video me-1"></i> Video Call
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'audio', 'appointment', <?= $activeConvId ?>)">
                        <i class="fa-solid fa-phone me-1"></i> Audio Call
                    </button>
                </div>
            </div>

            <!-- Messages Stream -->
            <div class="chat-messages-box" id="messagesBox">
                <?php if (empty($activeMessages)): ?>
                    <div class="p-5 text-center text-muted m-auto">
                        <i class="fa-regular fa-comment-dots fa-3x mb-3 text-muted"></i>
                        <p class="fw-semibold">Send a message to start this verified conversation.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($activeMessages as $msg): 
                        $isMine = (int)$msg['sender_id'] === (int)$currentUser['id'];
                    ?>
                        <div class="chat-bubble-wrap <?= $isMine ? 'outgoing' : 'incoming' ?>">
                            <div class="chat-bubble">
                                <?= nl2br(ViewHelper::e($msg['message_text'])) ?>
                            </div>
                            <span class="chat-meta-time">
                                <?= date('h:i A', strtotime($msg['created_at'])) ?>
                                <?php if ($isMine): ?>
                                    <i class="fa-solid fa-check-double ms-1 <?= !empty($msg['is_read']) ? 'text-brand' : 'text-muted' ?>"></i>
                                <?php endif; ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Input Bar -->
            <form id="chatSendForm" class="chat-input-bar">
                <input type="hidden" name="conversation_id" value="<?= $activeConvId ?>">
                <input type="text" name="message_text" id="messageInput" class="form-control rounded-pill px-4" placeholder="Type your message..." autocomplete="off" required>
                <button type="submit" class="btn btn-admin-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; flex-shrink: 0;">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        <?php else: ?>
            <div class="p-5 text-center text-muted m-auto">
                <i class="fa-solid fa-comments fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">Select a conversation</h5>
                <p class="small text-muted">Choose a contact from the list on the left to review messages and start video consultations.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const messagesBox = document.getElementById('messagesBox');
    if (messagesBox) {
        messagesBox.scrollTop = messagesBox.scrollHeight;
    }

    const sendForm = document.getElementById('chatSendForm');
    if (sendForm) {
        sendForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const input = document.getElementById('messageInput');
            const text = input.value.trim();
            if (!text) return;

            const convId = sendForm.querySelector('[name="conversation_id"]').value;
            input.value = '';

            // Optimistic append
            const bubbleWrap = document.createElement('div');
            bubbleWrap.className = 'chat-bubble-wrap outgoing';
            bubbleWrap.innerHTML = `
                <div class="chat-bubble">${PetGuardToast.escapeHtml(text)}</div>
                <span class="chat-meta-time">Just now <i class="fa-solid fa-check ms-1 text-muted"></i></span>
            `;
            messagesBox.appendChild(bubbleWrap);
            messagesBox.scrollTop = messagesBox.scrollHeight;

            const res = await PetGuardAjax.post('messages/send', {
                conversation_id: convId,
                message_text: text
            });

            if (!res.ok) {
                PetGuardToast.error(res.message || 'Failed to deliver message.');
            }
        });
    }

    // Auto poll for new messages in active conversation every 3.5 seconds
    const activeConvId = <?= json_encode($activeConvId) ?>;
    if (activeConvId) {
        setInterval(async () => {
            const res = await PetGuardAjax.get(`messages/conversation/${activeConvId}`);
            if (res.ok && res.data && res.data.messages) {
                const currentCount = messagesBox.querySelectorAll('.chat-bubble-wrap').length;
                if (res.data.messages.length > currentCount) {
                    // Refresh view messages
                    window.location.reload();
                }
            }
        }, 4000);
    }
});
</script>
