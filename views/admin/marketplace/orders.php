<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Customer Orders</h2>
        <p class="admin-page-subtitle">Marketplace fulfillment pipeline, checkout histories, and shipment tracking.</p>
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
                        <th>Customer</th>
                        <th>Amount</th>
                        <th>Payment Status</th>
                        <th>Fulfillment Status</th>
                        <th>Placed On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orders)): ?>
                        <tr><td colspan="7" class="text-center p-4 text-muted">No marketplace orders placed yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orders as $o): ?>
                            <tr>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/marketplace/orders/{$o['id']}") ?>" class="fw-bold text-dark text-decoration-none hover-underline font-monospace">
                                        #<?= ViewHelper::e($o['order_number']) ?>
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e(trim(($o['first_name'] ?? '') . ' ' . ($o['last_name'] ?? '')) ?: 'Customer') ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($o['email'] ?? '') ?></small>
                                </td>
                                <td class="fw-bold text-dark">$<?= number_format((float)($o['total'] ?? 0), 2) ?></td>
                                <td>
                                    <span class="badge bg-light text-dark border text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($o['payment_status'] ?? 'paid') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $o['status'] ?>"><?= ViewHelper::e($o['status']) ?></span>
                                </td>
                                <td><small class="text-muted"><?= date('M d, Y H:i', strtotime($o['created_at'])) ?></small></td>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/marketplace/orders/{$o['id']}") ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
