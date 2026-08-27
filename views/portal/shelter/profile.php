<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-house-chimney-medical text-brand me-2"></i> Shelter Facility & Organization Profile</h2>
        <p class="admin-page-subtitle">Manage sanctuary information, official registration, and contact persons.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <div class="avatar-circle mx-auto mb-3 bg-brand text-white fw-bold d-flex align-items-center justify-content-center" style="width: 84px; height: 84px; font-size: 32px; border-radius: 50%;">
                <i class="fa-solid fa-shield-cat"></i>
            </div>
            <h4 class="fw-bold mb-1"><?= ViewHelper::e($profile['shelter_name'] ?? $user['name']) ?></h4>
            <p class="text-muted small mb-2"><i class="fa-solid fa-location-dot me-1 text-danger"></i> <?= ViewHelper::e($user['address']) ?></p>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-3">
                <i class="fa-solid fa-check-double me-1"></i> Verified Non-Profit Rescue Partner
            </span>

            <hr class="my-3">

            <div class="text-start small">
                <div class="mb-2"><strong>Primary Contact:</strong> <?= ViewHelper::e($profile['contact_person'] ?? 'Director') ?></div>
                <div class="mb-2"><strong>Phone:</strong> <?= ViewHelper::e($user['phone'] ?? '+1-555-098-7654') ?></div>
                <div class="mb-2"><strong>Email:</strong> <?= ViewHelper::e($user['email']) ?></div>
                <div><strong>Max Capacity:</strong> <?= (int)($profile['capacity'] ?? 60) ?> Animals</div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Shelter Details</h3>
            </div>
            <div class="admin-card-body">
                <form id="shelterProfileForm" action="<?= ViewHelper::url('shelter/profile/edit') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Shelter / Organization Name</label>
                            <input type="text" name="shelter_name" class="form-control" value="<?= ViewHelper::e($profile['shelter_name'] ?? $user['name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Designated Contact Person</label>
                            <input type="text" name="contact_person" class="form-control" value="<?= ViewHelper::e($profile['contact_person'] ?? 'Maria Rodriguez') ?>" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Contact Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e($user['phone']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Rescue Animal Capacity</label>
                            <input type="number" name="capacity" class="form-control" value="<?= (int)($profile['capacity'] ?? 60) ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Facility Street Address</label>
                        <input type="text" name="address" class="form-control" value="<?= ViewHelper::e($user['address']) ?>" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Official Website / Social Link</label>
                        <input type="url" name="website" class="form-control" value="<?= ViewHelper::e($profile['website'] ?? 'https://petguard.com') ?>" placeholder="https://">
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
    PetGuardAjax.bindForm('#shelterProfileForm', {
        loadingText: 'Saving Shelter Details...',
        reload: true
    });
});
</script>
