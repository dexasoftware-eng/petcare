<?php
use Helpers\ViewHelper;

$total = $stats['total'] ?? count($veterinarians);
$approved = $stats['approved'] ?? 0;
$pending = $stats['pending'] ?? 0;
$rejected = $stats['rejected'] ?? 0;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-doctor text-warning"></i>
            <span>Accredited Clinical Network</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($total) ?> Clinicians</span>
        </div>
        <h2 class="portal-hero-title">Veterinarians &amp; Licensing 🩺</h2>
        <p class="portal-hero-subtitle">
            Accredited veterinary clinicians, medical licensing credentials, and practice verifications.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Command Center</span>
        </a>
        <a href="<?= ViewHelper::url('admin/users') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-users-gear"></i>
            <span>All Users</span>
        </a>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Clinicians</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($total) ?></div>
            <div class="stat-card-footer text-muted">
                Registered Medical Network
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
                <i class="fa-solid fa-shield-check me-1"></i> Verified Licenses
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Approval</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-clock"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($pending) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark">Requires Verification</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Specialized Clinics</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-hospital"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($total) ?></div>
            <div class="stat-card-footer text-muted">
                Animal Medical Centers
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar mb-4">
    <form action="<?= ViewHelper::url('admin/veterinarians') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="q" class="form-control rounded-pill px-3 ps-5" placeholder="Search doctor name, clinic, or specialization..." value="<?= ViewHelper::e($filters['q'] ?? '') ?>">
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
        <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Veterinarians Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Doctor / Practitioner</th>
                        <th>Clinic Name</th>
                        <th>Specialization</th>
                        <th>Experience</th>
                        <th>Verification Status</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($veterinarians)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-user-doctor fa-2x mb-2 d-block text-muted"></i>
                            No veterinarian records found matching your search.
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($veterinarians as $v): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 40px; height: 40px; min-width: 40px; background: #e0f2fe; font-size: 14px;">
                                            <i class="fa-solid fa-user-doctor"></i>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url('admin/veterinarians/' . $v['id']) ?>" class="fw-bold text-dark text-decoration-none" style="font-size: 14px;">
                                                <?= ViewHelper::e($v['name']) ?>
                                            </a>
                                            <small class="text-muted d-block" style="font-size: 12px;"><?= ViewHelper::e($v['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($v['clinic_name'] ?? 'Central Veterinary Clinic') ?></div>
                                    <small class="text-muted">Lic: <?= ViewHelper::e($v['license_number'] ?? 'VET2026') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                        <?= ViewHelper::e($v['specialization'] ?? 'General Veterinary') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= ViewHelper::e($v['experience'] ?? '5') ?> Years</span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $v['verification_status'] ?? 'pending' ?>">
                                        <?= ucfirst(ViewHelper::e($v['verification_status'] ?? 'pending')) ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= ViewHelper::url('admin/veterinarians/' . $v['id']) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                        <i class="fa-solid fa-user-doctor me-1 text-primary"></i> Review
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
