<?php
use Helpers\ViewHelper;

$products = $products ?? [];
$totalItems = count($products);
$inStockCount = 0;
$lowStockCount = 0;
$outOfStockCount = 0;
$totalInventoryValuation = 0.0;

foreach ($products as $p) {
    $stock = (int)($p['stock'] ?? 0);
    $price = (float)($p['price'] ?? 0);
    $totalInventoryValuation += ($stock * $price);
    if ($stock > 10) {
        $inStockCount++;
    } elseif ($stock > 0) {
        $lowStockCount++;
    } else {
        $outOfStockCount++;
    }
}
?>

<style>
/* 5-Screen Breakpoints for Inventory */
@media (max-width: 767.98px) {
    .inventory-desktop-table { display: none !important; }
    .inventory-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .inventory-desktop-table { display: block !important; }
    .inventory-mobile-grid { display: none !important; }
}
</style>

<div class="vendor-inventory-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-boxes-stacked text-warning"></i>
                <span>Real-Time Warehouse Stock</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= $inStockCount ?> In Stock</span>
            </div>
            <h2 class="portal-hero-title">Inventory &amp; Stock Control 📦</h2>
            <p class="portal-hero-subtitle">
                Monitor warehouse stock levels, adjust SKU inventory counts in real time, and prevent stockouts.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('vendor/products') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-layer-group"></i>
                <span>Products Catalog</span>
            </a>
            <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-plus"></i>
                <span>Add New SKU</span>
            </a>
        </div>
    </div>

    <!-- 2. 4 Top Inventory Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Tracked SKUs</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-barcode"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalItems ?></div>
                <small class="text-muted" style="font-size: 11px;">Active Inventory Items</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Healthy Stock</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $inStockCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">&gt; 10 Units Ready</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Low Stock Alert</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $lowStockCount > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $lowStockCount ?></div>
                <small class="text-muted" style="font-size: 11px;">1 to 10 Units Remaining</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Valuation</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($totalInventoryValuation, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Warehouse Stock Asset</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Inventory Content -->
    <?php if (empty($products)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <i class="fa-solid fa-warehouse fs-1 text-muted mb-3 d-block"></i>
            <h5 class="fw-bold text-dark">No Products Tracked</h5>
            <p class="small text-muted mb-3">Add items to your merchant catalog to begin tracking real-time stock levels.</p>
            <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> Add Product SKU
            </a>
        </div>
    <?php else: ?>

        <!-- A. Desktop High-Density Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden inventory-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Live Stock Inventory (<?= $totalItems ?> Items)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Auto-Sync Enabled</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 280px;">Product Name &amp; SKU</th>
                            <th class="py-3" style="min-width: 150px;">Category</th>
                            <th class="py-3" style="min-width: 120px;">Unit Price</th>
                            <th class="py-3" style="min-width: 130px;">Stock Units</th>
                            <th class="py-3" style="min-width: 130px;">Threshold Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 200px;">Quick Stock Adjust</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): 
                            $stock = (int)$prod['stock'];
                        ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/food-1.png') ?>" alt="Product" class="rounded-3 border flex-shrink-0" style="width: 48px; height: 48px; object-fit: contain; background: #f8fafc; padding: 2px;">
                                        <div class="min-w-0">
                                            <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="fw-bold text-dark text-decoration-none text-truncate d-block" style="font-size: 14px; max-width: 300px;">
                                                <?= ViewHelper::e($prod['name']) ?>
                                            </a>
                                            <span class="text-muted small font-monospace" style="font-size: 11px;">SKU: <?= ViewHelper::e($prod['sku'] ?: 'PG-SKU-NONE') ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill"><?= ViewHelper::e($prod['category']) ?></span>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$prod['price'], 2) ?>
                                </td>
                                <td>
                                    <span class="fw-bold fs-6 text-dark" id="stock-val-<?= $prod['id'] ?>"><?= $stock ?></span>
                                    <span class="text-muted small">Units</span>
                                </td>
                                <td>
                                    <?php if ($stock > 10): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-circle-check me-1"></i> In Stock
                                        </span>
                                    <?php elseif ($stock > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Low Stock
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-light border rounded-circle" style="width: 32px; height: 32px; padding: 0;" onclick="stepStock(<?= $prod['id'] ?>, -1)">
                                            <i class="fa-solid fa-minus" style="font-size: 11px;"></i>
                                        </button>
                                        <input type="number" id="input-stock-<?= $prod['id'] ?>" class="form-control form-control-sm text-center font-monospace fw-bold rounded-3" value="<?= $stock ?>" min="0" style="width: 70px;">
                                        <button type="button" class="btn btn-sm btn-light border rounded-circle" style="width: 32px; height: 32px; padding: 0;" onclick="stepStock(<?= $prod['id'] ?>, 1)">
                                            <i class="fa-solid fa-plus" style="font-size: 11px;"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-admin-primary rounded-pill px-3 ms-1 fw-bold" onclick="saveStock(<?= $prod['id'] ?>)">
                                            Save
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile & Tablet Card Grid (<768px) -->
        <div class="row g-3 inventory-mobile-grid mb-4">
            <?php foreach ($products as $prod): 
                $stock = (int)$prod['stock'];
            ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex gap-3 align-items-center mb-2">
                                <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/food-1.png') ?>" alt="Product" class="rounded-3 border flex-shrink-0" style="width: 52px; height: 52px; object-fit: contain; background: #f8fafc; padding: 2px;">
                                <div class="min-w-0 flex-grow-1">
                                    <span class="badge bg-light text-secondary border mb-1" style="font-size: 10px;"><?= ViewHelper::e($prod['category']) ?></span>
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 14px;"><?= ViewHelper::e($prod['name']) ?></div>
                                    <small class="text-muted font-monospace" style="font-size: 11px;">SKU: <?= ViewHelper::e($prod['sku'] ?: 'N/A') ?></small>
                                </div>
                            </div>

                            <div class="p-2 px-3 bg-light rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark fs-6">$<?= number_format((float)$prod['price'], 2) ?></span>
                                <div>
                                    <?php if ($stock > 10): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10px;">In Stock</span>
                                    <?php elseif ($stock > 0): ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10px;">Low Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 10px;">Out of Stock</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Stepper on Mobile -->
                        <div class="pt-2 border-top">
                            <label class="form-label text-muted small mb-1" style="font-size: 11px;">Update Stock Level:</label>
                            <div class="d-flex align-items-center gap-1">
                                <button type="button" class="btn btn-light border rounded-circle flex-shrink-0" style="width: 36px; height: 36px; padding: 0;" onclick="stepStock(<?= $prod['id'] ?>, -1)">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <input type="number" id="input-stock-mob-<?= $prod['id'] ?>" class="form-control text-center font-monospace fw-bold rounded-3" value="<?= $stock ?>" min="0">
                                <button type="button" class="btn btn-light border rounded-circle flex-shrink-0" style="width: 36px; height: 36px; padding: 0;" onclick="stepStock(<?= $prod['id'] ?>, 1)">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <button type="button" class="btn btn-admin-primary rounded-pill px-3 fw-bold flex-shrink-0" onclick="saveStockMobile(<?= $prod['id'] ?>)">
                                    Save
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<script>
function stepStock(id, delta) {
    const desktopInput = document.getElementById('input-stock-' + id);
    const mobileInput = document.getElementById('input-stock-mob-' + id);
    
    let currentVal = parseInt((desktopInput ? desktopInput.value : mobileInput ? mobileInput.value : 0), 10) || 0;
    let newVal = Math.max(0, currentVal + delta);
    
    if (desktopInput) desktopInput.value = newVal;
    if (mobileInput) mobileInput.value = newVal;
}

async function saveStock(id) {
    const input = document.getElementById('input-stock-' + id);
    const newStock = parseInt(input ? input.value : 0, 10);
    if (isNaN(newStock) || newStock < 0) {
        PetGuardToast.error('Please enter a valid non-negative number.');
        return;
    }

    try {
        const res = await PetGuardAjax.post(`vendor/inventory/${id}/stock`, { stock: newStock });
        if (res.ok) {
            PetGuardToast.success(res.message || 'Stock level updated.');
            const valEl = document.getElementById('stock-val-' + id);
            if (valEl) valEl.textContent = newStock;
        } else {
            PetGuardToast.error(res.message || 'Failed to update stock.');
        }
    } catch (e) {
        PetGuardToast.error('Network error updating stock.');
    }
}

async function saveStockMobile(id) {
    const input = document.getElementById('input-stock-mob-' + id);
    const newStock = parseInt(input ? input.value : 0, 10);
    if (isNaN(newStock) || newStock < 0) {
        PetGuardToast.error('Please enter a valid non-negative number.');
        return;
    }

    try {
        const res = await PetGuardAjax.post(`vendor/inventory/${id}/stock`, { stock: newStock });
        if (res.ok) {
            PetGuardToast.success(res.message || 'Stock level updated.');
            const valEl = document.getElementById('stock-val-' + id);
            if (valEl) valEl.textContent = newStock;
        } else {
            PetGuardToast.error(res.message || 'Failed to update stock.');
        }
    } catch (e) {
        PetGuardToast.error('Network error updating stock.');
    }
}
</script>
