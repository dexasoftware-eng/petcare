<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <a href="<?= ViewHelper::url('admin/ai') ?>" class="btn btn-sm btn-light rounded-pill mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to AI Intelligence
        </a>
        <h2 class="admin-page-title"><i class="fa-solid fa-robot text-purple me-2"></i> AI Pet Care Assistant Sandbox</h2>
        <p class="admin-page-subtitle">Test clinical prompt safety, emergency triage detection, and veterinary educational guidance using OpenRouter.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Configuration & Context Selector -->
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-sliders text-brand"></i> Clinical Context</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">Attach Pet Patient Context</label>
                    <select id="selectedPetId" class="form-select rounded-3">
                        <option value="">-- No specific pet (General Query) --</option>
                        <?php foreach ($pets as $pet): ?>
                            <option value="<?= $pet['id'] ?>"><?= ViewHelper::e($pet['name']) ?> (<?= ViewHelper::e($pet['species']) ?> - <?= ViewHelper::e($pet['breed']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold">Model Engine</label>
                    <div class="p-2 px-3 bg-light rounded-3 font-monospace small text-dark border">
                        <i class="fa-solid fa-bolt text-warning me-1"></i> OpenRouter Free Tier
                    </div>
                </div>

                <hr>

                <h6 class="fw-bold small text-uppercase text-muted mb-2">1-Click Test Scenarios</h6>
                <div class="d-flex flex-column gap-2">
                    <button class="btn btn-sm btn-outline-danger text-start rounded-3" onclick="fillPrompt('My dog ate a whole bar of dark chocolate and is breathing heavily and trembling!')">
                        🚨 <span class="fw-bold">Emergency Ingestion Triage</span>
                    </button>
                    <button class="btn btn-sm btn-outline-primary text-start rounded-3" onclick="fillPrompt('What are the core vaccination milestones for a 10-week-old rescue puppy?')">
                        🩺 <span class="fw-bold">Puppy Immunization Timeline</span>
                    </button>
                    <button class="btn btn-sm btn-outline-success text-start rounded-3" onclick="fillPrompt('How can I increase water intake for my senior domestic cat with early kidney signs?')">
                        💧 <span class="fw-bold">Feline Hydration Strategies</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Interactive Chat Console -->
    <div class="col-lg-8">
        <div class="admin-card d-flex flex-column" style="height: 620px;">
            <div class="admin-card-header bg-light d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-white p-2 border shadow-sm text-purple">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark lh-1">PetGuard Clinical AI Assistant</div>
                        <small class="text-muted" id="aiStatusText">Ready for inquiry</small>
                    </div>
                </div>
                <button class="btn btn-sm btn-light rounded-pill px-3" onclick="clearAiChat()">Clear Log</button>
            </div>

            <!-- Messages Window -->
            <div class="admin-card-body flex-grow-1 overflow-auto p-4" id="aiChatWindow" style="background: #faf8f5;">
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-white border p-2 text-danger shadow-sm" style="width: 38px; height: 38px; text-align: center;">
                        <i class="fa-solid fa-shield-cat"></i>
                    </div>
                    <div class="p-3 bg-white rounded-4 shadow-sm border" style="max-width: 80%;">
                        <div class="fw-bold text-dark mb-1 small">PetGuard AI Medical Assistant</div>
                        <p class="mb-0 small text-muted">Hello! I am configured with strict veterinary safety guardrails. Ask any questions regarding pet wellness, nutrition, or preventive healthcare.</p>
                    </div>
                </div>
            </div>

            <!-- Input Bar -->
            <div class="p-3 border-top bg-white">
                <form id="aiPromptForm" onsubmit="sendAiPrompt(event)" class="d-flex gap-2">
                    <input type="text" id="aiPromptInput" class="form-control rounded-pill px-4" placeholder="Type clinical symptom or question..." required autocomplete="off">
                    <button type="submit" class="btn btn-brand rounded-pill px-4 fw-bold d-inline-flex align-items-center gap-2" id="aiSendBtn">
                        <span>Send</span>
                        <i class="fa-solid fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function fillPrompt(text) {
        document.getElementById('aiPromptInput').value = text;
        document.getElementById('aiPromptInput').focus();
    }

    function clearAiChat() {
        document.getElementById('aiChatWindow').innerHTML = `
            <div class="d-flex align-items-start gap-3 mb-3">
                <div class="rounded-circle bg-white border p-2 text-danger shadow-sm" style="width: 38px; height: 38px; text-align: center;">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
                <div class="p-3 bg-white rounded-4 shadow-sm border" style="max-width: 80%;">
                    <div class="fw-bold text-dark mb-1 small">PetGuard AI Medical Assistant</div>
                    <p class="mb-0 small text-muted">Chat history cleared. Ready for new clinical inquiry.</p>
                </div>
            </div>
        `;
    }

    function sendAiPrompt(e) {
        e.preventDefault();
        var prompt = document.getElementById('aiPromptInput').value.trim();
        if (!prompt) return;

        var petId = document.getElementById('selectedPetId').value;
        var chatWindow = document.getElementById('aiChatWindow');
        var sendBtn = document.getElementById('aiSendBtn');
        var statusText = document.getElementById('aiStatusText');

        // Append User Message
        chatWindow.innerHTML += `
            <div class="d-flex align-items-start justify-content-end gap-3 mb-3">
                <div class="p-3 bg-dark text-white rounded-4 shadow-sm" style="max-width: 80%;">
                    <div class="small fw-semibold mb-1 text-light">You (Administrator)</div>
                    <div class="small">${escapeHtml(prompt)}</div>
                </div>
            </div>
        `;
        chatWindow.scrollTop = chatWindow.scrollHeight;

        document.getElementById('aiPromptInput').value = '';
        sendBtn.disabled = true;
        statusText.innerHTML = '<span class="spinner-border spinner-border-sm text-primary me-1"></span> Consulting OpenRouter AI...';

        // AJAX POST to Admin AI Endpoint
        fetch('<?= ViewHelper::url("admin/ai/ask") ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: new URLSearchParams({
                'prompt': prompt,
                'pet_id': petId,
                '_csrf': '<?= Helpers\ViewHelper::csrfToken() ?>'
            })
        })
        .then(res => res.json())
        .then(data => {
            sendBtn.disabled = false;
            statusText.textContent = 'Response received in ' + (data.latency_ms || 0) + 'ms';

            var isEmergency = data.is_emergency;
            var responseHtml = escapeHtml(data.response || data.error || 'No response returned.').replace(/\n/g, '<br>');

            var alertBanner = isEmergency 
                ? `<div class="alert alert-danger p-2 mb-2 rounded-3 small fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i> EMERGENCY SAFETY PROTOCOL TRIGGERED: ${escapeHtml(data.safety_alert || 'Immediate Veterinary Attention Required')}</div>`
                : '';

            chatWindow.innerHTML += `
                <div class="d-flex align-items-start gap-3 mb-3">
                    <div class="rounded-circle bg-white border p-2 text-purple shadow-sm" style="width: 38px; height: 38px; text-align: center;">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <div class="p-3 bg-white rounded-4 shadow-sm border ${isEmergency ? 'border-danger' : ''}" style="max-width: 85%;">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold text-dark small">PetGuard AI Assistant</span>
                            <span class="badge bg-light text-muted border font-monospace" style="font-size: 10px;">${escapeHtml(data.model || 'OpenRouter')}</span>
                        </div>
                        ${alertBanner}
                        <div class="small text-dark leading-relaxed">${responseHtml}</div>
                    </div>
                </div>
            `;
            chatWindow.scrollTop = chatWindow.scrollHeight;
        })
        .catch(err => {
            sendBtn.disabled = false;
            statusText.textContent = 'Error communicating with AI engine';
            chatWindow.innerHTML += `
                <div class="alert alert-danger rounded-3 small m-3">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> Failed to communicate with AI gateway.
                </div>
            `;
        });
    }

    function escapeHtml(text) {
        var map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
        return text.replace(/[&<>"']/g, function(m) { return map[m]; });
    }
</script>
