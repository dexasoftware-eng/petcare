<?php
use Helpers\ViewHelper;

$customers = $customers ?? [];
$totalCustomers = count($customers);
$totalOrders = 0;
$totalSpent = 0.0;

foreach ($customers as $c) {
    $totalOrders += (int)($c['order_count'] ?? 0);
    $totalSpent += (float)($c['total_spent'] ?? 0);
}

$aov = $totalOrders > 0 ? ($totalSpent / $totalOrders) : 0.0;
?>

<style>
/* 5-Screen Breakpoints for Customers */
@media (max-width: 767.98px) {
    .customers-desktop-table { display: none !important; }
    .customers-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .customers-desktop-table { display: block !important; }
    .customers-mobile-grid { display: none !important; }
}
</style>

<div class="vendor-customers-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-users text-warning"></i>
                <span>Customer Relationship Hub</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= $totalCustomers ?> Clients</span>
            </div>
            <h2 class="portal-hero-title">Verified Store Customers 👥</h2>
            <p class="portal-hero-subtitle">
                View client purchase histories, lifetime transaction volumes, and provide instant customer support.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('vendor/dashboard') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Vendor Portal</span>
            </a>
            <a href="<?= ViewHelper::url('portal/messages') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-comments"></i>
                <span>Message Center</span>
            </a>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Clients</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalCustomers ?></div>
                <small class="text-muted" style="font-size: 11px;">Registered Pet Parents</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Orders Fulfilled</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $totalOrders ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Store Transactions</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Cumulative Spend</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($totalSpent, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Customer Revenue</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Avg Order Value</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($aov, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Average Ticket Size</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Customers Content -->
    <?php if (empty($customers)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-solid fa-users"></i>
            </div>
            <h5 class="fw-bold text-dark">No Customers Registered Yet</h5>
            <p class="small text-muted mb-3" style="max-width: 480px; margin: 0 auto;">Customer accounts and lifetime purchase summaries will automatically populate here as orders are placed.</p>
        </div>
    <?php else: ?>

        <!-- A. Desktop Data Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden customers-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Customer Directory (<?= $totalCustomers ?> Accounts)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Verified Accounts</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 250px;">Customer Profile</th>
                            <th class="py-3" style="min-width: 200px;">Contact Email</th>
                            <th class="py-3" style="min-width: 150px;">Phone Number</th>
                            <th class="py-3" style="min-width: 130px;">Orders Placed</th>
                            <th class="py-3" style="min-width: 130px;">Total Spent</th>
                            <th class="text-end pe-4 py-3" style="min-width: 130px;">Support</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($customers as $c): ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                            <?= strtoupper(substr($c['name'] ?? 'U', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($c['name']) ?></div>
                                            <span class="badge bg-light text-secondary border rounded-pill px-2 py-0 text-uppercase" style="font-size: 9.5px;"><?= ViewHelper::e($c['role'] ?? 'owner') ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="mailto:<?= ViewHelper::e($c['email']) ?>" class="text-muted text-decoration-none hover-brand">
                                        <?= ViewHelper::e($c['email']) ?>
                                    </a>
                                </td>
                                <td class="text-muted font-monospace small">
                                    <?= ViewHelper::e($c['phone'] ?: 'N/A') ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-bold">
                                        <?= (int)$c['order_count'] ?> Orders
                                    </span>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$c['total_spent'], 2) ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <a href="<?= ViewHelper::url('portal/messages?target=' . $c['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                                        <i class="fa-solid fa-comments"></i>
                                        <span>Chat</span>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile & Tablet Card Grid (<768px) -->
        <div class="row g-3 customers-mobile-grid mb-4">
            <?php foreach ($customers as $c): ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 48px; height: 48px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 18px;">
                                    <?= strtoupper(substr($c['name'] ?? 'U', 0, 1)) ?>
                                </div>
                                <div class="min-w-0 flex-grow-1">
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 15px;"><?= ViewHelper::e($c['name']) ?></div>
                                    <span class="badge bg-light text-secondary border rounded-pill px-2 py-0 text-uppercase" style="font-size: 9.5px;"><?= ViewHelper::e($c['role'] ?? 'owner') ?></span>
                                </div>
                            </div>

                            <div class="mb-2 small">
                                <div class="text-muted mb-1 text-truncate">
                                    <i class="fa-regular fa-envelope me-1 text-brand"></i><?= ViewHelper::e($c['email']) ?>
                                </div>
                                <div class="text-muted font-monospace">
                                    <i class="fa-solid fa-phone me-1 text-brand"></i><?= ViewHelper::e($c['phone'] ?: 'No phone provided') ?>
                                </div>
                            </div>

                            <div class="p-2 px-3 bg-light rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                <span class="badge bg-white text-dark border px-2 py-1"><?= (int)$c['order_count'] ?> Orders</span>
                                <span class="fw-bold text-dark fs-6">$<?= number_format((float)$c['total_spent'], 2) ?></span>
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="pt-2 border-top">
                            <a href="<?= ViewHelper::url('portal/messages?target=' . $c['id']) ?>" class="btn btn-sm btn-admin-primary rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-solid fa-comments"></i>
                                <span>Start Telehealth Chat</span>
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
