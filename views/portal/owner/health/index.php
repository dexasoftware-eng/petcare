<?php
use Helpers\ViewHelper;

$totalPets = count($pets ?? []);
$totalMeds = count($medications ?? []);
$totalVaccines = count($vaccines ?? []);
$avgCareScore = $totalPets > 0 ? round(array_sum(array_column($pets, 'care_score')) / $totalPets) : 95;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-heart-pulse text-warning"></i>
            <span>Preventive Veterinary Wellness</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= $avgCareScore ?>/100 Avg Care Score</span>
        </div>
        <h2 class="portal-hero-title">Health, Vaccines &amp; Rx 🩺</h2>
        <p class="portal-hero-subtitle">
            Comprehensive pet clinical wellness telemetry, vaccine history, and smart medication dosing tracker.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/care') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-list-check"></i>
            <span>Care Routine</span>
        </a>
        <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-calendar-plus"></i>
            <span>Book Clinic</span>
        </a>
    </div>
</div>

<!-- 2. Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-blue">
                <i class="fa-solid fa-shield-dog"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $totalPets ?></div>
                <div class="stat-card-label">Registered Companions</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-purple">
                <i class="fa-solid fa-pills"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $totalMeds ?></div>
                <div class="stat-card-label">Active Prescriptions</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-green">
                <i class="fa-solid fa-syringe"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $totalVaccines ?></div>
                <div class="stat-card-label">Vaccine Records</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-orange">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $avgCareScore ?>/100</div>
                <div class="stat-card-label">Avg Wellness Score</div>
            </div>
        </div>
    </div>
</div>

<!-- Pets Health Matrix Cards -->
<div class="admin-card shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-orange" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                <i class="fa-solid fa-heart-pulse"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Companion Health &amp; Clinical Status</h5>
                <p class="text-muted small m-0">Consolidated vital statistics, blood typing, allergies, and preventive care tracking.</p>
            </div>
        </div>
        <a href="<?= ViewHelper::url('portal/pets') ?>" class="btn btn-sm btn-outline-secondary px-3 py-2 rounded-pill fw-semibold" style="font-size: 13px;">
            <i class="fa-solid fa-paw me-1"></i> Manage All Pets
        </a>
    </div>

    <div class="p-4">
        <div class="row g-4">
            <?php if (empty($pets)): ?>
                <div class="col-12 text-center p-5 text-muted">
                    <div class="stat-card-icon icon-blue mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                        <i class="fa-solid fa-paw"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">No Pets Registered</h6>
                    <p class="small text-muted mb-3">Register your first pet to start tracking vaccinations, medications, and wellness scores.</p>
                    <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;">
                        <i class="fa-solid fa-plus me-1"></i> Register Companion
                    </a>
                </div>
            <?php else: ?>
                <?php foreach ($pets as $pet): ?>
                    <div class="col-12 col-lg-6">
                        <div class="admin-card h-100 p-4 border shadow-sm transition-all" style="border-radius: 18px; background: #fafbfc;">
                            <!-- Header Identity -->
                            <div class="d-flex gap-3 align-items-start mb-3">
                                <?php if (!empty($pet['avatar'])): ?>
                                    <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm flex-shrink-0" style="width: 68px; height: 68px; object-fit: contain; background: #fff8e5;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                                <?php else: ?>
                                    <div class="rounded-4 bg-light border d-flex align-items-center justify-content-center fw-bold text-brand flex-shrink-0 shadow-sm" style="width: 68px; height: 68px; font-size: 24px;">
                                        <i class="fa-solid fa-paw"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="flex-grow-1 min-w-0">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-1 mb-1">
                                        <h5 class="fw-bold text-dark m-0 text-truncate"><?= ViewHelper::e($pet['name']) ?></h5>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                                            <i class="fa-solid fa-shield-heart me-1"></i> Score: <?= $pet['care_score'] ?? 95 ?>/100
                                        </span>
                                    </div>
                                    <div class="text-muted small text-truncate">
                                        <span class="badge bg-light text-dark border me-1"><?= ViewHelper::e($pet['species'] ?? 'Pet') ?></span>
                                        <?= ViewHelper::e($pet['breed'] ?? 'Unknown Breed') ?> • <?= ViewHelper::e($pet['gender'] ?? 'Companion') ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Vitals 4-Grid -->
                            <div class="p-3 rounded-4 bg-white border mb-3">
                                <div class="row g-2 small">
                                    <div class="col-6 col-sm-6">
                                        <div class="text-muted" style="font-size: 11px;"><i class="fa-solid fa-syringe text-success me-1"></i> Immunizations</div>
                                        <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to Date') ?></div>
                                    </div>
                                    <div class="col-6 col-sm-6">
                                        <div class="text-muted" style="font-size: 11px;"><i class="fa-solid fa-weight-scale text-primary me-1"></i> Current Weight</div>
                                        <div class="fw-bold text-dark font-monospace text-truncate"><?= ViewHelper::e($pet['weight'] ?? '—') ?></div>
                                    </div>
                                    <div class="col-6 col-sm-6 mt-2">
                                        <div class="text-muted" style="font-size: 11px;"><i class="fa-solid fa-droplet text-danger me-1"></i> Blood Group</div>
                                        <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($pet['blood_group'] ?: 'Standard') ?></div>
                                    </div>
                                    <div class="col-6 col-sm-6 mt-2">
                                        <div class="text-muted" style="font-size: 11px;"><i class="fa-solid fa-triangle-exclamation text-warning me-1"></i> Allergies</div>
                                        <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($pet['allergies'] ?: 'None Reported') ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Actions Row -->
                            <div class="d-flex gap-2 mt-auto pt-2 border-top flex-wrap">
                                <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-admin-primary flex-grow-1 text-center py-2 rounded-pill fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-1" style="font-size: 13px; min-height: 38px;">
                                    <i class="fa-solid fa-notes-medical"></i> View 10 Medical Tabs
                                </a>
                                <a href="<?= ViewHelper::url('portal/reports/health/' . $pet['id']) ?>" class="btn btn-light border text-dark rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; min-width: 38px;" target="_blank" title="Print Health Summary">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Active Medications Table Card -->
