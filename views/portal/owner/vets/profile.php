<?php
use Helpers\ViewHelper;

function getDoctorInitials(string $name): string {
    $clean = trim(preg_replace('/^dr\.?\s+/i', '', trim($name)));
    return strtoupper(substr($clean, 0, 1) ?: 'D');
}

$initial = getDoctorInitials($vet['name']);
?>

<!-- Top Navigation -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
    <a href="<?= ViewHelper::url('portal/vets') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
        <i class="fa-solid fa-arrow-left"></i> Back to Veterinarians
    </a>
    <div class="d-flex align-items-center gap-2">
        <form action="<?= ViewHelper::url('portal/vets/' . $vet['id'] . '/favorite') ?>" method="POST" class="m-0">
            <?= ViewHelper::csrfField() ?>
            <input type="hidden" name="redirect" value="portal/vets/<?= $vet['id'] ?>">
            <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-1 <?= $isFavorite ? 'text-danger' : 'text-muted' ?>">
                <i class="fa-<?= $isFavorite ? 'solid' : 'regular' ?> fa-heart"></i> <?= $isFavorite ? 'Favorited Doctor' : 'Save as Favorite' ?>
            </button>
        </form>
    </div>
</div>

<!-- Doctor Hero Header Card -->
<div class="admin-card p-4 p-md-5 mb-4 border shadow-sm" style="border-radius: 24px; background: #ffffff;">
    <div class="row g-4 align-items-center">
        <div class="col-12 col-sm-auto text-center">
            <div class="rounded-4 text-white border d-flex align-items-center justify-content-center fw-bold shadow mx-auto" style="width: 100px; height: 100px; font-size: 40px; background: linear-gradient(135deg, #ff7a18, #ff9f43);">
                <?= $initial ?>
            </div>
            <div class="mt-2">
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                    <i class="fa-solid fa-circle-check me-1"></i> Verified Active
                </span>
            </div>
        </div>

        <div class="col-12 col-sm">
            <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                <div>
                    <h2 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;"><?= ViewHelper::e($vet['name']) ?></h2>
                    <div class="text-brand fs-6 fw-bold mt-1"><?= ViewHelper::e($vet['specialization'] ?: 'General Small Animal Practice') ?></div>
                </div>
                <div class="d-flex gap-2">
                    <span class="badge bg-light text-dark border font-monospace px-3 py-2 fw-bold" style="font-size: 12px;">
                        <i class="fa-solid fa-id-card me-1 text-muted"></i> <?= ViewHelper::e($vet['license_number'] ?: 'VET-DVM-LIC') ?>
                    </span>
                </div>
            </div>

            <div class="row g-3 pt-3 border-top mt-2">
                <div class="col-6 col-md-3">
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 10.5px;">Experience</div>
                    <div class="fw-bold text-dark fs-6"><?= (int)($vet['experience'] ?? 5) ?>+ Years</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 10.5px;">Client Rating</div>
                    <div class="fw-bold text-success fs-6"><i class="fa-solid fa-star text-warning me-1"></i> 4.9 / 5.0</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 10.5px;">Telemedicine</div>
                    <div class="fw-bold text-dark fs-6"><i class="fa-solid fa-video text-primary me-1"></i> Available</div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="text-muted small text-uppercase fw-bold" style="font-size: 10.5px;">Consultations</div>
                    <div class="fw-bold text-dark fs-6">140+ Treated</div>
                </div>
            </div>

            <!-- Action Bar -->
            <div class="d-flex gap-2 flex-wrap pt-3 mt-3 border-top">
                <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" onclick="PetGuardCall.initiateCall(<?= (int)$vet['id'] ?>, 'video', 'direct')">
                    <i class="fa-solid fa-video"></i> Start Video Consultation
                </button>
                <a href="#bookSection" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-plus"></i> Book Consultation
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Biography & Credentials -->
    <div class="col-12 col-lg-7">
        
        <!-- About Clinician -->
        <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
            <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                <div class="stat-card-icon icon-blue" style="width: 34px; height: 34px; font-size: 14px; border-radius: 10px;">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <h5 class="fw-bold text-dark m-0">About the Clinician</h5>
            </div>
            <p class="text-muted" style="line-height: 1.7; font-size: 14px;">
                <?= nl2br(ViewHelper::e($vet['bio'] ?: 'Dr. ' . $vet['name'] . ' is an experienced certified veterinarian in the PetGuard healthcare network with extensive experience providing comprehensive diagnostic assessments, advanced surgical care, preventive immunology, and compassionate companion wellness treatments.')) ?>
            </p>
        </div>

        <!-- Specialization & Scope of Practice -->
        <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
            <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                <div class="stat-card-icon icon-purple" style="width: 34px; height: 34px; font-size: 14px; border-radius: 10px;">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
                <h5 class="fw-bold text-dark m-0">Specializations &amp; Clinical Focus</h5>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> <?= ViewHelper::e($vet['specialization']) ?></span>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Soft Tissue Surgery</span>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Preventive Immunizations</span>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Diagnostic Ultrasound</span>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Companion Geriatrics</span>
                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Emergency Critical Care</span>
            </div>
        </div>

        <!-- Verification Seal -->
        <div class="p-4 rounded-4 bg-light border d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-green" style="width: 46px; height: 46px; font-size: 18px; border-radius: 14px;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div>
                <h6 class="fw-bold text-dark m-0">Certified PetGuard Hospital Network Practitioner</h6>
                <p class="text-muted small m-0">Credentials, state veterinary medical licensing, and practice compliance have been authenticated by the PetGuard Credentialing Board.</p>
            </div>
        </div>

    </div>

    <!-- Right Column: Clinic Practice & Direct Booking -->
    <div class="col-12 col-lg-5">
        
        <!-- Clinic Location & Contact -->
        <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
            <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                <div class="stat-card-icon icon-orange" style="width: 34px; height: 34px; font-size: 14px; border-radius: 10px;">
                    <i class="fa-solid fa-hospital"></i>
                </div>
                <h5 class="fw-bold text-dark m-0">Primary Clinic &amp; Practice</h5>
            </div>

            <div class="mb-3">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Hospital Name</div>
                <div class="fw-bold text-dark fs-6"><?= ViewHelper::e($vet['clinic_name'] ?: 'PetGuard Central Hospital') ?></div>
            </div>

            <div class="mb-3">
                <div class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Physical Address</div>
                <div class="text-dark small"><i class="fa-solid fa-location-dot text-danger me-1"></i> <?= ViewHelper::e($vet['clinic_address'] ?: '742 Evergreen Terrace, Clinic B') ?></div>
            </div>

            <div class="row g-2 mb-3">
                <div class="col-6">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Telephone</div>
                    <div class="text-dark small"><i class="fa-solid fa-phone text-muted me-1"></i> <?= ViewHelper::e($vet['phone'] ?? '+1-555-019-2834') ?></div>
                </div>
                <div class="col-6">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Consultation Email</div>
                    <div class="text-dark small text-truncate"><i class="fa-solid fa-envelope text-muted me-1"></i> <?= ViewHelper::e($vet['email']) ?></div>
                </div>
            </div>

            <div class="p-3 bg-light rounded-3 border">
                <div class="fw-bold text-dark small mb-1"><i class="fa-regular fa-clock text-brand me-1"></i> Operating Hours</div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Monday - Friday:</span>
                    <span class="fw-semibold text-dark">08:00 - 18:00</span>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Saturday:</span>
                    <span class="fw-semibold text-dark">09:00 - 15:00</span>
                </div>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Sunday / Emergency:</span>
                    <span class="text-danger fw-bold">24/7 On Call</span>
                </div>
            </div>
        </div>

        <!-- Direct Consultation Booking Form -->
        <div class="admin-card p-4 border shadow-sm" id="bookSection" style="border-radius: 20px;">
            <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                <div class="stat-card-icon icon-green" style="width: 34px; height: 34px; font-size: 14px; border-radius: 10px;">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h5 class="fw-bold text-dark m-0">Book with <?= ViewHelper::e($vet['name']) ?></h5>
            </div>

            <form action="<?= ViewHelper::url('portal/appointments/book') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/vets/<?= $vet['id'] ?>">
                <input type="hidden" name="vet_id" value="<?= $vet['id'] ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Select Companion Patient *</label>
                    <select name="pet_id" class="form-select rounded-3" required>
                        <?php if (empty($pets)): ?>
                            <option value="" disabled selected>No companions registered</option>
                        <?php else: ?>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?> - <?= ViewHelper::e($p['breed']) ?>)</option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label fw-bold small text-dark">Date *</label>
                        <input type="date" name="appointment_date" class="form-control rounded-3" required min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold small text-dark">Time *</label>
                        <input type="time" name="appointment_time" class="form-control rounded-3" required value="11:00">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Consultation Channel *</label>
                    <select name="consultation_type" class="form-select rounded-3" required>
                        <option value="In-Person Clinic Visit">🏥 In-Person Clinic Visit</option>
                        <option value="Telemedicine Video Consultation">📹 Telemedicine Video Consultation</option>
                        <option value="Emergency Priority Triage">🚨 Emergency Priority Triage</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold small text-dark">Symptoms / Reason</label>
                    <textarea name="symptoms" class="form-control rounded-3" rows="3" placeholder="Describe symptoms or reasons for visit..."></textarea>
                </div>

                <button type="submit" class="btn btn-admin-primary w-100 rounded-pill py-2 fw-bold shadow-sm">
                    <i class="fa-solid fa-calendar-check me-1"></i> Confirm Appointment Request
                </button>
            </form>
        </div>

    </div>
</div>
