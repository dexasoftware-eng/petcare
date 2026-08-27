<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-box text-brand me-2"></i> <?= ViewHelper::e($product['name']) ?></h2>
        <p class="admin-page-subtitle">SKU: <span class="font-monospace fw-bold text-dark"><?= ViewHelper::e($product['sku']) ?></span> &middot; Category: <?= ViewHelper::e($product['category']) ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= ViewHelper::url('vendor/products/' . $product['id'] . '/edit') ?>" class="btn btn-outline-brand rounded-pill px-4">
            <i class="fa-solid fa-pen-to-square me-1"></i> Edit Product
        </a>
        <a href="<?= ViewHelper::url('product-details/' . $product['slug']) ?>" target="_blank" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-eye me-1"></i> View on Storefront
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <div class="mb-3 position-relative">
                <img id="mainProductShowcaseImg" src="<?= ViewHelper::asset($product['img'] ?? 'img/product-1.jpg') ?>" alt="Product" class="rounded-4 border img-fluid w-100 shadow-sm" style="max-height: 260px; object-fit: contain; background: #fafafa;">
            </div>

            <!-- Multi-Image Thumbnails -->
            <?php if (!empty($images) && count($images) > 1): ?>
                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                    <?php foreach ($images as $idx => $img): ?>
                        <div class="rounded-3 border p-1 bg-white shadow-sm" style="width: 54px; height: 54px; cursor: pointer; transition: transform 0.2s;" onclick="document.getElementById('mainProductShowcaseImg').src = '<?= ViewHelper::asset($img['img_path']) ?>'" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                            <img src="<?= ViewHelper::asset($img['img_path']) ?>" class="w-100 h-100 rounded-2" style="object-fit: cover;">
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h4 class="fw-bold text-dark mb-1">$<?= number_format((float)$product['price'], 2) ?></h4>
            <?php if (!empty($product['old_price'])): ?>
                <span class="text-muted text-decoration-line-through small me-2">$<?= number_format((float)$product['old_price'], 2) ?></span>
            <?php endif; ?>

            <hr class="my-3">

            <div class="text-start small">
                <div class="mb-2"><strong>Category:</strong> <?= ViewHelper::e($product['category']) ?></div>
                <div class="mb-2"><strong>Stock Level:</strong> <span class="badge <?= (int)$product['stock'] > 5 ? 'bg-success' : 'bg-danger' ?>"><?= (int)$product['stock'] ?> Units</span></div>
                <div class="mb-2"><strong>Weight:</strong> <?= ViewHelper::e($product['weight'] ?? '1.0 kg') ?></div>
                <div><strong>Target Species:</strong> <?= ViewHelper::e($product['target_species'] ?? 'All Pets') ?></div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-align-left text-brand me-2"></i> Description & Features</h3>
            </div>
            <div class="admin-card-body">
                <p class="text-secondary leading-relaxed"><?= nl2br(ViewHelper::e($product['description'])) ?></p>
            </div>
        </div>
    </div>
</div>
