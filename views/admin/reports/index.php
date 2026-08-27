<?php
use Helpers\ViewHelper;

$totalSales = $stats['totalSales'] ?? 0;
$totalUsers = $stats['totalUsers'] ?? 0;
$totalPets = $stats['totalPets'] ?? 0;
$totalAppointments = $stats['totalAppointments'] ?? 0;

$totalSpeciesCount = 0;
foreach ($petSpecies as $p) {
    $totalSpeciesCount += (int)($p['count'] ?? 0);
}
if ($totalSpeciesCount === 0) $totalSpeciesCount = 1;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-chart-pie text-warning"></i>
            <span>Executive Business Intelligence</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($totalUsers) ?> Users</span>
        </div>
        <h2 class="portal-hero-title">Reports &amp; Platform Analytics 📊</h2>
        <p class="portal-hero-subtitle">
            Longitudinal user growth metrics, species demographics, and marketplace gross merchandise volume.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Command Center</span>
        </a>
        <a href="<?= ViewHelper::url('admin/marketplace/orders') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-cart-shopping"></i>
            <span>Transactions</span>
        </a>
    </div>
</div>

<!-- 4 Top Analytics KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Marketplace GMV</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-sack-dollar"></i>
                </div>
            </div>
            <div class="stat-card-value text-success">$<?= number_format((float)$totalSales, 2) ?></div>
            <div class="stat-card-footer text-muted">
                Completed Store Orders
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Community</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalUsers) ?></div>
            <div class="stat-card-footer text-muted">
                Platform User Accounts
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Animal Passports</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalPets) ?></div>
            <div class="stat-card-footer text-muted">
                Registered In Registry
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Clinical Care</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalAppointments) ?></div>
            <div class="stat-card-footer text-muted">
                Consultations on Record
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- User Growth Trajectory -->
    <div class="col-lg-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-chart-line text-brand me-2"></i> Monthly User Registrations
                </h3>
                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small">Last 6 Months</span>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Registration Cycle</th>
                                <th>New Accounts</th>
                                <th style="text-align: right;">Growth Trajectory</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($userGrowth)): ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted">No monthly user registrations recorded.</td></tr>
                            <?php else: ?>
                                <?php foreach ($userGrowth as $growth): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark"><i class="fa-regular fa-calendar text-muted me-1"></i> <?= ViewHelper::e($growth['month']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border fs-6 px-3 py-1 rounded-pill">
                                                <strong><?= $growth['count'] ?></strong> Users
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
                                                <i class="fa-solid fa-arrow-trend-up me-1"></i> Positive Growth
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Species Demographics -->
    <div class="col-lg-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-shield-cat text-purple me-2"></i> Pet Species Demographics
                </h3>
                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small"><?= $totalPets ?> Total</span>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Species Family</th>
                                <th>Patient Count</th>
                                <th style="text-align: right;">Share Distribution</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($petSpecies)): ?>
                                <tr><td colspan="3" class="text-center py-4 text-muted">No pet records available for breakdown.</td></tr>
                            <?php else: ?>
                                <?php foreach ($petSpecies as $spec): ?>
                                    <?php
                                    $pct = round(((int)$spec['count'] / $totalSpeciesCount) * 100, 1);
                                    $iconClass = match(strtolower($spec['species'])) {
                                        'dog' => 'fa-dog text-brand',
                                        'cat' => 'fa-cat text-purple',
                                        'bird' => 'fa-dove text-info',
                                        default => 'fa-paw text-success'
                                    };
                                    $barClass = match(strtolower($spec['species'])) {
                                        'dog' => 'bg-danger',
                                        'cat' => 'bg-primary',
                                        'bird' => 'bg-info',
                                        default => 'bg-success'
                                    };
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark">
                                                <i class="fa-solid <?= $iconClass ?> me-2"></i> <?= ucfirst(ViewHelper::e($spec['species'])) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-semibold text-dark"><?= $spec['count'] ?> Registered Pets</span>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="d-inline-flex align-items-center gap-2" style="min-width: 140px; justify-content: flex-end;">
                                                <div class="progress flex-grow-1" style="height: 8px; width: 80px; border-radius: 4px; background: #e2e8f0;">
                                                    <div class="progress-bar <?= $barClass ?>" style="width: <?= $pct ?>%;"></div>
                                                </div>
                                                <span class="small fw-bold text-dark"><?= $pct ?>%</span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Marketplace Sales Aggregation -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-sack-dollar text-success me-2"></i> Marketplace GMV & Revenue Performance
        </h3>
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill fw-semibold">
            Merchant Ecosystem
        </span>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Billing Cycle Month</th>
                        <th>Completed Orders</th>
                        <th>Gross Revenue (GMV)</th>
                        <th>Platform Fee (15%)</th>
                        <th style="text-align: right;">Settlement Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($orderSales)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fa-solid fa-sack-dollar fa-2x mb-2 d-block text-muted"></i>
                                No marketplace sales cycles on record yet.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($orderSales as $sale): ?>
                            <?php
                            $rev = (float)($sale['revenue'] ?? 0);
                            $fee = $rev * 0.15;
                            ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark"><i class="fa-regular fa-calendar-check text-success me-1"></i> <?= ViewHelper::e($sale['month']) ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
                                        <?= $sale['orders'] ?> Orders
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-bold fs-6 text-brand">$<?= number_format($rev, 2) ?></span>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">$<?= number_format($fee, 2) ?></span>
                                </td>
                                <td style="text-align: right;">
                                    <span class="badge-status status-active">Settled</span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
