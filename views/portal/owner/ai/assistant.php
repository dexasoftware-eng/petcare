<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-brain text-warning"></i>
            <span>Intelligent Clinical Advisor</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">OpenRouter Free Engine</span>
        </div>
        <h2 class="portal-hero-title">AI Pet Care Assistant 🤖</h2>
        <p class="portal-hero-subtitle">Ask nutrition, wellness, exercise, and routine questions powered by AI with pet health profile context.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>My Portal</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Main Chat Workspace -->
    <div class="col-lg-8">
        <div class="card card-custom p-0 overflow-hidden shadow-sm d-flex flex-column" style="height: 620px;">
            <!-- Header Bar -->
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white shadow-sm" style="width: 38px; height: 38px; background: linear-gradient(135deg, #8b5cf6 0%, #6366f1 100%);">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div>
                        <div class="fw-bold text-dark small">PetGuard AI Clinical & Routine Advisor</div>
                        <small class="text-muted" style="font-size: 11px;">Patient Profile Context Injected</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="small text-muted fw-bold d-none d-sm-inline">Discussing Pet:</label>
                    <select id="aiPetSelect" class="form-select form-select-sm rounded-pill" style="width: auto;">
                        <option value="0">General Pet Inquiry</option>
                        <?php foreach ($pets as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['breed']) ?>)</option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <!-- Messages Window -->
            <div id="aiChatBox" class="p-4 flex-grow-1 overflow-auto d-flex flex-column gap-3" style="background: #f8fafc;">
                <!-- Initial Welcome Bubble -->
                <div class="d-flex align-items-start gap-2" style="max-width: 85%;">
                    <div class="rounded-circle bg-white p-2 border shadow-sm" style="width: 36px; height: 36px; min-width: 36px; text-align: center;">
                        <i class="fa-solid fa-robot text-primary"></i>
                    </div>
                    <div class="p-3 rounded-4 bg-white border shadow-sm small text-dark">
                        <div class="fw-bold text-primary mb-1">PetGuard AI Assistant</div>
                        Hello <strong><?= ViewHelper::e($user['name']) ?></strong>! I am your AI companion for preventive care, dietary optimization, grooming routines, and understanding veterinary terminology.<br><br>
                        <em>How can I assist you with your pets today?</em>
                    </div>
                </div>
            </div>

            <!-- Input Box -->
            <div class="p-3 border-top bg-white">
                <form id="aiChatForm" class="d-flex gap-2 m-0">
                    <input type="text" id="aiInput" class="form-control rounded-pill px-4" placeholder="Ask about symptoms, food portions, exercise, or routines..." autocomplete="off">
                    <button type="submit" id="aiSendBtn" class="btn btn-brand rounded-pill px-4 fw-bold">
                        <i class="fa-solid fa-paper-plane me-1"></i> Ask
                    </button>
                </form>
                <div class="d-flex justify-content-between text-muted mt-2 px-2" style="font-size: 10.5px;">
                    <span>⚠️ For informational guidance only &middot; Not a substitute for licensed clinical diagnosis</span>
                    <span>24/7 Hotline: +1-800-555-PET-911</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Side Suggestions & Health Insights -->
    <div class="col-lg-4">
        <!-- Recommended Questions Card -->
        <div class="card card-custom p-4 mb-4">
            <h6 class="fw-bold text-dark mb-3"><i class="fa-regular fa-lightbulb text-warning me-2"></i> Suggested Prompts</h6>
            <div class="d-flex flex-column gap-2">
                <button type="button" class="btn btn-sm btn-light border text-start rounded-3 p-2 small prompt-suggestion">
                    "What are the ideal daily walking guidelines for my dog?"
                </button>
                <button type="button" class="btn btn-sm btn-light border text-start rounded-3 p-2 small prompt-suggestion">
                    "How can I prepare a low-stress grooming routine?"
                </button>
                <button type="button" class="btn btn-sm btn-light border text-start rounded-3 p-2 small prompt-suggestion">
                    "Explain the DHPP and Rabies vaccination schedule."
                </button>
                <button type="button" class="btn btn-sm btn-light border text-start rounded-3 p-2 small prompt-suggestion">
                    "What foods are dangerous or toxic for domestic pets?"
                </button>
            </div>
        </div>

        <!-- AI Care Plan Generator -->
        <div class="card card-custom p-4" style="background: #faf5ff; border: 1px solid #e9d5ff;">
            <div class="d-flex align-items-center gap-2 mb-2 text-purple" style="color: #7e22ce;">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <h6 class="fw-bold m-0">Generate Smart Care Plan</h6>
            </div>
            <p class="small text-muted mb-3">Ask AI to formulate a customized weekly routine based on your pet's species, age, and breed.</p>
            <button type="button" id="btnGenCarePlan" class="btn btn-sm rounded-pill text-white fw-bold w-100" style="background: #8b5cf6;">
                Generate Weekly Care Plan
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('aiChatForm');
    const input = document.getElementById('aiInput');
    const box = document.getElementById('aiChatBox');
    const petSelect = document.getElementById('aiPetSelect');

    document.querySelectorAll('.prompt-suggestion').forEach(btn => {
        btn.addEventListener('click', () => {
            input.value = btn.innerText.replace(/"/g, '').trim();
            form.dispatchEvent(new Event('submit'));
        });
    });

    document.getElementById('btnGenCarePlan')?.addEventListener('click', () => {
        const petText = petSelect.options[petSelect.selectedIndex].text;
        input.value = `Generate an intelligent weekly care and exercise routine for ${petText}. Include Monday through Sunday suggestions for feeding, activity, and grooming.`;
        form.dispatchEvent(new Event('submit'));
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const query = input.value.trim();
        if (!query) return;

        // Append User Bubble
        const userDiv = document.createElement('div');
        userDiv.className = 'd-flex align-items-start gap-2 ms-auto';
        userDiv.style.maxWidth = '85%';
        userDiv.innerHTML = `
            <div class="p-3 rounded-4 bg-brand text-white shadow-sm small">
                ${escapeHtml(query)}
            </div>
        `;
        box.appendChild(userDiv);
        input.value = '';
        box.scrollTop = box.scrollHeight;

        // Append Typing Bubble
        const typingDiv = document.createElement('div');
        typingDiv.className = 'd-flex align-items-start gap-2';
        typingDiv.style.maxWidth = '85%';
        typingDiv.id = 'aiTypingBubble';
        typingDiv.innerHTML = `
            <div class="rounded-circle bg-white p-2 border shadow-sm" style="width: 36px; height: 36px; min-width: 36px; text-align: center;">
                <i class="fa-solid fa-robot text-primary"></i>
            </div>
            <div class="p-3 rounded-4 bg-white border shadow-sm small text-muted">
                <i class="fa-solid fa-spinner fa-spin me-1"></i> Thinking...
            </div>
        `;
        box.appendChild(typingDiv);
        box.scrollTop = box.scrollHeight;

        try {
            const res = await fetch('<?= ViewHelper::url("portal/ai-assistant/chat") ?>', {
                method: 'POST',
                headers: { 
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: new URLSearchParams({
                    prompt: query,
                    pet_id: petSelect.value,
                    _csrf: '<?= ViewHelper::csrfToken() ?>',
                    csrf_token: '<?= ViewHelper::csrfToken() ?>'
                })
            });
            const data = await res.json();
            typingDiv.remove();

            const aiDiv = document.createElement('div');
            aiDiv.className = 'd-flex align-items-start gap-2';
            aiDiv.style.maxWidth = '85%';

            let responseHtml = data.response ? data.response.replace(/\n/g, '<br>') : (data.error || 'I could not generate a response. Please try again.');
            if (data.is_emergency) {
                responseHtml = `<div class="alert alert-danger p-2 mb-2 fw-bold"><i class="fa-solid fa-triangle-exclamation me-1"></i> ${data.safety_alert || 'Potential Medical Emergency Detected'}</div>` + responseHtml;
            }

            aiDiv.innerHTML = `
                <div class="rounded-circle bg-white p-2 border shadow-sm" style="width: 36px; height: 36px; min-width: 36px; text-align: center;">
                    <i class="fa-solid fa-robot text-primary"></i>
                </div>
                <div class="p-3 rounded-4 bg-white border shadow-sm small text-dark">
                    <div class="fw-bold text-primary mb-1">PetGuard AI</div>
                    ${responseHtml}
                </div>
            `;
            box.appendChild(aiDiv);
            box.scrollTop = box.scrollHeight;
        } catch (err) {
            typingDiv.remove();
            if (typeof PetGuardToast !== 'undefined') {
                PetGuardToast.error('Could not connect to AI service. Please try again.');
            }
        }
    });

    function escapeHtml(text) {
        const div = document.createElement('div');
        div.innerText = text;
        return div.innerHTML;
    }
});
</script>
