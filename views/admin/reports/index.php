<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Reports & Platform Analytics</h2>
        <p class="admin-page-subtitle">Longitudinal user growth metrics, species demographics, and marketplace gross merchandise volume.</p>
    </div>
    <div>
        <button class="btn btn-sm btn-outline-dark rounded-pill px-3" onclick="window.print()">
            <i class="fa-solid fa-print me-1"></i> Print / Export Report
        </button>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- User Growth Trajectory -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-chart-line text-brand"></i> Monthly User Registrations</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead><tr><th>Month</th><th>New Registrations</th><th>Growth Ratio</th></tr></thead>
                        <tbody>
                            <?php foreach ($userGrowth as $growth): ?>
                                <tr>
                                    <td class="fw-bold"><?= ViewHelper::e($growth['month']) ?></td>
                                    <td><span class="badge bg-light text-dark border fs-6"><?= $growth['count'] ?> Users</span></td>
                                    <td><span class="text-success fw-bold"><i class="fa-solid fa-arrow-up me-1"></i> Positive Growth</span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pet Species Demographics -->
    <div class="col-lg-6">
        <div class="admin-card h-100">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-chart-pie text-purple"></i> Pet Species Breakdown</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead><tr><th>Species</th><th>Patient Count</th><th>Distribution</th></tr></thead>
                        <tbody>
                            <?php foreach ($petSpecies as $spec): ?>
                                <tr>
                                    <td class="fw-bold"><?= ViewHelper::e($spec['species']) ?></td>
                                    <td><?= $spec['count'] ?> Pets</td>
                                    <td>
                                        <div class="progress" style="height: 8px;">
                                            <div class="progress-bar bg-danger" style="width: <?= min(100, $spec['count'] * 15) ?>%;"></div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Marketplace Sales Aggregation -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-sack-dollar text-success"></i> Marketplace GMV & Revenue Performance</h3>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead><tr><th>Billing Month</th><th>Orders Count</th><th>Total Revenue</th><th>Status</th></tr></thead>
                <tbody>
                    <?php if (empty($orderSales)): ?>
                        <tr><td colspan="4" class="text-center p-4 text-muted">No sales cycles on record yet.</td></tr>
                    <?php else: ?>
                        <?php foreach ($orderSales as $sale): ?>
                            <tr>
                                <td class="fw-bold"><?= ViewHelper::e($sale['month']) ?></td>
                                <td><?= $sale['orders'] ?> Orders</td>
                                <td class="fw-bold fs-6 text-brand">$<?= number_format((float)($sale['revenue'] ?? 0), 2) ?></td>
                                <td><span class="badge-status status-active">Settled</span></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
