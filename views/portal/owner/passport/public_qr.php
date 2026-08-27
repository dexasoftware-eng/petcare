<?php
use Helpers\ViewHelper;

$isLost = !empty($pet['is_lost']);
$ownerPhone = $owner['phone'] ?? '+1-800-555-7389';
$cleanPhone = preg_replace('/[^0-9+]/', '', $ownerPhone);
$ownerName = $owner['name'] ?? 'Pet Parent';
$regId = 'PG-REG-' . strtoupper(substr(md5($pet['id'] . $pet['name']), 0, 8));
?>

<style>
.metric-tile {
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.metric-tile:hover {
    transform: translateY(-2px);
    border-color: #cbd5e1 !important;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06) !important;
}
@media (max-width: 575.98px) {
    .metric-tile {
        padding: 12px 8px !important;
    }
}
</style>

<!-- 1. PetGuard Banner & Breadcrumb (Guarantees Perfect Navbar Offset) -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>'); padding: 45px 0;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 text-center text-md-start d-md-flex justify-content-between align-items-center">
                <div class="banner-text mb-3 mb-md-0">
                    <h2 class="fw-bold mb-1" style="font-family: var(--font-heading, inherit);">Digital Pet Passport</h2>
                    <ol class="breadcrumb m-0 justify-content-center justify-content-md-start">
                        <li class="breadcrumb-item"><a href="<?= ViewHelper::url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ViewHelper::url('portal/pets') ?>">Registry</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ViewHelper::e($pet['name']) ?> (<?= ViewHelper::e($pet['qr_token']) ?>)</li>
                    </ol>
                </div>
                <div>
                    <span class="badge bg-white text-dark border rounded-pill px-3 py-2 shadow-sm font-monospace">
                        <i class="fa-solid fa-shield-halved text-success me-1"></i> Public Verified Registry
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Main Passport Section -->
<section class="py-4 py-md-5" style="background: #fdfbf7; min-height: 80vh;">
    <div class="container">
        
        <!-- Top Navigation Context -->
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 mx-auto" style="max-width: 760px;">
            <a href="<?= ViewHelper::url('/') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold">
                <i class="fa-solid fa-arrow-left me-1"></i> PetGuard Home
            </a>
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-light text-dark border rounded-pill px-3 py-2 font-monospace small">
                    <i class="fa-solid fa-qrcode text-brand me-1"></i> Scanned Tag
                </span>
                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 font-monospace small">
                    <i class="fa-solid fa-circle-check me-1"></i> Official Record
                </span>
            </div>
        </div>

        <!-- Main Digital Passport Document Card -->
        <div class="card card-custom p-0 overflow-hidden mx-auto border-0 shadow-lg" style="max-width: 760px; border-radius: 24px; background: #ffffff; box-shadow: 0 25px 60px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(0,0,0,0.06);">
            
            <!-- 1. Official Passport Header Strip -->
            <?php if ($isLost): ?>
                <div class="p-4 text-center text-white position-relative" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
                    <div class="rounded-circle bg-white text-danger d-inline-flex align-items-center justify-content-center mb-2 shadow" style="width: 56px; height: 56px; font-size: 26px;">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <h3 class="fw-bold m-0 text-uppercase" style="letter-spacing: 1.5px; font-family: var(--font-heading, inherit);">⚠️ EMERGENCY: LOST PET ALERT</h3>
                    <p class="small text-white-50 m-0 mt-1">This companion is reported missing by their family. Please contact the owner or emergency line below.</p>
                </div>
            <?php else: ?>
                <div class="p-4 text-white position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-bottom: 4px solid #fa441d;">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-white p-2 d-inline-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px;">
                                <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard" style="height: 28px;">
                            </div>
                            <div>
                                <h4 class="fw-bold m-0 text-white" style="font-family: 'DynaPuff', cursive; letter-spacing: 0.5px;">PetGuard Global Registry</h4>
                                <small class="text-white-50 text-uppercase fw-semibold" style="font-size: 11px; letter-spacing: 1px;">Official Companion Identity &amp; Digital Passport</small>
                            </div>
                        </div>
                        <span class="badge bg-success text-white rounded-pill px-3 py-2 fw-bold font-monospace shadow-sm" style="font-size: 11.5px;">
                            <i class="fa-solid fa-shield-halved me-1"></i> PASSPORT ACTIVE
                        </span>
                    </div>
                </div>
            <?php endif; ?>

            <!-- 2. Main Passport Body -->
            <div class="p-4 p-md-5">
                
                <!-- Urgent Missing Area Details (If Lost) -->
                <?php if ($isLost): ?>
                    <div class="alert alert-danger rounded-4 p-3 p-md-4 mb-4 border-2 border-danger" style="background: #fff5f5;">
                        <h6 class="fw-bold text-danger mb-2"><i class="fa-solid fa-location-dot me-1"></i> Missing Area Details:</h6>
                        <?php if (!empty($pet['lost_location'])): ?>
                            <div class="mb-1 text-dark small"><strong>Last Seen:</strong> <?= ViewHelper::e($pet['lost_location']) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($pet['lost_date'])): ?>
                            <div class="mb-1 text-dark small"><strong>Date Reported:</strong> <?= date('F j, Y', strtotime($pet['lost_date'])) ?></div>
                        <?php endif; ?>
                        <?php if (!empty($pet['lost_notes'])): ?>
                            <div class="text-muted small mt-2 p-2 rounded-3 bg-white border">
                                <em>"<?= ViewHelper::e($pet['lost_notes']) ?>"</em>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <!-- Biometrics Header: Avatar + Primary Identity -->
                <div class="d-flex flex-column flex-sm-row align-items-center align-items-sm-start gap-4 pb-4 mb-4 border-bottom">
                    
                    <!-- Portrait & Security Stamp -->
                    <div class="position-relative flex-shrink-0 text-center">
                        <div class="p-2 bg-white rounded-4 border shadow-sm" style="background: #fff8e5;">
                            <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-3" style="width: 130px; height: 130px; object-fit: contain; background: #fff8e5;">
                        </div>
                        <span class="position-absolute bottom-0 start-50 translate-middle-x badge bg-dark text-warning rounded-pill px-3 py-1 shadow-sm font-monospace" style="font-size: 10px; white-space: nowrap; transform: translate(-50%, 50%) !important;">
                            <?= ViewHelper::e($pet['qr_token']) ?>
                        </span>
                    </div>

                    <!-- Companion Identity & Microchip -->
                    <div class="flex-grow-1 text-center text-sm-start mt-2 mt-sm-0">
                        <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 flex-wrap mb-1">
                            <h2 class="fw-bold text-dark m-0" style="font-family: var(--font-heading, inherit);"><?= ViewHelper::e($pet['name']) ?></h2>
                            <span class="badge bg-light text-dark border rounded-pill px-3 py-1 font-monospace small">
                                <?= ViewHelper::e($pet['gender']) ?>
                            </span>
                        </div>
                        
                        <div class="text-muted fs-6 mb-3">
                            <i class="fa-solid fa-paw text-brand me-1"></i>
                            <?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed'] ?: 'Purebred/Mixed') ?>
                        </div>

                        <!-- ISO Microchip Code -->
                        <div class="p-2 px-3 bg-light rounded-3 border d-inline-flex align-items-center gap-2 small">
                            <i class="fa-solid fa-microchip text-primary"></i>
                            <span class="text-muted">Microchip ID:</span>
                            <strong class="font-monospace text-dark"><?= ViewHelper::e($pet['microchip_id'] ?: '985141008837192') ?></strong>
                        </div>
                    </div>
                </div>

                <!-- 4 Vital Biometrics Grid (5-Screen Optimized) -->
                <div class="row g-3 mb-4">
                    <!-- 1. Age Tile -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-white border text-center h-100 d-flex flex-column justify-content-between shadow-sm metric-tile" style="transition: all 0.2s ease;">
                            <div>
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; background: #fff2ee; color: #fa441d;">
                                    <i class="fa-solid fa-cake-candles fs-6"></i>
                                </div>
                                <div class="text-muted fw-bold text-uppercase" style="font-size: 10.5px; letter-spacing: 0.6px;">Age / Life Stage</div>
                            </div>
                            <div class="pt-2">
                                <strong class="text-dark d-block fw-bold" style="font-size: 14px; line-height: 1.3;"><?= ViewHelper::e($pet['age'] ?: 'Unknown') ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Weight Tile -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-white border text-center h-100 d-flex flex-column justify-content-between shadow-sm metric-tile" style="transition: all 0.2s ease;">
                            <div>
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; background: #eff6ff; color: #3b82f6;">
                                    <i class="fa-solid fa-weight-scale fs-6"></i>
                                </div>
                                <div class="text-muted fw-bold text-uppercase" style="font-size: 10.5px; letter-spacing: 0.6px;">Body Weight</div>
                            </div>
                            <div class="pt-2">
                                <strong class="text-dark d-block fw-bold font-monospace" style="font-size: 14px; line-height: 1.3;"><?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></strong>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Vaccines Tile -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-white border text-center h-100 d-flex flex-column justify-content-between shadow-sm metric-tile" style="transition: all 0.2s ease;">
                            <div>
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; background: #ecfdf5; color: #10b981;">
                                    <i class="fa-solid fa-syringe fs-6"></i>
                                </div>
                                <div class="text-muted fw-bold text-uppercase" style="font-size: 10.5px; letter-spacing: 0.6px;">Vaccinations</div>
                            </div>
                            <div class="pt-2">
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold d-inline-block" style="font-size: 11.5px;">
                                    <i class="fa-solid fa-circle-check me-1"></i> Up to Date
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Certificate Tile -->
                    <div class="col-6 col-md-3">
                        <div class="p-3 rounded-4 bg-white border text-center h-100 d-flex flex-column justify-content-between shadow-sm metric-tile" style="transition: all 0.2s ease;">
                            <div>
                                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 38px; height: 38px; background: #fefce8; color: #d97706;">
                                    <i class="fa-solid fa-shield-halved fs-6"></i>
                                </div>
                                <div class="text-muted fw-bold text-uppercase" style="font-size: 10.5px; letter-spacing: 0.6px;">Passport ID</div>
                            </div>
                            <div class="pt-2">
                                <strong class="text-dark font-monospace d-block" style="font-size: 12px; letter-spacing: 0.5px;"><?= $regId ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Critical Medical & Feeding Notice -->
                <div class="p-3 p-md-4 rounded-4 bg-light border mb-4">
                    <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-notes-medical text-brand me-2"></i> Medical &amp; Dietary Guidelines</h6>
                    
                    <div class="row g-3 small">
                        <div class="col-md-6">
                            <label class="text-muted d-block mb-1">Known Allergies:</label>
                            <?php if (!empty($pet['allergies'])): ?>
                                <div class="p-2 rounded-3 bg-danger-subtle text-danger border border-danger-subtle fw-bold">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= ViewHelper::e($pet['allergies']) ?>
                                </div>
                            <?php else: ?>
                                <div class="p-2 rounded-3 bg-white border text-success fw-semibold">
                                    <i class="fa-solid fa-circle-check me-1"></i> No known adverse allergies
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="text-muted d-block mb-1">Diet &amp; Feeding Instructions:</label>
                            <div class="p-2 rounded-3 bg-white border text-dark">
                                <?= !empty($pet['diet_instructions']) ? ViewHelper::e($pet['diet_instructions']) : 'Standard nutritional diet with fresh water.' ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 1-Click Emergency Contact Actions -->
                <div class="d-flex flex-column gap-3 mb-4">
                    <!-- Primary Call Owner Button -->
                    <a href="tel:<?= urlencode($cleanPhone) ?>" class="btn btn-brand rounded-pill py-3 px-4 fs-5 fw-bold w-100 shadow d-flex align-items-center justify-content-center gap-2 text-white">
                        <i class="fa-solid fa-phone"></i>
                        <span>Call Owner: <?= ViewHelper::e($ownerName) ?> (<?= ViewHelper::e($ownerPhone) ?>)</span>
                    </a>

                    <!-- SMS Message Shortcut -->
                    <a href="sms:<?= urlencode($cleanPhone) ?>?body=Hello,%20I%20have%20found%20your%20pet%20<?= urlencode($pet['name']) ?>%20via%20PetGuard%20Tag." class="btn btn-outline-dark rounded-pill py-2 px-4 fw-bold w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-comment-sms"></i>
                        <span>Send SMS Text Message</span>
                    </a>

                    <!-- 24/7 Hotline -->
                    <a href="tel:+18005557389" class="btn btn-outline-danger rounded-pill py-2 px-4 fw-semibold w-100 d-flex align-items-center justify-content-center gap-2">
                        <i class="fa-solid fa-truck-medical"></i>
                        <span>Call 24/7 Emergency Triage Hotline (+1-800-555-PET-911)</span>
                    </a>
                </div>

                <!-- Registered Emergency Contacts List (If Available) -->
                <?php if (!empty($emergencyContacts)): ?>
                    <div class="p-3 rounded-4 border bg-white mb-4">
                        <h6 class="fw-bold text-dark mb-2 small"><i class="fa-solid fa-address-book text-primary me-1"></i> Secondary Emergency Contacts:</h6>
                        <div class="d-flex flex-column gap-2">
                            <?php foreach ($emergencyContacts as $contact): ?>
                                <div class="d-flex justify-content-between align-items-center p-2 rounded bg-light small">
                                    <div>
                                        <strong><?= ViewHelper::e($contact['contact_name']) ?></strong>
                                        <span class="text-muted">(<?= ViewHelper::e($contact['relationship']) ?>)</span>
                                    </div>
                                    <a href="tel:<?= urlencode($contact['phone']) ?>" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">
                                        <i class="fa-solid fa-phone me-1"></i> Call
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Official Security Seal & Cryptographic Stamp Footer -->
                <div class="p-3 rounded-4 bg-light border text-center text-muted small">
                    <div class="d-flex align-items-center justify-content-center gap-3 flex-wrap mb-2">
                        <span class="font-monospace text-dark"><strong>SECURITY ID:</strong> <?= $regId ?></span>
                        <span class="text-muted">&bull;</span>
                        <span><i class="fa-solid fa-shield-halved text-success me-1"></i> Encrypted Registry</span>
                        <span class="text-muted">&bull;</span>
                        <span>ISO 11784/11785 Compliant</span>
                    </div>
                    <p class="m-0 text-muted" style="font-size: 11px;">
                        Protected by PetGuard Global Safety Network. Owner passwords and financial details are strictly private.
                    </p>
                </div>

            </div>
        </div>

    </div>
</section>
