<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-box text-brand me-2"></i> Order #<?= ViewHelper::e($order['order_number']) ?></h2>
        <p class="admin-page-subtitle">Placed on <?= date('F d, Y \a\t h:i A', strtotime($order['created_at'])) ?> &middot; Total: $<?= number_format((float)$order['total'], 2) ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= ViewHelper::url('portal/messages?target=' . ($customer['id'] ?? 0)) ?>" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-comments me-1"></i> Customer Support Chat
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left: Order Items & Pipeline Status -->
    <div class="col-lg-8">
        <!-- Order Pipeline Status Form -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-route text-brand me-2"></i> Update Fulfillment Status</h3>
            </div>
            <div class="admin-card-body">
                <form id="orderStatusForm" action="<?= ViewHelper::url('vendor/orders/' . $order['id'] . '/status') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="row g-3 align-items-center">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Order Lifecycle Stage</label>
                            <select name="status" class="form-select form-select-lg" required>
                                <option value="pending" <?= $order['status'] === 'pending' ? 'selected' : '' ?>>1. Pending Verification</option>
                                <option value="confirmed" <?= $order['status'] === 'confirmed' ? 'selected' : '' ?>>2. Confirmed</option>
                                <option value="processing" <?= $order['status'] === 'processing' ? 'selected' : '' ?>>3. Packing & Processing</option>
                                <option value="ready_to_ship" <?= $order['status'] === 'ready_to_ship' ? 'selected' : '' ?>>4. Ready for Courier Pickup</option>
                                <option value="shipped" <?= $order['status'] === 'shipped' ? 'selected' : '' ?>>5. In Transit / Shipped</option>
                                <option value="out_for_delivery" <?= $order['status'] === 'out_for_delivery' ? 'selected' : '' ?>>6. Out for Delivery</option>
                                <option value="delivered" <?= $order['status'] === 'delivered' ? 'selected' : '' ?>>7. Successfully Delivered</option>
                                <option value="cancelled" <?= $order['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                <option value="refunded" <?= $order['status'] === 'refunded' ? 'selected' : '' ?>>Refunded</option>
                            </select>
                        </div>
                        <div class="col-md-4 pt-md-4">
                            <button type="submit" class="btn btn-admin-primary rounded-pill w-100 py-2">
                                Update Status
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Purchased Order Items -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-list-check text-brand me-2"></i> Order Line Items</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="table-responsive m-0">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-4">Product</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($items as $item): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($item['name']) ?></div>
                                        <span class="small text-muted font-monospace">SKU: <?= ViewHelper::e($item['sku'] ?? 'PG-SKU') ?></span>
                                    </td>
                                    <td>
                                        $<?= number_format((float)$item['price'], 2) ?>
                                    </td>
                                    <td>
                                        <?= (int)$item['quantity'] ?>
                                    </td>
                                    <td class="text-end pe-4 fw-bold text-dark">
                                        $<?= number_format((float)($item['price'] * $item['quantity']), 2) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Right: Customer & Shipping Summary -->
    <div class="col-lg-4">
        <!-- Customer Info -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-user me-2"></i> Customer Profile</h3>
            </div>
            <div class="admin-card-body small">
                <div class="fw-bold text-dark fs-6 mb-1"><?= ViewHelper::e($customer['name'] ?? 'Pet Parent') ?></div>
                <div class="text-muted mb-2"><i class="fa-solid fa-envelope me-1"></i> <?= ViewHelper::e($customer['email'] ?? 'N/A') ?></div>
                <div class="text-muted"><i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($customer['phone'] ?? 'N/A') ?></div>
            </div>
        </div>

        <!-- Shipping Destination -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-location-dot me-2"></i> Shipping Address</h3>
            </div>
            <div class="admin-card-body small">
                <div class="p-3 bg-light rounded-3">
                    <div class="fw-bold text-dark mb-1"><?= ViewHelper::e($order['shipping_name'] ?? $customer['name'] ?? 'Customer') ?></div>
                    <div><?= ViewHelper::e($order['shipping_address'] ?? '88 Magnolia Court, Apt 4B') ?></div>
                    <div><?= ViewHelper::e($order['shipping_city'] ?? 'Austin') ?>, <?= ViewHelper::e($order['shipping_zip'] ?? '78701') ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#orderStatusForm', {
        loadingText: 'Updating Status...',
        reload: true
    });
});
</script>
