<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$currentUser = Auth::user() ?? [];
$conversations = $conversations ?? [];
$activeConvId = $activeConvId ?? null;
$activeRecipient = $activeRecipient ?? null;
$activeMessages = $activeMessages ?? [];
$availableContacts = $availableContacts ?? [];
?>

<style>
/* Chat Container Responsive Layout */
.pg-chat-wrapper {
    display: flex;
    height: calc(100vh - 220px);
    min-height: 560px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.06);
}

.chat-sidebar {
    width: 320px;
    min-width: 320px;
    border-right: 1px solid #e2e8f0;
    display: flex;
    flex-direction: column;
    background: #f8fafc;
    height: 100%;
    overflow: hidden;
}

.chat-main {
    flex: 1 1 0%;
    min-width: 0;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.chat-messages-container {
    flex: 1 1 0%;
    min-height: 0;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 12px;
    padding: 20px;
    background: #f8fafc;
}

.chat-input-bar {
    flex-shrink: 0;
    background: #ffffff;
    border-top: 1px solid #e2e8f0;
    padding: 14px 20px;
    z-index: 10;
}

.chat-bubble-mine {
    background: linear-gradient(135deg, #fa441d 0%, #ff5722 100%);
    color: #ffffff;
    border-radius: 18px 18px 4px 18px;
    padding: 12px 16px;
    max-width: 75%;
    box-shadow: 0 4px 12px rgba(250, 68, 29, 0.2);
    word-break: break-word;
}

.chat-bubble-theirs {
    background: #ffffff;
    color: #0f172a;
    border-radius: 18px 18px 18px 4px;
    padding: 12px 16px;
    max-width: 75%;
    border: 1px solid #e2e8f0;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    word-break: break-word;
}

.chat-conv-item {
    padding: 12px 16px;
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
        min-height: 480px;
        border-radius: 16px;
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
            <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#newChatModal">
                <i class="fa-solid fa-pen-to-square"></i>
                <span>New Message</span>
            </button>
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
            <div class="p-3 border-bottom bg-white d-flex gap-2 align-items-center">
                <div class="input-group flex-grow-1">
                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3 text-muted">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="chatSearchInput" class="form-control bg-light border-start-0 rounded-end-pill py-2 text-dark" placeholder="Search chats..." onkeyup="filterConversations()">
                </div>
                <button type="button" class="btn btn-sm btn-outline-brand rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 38px; height: 38px;" data-bs-toggle="modal" data-bs-target="#newChatModal" title="Start New Conversation">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </div>

            <div class="overflow-y-auto flex-grow-1" id="conversationsList">
                <?php if (empty($conversations)): ?>
                    <div class="p-4 text-center text-muted">
                        <i class="fa-regular fa-comment-dots fa-2x mb-2 text-muted"></i>
                        <p class="small mb-3">No active conversations yet.</p>
                        <button type="button" class="btn btn-sm btn-admin-primary px-3" data-bs-toggle="modal" data-bs-target="#newChatModal">
                            <i class="fa-solid fa-pen me-1"></i> Start a Chat
                        </button>
                    </div>
                <?php else: ?>
                    <?php foreach ($conversations as $conv): 
                        $otherName = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_name'] : $conv['user1_name'];
                        $otherRole = ((int)$conv['user1_id'] === (int)$currentUser['id']) ? $conv['user2_role'] : $conv['user1_role'];
                        $isActive = (int)$conv['id'] === (int)$activeConvId;
                    ?>
                        <a href="<?= ViewHelper::url('portal/messages?conv=' . $conv['id']) ?>" class="chat-conv-item <?= $isActive ? 'active' : '' ?>">
                            <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 42px; height: 42px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 15px;">
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
                <div class="p-3 px-4 border-bottom bg-white d-flex align-items-center justify-content-between flex-wrap gap-2 flex-shrink-0" style="z-index: 5;">
                    <div class="d-flex align-items-center gap-3">
                        <a href="<?= ViewHelper::url('portal/messages') ?>" class="btn btn-sm btn-light d-md-none rounded-circle border shadow-sm" style="width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa-solid fa-arrow-left"></i>
                        </a>
                        <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold text-white shadow-sm flex-shrink-0" style="width: 42px; height: 42px; background: #fa441d; font-size: 15px;">
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
                    <?php if (!empty($activeRecipient) && (int)$activeRecipient['id'] !== (int)($currentUser['id'] ?? 0)): ?>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'video', 'consultation', <?= (int)$activeConvId ?>)">
                            <i class="fa-solid fa-video"></i>
                            <span class="d-none d-sm-inline">Video Call</span>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" onclick="PetGuardCall.initiateCall(<?= (int)$activeRecipient['id'] ?>, 'audio', 'consultation', <?= (int)$activeConvId ?>)">
                            <i class="fa-solid fa-phone"></i>
                            <span class="d-none d-sm-inline">Audio Call</span>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Messages Scroll Stream -->
                <div class="chat-messages-container" id="messagesBox">
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

                <!-- Message Input Box (Permanently Visible & Docked at Bottom) -->
                <div class="chat-input-bar">
                    <form id="sendMessageForm" action="<?= ViewHelper::url('portal/messages/send') ?>" method="POST" class="d-flex gap-2 align-items-center m-0">
                        <?= ViewHelper::csrfField() ?>
                        <input type="hidden" name="conversation_id" value="<?= (int)$activeConvId ?>">
                        <input type="hidden" name="receiver_id" value="<?= (int)$activeRecipient['id'] ?>">

                        <input type="text" name="message" id="messageInput" class="form-control rounded-pill px-4 py-2 bg-light border-0 shadow-none text-dark" placeholder="Type a message or consultation note..." required autocomplete="off" style="font-size: 14px; min-height: 44px;">
                        <button type="submit" class="btn btn-admin-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0 shadow-sm" style="width: 44px; height: 44px;" title="Send Message">
                            <i class="fa-solid fa-paper-plane" style="font-size: 15px;"></i>
                        </button>
                    </form>
                </div>

            <?php else: ?>
                <!-- No Conversation Selected State -->
                <div class="m-auto text-center text-muted p-5">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px; background: #f8fafc; color: #94a3b8; font-size: 36px;">
                        <i class="fa-regular fa-comments"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-1">Select or Start a Conversation</h5>
                    <p class="small text-muted mb-4" style="max-width: 400px; margin: 0 auto;">Choose an existing contact from the left list, or start a new encrypted consultation chat.</p>
                    <button type="button" class="btn btn-admin-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#newChatModal">
                        <i class="fa-solid fa-plus me-1"></i> Start New Message
                    </button>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<!-- 3. Start New Conversation Modal -->
<div class="modal fade" id="newChatModal" tabindex="-1" aria-labelledby="newChatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-bottom px-4 py-3 bg-light rounded-top-4">
                <h5 class="modal-title fw-bold text-dark" id="newChatModalLabel">
                    <i class="fa-solid fa-pen-to-square text-brand me-2"></i> Start New Conversation
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/messages/start') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Select Contact / Practitioner *</label>
                        <select name="target_user_id" class="form-select rounded-3 py-2" required>
                            <option value="">-- Choose a recipient --</option>
                            <?php foreach ($availableContacts as $contact): ?>
                                <option value="<?= (int)$contact['id'] ?>">
                                    <?= ViewHelper::e($contact['name']) ?> (<?= ucfirst(ViewHelper::e($contact['role'])) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Subject / Topic</label>
                        <input type="text" name="subject" class="form-control rounded-3 py-2" placeholder="e.g. Clinical Consultation, Adoption Inquiry, Product Question">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-dark">Initial Message *</label>
                        <textarea name="initial_message" class="form-control rounded-3" rows="3" placeholder="Type your initial greeting or clinical inquiry..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light px-4 py-3 rounded-bottom-4">
                    <button type="button" class="btn btn-admin-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">
                        <i class="fa-solid fa-paper-plane me-1"></i> Send &amp; Open Chat
                    </button>
                </div>
            </form>
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
    const form = document.getElementById('sendMessageForm');
    const msgInput = document.getElementById('messageInput');
    const convId = <?= (int)($activeConvId ?? 0) ?>;

    const scrollToBottom = () => {
        if (msgBox) {
            msgBox.scrollTop = msgBox.scrollHeight;
        }
    };

    scrollToBottom();
    if (msgInput) {
        msgInput.focus();
    }

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = msgInput ? msgInput.value.trim() : '';
            if (!text) return;

            const sendBtn = form.querySelector('button[type="submit"]');
            if (sendBtn) sendBtn.disabled = true;

            // Immediate optimistic UI append
            const now = new Date();
            const timeStr = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            const bubbleHtml = `
                <div class="d-flex flex-column align-items-end" id="tempMsg_${Date.now()}">
                    <div class="chat-bubble-mine">
                        ${PetGuardToast.escapeHtml(text).replace(/\n/g, '<br>')}
                    </div>
                    <span class="text-muted mt-1" style="font-size: 10.5px;">
                        ${timeStr} &middot; <i class="fa-solid fa-check text-muted" style="font-size: 9px;"></i>
                    </span>
                </div>
            `;

            // If empty placeholder was showing, clear it
            if (msgBox && msgBox.querySelector('.fa-comment-dots')) {
                msgBox.innerHTML = '';
            }

            if (msgBox) {
                msgBox.insertAdjacentHTML('beforeend', bubbleHtml);
                scrollToBottom();
            }

            msgInput.value = '';
            msgInput.focus();

            try {
                const formData = new FormData(form);
                formData.set('message', text);
                const res = await PetGuardAjax.request(form.getAttribute('action') || 'portal/messages/send', {
                    method: 'POST',
                    body: formData
                });

                if (!res.ok) {
                    PetGuardToast.error(res.message || 'Could not send message.');
                }
            } catch (err) {
                PetGuardToast.error('Network error sending message.');
            } finally {
                if (sendBtn) sendBtn.disabled = false;
            }
        });
    }

    // Live Polling for new incoming messages every 4 seconds
    if (convId > 0 && msgBox) {
        let lastCount = msgBox.querySelectorAll('.chat-bubble-mine, .chat-bubble-theirs').length;
        setInterval(async () => {
            const res = await PetGuardAjax.get(`messages/conversation/${convId}`);
            if (res.ok && res.data && res.data.messages) {
                const messages = res.data.messages;
                if (messages.length > lastCount) {
                    lastCount = messages.length;
                    // Re-render conversation stream
                    const currentUserId = <?= (int)($currentUser['id'] ?? 0) ?>;
                    let html = '';
                    messages.forEach(msg => {
                        const isMine = parseInt(msg.sender_id, 10) === currentUserId;
                        const date = new Date(msg.created_at);
                        const time = isNaN(date.getTime()) ? '' : date.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                        const text = (msg.message_text || msg.message || '').replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>");

                        if (isMine) {
                            html += `
                                <div class="d-flex flex-column align-items-end">
                                    <div class="chat-bubble-mine">${text}</div>
                                    <span class="text-muted mt-1" style="font-size: 10.5px;">${time}</span>
                                </div>
                            `;
                        } else {
                            html += `
                                <div class="d-flex flex-column align-items-start">
                                    <div class="chat-bubble-theirs">${text}</div>
                                    <span class="text-muted mt-1" style="font-size: 10.5px;">${time}</span>
                                </div>
                            `;
                        }
                    });
                    msgBox.innerHTML = html;
                    scrollToBottom();
                }
            }
        }, 4000);
    }
});
</script>
