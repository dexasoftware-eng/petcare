<?php
use Helpers\ViewHelper;

$animals = $animals ?? [];
$totalAnimals = count($animals);
$availableCount = 0;
$dogsCount = 0;
$catsCount = 0;

foreach ($animals as $pet) {
    if (!empty($pet['is_for_adoption'])) $availableCount++;
    $sp = strtolower($pet['species'] ?? '');
    if (str_contains($sp, 'dog')) $dogsCount++;
    elseif (str_contains($sp, 'cat')) $catsCount++;
}
?>

<style>
@media (max-width: 767.98px) {
    .animals-desktop-table { display: none !important; }
    .animals-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .animals-desktop-table { display: block !important; }
    .animals-mobile-grid { display: none !important; }
}
</style>

<div class="shelter-animals-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-paw text-warning"></i> Rescue Animals Management
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Shelter Rescue Directory
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Manage shelter residents, update health &amp; vaccination statuses, review adoption profiles, and publish listings to the marketplace.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-plus"></i>
                    <span>List Rescue Animal</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Rescues</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-paw"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalAnimals ?></div>
                <small class="text-muted" style="font-size: 11px;">Shelter Residents</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Available</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $availableCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Ready for Adoption</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Rescue Dogs</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $dogsCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Canines in Shelter</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Rescue Cats</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-cat"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $catsCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Felines in Shelter</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Animals Content -->
    <?php if (empty($animals)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-solid fa-paw"></i>
            </div>
            <h5 class="fw-bold text-dark">No Rescue Animals Listed</h5>
            <p class="small text-muted mb-3" style="max-width: 480px; margin: 0 auto;">List animals currently sheltered under your care to publish them to the adoption marketplace.</p>
            <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-plus me-1"></i> List Animal
            </a>
        </div>
    <?php else: ?>

        <!-- A. Desktop High-Density Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden animals-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-shield-cat"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Rescue Resident Directory (<?= $totalAnimals ?> Animals)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Public Listings</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 220px;">Animal Profile</th>
                            <th class="py-3" style="min-width: 170px;">Species &amp; Breed</th>
                            <th class="py-3" style="min-width: 140px;">Age &amp; Gender</th>
                            <th class="py-3" style="min-width: 150px;">Microchip ID</th>
                            <th class="py-3" style="min-width: 150px;">Adoption Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($animals as $pet): ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($pet['name']) ?></div>
                                            <span class="badge bg-light text-muted border px-2 py-0" style="font-size: 9.5px;"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to date') ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($pet['species']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($pet['breed']) ?></small>
                                </td>
                                <td class="text-muted small">
                                    <?= ViewHelper::e($pet['gender']) ?> &middot; <?= ViewHelper::e($pet['age']) ?>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($pet['microchip_id'] ?: 'Unchipped') ?>
                                </td>
                                <td>
                                    <?php if (!empty($pet['is_for_adoption'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">
                                            <i class="fa-solid fa-heart me-1"></i> Available
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-muted border rounded-pill px-2 py-1">
                                            Adopted / Placed
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                                        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold">
                                            View
                                        </a>
                                        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle" style="width: 32px; height: 32px; padding: 0;" onclick="deleteAnimal(<?= $pet['id'] ?>)">
                                            <i class="fa-solid fa-trash" style="font-size: 11px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile Card Grid (<768px) -->
        <div class="row g-3 animals-mobile-grid mb-4">
            <?php foreach ($animals as $pet): ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-2 pb-2 border-bottom">
                                <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                <div class="min-w-0 flex-grow-1">
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 14.5px;"><?= ViewHelper::e($pet['name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($pet['species']) ?> &middot; <?= ViewHelper::e($pet['breed']) ?></small>
                                </div>
                                <span class="badge <?= !empty($pet['is_for_adoption']) ? 'bg-success-subtle text-success border-success-subtle' : 'bg-light text-muted border' ?> rounded-pill px-2 py-0" style="font-size: 9.5px;">
                                    <?= !empty($pet['is_for_adoption']) ? 'Available' : 'Placed' ?>
                                </span>
                            </div>

                            <div class="mb-3 small">
                                <div class="text-muted mb-1">
                                    <strong>Age / Gender:</strong> <?= ViewHelper::e($pet['gender']) ?> &middot; <?= ViewHelper::e($pet['age']) ?>
                                </div>
                                <div class="text-muted font-monospace" style="font-size: 11.5px;">
                                    <i class="fa-solid fa-barcode text-brand me-1"></i><?= ViewHelper::e($pet['microchip_id'] ?: 'Unchipped') ?>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex gap-2">
                            <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-sm btn-admin-primary rounded-pill flex-grow-1 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center">
                                View Details
                            </a>
                            <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-bold py-2">
                                Edit
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold py-2" onclick="deleteAnimal(<?= $pet['id'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<script>
async function deleteAnimal(id) {
    const confirmed = await PetGuardModal.danger({
        title: 'Delete Animal Record?',
        message: 'This will remove the animal listing from the adoption directory.'
    });

    if (confirmed) {
        try {
            const res = await PetGuardAjax.post(`shelter/animals/${id}/delete`, {});
            if (res.ok) {
                PetGuardToast.success(res.message || 'Record deleted.');
                window.location.reload();
            } else {
                PetGuardToast.error(res.message || 'Failed to delete animal.');
            }
        } catch (e) {
            PetGuardToast.error('Network error deleting record.');
        }
    }
}
</script>
