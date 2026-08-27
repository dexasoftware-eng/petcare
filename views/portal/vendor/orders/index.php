<?php
use Helpers\ViewHelper;

$orders = $orders ?? [];
$totalOrders = count($orders);
$paidOrders = 0;
$pendingOrders = 0;
$grossSales = 0.0;

foreach ($orders as $ord) {
    $total = (float)($ord['total'] ?? 0);
    $grossSales += $total;
    if (($ord['payment_status'] ?? '') === 'paid') {
        $paidOrders++;
    }
    if (in_array($ord['status'] ?? '', ['pending', 'received', 'processing', 'confirmed'])) {
        $pendingOrders++;
    }
}
?>

<style>
/* 5-Screen Breakpoints for Orders */
@media (max-width: 767.98px) {
    .orders-desktop-table { display: none !important; }
    .orders-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .orders-desktop-table { display: block !important; }
    .orders-mobile-grid { display: none !important; }
}
</style>

<div class="vendor-orders-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-truck-fast text-warning"></i> Merchant Fulfillment Hub
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Orders &amp; Shipping Pipeline
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Track customer purchases, review 256-bit verified Stripe authorizations, print invoices, and update live package fulfillment milestones.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('vendor/reports') ?>" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Sales Analytics</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Orders</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalOrders ?></div>
                <small class="text-muted" style="font-size: 11px;">Customer Transactions</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Paid via Stripe</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-brands fa-stripe"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $paidOrders ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Authorized Settlements</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Pending Fulfillment</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dolly"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $pendingOrders > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $pendingOrders ?></div>
                <small class="text-muted" style="font-size: 11px;">Awaiting Dispatch</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Gross Volume</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($grossSales, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Total Store Sales</small>
            </div>
        </div>
    </div>

    <!-- 3. Orders Content Container -->
    <?php if (empty($orders)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <h5 class="fw-bold text-dark">No Orders Placed Yet</h5>
            <p class="small text-muted mb-3" style="max-width: 480px; margin: 0 auto;">When pet parents purchase your products in the online shop, their orders and shipping details will appear here.</p>
            <a href="<?= ViewHelper::url('our-products') ?>" target="_blank" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-store me-1"></i> Visit Public Shop
            </a>
        </div>
    <?php else: ?>

        <!-- A. Desktop Data Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden orders-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Recent Order Shipments (<?= $totalOrders ?> Orders)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Stripe Verified</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 200px;">Order Number</th>
                            <th class="py-3" style="min-width: 170px;">Customer &amp; City</th>
                            <th class="py-3" style="min-width: 150px;">Order Date</th>
                            <th class="py-3" style="min-width: 110px;">Total Amount</th>
                            <th class="py-3" style="min-width: 120px;">Payment</th>
                            <th class="py-3" style="min-width: 140px;">Fulfillment Stage</th>
                            <th class="text-end pe-4 py-3" style="min-width: 130px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $ord): 
                            $statusMap = [
                                'pending' => 'bg-warning-subtle text-warning border-warning-subtle',
                                'received' => 'bg-info-subtle text-info border-info-subtle',
                                'confirmed' => 'bg-primary-subtle text-primary border-primary-subtle',
                                'processing' => 'bg-primary-subtle text-primary border-primary-subtle',
                                'ready_to_ship' => 'bg-purple-subtle text-purple border-purple-subtle',
                                'shipped' => 'bg-purple-subtle text-purple border-purple-subtle',
                                'delivered' => 'bg-success-subtle text-success border-success-subtle',
                                'cancelled' => 'bg-danger-subtle text-danger border-danger-subtle',
                                'refunded' => 'bg-danger-subtle text-danger border-danger-subtle'
                            ];
                        ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="fw-bold text-dark font-monospace text-decoration-none hover-brand" style="font-size: 14px;">
                                        #<?= ViewHelper::e($ord['order_number']) ?>
                                    </a>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($ord['first_name'] . ' ' . $ord['last_name']) ?></div>
                                    <small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i><?= ViewHelper::e($ord['city'] ?? 'Standard Delivery') ?></small>
                                </td>
                                <td class="text-muted small">
                                    <?= date('M d, Y · h:i A', strtotime($ord['created_at'])) ?>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$ord['total'], 2) ?>
                                </td>
                                <td>
                                    <?php if ($ord['payment_status'] === 'paid'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-circle-check me-1"></i> Paid (Stripe)
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-clock me-1"></i> <?= strtoupper(ViewHelper::e($ord['payment_status'])) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge <?= $statusMap[$ord['status']] ?? 'bg-light text-dark border' ?> rounded-pill px-3 py-1 text-uppercase fw-bold" style="font-size: 10.5px;">
                                        <?= str_replace('_', ' ', ViewHelper::e($ord['status'])) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                                        <span>Fulfill</span>
                                        <i class="fa-solid fa-arrow-right" style="font-size: 11px;"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile & Tablet Cards (<768px) -->
        <div class="row g-3 orders-mobile-grid mb-4">
            <?php foreach ($orders as $ord): 
                $statusBadgeClass = ($ord['status'] === 'delivered') ? 'bg-success-subtle text-success border-success-subtle' : (in_array($ord['status'], ['cancelled', 'refunded']) ? 'bg-danger-subtle text-danger border-danger-subtle' : 'bg-primary-subtle text-primary border-primary-subtle');
            ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <!-- Header Strip -->
                            <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                                <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="fw-bold text-dark font-monospace text-decoration-none" style="font-size: 14.5px;">
                                    #<?= ViewHelper::e($ord['order_number']) ?>
                                </a>
                                <span class="badge <?= $statusBadgeClass ?> rounded-pill px-2 py-1 text-uppercase fw-bold" style="font-size: 10px;">
                                    <?= str_replace('_', ' ', ViewHelper::e($ord['status'])) ?>
                                </span>
                            </div>

                            <!-- Customer & Date -->
                            <div class="mb-2">
                                <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($ord['first_name'] . ' ' . $ord['last_name']) ?></div>
                                <div class="text-muted small" style="font-size: 11.5px;">
                                    <i class="fa-solid fa-location-dot text-brand me-1"></i><?= ViewHelper::e($ord['city'] ?? 'Delivery Address') ?>
                                </div>
                                <div class="text-muted small mt-1" style="font-size: 11px;">
                                    <i class="fa-regular fa-clock me-1"></i><?= date('M d, Y · h:i A', strtotime($ord['created_at'])) ?>
                                </div>
                            </div>

                            <!-- Financial Strip -->
                            <div class="p-2 px-3 bg-light rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark fs-6">$<?= number_format((float)$ord['total'], 2) ?></span>
                                <div>
                                    <?php if ($ord['payment_status'] === 'paid'): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-0 fw-bold" style="font-size: 9.5px;">Paid (Stripe)</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2 py-0 fw-bold" style="font-size: 9.5px;"><?= strtoupper(ViewHelper::e($ord['payment_status'])) ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="pt-2 border-top">
                            <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="btn btn-sm btn-admin-primary rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" style="font-size: 12.5px;">
                                <i class="fa-solid fa-truck-ramp-box"></i>
                                <span>Fulfill &amp; Print Invoice</span>
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
