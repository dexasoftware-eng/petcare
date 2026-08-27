<?php
use Helpers\ViewHelper;

$salesByMonth = $salesByMonth ?? [];
$totalRevenue = 0.0;
$totalOrders = 0;
$monthsCount = count($salesByMonth);

foreach ($salesByMonth as $sm) {
    $totalRevenue += (float)($sm['revenue'] ?? 0);
    $totalOrders += (int)($sm['count'] ?? 0);
}

$monthlyAvg = $monthsCount > 0 ? ($totalRevenue / $monthsCount) : $totalRevenue;
?>

<style>
/* 5-Screen Breakpoints for Reports */
@media (max-width: 767.98px) {
    .reports-desktop-table { display: none !important; }
    .reports-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .reports-desktop-table { display: block !important; }
    .reports-mobile-grid { display: none !important; }
}
</style>

<div class="vendor-reports-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-chart-pie text-warning"></i> Commercial Financial Analytics
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Sales &amp; Revenue Analytics
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Track monthly sales velocity, review gross and net sales breakdowns, and monitor automatic daily Stripe merchant payout settlements.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('vendor/orders') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-truck-fast"></i>
                    <span>Manage Orders</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Financial Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Gross Revenue</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0">$<?= number_format($totalRevenue, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Total Store Sales</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Orders</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalOrders ?></div>
                <small class="text-muted" style="font-size: 11px;">Billed Transactions</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Monthly Run Rate</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($monthlyAvg, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Avg Revenue / Month</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Payout Status</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-brands fa-stripe"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-primary mb-0">Active</div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Daily Auto-Settlement</small>
            </div>
        </div>
    </div>

    <!-- 3. Financial Content Grid -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Monthly Revenue Table (col-lg-8) -->
        <div class="col-12 col-lg-8">
            
            <!-- Desktop View Table (>=768px) -->
            <div class="admin-card shadow-sm border overflow-hidden reports-desktop-table rounded-4 bg-white">
                <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <h6 class="fw-bold text-dark m-0">Monthly Billing Breakdown</h6>
                    </div>
                    <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Reconciled</span>
                </div>

                <div class="table-responsive m-0">
                    <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                        <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <tr>
                                <th class="ps-4 py-3" style="min-width: 220px;">Billing Period</th>
                                <th class="py-3" style="min-width: 150px;">Orders Volume</th>
                                <th class="py-3" style="min-width: 140px;">Settlement</th>
                                <th class="text-end pe-4 py-3" style="min-width: 160px;">Net Revenue ($)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($salesByMonth)): ?>
                                <tr>
                                    <td colspan="4" class="p-5 text-center text-muted">
                                        <i class="fa-solid fa-receipt fa-2x mb-2 text-muted"></i>
                                        <div class="fw-bold">No sales logged yet.</div>
                                        <small>Completed store transactions will generate monthly statements automatically.</small>
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($salesByMonth as $sm): ?>
                                    <tr>
                                        <td class="ps-4 py-3">
                                            <div class="fw-bold text-dark" style="font-size: 14px;">
                                                <i class="fa-regular fa-calendar-check text-brand me-2"></i>
                                                <?= date('F Y', strtotime($sm['month'] . '-01')) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-bold">
                                                <?= (int)$sm['count'] ?> Orders
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">
                                                <i class="fa-solid fa-circle-check me-1"></i> Transferred
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 py-3 fw-bold text-success fs-6">
                                            $<?= number_format((float)$sm['revenue'], 2) ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile & Tablet Card Grid (<768px) -->
            <div class="row g-3 reports-mobile-grid">
                <?php if (empty($salesByMonth)): ?>
                    <div class="col-12">
                        <div class="admin-card p-4 text-center text-muted bg-white rounded-4 border">
                            No monthly sales records yet.
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($salesByMonth as $sm): ?>
                        <div class="col-12">
                            <div class="admin-card p-3 rounded-4 border shadow-sm bg-white">
                                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                    <span class="fw-bold text-dark" style="font-size: 14.5px;">
                                        <i class="fa-regular fa-calendar-check text-brand me-1"></i>
                                        <?= date('F Y', strtotime($sm['month'] . '-01')) ?>
                                    </span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0 fw-bold" style="font-size: 9.5px;">Transferred</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-light text-dark border px-2 py-1"><?= (int)$sm['count'] ?> Orders</span>
                                    <span class="fw-bold text-success fs-5">$<?= number_format((float)$sm['revenue'], 2) ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

        </div>

        <!-- Right: Instant Payouts & Stripe Reconciliation (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card text-center p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-success fw-bold shadow-sm" style="width: 76px; height: 76px; background: #ecfdf5; font-size: 32px;">
                    <i class="fa-solid fa-vault"></i>
                </div>
                <h5 class="fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">
                    Direct Merchant Settlement
                </h5>
                <p class="text-muted small mb-3" style="line-height: 1.6; font-size: 12.5px;">
                    All credit and debit card payments collected through the marketplace are automatically reconciled and batched for daily merchant deposit.
                </p>
                <div class="p-3 bg-light rounded-3 border text-start small mb-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Settlement Schedule:</span>
                        <strong class="text-dark">Daily 00:00 UTC</strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Processing Gateway:</span>
                        <strong class="text-primary"><i class="fa-brands fa-stripe me-1"></i> Stripe Connect</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Transfer Status:</span>
                        <strong class="text-success"><i class="fa-solid fa-circle-check me-1"></i> Active &amp; Verified</strong>
                    </div>
                </div>
            </div>

            <!-- Tax & Invoicing Summary -->
            <div class="p-4 rounded-4 bg-white border shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold small">
                    <i class="fa-solid fa-file-invoice-dollar text-brand fs-5"></i>
                    <span>Year-End Tax &amp; Invoices</span>
                </div>
                <p class="text-muted small m-0" style="font-size: 12px; line-height: 1.6;">
                    Consolidated 1099-K commercial sales documentation and itemized VAT summaries are generated automatically for fiscal year auditing.
                </p>
            </div>
        </div>

    </div>

</div>
