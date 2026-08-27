<?php
use Helpers\ViewHelper;

$publicUrl = ViewHelper::url('pet-passport/' . urlencode($pet['qr_token']));
$ownerPhone = $user['phone'] ?? '+1 (555) 012-3456';
$cleanPhone = preg_replace('/[^0-9+]/', '', $ownerPhone);
?>

<!-- Action Bar (Hidden on Print) -->
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2 d-print-none">
    <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold">
        <i class="fa-solid fa-arrow-left me-1"></i> Back to Pet Profile
    </a>
    <div class="d-flex gap-2">
        <a href="<?= $publicUrl ?>" target="_blank" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-semibold">
            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Public QR Scanner
        </a>
        <button onclick="window.print()" class="btn btn-danger rounded-pill px-4 py-2 fw-bold shadow-sm">
            <i class="fa-solid fa-print me-1"></i> Print Emergency Card
        </button>
    </div>
</div>

<!-- Print-Ready Emergency Trauma Card -->
<div class="admin-card p-0 overflow-hidden mx-auto shadow-lg border-2 border-danger mb-5" style="max-width: 720px; border-radius: 24px; background: #ffffff;">
    
    <!-- Header Strip -->
    <div class="p-4 text-white" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white text-danger d-flex align-items-center justify-content-center shadow-sm" style="width: 48px; height: 48px; font-size: 22px;">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <div>
                    <h3 class="fw-bold m-0 text-white" style="letter-spacing: 1px; font-family: 'Anybody', sans-serif;">PET EMERGENCY MEDICAL CARD</h3>
                    <small class="text-white-50 text-uppercase" style="letter-spacing: 0.8px; font-size: 11px;">Verified Clinical Identity & Trauma Triage Pass</small>
                </div>
            </div>
            <span class="badge bg-white text-danger text-uppercase px-3 py-2 fw-bold font-monospace shadow-sm" style="font-size: 12px;">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> CRITICAL CARE
            </span>
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-4 p-md-5">
        
        <!-- Primary Pet Identity & Live QR Tag Grid -->
        <div class="row g-4 align-items-center pb-4 border-bottom mb-4">
            <div class="col-12 col-sm-4 text-center">
                <div class="position-relative d-inline-block">
                    <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border border-danger-subtle shadow-sm" style="width: 130px; height: 130px; object-fit: contain; background: #fff8e5;">
                </div>
                <h3 class="fw-bold text-dark mt-2 mb-0"><?= ViewHelper::e($pet['name']) ?></h3>
                <small class="text-muted"><?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed']) ?></small>
            </div>

            <!-- Pet Medical Quick Facts -->
            <div class="col-12 col-sm-8">
                <div class="row g-3 small">
                    <div class="col-6">
                        <span class="text-muted d-block">Gender / Age:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['gender']) ?> (<?= ViewHelper::e($pet['age']) ?>)</strong>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block">Weight:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['weight']) ?></strong>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block">Blood Group:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['blood_group'] ?: 'Standard Canine/Feline') ?></strong>
                    </div>
                    <div class="col-6">
                        <span class="text-muted d-block">ISO Microchip ID:</span>
                        <code class="fs-6 fw-bold text-dark"><?= ViewHelper::e($pet['microchip_id'] ?: '985141008837192') ?></code>
                    </div>
                    <div class="col-12">
                        <span class="text-muted d-block">Registered Pet Parent:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($user['name']) ?></strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Critical Allergies Warning Strip -->
        <div class="p-3 rounded-4 bg-danger-subtle border border-danger text-danger mb-4">
            <div class="d-flex align-items-center gap-2 mb-1">
                <i class="fa-solid fa-triangle-exclamation fs-5"></i>
                <strong class="fs-6 text-uppercase">Critical Medical Allergies & Hazards:</strong>
            </div>
            <div class="fw-semibold small">
                <?= ViewHelper::e($pet['allergies'] ?: 'No known drug or food allergies recorded in profile.') ?>
            </div>
            <?php if (!empty($pet['diet_instructions'])): ?>
                <div class="small text-muted mt-2 pt-2 border-top border-danger-subtle">
                    <strong>Special Feeding Instructions:</strong> <?= ViewHelper::e($pet['diet_instructions']) ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Live Scannable Emergency QR Tag Module (Replacing Raw String) -->
        <div class="p-4 rounded-4 bg-light border mb-4">
            <div class="row align-items-center g-3">
                <div class="col-12 col-sm-4 text-center">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=4&data=<?= urlencode($publicUrl) ?>" alt="Emergency QR Code" class="rounded-3 border shadow-sm p-1 bg-white" style="width: 125px; height: 125px;">
                </div>
                <div class="col-12 col-sm-8">
                    <span class="badge bg-danger text-white rounded-pill px-3 py-1 text-uppercase fw-bold mb-2">Instant Responder QR Code</span>
                    <h5 class="fw-bold text-dark m-0">Universal Recovery & Medical Tag</h5>
                    <p class="small text-muted m-0 mt-1">
                        Scan with any smartphone camera to immediately access emergency contact numbers, full clinical history, or notify the owner.
                    </p>
                </div>
            </div>
        </div>

        <!-- Active Prescriptions -->
        <div class="mb-4">
            <h6 class="fw-bold text-dark mb-2"><i class="fa-solid fa-pills text-danger me-1"></i> Active Medications & Dosages:</h6>
            <?php if (empty($medications)): ?>
                <div class="p-3 rounded-3 bg-light border text-muted small">No active daily medications recorded.</div>
            <?php else: ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($medications as $m): ?>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light border small">
                            <div>
                                <span class="fw-bold text-dark"><?= ViewHelper::e($m['name']) ?></span>
                                <span class="text-muted">&bull; <?= ViewHelper::e($m['frequency']) ?></span>
                            </div>
                            <span class="badge bg-light text-dark border fw-bold"><?= ViewHelper::e($m['dosage']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 24/7 Emergency Contacts & Hotline -->
        <div class="p-3 rounded-4 bg-light border mb-4 small">
            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-phone text-success me-1"></i> Direct Emergency Contacts:</h6>
            <div class="row g-3">
                <div class="col-12 col-sm-6">
                    <span class="text-muted d-block">Pet Parent Contact:</span>
                    <a href="tel:<?= urlencode($cleanPhone) ?>" class="fw-bold text-dark fs-6 text-decoration-none">
                        <i class="fa-solid fa-phone text-success me-1"></i> <?= ViewHelper::e($ownerPhone) ?>
                    </a>
                </div>
                <div class="col-12 col-sm-6">
                    <span class="text-muted d-block">PetGuard 24/7 Triage Hotline:</span>
                    <a href="tel:+18005557389" class="fw-bold text-danger fs-6 text-decoration-none">
                        <i class="fa-solid fa-truck-medical me-1"></i> +1 (800) 555-PET-911
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Verification Strip -->
        <div class="text-center text-muted small pt-3 border-top" style="font-size: 11px;">
            <i class="fa-solid fa-shield-halved text-success me-1"></i> Verified by PetGuard Companion Animal Emergency Registry &bull; www.petguard.com
        </div>

    </div>
</div>
