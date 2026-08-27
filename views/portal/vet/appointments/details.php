<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-stethoscope text-brand me-2"></i> Clinical Consultation #<?= $appointment['id'] ?></h2>
        <p class="admin-page-subtitle">Patient: <?= ViewHelper::e($pet['name']) ?> &middot; Scheduled: <?= date('F d, Y', strtotime($appointment['appointment_date'])) ?> at <?= ViewHelper::e($appointment['appointment_time']) ?></p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success rounded-pill px-4" onclick="PetGuardCall.initiateCall(<?= (int)$owner['id'] ?>, 'video', 'appointment', <?= (int)$appointment['id'] ?>)">
            <i class="fa-solid fa-video me-1"></i> Start Video Consultation
        </button>
        <button type="button" class="btn btn-outline-secondary rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$owner['id'] ?>, 'audio', 'appointment', <?= (int)$appointment['id'] ?>)">
            <i class="fa-solid fa-phone me-1"></i> Audio
        </button>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Patient & Owner Profile -->
    <div class="col-lg-4">
        <!-- Patient Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Patient Information</h3>
            </div>
            <div class="admin-card-body text-center">
                <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-4 border mb-3" style="width: 90px; height: 90px; object-fit: cover;">
                <h4 class="fw-bold mb-1"><?= ViewHelper::e($pet['name']) ?></h4>
                <p class="text-muted small mb-3"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>)</p>

                <div class="text-start small border-top pt-3">
                    <div class="mb-2"><strong>Gender:</strong> <?= ViewHelper::e($pet['gender']) ?></div>
                    <div class="mb-2"><strong>Age:</strong> <?= ViewHelper::e($pet['age']) ?></div>
                    <div class="mb-2"><strong>Weight:</strong> <?= ViewHelper::e($pet['weight']) ?></div>
                    <div class="mb-2"><strong>Microchip:</strong> <?= ViewHelper::e($pet['microchip_id'] ?? 'N/A') ?></div>
                    <div class="mb-2"><strong>Allergies:</strong> <span class="text-danger"><?= ViewHelper::e($pet['allergies'] ?? 'None recorded') ?></span></div>
                </div>

                <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" target="_blank" class="btn btn-sm btn-outline-brand rounded-pill w-100 mt-2">
                    <i class="fa-solid fa-passport me-1"></i> Full Digital Passport
                </a>
            </div>
        </div>

        <!-- Owner Card -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-user me-2"></i> Pet Parent Details</h3>
            </div>
            <div class="admin-card-body small">
                <div class="fw-bold text-dark fs-6 mb-1"><?= ViewHelper::e($owner['name']) ?></div>
                <div class="text-muted mb-2"><i class="fa-solid fa-envelope me-1"></i> <?= ViewHelper::e($owner['email']) ?></div>
                <div class="text-muted mb-3"><i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($owner['phone'] ?? 'N/A') ?></div>

                <a href="<?= ViewHelper::url('portal/messages?target=' . $owner['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill w-100">
                    <i class="fa-solid fa-comments me-1"></i> Open Direct Chat
                </a>
            </div>
        </div>
    </div>

    <!-- Right Column: Medical Notes & e-Prescription Form -->
    <div class="col-lg-8">
        <!-- Status Changer -->
        <div class="admin-card mb-4">
            <div class="admin-card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <span class="small text-muted d-block">Current Booking Status:</span>
                    <span class="badge bg-light text-dark border fs-6 text-uppercase px-3 py-1"><?= ViewHelper::e($appointment['status']) ?></span>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="updateStatus('confirmed')">
                        <i class="fa-solid fa-check me-1"></i> Confirm
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="updateStatus('cancelled')">
                        <i class="fa-solid fa-ban me-1"></i> Cancel
                    </button>
                </div>
            </div>
        </div>

        <!-- Add Clinical Examination Notes & Prescription -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-prescription text-brand me-2"></i> Clinical Record & Prescription Pad</h3>
            </div>
            <div class="admin-card-body">
                <form id="consultationForm" action="<?= ViewHelper::url('vet/consultations/create') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                    <input type="hidden" name="pet_id" value="<?= $pet['id'] ?>">
                    <input type="hidden" name="owner_id" value="<?= $owner['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Chief Complaints / Presenting Symptoms</label>
                        <input type="text" name="symptoms" class="form-control" value="<?= ViewHelper::e($appointment['notes'] ?? '') ?>" placeholder="e.g. Mild limping on right hind leg after exercise...">
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Primary Diagnosis *</label>
                            <input type="text" name="diagnosis" class="form-control" placeholder="e.g. Grade 1 Patellar Subluxation" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Follow-Up Target Date</label>
                            <input type="date" name="follow_up_date" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Treatment Plan & Veterinary Recommendations *</label>
                        <textarea name="treatment_plan" class="form-control" rows="3" placeholder="Advised rest, weight management, and physical therapy exercises..." required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Digital Prescription (e-Rx)</label>
                        <textarea name="prescription" class="form-control font-monospace" rows="3" placeholder="e.g. Carprofen 25mg - 1 chewable tablet every 12 hours with meals for 5 days."></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Confidential Clinical Notes (Internal Practice Only)</label>
                        <textarea name="clinical_notes" class="form-control" rows="2" placeholder="Private observations, vitals, temperature, heart rate..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                            <i class="fa-solid fa-circle-check me-1"></i> Finalize Consultation & Save Record
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Past Medical Records -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-clock-rotate-left text-brand me-2"></i> Patient Past Medical History</h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($pastRecords)): ?>
                    <div class="p-4 text-center text-muted">No previous consultation records logged for this patient.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($pastRecords as $pr): ?>
                            <div class="list-group-item py-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <h6 class="fw-bold text-dark m-0"><?= ViewHelper::e($pr['diagnosis']) ?></h6>
                                    <span class="small text-muted"><?= date('M d, Y', strtotime($pr['created_at'])) ?></span>
                                </div>
                                <p class="small text-muted mb-2"><?= ViewHelper::e($pr['treatment_plan']) ?></p>
                                <?php if (!empty($pr['prescription'])): ?>
                                    <div class="p-2 bg-light rounded-3 small font-monospace"><strong>Rx:</strong> <?= ViewHelper::e($pr['prescription']) ?></div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<script>
async function updateStatus(status) {
    const res = await PetGuardAjax.post(`vet/appointments/<?= $appointment['id'] ?>/status`, { status });
    if (res.ok) {
        PetGuardToast.success(res.message);
        setTimeout(() => window.location.reload(), 600);
    } else {
        PetGuardToast.error(res.message);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#consultationForm', {
        loadingText: 'Saving Record & Prescribing...',
        reload: true
    });
});
</script>
