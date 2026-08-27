<?php
use Helpers\ViewHelper;

$totalProducts = count($products ?? []);
$inStockCount = 0;
$lowStockCount = 0;
$outOfStockCount = 0;
$totalInventoryValuation = 0.0;

foreach ($products as $p) {
    $stock = (int)($p['stock'] ?? 0);
    $price = (float)($p['price'] ?? 0);
    $totalInventoryValuation += ($stock * $price);
    if ($stock > 5) {
        $inStockCount++;
    } elseif ($stock > 0) {
        $lowStockCount++;
    } else {
        $outOfStockCount++;
    }
}
?>

<style>
/* Modern Vendor Products Catalog Styling */
.vendor-products-container {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

.vendor-product-thumb {
    width: 54px;
    height: 54px;
    min-width: 54px;
    border-radius: 12px;
    object-fit: contain;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 3px;
    flex-shrink: 0;
    transition: transform 0.2s ease;
}
.vendor-product-thumb:hover {
    transform: scale(1.1);
}

.vendor-table th {
    font-size: 11px;
    letter-spacing: 0.6px;
    font-weight: 700;
    text-transform: uppercase;
    color: #64748b;
    background-color: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    padding: 14px 16px;
}

.vendor-table td {
    padding: 16px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
}

.vendor-table tbody tr {
    transition: background-color 0.15s ease;
}

.vendor-table tbody tr:hover {
    background-color: #f8fafc;
}

/* Card for Mobile / Tablet */
.vendor-product-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 18px;
    padding: 16px;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.vendor-product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 28px -6px rgba(15, 23, 42, 0.1);
    border-color: #cbd5e1;
}

/* 5-Screen Breakpoints */
@media (max-width: 767.98px) {
    .vendor-desktop-table {
        display: none !important;
    }
    .vendor-mobile-grid {
        display: flex !important;
    }
}
@media (min-width: 768px) {
    .vendor-mobile-grid {
        display: none !important;
    }
    .vendor-desktop-table {
        display: block !important;
    }
}
</style>

