<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$user = $user ?? Auth::user() ?? [];
$petsCount = $petsCount ?? 0;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-shield-halved text-success"></i>
            <span>256-Bit SSL Protected Account</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= $petsCount ?> Registered Pets</span>
        </div>
        <h2 class="portal-hero-title">Account Settings &amp; Privacy ⚙️</h2>
        <p class="portal-hero-subtitle">
            Manage your personal profile, credentials, security, and QR digital passport privacy preferences.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>My Portal</span>
        </a>
    </div>
</div>

<div class="row g-4 mb-5">
    <!-- Left Column: Primary Settings Forms -->
    <div class="col-lg-8">
        
        <!-- Section 1: Profile & Contact Details -->
        <div class="admin-card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="admin-card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="admin-card-title m-0 fw-bold" style="font-family: 'Anybody', sans-serif;">
                        <i class="fa-solid fa-user-pen text-brand me-2"></i> Pet Parent Information
                    </h4>
                    <p class="text-muted small m-0 mt-1">Keep your primary contact details updated for emergency veterinary alerts.</p>
                </div>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">Profile Details</span>
            </div>
            <div class="admin-card-body p-4">
                <form id="profileSettingsForm" action="<?= ViewHelper::url('portal/settings/profile') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Full Legal Name *</label>
                            <input type="text" name="name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Account Email (Verified)</label>
                            <div class="input-group">
                                <input type="email" class="form-control rounded-start-3 py-2 bg-light text-muted border-end-0" value="<?= ViewHelper::e($user['email'] ?? '') ?>" readonly>
                                <span class="input-group-text bg-light border-start-0 text-success small pe-3">
                                    <i class="fa-solid fa-circle-check"></i>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Emergency Contact Phone *</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-phone text-muted"></i></span>
                                <input type="text" name="phone" class="form-control rounded-end-3 py-2" value="<?= ViewHelper::e($user['phone'] ?? '') ?>" placeholder="+1 (555) 000-0000" required>
                            </div>
                            <div class="form-text small text-muted">Used by finders and emergency clinics when your pet is in triage.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Residential Address / City</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fa-solid fa-location-dot text-muted"></i></span>
                                <input type="text" name="address" class="form-control rounded-end-3 py-2" value="<?= ViewHelper::e($user['address'] ?? '') ?>" placeholder="e.g. 742 Evergreen Terrace, Springfield">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="fa-solid fa-check me-1"></i> Save Profile Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section 2: Password & Authentication Security -->
        <div class="admin-card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
            <div class="admin-card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="admin-card-title m-0 fw-bold" style="font-family: 'Anybody', sans-serif;">
                        <i class="fa-solid fa-key text-primary me-2"></i> Security &amp; Password
                    </h4>
                    <p class="text-muted small m-0 mt-1">Ensure your account is protected with a robust cryptographic password.</p>
                </div>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill small">Authentication</span>
            </div>
            <div class="admin-card-body p-4">
                <form id="passwordSettingsForm" action="<?= ViewHelper::url('portal/settings/password') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Current Password *</label>
                        <input type="password" name="current_password" class="form-control rounded-3 py-2" placeholder="Enter existing password" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">New Password *</label>
                            <input type="password" name="new_password" class="form-control rounded-3 py-2" placeholder="Minimum 6 characters" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-dark">Confirm New Password *</label>
                            <input type="password" name="confirm_password" class="form-control rounded-3 py-2" placeholder="Repeat new password" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm">
                            <i class="fa-solid fa-lock me-1"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Section 3: Digital Pet Passport & QR Privacy -->
        <div class="admin-card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="admin-card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="admin-card-title m-0 fw-bold" style="font-family: 'Anybody', sans-serif;">
                        <i class="fa-solid fa-qrcode text-success me-2"></i> Public QR Scanner Privacy Controls
                    </h4>
                    <p class="text-muted small m-0 mt-1">Configure what information is visible when someone scans your lost pet's smart collar QR tag.</p>
                </div>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill small">QR Shield</span>
            </div>
            <div class="admin-card-body p-4">
                <div class="d-flex flex-column gap-3">
                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13.5px;">Display Emergency Phone on Public Scans</strong>
                            <p class="text-muted small m-0" style="font-size: 11.5px;">Allows finders who scan your pet's tag to call you directly with 1-tap.</p>
                        </div>
                        <div class="form-check form-switch m-0 ms-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="qrPhoneSwitch" checked onchange="PetGuardToast.success('QR Phone visibility updated.');">
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13.5px;">Display Critical Medical Allergies &amp; Diets</strong>
                            <p class="text-muted small m-0" style="font-size: 11.5px;">Ensures finders and shelters do not administer toxic medications or allergen foods.</p>
                        </div>
                        <div class="form-check form-switch m-0 ms-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="qrAllergySwitch" checked onchange="PetGuardToast.success('Critical allergy visibility updated.');">
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center justify-content-between">
                        <div>
                            <strong class="text-dark d-block" style="font-size: 13.5px;">Display Microchip Identification Number</strong>
                            <p class="text-muted small m-0" style="font-size: 11.5px;">Enables veterinary clinics to cross-reference global registry databases immediately.</p>
                        </div>
                        <div class="form-check form-switch m-0 ms-3">
                            <input class="form-check-input" type="checkbox" role="switch" id="qrChipSwitch" checked onchange="PetGuardToast.success('Microchip visibility updated.');">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Right Column: Security Status & Account Insights -->
    <div class="col-lg-4">
        
        <!-- Security Overview Card -->
        <div class="admin-card border-0 shadow-sm rounded-4 p-4 mb-4">
            <h5 class="fw-bold text-dark mb-3" style="font-family: 'Anybody', sans-serif;">
                <i class="fa-solid fa-shield-cat text-primary me-2"></i> Security Overview
            </h5>
            
            <div class="d-flex flex-column gap-2 mb-4">
                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                    <span class="text-muted small">Account Role</span>
                    <span class="badge bg-dark text-uppercase px-2 py-1" style="font-size: 10px;">Pet Parent</span>
                </div>
                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                    <span class="text-muted small">Encryption</span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1" style="font-size: 10px;">256-Bit SSL</span>
                </div>
                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                    <span class="text-muted small">Status</span>
                    <span class="badge bg-success px-2 py-1" style="font-size: 10px;">Active</span>
                </div>
                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                    <span class="text-muted small">Protected Pets</span>
                    <span class="fw-bold text-dark small"><?= $petsCount ?> Registered</span>
                </div>
            </div>

            <div class="p-3 rounded-3 bg-primary-subtle border border-primary-subtle text-primary small">
                <div class="d-flex align-items-center gap-2 fw-bold mb-1">
                    <i class="fa-solid fa-lock"></i>
                    <span>Automatic Session Shield</span>
                </div>
                <p class="m-0 text-secondary" style="font-size: 11.5px; line-height: 1.5;">
                    Your account is safeguarded with encrypted session cookies, CSRF protection, and real-time brute-force throttling.
                </p>
            </div>
        </div>

        <!-- Quick Links Card -->
        <div class="admin-card border-0 shadow-sm rounded-4 p-4">
            <h5 class="fw-bold text-dark mb-3" style="font-family: 'Anybody', sans-serif;">
                <i class="fa-solid fa-compass text-brand me-2"></i> Quick Actions
            </h5>
            <div class="d-flex flex-column gap-2">
                <a href="<?= ViewHelper::url('portal/pets') ?>" class="btn btn-light rounded-pill text-start d-flex align-items-center justify-content-between px-3 py-2 text-dark">
                    <span class="small fw-semibold"><i class="fa-solid fa-paw text-brand me-2"></i> Manage Pet Profiles</span>
                    <i class="fa-solid fa-chevron-right text-muted small" style="font-size: 11px;"></i>
                </a>
                <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-light rounded-pill text-start d-flex align-items-center justify-content-between px-3 py-2 text-dark">
                    <span class="small fw-semibold"><i class="fa-solid fa-truck-medical text-danger me-2"></i> Emergency Contacts</span>
                    <i class="fa-solid fa-chevron-right text-muted small" style="font-size: 11px;"></i>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="btn btn-light rounded-pill text-start d-flex align-items-center justify-content-between px-3 py-2 text-dark">
                    <span class="small fw-semibold"><i class="fa-solid fa-video text-primary me-2"></i> Consultation Logs</span>
                    <i class="fa-solid fa-chevron-right text-muted small" style="font-size: 11px;"></i>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#profileSettingsForm', {
        loadingText: 'Saving Profile Changes...',
        onSuccess: (data) => {
            PetGuardToast.success('Your profile details have been saved successfully.');
        }
    });

    PetGuardAjax.bindForm('#passwordSettingsForm', {
        loadingText: 'Updating Password...',
        onSuccess: (data, form) => {
            PetGuardToast.success('Your security password has been updated.');
            form.reset();
        }
    });
});
</script>
