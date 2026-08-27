<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-cart-shopping text-warning me-2"></i> Marketplace Customer Orders</h2>
        <p class="admin-page-subtitle">Platform customer purchases, Stripe checkout transactions, payment statuses, and fulfillment tracking.</p>
    </div>
</div>

<!-- 4 Top Metric KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Orders</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(count($orders ?? [])) ?></div>
            <div class="stat-card-footer text-muted">
                Lifetime Orders
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Paid Transactions</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(\Models\Order::count("payment_status = 'paid'")) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-shield-check me-1"></i> Verified Payments
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Payments</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(\Models\Order::count("payment_status = 'pending'")) ?></div>
            <div class="stat-card-footer text-muted">
                Awaiting Checkout
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Fulfillment Processing</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-truck-fast"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format(\Models\Order::count("status = 'processing' OR status = 'pending'")) ?></div>
            <div class="stat-card-footer text-muted">
                In Dispatch Pipeline
            </div>
        </div>
    </div>
</div>

<!-- Orders Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order Ref</th>
                        <th>Customer / Buyer</th>
                        <th>Order Total</th>
                        <th>Payment Status</th>
                        <th>Fulfillment</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No marketplace customer orders recorded yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                            <tr>
                                <td>
                                    <span class="fw-bold text-dark font-monospace">#<?= ViewHelper::e($o['order_number'] ?? $o['id']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($o['customer_name'] ?? $o['name'] ?? 'Guest Customer') ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($o['customer_email'] ?? $o['email'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark">$<?= number_format($o['total'], 2) ?></span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= ($o['payment_status'] ?? 'pending') === 'paid' ? 'active' : 'pending' ?>">
                                        <?= strtoupper($o['payment_status'] ?? 'pending') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px;">
                                        <i class="fa-solid fa-truck me-1 text-muted"></i> <?= ucfirst(ViewHelper::e($o['status'] ?? 'processing')) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted"><?= date('M d, Y · H:i', strtotime($o['created_at'])) ?></small>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
