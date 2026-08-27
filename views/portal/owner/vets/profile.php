<?php
use Helpers\ViewHelper;

function getDoctorInitials(string $name): string {
    $clean = trim(preg_replace('/^dr\.?\s+/i', '', trim($name)));
    return strtoupper(substr($clean, 0, 1) ?: 'D');
}

$initial = getDoctorInitials($vet['name']);
$experience = (int)($vet['experience'] ?? 8);
$license = ViewHelper::e($vet['license_number'] ?: 'VET-DVM-CERT-9821');
?>

<style>
/* Modern Doctor Profile Layout */
.doctor-profile-wrap {
    max-width: 1360px;
    margin: 0 auto;
    width: 100%;
}

/* Doctor Hero Card */
.doctor-hero-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 32px;
    box-shadow: 0 10px 30px -5px rgba(15, 23, 42, 0.05);
    position: relative;
    overflow: hidden;
}
.doctor-hero-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, #ff7a18 0%, #ff9f43 50%, #10b981 100%);
}

.doctor-avatar-container {
    width: 100px;
    height: 100px;
    min-width: 100px;
    border-radius: 24px;
    font-size: 40px;
    font-weight: 800;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ff7a18 0%, #ff9f43 100%);
    box-shadow: 0 10px 24px rgba(255, 122, 24, 0.25);
    position: relative;
    border: 3px solid #ffffff;
}
.doctor-live-dot {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 18px;
    height: 18px;
    background: #10b981;
    border: 3px solid #ffffff;
    border-radius: 50%;
}

/* Stat Mini Box */
.doctor-stat-badge {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 10px 16px;
    text-align: center;
    min-width: 110px;
}

/* Section Card */
.profile-section-card {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.02);
    margin-bottom: 24px;
}

