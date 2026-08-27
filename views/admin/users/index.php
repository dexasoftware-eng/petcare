<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">User Governance</h2>
        <p class="admin-page-subtitle">Directory of pet owners, verified veterinarians, rescue shelters, and administrators.</p>
    </div>
</div>

<!-- Filters Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/users') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 200px;">
            <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" placeholder="Search name, email, or phone..." value="<?= ViewHelper::e($filters['q']) ?>">
        </div>
        <div>
            <select name="role" class="form-select form-select-sm rounded-pill px-3">
                <option value="">All Roles</option>
                <option value="petowner" <?= $filters['role'] === 'petowner' ? 'selected' : '' ?>>Pet Owners</option>
                <option value="veterinarian" <?= $filters['role'] === 'veterinarian' ? 'selected' : '' ?>>Veterinarians</option>
                <option value="shelter" <?= $filters['role'] === 'shelter' ? 'selected' : '' ?>>Rescue Shelters</option>
                <option value="admin" <?= $filters['role'] === 'admin' ? 'selected' : '' ?>>Administrators</option>
            </select>
        </div>
        <div>
            <select name="status" class="form-select form-select-sm rounded-pill px-3">
                <option value="">All Statuses</option>
                <option value="active" <?= $filters['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="pending" <?= $filters['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="suspended" <?= $filters['status'] === 'suspended' ? 'selected' : '' ?>>Suspended</option>
                <option value="disabled" <?= $filters['status'] === 'disabled' ? 'selected' : '' ?>>Disabled</option>
            </select>
        </div>
        <button type="submit" class="btn btn-sm btn-dark rounded-pill px-4">Filter</button>
        <a href="<?= ViewHelper::url('admin/users') ?>" class="btn btn-sm btn-light rounded-pill px-3">Reset</a>
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
                        <th>Role</th>
                        <th>Status</th>
                        <th>Contact Phone</th>
                        <th>Joined</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold text-danger border" style="width: 38px; height: 38px; min-width: 38px;">
                                        <?= strtoupper(substr($u['name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <a href="<?= ViewHelper::url("admin/users/{$u['id']}") ?>" class="fw-bold text-dark text-decoration-none hover-underline">
                                            <?= ViewHelper::e($u['name']) ?>
                                        </a>
                                        <small class="text-muted d-block"><?= ViewHelper::e($u['email']) ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase" style="font-size: 11px;">
                                    <?= ViewHelper::e($u['role']) ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge-status status-<?= $u['status'] ?>"><?= ViewHelper::e($u['status']) ?></span>
                            </td>
                            <td><?= ViewHelper::e($u['phone'] ?: '—') ?></td>
                            <td><small class="text-muted"><?= date('M d, Y', strtotime($u['created_at'])) ?></small></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light rounded-pill px-3" data-bs-toggle="dropdown">
                                        <i class="fa-solid fa-ellipsis"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                        <li><a class="dropdown-item" href="<?= ViewHelper::url("admin/users/{$u['id']}") ?>"><i class="fa-solid fa-eye me-2 text-primary"></i> View Profile</a></li>
                                        <?php if ($u['status'] === 'active'): ?>
                                            <li>
                                                <button class="dropdown-item text-danger" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/users/{$u['id']}/status") ?>', 'Suspend User', 'Are you sure you want to suspend <?= ViewHelper::e($u['name']) ?>?', 'Suspend User', 'btn-danger', 'suspended')">
                                                    <i class="fa-solid fa-ban me-2"></i> Suspend Account
                                                </button>
                                            </li>
                                        <?php else: ?>
                                            <li>
                                                <button class="dropdown-item text-success" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/users/{$u['id']}/status") ?>', 'Activate User', 'Reactivate account for <?= ViewHelper::e($u['name']) ?>?', 'Activate Account', 'btn-success', 'active')">
                                                    <i class="fa-solid fa-check me-2"></i> Activate Account
                                                </button>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
