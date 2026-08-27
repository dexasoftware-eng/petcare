<?php
use Helpers\ViewHelper;

function getDoctorInitials(string $name): string {
    $clean = trim(preg_replace('/^dr\.?\s+/i', '', trim($name)));
    return strtoupper(substr($clean, 0, 1) ?: 'D');
}

$initial = getDoctorInitials($vet['name']);
?>

<style>
/* 5-Screen Responsive Doctor Profile Layout */
.vet-profile-container {
    max-width: 1360px;
    margin: 0 auto;
    width: 100%;
}

.vet-profile-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: 24px;
    padding: 32px 36px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 12px 32px -8px rgba(15, 23, 42, 0.3);
}
.vet-profile-hero::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 360px;
    height: 360px;
    background: radial-gradient(circle, rgba(255, 122, 24, 0.22) 0%, rgba(255, 122, 24, 0) 70%);
    pointer-events: none;
}

.vet-profile-avatar {
    width: 96px;
    height: 96px;
    min-width: 96px;
    border-radius: 22px;
    font-size: 38px;
    font-weight: 800;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ff7a18 0%, #ff9f43 100%);
    box-shadow: 0 10px 24px rgba(255, 122, 24, 0.3);
    border: 3px solid rgba(255, 255, 255, 0.85);
    position: relative;
}
.vet-profile-online-ring {
    position: absolute;
    bottom: -3px;
    right: -3px;
    width: 18px;
    height: 18px;
    background: #10b981;
    border: 3px solid #ffffff;
    border-radius: 50%;
}

