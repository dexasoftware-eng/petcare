<?php
use Helpers\ViewHelper;
?>

<!-- 1. Pet Profile Hero Banner -->
<div class="admin-card p-4 mb-4 border shadow-sm <?= !empty($pet['is_lost']) ? 'border-danger border-2' : '' ?>" style="border-radius: 20px;">
    <div class="d-flex flex-column flex-xl-row justify-content-between align-items-start align-items-xl-center gap-4">
        
        <!-- Left Identity -->
        <div class="d-flex gap-3 align-items-start align-items-sm-center flex-grow-1 min-w-0">
            <div class="flex-shrink-0">
                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm" style="width: 80px; height: 80px; object-fit: contain; background: #fff8e5;">
            </div>
            <div class="min-w-0 flex-grow-1">
                <div class="d-flex align-items-center gap-2 flex-wrap mb-1">
                    <h2 class="fw-bold text-dark m-0 text-truncate" style="font-family: var(--font-heading, inherit); font-size: 22px;"><?= ViewHelper::e($pet['name']) ?></h2>
                    <span class="badge bg-dark text-warning rounded-pill px-2 py-0 font-monospace text-uppercase" style="font-size: 10px;">
                        <?= ViewHelper::e($pet['species']) ?>
                    </span>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold" style="font-size: 11.5px;">
                        <i class="fa-solid fa-heart-pulse me-1"></i> Care Score: <?= $pet['care_score'] ?? 95 ?>/100
                    </span>
                    <?php if (!empty($pet['is_lost'])): ?>
                        <span class="badge bg-danger text-white text-uppercase px-2 py-1 fw-bold rounded-pill" style="font-size: 11px;"><i class="fa-solid fa-triangle-exclamation me-1"></i> LOST PET ACTIVE</span>
                    <?php endif; ?>
                </div>
                <div class="text-muted small text-truncate mb-2">
                    <?= ViewHelper::e($pet['breed'] ?: 'Mixed Breed') ?> &bull; <?= ViewHelper::e($pet['gender']) ?> &bull; <?= is_numeric($pet['age']) ? ViewHelper::e($pet['age']) . ' Years' : ViewHelper::e($pet['age']) ?>
                    <?php if (!empty($pet['birthday'])): ?> &bull; <i class="fa-solid fa-cake-candles text-warning me-1"></i> <?= date('M d, Y', strtotime($pet['birthday'])) ?><?php endif; ?>
                </div>
                <div class="d-flex gap-2 flex-wrap small align-items-center">
                    <span class="badge bg-light text-dark border font-monospace"><i class="fa-solid fa-microchip text-primary me-1"></i><?= ViewHelper::e($pet['microchip_id'] ?: 'Chip: Pending') ?></span>
                    <span class="badge bg-light text-dark border font-monospace"><i class="fa-solid fa-qrcode text-brand me-1"></i><?= ViewHelper::e($pet['qr_token']) ?></span>
                    <?php if (!empty($pet['color'])): ?><span class="badge bg-light text-dark border"><i class="fa-solid fa-palette text-secondary me-1"></i><?= ViewHelper::e($pet['color']) ?></span><?php endif; ?>
                    <span class="badge bg-light text-dark border font-monospace"><i class="fa-solid fa-weight-scale text-primary me-1"></i><?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></span>
                </div>
            </div>
        </div>

        <!-- Right Action Buttons (Dual-Mode: Desktop Toolbar & Mobile Grid) -->
        <div class="w-100 w-xl-auto pt-3 pt-xl-0 border-top border-xl-0 flex-shrink-0">
            
            <!-- Desktop / Tablet View (>=768px) -->
            <div class="d-none d-md-flex flex-wrap gap-2 align-items-center justify-content-xl-end">
                <a href="<?= ViewHelper::url('portal/passport/' . $pet['qr_token']) ?>" class="btn btn-admin-primary px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px; border-radius: 50px;">
                    <i class="fa-solid fa-passport"></i>
                    <span>Digital Passport</span>
                </a>
                <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-outline-danger px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px; border-radius: 50px;">
                    <i class="fa-solid fa-truck-medical"></i>
                    <span>Emergency Card</span>
                </a>
                <button type="button" class="btn btn-light border rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px;" data-bs-toggle="modal" data-bs-target="#editPetModal">
                    <i class="fa-solid fa-pen-to-square text-muted"></i>
                    <span>Edit</span>
                </button>
                <a href="<?= ViewHelper::url('portal/reports/health/' . $pet['id']) ?>" class="btn btn-light border rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px;" target="_blank">
                    <i class="fa-solid fa-print text-muted"></i>
                    <span>Dossier</span>
                </a>
                <?php if (empty($pet['is_lost'])): ?>
                    <button type="button" class="btn btn-danger rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px;" data-bs-toggle="modal" data-bs-target="#lostPetModal">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span>Mark Lost</span>
                    </button>
                <?php else: ?>
                    <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/found') ?>" method="POST" class="d-inline m-0">
                        <?= ViewHelper::csrfField() ?>
                        <button type="submit" class="btn btn-success rounded-pill px-3 py-2 fw-bold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-nowrap" style="min-height: 42px; font-size: 13px;">
                            <i class="fa-solid fa-shield-cat"></i>
                            <span>Mark Found</span>
                        </button>
                    </form>
                <?php endif; ?>
                <button type="button" class="btn btn-light text-danger rounded-circle d-inline-flex align-items-center justify-content-center border shadow-sm flex-shrink-0" style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; padding: 0;" data-bs-toggle="modal" data-bs-target="#deletePetDetailsModal" title="Delete Pet Profile">
                    <i class="fa-regular fa-trash-can fs-6"></i>
                </button>
            </div>

            <!-- Mobile View (<768px Structured 2-Tier Grid) -->
            <div class="d-md-none w-100">
                <div class="row g-2 mb-2">
                    <div class="col-6">
                        <a href="<?= ViewHelper::url('portal/passport/' . $pet['qr_token']) ?>" class="btn btn-admin-primary w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold shadow-sm" style="min-height: 44px; font-size: 13px; border-radius: 12px;">
                            <i class="fa-solid fa-passport"></i>
                            <span>Passport</span>
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-outline-danger w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-semibold shadow-sm" style="min-height: 44px; font-size: 13px; border-radius: 12px;">
                            <i class="fa-solid fa-truck-medical"></i>
                            <span>Emergency</span>
                        </a>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-4">
                        <button type="button" class="btn btn-light border w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-semibold text-dark shadow-sm" style="min-height: 40px; font-size: 12.5px; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#editPetModal">
                            <i class="fa-solid fa-pen-to-square text-muted"></i>
                            <span>Edit</span>
                        </button>
                    </div>
                    <div class="col-4">
                        <a href="<?= ViewHelper::url('portal/reports/health/' . $pet['id']) ?>" target="_blank" class="btn btn-light border w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-semibold text-dark shadow-sm" style="min-height: 40px; font-size: 12.5px; border-radius: 10px;">
                            <i class="fa-solid fa-print text-muted"></i>
                            <span>Dossier</span>
                        </a>
                    </div>
                    <div class="col-4">
                        <button type="button" class="btn btn-light border text-danger w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-semibold shadow-sm" style="min-height: 40px; font-size: 12.5px; border-radius: 10px;" data-bs-toggle="modal" data-bs-target="#deletePetDetailsModal">
                            <i class="fa-regular fa-trash-can"></i>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
                <?php if (!empty($pet['is_lost'])): ?>
                    <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/found') ?>" method="POST" class="mt-2">
                        <?= ViewHelper::csrfField() ?>
                        <button type="submit" class="btn btn-success w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 rounded-3 shadow-sm" style="min-height: 42px;">
                            <i class="fa-solid fa-shield-cat"></i>
                            <span>Mark Found (Recovered)</span>
                        </button>
                    </form>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<!-- 2. Responsive 10-Tab Navigation Bar -->
