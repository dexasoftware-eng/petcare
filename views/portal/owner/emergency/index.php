<?php
use Helpers\ViewHelper;
?>

<style>
/* Emergency Center Layout */
.emergency-container {
    max-width: 1360px;
    margin: 0 auto;
    width: 100%;
}

/* Urgent 24/7 Red Hero Banner */
.emergency-hero-banner {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 50%, #7f1d1d 100%);
    border-radius: 24px;
    padding: 32px;
    color: #ffffff;
    position: relative;
    overflow: hidden;
    box-shadow: 0 12px 32px -6px rgba(185, 28, 28, 0.35);
}
.emergency-hero-banner::after {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
    pointer-events: none;
}

/* Pulsing Red Dot */
.emergency-live-pulse {
    display: inline-block;
    width: 10px;
    height: 10px;
    background: #ef4444;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
    animation: emergencyPulse 1.5s infinite;
}
@keyframes emergencyPulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(255, 255, 255, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
}

/* Emergency Pet Card */
.emergency-pet-card {
    background: #ffffff;
    border: 1px solid #fee2e2;
    border-radius: 20px;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
}
.emergency-pet-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 32px -6px rgba(220, 38, 38, 0.12);
    border-color: #fca5a5;
}

/* Severity Cards */
.severity-card-red {
    background: #fff5f5;
    border: 1px solid #fed7d7;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
}
.severity-card-yellow {
    background: #fffdf0;
    border: 1px solid #feebc8;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
}
.severity-card-green {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .emergency-hero-banner {
        padding: 20px 18px;
        border-radius: 18px;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .emergency-hero-banner {
        padding: 24px 22px;
    }
}
</style>

<div class="emergency-container py-2">

    <!-- Urgent 24/7 Emergency Hotline Hero Banner -->
    <div class="emergency-hero-banner mb-4">
        <div class="row align-items-center g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-20 text-white small fw-bold mb-2 border border-white border-opacity-20">
                    <span class="emergency-live-pulse"></span> 24/7 Rapid Triage &amp; Critical Trauma Support
                </div>
                <h2 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Emergency Veterinary Center</h2>
                <p class="text-white-50 small mb-0" style="max-width: 650px; line-height: 1.6;">
                    If your pet is suffering from breathing distress, toxic poison ingestion, severe physical trauma, continuous seizures, or acute collapse, call the emergency hotline immediately.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <div class="d-flex flex-column gap-2 justify-content-lg-end">
                    <a href="tel:+18005557389" class="btn btn-light rounded-pill px-4 py-3 fs-6 fw-bold text-danger shadow-sm d-inline-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-phone-volume fs-5"></i> Call Hotline: +1 (800) 555-PET-911
                    </a>
                    <a href="<?= ViewHelper::url('portal/vets') ?>" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center justify-content-center gap-2" style="font-size: 13px;">
                        <i class="fa-solid fa-video"></i> 1-Click Video Telemedicine Triage
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- 4 Triage Quick Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Acute Hotline</span>
                    <div class="stat-card-icon icon-red" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-truck-medical"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-danger mb-0">24/7 Available</div>
                <small class="text-muted" style="font-size: 11px;">Zero Wait Triage Line</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Poison Helpline</span>
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-flask-vial"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0">ASPCA Helpline</div>
                <small class="text-muted" style="font-size: 11px;">(888) 426-4435</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Video Triage</span>
                    <div class="stat-card-icon icon-green" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0">Live Vet Call</div>
                <small class="text-success fw-semibold" style="font-size: 11px;">1-Click WebRTC</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Emergency Cards</span>
                    <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0"><?= count($pets) ?> Registered</div>
                <small class="text-muted" style="font-size: 11px;">Print-Ready Passes</small>
            </div>
        </div>
    </div>

    <!-- Emergency Triage Symptom Severity Matrix -->
    <div class="admin-card p-4 mb-4" style="border-radius: 22px;">
        <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-4">
            <div class="stat-card-icon icon-red" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Emergency Triage &amp; Action Protocol</h5>
                <p class="text-muted small m-0">Assess symptoms to determine whether your pet requires immediate emergency hospitalization</p>
            </div>
        </div>

        <div class="row g-3">
            <!-- Red Alert: Immediate ER Hospitalization -->
            <div class="col-12 col-md-4">
                <div class="severity-card-red">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-danger text-white rounded-pill px-3 py-1 fw-bold text-uppercase" style="font-size: 10.5px;">
                            <i class="fa-solid fa-circle-exclamation me-1"></i> Red Alert — Immediate ER
                        </span>
                    </div>
                    <h6 class="fw-bold text-danger mb-2">Life-Threatening Symptoms:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.7; font-size: 12px;">
                        <li>Severe breathing difficulty, choking, blue gums</li>
                        <li>Arterial bleeding that won't stop with pressure</li>
                        <li>Seizures lasting &gt;2 minutes or multiple clusters</li>
                        <li>Suspected GDV / rapid abdominal distention</li>
                        <li>Ingestion of toxic poison (antifreeze, lilies, xylitol)</li>
                        <li>Severe vehicular trauma, fall, or blunt collision</li>
                    </ul>
                </div>
            </div>

            <!-- Yellow Alert: Urgent Care Within 2-4 Hours -->
            <div class="col-12 col-md-4">
                <div class="severity-card-yellow">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold text-uppercase" style="font-size: 10.5px;">
                            <i class="fa-solid fa-clock me-1"></i> Yellow Alert — Urgent (2-4 Hrs)
                        </span>
                    </div>
                    <h6 class="fw-bold text-dark mb-2">Urgent Medical Attention:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.7; font-size: 12px;">
                        <li>Repeated vomiting or diarrhea &gt;12 hours</li>
                        <li>Straining or inability to urinate (especially male cats)</li>
                        <li>Sudden weakness, disorientation, or collapse</li>
                        <li>Eye injury, corneal laceration, or sudden cloudiness</li>
                        <li>Deep lacerations or suspected bone fracture</li>
                        <li>High fever, extreme lethargy, or refusal to drink</li>
                    </ul>
                </div>
            </div>

            <!-- Green: First Aid Stabilization Tips -->
            <div class="col-12 col-md-4">
                <div class="severity-card-green">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-success text-white rounded-pill px-3 py-1 fw-bold text-uppercase" style="font-size: 10.5px;">
                            <i class="fa-solid fa-shield-heart me-1"></i> First Aid Rules
                        </span>
                    </div>
                    <h6 class="fw-bold text-success mb-2">Before Arriving at the Hospital:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.7; font-size: 12px;">
                        <li><strong>Keep Warm:</strong> Wrap pet gently in a clean blanket.</li>
                        <li><strong>Never Give Human Meds:</strong> Aspirin, Tylenol, and Ibuprofen are fatal to dogs and cats.</li>
                        <li><strong>Bleeding:</strong> Apply continuous direct gauze pressure.</li>
                        <li><strong>Poison:</strong> Bring container, plant sample, or packaging.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Printable Emergency Pet ID Cards per Companion -->
    <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
        <h4 class="fw-bold text-dark m-0"><i class="fa-solid fa-id-card-clip text-danger me-2"></i> Printable Emergency Medical ID Passes</h4>
        <small class="text-muted">Instant wallet-sized printable medical identity cards</small>
    </div>

    <div class="row g-4 mb-4">
        <?php if (empty($pets)): ?>
            <div class="col-12">
                <div class="admin-card p-4 text-center text-muted" style="border-radius: 20px;">
                    <i class="fa-solid fa-paw fs-1 text-muted mb-2 d-block"></i>
                    <p class="mb-0">No companion pets registered. Add a pet to generate an emergency card.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($pets as $pet): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="emergency-pet-card p-4">
                        <div>
                            <!-- Header: Avatar + Name + Species -->
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border border-danger-subtle shadow-sm flex-shrink-0" style="width: 64px; height: 64px; object-fit: contain; background: #fff8e5;">
                                <div class="min-w-0 flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="fw-bold text-dark m-0 text-truncate"><?= ViewHelper::e($pet['name']) ?></h5>
                                        <span class="badge bg-danger-subtle text-danger font-monospace" style="font-size: 10px;">ID: #<?= (int)$pet['id'] ?></span>
                                    </div>
                                    <small class="text-muted text-truncate d-block"><?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed'] ?: 'Purebred/Mixed') ?></small>
                                    <small class="text-muted"><?= ViewHelper::e($pet['gender']) ?> &bull; <?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></small>
                                </div>
                            </div>

                            <!-- Medical Facts Box -->
                            <div class="p-3 bg-light rounded-3 border mb-3 small">
                                <div class="mb-1 text-danger">
                                    <strong><i class="fa-solid fa-triangle-exclamation me-1"></i> Allergies:</strong> 
                                    <span class="fw-semibold"><?= ViewHelper::e($pet['allergies'] ?: 'No recorded allergies') ?></span>
                                </div>
                                <div class="mb-1 text-dark">
                                    <strong><i class="fa-solid fa-droplet text-danger me-1"></i> Blood Group:</strong> 
                                    <span><?= ViewHelper::e($pet['blood_group'] ?: 'Standard') ?></span>
                                </div>
                                <div class="text-dark">
                                    <strong><i class="fa-solid fa-microchip text-primary me-1"></i> Microchip ID:</strong> 
                                    <code class="fw-bold text-dark"><?= ViewHelper::e($pet['microchip_id'] ?: 'Pending Assign') ?></code>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 pt-2 border-top">
                            <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-sm btn-danger rounded-pill fw-bold flex-fill d-inline-flex align-items-center justify-content-center gap-1 shadow-sm py-2" target="_blank">
                                <i class="fa-solid fa-print"></i> Print Trauma Card
                            </a>
                            <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold d-inline-flex align-items-center justify-content-center gap-1 px-3 py-2">
                                <i class="fa-regular fa-eye"></i> Details
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Registered Emergency Contacts & On-Call ER Hospitals Grid -->
    <div class="row g-4">
        
        <!-- Left: Registered User Emergency Contacts -->
        <div class="col-12 col-lg-7">
            <div class="admin-card p-4 h-100" style="border-radius: 22px;">
                <div class="d-flex justify-content-between align-items-center pb-3 border-bottom mb-3">
                    <div class="d-flex align-items-center gap-2">
                        <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <h5 class="fw-bold text-dark m-0">Registered Emergency Contacts</h5>
                    </div>
                </div>

                <?php if (empty($contacts)): ?>
                    <div class="p-4 text-center text-muted bg-light rounded-3 border">
                        <i class="fa-solid fa-phone-slash fs-2 text-muted mb-2 d-block"></i>
                        <p class="small mb-0">No dedicated emergency contacts added yet. Defaulting to registered pet owner contact.</p>
                    </div>
                <?php else: ?>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($contacts as $c): ?>
                            <div class="p-3 rounded-3 border bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <div>
                                    <div class="fw-bold text-dark">
                                        <?= ViewHelper::e($c['contact_name']) ?> 
                                        <span class="badge bg-white text-secondary border font-monospace ms-1"><?= ViewHelper::e($c['relationship']) ?></span>
                                    </div>
                                    <div class="small text-muted mt-1">
                                        <i class="fa-solid fa-phone text-success me-1"></i> <strong><?= ViewHelper::e($c['phone']) ?></strong>
                                    </div>
                                    <?php if (!empty($c['clinic_name'])): ?>
                                        <small class="text-muted d-block mt-1"><i class="fa-solid fa-hospital text-brand me-1"></i> <?= ViewHelper::e($c['clinic_name']) ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="tel:<?= urlencode($c['phone']) ?>" class="btn btn-sm btn-success rounded-pill px-3 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-1">
                                        <i class="fa-solid fa-phone"></i> Call Now
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Partner 24/7 Veterinary Emergency Centers -->
        <div class="col-12 col-lg-5">
            <div class="admin-card p-4 h-100" style="border-radius: 22px;">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-red" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-hospital"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">Accredited 24/7 Animal ER Centers</h5>
                </div>

                <div class="d-flex flex-column gap-3">
                    <!-- ER Hospital 1 -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="fw-bold text-dark small">PetGuard Central Trauma Hospital</div>
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1" style="font-size: 9.5px;">24/7 Open</span>
                        </div>
                        <div class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-1"></i> 742 Evergreen Terrace, Trauma Pavilion</div>
                        <a href="tel:+18005557389" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-bold w-100 d-inline-flex align-items-center justify-content-center gap-1">
                            <i class="fa-solid fa-phone"></i> Call (800) 555-7389
                        </a>
                    </div>

                    <!-- ER Hospital 2 -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <div class="fw-bold text-dark small">Metro Specialty &amp; Emergency Animal Center</div>
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1" style="font-size: 9.5px;">24/7 Open</span>
                        </div>
                        <div class="text-muted small mb-2"><i class="fa-solid fa-location-dot text-danger me-1"></i> 880 Central Parkway, Medical District</div>
                        <a href="tel:+15550134488" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-bold w-100 d-inline-flex align-items-center justify-content-center gap-1">
                            <i class="fa-solid fa-phone"></i> Call (555) 013-4488
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
