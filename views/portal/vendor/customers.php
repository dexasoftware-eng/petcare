<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-users text-brand me-2"></i> Verified Store Customers</h2>
        <p class="admin-page-subtitle">Pet parents and shelters who have purchased products from your store catalog.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-user-check text-brand me-2"></i> Customer Accounts</h3>
        <span class="badge bg-light text-dark border"><?= count($customers ?? []) ?> Customers</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($customers)): ?>
            <div class="p-5 text-center text-muted">No customers registered yet.</div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Customer Name</th>
                            <th>Contact Email</th>
                            <th>Phone</th>
                            <th>Orders Placed</th>
                            <th>Total Spent</th>
                            <th class="text-end pe-4">Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $c): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($c['name']) ?></div>
                                    <span class="badge bg-light text-muted border text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($c['role']) ?></span>
                                </td>
                                <td>
                                    <?= ViewHelper::e($c['email']) ?>
                                </td>
                                <td class="small text-muted">
                                    <?= ViewHelper::e($c['phone'] ?: 'N/A') ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1"><?= (int)$c['order_count'] ?> Orders</span>
                                </td>
                                <td class="fw-bold text-dark">
                                    $<?= number_format((float)$c['total_spent'], 2) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= ViewHelper::url('portal/messages?target=' . $c['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                        <i class="fa-solid fa-comments me-1"></i> Chat
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
