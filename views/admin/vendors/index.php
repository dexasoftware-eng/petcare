<?php
use Helpers\ViewHelper;

$total = $stats['total'] ?? count($vendors);
$approved = $stats['approved'] ?? 0;
$pending = $stats['pending'] ?? 0;
$rejected = $stats['rejected'] ?? 0;
?>

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="page-title-group">
        <h2 class="admin-page-title">
            <i class="fa-solid fa-store text-info me-2"></i>
            Merchant Vendors & Verification
        </h2>
        <p class="admin-page-subtitle">
            Manage store merchants, business licenses, and ecommerce vendor queues.
        </p>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Vendors</span>
                <div class="stat-card-icon icon-info">
                    <i class="fa-solid fa-store"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($total) ?></div>
            <div class="stat-card-footer text-muted">
                Marketplace Merchants
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Approved & Active</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($approved) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-bag-shopping me-1"></i> Verified Stores
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Review</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($pending) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark">Application Queue</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Business Growth</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
            <div class="stat-card-value">100%</div>
            <div class="stat-card-footer text-muted">
                Order Fulfillment Rate
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar mb-4">
    <form action="<?= ViewHelper::url('admin/vendors') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="q" class="form-control rounded-pill px-3 ps-5" placeholder="Search store name, owner, or email..." value="<?= ViewHelper::e($search ?? '') ?>">
            </div>
        </div>
        <div style="min-width: 180px;">
            <select name="status" class="form-select rounded-pill px-3">
                <option value="">All Verifications</option>
                <option value="pending" <?= ($selectedStatus ?? '') === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                <option value="approved" <?= ($selectedStatus ?? '') === 'approved' ? 'selected' : '' ?>>Approved / Verified</option>
                <option value="rejected" <?= ($selectedStatus ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="suspended" <?= ($selectedStatus ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="font-size: 13.5px; background: #1e293b;">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>
        <a href="<?= ViewHelper::url('admin/vendors') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Vendors Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Store / Merchant</th>
                        <th>Owner / Contact</th>
                        <th>Business Phone</th>
                        <th>Store Status</th>
                        <th>Verification</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($vendors)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-store-slash fa-2x mb-2 d-block text-muted"></i>
                            No merchant vendors found matching your search.
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($vendors as $vn): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-info" style="width: 40px; height: 40px; min-width: 40px; background: #fff3ed; font-size: 14px;">
                                            <i class="fa-solid fa-store"></i>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url('admin/vendors/' . $vn['id']) ?>" class="fw-bold text-dark text-decoration-none" style="font-size: 14px;">
                                                <?= ViewHelper::e($vn['store_name'] ?? 'PetGuard Merchant') ?>
                                            </a>
                                            <small class="text-muted d-block" style="font-size: 12px;"><?= ViewHelper::e($vn['email'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($vn['name'] ?? 'Merchant') ?></div>
                                    <small class="text-muted">Id: #<?= ViewHelper::e($vn['user_id'] ?? '-') ?></small>
                                </td>
                                <td>
                                    <small class="text-dark fw-semibold"><?= ViewHelper::e($vn['phone'] ?? '—') ?></small>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $vn['store_status'] ?? 'active' ?>">
                                        <?= ucfirst(ViewHelper::e($vn['store_status'] ?? 'active')) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $vn['verification_status'] ?? 'pending' ?>">
                                        <?= ucfirst(ViewHelper::e($vn['verification_status'] ?? 'pending')) ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= ViewHelper::url('admin/vendors/' . $vn['id']) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                        <i class="fa-solid fa-store me-1 text-info"></i> Review
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
