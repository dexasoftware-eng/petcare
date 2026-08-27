<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-circle-plus text-brand me-2"></i> Add New Store Product</h2>
        <p class="admin-page-subtitle">Publish a new pet care product, food, supplement, or accessory to the Pet Guard store.</p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('vendor/products') ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Catalog
        </a>
    </div>
</div>

<!-- AI Auto-Fill Helper Card -->
<div class="admin-card p-3 p-md-4 mb-4 border shadow-sm" style="border-radius: 20px; background: linear-gradient(135deg, #f0fdf4 0%, #ffffff 100%); border-color: #bbf7d0 !important;">
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-green" style="width: 42px; height: 42px; font-size: 18px; border-radius: 12px;">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark m-0">AI Product Auto-Generator</h6>
                <small class="text-muted">Type any product title or brand name below and click <strong>"AI Auto-Fill"</strong> to automatically generate SKU, pricing, category, weight, and clinical descriptions.</small>
            </div>
        </div>
    </div>
</div>

<div class="admin-card" style="border-radius: 20px;">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-box text-brand me-2"></i> Product Information</h3>
    </div>
    <div class="admin-card-body">
        <form id="createProductForm" action="<?= ViewHelper::url('vendor/products/create') ?>" method="POST" enctype="multipart/form-data">
            <?= ViewHelper::csrfField() ?>

            <!-- Title with Direct AI Action -->
            <div class="row g-3 mb-3">
                <div class="col-12 col-md-8">
                    <label class="form-label small fw-bold text-dark">Product Title *</label>
                    <div class="input-group">
                        <input type="text" id="productTitleInput" name="name" class="form-control" placeholder="e.g. Royal Canin Mini Adult Dog Food 8kg or KONG Classic Dog Toy Large" required>
                        <button type="button" id="btnAiAutoFill" class="btn btn-success fw-bold px-3 d-inline-flex align-items-center gap-1" onclick="triggerAiFill()">
                            <i class="fa-solid fa-wand-magic-sparkles"></i> <span id="aiBtnText">AI Auto-Fill</span>
                        </button>
                    </div>
                    <div class="form-text small text-muted">Enter brand name or title and click <strong>AI Auto-Fill</strong> to populate all details.</div>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-dark">SKU Code (Stock Keeping Unit)</label>
                    <input type="text" id="productSkuInput" name="sku" class="form-control font-monospace" placeholder="PG-SKU-1082">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-dark">Category *</label>
                    <select id="productCategorySelect" name="category" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= ViewHelper::e($cat['title']) ?>"><?= ViewHelper::e($cat['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label small fw-bold text-dark">Retail Price ($ USD) *</label>
                    <input type="number" step="0.01" id="productPriceInput" name="price" class="form-control" placeholder="29.99" required>
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label small fw-bold text-dark">Old / Compare Price ($ USD)</label>
                    <input type="number" step="0.01" id="productOldPriceInput" name="old_price" class="form-control" placeholder="39.99">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-12 col-md-4">
                    <label class="form-label small fw-bold text-dark">Initial Stock Count *</label>
                    <input type="number" id="productStockInput" name="stock" class="form-control" value="25" required>
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label small fw-bold text-dark">Product Weight / Volume</label>
                    <input type="text" id="productWeightInput" name="weight" class="form-control" placeholder="e.g. 5.0 kg / 500 ml" value="1.0 kg">
                </div>
                <div class="col-6 col-md-4">
                    <label class="form-label small fw-bold text-dark">Target Pet Species</label>
                    <select id="productSpeciesSelect" name="target_species" class="form-select">
                        <option value="All Pets">All Pets</option>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <option value="Small Animals">Small Animals</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold text-dark m-0">Product Packaging &amp; Gallery Photos (Upload Multiple)</label>
                    <span class="badge bg-light text-muted border" id="imageCountBadge" style="font-size: 10px;">Select Multiple Photos</span>
                </div>
                <input type="file" name="images[]" id="productImagesInput" class="form-control rounded-3" accept="image/*" multiple onchange="previewMultipleImages(this)">
                <div class="form-text small text-muted">You can select multiple photos at once (JPG, PNG, WebP). The first photo will be set as the main storefront image.</div>
                
                <!-- Live Preview Grid -->
                <div id="imagePreviewContainer" class="d-flex flex-wrap gap-2 mt-3 d-none"></div>
            </div>

            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <label class="form-label small fw-bold text-dark m-0">Detailed Description, Benefits &amp; Ingredients</label>
                    <span id="aiDescBadge" class="badge bg-success-subtle text-success border border-success-subtle d-none" style="font-size: 10px;">
                        <i class="fa-solid fa-sparkles me-1"></i> AI Optimized Copy
                    </span>
                </div>
                <textarea id="productDescriptionInput" name="description" class="form-control" rows="6" placeholder="Highlight key nutritional benefits, materials, sizing guide, or usage instructions..."></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2">
                <a href="<?= ViewHelper::url('vendor/products') ?>" class="btn btn-light rounded-pill px-4">Cancel</a>
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5 fw-bold shadow-sm">
                    <i class="fa-solid fa-check me-1"></i> Publish Product
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#createProductForm', {
        loadingText: 'Publishing Product...',
        redirect: 'vendor/products'
    });
});

