<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-paw text-warning"></i>
            <span>Family Pet Registry</span>
            <span class="text-white-50">&middot;</span>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0"><?= count($pets ?? []) ?> Active Pets</span>
        </div>
        <h2 class="portal-hero-title">My Family Pets 🐾</h2>
        <p class="portal-hero-subtitle">Manage medical records, digital QR passports, biometrics, and lost pet recovery beacons.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/care') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-list-check"></i>
            <span>Care Routine</span>
        </a>
        <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus"></i>
            <span>Register New Pet</span>
        </a>
    </div>
</div>

<!-- 2. Empty State -->
<?php if (empty($pets)): ?>
    <div class="admin-card text-center p-5 mx-auto my-4 shadow-sm" style="max-width: 600px; border-radius: 20px;">
        <div class="rounded-circle bg-light border text-muted d-inline-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 80px; height: 80px; font-size: 36px;">
            <i class="fa-solid fa-dog text-brand"></i>
        </div>
        <h3 class="fw-bold text-dark mb-2">No Pets Registered Yet</h3>
        <p class="text-muted small mb-4" style="line-height: 1.6;">
            Register your dog, cat, or companion animal to generate their cryptographic Digital QR Passport, log vaccines, track medications, and activate emergency lost recovery.
        </p>
        <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn btn-admin-primary mx-auto px-4 py-2 fw-bold d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-plus"></i>
            <span>Register Your First Pet</span>
        </a>
    </div>
