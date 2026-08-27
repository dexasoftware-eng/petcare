<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Inventory & Stock Control</h2>
        <p class="admin-page-subtitle">Real-time warehouse SKU tracking, low stock thresholds, and replenishment orders.</p>
    </div>
</div>

<!-- Inventory Table Card -->
<div class="admin-card">
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
                        <th>Update Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inventory as $item): ?>
                        <tr>
                            <td>
                                <div class="fw-bold text-dark"><?= ViewHelper::e($item['name']) ?></div>
                                <small class="text-muted font-monospace">SKU: <?= ViewHelper::e($item['sku']) ?></small>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($item['category_name'] ?? 'General') ?></span></td>
                            <td class="fw-bold fs-6 <?= $item['stock'] <= 5 ? 'text-danger' : 'text-dark' ?>">
                                <?= number_format($item['stock']) ?> Units
                            </td>
                            <td>
                                <?php if ($item['stock'] == 0): ?>
                                    <span class="badge-status status-disabled">Out of Stock</span>
                                <?php elseif ($item['stock'] <= 5): ?>
                                    <span class="badge-status status-pending">Low Stock Alert</span>
                                <?php else: ?>
                                    <span class="badge-status status-active">Optimal Stock</span>
                                <?php endif; ?>
                            </td>
                            <td>$<?= number_format((float)$item['price'], 2) ?></td>
                            <td>
                                <form action="<?= ViewHelper::url("admin/marketplace/products/{$item['id']}/stock") ?>" method="POST" class="d-flex align-items-center gap-2 m-0">
                                    <?= ViewHelper::csrfField() ?>
                                    <input type="number" name="stock" value="<?= $item['stock'] ?>" class="form-control form-control-sm rounded-pill text-center" style="width: 80px;" min="0">
                                    <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3">Update</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
