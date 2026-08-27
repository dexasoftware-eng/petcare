<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Animal Rescue Shelters & Sanctuaries</h2>
        <p class="admin-page-subtitle">Verified rescue facilities, holding capacities, and adoption program management.</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/shelters') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 200px;">
            <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" placeholder="Search sanctuary or contact person..." value="<?= ViewHelper::e($filters['q']) ?>">
        </div>
        <div>
            <select name="status" class="form-select form-select-sm rounded-pill px-3">
                <option value="">All Verifications</option>
                <option value="pending" <?= $filters['status'] === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                <option value="approved" <?= $filters['status'] === 'approved' ? 'selected' : '' ?>>Approved / Active</option>
                <option value="rejected" <?= $filters['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="suspended" <?= $filters['status'] === 'suspended' ? 'selected' : '' ?>>Suspended</option>
            </select>
        </div>
        <button type="submit" class="btn btn-sm btn-dark rounded-pill px-4">Filter</button>
        <a href="<?= ViewHelper::url('admin/shelters') ?>" class="btn btn-sm btn-light rounded-pill px-3">Reset</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($shelters)): ?>
                        <tr><td colspan="6" class="text-center p-4 text-muted">No shelter organizations found matching criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($shelters as $s): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-success fw-bold border" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-house-medical"></i>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url("admin/shelters/{$s['id']}") ?>" class="fw-bold text-dark text-decoration-none hover-underline">
                                                <?= ViewHelper::e($s['shelter_name']) ?>
                                            </a>
                                            <small class="text-muted d-block"><?= ViewHelper::e($s['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($s['name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($s['phone']) ?></small>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($s['capacity']) ?> Animals</span></td>
                                <td><small class="text-muted"><?= ViewHelper::e($s['address'] ?: '—') ?></small></td>
                                <td>
                                    <span class="badge-status status-<?= $s['verification_status'] ?>"><?= ViewHelper::e($s['verification_status']) ?></span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= ViewHelper::url("admin/shelters/{$s['id']}") ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">Review</a>
                                        <?php if ($s['verification_status'] === 'pending'): ?>
                                            <button class="btn btn-sm btn-success rounded-pill px-2" title="Approve Sanctuary" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/shelters/{$s['id']}/verification") ?>', 'Approve Sanctuary', 'Approve rescue sanctuary <?= ViewHelper::e($s['shelter_name']) ?>?', 'Approve Shelter', 'btn-success', 'approved')">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        <?php endif; ?>
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
