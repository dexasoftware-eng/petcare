<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-notes-medical text-brand me-2"></i> Patient Medical File: <?= ViewHelper::e($pet['name']) ?></h2>
        <p class="admin-page-subtitle"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>) &middot; Microchip: <?= ViewHelper::e($pet['microchip_id'] ?? 'N/A') ?></p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" target="_blank" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-passport me-1"></i> Public QR Passport
        </a>
        <button type="button" class="btn btn-admin-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#newConsultModal">
            <i class="fa-solid fa-plus me-1"></i> Log Clinical Note / Rx
        </button>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Patient Summary -->
    <div class="col-lg-4">
        <div class="admin-card text-center p-4 mb-4">
            <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-4 border mb-3" style="width: 100px; height: 100px; object-fit: cover;">
            <h4 class="fw-bold mb-1"><?= ViewHelper::e($pet['name']) ?></h4>
            <p class="text-muted small mb-3"><?= ViewHelper::e($pet['breed']) ?></p>

            <div class="text-start small border-top pt-3">
                <div class="mb-2"><strong>Gender:</strong> <?= ViewHelper::e($pet['gender']) ?></div>
                <div class="mb-2"><strong>Age:</strong> <?= ViewHelper::e($pet['age']) ?></div>
                <div class="mb-2"><strong>Weight:</strong> <?= ViewHelper::e($pet['weight']) ?></div>
                <div class="mb-2"><strong>Blood Group:</strong> <?= ViewHelper::e($pet['blood_group'] ?? 'DEA 1.1 Negative') ?></div>
                <div class="mb-2"><strong>Color:</strong> <?= ViewHelper::e($pet['color'] ?? 'Golden Honey') ?></div>
                <div class="mb-2"><strong>Allergies:</strong> <span class="text-danger"><?= ViewHelper::e($pet['allergies'] ?? 'None recorded') ?></span></div>
                <div><strong>Diet:</strong> <?= ViewHelper::e($pet['diet_instructions'] ?? 'Standard veterinary formula') ?></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-shield-virus me-2"></i> Vaccinations</h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($vaccines)): ?>
                    <div class="p-3 text-center text-muted small">No vaccines recorded yet.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush small">
                        <?php foreach ($vaccines as $vac): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-2">
                                <div>
                                    <strong class="d-block text-dark"><?= ViewHelper::e($vac['vaccine_name']) ?></strong>
                                    <span class="text-muted" style="font-size: 11px;">Administered: <?= date('M d, Y', strtotime($vac['administered_date'])) ?></span>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Verified</span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Right Column: Medical History -->
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-waveform text-brand me-2"></i> Clinical Records & Diagnoses</h3>
                <span class="badge bg-light text-dark border"><?= count($consultations ?? []) ?> Consultations</span>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($consultations)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-regular fa-clipboard fa-3x mb-3 text-muted"></i>
                        <h5 class="fw-bold">No clinical records found</h5>
                        <p class="small text-muted">Click "+ Log Clinical Note / Rx" to add consultation records for this patient.</p>
                    </div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($consultations as $rec): ?>
                            <div class="list-group-item p-4">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-1"><?= ViewHelper::e($rec['diagnosis']) ?></h5>
                                        <span class="small text-muted"><i class="fa-solid fa-user-doctor me-1"></i> <?= ViewHelper::e($rec['vet_name']) ?> &middot; <?= ViewHelper::e($rec['clinic_name'] ?? 'Pet Guard Practice') ?></span>
                                    </div>
                                    <span class="badge bg-light text-dark border"><?= date('M d, Y', strtotime($rec['created_at'])) ?></span>
                                </div>

                                <?php if (!empty($rec['symptoms'])): ?>
                                    <div class="small text-muted mb-2"><strong>Presenting Symptoms:</strong> <?= ViewHelper::e($rec['symptoms']) ?></div>
                                <?php endif; ?>

                                <div class="p-3 bg-light rounded-3 mb-3 small">
                                    <strong class="d-block text-dark mb-1">Treatment Plan:</strong>
                                    <?= nl2br(ViewHelper::e($rec['treatment_plan'])) ?>
                                </div>

                                <?php if (!empty($rec['prescription'])): ?>
                                    <div class="p-3 border border-success-subtle bg-success-subtle rounded-3 small font-monospace">
                                        <strong class="d-block text-success mb-1"><i class="fa-solid fa-file-prescription me-1"></i> Digital Prescription:</strong>
                                        <?= nl2br(ViewHelper::e($rec['prescription'])) ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal: New Consultation Note -->
<div class="modal fade" id="newConsultModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold">Log Clinical Consultation & Prescription</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="newConsultForm" action="<?= ViewHelper::url('vet/consultations/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                <input type="hidden" name="owner_id" value="<?= $owner['id'] ?>">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Presenting Symptoms / Reason for Visit</label>
                        <input type="text" name="symptoms" class="form-control" placeholder="e.g. Ear scratching, redness in left ear canal...">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Primary Diagnosis *</label>
                            <input type="text" name="diagnosis" class="form-control" placeholder="e.g. Otitis Externa" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Follow-Up Date (Optional)</label>
                            <input type="date" name="follow_up_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Treatment Plan *</label>
                        <textarea name="treatment_plan" class="form-control" rows="3" placeholder="Describe clinical treatment and owner care recommendations..." required></textarea>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Digital Prescription (e-Rx)</label>
                        <textarea name="prescription" class="form-control font-monospace" rows="3" placeholder="e.g. Posatex Otic Drops - 4 drops in left ear once daily for 7 days."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top p-3 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4">Save Consultation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#newConsultForm', {
        loadingText: 'Saving Consultation...',
        reload: true
    });
});
</script>
