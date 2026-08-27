<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$user = $user ?? Auth::user() ?? [];
$profile = $profile ?? [];
?>

<div class="shelter-profile-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-house-chimney-medical text-warning"></i>
                <span>Certified Rescue Organization</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= ViewHelper::e($profile['license_number'] ?? 'SHL-TX-88219') ?></span>
            </div>
            <h2 class="portal-hero-title">Facility &amp; Organization Profile 🐾</h2>
            <p class="portal-hero-subtitle">
                Manage your sanctuary profile, official registration, capacity limits, and public directory details.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('shelter/dashboard') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Sanctuary Portal</span>
            </a>
            <a href="<?= ViewHelper::url('shelter/animals') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-paw"></i>
                <span>Manage Animals</span>
            </a>
        </div>
    </div>

    <!-- 2. Main Profile Grid -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Shelter Badge & Credibility Card (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card text-center p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold shadow" style="width: 88px; height: 88px; background: linear-gradient(135deg, #fa441d 0%, #ff5722 100%); font-size: 36px;">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">
                    <?= ViewHelper::e($profile['shelter_name'] ?? $user['name']) ?>
                </h4>
                <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1 text-danger"></i> <?= ViewHelper::e($user['address'] ?? 'Texas, USA') ?></p>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-4 fw-bold">
                    <i class="fa-solid fa-check-double me-1"></i> Verified Non-Profit Rescue Partner
                </span>

                <div class="p-3 bg-light rounded-3 text-start small border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Primary Contact:</span>
                        <strong class="text-dark"><?= ViewHelper::e($profile['contact_person'] ?? 'Director') ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Phone:</span>
                        <strong class="text-dark font-monospace"><?= ViewHelper::e($user['phone'] ?? '+1-555-098-7654') ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Email:</span>
                        <strong class="text-dark text-truncate" style="max-width: 160px;"><?= ViewHelper::e($user['email']) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Rescue Capacity:</span>
                        <strong class="text-brand fw-bold"><?= (int)($profile['capacity'] ?? 60) ?> Animals</strong>
                    </div>
                </div>
            </div>

            <!-- Virtual Screening Notice -->
            <div class="p-4 rounded-4 bg-white border shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold small">
                    <i class="fa-solid fa-video text-success fs-5"></i>
                    <span>Virtual Home Checks Active</span>
                </div>
                <p class="text-muted small m-0" style="font-size: 12px; line-height: 1.6;">
                    Your shelter is enabled to conduct live video assessments and virtual meet-and-greets directly from the applications tab.
                </p>
            </div>
        </div>

        <!-- Right: Edit Shelter Form (col-lg-8) -->
        <div class="col-12 col-lg-8">
            <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden">
                <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-pen-to-square text-brand me-2"></i> Update Organization Profile
                        </h4>
                        <p class="text-muted small m-0 mt-1">Information displayed on your public shelter profile and adoption listings.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">Sanctuary Profile</span>
                </div>

                <div class="admin-card-body p-4 p-md-5">
                    <form id="shelterProfileForm" action="<?= ViewHelper::url('shelter/profile/edit') ?>" method="POST">
                        <?= ViewHelper::csrfField() ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Shelter / Organization Name *</label>
                                <input type="text" name="shelter_name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['shelter_name'] ?? $user['name']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Designated Contact Person *</label>
                                <input type="text" name="contact_person" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['contact_person'] ?? 'Maria Rodriguez') ?>" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Facility Contact Phone *</label>
                                <input type="text" name="phone" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['phone']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Rescue Animal Capacity (Heads) *</label>
                                <input type="number" name="capacity" class="form-control rounded-3 py-2 font-monospace" value="<?= (int)($profile['capacity'] ?? 60) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Facility Street Address *</label>
                            <input type="text" name="address" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['address']) ?>" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Official Sanctuary Website / Social Link</label>
                            <input type="url" name="website" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['website'] ?? 'https://petguard.com') ?>" placeholder="https://">
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-check"></i>
                                <span>Save Shelter Details</span>
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
    PetGuardAjax.bindForm('#shelterProfileForm', {
        loadingText: 'Saving Shelter Details...',
        onSuccess: (data) => {
            PetGuardToast.success(data.message || 'Shelter organization profile updated.');
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to update details.');
        }
    });
});
</script>