/* Stat Tile in Hero */
.vet-hero-stat {
    background: rgba(255, 255, 255, 0.07);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 16px;
    padding: 12px 16px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .vet-profile-hero {
        padding: 20px 16px;
        border-radius: 18px;
    }
    .vet-profile-avatar {
        width: 72px;
        height: 72px;
        min-width: 72px;
        font-size: 28px;
        border-radius: 18px;
    }
    .vet-hero-stat {
        padding: 8px 12px;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .vet-profile-hero {
        padding: 24px 22px;
    }
}
@media (min-width: 768px) and (max-width: 991.98px) {
    .vet-profile-hero {
        padding: 28px 28px;
    }
}
</style>

<div class="vet-profile-container py-2">

    <!-- Top Navigation Breadcrumb -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/vets') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to All Veterinarians
        </a>
        <div class="d-flex align-items-center gap-2">
            <form action="<?= ViewHelper::url('portal/vets/' . $vet['id'] . '/favorite') ?>" method="POST" class="m-0">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/vets/<?= $vet['id'] ?>">
                <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2 <?= $isFavorite ? 'text-danger' : 'text-muted' ?>">
                    <i class="fa-<?= $isFavorite ? 'solid' : 'regular' ?> fa-heart"></i> <?= $isFavorite ? 'Saved in Favorites' : 'Add to Favorites' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Doctor Hero Banner -->
    <div class="vet-profile-hero mb-4">
        <div class="row g-4 align-items-center">
            
            <!-- Left: Avatar & Active Badge -->
            <div class="col-12 col-sm-auto text-center">
                <div class="vet-profile-avatar mx-auto">
                    <?= $initial ?>
                    <span class="vet-profile-online-ring" title="Verified Active Clinician"></span>
                </div>
                <div class="mt-2">
                    <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Verified Active
                    </span>
                </div>
            </div>

            <!-- Right: Doctor Metadata, Credentials & 4 Stats -->
            <div class="col-12 col-sm min-w-0">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <div class="min-w-0">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <h2 class="fw-bold text-white m-0" style="letter-spacing: -0.5px;"><?= ViewHelper::e($vet['name']) ?></h2>
                            <i class="fa-solid fa-circle-check text-primary fs-5" title="Board-Certified Practitioner"></i>
                        </div>
                        <div class="text-brand fs-6 fw-bold mt-1"><?= ViewHelper::e($vet['specialization'] ?: 'General Small Animal Practice') ?></div>
                    </div>
                    <div>
                        <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-15 font-monospace px-3 py-2 fw-bold" style="font-size: 11.5px;">
                            <i class="fa-solid fa-id-card me-1 text-brand"></i> <?= ViewHelper::e($vet['license_number'] ?: 'VET-CERT-APPROVED') ?>
                        </span>
                    </div>
                </div>

                <!-- 4 Hero Stat Tiles -->
                <div class="row g-2 g-md-3 pt-3 border-top border-white border-opacity-10 mt-2">
                    <div class="col-6 col-md-3">
                        <div class="vet-hero-stat">
                            <div class="text-white-50 small text-uppercase fw-bold" style="font-size: 10px;">Experience</div>
                            <div class="fw-bold text-white fs-6"><?= (int)($vet['experience'] ?? 5) ?>+ Years</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="vet-hero-stat">
                            <div class="text-white-50 small text-uppercase fw-bold" style="font-size: 10px;">Client Rating</div>
                            <div class="fw-bold text-success fs-6"><i class="fa-solid fa-star text-warning me-1"></i> 4.9 / 5.0</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="vet-hero-stat">
                            <div class="text-white-50 small text-uppercase fw-bold" style="font-size: 10px;">Telemedicine</div>
                            <div class="fw-bold text-white fs-6"><i class="fa-solid fa-video text-primary me-1"></i> HD Live</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="vet-hero-stat">
                            <div class="text-white-50 small text-uppercase fw-bold" style="font-size: 10px;">Consultations</div>
                            <div class="fw-bold text-white fs-6">140+ Treated</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex gap-2 flex-wrap pt-3 mt-3 border-top border-white border-opacity-10">
                    <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13px;" onclick="PetGuardCall.initiateCall(<?= (int)$vet['id'] ?>, 'video', 'direct')">
                        <i class="fa-solid fa-video"></i> Start Video Consultation
                    </button>
                    <a href="#bookSection" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13px;">
                        <i class="fa-solid fa-calendar-plus"></i> Book Consultation
                    </a>
                </div>

            </div>
        </div>
    </div>

    <!-- Main Content 2-Column Grid -->
    <div class="row g-4">
        
        <!-- Left Column: Biography, Specializations & Credentials -->
        <div class="col-12 col-lg-7">
            
            <!-- About the Clinician -->
            <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">About the Clinician</h5>
                </div>
                <p class="text-muted" style="line-height: 1.75; font-size: 14px;">
                    <?= nl2br(ViewHelper::e($vet['bio'] ?: 'Dr. ' . $vet['name'] . ' is an experienced certified veterinarian in the PetGuard healthcare network with extensive experience providing comprehensive diagnostic assessments, advanced surgical care, preventive immunology, and compassionate companion wellness treatments.')) ?>
                </p>
            </div>

            <!-- Specializations & Clinical Focus -->
            <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-purple" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
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
                <div class="stat-card-icon icon-green" style="width: 48px; height: 48px; min-width: 48px; font-size: 18px; border-radius: 14px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark m-0">Certified PetGuard Hospital Network Practitioner</h6>
                    <p class="text-muted small m-0">Credentials, state veterinary medical licensing, and practice compliance have been authenticated by the PetGuard Credentialing Board.</p>
                </div>
            </div>

        </div>

        <!-- Right Column: Clinic Practice & Direct Booking Form -->
        <div class="col-12 col-lg-5">
            
            <!-- Clinic Location & Contact -->
            <div class="admin-card p-4 mb-4 border shadow-sm" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                        <i class="fa-solid fa-hospital"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">Primary Clinic &amp; Practice</h5>
                </div>

                <div class="mb-3">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Hospital Facility</div>
                    <div class="fw-bold text-dark fs-6"><?= ViewHelper::e($vet['clinic_name'] ?: 'PetGuard Central Hospital') ?></div>
                </div>

                <div class="mb-3">
                    <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Physical Address</div>
                    <div class="text-dark small"><i class="fa-solid fa-location-dot text-danger me-1"></i> <?= ViewHelper::e($vet['clinic_address'] ?: '742 Evergreen Terrace, Clinic B') ?></div>
                </div>

                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Telephone</div>
                        <div class="text-dark small"><i class="fa-solid fa-phone text-muted me-1"></i> <?= ViewHelper::e($vet['phone'] ?? '+1-555-019-2834') ?></div>
                    </div>
                    <div class="col-6">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Consultation Email</div>
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
                    <div class="stat-card-icon icon-green" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
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
                        <select name="pet_id" class="form-select rounded-3 py-2" required>
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
                            <input type="date" name="appointment_date" class="form-control rounded-3 py-2" required min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small text-dark">Time *</label>
                            <input type="time" name="appointment_time" class="form-control rounded-3 py-2" required value="11:00">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Consultation Channel *</label>
                        <select name="consultation_type" class="form-select rounded-3 py-2" required>
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

</div>