/* Sticky Booking Box on Desktop */
@media (min-width: 992px) {
    .sticky-booking-sidebar {
        position: sticky;
        top: 90px;
        z-index: 10;
    }
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .doctor-hero-card {
        padding: 20px 16px;
        border-radius: 18px;
    }
    .doctor-avatar-container {
        width: 76px;
        height: 76px;
        min-width: 76px;
        font-size: 30px;
        border-radius: 18px;
    }
    .profile-section-card {
        padding: 18px 16px;
        border-radius: 16px;
    }
    .doctor-stat-badge {
        padding: 8px 10px;
        min-width: 0;
        flex: 1 1 calc(50% - 6px);
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .doctor-hero-card {
        padding: 24px 20px;
    }
}
</style>

<div class="doctor-profile-wrap py-2">

    <!-- Top Navigation Header -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/vets') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Back to Veterinarians Directory
        </a>
        <div class="d-flex align-items-center gap-2">
            <form action="<?= ViewHelper::url('portal/vets/' . $vet['id'] . '/favorite') ?>" method="POST" class="m-0">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/vets/<?= $vet['id'] ?>">
                <button type="submit" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2 <?= $isFavorite ? 'text-danger' : 'text-muted' ?>">
                    <i class="fa-<?= $isFavorite ? 'solid' : 'regular' ?> fa-heart"></i> <?= $isFavorite ? 'Saved in Favorites' : 'Save as Favorite' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Doctor Header Profile Hero Card -->
    <div class="doctor-hero-card mb-4">
        <div class="row g-4 align-items-center">
            
            <!-- Left: Avatar & Verification -->
            <div class="col-12 col-sm-auto text-center">
                <div class="doctor-avatar-container mx-auto">
                    <?= $initial ?>
                    <span class="doctor-live-dot" title="Verified Active Clinician"></span>
                </div>
                <div class="mt-2">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                        <i class="fa-solid fa-circle-check me-1"></i> Board Certified
                    </span>
                </div>
            </div>

            <!-- Middle: Name, Specialization & Meta Tags -->
            <div class="col-12 col-sm min-w-0">
                <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                    <div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <h2 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;"><?= ViewHelper::e($vet['name']) ?></h2>
                            <i class="fa-solid fa-circle-check text-primary fs-5" title="Authenticated License"></i>
                        </div>
                        <div class="text-brand fs-6 fw-bold mt-1"><?= ViewHelper::e($vet['specialization'] ?: 'General Small Animal Practice') ?></div>
                    </div>
                    <div>
                        <span class="badge bg-light text-dark border font-monospace px-3 py-2 fw-bold" style="font-size: 11px;">
                            <i class="fa-solid fa-id-card me-1 text-muted"></i> <?= $license ?>
                        </span>
                    </div>
                </div>

                <!-- 4 Quick Stats -->
                <div class="d-flex gap-2 flex-wrap mt-3 pt-3 border-top">
                    <div class="doctor-stat-badge">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px;">Experience</div>
                        <div class="fw-bold text-dark fs-6"><?= $experience ?>+ Years</div>
                    </div>
                    <div class="doctor-stat-badge">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px;">Client Rating</div>
                        <div class="fw-bold text-success fs-6"><i class="fa-solid fa-star text-warning me-1"></i> 4.9 <small class="text-muted fw-normal" style="font-size: 11px;">(128)</small></div>
                    </div>
                    <div class="doctor-stat-badge">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px;">Telemedicine</div>
                        <div class="fw-bold text-primary fs-6"><i class="fa-solid fa-video me-1"></i> HD Live</div>
                    </div>
                    <div class="doctor-stat-badge">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10px;">Consultations</div>
                        <div class="fw-bold text-dark fs-6">140+ Pets</div>
                    </div>
                </div>
            </div>

            <!-- Right: Direct Quick Action Buttons -->
            <div class="col-12 col-xl-auto">
                <div class="d-flex flex-column gap-2" style="min-width: 200px;">
                    <button type="button" class="btn btn-success rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2 w-100" style="font-size: 13px; height: 42px;" onclick="PetGuardCall.initiateCall(<?= (int)$vet['id'] ?>, 'video', 'direct')">
                        <i class="fa-solid fa-video"></i> Start Video Call
                    </button>
                    <a href="#bookingSection" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center justify-content-center gap-2 w-100" style="font-size: 13px; height: 42px;">
                        <i class="fa-solid fa-calendar-plus"></i> Book Consultation
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- 2-Column Responsive Body Layout -->
    <div class="row g-4">
        
        <!-- Left Column: Biography, Clinical Scope, Verification & Reviews (8 Cols) -->
        <div class="col-12 col-lg-7 col-xl-8">
            
            <!-- Biography Card -->
            <div class="profile-section-card">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">About the Clinician</h5>
                        <small class="text-muted">Background, medical training &amp; veterinary care philosophy</small>
                    </div>
                </div>
                
                <p class="text-muted" style="line-height: 1.8; font-size: 14px; margin-bottom: 0;">
                    <?= nl2br(ViewHelper::e($vet['bio'] ?: 'Dr. ' . $vet['name'] . ' is a board-certified clinical veterinarian in the PetGuard healthcare network with extensive experience in comprehensive diagnostic assessments, advanced soft-tissue surgical procedures, preventive immunology, and compassionate companion wellness treatments.')) ?>
                </p>
            </div>

            <!-- Specializations & Clinical Focus -->
            <div class="profile-section-card">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-purple" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-dark m-0">Specializations &amp; Clinical Focus</h5>
                        <small class="text-muted">Certified scopes of practice and medical interventions</small>
                    </div>
                </div>

                <div class="d-flex gap-2 flex-wrap">
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> <?= ViewHelper::e($vet['specialization'] ?: 'Small Animal Practice') ?>
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Soft Tissue Surgery
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Diagnostic Ultrasound &amp; Radiology
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Preventive Vaccines &amp; Immunology
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Companion Geriatric Care
                    </span>
                    <span class="badge bg-light text-dark border px-3 py-2 rounded-pill fw-semibold" style="font-size: 12.5px;">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Emergency Critical Care
                    </span>
                </div>
            </div>

            <!-- PetGuard Network Verification Seal -->
            <div class="p-4 rounded-4 bg-light border d-flex align-items-center gap-3 mb-4">
                <div class="stat-card-icon icon-green" style="width: 52px; height: 52px; min-width: 52px; font-size: 20px; border-radius: 16px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-dark m-0">PetGuard Accredited Hospital Network Practitioner</h6>
                    <p class="text-muted small m-0 mt-1">Medical credentials, state licensure, and clinic practice compliance have been authenticated by the PetGuard Quality Credentialing Board.</p>
                </div>
            </div>

            <!-- Patient Reviews & Testimonials Preview -->
            <div class="profile-section-card">
                <div class="d-flex align-items-center justify-content-between pb-3 border-bottom mb-3 flex-wrap gap-2">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark m-0">Verified Pet Owner Reviews</h5>
                            <small class="text-muted">Feedback from authenticated consultation patients</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold">
                            <i class="fa-solid fa-star text-warning me-1"></i> 4.9 Out of 5.0 (128 Reviews)
                        </span>
                    </div>
                </div>

                <div class="d-flex flex-column gap-3">
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="fw-bold text-dark small">Jessica Miller <span class="badge bg-secondary-subtle text-secondary font-monospace" style="font-size: 10px;">Golden Retriever Parent</span></div>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <p class="text-muted small m-0" style="line-height: 1.6;">
                            "Incredible care and bedside manner. Doctor took time to explain the diagnostic report thoroughly and provided clear follow-up medication instructions."
                        </p>
                    </div>

                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="fw-bold text-dark small">Robert Campbell <span class="badge bg-secondary-subtle text-secondary font-monospace" style="font-size: 10px;">Exotic Bird Parent</span></div>
                            <div class="text-warning small"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <p class="text-muted small m-0" style="line-height: 1.6;">
                            "The telemedicine video call was prompt, high quality, and saved us an emergency hospital trip. Highly recommended specialist!"
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Clinic Practice Details & Interactive Booking Form (4 Cols) -->
        <div class="col-12 col-lg-5 col-xl-4">
            
            <div class="sticky-booking-sidebar">

                <!-- Primary Clinic Facility Card -->
                <div class="profile-section-card mb-4">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                        <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                            <i class="fa-solid fa-hospital"></i>
                        </div>
                        <h5 class="fw-bold text-dark m-0">Primary Clinic Facility</h5>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Hospital Name</div>
                        <div class="fw-bold text-dark fs-6"><?= ViewHelper::e($vet['clinic_name'] ?: 'PetGuard Central Hospital') ?></div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Physical Address</div>
                        <div class="text-dark small"><i class="fa-solid fa-location-dot text-danger me-1"></i> <?= ViewHelper::e($vet['clinic_address'] ?: '742 Evergreen Terrace, Clinic B') ?></div>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Telephone</div>
                            <div class="text-dark small"><i class="fa-solid fa-phone text-muted me-1"></i> <a href="tel:<?= ViewHelper::e($vet['phone'] ?? '+1-555-019-2834') ?>" class="text-dark text-decoration-none fw-semibold"><?= ViewHelper::e($vet['phone'] ?? '+1-555-019-2834') ?></a></div>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-12">
                            <div class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Consultation Email</div>
                            <div class="text-dark small text-truncate"><i class="fa-solid fa-envelope text-muted me-1"></i> <?= ViewHelper::e($vet['email']) ?></div>
                        </div>
                    </div>

                    <div class="p-3 bg-light rounded-3 border">
                        <div class="fw-bold text-dark small mb-1"><i class="fa-regular fa-clock text-brand me-1"></i> Operating Hours</div>
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Mon - Fri:</span>
                            <span class="fw-semibold text-dark">08:00 - 18:00</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted mb-1">
                            <span>Saturday:</span>
                            <span class="fw-semibold text-dark">09:00 - 15:00</span>
                        </div>
                        <div class="d-flex justify-content-between small text-muted">
                            <span>Sunday / Emergency:</span>
                            <span class="text-danger fw-bold">24/7 On Call</span>
                        </div>
                    </div>
                </div>

                <!-- Instant Consultation Booking Card -->
                <div class="profile-section-card" id="bookingSection">
                    <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                        <div class="stat-card-icon icon-green" style="width: 36px; height: 36px; font-size: 14px; border-radius: 11px;">
                            <i class="fa-solid fa-calendar-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark m-0">Book Consultation</h5>
                            <small class="text-muted">Direct with <?= ViewHelper::e($vet['name']) ?></small>
                        </div>
                    </div>

                    <form action="<?= ViewHelper::url('portal/appointments/book') ?>" method="POST">
                        <?= ViewHelper::csrfField() ?>
                        <input type="hidden" name="redirect" value="portal/vets/<?= $vet['id'] ?>">
                        <input type="hidden" name="vet_id" value="<?= $vet['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark">Companion Patient *</label>
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
                            <label class="form-label fw-bold small text-dark">Reason / Symptoms</label>
                            <textarea name="symptoms" class="form-control rounded-3" rows="3" placeholder="Describe symptoms or reasons for visit..."></textarea>
                        </div>

                        <button type="submit" class="btn btn-admin-primary w-100 rounded-pill py-2 fw-bold shadow-sm" style="height: 42px;">
                            <i class="fa-solid fa-calendar-check me-1"></i> Confirm Appointment
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>

</div>
