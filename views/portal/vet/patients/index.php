<?php
use Helpers\ViewHelper;

$patients = $patients ?? [];
$totalPatients = count($patients);
$dogsCount = 0;
$catsCount = 0;
$activePassports = 0;

foreach ($patients as $p) {
    $sp = strtolower($p['species'] ?? '');
    if (str_contains($sp, 'dog')) $dogsCount++;
    elseif (str_contains($sp, 'cat')) $catsCount++;
    if (($p['passport_status'] ?? 'active') === 'active') $activePassports++;
}
?>

<style>
@media (max-width: 767.98px) {
    .patients-desktop-table { display: none !important; }
    .patients-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .patients-desktop-table { display: block !important; }
    .patients-mobile-grid { display: none !important; }
}
</style>

<div class="vet-patients-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-paw text-warning"></i> Electronic Veterinary Health Records (EHR)
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Patients Medical Database
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Access comprehensive clinical history, vaccination records, weight progression charts, and smart digital pet passports.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span>View Schedule</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Patients</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-shield-cat"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalPatients ?></div>
                <small class="text-muted" style="font-size: 11px;">Registered Health Records</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Canine Patients</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dog"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $dogsCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Active Dogs</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Feline Patients</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-cat"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $catsCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Active Cats</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Active Passports</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $activePassports ?></div>
                <small class="text-muted" style="font-size: 11px;">QR Digital Tags</small>
            </div>
        </div>
    </div>

    <!-- 3. Search & Main Table Card -->
    <div class="admin-card shadow-sm border rounded-4 bg-white overflow-hidden mb-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light flex-wrap gap-2">
            <div class="d-flex align-items-center gap-2">
                <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                    <i class="fa-solid fa-database"></i>
                </div>
                <h6 class="fw-bold text-dark m-0">Patient Directory (<?= $totalPatients ?> Pets)</h6>
            </div>

            <form method="GET" action="<?= ViewHelper::url('vet/patients') ?>" class="d-flex gap-2" style="max-width: 320px; width: 100%;">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-sm rounded-start-pill px-3" placeholder="Search pet, breed, chip..." value="<?= ViewHelper::e($search ?? '') ?>">
                    <button type="submit" class="btn btn-sm btn-admin-primary rounded-end-pill px-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>
        </div>

        <div class="admin-card-body p-0">
            <?php if (empty($patients)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                        <i class="fa-solid fa-paw"></i>
                    </div>
                    <h5 class="fw-bold text-dark">No Patient Records Found</h5>
                    <p class="small text-muted mb-0">Try adjusting your search criteria or query.</p>
                </div>
            <?php else: ?>

                <!-- A. Desktop High-Density Table (>=768px) -->
                <div class="table-responsive m-0 patients-desktop-table">
                    <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                        <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                            <tr>
                                <th class="ps-4 py-3" style="min-width: 220px;">Patient</th>
                                <th class="py-3" style="min-width: 170px;">Species &amp; Breed</th>
                                <th class="py-3" style="min-width: 180px;">Pet Parent Contact</th>
                                <th class="py-3" style="min-width: 150px;">Microchip ID</th>
                                <th class="py-3" style="min-width: 130px;">Digital Passport</th>
                                <th class="text-end pe-4 py-3" style="min-width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($patients as $p): ?>
                                <tr>
                                    <td class="ps-4 py-3">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="<?= ViewHelper::asset($p['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($p['name']) ?></div>
                                                <small class="text-muted"><?= ViewHelper::e($p['gender']) ?> &middot; <?= ViewHelper::e($p['age']) ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($p['species']) ?></div>
                                        <small class="text-muted"><?= ViewHelper::e($p['breed']) ?></small>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= ViewHelper::e($p['owner_name']) ?></div>
                                        <small class="text-muted"><?= ViewHelper::e($p['owner_phone'] ?? $p['owner_email']) ?></small>
                                    </td>
                                    <td class="font-monospace small text-muted">
                                        <?= ViewHelper::e($p['microchip_id'] ?: 'Unchipped') ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold text-uppercase" style="font-size: 10px;">
                                            <i class="fa-solid fa-circle-check me-1"></i> Active
                                        </span>
                                    </td>
                                    <td class="text-end pe-4 py-3">
                                        <a href="<?= ViewHelper::url('vet/patients/' . $p['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold d-inline-flex align-items-center gap-1 shadow-sm">
                                            <i class="fa-solid fa-folder-open"></i>
                                            <span>Medical EHR</span>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- B. Mobile Card Grid (<768px) -->
                <div class="row g-3 p-3 patients-mobile-grid">
                    <?php foreach ($patients as $p): ?>
                        <div class="col-12 col-sm-6">
                            <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-2 pb-2 border-bottom">
                                        <img src="<?= ViewHelper::asset($p['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div class="min-w-0 flex-grow-1">
                                            <div class="fw-bold text-dark text-truncate" style="font-size: 14.5px;"><?= ViewHelper::e($p['name']) ?></div>
                                            <small class="text-muted"><?= ViewHelper::e($p['species']) ?> &middot; <?= ViewHelper::e($p['breed']) ?></small>
                                        </div>
                                    </div>

                                    <div class="mb-3 small">
                                        <div class="text-dark mb-1">
                                            <i class="fa-solid fa-user text-brand me-1"></i><strong>Parent:</strong> <?= ViewHelper::e($p['owner_name']) ?>
                                        </div>
                                        <div class="text-muted font-monospace" style="font-size: 11.5px;">
                                            <i class="fa-solid fa-barcode text-brand me-1"></i><?= ViewHelper::e($p['microchip_id'] ?: 'No microchip logged') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="pt-2 border-top">
                                    <a href="<?= ViewHelper::url('vet/patients/' . $p['id']) ?>" class="btn btn-sm btn-admin-primary rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                        <i class="fa-solid fa-folder-open"></i>
                                        <span>Open Clinical Record</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>
        </div>
    </div>

</div>