<?php else: ?>
    <!-- 3. Responsive Pet Cards Grid (Adaptive 5-Screen Layout) -->
    <div class="row g-4 mb-5">
        <?php foreach ($pets as $pet): ?>
            <?php 
            $isLost = !empty($pet['is_lost']); 
            $score = $pet['care_score'] ?? 95;
            ?>
            <div class="col-12 col-md-6 col-xl-4">
                <div class="admin-card p-4 h-100 position-relative border d-flex flex-column justify-content-between shadow-sm <?= $isLost ? 'border-danger border-2' : '' ?>" style="border-radius: 20px;">
                    <div>
                        <!-- Lost Pet Top Banner if active -->
                        <?php if ($isLost): ?>
                            <div class="alert alert-danger p-2 px-3 mb-3 rounded-3 d-flex align-items-center justify-content-between small fw-bold">
                                <span><i class="fa-solid fa-triangle-exclamation me-1"></i> MARKED AS LOST</span>
                                <span class="badge bg-danger text-white">RECOVERY ACTIVE</span>
                            </div>
                        <?php endif; ?>

                        <!-- Avatar + Identity Header -->
                        <div class="d-flex gap-3 align-items-start mb-2">
                            <div class="position-relative flex-shrink-0">
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm" style="width: 72px; height: 72px; object-fit: contain; background: #fff8e5;">
                            </div>
                            <div class="flex-grow-1 overflow-hidden min-w-0">
                                <div class="d-flex justify-content-between align-items-center gap-1 mb-1">
                                    <h5 class="fw-bold text-dark m-0 text-truncate" style="font-family: var(--font-heading, inherit); font-size: 17px;"><?= ViewHelper::e($pet['name']) ?></h5>
                                    <div class="d-flex align-items-center gap-2 flex-shrink-0">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 11px;">
                                            <i class="fa-solid fa-shield-heart me-1"></i> <?= $score ?>/100
                                        </span>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle p-0 d-inline-flex align-items-center justify-content-center border shadow-sm" style="width: 32px; height: 32px; min-width: 32px; min-height: 32px;" data-bs-toggle="modal" data-bs-target="#deletePetModal<?= $pet['id'] ?>" title="Delete Pet">
                                            <i class="fa-regular fa-trash-can" style="font-size: 12px;"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center gap-1 flex-wrap mb-1">
                                    <span class="badge bg-dark text-warning rounded-pill px-2 py-0 font-monospace text-uppercase" style="font-size: 9.5px;">
                                        <?= ViewHelper::e($pet['species']) ?>
                                    </span>
                                    <span class="text-muted small text-truncate">
                                        <?= ViewHelper::e($pet['breed'] ?: 'Purebred/Mixed') ?> &bull; <?= ViewHelper::e($pet['gender']) ?>
                                    </span>
                                </div>
                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                    <span class="badge bg-light text-dark border font-monospace small"><i class="fa-solid fa-weight-scale text-primary me-1"></i><?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></span>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small"><i class="fa-solid fa-shield-halved me-1"></i> Passport Active</span>
                                </div>
                            </div>
                        </div>

                        <!-- Security Monospace Credentials Box -->
                        <div class="p-2 px-3 rounded-3 bg-light border my-3 small d-flex flex-column gap-1">
                            <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                <span class="text-muted text-nowrap"><i class="fa-solid fa-qrcode text-brand me-1"></i> QR Token:</span>
                                <code class="text-dark fw-bold text-truncate ms-2"><?= ViewHelper::e($pet['qr_token']) ?></code>
                            </div>
                            <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                <span class="text-muted text-nowrap"><i class="fa-solid fa-microchip text-primary me-1"></i> Microchip:</span>
                                <strong class="font-monospace text-dark text-truncate ms-2"><?= ViewHelper::e($pet['microchip_id'] ?: 'Pending / Unassigned') ?></strong>
                            </div>
                        </div>

                        <!-- Wellness Score Bar -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center small text-muted mb-1">
                                <span>Health Wellness Progress</span>
                                <span class="fw-bold text-success"><?= $score ?>%</span>
                            </div>
                            <div class="progress rounded-pill" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: <?= min(100, max(10, $score)) ?>%;"></div>
                            </div>
                        </div>

                        <?php 
                        $allergies = trim($pet['allergies'] ?? '');
                        if (!empty($allergies) && !in_array(strtolower($allergies), ['no', 'none', 'n/a', 'nil'])): 
                        ?>
                            <div class="mb-3 p-2 rounded-3 bg-danger-subtle text-danger border border-danger-subtle small fw-bold text-truncate">
                                <i class="fa-solid fa-triangle-exclamation me-1"></i> Allergy: <?= ViewHelper::e($allergies) ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Action Buttons Row (Precision 42px touch targets across all 5 screens) -->
                    <div class="d-flex gap-2 mt-auto pt-3 border-top align-items-center">
                        <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-admin-primary flex-grow-1 text-center text-decoration-none py-2 px-3 d-flex align-items-center justify-content-center gap-2 fw-bold shadow-sm" style="min-height: 42px; font-size: 13.5px; border-radius: 50px; white-space: nowrap;">
                            <i class="fa-solid fa-id-card-clip"></i>
                            <span>Pet Profile</span>
                        </a>
                        <a href="<?= ViewHelper::url('portal/passport/' . $pet['qr_token']) ?>" class="btn btn-outline-dark rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; padding: 0;" title="Digital QR Passport">
                            <i class="fa-solid fa-qrcode fs-6"></i>
                        </a>
                        <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-outline-danger rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; padding: 0;" title="Emergency Medical Card">
                            <i class="fa-solid fa-truck-medical fs-6"></i>
                        </a>
                    </div>

                </div>
            </div>

            <!-- Modal: Confirm Delete Pet -->
            <div class="modal fade" id="deletePetModal<?= $pet['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Delete Pet Profile</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/delete') ?>" method="POST">
                            <?= ViewHelper::csrfField() ?>
                            <div class="modal-body text-start">
                                <p class="text-dark">Are you sure you want to permanently remove <strong><?= ViewHelper::e($pet['name']) ?></strong> from your PetGuard account?</p>
                                <div class="p-3 bg-light rounded-3 border small text-muted mb-2">
                                    <i class="fa-solid fa-info-circle text-danger me-1"></i> This will delete all vaccination records, care routines, weigh-in histories, and deactivate the digital passport tag <code><?= ViewHelper::e($pet['qr_token']) ?></code>.
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Keep Pet</button>
                                <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold"><i class="fa-solid fa-trash me-1"></i> Yes, Delete Pet</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
