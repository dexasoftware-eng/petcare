<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$user = $user ?? Auth::user() ?? [];
$profile = $profile ?? [];
?>

<div class="vet-profile-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-user-doctor text-warning"></i>
                <span>Certified Practice Credentials</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?></span>
            </div>
            <h2 class="portal-hero-title">Clinical Profile &amp; Accreditation 🩺</h2>
            <p class="portal-hero-subtitle">
                Manage verified practice credentials, state medical licensing, clinical specialization, and hospital location.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('vet/dashboard') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Doctor Portal</span>
            </a>
            <a href="<?= ViewHelper::url('vet/services') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-briefcase-medical"></i>
                <span>Manage Services</span>
            </a>
        </div>
    </div>

    <!-- 2. Main Profile Grid -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Accreditation & Doctor Trust Card (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card text-center p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold shadow" style="width: 88px; height: 88px; background: linear-gradient(135deg, #fa441d 0%, #ff5722 100%); font-size: 36px;">
                    <?= strtoupper(substr($user['name'] ?? 'V', 0, 1)) ?>
                </div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">
                    Dr. <?= ViewHelper::e($user['name']) ?>
                </h4>
                <p class="text-muted small mb-2"><?= ViewHelper::e($profile['specialization'] ?? 'Veterinary Surgeon') ?></p>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-4 fw-bold">
                    <i class="fa-solid fa-circle-check me-1"></i> Verified Licensed Clinician
                </span>

                <div class="p-3 bg-light rounded-3 text-start small border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">License Number:</span>
                        <strong class="text-brand font-monospace"><?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Clinic Phone:</span>
                        <strong class="text-dark font-monospace"><?= ViewHelper::e($user['phone'] ?? '+1-555-019-2834') ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Email:</span>
                        <strong class="text-dark text-truncate" style="max-width: 160px;"><?= ViewHelper::e($user['email']) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Experience:</span>
                        <strong class="text-dark fw-bold"><?= (int)($profile['experience'] ?? 8) ?> Years</strong>
                    </div>
                </div>
            </div>

            <!-- Telemedicine Badge -->
            <div class="p-4 rounded-4 bg-white border shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold small">
                    <i class="fa-solid fa-video text-success fs-5"></i>
                    <span>WebRTC Telehealth Verified</span>
                </div>
                <p class="text-muted small m-0" style="font-size: 12px; line-height: 1.6;">
                    Your account is authorized to conduct 256-bit encrypted video consultations and issue digital prescriptions to pet passports.
                </p>
            </div>
        </div>

        <!-- Right: Edit Clinical Details Form (col-lg-8) -->
        <div class="col-12 col-lg-8">
            <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden">
                <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-pen-to-square text-brand me-2"></i> Update Clinical Credentials
                        </h4>
                        <p class="text-muted small m-0 mt-1">Information displayed on your public veterinary profile.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">Accreditation</span>
                </div>

                <div class="admin-card-body p-4 p-md-5">
                    <form id="vetProfileForm" action="<?= ViewHelper::url('vet/profile/edit') ?>" method="POST">
                        <?= ViewHelper::csrfField() ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Full Practitioner Name *</label>
                                <input type="text" name="name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['name']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Clinic Direct Phone *</label>
                                <input type="text" name="phone" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['phone']) ?>" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Clinical Specialization *</label>
                                <input type="text" name="specialization" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['specialization'] ?? 'Small Animal Surgery & Canine Medicine') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Years of Clinical Experience *</label>
                                <input type="number" name="experience" class="form-control rounded-3 py-2 font-monospace" value="<?= (int)($profile['experience'] ?? 8) ?>" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Primary Hospital / Clinic Name *</label>
                                <input type="text" name="clinic_name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['clinic_name'] ?? 'Pet Guard Central Veterinary Hospital') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">State Veterinary License # *</label>
                                <input type="text" name="license_number" class="form-control rounded-3 py-2 font-monospace" value="<?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Physical Clinic Address *</label>
                            <input type="text" name="clinic_address" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['clinic_address'] ?? $user['address']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Professional Bio &amp; Philosophy of Care</label>
                            <textarea name="bio" class="form-control rounded-3 p-3" rows="4"><?= ViewHelper::e($profile['bio'] ?? 'Dedicated to compassionate, preventative veterinary medicine, digital telehealth diagnostics, and gold-standard surgical wellness.') ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-check"></i>
                                <span>Save Practitioner Details</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vetProfileForm', {
        loadingText: 'Saving Credentials...',
        onSuccess: (data) => {
            PetGuardToast.success(data.message || 'Profile credentials updated.');
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to update credentials.');
        }
    });
});
</script>
