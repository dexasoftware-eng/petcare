<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-cart-shopping text-warning"></i>
            <span>Commercial Order Details</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">#<?= ViewHelper::e($order['order_number']) ?></span>
        </div>
        <h2 class="portal-hero-title">Order #<?= ViewHelper::e($order['order_number']) ?> 📦</h2>
        <p class="portal-hero-subtitle">Placed: <?= date('F d, Y \a\t H:i', strtotime($order['created_at'])) ?> &middot; Total: $<?= number_format((float)$order['total'], 2) ?> &middot; Status: <span class="badge-status status-<?= $order['status'] ?>"><?= ucfirst(ViewHelper::e($order['status'])) ?></span></p>
    </div>
    <div class="d-flex flex-wrap align-items-center gap-2">
        <form action="<?= ViewHelper::url("admin/marketplace/orders/{$order['id']}/status") ?>" method="POST" class="d-flex align-items-center gap-2 m-0">
            <?= ViewHelper::csrfField() ?>
            <select name="status" class="form-select form-select-sm rounded-pill px-3 bg-white" style="font-size: 13px; height: 38px;">
                <option value="placed" <?= $order['status'] === 'placed' ? 'selected' : '' ?>>Placed</option>
                <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>Processing / Packaging</option>
                <option value="completed" <?= $order['status'] === 'completed' ? 'selected' : '' ?>>Completed / Delivered</option>
                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
            <button type="submit" class="btn btn-admin-primary">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Update</span>
            </button>
        </form>
        <a href="<?= ViewHelper::url('admin/marketplace/orders') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Order Summary and Shipping -->
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-truck text-brand"></i> Shipping & Recipient</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Recipient Name</label>
                    <div class="fw-bold"><?= ViewHelper::e(trim(($order['first_name'] ?? '') . ' ' . ($order['last_name'] ?? '')) ?: 'Customer') ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Contact</label>
                    <div><?= ViewHelper::e($order['phone'] ?? '—') ?></div>
                    <small class="text-muted"><?= ViewHelper::e($order['email'] ?? '—') ?></small>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Delivery Address</label>
                    <div class="fw-semibold text-dark"><?= ViewHelper::e(($order['address'] ?? '') . ', ' . ($order['city'] ?? '') . ' ' . ($order['postcode'] ?? '')) ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Payment Method</label>
                    <div><span class="badge bg-light text-dark border text-uppercase"><?= ViewHelper::e($order['payment_method'] ?? 'Card') ?> (<?= ViewHelper::e($order['payment_status'] ?? 'paid') ?>)</span></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Items Table Card -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-boxes-packing text-primary"></i> Order Items & Breakdown</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Product Item</th>
                                <th>Unit Price</th>
                                <th>Qty</th>
                                <th class="text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= ViewHelper::e($item['name'] ?? 'Item') ?></td>
                                    <td>$<?= number_format((float)($item['price'] ?? 0), 2) ?></td>
                                    <td><?= (int)($item['quantity'] ?? 1) ?></td>
                                    <td class="text-end fw-bold text-dark">$<?= number_format((float)(($item['price'] ?? 0) * ($item['quantity'] ?? 1)), 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end fw-bold fs-6">Order Total:</td>
                                <td class="text-end fw-bold fs-5 text-brand">$<?= number_format((float)($order['total'] ?? 0), 2) ?></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
