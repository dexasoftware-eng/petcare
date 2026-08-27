<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-doctor text-warning"></i>
            <span>Veterinary Credential Review</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">Status: <?= ucfirst($vet['verification_status'] ?? 'pending') ?></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($vet['name']) ?> 🩺</h2>
        <p class="portal-hero-subtitle">
            <?= ViewHelper::e($vet['clinic_name'] ?? 'Private Practice') ?> &middot; License: <?= ViewHelper::e($vet['license_number'] ?? 'N/A') ?> &middot; Specialization: <?= ViewHelper::e($vet['specialization'] ?? 'General Veterinary Medicine') ?>
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <?php if (($vet['verification_status'] ?? '') !== 'approved'): ?>
            <button class="btn btn-admin-success" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/veterinarians/' . $vet['id'] . '/verification') ?>', 'Approve Veterinarian', 'Verify and approve credentials for <?= ViewHelper::e($vet['name']) ?>?', 'Approve Credentials', 'btn-success', 'approved')">
                <i class="fa-solid fa-check"></i>
                <span>Approve Practice</span>
            </button>
        <?php endif; ?>
        <?php if (($vet['verification_status'] ?? '') !== 'rejected'): ?>
            <button class="btn btn-admin-danger" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/veterinarians/' . $vet['id'] . '/verification') ?>', 'Reject Application', 'Reject verification for <?= ViewHelper::e($vet['name']) ?>?', 'Reject Application', 'btn-danger', 'rejected')">
                <i class="fa-solid fa-ban"></i>
                <span>Reject</span>
            </button>
        <?php endif; ?>
        <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Clinicians</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-certificate text-primary me-2"></i> Clinical Qualifications</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">License Number</label>
                    <div class="fw-bold font-monospace text-primary"><?= ViewHelper::e($vet['license_number'] ?? 'VET-DVM-2026') ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Specialization</label>
                    <div class="fw-bold"><?= ViewHelper::e($vet['specialization'] ?? 'General Veterinary') ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Clinical Experience</label>
                    <div class="fw-bold"><?= ViewHelper::e($vet['experience'] ?? '5') ?> Years</div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Direct Phone & Email</label>
                    <div><?= ViewHelper::e($vet['phone'] ?? '—') ?></div>
                    <small class="text-muted"><?= ViewHelper::e($vet['email'] ?? '') ?></small>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Clinic Address</label>
                    <div class="fw-semibold text-dark"><?= ViewHelper::e($vet['clinic_address'] ?? $vet['user_address'] ?? '—') ?></div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-calendar-check text-primary me-2"></i> Patient Appointments on Record (<?= count($appointments ?? []) ?>)
                </h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($appointments)): ?>
                    <div class="p-4 text-center text-muted">No appointments on record for this doctor yet.</div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Patient Pet</th>
                                    <th>Owner</th>
                                    <th>Consultation</th>
                                    <th style="text-align: right;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointments as $a): ?>
                                    <tr>
                                        <td><?= ViewHelper::e($a['appointment_date'] ?? '-') ?> <?= ViewHelper::e($a['appointment_time'] ?? '') ?></td>
                                        <td class="fw-bold"><?= ViewHelper::e($a['pet_name'] ?? '-') ?></td>
                                        <td><?= ViewHelper::e($a['owner_name'] ?? '-') ?></td>
                                        <td><?= ViewHelper::e($a['consultation_type'] ?? 'General') ?></td>
                                        <td style="text-align: right;">
                                            <span class="badge-status status-<?= $a['status'] ?? 'pending' ?>"><?= ucfirst(ViewHelper::e($a['status'] ?? 'pending')) ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