<div class="admin-card mb-4 p-2 shadow-sm" style="border-radius: 20px;">
    <ul class="nav nav-tabs-responsive" id="petTabs" role="tablist">
        <li class="nav-item">
            <button class="nav-link active rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-overview"><i class="fa-solid fa-paw me-1"></i> Overview</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-health"><i class="fa-solid fa-heart-pulse me-1"></i> Health &amp; Wellness</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-vaccines"><i class="fa-solid fa-syringe me-1"></i> Vaccines (<?= count($vaccines ?? []) ?>)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-meds"><i class="fa-solid fa-pills me-1"></i> Medications (<?= count($medications ?? []) ?>)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-care"><i class="fa-solid fa-list-check me-1"></i> Care Tasks (<?= count($careTasks ?? []) ?>)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-weight"><i class="fa-solid fa-weight-scale me-1"></i> Weight Tracking</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-docs"><i class="fa-solid fa-folder-closed me-1"></i> Documents (<?= count($documents ?? []) ?>)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-appts"><i class="fa-solid fa-calendar-check me-1"></i> Appointments (<?= count($appointments ?? []) ?>)</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-family"><i class="fa-solid fa-people-roof me-1"></i> Family Sharing</button>
        </li>
        <li class="nav-item">
            <button class="nav-link rounded-pill fw-bold" data-bs-toggle="tab" data-bs-target="#tab-timeline"><i class="fa-solid fa-timeline me-1"></i> Timeline</button>
        </li>
    </ul>
</div>

