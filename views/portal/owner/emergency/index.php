<?php
use Helpers\ViewHelper;
?>

<style>
/* 5-Screen Responsive Emergency Center Layout */
.emergency-container {
    max-width: 1360px;
    margin: 0 auto;
    width: 100%;
}

/* Urgent 24/7 Red Hero Banner */
.emergency-hero-banner {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 50%, #7f1d1d 100%);
    border-radius: 24px;
    padding: 28px 32px;
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
    width: 360px;
    height: 360px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.16) 0%, rgba(255, 255, 255, 0) 70%);
    pointer-events: none;
}

/* Pulsing Red Dot */
.emergency-live-pulse {
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #dc2626;
    border-radius: 50%;
    box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7);
    animation: emergencyPulse 1.5s infinite;
}
@keyframes emergencyPulse {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 8px rgba(220, 38, 38, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(220, 38, 38, 0); }
}

/* Emergency Pet Card */
.emergency-pet-card {
    background: #ffffff;
    border: 1px solid #fecaca;
    border-radius: 20px;
    transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 100%;
    width: 100%;
    max-width: 100%;
    overflow: hidden;
    box-sizing: border-box;
}
.emergency-pet-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 16px 32px -6px rgba(220, 38, 38, 0.14);
    border-color: #f87171;
}

.emergency-pet-avatar {
    width: 58px;
    height: 58px;
    min-width: 58px;
    border-radius: 16px;
    object-fit: contain;
    background: #fff8e5;
    border: 1px solid #fee2e2;
    padding: 3px;
    flex-shrink: 0;
}

