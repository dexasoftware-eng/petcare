<?php
use Helpers\ViewHelper;
use Helpers\Auth;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-user-doctor text-brand me-2"></i> Clinical Profile & Accreditation</h2>
        <p class="admin-page-subtitle">Manage your verified practice credentials, licensing, and clinic details.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <div class="avatar-circle mx-auto mb-3 bg-brand text-white fw-bold d-flex align-items-center justify-content-center" style="width: 84px; height: 84px; font-size: 32px; border-radius: 50%;">
                <?= strtoupper(substr($user['name'] ?? 'V', 0, 1)) ?>
            </div>
            <h4 class="fw-bold mb-1">Dr. <?= ViewHelper::e($user['name']) ?></h4>
            <p class="text-muted small mb-2"><?= ViewHelper::e($profile['specialization'] ?? 'Veterinarian') ?></p>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-3">
                <i class="fa-solid fa-circle-check me-1"></i> Verified Licensed Clinician
            </span>

            <hr class="my-3">

            <div class="text-start small">
                <div class="mb-2"><strong>License No:</strong> <span class="font-monospace text-brand"><?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?></span></div>
                <div class="mb-2"><strong>Email:</strong> <?= ViewHelper::e($user['email']) ?></div>
                <div class="mb-2"><strong>Phone:</strong> <?= ViewHelper::e($user['phone'] ?? '+1-555-019-2834') ?></div>
                <div><strong>Experience:</strong> <?= (int)($profile['experience'] ?? 8) ?> Years</div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Clinical Details</h3>
            </div>
            <div class="admin-card-body">
                <form id="vetProfileForm" action="<?= ViewHelper::url('vet/profile/edit') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Full Practitioner Name</label>
                            <input type="text" name="name" class="form-control" value="<?= ViewHelper::e($user['name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Clinic Direct Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e($user['phone']) ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Clinical Specialization</label>
                            <input type="text" name="specialization" class="form-control" value="<?= ViewHelper::e($profile['specialization'] ?? 'Small Animal Surgery & Canine Medicine') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Years of Clinical Practice</label>
                            <input type="number" name="experience" class="form-control" value="<?= (int)($profile['experience'] ?? 8) ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Primary Clinic Name</label>
                            <input type="text" name="clinic_name" class="form-control" value="<?= ViewHelper::e($profile['clinic_name'] ?? 'Pet Guard Central Hospital') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold small">Veterinary License Number</label>
                            <input type="text" name="license_number" class="form-control font-monospace" value="<?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small">Physical Hospital / Clinic Address</label>
                        <input type="text" name="clinic_address" class="form-control" value="<?= ViewHelper::e($profile['clinic_address'] ?? $user['address']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold small">Professional Bio & Philosophy of Care</label>
                        <textarea name="bio" class="form-control" rows="4"><?= ViewHelper::e($profile['bio'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                            <i class="fa-solid fa-check me-1"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vetProfileForm', {
        loadingText: 'Saving Profile...',
        reload: true
    });
});
</script>
