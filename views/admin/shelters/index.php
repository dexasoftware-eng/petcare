<?php
use Helpers\ViewHelper;

$total = $stats['total'] ?? count($shelters);
$approved = $stats['approved'] ?? 0;
$pending = $stats['pending'] ?? 0;
$adoptablePets = $stats['adoptablePets'] ?? 0;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-house-medical text-warning"></i>
            <span>Verified Sanctuaries Network</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($total) ?> Shelters</span>
        </div>
        <h2 class="portal-hero-title">Rescue Shelters &amp; Sanctuaries 🏡</h2>
        <p class="portal-hero-subtitle">
            Verified rescue facilities, holding capacities, and adoption program governance.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Command Center</span>
        </a>
        <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-heart"></i>
            <span>Adoptions Queue</span>
        </a>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Shelters</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-house-medical"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($total) ?></div>
            <div class="stat-card-footer text-muted">
                Rescue Organizations
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Approved & Active</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($approved) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-circle-check me-1"></i> Verified Facilities
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Verification</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($pending) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark">Requires Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Adoptable Pets</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($adoptablePets) ?></div>
            <div class="stat-card-footer text-muted">
                In Rescue Care
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar mb-4">
    <form action="<?= ViewHelper::url('admin/shelters') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="q" class="form-control rounded-pill px-3 ps-5" placeholder="Search sanctuary name, contact person, or location..." value="<?= ViewHelper::e($filters['q'] ?? '') ?>">
            </div>
        </div>
        <div style="min-width: 180px;">
            <select name="status" class="form-select rounded-pill px-3">
                <option value="">All Verifications</option>
                <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                <option value="approved" <?= ($filters['status'] ?? '') === 'approved' ? 'selected' : '' ?>>Approved / Verified</option>
                <option value="rejected" <?= ($filters['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="suspended" <?= ($filters['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="font-size: 13.5px; background: #1e293b;">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>
        <a href="<?= ViewHelper::url('admin/shelters') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Shelters Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sanctuary / Shelter</th>
                        <th>Contact Person</th>
                        <th>Holding Capacity</th>
                        <th>Location Address</th>
                        <th>Verification Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($shelters)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-house-medical fa-2x mb-2 d-block text-muted"></i>
                            No shelter organizations found matching your search.
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($shelters as $s): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-success" style="width: 40px; height: 40px; min-width: 40px; background: #dcfce7; font-size: 14px;">
                                            <i class="fa-solid fa-shield-cat"></i>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url('admin/shelters/' . $s['id']) ?>" class="fw-bold text-dark text-decoration-none" style="font-size: 14px;">
                                                <?= ViewHelper::e($s['shelter_name']) ?>
                                            </a>
                                            <small class="text-muted d-block" style="font-size: 12px;"><?= ViewHelper::e($s['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($s['name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($s['phone'] ?? '—') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                        <i class="fa-solid fa-paw text-brand me-1"></i> <?= ViewHelper::e($s['capacity'] ?? '50') ?> Animals
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted"><i class="fa-solid fa-location-dot me-1 text-danger"></i> <?= ViewHelper::e($s['address'] ?? '—') ?></small>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $s['verification_status'] ?? 'pending' ?>">
                                        <?= ucfirst(ViewHelper::e($s['verification_status'] ?? 'pending')) ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= ViewHelper::url('admin/shelters/' . $s['id']) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                        <i class="fa-solid fa-house-medical me-1 text-success"></i> Review
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
