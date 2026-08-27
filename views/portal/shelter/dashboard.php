<?php
use Helpers\ViewHelper;
?>

<!-- 1. Sanctuary Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-house-chimney-medical text-warning"></i>
            <span>Verified Animal Sanctuary</span>
            <span class="text-white-50">&middot;</span>
            <span>Capacity: <strong><?= $kpi['totalAnimals'] ?? 0 ?> / <?= (int)($profile['capacity'] ?? 60) ?></strong></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($profile['shelter_name'] ?? 'Hope Animal Rescue Sanctuary') ?> 🐾</h2>
        <p class="portal-hero-subtitle">Adoption management pipeline, rescue medical records & prospective parent interviews.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus"></i>
            <span>List Animal for Adoption</span>
        </a>
        <a href="<?= ViewHelper::url('shelter/interviews') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-video"></i>
            <span>Video Home Checks</span>
        </a>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Rescued Animals</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['totalAnimals'] ?? 0 ?></div>
            <div class="stat-card-footer text-muted">Currently under shelter care</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Available for Adoption</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['availableForAdoption'] ?? 0 ?></div>
            <div class="stat-card-footer text-success fw-bold">Live on public portal</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Applications</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-file-signature"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['pendingApplications'] ?? 0 ?></div>
            <div class="stat-card-footer text-muted">Require review or interview</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Successful Adoptions</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-house-chimney-heart"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['successfulAdoptions'] ?? 0 ?></div>
            <div class="stat-card-footer text-success fw-bold">Forever homes found</div>
        </div>
    </div>
</div>

<!-- Animals Grid & Recent Applications -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Rescue Animals Under Shelter Care</h3>
                <a href="<?= ViewHelper::url('shelter/animals') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">View All</a>
            </div>
            <div class="admin-card-body p-0">
                <div class="d-none d-md-block table-responsive m-0">
                    <table class="table table-hover align-middle m-0" style="min-width: 540px;">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-4">Animal</th>
                                <th>Species & Breed</th>
                                <th>Gender / Age</th>
                                <th>Adoption Status</th>
                                <th class="text-end pe-4 text-nowrap">Manage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($animals as $pet): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 40px; height: 40px; object-fit: cover;">
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($pet['name']) ?></div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold text-dark"><?= ViewHelper::e($pet['species']) ?></div>
                                        <div class="small text-muted"><?= ViewHelper::e($pet['breed']) ?></div>
                                    </td>
                                    <td class="small text-muted text-nowrap">
                                        <?= ViewHelper::e($pet['gender']) ?> &middot; <?= ViewHelper::e($pet['age']) ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($pet['is_for_adoption'])): ?>
                                            <span class="admin-badge badge-success">Available</span>
                                        <?php else: ?>
                                            <span class="admin-badge badge-neutral">Adopted</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end pe-4 text-nowrap">
                                        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" style="font-size: 12px;">
                                            Profile
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Mobile Cards (<768px) -->
                <div class="d-md-none p-3 d-flex flex-column gap-3">
                    <?php foreach ($animals as $pet): ?>
                        <div class="p-3 rounded-4 border bg-white shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($pet['name']) ?></div>
                                        <div class="small text-muted"><?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed']) ?></div>
                                    </div>
                                </div>
                                <?php if (!empty($pet['is_for_adoption'])): ?>
                                    <span class="admin-badge badge-success">Available</span>
                                <?php else: ?>
                                    <span class="admin-badge badge-neutral">Adopted</span>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                                <small class="text-muted"><?= ViewHelper::e($pet['gender']) ?> &bull; <?= ViewHelper::e($pet['age']) ?></small>
                                <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                                    View Profile &rarr;
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-signature text-brand me-2"></i> Recent Applications</h3>
                <a href="<?= ViewHelper::url('shelter/applications') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">All</a>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($recentApplications)): ?>
                    <div class="p-4 text-center text-muted">No pending adoption applications.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentApplications as $app): ?>
                            <div class="list-group-item py-3">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="fw-bold text-dark"><?= ViewHelper::e($app['applicant_name']) ?></span>
                                    <span class="badge bg-light text-secondary border"><?= ViewHelper::e($app['status']) ?></span>
                                </div>
                                <div class="small text-muted mb-2">Applied for: <strong class="text-brand"><?= ViewHelper::e($app['pet_name']) ?></strong></div>
                                <div class="d-flex gap-2">
                                    <a href="<?= ViewHelper::url('shelter/applications/' . $app['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1">Review</a>
                                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1" onclick="PetGuardCall.initiateCall(<?= (int)$app['applicant_id'] ?>, 'video', 'adoption', <?= (int)$app['id'] ?>)">
                                        <i class="fa-solid fa-video me-1"></i> Interview
                                    </button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
