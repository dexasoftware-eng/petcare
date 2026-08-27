<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-heart text-danger me-2"></i> Adoption Applications & Placement Hub</h2>
        <p class="admin-page-subtitle">Multi-tier adoption screening, background validations, shelter coordination, and pet placement reviews.</p>
    </div>
</div>

<!-- 4 Top Metric KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Applications</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['total'] ?? count($applications)) ?></div>
            <div class="stat-card-footer text-muted">
                Submitted to Date
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Review</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-hourglass-half"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['pending'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark">Awaiting Triage</span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Approved Matches</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['approved'] ?? 0) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-house-chimney-heart me-1"></i> Fostered / Placed
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Rejected / Cancelled</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-ban"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['rejected'] ?? 0) ?></div>
            <div class="stat-card-footer text-muted">
                Declined Filings
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/adoption') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <input type="text" name="q" class="form-control rounded-pill px-3 ps-4" placeholder="Search applicant, pet, or shelter name..." value="<?= ViewHelper::e($filters['q'] ?? '') ?>">
        </div>
        <div style="min-width: 180px;">
            <select name="status" class="form-select rounded-pill px-3">
                <option value="">All Application Statuses</option>
                <option value="submitted" <?= ($filters['status'] ?? '') === 'submitted' ? 'selected' : '' ?>>Submitted</option>
                <option value="under_review" <?= ($filters['status'] ?? '') === 'under_review' ? 'selected' : '' ?>>Under Review</option>
                <option value="approved" <?= ($filters['status'] ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
                <option value="rejected" <?= ($filters['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="font-size: 13.5px;">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>
        <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Applications Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Applicant</th>
                        <th>Adoptable Pet</th>
                        <th>Managing Shelter</th>
                        <th>Applied Date</th>
                        <th>Triage Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($applications)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No adoption applications found matching search criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($applications as $app): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-danger" style="width: 40px; height: 40px; min-width: 40px;">
                                            <?= strtoupper(substr($app['applicant_name'] ?? 'U', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url("admin/adoption/{$app['id']}") ?>" class="fw-bold text-dark text-decoration-none">
                                                <?= ViewHelper::e($app['applicant_name'] ?? 'Applicant') ?>
                                            </a>
                                            <small class="text-muted d-block"><?= ViewHelper::e($app['applicant_email'] ?? '') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><i class="fa-solid fa-paw text-brand me-1"></i> <?= ViewHelper::e($app['pet_name'] ?? 'Pet') ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($app['breed'] ?? '') ?> (<?= ViewHelper::e($app['species'] ?? 'Pet') ?>)</small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($app['shelter_name'] ?? 'Hope Sanctuary') ?></div>
                                </td>
                                <td><small class="text-muted"><?= date('M d, Y', strtotime($app['created_at'])) ?></small></td>
                                <td>
                                    <span class="badge-status status-<?= $app['status'] ?? 'submitted' ?>"><?= strtoupper(str_replace('_', ' ', $app['status'] ?? 'submitted')) ?></span>
                                </td>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/adoption/{$app['id']}") ?>" class="btn-admin-action">
                                        <i class="fa-solid fa-file-signature text-warning"></i> Review Application
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
