<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-paw text-warning"></i>
            <span>Rescue Resident Profile</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">ID: <?= $pet['id'] ?></span>
        </div>
        <h2 class="portal-hero-title">Rescue: <?= ViewHelper::e($pet['name']) ?> 🐾</h2>
        <p class="portal-hero-subtitle"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>) &middot; Microchip: <?= ViewHelper::e($pet['microchip_id'] ?? 'Not microchipped') ?></p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id'] . '/edit') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-pen-to-square"></i>
            <span>Edit Profile</span>
        </a>
        <a href="<?= ViewHelper::url('pet-passport/' . ($pet['qr_token'] ?? '')) ?>" target="_blank" class="btn btn-admin-secondary">
            <i class="fa-solid fa-qrcode"></i>
            <span>Public Adoption QR</span>
        </a>
        <a href="<?= ViewHelper::url('shelter/animals') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Directory</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-4 border mb-3" style="width: 120px; height: 120px; object-fit: cover;">
            <h4 class="fw-bold mb-1"><?= ViewHelper::e($pet['name']) ?></h4>
            <p class="text-muted small mb-2"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>)</p>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-3">
                <?= !empty($pet['is_for_adoption']) ? 'Available for Adoption' : 'Adopted' ?>
            </span>

            <div class="text-start small border-top pt-3">
                <div class="mb-2"><strong>Gender:</strong> <?= ViewHelper::e($pet['gender']) ?></div>
                <div class="mb-2"><strong>Age:</strong> <?= ViewHelper::e($pet['age']) ?></div>
                <div class="mb-2"><strong>Weight:</strong> <?= ViewHelper::e($pet['weight']) ?></div>
                <div class="mb-2"><strong>Vaccinations:</strong> <span class="text-success"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to date') ?></span></div>
                <div><strong>Care Score:</strong> <?= (int)($pet['care_score'] ?? 95) ?>/100</div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-heart-pulse text-brand me-2"></i> Behavioral & Adoption Temperament</h3>
            </div>
            <div class="admin-card-body">
                <p class="text-muted mb-0"><?= nl2br(ViewHelper::e($pet['diet_instructions'] ?: 'Gentle and friendly demeanor, loves outdoor activity and is social with people.')) ?></p>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-signature text-brand me-2"></i> Submitted Applications for this Pet</h3>
                <span class="badge bg-light text-dark border"><?= count($applications ?? []) ?> Applications</span>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($applications)): ?>
                    <div class="p-4 text-center text-muted">No adoption applications submitted for <?= ViewHelper::e($pet['name']) ?> yet.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($applications as $app): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center p-3">
                                <div>
                                    <h6 class="fw-bold text-dark mb-1"><?= ViewHelper::e($app['applicant_name']) ?></h6>
                                    <span class="small text-muted"><?= ViewHelper::e($app['living_arrangement'] ?? 'House with Yard') ?> &middot; Submitted <?= date('M d, Y', strtotime($app['created_at'])) ?></span>
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="admin-badge badge-amber text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($app['status']) ?></span>
                                    <a href="<?= ViewHelper::url('shelter/applications/' . $app['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                        Review
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
