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

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-box text-brand me-2"></i> Product Information</h3>
    </div>
    <div class="admin-card-body">
        <form id="createProductForm" action="<?= ViewHelper::url('vendor/products/create') ?>" method="POST" enctype="multipart/form-data">
            <?= ViewHelper::csrfField() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label small fw-bold">Product Title *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Pet Guard Premium Organic Salmon Kibble 5kg" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">SKU Code (Stock Keeping Unit)</label>
                    <input type="text" name="sku" class="form-control font-monospace" placeholder="PG-SKU-1082">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Category *</label>
                    <select name="category" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= ViewHelper::e($cat['title']) ?>"><?= ViewHelper::e($cat['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Retail Price ($ USD) *</label>
                    <input type="number" step="0.01" name="price" class="form-control" placeholder="29.99" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Old / Compare Price ($ USD)</label>
                    <input type="number" step="0.01" name="old_price" class="form-control" placeholder="39.99">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Initial Inventory Stock Count *</label>
                    <input type="number" name="stock" class="form-control" value="25" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Product Weight / Volume</label>
                    <input type="text" name="weight" class="form-control" placeholder="e.g. 5.0 kg / 500 ml" value="1.0 kg">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Target Pet Species</label>
                    <select name="target_species" class="form-select">
                        <option value="All Pets">All Pets</option>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <option value="Small Animals">Small Animals</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Product Image</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                <div class="form-text small text-muted">Upload high quality product packaging image (JPG, PNG, WebP).</div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Detailed Description, Ingredients & Features</label>
                <textarea name="description" class="form-control" rows="5" placeholder="Highlight key nutritional benefits, materials, sizing guide, or usage instructions..."></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
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
</script>
