<?php
use Helpers\ViewHelper;
?>

<div class="shelter-create-animal-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-heart text-warning"></i>
                <span>Adoption Listing Publishing</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning">Rescue Network</span>
            </div>
            <h2 class="portal-hero-title">List Animal for Adoption 🐕</h2>
            <p class="portal-hero-subtitle">
                Publish a verified rescue pet profile to the public PetGuard marketplace and reach screened adopters.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('shelter/animals') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-arrow-left"></i>
                <span>Back to Directory</span>
            </a>
        </div>
    </div>

    <!-- 2. Main Form Grid -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Listing Guidance & Best Practices (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mb-3 d-flex align-items-center justify-content-center text-primary fw-bold shadow-sm" style="width: 64px; height: 64px; background: #eff6ff; font-size: 28px;">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2" style="font-family: 'Anybody', sans-serif;">
                    Adoption Listing Standards
                </h5>
                <p class="text-muted small mb-3" style="font-size: 12.5px; line-height: 1.6;">
                    Detailed temperament descriptions and clear profile photos increase adoption match rates by up to <strong>3.8x</strong>.
                </p>

                <div class="d-flex flex-column gap-2 text-start small">
                    <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light border">
                        <i class="fa-solid fa-camera text-brand mt-1"></i>
                        <div><strong>Bright Lighting:</strong> High-resolution candid or studio photos work best.</div>
                    </div>
                    <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light border">
                        <i class="fa-solid fa-syringe text-success mt-1"></i>
                        <div><strong>Medical Records:</strong> Ensure vaccination status is verified before publishing.</div>
                    </div>
                    <div class="d-flex align-items-start gap-2 p-2 rounded-3 bg-light border">
                        <i class="fa-solid fa-house-chimney-crack text-primary mt-1"></i>
                        <div><strong>Compatibility:</strong> Specify behavior with other pets, cats, and kids.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Rescue Animal Registration Form (col-lg-8) -->
        <div class="col-12 col-lg-8">
            <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden">
                <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-paw text-brand me-2"></i> Animal Profile Information
                        </h4>
                        <p class="text-muted small m-0 mt-1">Enter complete rescue details for public listing.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">New Listing</span>
                </div>

                <div class="admin-card-body p-4 p-md-5">
                    <form id="createRescueForm" action="<?= ViewHelper::url('shelter/animals/create') ?>" method="POST" enctype="multipart/form-data">
                        <?= ViewHelper::csrfField() ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Animal Name *</label>
                                <input type="text" name="name" class="form-control rounded-3 py-2" placeholder="e.g. Luna" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Species *</label>
                                <select name="species" class="form-select rounded-3 py-2" required>
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Bird">Bird</option>
                                    <option value="Rabbit">Rabbit</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Breed / Mix *</label>
                                <input type="text" name="breed" class="form-control rounded-3 py-2" placeholder="e.g. Labrador Retriever Mix" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Gender *</label>
                                <select name="gender" class="form-select rounded-3 py-2" required>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Age / Life Stage *</label>
                                <input type="text" name="age" class="form-control rounded-3 py-2" placeholder="e.g. 1 Year, Puppy, Senior" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-dark">Weight *</label>
                                <input type="text" name="weight" class="form-control rounded-3 py-2" placeholder="e.g. 18 kg / 40 lbs" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Microchip ID (Optional)</label>
                                <input type="text" name="microchip_id" class="form-control rounded-3 py-2 font-monospace" placeholder="985141002348912">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Vaccination &amp; Health Status *</label>
                                <select name="vaccination_status" class="form-select rounded-3 py-2" required>
                                    <option value="Up to Date">Fully Vaccinated &amp; Up to Date</option>
                                    <option value="Scheduled">Vaccinations In Progress</option>
                                    <option value="Medical Hold">Special Medical Care Required</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Primary Profile Photo</label>
                            <input type="file" name="photo" class="form-control rounded-3 py-2" accept="image/*">
                            <div class="form-text small text-muted">Upload high-resolution photo (JPG, PNG, WebP up to 5MB).</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Temperament &amp; Lifestyle Match Notes *</label>
                            <textarea name="temperament_notes" class="form-control rounded-3 p-3" rows="4" placeholder="Describe social behavior with children, cats, dogs, energy level, house training, leash manners..." required></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-heart"></i>
                                <span>Publish Rescue Listing</span>
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
    PetGuardAjax.bindForm('#createRescueForm', {
        loadingText: 'Publishing Rescue Animal...',
        onSuccess: (data) => {
            PetGuardToast.success('Rescue animal published successfully!');
            setTimeout(() => {
                window.location.href = '<?= ViewHelper::url("shelter/animals") ?>';
            }, 600);
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to list rescue animal.');
        }
    });
});
</script>
