<?php
use Helpers\ViewHelper;

$totalItems = $stats['totalItems'] ?? count($inventory);
$lowStock = $stats['lowStock'] ?? 0;
$outOfStock = $stats['outOfStock'] ?? 0;
$totalValuation = $stats['totalValuation'] ?? 0.0;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-warehouse text-warning"></i>
            <span>Real-Time Warehouse Stock</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">$<?= number_format((float)$totalValuation, 2) ?> Valuation</span>
        </div>
        <h2 class="portal-hero-title">Inventory &amp; Stock Control 📦</h2>
        <p class="portal-hero-subtitle">
            Real-time warehouse SKU tracking, low stock thresholds, and replenishment adjustments.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/marketplace/products') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span>Products Catalog</span>
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
                <span class="stat-card-label">Monitored SKUs</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-boxes-stacked"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalItems) ?></div>
            <div class="stat-card-footer text-muted">
                Active Warehouse Lines
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Low Stock Alerts</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-triangle-exclamation text-danger"></i>
                </div>
            </div>
            <div class="stat-card-value text-danger"><?= number_format($lowStock) ?></div>
            <div class="stat-card-footer text-danger fw-bold">
                <i class="fa-solid fa-circle-exclamation me-1"></i> Stock &le; 5 Units
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Out of Stock</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-circle-xmark text-warning"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($outOfStock) ?></div>
            <div class="stat-card-footer text-muted">
                Zero Balance SKUs
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Inventory Asset Value</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-sack-dollar text-success"></i>
                </div>
            </div>
            <div class="stat-card-value text-success">$<?= number_format((float)$totalValuation, 2) ?></div>
            <div class="stat-card-footer text-muted">
                Total Stock Valuation
            </div>
        </div>
    </div>
</div>

<!-- Inventory Table Card -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-list-check text-brand me-2"></i> Stock Telemetry & Quick Adjustments
        </h3>
        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
            <?= count($inventory) ?> Monitored SKUs
        </span>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product & SKU</th>
                        <th>Category</th>
                        <th>Current Quantity</th>
                        <th>Stock Health</th>
                        <th>Unit Price</th>
                        <th style="text-align: right;">Update Stock Level</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inventory)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">No inventory records found in warehouse database.</td></tr>
                    <?php else: ?>
                        <?php foreach ($inventory as $item): ?>
                            <?php
                            $itemName = $item['name'] ?? $item['title'] ?? 'Unnamed Product';
                            $itemCategory = $item['category'] ?? $item['category_name'] ?? 'General';
                            $stock = (int)($item['stock'] ?? 0);
                            $price = (float)($item['price'] ?? 0);
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($item['image_url'])): ?>
                                            <img src="<?= ViewHelper::asset($item['image_url']) ?>" class="rounded-3 border object-fit-cover" style="width: 40px; height: 40px; min-width: 40px;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                                        <?php else: ?>
                                            <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center text-muted fw-bold" style="width: 40px; height: 40px; min-width: 40px;">
                                                <i class="fa-solid fa-box"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($itemName) ?></div>
                                            <small class="text-muted font-monospace" style="font-size: 11.5px;">SKU: <?= ViewHelper::e($item['sku'] ?? 'N/A') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                        <i class="fa-solid fa-tag text-muted me-1"></i> <?= ViewHelper::e($itemCategory) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold fs-6 <?= $stock <= 5 ? 'text-danger' : 'text-dark' ?>">
                                        <?= number_format($stock) ?> Units
                                    </span>
                                </td>
                                <td>
                                    <?php if ($stock <= 0): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                        </span>
                                    <?php elseif ($stock <= 5): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2 py-1 fw-bold" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Low Stock Alert
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-circle-check me-1"></i> Optimal Stock
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark" style="font-size: 14px;">$<?= number_format($price, 2) ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <form action="<?= ViewHelper::url("admin/marketplace/products/{$item['id']}/stock") ?>" method="POST" class="d-inline-flex align-items-center gap-2 m-0 justify-content-end">
                                        <?= ViewHelper::csrfField() ?>
                                        <input type="number" name="stock" value="<?= $stock ?>" class="form-control form-control-sm rounded-pill text-center border" style="width: 85px; font-weight: 600;" min="0">
                                        <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3 py-1 fw-semibold" style="background: #fa441d; border: none;">Save</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
