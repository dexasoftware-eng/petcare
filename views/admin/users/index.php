<?php
use Helpers\ViewHelper;

$total = $stats['total'] ?? count($users);
$owners = $stats['owners'] ?? 0;
$vets = $stats['vets'] ?? 0;
$shelters = $stats['shelters'] ?? 0;
$vendors = $stats['vendors'] ?? 0;
$active = $stats['active'] ?? 0;
$pending = $stats['pending'] ?? 0;
?>

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="page-title-group">
        <h2 class="admin-page-title">
            <i class="fa-solid fa-users-gear text-danger me-2"></i>
            User Governance & Directory
        </h2>
        <p class="admin-page-subtitle">
            Centralized governance directory of pet owners, veterinarians, rescue shelters, and store vendors.
        </p>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Accounts</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($total) ?></div>
            <div class="stat-card-footer">
                <span class="text-success fw-bold"><i class="fa-solid fa-circle-check me-1"></i> <?= $active ?> Active</span>
                <span class="text-muted ms-1">on platform</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pet Owners</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($owners) ?></div>
            <div class="stat-card-footer text-muted">
                <i class="fa-solid fa-house-chimney-user me-1 text-primary"></i> Registered Pet Parents
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Clinical Vets</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($vets) ?></div>
            <div class="stat-card-footer text-muted">
                <i class="fa-solid fa-stethoscope me-1 text-purple"></i> Licensed Practitioners
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Shelters & Vendors</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-house-medical"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($shelters + $vendors) ?></div>
            <div class="stat-card-footer text-muted">
                <span class="text-success fw-bold"><?= $shelters ?> Shelters</span> | <span class="text-info fw-bold"><?= $vendors ?> Stores</span>
            </div>
        </div>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar mb-4">
    <form action="<?= ViewHelper::url('admin/users') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 240px;">
            <div class="position-relative">
                <i class="fa-solid fa-magnifying-glass position-absolute text-muted" style="left: 14px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="q" class="form-control rounded-pill px-3 ps-5" placeholder="Search name, email, or phone number..." value="<?= ViewHelper::e($filters['q'] ?? '') ?>">
            </div>
        </div>
        <div style="min-width: 160px;">
            <select name="role" class="form-select rounded-pill px-3">
                <option value="">All Roles</option>
                <option value="petowner" <?= ($filters['role'] ?? '') === 'petowner' ? 'selected' : '' ?>>Pet Owners</option>
                <option value="veterinarian" <?= ($filters['role'] ?? '') === 'veterinarian' ? 'selected' : '' ?>>Veterinarians</option>
                <option value="shelter" <?= ($filters['role'] ?? '') === 'shelter' ? 'selected' : '' ?>>Rescue Shelters</option>
                <option value="vendor" <?= ($filters['role'] ?? '') === 'vendor' ? 'selected' : '' ?>>Store Vendors</option>
                <option value="admin" <?= ($filters['role'] ?? '') === 'admin' ? 'selected' : '' ?>>Administrators</option>
            </select>
        </div>
        <div style="min-width: 150px;">
            <select name="status" class="form-select rounded-pill px-3">
                <option value="">All Statuses</option>
                <option value="active" <?= ($filters['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="pending" <?= ($filters['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="suspended" <?= ($filters['status'] ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                <option value="disabled" <?= ($filters['status'] ?? '') === 'disabled' ? 'selected' : '' ?>>Disabled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="font-size: 13.5px; background: #1e293b;">
            <i class="fa-solid fa-filter me-1"></i> Filter
        </button>
        <a href="<?= ViewHelper::url('admin/users') ?>" class="btn btn-light border rounded-pill px-3 fw-semibold text-muted" style="font-size: 13.5px;">Reset</a>
    </form>
</div>

<!-- Users Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>User Profile</th>
                        <th>Platform Role</th>
                        <th>Account Status</th>
                        <th>Contact Phone</th>
                        <th>Joined Date</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)): ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-users-slash fa-2x mb-2 d-block text-muted"></i>
                            No users found matching your search criteria.
                        </td></tr>
                    <?php else: ?>
                        <?php foreach ($users as $u): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php
                                        $avatarBack = match($u['role']) {
                                            'admin' => 'background: #feeeee; color: #df1131;',
                                            'veterinarian' => 'background: #e0f2fe; color: #0284c7;',
                                            'shelter' => 'background: #dcfce7; color: #15803d;',
                                            'vendor' => 'background: #fff3ed; color: #d97706;',
                                            default => 'background: #feeae5; color: #fa441d;',
                                        };
                                        ?>
                                        <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 40px; height: 40px; min-width: 40px; font-size: 14px; <?= $avatarBack ?>">
                                            <?= strtoupper(substr($u['name'], 0, 1)) ?>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url('admin/users/' . $u['id']) ?>" class="fw-bold text-dark text-decoration-none" style="font-size: 14px;">
                                                <?= ViewHelper::e($u['name']) ?>
                                            </a>
                                            <small class="text-muted d-block" style="font-size: 12px;"><?= ViewHelper::e($u['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    $roleBadge = match($u['role']) {
                                        'admin' => 'bg-danger-subtle text-danger border-danger-subtle',
                                        'veterinarian' => 'bg-primary-subtle text-primary border-primary-subtle',
                                        'shelter' => 'bg-success-subtle text-success border-success-subtle',
                                        'vendor' => 'bg-info-subtle text-info border-info-subtle',
                                        default => 'bg-warning-subtle text-dark border-warning-subtle',
                                    };
                                    ?>
                                    <span class="badge border text-uppercase px-2 py-1 <?= $roleBadge ?>" style="font-size: 11.5px; border-radius: 6px;">
                                        <?= ViewHelper::e($u['role']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $u['status'] ?>">
                                        <?= ucfirst(ViewHelper::e($u['status'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <small class="text-dark fw-semibold"><?= ViewHelper::e($u['phone'] ?? '—') ?></small>
                                </td>
                                <td>
                                    <small class="text-muted"><?= date('M d, Y', strtotime($u['created_at'])) ?></small>
                                </td>
                                <td style="text-align: right;">
                                    <a href="<?= ViewHelper::url('admin/users/' . $u['id']) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold">
                                        <i class="fa-solid fa-eye me-1 text-primary"></i> View
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

<!-- Pagination -->
<?php if (isset($pagination) && (($pagination['totalPages'] ?? 1) > 1)): ?>
    <div class="d-flex justify-content-between align-items-center mt-4">
        <small class="text-muted">
            Showing <strong><?= count($users) ?></strong> items of <strong><?= $pagination['totalItems'] ?></strong> records.
        </small>
        <ul class="pagination pagination-sm m-0">
            <?php for ($i = 1; $i <= $pagination['totalPages']; $i++): ?>
                <li class="page-item <?= (($pagination['currentPage'] ?? 1) == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="<?= ViewHelper::url('admin/users?page=' . $i) ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </div>
<?php endif; ?>