<div class="admin-card shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-purple" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                <i class="fa-solid fa-pills"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Active Prescriptions &amp; Administration Schedules</h5>
                <p class="text-muted small m-0">Track dosages, administration intervals, and ongoing medical regimens.</p>
            </div>
        </div>
        <button type="button" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#healthMedModal">
            <i class="fa-solid fa-plus me-1"></i> Add Medication
        </button>
    </div>

    <?php if (empty($medications)): ?>
        <div class="p-5 text-center text-muted">
            <div class="stat-card-icon icon-purple mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                <i class="fa-solid fa-pills"></i>
            </div>
            <h6 class="fw-bold text-dark mb-1">No Active Prescriptions</h6>
            <p class="small text-muted mb-3">All your companions are currently free of active medical prescriptions.</p>
            <button type="button" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#healthMedModal">
                <i class="fa-solid fa-plus me-1"></i> Add Medication
            </button>
        </div>
    <?php else: ?>
        <div class="admin-table-container">
            <table class="admin-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Companion Patient</th>
                        <th>Medication Name</th>
                        <th>Dosage &amp; Frequency</th>
                        <th>Schedule Duration</th>
                        <th>Prescribing Clinician</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medications as $m): ?>
                        <tr>
                            <td class="ps-4">
                                <a href="<?= ViewHelper::url('portal/pets/' . $m['pet_id'] . '?tab=meds') ?>" class="fw-bold text-dark text-decoration-none d-inline-flex align-items-center gap-2">
                                    <i class="fa-solid fa-paw text-brand"></i>
                                    <span><?= ViewHelper::e($m['pet_name']) ?></span>
                                </a>
                            </td>
                            <td>
                                <strong class="text-dark d-block"><?= ViewHelper::e($m['name']) ?></strong>
                                <small class="text-muted"><?= ViewHelper::e($m['instructions'] ?: 'Standard prescription routine') ?></small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($m['dosage']) ?></span>
                                <small class="text-muted d-block mt-1"><?= ViewHelper::e($m['frequency']) ?></small>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark text-nowrap">
                                    <i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($m['start_date'])) ?>
                                </div>
                                <small class="text-muted text-nowrap"><?= $m['end_date'] ? '→ ' . date('M d, Y', strtotime($m['end_date'])) : 'Ongoing treatment' ?></small>
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark text-nowrap">
                                    <i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($m['prescribing_vet'] ?: 'Certified Vet') ?>
                                </div>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex align-items-center gap-2 justify-content-end">
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
                                            <input type="hidden" name="redirect" value="portal/health">
                                            <button type="submit" class="btn btn-sm btn-admin-primary px-3 py-1 fw-bold rounded-pill shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 12px; min-height: 34px;">
                                                <i class="fa-solid fa-check"></i> Give Dose <?= ($doseLimit > 1 && $doseLimit < 999) ? "({$dosesGiven}/{$doseLimit})" : "" ?>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Medication"
                                        data-confirm-delete
                                        data-action="<?= ViewHelper::url('portal/medications/' . $m['id'] . '/delete') ?>"
                                        data-redirect="portal/health"
                                        data-title="Remove Medication Prescription?"
                                        data-message="Are you sure you want to remove &quot;<?= ViewHelper::e($m['name']) ?>&quot; for <?= ViewHelper::e($m['pet_name']) ?>?">
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

