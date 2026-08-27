<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header mb-4">
    <div>
        <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="btn btn-sm btn-light border rounded-pill px-3 py-1 fw-semibold mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Veterinarians
        </a>
        <h2 class="admin-page-title"><?= ViewHelper::e($vet['name']) ?></h2>
        <p class="admin-page-subtitle">
            <?= ViewHelper::e($vet['clinic_name'] ?? 'Private Practice') ?> &bull; 
            Verification: <span class="badge-status status-<?= $vet['verification_status'] ?? 'pending' ?>"><?= ucfirst(ViewHelper::e($vet['verification_status'] ?? 'pending')) ?></span>
        </p>
    </div>
    <div class="d-flex gap-2 mt-2">
        <?php if (($vet['verification_status'] ?? '') !== 'approved'): ?>
            <button class="btn btn-sm btn-success rounded-pill px-3 py-2 fw-semibold" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/veterinarians/' . $vet['id'] . '/verification') ?>', 'Approve Veterinarian', 'Verify and approve credentials for <?= ViewHelper::e($vet['name']) ?>?', 'Approve Credentials', 'btn-success', 'approved')">
                <i class="fa-solid fa-check me-1"></i> Approve Practice
            </button>
        <?php endif; ?>
        <?php if (($vet['verification_status'] ?? '') !== 'rejected'): ?>
            <button class="btn btn-sm btn-outline-danger rounded-pill px-3 py-2 fw-semibold" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/veterinarians/' . $vet['id'] . '/verification') ?>', 'Reject Application', 'Reject verification for <?= ViewHelper::e($vet['name']) ?>?', 'Reject Application', 'btn-danger', 'rejected')">
                <i class="fa-solid fa-ban me-1"></i> Reject
            </button>
        <?php endif; ?>
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
