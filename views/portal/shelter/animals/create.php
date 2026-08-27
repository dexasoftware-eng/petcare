<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-plus-circle text-brand me-2"></i> List Rescue Animal for Adoption</h2>
        <p class="admin-page-subtitle">Publish a rescue profile to the public Pet Guard adoption platform.</p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('shelter/animals') ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Directory
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Animal Profile Information</h3>
    </div>
    <div class="admin-card-body">
        <form id="createRescueForm" action="<?= ViewHelper::url('shelter/animals/create') ?>" method="POST" enctype="multipart/form-data">
            <?= ViewHelper::csrfField() ?>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Animal Name *</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. Luna" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Species *</label>
                    <select name="species" class="form-select" required>
                        <option value="Dog">Dog</option>
                        <option value="Cat">Cat</option>
                        <option value="Bird">Bird</option>
                        <option value="Rabbit">Rabbit</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Breed *</label>
                    <input type="text" name="breed" class="form-control" placeholder="e.g. Labrador Retriever Mix" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Gender *</label>
                    <select name="gender" class="form-select" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Age / Life Stage *</label>
                    <input type="text" name="age" class="form-control" placeholder="e.g. 1 Year, Puppy, Senior" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold">Weight *</label>
                    <input type="text" name="weight" class="form-control" placeholder="e.g. 18 kg" required>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Microchip Identification Number</label>
                    <input type="text" name="microchip_id" class="form-control font-monospace" placeholder="985141002348912">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold">Vaccination & Health Status</label>
                    <select name="vaccination_status" class="form-select">
                        <option value="Up to Date">Fully Vaccinated & Up to Date</option>
                        <option value="Scheduled">Vaccinations In Progress</option>
                        <option value="Medical Hold">Medical Hold / Special Care</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Primary Profile Photo</label>
                <input type="file" name="photo" class="form-control" accept="image/*">
                <div class="form-text small text-muted">Upload high-resolution photo (JPG, PNG, WebP up to 5MB).</div>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold">Temperament & Adoption Match Notes</label>
                <textarea name="temperament_notes" class="form-control" rows="4" placeholder="Describe social behavior with children, cats, dogs, activity requirements, house training..."></textarea>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                    <i class="fa-solid fa-heart me-1"></i> List Animal for Adoption
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#createRescueForm', {
        loadingText: 'Publishing Listing...',
        redirect: 'shelter/animals'
    });
});
</script>