<div class="vendor-products-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-wand-magic-sparkles text-warning"></i>
                <span>Merchant Catalog Management</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= $totalProducts ?> SKUs Listed</span>
            </div>
            <h2 class="portal-hero-title">Store Products Catalog 🛍️</h2>
            <p class="portal-hero-subtitle">
                Manage your merchant inventory, real-time prices, SKU codes, and auto-add products using AI title analysis.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <button type="button" class="btn btn-admin-success" data-bs-toggle="modal" data-bs-target="#aiProductModal">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
                <span>AI Instant Add</span>
            </button>
            <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Add Product</span>
            </a>
            <a href="<?= ViewHelper::url('our-products') ?>" target="_blank" class="btn btn-admin-secondary">
                <i class="fa-solid fa-store"></i>
                <span>Live Store</span>
            </a>
        </div>
    </div>

    <!-- 2. 4 Top Inventory Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Listed</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalProducts ?></div>
                <small class="text-muted" style="font-size: 11px;">Active in Catalog</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">In-Stock Ready</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $inStockCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Available to Ship</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Low Stock Alerts</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $lowStockCount > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $lowStockCount ?></div>
                <small class="text-muted" style="font-size: 11px;">&lt; 5 Units Remaining</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Inventory Value</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($totalInventoryValuation, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Total Catalog Valuation</small>
            </div>
        </div>
    </div>

    <!-- 3. Smart Search & Filter Toolbar -->
    <div class="admin-card p-3 p-md-4 shadow-sm mb-4 rounded-4 bg-white">
        <form method="GET" action="<?= ViewHelper::url('vendor/products') ?>" class="row g-2 align-items-center">
            <div class="col-12 col-md-5 col-lg-6">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0 rounded-end-pill py-2" placeholder="Search by product name or SKU..." value="<?= ViewHelper::e($search ?? '') ?>">
                </div>
            </div>
            <div class="col-6 col-md-3 col-lg-3">
                <select name="category" class="form-select bg-light rounded-pill py-2" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= ViewHelper::e($cat['title']) ?>" <?= ($selectedCategory ?? '') === $cat['title'] ? 'selected' : '' ?>>
                            <?= ViewHelper::e($cat['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-6 col-md-4 col-lg-3 d-flex gap-2">
                <select name="stock_status" class="form-select bg-light rounded-pill py-2" onchange="this.form.submit()">
                    <option value="">All Stock Statuses</option>
                    <option value="in_stock" <?= ($selectedStock ?? '') === 'in_stock' ? 'selected' : '' ?>>In Stock (&gt; 5)</option>
                    <option value="low_stock" <?= ($selectedStock ?? '') === 'low_stock' ? 'selected' : '' ?>>Low Stock (1 - 5)</option>
                    <option value="out_of_stock" <?= ($selectedStock ?? '') === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock (0)</option>
                </select>
                <?php if (!empty($search) || !empty($selectedCategory) || !empty($selectedStock)): ?>
                    <a href="<?= ViewHelper::url('vendor/products') ?>" class="btn btn-light rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;" title="Clear Filters">
                        <i class="fa-solid fa-xmark text-muted"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- 4. Products Table View -->
    <?php if (empty($products)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <i class="fa-solid fa-box-open fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-bold text-dark">No Products Found</h5>
            <p class="small text-muted mb-3">No inventory items matched your search filters or catalog is empty.</p>
            <div class="d-flex justify-content-center gap-2">
                <button type="button" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#aiProductModal">
                    <i class="fa-solid fa-wand-magic-sparkles me-1"></i> AI Auto-Add Product
                </button>
                <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                    <i class="fa-solid fa-plus me-1"></i> Add Manually
                </a>
            </div>
        </div>
    <?php else: ?>

        <!-- 1. DESKTOP & TABLET DATA TABLE VIEW (Visible on >=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden vendor-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Inventory Catalog (<?= $totalProducts ?> Items)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Verified Vendor Merchant</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 280px;">Product &amp; SKU</th>
                            <th class="py-3" style="min-width: 150px;">Category &amp; Species</th>
                            <th class="py-3" style="min-width: 110px;">Price</th>
                            <th class="py-3" style="min-width: 140px;">Stock Units</th>
                            <th class="py-3" style="min-width: 110px;">Market Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <!-- Product & SKU -->
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="d-block flex-shrink-0">
                                            <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/food-1.png') ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="vendor-product-thumb">
                                        </a>
                                        <div class="min-w-0">
                                            <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="fw-bold text-dark text-decoration-none text-truncate d-block" style="font-size: 14px; max-width: 320px;" title="<?= ViewHelper::e($prod['name']) ?>">
                                                <?= ViewHelper::e($prod['name']) ?>
                                            </a>
                                            <span class="text-muted small font-monospace" style="font-size: 11px;">SKU: <?= ViewHelper::e($prod['sku'] ?: 'PG-SKU-NONE') ?></span>
                                        </div>
                                    </div>
                                </td>

                                <!-- Category & Species -->
                                <td class="py-3">
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill" style="font-size: 11.5px;"><?= ViewHelper::e($prod['category']) ?></span>
                                    <span class="d-block text-muted small mt-1" style="font-size: 11px;">
                                        <i class="fa-solid fa-paw text-brand me-1"></i><?= ViewHelper::e($prod['target_species'] ?? 'All Pets') ?>
                                    </span>
                                </td>

                                <!-- Price -->
                                <td class="py-3">
                                    <div class="fw-bold text-dark fs-6">$<?= number_format((float)$prod['price'], 2) ?></div>
                                    <?php if (!empty($prod['old_price'])): ?>
                                        <span class="text-muted text-decoration-line-through small" style="font-size: 11px;">$<?= number_format((float)$prod['old_price'], 2) ?></span>
                                    <?php endif; ?>
                                </td>

                                <!-- Stock Units -->
                                <td class="py-3">
                                    <?php if ((int)$prod['stock'] > 5): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-circle-check me-1"></i> <?= $prod['stock'] ?> In Stock
                                        </span>
                                    <?php elseif ((int)$prod['stock'] > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $prod['stock'] ?> Low Stock
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Status -->
                                <td class="py-3">
                                    <?php if (!empty($prod['in_stock'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">
                                            <i class="fa-solid fa-globe me-1"></i> Live
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1">
                                            <i class="fa-solid fa-eye-slash me-1"></i> Draft
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <!-- Actions -->
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex gap-1">
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; padding: 0;" title="View Product Details">
                                            <i class="fa-regular fa-eye" style="font-size: 13px;"></i>
                                        </a>
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id'] . '/edit') ?>" class="btn btn-sm btn-outline-brand rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; padding: 0;" title="Edit Product">
                                            <i class="fa-solid fa-pen" style="font-size: 12px;"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; padding: 0;" onclick="deleteProduct(<?= $prod['id'] ?>)" title="Archive Product">
                                            <i class="fa-regular fa-trash-can" style="font-size: 13px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 2. MOBILE & PHABLET CARDS GRID (Visible on <768px) -->
        <div class="row g-3 vendor-mobile-grid mb-4">
            <?php foreach ($products as $prod): ?>
                <div class="col-12 col-sm-6">
                    <div class="vendor-product-card">
                        
                        <div class="w-100 min-w-0">
                            <!-- Top: Thumbnail + Name + Category -->
                            <div class="d-flex gap-3 align-items-center mb-2">
                                <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/food-1.png') ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="vendor-product-thumb">
                                <div class="min-w-0 flex-grow-1" style="overflow: hidden;">
                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                        <span class="badge bg-light text-secondary border" style="font-size: 10px;"><?= ViewHelper::e($prod['category']) ?></span>
                                        <?php if (!empty($prod['in_stock'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 9.5px;">Live</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill" style="font-size: 9.5px;">Draft</span>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="fw-bold text-dark text-decoration-none text-truncate d-block mt-1" style="font-size: 14.5px;">
                                        <?= ViewHelper::e($prod['name']) ?>
                                    </a>
                                    <small class="text-muted text-truncate d-block" style="font-size: 11px;"><?= ViewHelper::e($prod['target_species'] ?? 'All Pets') ?></small>
                                </div>
                            </div>

                            <!-- Middle Details Strip -->
                            <div class="p-2 px-3 bg-light rounded-3 border mb-3 small d-flex justify-content-between align-items-center flex-wrap gap-1">
                                <div>
                                    <span class="text-muted" style="font-size: 10.5px;">SKU:</span>
                                    <code class="text-dark fw-bold"><?= ViewHelper::e($prod['sku'] ?: 'N/A') ?></code>
                                </div>
                                <div class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$prod['price'], 2) ?>
                                </div>
                            </div>

                            <!-- Stock Badge -->
                            <div class="mb-3">
                                <?php if ((int)$prod['stock'] > 5): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10.5px;">
                                        <i class="fa-solid fa-circle-check me-1"></i> <?= $prod['stock'] ?> In Stock
                                    </span>
                                <?php elseif ((int)$prod['stock'] > 0): ?>
                                    <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10.5px;">
                                        <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $prod['stock'] ?> Low Stock
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10.5px;">
                                        <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-1 pt-2 border-top w-100">
                            <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold flex-fill d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-truncate" style="height: 36px; font-size: 11.5px; min-width: 0;">
                                <i class="fa-regular fa-eye flex-shrink-0"></i> <span class="text-truncate">View</span>
                            </a>
                            <a href="<?= ViewHelper::url('vendor/products/' . $prod['id'] . '/edit') ?>" class="btn btn-sm btn-outline-brand rounded-pill fw-semibold flex-fill d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-truncate" style="height: 36px; font-size: 11.5px; min-width: 0;">
                                <i class="fa-solid fa-pen flex-shrink-0"></i> <span class="text-truncate">Edit</span>
                            </a>
                            <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 36px; height: 36px; padding: 0;" onclick="deleteProduct(<?= $prod['id'] ?>)" title="Archive">
                                <i class="fa-regular fa-trash-can" style="font-size: 12px;"></i>
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<!-- AI Instant Product Generator Modal -->
<div class="modal fade" id="aiProductModal" tabindex="-1" aria-labelledby="aiProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header p-4 border-bottom bg-light rounded-top-4">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; font-size: 16px;">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark m-0" id="aiProductModalLabel">AI Product Auto-Creator</h5>
                        <p class="text-muted small m-0">Enter any product title or brand name to automatically add to catalog</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="aiInstantProductForm" action="<?= ViewHelper::url('vendor/products/ai-create-instant') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Product Title or Brand Prompt *</label>
                        <textarea name="title" id="aiPromptTitle" class="form-control rounded-3 p-3" rows="3" placeholder="e.g. Royal Canin Hydrolyzed Protein Adult Dog Food 12kg or KONG Classic Dog Toy Large or Hill's Science Diet Indoor Cat Food 7kg" required></textarea>
                        <div class="form-text small text-muted mt-2">
                            The AI will automatically generate the <strong>category, SKU, pricing, weight, stock count, target species, and full product description</strong>.
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <div class="d-flex align-items-center gap-2 text-dark small fw-bold mb-1">
                            <i class="fa-solid fa-sparkles text-brand"></i> Instant AI Generation Features:
                        </div>
                        <ul class="text-muted small m-0 ps-3" style="font-size: 12px; line-height: 1.6;">
                            <li>Automated Clinical Nutrition &amp; Care Taxonomy</li>
                            <li>Calculates suggested competitive merchant pricing</li>
                            <li>Assigns matching demo product photograph and SKU</li>
                        </ul>
                    </div>
                </div>

                <div class="modal-footer p-3 px-4 border-top bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="aiSubmitBtn" class="btn btn-success rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-wand-magic-sparkles"></i>
                        <span>Generate &amp; Publish Now</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
async function deleteProduct(productId) {
    if (!confirm('Are you sure you want to archive this product? It will be hidden from the customer shop.')) {
        return;
    }

    try {
        const response = await PetGuardAjax.post(`vendor/products/${productId}/delete`);
        if (response.ok) {
            PetGuardToast.success('Product archived successfully.');
            setTimeout(() => window.location.reload(), 600);
        } else {
            PetGuardToast.error(response.message || 'Failed to archive product.');
        }
    } catch (e) {
        PetGuardToast.error('An unexpected error occurred.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#aiInstantProductForm', {
        loadingText: 'AI Analyzing & Generating Product...',
        redirect: '<?= ViewHelper::url("vendor/products") ?>',
        onSuccess: (data) => {
            const modalEl = document.getElementById('aiProductModal');
            if (modalEl && typeof bootstrap !== 'undefined') {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
            PetGuardToast.success(data.message || 'Product created and added to catalog successfully!');
            setTimeout(() => {
                window.location.href = '<?= ViewHelper::url("vendor/products") ?>';
            }, 700);
        },
        onError: (data) => {
            PetGuardToast.error(data.message || 'AI generation failed. Please try a different title.');
        }
    });
});
</script>
