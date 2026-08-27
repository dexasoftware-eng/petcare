<?php
use Helpers\ViewHelper;

$totalVets = count($vets);
?>

<style>
/* 5-Screen Breakpoint Layout for Veterinarians Directory */
.vets-directory-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}
.vet-hero-banner {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
    border-radius: 24px;
    padding: 28px 32px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 10px 25px -5px rgba(15, 23, 42, 0.15);
}
.vet-hero-banner::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 350px;
    height: 350px;
    background: radial-gradient(circle, rgba(255, 122, 24, 0.18) 0%, rgba(255, 122, 24, 0) 70%);
    pointer-events: none;
}
.vet-card {
    border-radius: 22px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.vet-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 18px 35px -8px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(255, 122, 24, 0.2);
    border-color: #cbd5e1;
}
.vet-avatar-box {
    width: 64px;
    height: 64px;
    min-width: 64px;
    border-radius: 18px;
    font-size: 26px;
    font-weight: 700;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #ff7a18 0%, #ff9f43 100%);
    box-shadow: 0 8px 16px rgba(255, 122, 24, 0.25);
    position: relative;
}
.vet-online-dot {
    position: absolute;
    bottom: -2px;
    right: -2px;
    width: 14px;
    height: 14px;
    background: #10b981;
    border: 2px solid #ffffff;
    border-radius: 50%;
}
.vet-action-btn-row {
    display: grid;
    grid-template-columns: 1.2fr 1fr 1fr;
    gap: 8px;
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .vet-hero-banner {
        padding: 20px 18px;
        border-radius: 18px;
    }
    .vet-avatar-box {
        width: 54px;
        height: 54px;
        min-width: 54px;
        font-size: 22px;
        border-radius: 14px;
    }
    .vet-action-btn-row {
        grid-template-columns: 1fr;
        gap: 6px;
    }
    .vet-filter-scroll {
        display: flex;
        overflow-x: auto;
        padding-bottom: 6px;
        gap: 6px;
        flex-wrap: nowrap !important;
        -webkit-overflow-scrolling: touch;
    }
    .vet-filter-btn {
        white-space: nowrap;
        font-size: 11.5px;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .vet-action-btn-row {
        grid-template-columns: 1.2fr 1fr 1fr;
        gap: 6px;
    }
}
@media (min-width: 768px) and (max-width: 991.98px) {
    .vet-hero-banner {
        padding: 24px 28px;
    }
}
</style>

<div class="vets-directory-wrapper py-2">

    <!-- Hero Header Banner -->
    <div class="vet-hero-banner mb-4">
        <div class="row align-items-center g-3">
            <div class="col-12 col-md-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-hospital-user text-brand"></i> Accredited Healthcare Directory
                </div>
                <h2 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Find Certified Veterinarians</h2>
                <p class="text-white-50 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Discover board-certified clinicians, surgical specialists, and emergency care physicians. Connect via 1-click encrypted telemedicine or schedule clinic visits with instant confirmation.
                </p>
            </div>
            <div class="col-12 col-md-4 text-md-end">
                <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-light rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13px;">
                    <i class="fa-regular fa-calendar-check text-brand"></i> My Appointments
                </a>
            </div>
        </div>
    </div>

    <!-- 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 20px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Accredited Vets</span>
                    <div class="stat-card-icon icon-blue" style="width: 38px; height: 38px; font-size: 15px; border-radius: 12px;">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalVets ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;"><i class="fa-solid fa-circle-check me-1"></i> 100% Board Certified</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 20px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Telemedicine</span>
                    <div class="stat-card-icon icon-green" style="width: 38px; height: 38px; font-size: 15px; border-radius: 12px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">HD Live</div>
                <small class="text-muted" style="font-size: 11px;">1-Click Video Calls</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 20px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Emergency</span>
                    <div class="stat-card-icon icon-red" style="width: 38px; height: 38px; font-size: 15px; border-radius: 12px;">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">24/7 Center</div>
                <small class="text-danger fw-semibold" style="font-size: 11px;">Rapid Response Triage</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 20px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 11px;">Scheduling</span>
                    <div class="stat-card-icon icon-orange" style="width: 38px; height: 38px; font-size: 15px; border-radius: 12px;">
                        <i class="fa-solid fa-calendar-plus"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">Instant</div>
                <small class="text-muted" style="font-size: 11px;">Direct Confirmation</small>
            </div>
        </div>
    </div>

    <!-- Search & Specialization Filter Bar -->
    <div class="admin-card p-3 p-md-4 shadow-sm mb-4" style="border-radius: 22px;">
        <div class="row g-3 align-items-center">
            <div class="col-12 col-lg-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0 rounded-start-pill ps-3"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" id="vetDirectorySearch" class="form-control bg-light border-start-0 rounded-end-pill py-2" placeholder="Search by doctor name, specialization, or clinic..." onkeyup="filterVetCards()">
                </div>
            </div>
            <div class="col-12 col-lg-7">
                <div class="d-flex gap-2 flex-wrap justify-content-lg-end vet-filter-scroll">
                    <button type="button" class="btn btn-sm btn-dark rounded-pill px-3 py-2 fw-bold vet-filter-btn active" data-spec="all" onclick="filterBySpecialization('all', this)">
                        All Specialists
                    </button>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold vet-filter-btn" data-spec="surgery" onclick="filterBySpecialization('surgery', this)">
                        Surgery &amp; Canine
                    </button>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold vet-filter-btn" data-spec="feline" onclick="filterBySpecialization('feline', this)">
                        Feline Care
                    </button>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold vet-filter-btn" data-spec="exotic" onclick="filterBySpecialization('exotic', this)">
                        Exotics &amp; Avian
                    </button>
                    <button type="button" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold vet-filter-btn" data-spec="orthopedic" onclick="filterBySpecialization('orthopedic', this)">
                        Orthopedics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Veterinarians Directory Grid -->
    <div class="row g-4" id="vetsGridContainer">
        <?php if (empty($vets)): ?>
            <div class="col-12">
                <div class="admin-card p-5 text-center text-muted" style="border-radius: 22px;">
                    <i class="fa-solid fa-user-doctor-slash fs-1 text-muted mb-3 d-block"></i>
                    <h5 class="fw-bold text-dark">No Certified Veterinarians Registered</h5>
                    <p class="small text-muted mb-0">No licensed medical practitioners found in the registry.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($vets as $v): ?>
                <?php
                    $isFav = in_array((int)$v['id'], $favIds ?? []);
                    $initial = strtoupper(substr($v['name'], 0, 1));
                ?>
                <div class="col-12 col-md-6 col-lg-4 vet-card-col" 
                     data-name="<?= strtolower(htmlspecialchars($v['name'])) ?>" 
                     data-spec="<?= strtolower(htmlspecialchars($v['specialization'])) ?>" 
                     data-clinic="<?= strtolower(htmlspecialchars($v['clinic_name'])) ?>">
                    
                    <div class="vet-card p-4 shadow-sm">
                        
                        <div>
                            <!-- Header / Avatar / Favorite Button -->
                            <div class="d-flex justify-content-between align-items-start gap-3 mb-3">
                                <div class="d-flex align-items-center gap-3 min-w-0">
                                    <div class="vet-avatar-box">
                                        <?= $initial ?>
                                        <span class="vet-online-dot" title="Online for Consultations"></span>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="d-flex align-items-center gap-1">
                                            <a href="<?= ViewHelper::url('portal/vets/' . $v['id']) ?>" class="fw-bold text-dark text-decoration-none text-truncate d-block" style="font-size: 16px;">
                                                <?= ViewHelper::e($v['name']) ?>
                                            </a>
                                            <i class="fa-solid fa-circle-check text-primary small flex-shrink-0" title="Board-Certified Practitioner"></i>
                                        </div>
                                        <div class="text-brand small fw-semibold text-truncate"><?= ViewHelper::e($v['specialization'] ?: 'General Veterinary Practice') ?></div>
                                        <div class="text-muted" style="font-size: 11px;"><i class="fa-solid fa-award me-1 text-warning"></i> <?= (int)($v['experience'] ?? 5) ?>+ Years Clinical Experience</div>
                                    </div>
                                </div>

                                <!-- Favorite Toggle Form -->
                                <form action="<?= ViewHelper::url('portal/vets/' . $v['id'] . '/favorite') ?>" method="POST" class="m-0 flex-shrink-0">
                                    <?= ViewHelper::csrfField() ?>
                                    <input type="hidden" name="redirect" value="portal/vets">
                                    <button type="submit" class="btn btn-sm btn-light rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center <?= $isFav ? 'text-danger' : 'text-muted' ?>" style="width: 36px; height: 36px; min-width: 36px; padding: 0;" title="<?= $isFav ? 'Remove Favorite' : 'Save as Favorite' ?>">
                                        <i class="fa-<?= $isFav ? 'solid' : 'regular' ?> fa-heart"></i>
                                    </button>
                                </form>
                            </div>

                            <!-- License Number & Review Rating Pills -->
                            <div class="d-flex gap-2 flex-wrap mb-3">
                                <span class="badge bg-light text-dark border font-monospace px-2 py-1" style="font-size: 10.5px;">
                                    <i class="fa-solid fa-id-card me-1 text-muted"></i> <?= ViewHelper::e($v['license_number'] ?: 'VET-CERT-APPROVED') ?>
                                </span>
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-bold" style="font-size: 10.5px;">
                                    <i class="fa-solid fa-star me-1 text-warning"></i> 4.9 (120+ Reviews)
                                </span>
                            </div>

                            <!-- Clinic & Physical Practice Location Card -->
                            <div class="p-3 rounded-3 bg-light border mb-3 small">
                                <div class="fw-bold text-dark mb-1 text-truncate" style="font-size: 12.5px;">
                                    <i class="fa-solid fa-hospital me-1 text-brand"></i> <?= ViewHelper::e($v['clinic_name'] ?: 'PetGuard Central Hospital') ?>
                                </div>
                                <div class="text-muted text-truncate" style="font-size: 11.5px;">
                                    <i class="fa-solid fa-location-dot me-1 text-danger"></i> <?= ViewHelper::e($v['clinic_address'] ?: 'Metro Clinical District') ?>
                                </div>
                            </div>

                            <!-- Bio Description Excerpt -->
                            <?php if (!empty($v['bio'])): ?>
                                <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; font-size: 12.5px; line-height: 1.55;">
                                    <?= ViewHelper::e($v['bio']) ?>
                                </p>
                            <?php endif; ?>
                        </div>

                        <!-- Card Action Buttons Grid -->
                        <div class="pt-3 border-top vet-action-btn-row">
                            <a href="<?= ViewHelper::url('portal/vets/' . $v['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm" style="font-size: 12px; min-height: 38px;">
                                <i class="fa-regular fa-eye"></i> View Profile
                            </a>
                            
                            <button type="button" class="btn btn-sm btn-success rounded-pill fw-bold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm" style="font-size: 12px; min-height: 38px;" onclick="PetGuardCall.initiateCall(<?= (int)$v['id'] ?>, 'video', 'direct')" title="Launch 1-Click Telemedicine Video Call">
                                <i class="fa-solid fa-video"></i> Call
                            </button>

                            <button type="button" class="btn btn-sm btn-admin-primary rounded-pill fw-bold d-inline-flex align-items-center justify-content-center gap-1 shadow-sm" style="font-size: 12px; min-height: 38px;" onclick="openBookModalForVet(<?= (int)$v['id'] ?>, '<?= addslashes($v['name']) ?>')" title="Book Clinic or Video Consultation">
                                <i class="fa-solid fa-calendar-plus"></i> Book
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<!-- Instant Appointment Booking Modal -->
<div class="modal fade" id="bookVetVisitModal" tabindex="-1" aria-labelledby="bookVetVisitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
            <div class="modal-header p-4 border-bottom bg-light" style="border-radius: 24px 24px 0 0;">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark m-0" id="bookVetVisitModalLabel">Book Clinical Consultation</h5>
                        <p class="text-muted small m-0" id="bookingVetSubtitle">With Certified Practitioner</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="<?= ViewHelper::url('portal/appointments/book') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="redirect" value="portal/vets">
                <input type="hidden" name="vet_id" id="bookingVetId" value="">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-dark">Select Companion Patient *</label>
                        <select name="pet_id" class="form-select rounded-3 py-2" required>
                            <?php if (empty($pets)): ?>
                                <option value="" disabled selected>No companions registered (Add a pet first)</option>
                            <?php else: ?>
                                <?php foreach ($pets as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?> - <?= ViewHelper::e($p['breed']) ?>)</option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-bold small text-dark">Consultation Date *</label>
                            <input type="date" name="appointment_date" class="form-control rounded-3 py-2" required min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-bold small text-dark">Preferred Time *</label>
                            <input type="time" name="appointment_time" class="form-control rounded-3 py-2" required value="10:00">
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

                    <div class="mb-2">
                        <label class="form-label fw-bold small text-dark">Reason / Symptoms</label>
                        <textarea name="symptoms" class="form-control rounded-3" rows="3" placeholder="Describe symptoms, routine checkup goals, or vaccination requests..."></textarea>
                    </div>
                </div>

                <div class="modal-footer p-3 bg-light border-top d-flex justify-content-between" style="border-radius: 0 0 24px 24px;">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-calendar-check me-1"></i> Confirm Booking
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openBookModalForVet(vetId, vetName) {
    document.getElementById('bookingVetId').value = vetId;
    document.getElementById('bookingVetSubtitle').textContent = 'Consultation with ' + vetName;
    const modal = new bootstrap.Modal(document.getElementById('bookVetVisitModal'));
    modal.show();
}

function filterVetCards() {
    const q = (document.getElementById('vetDirectorySearch').value || '').toLowerCase().trim();
    const cards = document.querySelectorAll('.vet-card-col');
    cards.forEach(card => {
        const name = card.getAttribute('data-name') || '';
        const spec = card.getAttribute('data-spec') || '';
        const clinic = card.getAttribute('data-clinic') || '';
        if (!q || name.includes(q) || spec.includes(q) || clinic.includes(q)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}

function filterBySpecialization(specKey, btn) {
    document.querySelectorAll('.vet-filter-btn').forEach(b => {
        b.classList.remove('btn-dark', 'active');
        b.classList.add('btn-light', 'border');
    });
    btn.classList.remove('btn-light', 'border');
    btn.classList.add('btn-dark', 'active');

    const cards = document.querySelectorAll('.vet-card-col');
    cards.forEach(card => {
        const spec = card.getAttribute('data-spec') || '';
        if (specKey === 'all' || spec.includes(specKey)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>