/* Severity Protocol Cards */
.severity-card-red {
    background: #fff5f5;
    border: 1px solid #fed7d7;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.severity-card-yellow {
    background: #fffdf0;
    border: 1px solid #feebc8;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}
.severity-card-green {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 18px;
    padding: 20px;
    height: 100%;
    display: flex;
    flex-direction: column;
}

/* 5-Screen Breakpoints */
@media (max-width: 575.98px) {
    .emergency-hero-banner {
        padding: 20px 16px;
        border-radius: 18px;
    }
    .emergency-pet-avatar {
        width: 50px;
        height: 50px;
        min-width: 50px;
        border-radius: 14px;
    }
}
@media (min-width: 576px) and (max-width: 767.98px) {
    .emergency-hero-banner {
        padding: 24px 20px;
    }
}
</style>

<div class="emergency-container py-2">

    <!-- Urgent 24/7 Emergency Hotline Hero Banner -->
    <div class="emergency-hero-banner mb-4">
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white text-danger small fw-bold mb-2 shadow-sm" style="font-size: 11px; letter-spacing: 0.4px;">
            <span class="emergency-live-pulse"></span> 24/7 Rapid Triage &amp; Critical Trauma Support
        </div>
        <h2 class="fw-bold text-white mb-2" style="letter-spacing: -0.5px;">Emergency Veterinary Center</h2>
        <p class="text-white-50 small mb-0" style="max-width: 780px; line-height: 1.6;">
            If your companion is in acute distress (breathing difficulty, toxic ingestion, severe trauma, or continuous seizures), follow the emergency action protocol below or reach out to on-call emergency hospital centers.
        </p>
    </div>

    <!-- 4 Triage Quick Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Acute Hotline</span>
                    <div class="stat-card-icon icon-red" style="width: 38px; height: 38px; font-size: 15px; border-radius: 11px;">
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
                    <div class="stat-card-icon icon-orange" style="width: 38px; height: 38px; font-size: 15px; border-radius: 11px;">
                        <i class="fa-solid fa-flask-vial"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0">ASPCA Control</div>
                <small class="text-muted" style="font-size: 11px;">(888) 426-4435</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Video Triage</span>
                    <div class="stat-card-icon icon-green" style="width: 38px; height: 38px; font-size: 15px; border-radius: 11px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0">HD Live Call</div>
                <small class="text-success fw-semibold" style="font-size: 11px;"><i class="fa-solid fa-circle-check me-1"></i> 1-Click WebRTC</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card p-3 p-md-4 shadow-sm border h-100" style="border-radius: 18px; background: #ffffff;">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Emergency Cards</span>
                    <div class="stat-card-icon icon-blue" style="width: 38px; height: 38px; font-size: 15px; border-radius: 11px;">
                        <i class="fa-solid fa-id-card-clip"></i>
                    </div>
                </div>
                <div class="fs-5 fw-bold text-dark mb-0"><?= count($pets) ?> Registered</div>
                <small class="text-muted" style="font-size: 11px;">Print-Ready Passes</small>
            </div>
        </div>
    </div>

    <!-- Emergency Triage Symptom Severity Matrix -->
    <div class="admin-card p-3 p-md-4 mb-4" style="border-radius: 20px;">
        <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
            <div class="stat-card-icon icon-red" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Emergency Triage &amp; Action Protocol</h5>
                <p class="text-muted small m-0">Assess symptoms to determine whether your companion requires immediate emergency hospitalization</p>
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
                    <h6 class="fw-bold text-danger mb-2" style="font-size: 13.5px;">Life-Threatening Symptoms:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.65; font-size: 11.5px;">
                        <li>Severe respiratory distress, choking, blue gums</li>
                        <li>Arterial bleeding that will not cease with pressure</li>
                        <li>Seizures lasting &gt;2 minutes or multiple clusters</li>
                        <li>Suspected GDV / rapid abdominal distention</li>
                        <li>Ingestion of toxic poisons (antifreeze, lilies, xylitol)</li>
                        <li>Severe vehicular trauma, high fall, or collision</li>
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
                    <h6 class="fw-bold text-dark mb-2" style="font-size: 13.5px;">Urgent Medical Attention:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.65; font-size: 11.5px;">
                        <li>Repeated vomiting or severe diarrhea &gt;12 hours</li>
                        <li>Straining or inability to urinate (especially male cats)</li>
                        <li>Sudden weakness, disorientation, or collapse</li>
                        <li>Eye injury, corneal laceration, or cloudiness</li>
                        <li>Deep lacerations or suspected limb fracture</li>
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
                    <h6 class="fw-bold text-success mb-2" style="font-size: 13.5px;">Before Arriving at ER:</h6>
                    <ul class="text-muted small ps-3 mb-0" style="line-height: 1.65; font-size: 11.5px;">
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
        <div>
            <h4 class="fw-bold text-dark m-0"><i class="fa-solid fa-id-card-clip text-danger me-2"></i> Printable Emergency Medical ID Passes</h4>
            <small class="text-muted">Instant wallet-sized printable medical identity cards</small>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <?php if (empty($pets)): ?>
            <div class="col-12">
                <div class="admin-card p-4 text-center text-muted" style="border-radius: 20px;">
                    <i class="fa-solid fa-paw fs-1 text-muted mb-2 d-block"></i>
                    <p class="mb-0">No companion pets registered. Add a pet to generate an emergency card.</p>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($pets as $pet): ?>
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="emergency-pet-card p-3 p-sm-4">
                        
                        <div class="w-100 min-w-0" style="overflow: hidden;">
                            <!-- Header: Avatar + Name + Species -->
                            <div class="d-flex gap-3 align-items-center mb-3">
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="emergency-pet-avatar">
                                <div class="min-w-0 flex-grow-1" style="overflow: hidden;">
                                    <div class="d-flex align-items-center justify-content-between gap-1">
                                        <h5 class="fw-bold text-dark m-0 text-truncate" style="font-size: 16px;"><?= ViewHelper::e($pet['name']) ?></h5>
                                        <span class="badge bg-danger-subtle text-danger font-monospace flex-shrink-0" style="font-size: 10px;">ID: #<?= (int)$pet['id'] ?></span>
                                    </div>
                                    <small class="text-muted text-truncate d-block" style="font-size: 11.5px;"><?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed'] ?: 'Purebred/Mixed') ?></small>
                                    <small class="text-muted" style="font-size: 11px;"><?= ViewHelper::e($pet['gender']) ?> &bull; <?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></small>
                                </div>
                            </div>

                            <!-- Medical Facts Box -->
                            <div class="p-3 bg-light rounded-3 border mb-3 small" style="overflow: hidden; word-break: break-word;">
                                <div class="mb-1 text-danger text-truncate">
                                    <strong><i class="fa-solid fa-triangle-exclamation me-1"></i> Allergies:</strong> 
                                    <span class="fw-semibold"><?= ViewHelper::e($pet['allergies'] ?: 'No recorded allergies') ?></span>
                                </div>
                                <div class="mb-1 text-dark text-truncate">
                                    <strong><i class="fa-solid fa-droplet text-danger me-1"></i> Blood Group:</strong> 
                                    <span><?= ViewHelper::e($pet['blood_group'] ?: 'Standard') ?></span>
                                </div>
                                <div class="text-dark text-truncate">
                                    <strong><i class="fa-solid fa-microchip text-primary me-1"></i> Microchip ID:</strong> 
                                    <code class="fw-bold text-dark"><?= ViewHelper::e($pet['microchip_id'] ?: 'Pending Assign') ?></code>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex gap-2 pt-2 border-top w-100">
                            <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-sm btn-danger rounded-pill fw-bold flex-fill d-inline-flex align-items-center justify-content-center gap-1 shadow-sm text-truncate px-2" style="height: 38px; font-size: 12px; min-width: 0;" target="_blank">
                                <i class="fa-solid fa-print flex-shrink-0"></i> <span class="text-truncate">Print Trauma Pass</span>
                            </a>
                            <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold d-inline-flex align-items-center justify-content-center gap-1 px-3 text-truncate" style="height: 38px; font-size: 12px; min-width: 0;">
                                <i class="fa-regular fa-eye flex-shrink-0"></i> <span class="text-truncate">Details</span>
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
            <div class="admin-card p-4 h-100" style="border-radius: 20px;">
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
                                <div class="min-w-0 flex-grow-1" style="overflow: hidden;">
                                    <div class="fw-bold text-dark text-truncate">
                                        <?= ViewHelper::e($c['contact_name']) ?> 
                                        <span class="badge bg-white text-secondary border font-monospace ms-1"><?= ViewHelper::e($c['relationship']) ?></span>
                                    </div>
                                    <div class="small text-muted mt-1 text-truncate">
                                        <i class="fa-solid fa-phone text-success me-1"></i> <strong><?= ViewHelper::e($c['phone']) ?></strong>
                                    </div>
                                    <?php if (!empty($c['clinic_name'])): ?>
                                        <small class="text-muted d-block mt-1 text-truncate"><i class="fa-solid fa-hospital text-brand me-1"></i> <?= ViewHelper::e($c['clinic_name']) ?></small>
                                    <?php endif; ?>
                                </div>
                                <div class="d-flex gap-2 flex-shrink-0">
                                    <a href="tel:<?= urlencode($c['phone']) ?>" class="btn btn-sm btn-success rounded-pill px-3 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-1" style="font-size: 12px;">
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
            <div class="admin-card p-4 h-100" style="border-radius: 20px;">
                <div class="d-flex align-items-center gap-2 pb-3 border-bottom mb-3">
                    <div class="stat-card-icon icon-red" style="width: 36px; height: 36px; font-size: 14px; border-radius: 10px;">
                        <i class="fa-solid fa-hospital"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">Accredited 24/7 Animal ER Centers</h5>
                </div>

                <div class="d-flex flex-column gap-3">
                    <!-- ER Hospital 1 -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-start mb-1 gap-2">
                            <div class="fw-bold text-dark small text-truncate">PetGuard Central Trauma Hospital</div>
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 flex-shrink-0" style="font-size: 9.5px;">24/7 Open</span>
                        </div>
                        <div class="text-muted small mb-2 text-truncate" style="font-size: 11.5px;"><i class="fa-solid fa-location-dot text-danger me-1"></i> 742 Evergreen Terrace, Trauma Pavilion</div>
                        <a href="tel:+18005557389" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-bold w-100 d-inline-flex align-items-center justify-content-center gap-1" style="font-size: 12px; height: 36px;">
                            <i class="fa-solid fa-phone"></i> Call (800) 555-7389
                        </a>
                    </div>

                    <!-- ER Hospital 2 -->
                    <div class="p-3 rounded-3 bg-light border">
                        <div class="d-flex justify-content-between align-items-start mb-1 gap-2">
                            <div class="fw-bold text-dark small text-truncate">Metro Specialty &amp; Emergency Animal Center</div>
                            <span class="badge bg-danger text-white rounded-pill px-2 py-1 flex-shrink-0" style="font-size: 9.5px;">24/7 Open</span>
                        </div>
                        <div class="text-muted small mb-2 text-truncate" style="font-size: 11.5px;"><i class="fa-solid fa-location-dot text-danger me-1"></i> 880 Central Parkway, Medical District</div>
                        <a href="tel:+15550134488" class="btn btn-sm btn-outline-danger rounded-pill px-3 py-1 fw-bold w-100 d-inline-flex align-items-center justify-content-center gap-1" style="font-size: 12px; height: 36px;">
                            <i class="fa-solid fa-phone"></i> Call (555) 013-4488
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
