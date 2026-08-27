<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-paw text-warning"></i>
            <span>Sanctuary Rescue Management</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">ID: <?= $pet['id'] ?></span>
        </div>
        <h2 class="portal-hero-title">Edit Rescue: <?= ViewHelper::e($pet['name']) ?> ✏️</h2>
        <p class="portal-hero-subtitle">Update medical certifications, behavioral temperament notes, and public adoption listing details.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Profile</span>
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Edit Details</h3>
    </div>
    <div class="admin-card-body">
        <form id="editRescueForm" action="<?= ViewHelper::url('shelter/animals/' . $pet['id'] . '/edit') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Animal Name *</label>
                    <input type="text" name="name" class="form-control" value="<?= ViewHelper::e($pet['name']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Species *</label>
                    <select name="species" class="form-select" required>
                        <option value="Dog" <?= $pet['species'] === 'Dog' ? 'selected' : '' ?>>Dog</option>
                        <option value="Cat" <?= $pet['species'] === 'Cat' ? 'selected' : '' ?>>Cat</option>
                        <option value="Bird" <?= $pet['species'] === 'Bird' ? 'selected' : '' ?>>Bird</option>
                        <option value="Rabbit" <?= $pet['species'] === 'Rabbit' ? 'selected' : '' ?>>Rabbit</option>
                        <option value="Other" <?= $pet['species'] === 'Other' ? 'selected' : '' ?>>Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Breed *</label>
                    <input type="text" name="breed" class="form-control" value="<?= ViewHelper::e($pet['breed']) ?>" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Gender *</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male" <?= $pet['gender'] === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $pet['gender'] === 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Age / Life Stage *</label>
                    <input type="text" name="age" class="form-control" value="<?= ViewHelper::e($pet['age']) ?>" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Weight *</label>
                    <input type="text" name="weight" class="form-control" value="<?= ViewHelper::e($pet['weight']) ?>" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Microchip Identification Number</label>
                    <input type="text" name="microchip_id" class="form-control font-monospace" value="<?= ViewHelper::e($pet['microchip_id'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Vaccination & Health Status</label>
                    <select name="vaccination_status" class="form-select">
                        <option value="Up to Date" <?= ($pet['vaccination_status'] ?? '') === 'Up to Date' ? 'selected' : '' ?>>Fully Vaccinated & Up to Date</option>
                        <option value="Scheduled" <?= ($pet['vaccination_status'] ?? '') === 'Scheduled' ? 'selected' : '' ?>>Vaccinations In Progress</option>
                        <option value="Medical Hold" <?= ($pet['vaccination_status'] ?? '') === 'Medical Hold' ? 'selected' : '' ?>>Medical Hold / Special Care</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Temperament & Behavior Notes</label>
                <textarea name="temperament_notes" class="form-control" rows="4"><?= ViewHelper::e($pet['diet_instructions'] ?? '') ?></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                    <i class="fa-solid fa-check me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#editRescueForm', {
        loadingText: 'Saving Animal Details...',
        redirect: 'shelter/animals/<?= $pet['id'] ?>'
    });
});
</script>
