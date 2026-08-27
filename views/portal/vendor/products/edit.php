<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Product: <?= ViewHelper::e($product['name']) ?></h2>
        <p class="admin-page-subtitle">SKU: <?= ViewHelper::e($product['sku']) ?> &middot; Category: <?= ViewHelper::e($product['category']) ?></p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('vendor/products/' . $product['id']) ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Product
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-box text-brand me-2"></i> Edit Information</h3>
    </div>
    <div class="admin-card-body">
        <form id="editProductForm" action="<?= ViewHelper::url('vendor/products/' . $product['id'] . '/edit') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label small fw-bold">Product Title *</label>
                    <input type="text" name="name" class="form-control" value="<?= ViewHelper::e($product['name']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">SKU Code</label>
                    <input type="text" class="form-control font-monospace bg-light" value="<?= ViewHelper::e($product['sku']) ?>" readonly>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Category *</label>
                    <select name="category" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= ViewHelper::e($cat['title']) ?>" <?= $product['category'] === $cat['title'] ? 'selected' : '' ?>><?= ViewHelper::e($cat['title']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Retail Price ($ USD) *</label>
                    <input type="number" step="0.01" name="price" class="form-control" value="<?= $product['price'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Old / Compare Price ($ USD)</label>
                    <input type="number" step="0.01" name="old_price" class="form-control" value="<?= $product['old_price'] ?? '' ?>">
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Current Inventory Stock *</label>
                    <input type="number" name="stock" class="form-control" value="<?= $product['stock'] ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Weight / Volume</label>
                    <input type="text" name="weight" class="form-control" value="<?= ViewHelper::e($product['weight'] ?? '1.0 kg') ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Target Species</label>
                    <select name="target_species" class="form-select">
                        <option value="All Pets" <?= ($product['target_species'] ?? '') === 'All Pets' ? 'selected' : '' ?>>All Pets</option>
                        <option value="Dog" <?= ($product['target_species'] ?? '') === 'Dog' ? 'selected' : '' ?>>Dog</option>
                        <option value="Cat" <?= ($product['target_species'] ?? '') === 'Cat' ? 'selected' : '' ?>>Cat</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Product Description</label>
                <textarea name="description" class="form-control" rows="5"><?= ViewHelper::e($product['description']) ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                    <i class="fa-solid fa-check me-1"></i> Save Product Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#editProductForm', {
        loadingText: 'Updating Product...',
        redirect: 'vendor/products/<?= $product['id'] ?>'
    });
});
</script>
