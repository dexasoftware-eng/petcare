<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-boxes-stacked text-brand me-2"></i> Inventory & Stock Level Control</h2>
        <p class="admin-page-subtitle">Real-time stock monitoring, threshold warnings, and fast inline inventory adjustments.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-warehouse text-brand me-2"></i> Product Stock Levels</h3>
        <span class="badge bg-light text-dark border"><?= count($products ?? []) ?> Tracked Items</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($products)): ?>
            <div class="p-5 text-center text-muted">No products tracked in inventory.</div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Product Name</th>
                            <th>SKU</th>
                            <th>Category</th>
                            <th>Current Stock</th>
                            <th>Threshold Status</th>
                            <th class="text-end pe-4">Quick Adjust Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/product-1.jpg') ?>" alt="Product" class="rounded-3 border" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($prod['name']) ?></div>
                                    </div>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($prod['sku']) ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= ViewHelper::e($prod['category']) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold fs-6 text-dark" id="stock-val-<?= $prod['id'] ?>"><?= (int)$prod['stock'] ?></span> Units
                                </td>
                                <td>
                                    <?php if ((int)$prod['stock'] > 10): ?>
                                        <span class="admin-badge badge-success">In Stock</span>
                                    <?php elseif ((int)$prod['stock'] > 0): ?>
                                        <span class="admin-badge badge-amber">Low Stock</span>
                                    <?php else: ?>
                                        <span class="admin-badge badge-danger">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex align-items-center gap-2" style="max-width: 220px;">
                                        <input type="number" id="input-stock-<?= $prod['id'] ?>" class="form-control form-control-sm text-center font-monospace" value="<?= (int)$prod['stock'] ?>" min="0" style="width: 80px;">
                                        <button type="button" class="btn btn-sm btn-outline-brand rounded-pill px-3" onclick="saveStock(<?= $prod['id'] ?>)">
                                            Update
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
async function saveStock(id) {
    const input = document.getElementById('input-stock-' + id);
    const newStock = parseInt(input.value, 10);
    if (isNaN(newStock) || newStock < 0) {
        PetGuardToast.error('Please enter a valid non-negative number.');
        return;
    }

    const res = await PetGuardAjax.post(`vendor/inventory/${id}/stock`, { stock: newStock });
    if (res.ok) {
        PetGuardToast.success(res.message);
        document.getElementById('stock-val-' + id).textContent = newStock;
    } else {
        PetGuardToast.error(res.message);
    }
}
</script>