function previewMultipleImages(input) {
    const container = document.getElementById('imagePreviewContainer');
    const badge = document.getElementById('imageCountBadge');
    container.innerHTML = '';

    if (!input.files || input.files.length === 0) {
        container.classList.add('d-none');
        badge.textContent = 'Select Multiple Photos';
        return;
    }

    container.classList.remove('d-none');
    badge.textContent = `${input.files.length} Photo(s) Selected`;

    Array.from(input.files).forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const card = document.createElement('div');
            card.className = 'position-relative rounded-3 border p-1 bg-light shadow-sm';
            card.style.width = '80px';
            card.style.height = '80px';
            card.innerHTML = `
                <img src="${e.target.result}" class="w-100 h-100 rounded-2" style="object-fit: cover;">
                <span class="badge ${idx === 0 ? 'bg-success' : 'bg-dark bg-opacity-75'} position-absolute top-0 start-0 m-1" style="font-size: 8px;">
                    ${idx === 0 ? 'Primary' : `#${idx + 1}`}
                </span>
            `;
            container.appendChild(card);
        };
        reader.readAsDataURL(file);
    });
}

async function triggerAiFill() {
    const titleInput = document.getElementById('productTitleInput');
    const title = (titleInput.value || '').trim();
    if (!title) {
        PetGuardToast.warning('Please enter a product title or brand name first.');
        titleInput.focus();
        return;
    }

    const btn = document.getElementById('btnAiAutoFill');
    const btnText = document.getElementById('aiBtnText');
    const origHtml = btnText.innerHTML;

    btn.disabled = true;
    btnText.innerHTML = '<span class="spinner-border spinner-border-sm me-1" role="status"></span> Generating...';

    try {
        const res = await PetGuardAjax.post('vendor/products/ai-generate', { title: title });
        if (res.ok && res.data) {
            const d = res.data;
            if (d.name) titleInput.value = d.name;
            if (d.sku) document.getElementById('productSkuInput').value = d.sku;
            if (d.price) document.getElementById('productPriceInput').value = parseFloat(d.price).toFixed(2);
            if (d.old_price) document.getElementById('productOldPriceInput').value = parseFloat(d.old_price).toFixed(2);
            if (d.stock) document.getElementById('productStockInput').value = d.stock;
            if (d.weight) document.getElementById('productWeightInput').value = d.weight;
            if (d.description) {
                document.getElementById('productDescriptionInput').value = d.description;
                document.getElementById('aiDescBadge').classList.remove('d-none');
            }

            // Select category
            if (d.category) {
                const catSelect = document.getElementById('productCategorySelect');
                for (let i = 0; i < catSelect.options.length; i++) {
                    if (catSelect.options[i].value.toLowerCase() === d.category.toLowerCase() ||
                        catSelect.options[i].text.toLowerCase() === d.category.toLowerCase()) {
                        catSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            // Select target species
            if (d.target_species) {
                const specSelect = document.getElementById('productSpeciesSelect');
                for (let i = 0; i < specSelect.options.length; i++) {
                    if (specSelect.options[i].value.toLowerCase() === d.target_species.toLowerCase()) {
                        specSelect.selectedIndex = i;
                        break;
                    }
                }
            }

            PetGuardToast.success('Product fields successfully auto-populated by AI!');
        } else {
            PetGuardToast.error(res.message || 'Failed to auto-generate product details.');
        }
    } catch (e) {
        PetGuardToast.error('An error occurred during AI generation.');
    } finally {
        btn.disabled = false;
        btnText.innerHTML = origHtml;
    }
}
</script>
