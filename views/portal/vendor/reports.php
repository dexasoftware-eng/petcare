<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-chart-line text-brand me-2"></i> Sales & Revenue Analytics</h2>
        <p class="admin-page-subtitle">Monthly sales breakdown and commercial performance metrics.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-calendar-days text-brand me-2"></i> Monthly Revenue Performance</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="table-responsive m-0">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-4">Billing Period</th>
                                <th>Total Orders</th>
                                <th class="text-end pe-4">Net Revenue ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($salesByMonth)): ?>
                                <tr><td colspan="3" class="p-4 text-center text-muted">No sales logged yet.</td></tr>
                            <?php else: ?>
                                <?php foreach ($salesByMonth as $sm): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark"><?= date('F Y', strtotime($sm['month'] . '-01')) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= (int)$sm['count'] ?> Orders</span></td>
                                        <td class="text-end pe-4 fw-bold text-success fs-6">$<?= number_format((float)$sm['revenue'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <div class="avatar-circle mx-auto mb-3 bg-success-subtle text-success fw-bold d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; font-size: 28px; border-radius: 50%;">
                <i class="fa-solid fa-sack-dollar"></i>
            </div>
            <h5 class="fw-bold mb-1">Instant Payouts</h5>
            <p class="text-muted small mb-3">Merchant payouts are directly reconciled and settled automatically via integrated gateway.</p>
            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill font-monospace">Next Payout: Daily 00:00 UTC</span>
        </div>
    </div>
</div>
