<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-truck-fast text-brand me-2"></i> Orders & Shipping Pipeline</h2>
        <p class="admin-page-subtitle">Track, process, and ship customer pet store orders across all fulfillment stages.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list-check text-brand me-2"></i> All Customer Orders</h3>
        <span class="badge bg-light text-dark border"><?= count($orders ?? []) ?> Orders</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($orders)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-cart-shopping fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No orders placed yet</h5>
                <p class="small text-muted">When pet parents make purchases in the Pet Guard store, they will appear here.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Order Number</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Payment</th>
                            <th>Fulfillment Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $ord): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark font-monospace"><?= ViewHelper::e($ord['order_number']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($ord['shipping_city'] ?? 'Standard Delivery') ?></div>
                                </td>
                                <td class="small text-muted">
                                    <?= date('M d, Y · h:i A', strtotime($ord['created_at'])) ?>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$ord['total'], 2) ?>
                                </td>
                                <td>
                                    <?php if ($ord['payment_status'] === 'paid'): ?>
                                        <span class="admin-badge badge-success text-uppercase">Paid</span>
                                    <?php else: ?>
                                        <span class="admin-badge badge-amber text-uppercase"><?= ViewHelper::e($ord['payment_status']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $statusMap = [
                                        'pending' => 'badge-amber',
                                        'confirmed' => 'badge-blue',
                                        'processing' => 'badge-blue',
                                        'ready_to_ship' => 'badge-purple',
                                        'shipped' => 'badge-purple',
                                        'delivered' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        'refunded' => 'badge-danger'
                                    ];
                                    ?>
                                    <span class="admin-badge <?= $statusMap[$ord['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($ord['status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                        Fulfill Order
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
