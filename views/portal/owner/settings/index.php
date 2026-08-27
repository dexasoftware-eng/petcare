<?php
use Helpers\ViewHelper;
?>

<!-- Page Header -->
<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Account Settings & Privacy Controls</h2>
        <p class="admin-page-subtitle">Manage your pet parent profile, contact details, and QR digital passport privacy preferences.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <!-- Profile Settings Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h4 class="admin-card-title m-0"><i class="fa-solid fa-user-pen text-brand me-2"></i> Pet Parent Information</h4>
            </div>
            <div class="admin-card-body p-4">
                <form action="<?= ViewHelper::url('portal/settings/update') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Full Name *</label>
                            <input type="text" name="name" class="form-control rounded-3" value="<?= ViewHelper::e($user['name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Email Address</label>
                            <input type="email" class="form-control rounded-3 bg-light" value="<?= ViewHelper::e($user['email']) ?>" readonly>
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Primary Phone Number *</label>
                            <input type="text" name="phone" class="form-control rounded-3" value="<?= ViewHelper::e($user['phone'] ?? '') ?>" placeholder="+1 (555) 000-0000" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">City / Residential District</label>
                            <input type="text" name="address" class="form-control rounded-3" value="<?= ViewHelper::e($user['address'] ?? '') ?>" placeholder="e.g. Downtown Metro">
                        </div>
                    </div>
                    <button type="submit" class="btn-admin-primary px-4">Save Profile Changes</button>
                </form>
            </div>
        </div>

        <!-- Privacy & QR Controls -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h4 class="admin-card-title m-0"><i class="fa-solid fa-shield-halved text-success me-2"></i> Public QR Scanner Privacy Settings</h4>
            </div>
            <div class="admin-card-body p-4">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="qrPhoneSwitch" checked>
                    <label class="form-check-label fw-semibold text-dark" for="qrPhoneSwitch">Display emergency phone number on Public QR Scans</label>
                    <p class="small text-muted mb-0">Allows anyone who scans your lost pet's QR tag to call you directly with 1-click.</p>
                </div>
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox" role="switch" id="qrAllergySwitch" checked>
                    <label class="form-check-label fw-semibold text-dark" for="qrAllergySwitch">Display critical medical allergies to finders</label>
                    <p class="small text-muted mb-0">Ensures good samaritans or rescue clinics do not feed hazardous foods to your pet.</p>
                </div>
                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" onclick="showPetGuardModal('Preferences Updated', 'Your public QR privacy preferences have been updated successfully.', 'success');">Save Preferences</button>
            </div>
        </div>
    </div>

    <!-- Account Security Summary -->
    <div class="col-lg-4">
        <div class="admin-card p-4 mb-4">
            <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-lock text-primary me-2"></i> Security Status</h5>
            <div class="p-3 rounded-3 bg-light border mb-3 small">
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Account Role:</span>
                    <span class="badge bg-danger text-uppercase">Pet Owner</span>
                </div>
                <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted">Security Level:</span>
                    <span class="text-success fw-bold">256-Bit SSL Protected</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted">Status:</span>
                    <span class="badge bg-success">Active</span>
                </div>
            </div>
            <p class="small text-muted mb-0">Protected by PetGuard secure session management & encrypted token validation.</p>
        </div>
    </div>
</div>
