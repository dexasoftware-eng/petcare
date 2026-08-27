<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-boxes-stacked text-warning"></i>
            <span>Global Marketplace Catalog</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($stats['total'] ?? count($products)) ?> SKUs Listed</span>
        </div>
        <h2 class="portal-hero-title">Marketplace Products Catalog 🛍️</h2>
        <p class="portal-hero-subtitle">
            Global product directory, catalog pricing, inventory telemetry, and product status oversight.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/marketplace/inventory') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-warehouse"></i>
            <span>Stock Management</span>
        </a>
        <a href="<?= ViewHelper::url('our-products') ?>" target="_blank" class="btn btn-admin-primary">
            <i class="fa-solid fa-store"></i>
            <span>Live Pet Store</span>
        </a>
    </div>
</div>

<!-- 4 Top Metric KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Catalog Items</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(count($products)) ?></div>
            <div class="stat-card-footer text-muted">
                Active Listed Products
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Low Stock Warnings</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-triangle-exclamation text-danger"></i>
                </div>
            </div>
            <div class="stat-card-value text-danger"><?= number_format(\Models\Product::count("stock <= 5 AND stock > 0")) ?></div>
            <div class="stat-card-footer text-danger fw-bold">
                Stock &le; 5 Units Remaining
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Categories</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-layer-group text-primary"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(\Models\Category::count()) ?></div>
            <div class="stat-card-footer text-muted">
                Product Classifications
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Out of Stock</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-circle-exclamation text-warning"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(\Models\Product::count("stock = 0")) ?></div>
            <div class="stat-card-footer text-muted">
                Sold Out Items
            </div>
        </div>
    </div>
</div>

<!-- Products Table Card -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-list-ul text-brand me-2"></i> Products Catalog Directory
        </h3>
        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
            <?= count($products) ?> Items
        </span>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product Details</th>
                        <th>Category</th>
                        <th>Price (USD)</th>
                        <th>Stock Level</th>
                        <th>Catalog Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">No products found in marketplace catalog.</td></tr>
                    <?php else: ?>
                        <?php foreach ($products as $p): ?>
                            <?php
                            $productName = $p['name'] ?? $p['title'] ?? 'Unnamed Product';
                            $categoryName = $p['category'] ?? $p['category_name'] ?? 'General';
                            $stock = (int)($p['stock'] ?? 0);
                            $price = (float)($p['price'] ?? 0);
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($p['image_url'])): ?>
                                            <img src="<?= ViewHelper::asset($p['image_url']) ?>" class="rounded-3 border object-fit-cover" style="width: 44px; height: 44px; min-width: 44px;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                                        <?php else: ?>
                                            <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted fw-bold" style="width: 44px; height: 44px; min-width: 44px;">
                                                <i class="fa-solid fa-box"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($productName) ?></div>
                                            <small class="text-muted font-monospace" style="font-size: 11.5px;">SKU: <?= ViewHelper::e($p['sku'] ?? 'N/A') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                        <i class="fa-solid fa-tag text-muted me-1"></i> <?= ViewHelper::e($categoryName) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark" style="font-size: 14px;">$<?= number_format($price, 2) ?></span>
                                </td>
                                <td>
                                    <?php if ($stock <= 0): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                        </span>
                                    <?php elseif ($stock <= 5): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 fw-bold" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $stock ?> Low Stock
                                        </span>
                                    <?php else: ?>
                                        <span class="fw-semibold text-dark" style="font-size: 13.5px;"><?= $stock ?> Units</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= ($p['is_active'] ?? $p['in_stock'] ?? 1) ? 'active' : 'disabled' ?>">
                                        <?= ($p['is_active'] ?? $p['in_stock'] ?? 1) ? 'Active' : 'Disabled' ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= ViewHelper::url("shop/product/{$p['id']}") ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold" target="_blank">
                                        <i class="fa-solid fa-arrow-up-right-from-square me-1 text-primary"></i> View in Store
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
