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
/* 5-Screen Responsive Vendor Products Catalog */
.vendor-products-container {
    max-width: 1400px;
    margin: 0 auto;
    width: 100%;
}

/* Hero Header Banner */
.vendor-hero-banner {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: 22px;
    padding: 26px 30px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.2);
}
.vendor-hero-banner::after {
    content: '';
    position: absolute;
    top: -40%;
    right: -10%;
    width: 320px;
    height: 320px;
    background: radial-gradient(circle, rgba(255, 122, 24, 0.2) 0%, rgba(255, 122, 24, 0) 70%);
    pointer-events: none;
}

/* Product Card for Mobile / Tablet */
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
    overflow: hidden;
    box-sizing: border-box;
}
.vendor-product-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 28px -6px rgba(15, 23, 42, 0.1), 0 0 0 1px rgba(255, 122, 24, 0.25);
    border-color: #cbd5e1;
}

.vendor-product-thumb {
    width: 60px;
    height: 60px;
    min-width: 60px;
    border-radius: 14px;
    object-fit: cover;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    flex-shrink: 0;
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .vendor-hero-banner {
        padding: 20px 16px;
        border-radius: 16px;
    }
    .vendor-product-thumb {
        width: 52px;
        height: 52px;
        min-width: 52px;
        border-radius: 12px;
    }
    .vendor-desktop-table {
        display: none !important;
    }
    .vendor-mobile-grid {
        display: flex !important;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .vendor-hero-banner {
        padding: 22px 20px;
    }
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

    <!-- Hero Header Banner -->
    <div class="vendor-hero-banner mb-4">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-7 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-tags text-brand"></i> Merchant Inventory Management
                </div>
                <h2 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Store Product Catalog</h2>
                <p class="text-white-50 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Manage your merchant inventory, real-time prices, SKU codes, stock thresholds, and public marketplace listings.
                </p>
            </div>
            <div class="col-12 col-md-5 col-lg-4 text-md-end">
                <div class="d-flex flex-column flex-sm-row gap-2 justify-content-md-end">
                    <a href="<?= ViewHelper::url('shop') ?>" target="_blank" class="btn btn-outline-light rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm" style="font-size: 13px;">
                        <i class="fa-solid fa-store"></i> Live Shop
                    </a>
                    <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2" style="font-size: 13px;">
                        <i class="fa-solid fa-plus"></i> Add Product
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Top Inventory Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Listed</span>
                    <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalProducts ?></div>
                <small class="text-muted" style="font-size: 11px;">Active in Catalog</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">In-Stock Ready</span>
                    <div class="stat-card-icon icon-green" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $inStockCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Available to Ship</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Low Stock Alerts</span>
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $lowStockCount > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $lowStockCount ?></div>
                <small class="text-muted" style="font-size: 11px;">&lt; 5 Units Remaining</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Stock Value</span>
                    <div class="stat-card-icon icon-purple" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($totalInventoryValuation, 0) ?></div>
                <small class="text-muted" style="font-size: 11px;">Inventory Valuation</small>
            </div>
        </div>
    </div>

    <!-- Smart Search & Filter Toolbar -->
    <div class="admin-card p-3 p-md-4 shadow-sm mb-4" style="border-radius: 20px;">
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
                    <option value="in_stock" <?= ($selectedStock ?? '') === 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                    <option value="low_stock" <?= ($selectedStock ?? '') === 'low_stock' ? 'selected' : '' ?>>Low Stock</option>
                    <option value="out_of_stock" <?= ($selectedStock ?? '') === 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                </select>
                <?php if (!empty($search) || !empty($selectedCategory) || !empty($selectedStock)): ?>
                    <a href="<?= ViewHelper::url('vendor/products') ?>" class="btn btn-light rounded-circle border shadow-sm d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px;" title="Clear Filters">
                        <i class="fa-solid fa-xmark text-muted"></i>
                    </a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Products Content Container -->
    <?php if (empty($products)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm" style="border-radius: 20px;">
            <i class="fa-solid fa-box-open fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-bold text-dark">No Products Found</h5>
            <p class="small text-muted mb-3">No inventory items matched your search filters or catalog is empty.</p>
            <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Add First Product
            </a>
        </div>
    <?php else: ?>

        <!-- 1. DESKTOP & TABLET DATA TABLE VIEW (Visible on >=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden vendor-desktop-table mb-4" style="border-radius: 20px;">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange" style="width: 32px; height: 32px; font-size: 13px; border-radius: 9px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Inventory Catalog (<?= $totalProducts ?> Items)</h6>
                </div>
            </div>

            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3">Product Item</th>
                            <th class="py-3">Category</th>
                            <th class="py-3">SKU</th>
                            <th class="py-3">Price</th>
                            <th class="py-3">Stock Units</th>
                            <th class="py-3">Status</th>
                            <th class="text-end pe-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/product-1.jpg') ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="vendor-product-thumb">
                                        <div class="min-w-0">
                                            <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="fw-bold text-dark text-decoration-none text-truncate d-block" style="font-size: 14px;">
                                                <?= ViewHelper::e($prod['name']) ?>
                                            </a>
                                            <small class="text-muted d-block text-truncate"><?= ViewHelper::e($prod['target_species'] ?? 'All Companions') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1"><?= ViewHelper::e($prod['category']) ?></span>
                                </td>
                                <td class="font-monospace text-dark">
                                    <code><?= ViewHelper::e($prod['sku'] ?: 'SKU-NONE') ?></code>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$prod['price'], 2) ?>
                                </td>
                                <td>
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
                                <td>
                                    <?php if (!empty($prod['in_stock'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1">Hidden</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;" title="View Product">
                                            <i class="fa-regular fa-eye" style="font-size: 12px;"></i>
                                        </a>
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id'] . '/edit') ?>" class="btn btn-sm btn-outline-brand rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;" title="Edit Product">
                                            <i class="fa-solid fa-pen" style="font-size: 11px;"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px; padding: 0;" onclick="deleteProduct(<?= $prod['id'] ?>)" title="Archive Product">
                                            <i class="fa-regular fa-trash-can" style="font-size: 12px;"></i>
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
                                <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/product-1.jpg') ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="vendor-product-thumb">
                                <div class="min-w-0 flex-grow-1" style="overflow: hidden;">
                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                        <span class="badge bg-light text-secondary border" style="font-size: 10px;"><?= ViewHelper::e($prod['category']) ?></span>
                                        <?php if (!empty($prod['in_stock'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill" style="font-size: 9.5px;">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill" style="font-size: 9.5px;">Hidden</span>
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

<script>
async function deleteProduct(id) {
    const confirmed = await PetGuardModal.danger({
        title: 'Archive Product?',
        message: 'This will remove the product from your active merchant storefront.'
    });

    if (confirmed) {
        const res = await PetGuardAjax.post(`vendor/products/${id}/delete`);
        if (res.ok) {
            PetGuardToast.success('Product archived successfully.');
            setTimeout(() => window.location.reload(), 600);
        } else {
            PetGuardToast.error(res.message || 'Failed to archive product.');
        }
    }
}
</script>
