<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Veterinarian Network & Verification</h2>
        <p class="admin-page-subtitle">Accredited veterinary clinics, licensing credentials, and practice verifications.</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/veterinarians') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 200px;">
            <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" placeholder="Search doctor, clinic, or specialization..." value="<?= ViewHelper::e($filters['q']) ?>">
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
        <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="btn btn-sm btn-light rounded-pill px-3">Reset</a>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($veterinarians)): ?>
                        <tr><td colspan="6" class="text-center p-4 text-muted">No veterinarians found matching criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($veterinarians as $vet): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary fw-bold border" style="width: 40px; height: 40px;">
                                            <i class="fa-solid fa-user-doctor"></i>
                                        </div>
                                        <div>
                                            <a href="<?= ViewHelper::url("admin/veterinarians/{$vet['id']}") ?>" class="fw-bold text-dark text-decoration-none hover-underline">
                                                <?= ViewHelper::e($vet['name']) ?>
                                            </a>
                                            <small class="text-muted d-block"><?= ViewHelper::e($vet['email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= ViewHelper::e($vet['clinic_name']) ?></span>
                                    <small class="text-muted d-block">Lic: <?= ViewHelper::e($vet['license_number'] ?? 'VET-DVM-98421') ?></small>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($vet['specialization']) ?></span></td>
                                <td><?= ViewHelper::e($vet['experience']) ?> Yrs</td>
                                <td>
                                    <span class="badge-status status-<?= $vet['verification_status'] ?>"><?= ViewHelper::e($vet['verification_status']) ?></span>
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="<?= ViewHelper::url("admin/veterinarians/{$vet['id']}") ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">Review</a>
                                        <?php if ($vet['verification_status'] === 'pending'): ?>
                                            <button class="btn btn-sm btn-success rounded-pill px-2" title="Approve Practice" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/veterinarians/{$vet['id']}/verification") ?>', 'Approve Veterinarian', 'Approve license and practice credentials for <?= ViewHelper::e($vet['name']) ?>?', 'Approve Doctor', 'btn-success', 'approved')">
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