<!-- 3. Tab Contents -->
<div class="tab-content" id="petTabsContent">
    
    <!-- TAB 1: OVERVIEW -->
    <div class="tab-pane fade show active" id="tab-overview">
        <div class="row g-4 align-items-start">
            
            <!-- Left: Pet Bio & Identification -->
            <div class="col-lg-6">
                <div class="admin-card p-4 shadow-sm" style="border-radius: 20px;">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex align-items-center gap-2">
                                <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                                    <i class="fa-solid fa-id-card"></i>
                                </div>
                                <h5 class="fw-bold text-dark m-0">Pet Bio &amp; Identification</h5>
                            </div>
                            <span class="badge bg-light text-dark border">Bio Dossier</span>
                        </div>

                        <!-- 6-Metric Key-Value Grid (Single-Line Flex Rows) -->
                        <div class="row g-2 mb-3">
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-paw text-brand me-1"></i> Species:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['species']) ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-dna text-primary me-1"></i> Breed:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['breed'] ?: 'Mixed / Unknown') ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-venus-mars text-purple me-1"></i> Gender:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['gender']) ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-hourglass-half text-warning me-1"></i> Age:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= is_numeric($pet['age']) ? ViewHelper::e($pet['age']) . ' Years' : ViewHelper::e($pet['age']) ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-weight-scale text-success me-1"></i> Weight:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></strong>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="p-2 px-3 rounded-3 bg-light border d-flex justify-content-between align-items-center flex-nowrap small">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-droplet text-danger me-1"></i> Blood Group:</span>
                                    <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['blood_group'] ?: 'Type A') ?></strong>
                                </div>
                            </div>
                        </div>

                        <!-- Allergies Notice Box -->
                        <?php 
                        $hasAllergies = !empty($pet['allergies']) && !in_array(strtolower(trim($pet['allergies'])), ['no', 'none', 'n/a', 'nil', 'false']);
                        ?>
                        <div class="p-3 rounded-3 border mb-2 <?= $hasAllergies ? 'bg-danger-subtle border-danger-subtle' : 'bg-light' ?>">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <span class="small fw-bold <?= $hasAllergies ? 'text-danger' : 'text-dark' ?>">
                                    <i class="fa-solid fa-shield-virus me-1 text-danger"></i> Allergies &amp; Medical Warnings:
                                </span>
                                <?php if ($hasAllergies): ?>
                                    <span class="badge bg-danger text-white text-uppercase" style="font-size: 9.5px;">Caution Active</span>
                                <?php else: ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 9.5px;">No Known Allergies</span>
                                <?php endif; ?>
                            </div>
                            <div class="small fw-semibold <?= $hasAllergies ? 'text-danger' : 'text-muted' ?>">
                                <?= ViewHelper::e($pet['allergies'] ?: 'No medical or food allergies recorded.') ?>
                            </div>
                        </div>

                        <!-- Feeding Instructions Box -->
                        <div class="p-3 rounded-3 bg-light border">
                            <div class="small fw-bold text-dark mb-1">
                                <i class="fa-solid fa-bowl-food me-1 text-warning"></i> Feeding &amp; Daily Dietary Routine:
                            </div>
                            <div class="small text-muted" style="line-height: 1.5;">
                                <?= ViewHelper::e($pet['diet_instructions'] ?: 'Standard balanced nutrition twice daily with fresh water.') ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Digital Passport & QR Tag -->
            <div class="col-lg-6">
                <div class="admin-card p-4 shadow-sm" style="border-radius: 20px;">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2 flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                                    <i class="fa-solid fa-qrcode"></i>
                                </div>
                                <h5 class="fw-bold text-dark m-0">Digital Passport &amp; QR Tag</h5>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 text-uppercase fw-bold" style="font-size: 11px;">
                                <i class="fa-solid fa-shield-halved me-1"></i> Active
                            </span>
                        </div>
                        <p class="small text-muted mb-3" style="line-height: 1.5;">
                            The cryptographic QR code enables emergency responders and finders to view emergency medical data without exposing private account credentials.
                        </p>

                        <!-- Centered QR Box -->
                        <?php 
                        $qrTargetUrl = ViewHelper::url('pet-passport/' . $pet['qr_token']);
                        $qrImgUrl = "https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=4&data=" . urlencode($qrTargetUrl);
                        ?>
                        <div class="p-3 bg-light rounded-4 border text-center my-3">
                            <div class="d-inline-block p-2 bg-white rounded-3 border shadow-sm mb-2">
                                <img src="<?= $qrImgUrl ?>" alt="QR Code for <?= ViewHelper::e($pet['name']) ?>" style="width: 128px; height: 128px; display: block;" loading="lazy">
                            </div>
                            <div class="fs-5 fw-bold font-monospace text-brand tracking-wider"><?= ViewHelper::e($pet['qr_token']) ?></div>
                            <small class="text-muted d-block mt-1"><i class="fa-solid fa-shield-check text-success me-1"></i> Universal PetGuard QR Identifier &bull; Cryptographically Verified</small>
                        </div>
                    </div>

                    <div class="d-flex gap-2 flex-wrap pt-2">
                        <a href="<?= ViewHelper::url('portal/passport/' . $pet['qr_token']) ?>" class="btn btn-admin-primary flex-grow-1 fw-bold text-center py-2 px-3 d-flex align-items-center justify-content-center gap-2" style="min-height: 42px;">
                            <i class="fa-solid fa-passport"></i>
                            <span>Open Full Passport</span>
                        </a>
                        <a href="<?= ViewHelper::url('pet-passport/' . $pet['qr_token']) ?>" target="_blank" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm" style="min-height: 42px;" title="Open Public Scanner Page">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                            <span>Scanner View</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- TAB 2: HEALTH & WELLNESS -->
    <div class="tab-pane fade" id="tab-health">
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <div class="admin-card p-4 shadow-sm" style="border-radius: 20px;">
                    <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-shield-heart text-brand me-2"></i> Preventive Care Wellness Score</h5>
                    <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-4 mb-3 border">
                        <div class="fs-1 fw-bold text-success" style="font-family: var(--font-heading, inherit);"><?= $pet['care_score'] ?? 95 ?>/100</div>
                        <div>
                            <div class="fw-bold text-dark fs-6">Optimal Health Rating</div>
                            <small class="text-muted">Calculated from verified vaccinations, microchip registry, and care routine adherence.</small>
                        </div>
                    </div>
                    <div class="small d-flex flex-column gap-2">
                        <div class="d-flex justify-content-between"><span>Vaccination Compliance</span><span class="text-success fw-bold">100% (+40 pts)</span></div>
                        <div class="progress rounded-pill" style="height: 5px;"><div class="progress-bar bg-success" style="width: 100%;"></div></div>
                        
                        <div class="d-flex justify-content-between mt-1"><span>Microchip Registry</span><span class="text-success fw-bold">Verified (+25 pts)</span></div>
                        <div class="progress rounded-pill" style="height: 5px;"><div class="progress-bar bg-success" style="width: 100%;"></div></div>
                        
                        <div class="d-flex justify-content-between mt-1"><span>Care Routine Adherence</span><span class="text-success fw-bold">95% (+20 pts)</span></div>
                        <div class="progress rounded-pill" style="height: 5px;"><div class="progress-bar bg-success" style="width: 95%;"></div></div>
                        
                        <div class="d-flex justify-content-between mt-1"><span>Digital Passport Integrity</span><span class="text-success fw-bold">Active (+15 pts)</span></div>
                        <div class="progress rounded-pill" style="height: 5px;"><div class="progress-bar bg-success" style="width: 100%;"></div></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="admin-card p-4 shadow-sm" style="border-radius: 20px;">
                    <div>
                        <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-stethoscope text-brand me-2"></i> Clinical Actions</h6>
                        <p class="small text-muted mb-4">Keep all vaccinations and preventive prescriptions synchronized with your registered clinic.</p>
                        <div class="d-flex flex-column gap-2">
                            <button class="btn btn-admin-primary w-100 py-2 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="min-height: 44px;" data-bs-toggle="modal" data-bs-target="#vaccineModal">
                                <i class="fa-solid fa-syringe"></i>
                                <span>+ Log Vaccination</span>
                            </button>
                            <button class="btn btn-outline-secondary w-100 rounded-pill py-2 fw-semibold d-flex align-items-center justify-content-center gap-2 shadow-sm" style="min-height: 44px;" data-bs-toggle="modal" data-bs-target="#medicationModal">
                                <i class="fa-solid fa-pills"></i>
                                <span>+ Log Medication</span>
                            </button>
                        </div>
                    </div>
                    <div class="p-3 bg-light rounded-3 border small text-muted mt-3">
                        <i class="fa-solid fa-info-circle text-primary me-1"></i> Logged medical events are automatically stamped into your pet's permanent encrypted dossier.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 3: VACCINES -->
    <div class="tab-pane fade" id="tab-vaccines">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-orange" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-syringe"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Immunization &amp; Vaccine History</h5>
                        <p class="text-muted small m-0">Official clinical immunizations, booster dates, and health compliance tracking.</p>
                    </div>
                </div>
                <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#vaccineModal">
                    <i class="fa-solid fa-plus me-1"></i> Add Vaccine
                </button>
            </div>
            <?php if (empty($vaccines)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-orange mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-syringe"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Vaccination Records Logged</h6>
                    <p class="small text-muted mb-3">Keep your companion protected against core diseases by recording their immunizations.</p>
                    <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#vaccineModal">
                        <i class="fa-solid fa-plus me-1"></i> Record First Vaccine
                    </button>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Vaccine Name</th>
                                <th>Dose / Stage</th>
                                <th>Administered</th>
                                <th>Next Due Date</th>
                                <th>Clinic / Doctor</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($vaccines as $v): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-shield-virus text-brand"></i>
                                            <strong class="text-dark"><?= ViewHelper::e($v['vaccine_name']) ?></strong>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($v['dose_number'] ?? 'Standard') ?></span></td>
                                    <td><i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($v['administered_date'])) ?></td>
                                    <td>
                                        <?php if (!empty($v['next_due_date'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="fa-regular fa-clock me-1"></i> <?= date('M d, Y', strtotime($v['next_due_date'])) ?></span>
                                        <?php else: ?>
                                            <span class="text-muted">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($v['administering_vet'] ?? 'Licensed Clinic') ?></td>
                                    <td class="text-end pe-4">
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Vaccine"
                                            data-confirm-delete
                                            data-action="<?= ViewHelper::url('portal/vaccinations/' . $v['id'] . '/delete') ?>"
                                            data-redirect="portal/pets/<?= $pet['id'] ?>?tab=vaccines"
                                            data-title="Delete Vaccination Record?"
                                            data-message="Are you sure you want to remove the &quot;<?= ViewHelper::e($v['vaccine_name']) ?>&quot; vaccination record from <?= ViewHelper::e($pet['name']) ?>'s profile?">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 4: MEDICATIONS -->
    <div class="tab-pane fade" id="tab-meds">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-purple" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Prescriptions &amp; Active Medications</h5>
                        <p class="text-muted small m-0">Active medical treatments, dosage frequencies, and administration logs.</p>
                    </div>
                </div>
                <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#medicationModal">
                    <i class="fa-solid fa-plus me-1"></i> Add Medication
                </button>
            </div>
            <?php if (empty($medications)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-purple mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Active Prescriptions</h6>
                    <p class="small text-muted mb-3">Keep track of ongoing medications, dosages, and daily reminder schedules.</p>
                    <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#medicationModal">
                        <i class="fa-solid fa-plus me-1"></i> Add Medication
                    </button>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Medication Name</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                                <th>Instructions / Notes</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($medications as $m): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-prescription-bottle-medical text-brand"></i>
                                            <strong class="text-dark"><?= ViewHelper::e($m['name']) ?></strong>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($m['dosage']) ?></span></td>
                                    <td><?= ViewHelper::e($m['frequency']) ?></td>
                                    <td class="small text-muted"><?= ViewHelper::e($m['instructions'] ?: 'Standard prescription routine') ?></td>
                                    <td><span class="badge bg-success-subtle text-success border border-success-subtle">Active</span></td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <?php
                                                $doseLimit = \Models\PetMedication::getDoseLimit($m['frequency'] ?? 'Once daily');
                                                $dosesGiven = \Models\PetMedication::getDosesGivenToday($m);
                                                $isDoseDone = \Models\PetMedication::isDoseLimitReached($m);
                                            ?>
                                            <?php if ($isDoseDone): ?>
                                                <button type="button" class="btn btn-sm btn-light text-success border border-success-subtle px-3 py-1 fw-bold rounded-pill shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 12px; min-height: 34px; cursor: default;" title="All required doses (<?= $dosesGiven ?>/<?= $doseLimit ?>) completed for today">
                                                    <i class="fa-solid fa-circle-check"></i> Given Today <?= $doseLimit < 999 ? "({$dosesGiven}/{$doseLimit})" : "" ?>
                                                </button>
                                            <?php else: ?>
                                                <form action="<?= ViewHelper::url('portal/medications/' . $m['id'] . '/administer') ?>" method="POST" class="m-0">
                                                    <?= ViewHelper::csrfField() ?>
                                                    <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=meds">
                                                    <button type="submit" class="btn btn-sm btn-admin-primary px-3 py-1 fw-bold rounded-pill shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 12px; min-height: 34px;">
                                                        <i class="fa-solid fa-check"></i> Give Dose <?= ($doseLimit > 1 && $doseLimit < 999) ? "({$dosesGiven}/{$doseLimit})" : "" ?>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Medication"
                                                data-confirm-delete
                                                data-action="<?= ViewHelper::url('portal/medications/' . $m['id'] . '/delete') ?>"
                                                data-redirect="portal/pets/<?= $pet['id'] ?>?tab=meds"
                                                data-title="Remove Medication Prescription?"
                                                data-message="Are you sure you want to remove &quot;<?= ViewHelper::e($m['name']) ?>&quot; from the active prescription schedule?">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 5: CARE TASKS -->
    <div class="tab-pane fade" id="tab-care">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-blue" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Daily Routines &amp; Care Tasks</h5>
                        <p class="text-muted small m-0">Scheduled feedings, walks, grooming, and hygiene checklist.</p>
                    </div>
                </div>
                <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#careTaskModal">
                    <i class="fa-solid fa-plus me-1"></i> Add Task
                </button>
            </div>
            <?php if (empty($careTasks)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-blue mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Routines Set Up</h6>
                    <p class="small text-muted mb-3">Create daily care tasks to stay organized with your companion's needs.</p>
                    <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#careTaskModal">
                        <i class="fa-solid fa-plus me-1"></i> Add First Routine
                    </button>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4" style="width: 60px;">Status</th>
                                <th>Task Description</th>
                                <th>Type</th>
                                <th>Time Due</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($careTasks as $t): ?>
                                <tr>
                                    <td class="ps-4">
                                        <form action="<?= ViewHelper::url('portal/care/tasks/' . $t['id'] . '/toggle') ?>" method="POST" class="m-0">
                                            <?= ViewHelper::csrfField() ?>
                                            <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=care">
                                            <button type="submit" class="btn btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center shadow-sm <?= $t['is_completed'] ? 'btn-success' : 'btn-outline-secondary' ?>" style="width: 30px; height: 30px; min-width: 30px;" title="Toggle Complete">
                                                <i class="fa-solid fa-check <?= $t['is_completed'] ? 'text-white' : 'text-muted' ?>" style="font-size: 12px;"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <strong class="<?= $t['is_completed'] ? 'text-decoration-line-through text-muted' : 'text-dark' ?>"><?= ViewHelper::e($t['title']) ?></strong>
                                    </td>
                                    <td><span class="badge bg-light text-dark border text-capitalize"><?= ViewHelper::e($t['task_type'] ?? 'routine') ?></span></td>
                                    <td><i class="fa-regular fa-clock text-brand me-1"></i> <?= ViewHelper::e($t['time_due']) ?> (<?= ucfirst($t['frequency']) ?>)</td>
                                    <td class="text-end pe-4">
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Task"
                                            data-confirm-delete
                                            data-action="<?= ViewHelper::url('portal/care/tasks/' . $t['id'] . '/delete') ?>"
                                            data-redirect="portal/pets/<?= $pet['id'] ?>?tab=care"
                                            data-title="Delete Daily Care Routine?"
                                            data-message="Are you sure you want to remove &quot;<?= ViewHelper::e($t['title']) ?>&quot; from <?= ViewHelper::e($pet['name']) ?>'s schedule?">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 6: WEIGHT & GROWTH -->
    <div class="tab-pane fade" id="tab-weight">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-green" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-weight-scale"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Weight &amp; Lifecycle Growth Logs</h5>
                        <p class="text-muted small m-0">Periodic weigh-ins to ensure healthy metabolic companion development.</p>
                    </div>
                </div>
                <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#weightModal">
                    <i class="fa-solid fa-plus me-1"></i> Record Weight
                </button>
            </div>
            <?php if (empty($weights)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-green mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-weight-scale"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Weight History Logged</h6>
                    <p class="small text-muted mb-3">Track regular weight measurements to monitor vitality and growth trends.</p>
                    <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#weightModal">
                        <i class="fa-solid fa-plus me-1"></i> Record Weight
                    </button>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Date Recorded</th>
                                <th>Weight (kg)</th>
                                <th>Health Notes</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($weights as $w): ?>
                                <tr>
                                    <td class="ps-4 fw-semibold"><i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($w['recorded_date'])) ?></td>
                                    <td><strong class="text-dark fs-6 font-monospace text-brand"><?= $w['weight_kg'] ?> kg</strong></td>
                                    <td class="text-muted small"><?= ViewHelper::e($w['notes'] ?: 'Regular health logging') ?></td>
                                    <td class="text-end pe-4">
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Weight Entry"
                                            data-confirm-delete
                                            data-action="<?= ViewHelper::url('portal/weights/' . $w['id'] . '/delete') ?>"
                                            data-redirect="portal/pets/<?= $pet['id'] ?>?tab=weight"
                                            data-title="Delete Weigh-in Entry?"
                                            data-message="Are you sure you want to delete the weigh-in record of <?= $w['weight_kg'] ?> kg recorded on <?= date('M d, Y', strtotime($w['recorded_date'])) ?>?">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 7: DOCUMENTS VAULT -->
    <div class="tab-pane fade" id="tab-docs">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-orange" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-folder-closed"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Encrypted Document Vault</h5>
                        <p class="text-muted small m-0">Stored rabies certificates, adoption agreements, lab panels, and insurance papers.</p>
                    </div>
                </div>
                <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#docModal">
                    <i class="fa-solid fa-plus me-1"></i> Store Document
                </button>
            </div>
            <?php if (empty($documents)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-orange mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-folder-closed"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Document Vault is Empty</h6>
                    <p class="small text-muted mb-3">Store digital copies of vaccine certificates, vet reports, and registration forms safely.</p>
                    <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#docModal">
                        <i class="fa-solid fa-plus me-1"></i> Upload First Document
                    </button>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Document Title</th>
                                <th>Category</th>
                                <th>File Size</th>
                                <th class="text-end pe-4">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($documents as $d): ?>
                                <?php
                                    $ext = strtolower(pathinfo($d['file_path'] ?? '', PATHINFO_EXTENSION));
                                    $iconClass = 'fa-file-pdf text-danger';
                                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) $iconClass = 'fa-file-image text-primary';
                                    elseif (in_array($ext, ['doc', 'docx'])) $iconClass = 'fa-file-word text-info';
                                ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <i class="fa-solid <?= $iconClass ?> fs-4"></i>
                                            <div>
                                                <strong class="text-dark d-block"><?= ViewHelper::e($d['title']) ?></strong>
                                                <a href="<?= ViewHelper::url('portal/documents/' . $d['id'] . '/download') ?>" class="small text-brand text-decoration-none fw-semibold">
                                                    <i class="fa-solid fa-download me-1"></i> View / Download
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-light text-dark border text-uppercase"><?= strtoupper(str_replace('_', ' ', $d['doc_type'])) ?></span></td>
                                    <td class="text-muted small font-monospace"><?= $d['file_size'] ?? '1.2 MB' ?></td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex align-items-center gap-2">
                                            <a href="<?= ViewHelper::url('portal/documents/' . $d['id'] . '/download') ?>" class="btn btn-sm btn-light text-brand rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Download Document">
                                                <i class="fa-solid fa-download"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Document"
                                                data-confirm-delete
                                                data-action="<?= ViewHelper::url('portal/documents/' . $d['id'] . '/delete') ?>"
                                                data-redirect="portal/pets/<?= $pet['id'] ?>?tab=docs"
                                                data-title="Remove Document from Vault?"
                                                data-message="Are you sure you want to remove &quot;<?= ViewHelper::e($d['title']) ?>&quot; from your encrypted vault?">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 8: APPOINTMENTS -->
    <div class="tab-pane fade" id="tab-appts">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-blue" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Clinical Appointment History</h5>
                        <p class="text-muted small m-0">Veterinary consultations, checkup schedules, and clinic diagnostic notes.</p>
                    </div>
                </div>
                <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;">
                    <i class="fa-solid fa-plus me-1"></i> Book Consultation
                </a>
            </div>
            <?php if (empty($appointments)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-blue mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Consultations Booked</h6>
                    <p class="small text-muted mb-3">Connect directly with licensed veterinarians for routine examinations or emergency care.</p>
                    <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;">
                        <i class="fa-solid fa-plus me-1"></i> Book Consultation
                    </a>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Date &amp; Time</th>
                                <th>Consultation Type</th>
                                <th>Doctor / Clinic</th>
                                <th>Symptoms / Notes</th>
                                <th class="pe-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $a): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-dark"><i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($a['appointment_date'])) ?> (<?= ViewHelper::e($a['appointment_time']) ?>)</td>
                                    <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($a['consultation_type']) ?></span></td>
                                    <td><i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($a['vet_name'] ?? ($a['clinic_name'] ?? 'Assigned Doctor')) ?></td>
                                    <td class="small text-muted"><?= ViewHelper::e($a['symptoms']) ?></td>
                                    <td class="pe-4"><span class="badge bg-success-subtle text-success border border-success-subtle text-uppercase"><?= ucfirst($a['status']) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 9: FAMILY & SITTER SHARING -->
    <div class="tab-pane fade" id="tab-family">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-purple" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Family &amp; Pet Sitter Access</h5>
                        <p class="text-muted small m-0">Share daily tasks, medical logs, and emergency tags with trusted co-guardians.</p>
                    </div>
                </div>
                <a href="<?= ViewHelper::url('portal/family') ?>" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;">
                    <i class="fa-solid fa-plus me-1"></i> Manage Family
                </a>
            </div>
            <?php if (empty($family)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-purple mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Shared Guardians</h6>
                    <p class="small text-muted mb-3">Invite family members, roommates, or trusted sitters to collaborate on companion care.</p>
                    <a href="<?= ViewHelper::url('portal/family') ?>" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;">
                        <i class="fa-solid fa-plus me-1"></i> Invite Family Member
                    </a>
                </div>
            <?php else: ?>
                <div class="admin-table-container">
                    <table class="admin-table align-middle">
                        <thead>
                            <tr>
                                <th class="ps-4">Member Name</th>
                                <th>Email Address</th>
                                <th>Relationship</th>
                                <th class="pe-4">Access Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($family as $f): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold text-brand" style="width: 32px; height: 32px; font-size: 12px;">
                                                <?= strtoupper(substr($f['member_name'] ?? 'M', 0, 1)) ?>
                                            </div>
                                            <strong class="text-dark"><?= ViewHelper::e($f['member_name']) ?></strong>
                                        </div>
                                    </td>
                                    <td><i class="fa-regular fa-envelope text-muted me-1"></i> <?= ViewHelper::e($f['member_email']) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($f['relationship']) ?></span></td>
                                    <td class="pe-4"><span class="badge bg-light text-dark border text-uppercase"><?= strtoupper(str_replace('_', ' ', $f['access_level'])) ?></span></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- TAB 10: ACTIVITY TIMELINE -->
    <div class="tab-pane fade" id="tab-timeline">
        <div class="admin-card shadow-sm" style="border-radius: 20px; overflow: hidden;">
            <div class="p-4 border-bottom bg-white">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-card-icon icon-blue" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                        <i class="fa-solid fa-timeline"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Chronological Health Timeline</h5>
                        <p class="text-muted small m-0">Timestamped activity log across medical appointments, vaccines, and registrations.</p>
                    </div>
                </div>
            </div>
            <?php if (empty($timeline)): ?>
                <div class="p-5 text-center text-muted">
                    <div class="stat-card-icon icon-blue mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-timeline"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Activity History Recorded</h6>
                    <p class="small text-muted">Events, vaccinations, and weigh-ins will automatically populate this chronological history.</p>
                </div>
            <?php else: ?>
                <div class="p-4 d-flex flex-column gap-3">
                    <?php foreach ($timeline as $item): ?>
                        <div class="p-3 rounded-4 border bg-light d-flex align-items-start gap-3 shadow-sm">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-brand bg-white border shadow-sm flex-shrink-0" style="width: 38px; height: 38px; min-width: 38px;">
                                <i class="fa-solid <?= $item['icon'] ?> small"></i>
                            </div>
                            <div class="flex-grow-1 min-w-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h6 class="fw-bold text-dark m-0"><?= ViewHelper::e($item['title']) ?></h6>
                                    <span class="text-muted small"><?= date('M d, Y', strtotime($item['date'])) ?></span>
                                </div>
                                <small class="text-muted d-block mt-1"><?= ViewHelper::e($item['description']) ?></small>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<!-- Modal: Edit Pet Profile -->
<div class="modal fade" id="editPetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Pet Profile: <?= ViewHelper::e($pet['name']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/update') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Pet Name *</label>
                            <input type="text" name="name" class="form-control rounded-3" value="<?= ViewHelper::e($pet['name']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Age *</label>
                            <input type="text" name="age" class="form-control rounded-3" value="<?= ViewHelper::e($pet['age']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-bold">Weight *</label>
                            <input type="text" name="weight" class="form-control rounded-3" value="<?= ViewHelper::e($pet['weight']) ?>" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Birthday</label>
                            <input type="date" name="birthday" class="form-control rounded-3" value="<?= $pet['birthday'] ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Color / Coat</label>
                            <input type="text" name="color" class="form-control rounded-3" value="<?= ViewHelper::e($pet['color'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Microchip Number</label>
                            <input type="text" name="microchip_id" class="form-control rounded-3" value="<?= ViewHelper::e($pet['microchip_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Allergies</label>
                            <input type="text" name="allergies" class="form-control rounded-3" value="<?= ViewHelper::e($pet['allergies'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Diet Instructions</label>
                            <input type="text" name="diet_instructions" class="form-control rounded-3" value="<?= ViewHelper::e($pet['diet_instructions'] ?? '') ?>">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Log Vaccine -->
<div class="modal fade" id="vaccineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-syringe text-brand me-2"></i> Log Vaccination: <?= ViewHelper::e($pet['name']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/vaccinations/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=vaccines">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Vaccine Name *</label>
                        <input type="text" name="vaccine_name" class="form-control rounded-3" required placeholder="e.g. Rabies 3-Year, DHPP Booster">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Date Administered *</label>
                            <input type="date" name="administered_date" class="form-control rounded-3" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Next Due Date</label>
                            <input type="date" name="next_due_date" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Administering Veterinarian / Clinic</label>
                        <input type="text" name="administering_vet" class="form-control rounded-3" placeholder="e.g. Dr. Sarah Jenkins">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">Save Vaccine</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Log Medication -->
<div class="modal fade" id="medicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pills text-brand me-2"></i> Log Medication: <?= ViewHelper::e($pet['name']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/medications/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=meds">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Medication Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Cosequin DS, Amoxicillin">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Dosage *</label>
                            <input type="text" name="dosage" class="form-control rounded-3" required placeholder="e.g. 1 Tablet, 5mg">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Frequency *</label>
                            <input type="text" name="frequency" class="form-control rounded-3" required placeholder="e.g. Once daily">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Instructions / Food Notes</label>
                        <textarea name="instructions" rows="2" class="form-control rounded-3" placeholder="e.g. Give with morning breakfast"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">Save Medication</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Care Task -->
<div class="modal fade" id="careTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-list-check text-brand me-2"></i> Add Care Task for <?= ViewHelper::e($pet['name']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/care/tasks/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=care">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Task Title *</label>
                        <input type="text" name="title" class="form-control rounded-3" required placeholder="e.g. Evening Brushing, Ear Cleaning">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Task Type</label>
                            <select name="task_type" class="form-select rounded-3">
                                <option value="feeding">Feeding</option>
                                <option value="walking">Walking / Exercise</option>
                                <option value="grooming">Grooming</option>
                                <option value="medication">Medication</option>
                                <option value="dental">Dental Hygiene</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Time Due</label>
                            <input type="text" name="time_due" class="form-control rounded-3" value="08:00 AM">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">Add Task</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Record Weight -->
<div class="modal fade" id="weightModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-weight-scale text-brand me-2"></i> Record Weight: <?= ViewHelper::e($pet['name']) ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/weights/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=weight">
                <div class="modal-body">
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Weight (kg) *</label>
                            <input type="number" step="0.1" name="weight_kg" class="form-control rounded-3" required placeholder="e.g. 24.5">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Date *</label>
                            <input type="date" name="recorded_date" class="form-control rounded-3" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notes</label>
                        <input type="text" name="notes" class="form-control rounded-3" placeholder="e.g. Monthly wellness check">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4">Save Weight</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Store Document -->
<div class="modal fade" id="docModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-file-arrow-up text-brand me-2"></i> Upload Document to Vault</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/documents/create') ?>" method="POST" enctype="multipart/form-data">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="redirect" value="portal/pets/<?= $pet['id'] ?>?tab=docs">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Document Title *</label>
                        <input type="text" name="title" class="form-control rounded-3" required placeholder="e.g. 2026 Rabies Certificate, Lab Report">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Category</label>
                        <select name="doc_type" class="form-select rounded-3">
                            <option value="vaccine_cert">Vaccination Certificate</option>
                            <option value="medical_report">Medical / Vet Report</option>
                            <option value="adoption_papers">Adoption Agreement</option>
                            <option value="insurance">Insurance Policy</option>
                            <option value="lab_results">Lab Results</option>
                            <option value="other">Other Document</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select File (PDF, Image, Word DOC) *</label>
                        <input type="file" name="document_file" class="form-control rounded-3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted" style="font-size: 11px;">Supported formats: PDF, JPG, PNG, DOC, DOCX (Max 10MB)</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Store Document</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Lost Pet Alert -->
<div class="modal fade" id="lostPetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0 text-danger">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i> Activate Lost Pet Alert Mode</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/lost') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body">
                    <p class="small text-muted">When Lost Pet Mode is active, public scans of <?= ViewHelper::e($pet['name']) ?>'s QR passport will immediately display your emergency contact number and recovery instructions.</p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Last Seen Location *</label>
                        <input type="text" name="lost_location" class="form-control rounded-3" required placeholder="e.g. Elm Street Park, near Oakwood intersection">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Special Instructions / Distinct Features</label>
                        <textarea name="lost_notes" rows="2" class="form-control rounded-3" placeholder="e.g. Wearing red collar. Friendly but shy. Please call immediately."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Activate Lost Mode</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Confirm Delete Pet -->
<div class="modal fade" id="deletePetDetailsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-danger"><i class="fa-solid fa-triangle-exclamation me-2"></i> Delete Pet Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/delete') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body text-start">
                    <p class="text-dark">Are you sure you want to permanently remove <strong><?= ViewHelper::e($pet['name']) ?></strong> from your PetGuard family?</p>
                    <div class="p-3 bg-light rounded-3 border small text-muted mb-2">
                        <i class="fa-solid fa-info-circle text-danger me-1"></i> This will delete all vaccination records, active medications, care routines, weigh-in histories, and deactivate the digital passport tag <code><?= ViewHelper::e($pet['qr_token']) ?></code>.
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

<!-- JavaScript: Dynamic Tab Preservation & URL Sync -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Activate tab from URL query param (?tab=...) or hash (#tab-...)
    const params = new URLSearchParams(window.location.search);
    let tabParam = params.get('tab');
    let targetTabId = '';
    
    if (tabParam) {
        targetTabId = tabParam.startsWith('tab-') ? tabParam : 'tab-' + tabParam;
    } else if (window.location.hash) {
        targetTabId = window.location.hash.replace('#', '');
    }
    
    if (targetTabId) {
        const triggerEl = document.querySelector(`#petTabs button[data-bs-target="#${targetTabId}"]`);
        if (triggerEl && typeof bootstrap !== 'undefined') {
            const tabInstance = bootstrap.Tab.getOrCreateInstance(triggerEl);
            tabInstance.show();
        }
    }

    // 2. On click of any tab, update URL query param without full reload
    const tabButtons = document.querySelectorAll('#petTabs button[data-bs-toggle="tab"]');
    tabButtons.forEach(function(btn) {
        btn.addEventListener('shown.bs.tab', function(e) {
            const rawTarget = e.target.getAttribute('data-bs-target') || '';
            const cleanId = rawTarget.replace('#tab-', '').replace('#', '');
            if (cleanId) {
                const url = new URL(window.location);
                url.searchParams.set('tab', cleanId);
                window.history.replaceState({}, '', url);
            }
        });
    });
});
</script>
