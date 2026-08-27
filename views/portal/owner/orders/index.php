<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-bag-shopping text-warning"></i>
            <span>Marketplace Order History</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= count($orders ?? []) ?> Orders</span>
        </div>
        <h2 class="portal-hero-title">My Store Orders 🛍️</h2>
        <p class="portal-hero-subtitle">Track your marketplace purchases, nutritional formulas, wellness supplements, and receipts.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-shop"></i>
            <span>Browse Pet Store</span>
        </a>
    </div>
</div>

<!-- Orders Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Order Date</th>
                        <th>Items Count</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr>
                            <td colspan="6" class="text-center p-5 text-muted">
                                <i class="fa-solid fa-box-open fs-1 text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No store orders yet</h5>
                                <p class="small mb-3">Discover premium nutritional formulas, wellness supplements, toys, and grooming gear.</p>
                                <a href="<?= ViewHelper::url('our-products') ?>" class="btn-admin-primary">Explore Store Catalog</a>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td class="fw-bold font-monospace text-brand">#<?= $order['id'] ?></td>
                                <td><?= date('M d, Y', strtotime($order['created_at'])) ?></td>
                                <td><span class="badge bg-light text-dark border"><?= $order['item_count'] ?? 1 ?> Items</span></td>
                                <td class="fw-bold text-dark fs-6">$<?= number_format((float)($order['total_amount'] ?? 0), 2) ?></td>
                                <td><span class="badge bg-success-subtle text-success border text-uppercase" style="font-size: 11px;">Paid</span></td>
                                <td>
                                    <?php
                                        $statusClass = match(strtolower($order['order_status'] ?? 'delivered')) {
                                            'delivered', 'completed' => 'status-active',
                                            'pending', 'processing' => 'status-pending',
                                            default => 'status-active'
                                        };
                                    ?>
                                    <span class="badge-status <?= $statusClass ?>"><?= ucfirst($order['order_status'] ?? 'Delivered') ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
