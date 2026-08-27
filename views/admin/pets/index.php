<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-shield-cat text-warning"></i>
            <span>Global Animal Identification</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($stats['total'] ?? count($pets)) ?> Companions</span>
        </div>
        <h2 class="portal-hero-title">Pets &amp; Digital Passport Registry 🐾</h2>
        <p class="portal-hero-subtitle">
            Centralized animal registry, dynamic QR digital passports, microchip identifiers, and lost alerts.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Command Center</span>
        </a>
        <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-heart"></i>
            <span>Rescue Animals</span>
        </a>
    </div>
</div>

<!-- 4 Top Metric KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Registered</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['total'] ?? count($pets)) ?></div>
            <div class="stat-card-footer text-muted">
                Pets in Database
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Active Passports</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['activePassports'] ?? 0) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-shield-check me-1"></i> QR Enabled
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">For Adoption</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['forAdoption'] ?? 0) ?></div>
            <div class="stat-card-footer text-muted">
                Sanctuary Listings
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Lost Pet Broadcasts</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['lostAlerts'] ?? 0) ?></div>
            <div class="stat-card-footer text-danger fw-bold">
                Active SOS Alerts
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/pets') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <input type="text" name="q" class="form-control rounded-pill px-3 ps-4" placeholder="Search pet name, breed, microchip, or owner..." value="<?= ViewHelper::e($filters['q'] ?? '') ?>">
        </div>
        <div style="min-width: 150px;">
            <select name="species" class="form-select rounded-pill px-3">
                <option value="">All Species</option>
                <option value="Dog" <?= ($filters['species'] ?? '') === 'Dog' ? 'selected' : '' ?>>Dogs</option>
                <option value="Cat" <?= ($filters['species'] ?? '') === 'Cat' ? 'selected' : '' ?>>Cats</option>
                <option value="Bird" <?= ($filters['species'] ?? '') === 'Bird' ? 'selected' : '' ?>>Birds</option>
                <option value="Other" <?= ($filters['species'] ?? '') === 'Other' ? 'selected' : '' ?>>Others</option>
            </select>
        </div>
        <div style="min-width: 160px;">
            <select name="status" class="form-select rounded-pill px-3">
                <option value="">Passport Status</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="lost" <?= ($filters['status'] ?? '') === 'lost' ? 'selected' : '' ?>>Lost Alert</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="font-size: 13.5px;">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>
        <a href="<?= ViewHelper::url('admin/pets') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Pets Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pet Profile</th>
                        <th>Breed & Species</th>
                        <th>Guardian / Owner</th>
                        <th>Microchip Tag</th>
                        <th>Passport Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pets)): ?>
                        <tr><td colspan="6" class="text-center py-4 text-muted">No pets found matching search criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pets as $pet): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php if (!empty($pet['avatar'])): ?>
                                            <img src="<?= ViewHelper::asset($pet['avatar']) ?>" class="rounded-circle border object-fit-cover" style="width: 40px; height: 40px; min-width: 40px;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                                        <?php else: ?>
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-brand fw-bold" style="width: 40px; height: 40px; min-width: 40px;">
                                                <i class="fa-solid fa-paw"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="fw-bold text-dark text-decoration-none">
                                                <?= ViewHelper::e($pet['name']) ?>
                                            </a>
                                            <small class="text-muted d-block"><?= ViewHelper::e($pet['gender']) ?> · <?= ViewHelper::e($pet['age']) ?> Yrs</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($pet['breed'] ?: 'Mixed Breed') ?></div>
                                    <small class="badge bg-light text-dark border px-2 py-0" style="font-size: 10.5px;"><?= ViewHelper::e($pet['species']) ?></small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($pet['owner_name'] ?? 'N/A') ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($pet['owner_email'] ?? '') ?></small>
                                </td>
                                <td>
                                    <code class="px-2 py-1 bg-light border rounded text-dark" style="font-size: 11px;"><?= ViewHelper::e($pet['microchip_id'] ?: 'UNTAGGED') ?></code>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $pet['passport_status'] ?>"><?= ucfirst(ViewHelper::e($pet['passport_status'])) ?></span>
                                </td>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="btn-admin-action">
                                        <i class="fa-solid fa-id-card text-primary"></i> Passport
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