<!-- Immunizations Table Card -->
<div class="admin-card shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-green" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                <i class="fa-solid fa-syringe"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Immunization &amp; Vaccine Records</h5>
                <p class="text-muted small m-0">Verified clinical vaccine records, booster schedules, and authorized clinic logs.</p>
            </div>
        </div>
        <button type="button" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#healthVaccineModal">
            <i class="fa-solid fa-plus me-1"></i> Record Vaccine
        </button>
    </div>

    <?php if (empty($vaccines)): ?>
        <div class="p-5 text-center text-muted">
            <div class="stat-card-icon icon-green mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                <i class="fa-solid fa-syringe"></i>
            </div>
            <h6 class="fw-bold text-dark mb-1">No Vaccine Records Yet</h6>
            <p class="small text-muted mb-3">Keep your companions protected by logging rabies, DHPP, and annual booster immunizations.</p>
            <button type="button" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#healthVaccineModal">
                <i class="fa-solid fa-plus me-1"></i> Record Vaccine
            </button>
        </div>
    <?php else: ?>
        <div class="admin-table-container">
            <table class="admin-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Companion Patient</th>
                        <th>Vaccine Name</th>
                        <th>Dose / Batch</th>
                        <th>Administered</th>
                        <th>Next Due Date</th>
                        <th>Administering Clinic / Vet</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vaccines as $v): ?>
                        <tr>
                            <td class="ps-4">
                                <a href="<?= ViewHelper::url('portal/pets/' . $v['pet_id'] . '?tab=vaccines') ?>" class="fw-bold text-dark text-decoration-none d-inline-flex align-items-center gap-2">
                                    <i class="fa-solid fa-paw text-brand"></i>
                                    <span><?= ViewHelper::e($v['pet_name']) ?></span>
                                </a>
                            </td>
                            <td>
                                <strong class="text-dark d-block"><?= ViewHelper::e($v['vaccine_name']) ?></strong>
                            </td>
                            <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($v['dosage'] ?? '1st Dose') ?></span></td>
                            <td class="text-nowrap"><i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($v['administered_date'])) ?></td>
                            <td>
                                <?php if (!empty($v['next_due_date'])): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle text-nowrap"><i class="fa-regular fa-clock me-1"></i> <?= date('M d, Y', strtotime($v['next_due_date'])) ?></span>
                                <?php else: ?>
                                    <span class="text-muted">—</span>
                                <?php endif; ?>
                            </td>
                            <td><i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($v['administering_vet'] ?? 'Licensed Clinic') ?></td>
                            <td class="text-end pe-4">
                                <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Vaccine"
                                    data-confirm-delete
                                    data-action="<?= ViewHelper::url('portal/vaccinations/' . $v['id'] . '/delete') ?>"
                                    data-redirect="portal/health"
                                    data-title="Delete Vaccination Record?"
                                    data-message="Are you sure you want to remove the &quot;<?= ViewHelper::e($v['vaccine_name']) ?>&quot; vaccination record for <?= ViewHelper::e($v['pet_name']) ?>?">
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

<!-- Modal: Add Medication -->
<div class="modal fade" id="healthMedModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-pills text-brand me-2"></i> Add Medical Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/medications/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/health">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Pet *</label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Medication Name *</label>
                        <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Amoxicillin, NexGard Spectra, Apoquel">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Dosage *</label>
                            <input type="text" name="dosage" class="form-control rounded-3" required placeholder="e.g. 50mg, 1 tablet">
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Frequency *</label>
                            <select name="frequency" class="form-select rounded-3">
                                <option value="Once daily">Once daily</option>
                                <option value="Twice daily">Twice daily</option>
                                <option value="Every 8 hours">Every 8 hours</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly">Monthly</option>
                                <option value="As needed">As needed</option>
                            </select>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Start Date *</label>
                            <input type="date" name="start_date" class="form-control rounded-3" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">End Date (Optional)</label>
                            <input type="date" name="end_date" class="form-control rounded-3">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Prescribing Veterinarian</label>
                        <input type="text" name="prescribing_vet" class="form-control rounded-3" placeholder="e.g. Dr. Ahmed, PetGuard Hospital">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Special Instructions</label>
                        <textarea name="instructions" rows="2" class="form-control rounded-3" placeholder="e.g. Administer with morning meal, store refrigerated..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4"><i class="fa-solid fa-plus me-1"></i> Save Medication</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Add Vaccine -->
<div class="modal fade" id="healthVaccineModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-syringe text-brand me-2"></i> Record Immunization</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/vaccinations/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/health">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Pet *</label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Vaccine Name *</label>
                        <input type="text" name="vaccine_name" class="form-control rounded-3" required placeholder="e.g. Rabies 3-Year, DHPP 5-in-1, Bordetella">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Administered Date *</label>
                            <input type="date" name="administered_date" class="form-control rounded-3" value="<?= date('Y-m-d') ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Next Due Date (Booster)</label>
                            <input type="date" name="next_due_date" class="form-control rounded-3" value="<?= date('Y-m-d', strtotime('+1 year')) ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Dose / Batch Type</label>
                        <select name="dosage" class="form-select rounded-3">
                            <option value="1st Dose">1st Dose (Puppy/Kitten Series)</option>
                            <option value="2nd Dose">2nd Dose</option>
                            <option value="Annual Booster" selected>Annual Booster</option>
                            <option value="3-Year Booster">3-Year Booster</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Administering Clinic / Doctor</label>
                        <input type="text" name="administering_vet" class="form-control rounded-3" placeholder="e.g. Dr. Sarah Jenkins, PetGuard Clinic">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4"><i class="fa-solid fa-syringe me-1"></i> Save Vaccine</button>
                </div>
            </form>
        </div>
    </div>
</div>
