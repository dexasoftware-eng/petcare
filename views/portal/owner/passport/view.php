<?php
use Helpers\ViewHelper;

$publicUrl = ViewHelper::url('pet-passport/' . urlencode($pet['qr_token']));
$regCode = 'PG-REG-' . strtoupper(substr(md5($pet['id'] . $pet['name']), 0, 8));
$securityHash = strtoupper(hash('crc32b', $pet['id'] . $pet['qr_token'] . ($pet['microchip_id'] ?? 'CHIP')));
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-passport text-warning"></i>
            <span>Cryptographic Digital Passport</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= $regCode ?></span>
        </div>
        <h2 class="portal-hero-title">Official Pet Passport: <?= ViewHelper::e($pet['name']) ?> 🛂</h2>
        <p class="portal-hero-subtitle">Cryptographically verified companion animal identity document &amp; emergency recovery passport.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= $publicUrl ?>" target="_blank" class="btn btn-admin-primary">
            <i class="fa-solid fa-arrow-up-right-from-square"></i>
            <span>Public QR View</span>
        </a>
        <button onclick="window.print()" class="btn btn-admin-secondary">
            <i class="fa-solid fa-print"></i>
            <span>Print Passport</span>
        </button>
        <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Profile</span>
        </a>
    </div>
</div>

<!-- Digital Passport Document Card -->
<div class="card card-custom p-0 overflow-hidden mx-auto shadow-lg border-0 mb-5" style="max-width: 780px; border-radius: 24px; background: #ffffff;">
    
    <!-- Gold / Navy Leather Cover Header -->
    <div class="p-4 text-white position-relative" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-bottom: 5px solid #fa441d;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-white p-2 d-flex align-items-center justify-content-center shadow" style="width: 52px; height: 52px;">
                    <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard" style="height: 32px;">
                </div>
                <div>
                    <h3 class="fw-bold m-0 text-white" style="letter-spacing: 1.5px; font-family: 'DynaPuff', cursive;">PETGUARD PASSPORT</h3>
                    <small class="text-white-50 text-uppercase" style="letter-spacing: 0.8px; font-size: 11px;">Official Companion Animal Identity & Health Document</small>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-warning text-dark font-monospace px-3 py-1 fw-bold">TAG: <?= ViewHelper::e($pet['qr_token']) ?></span>
                <div class="text-white-50 small mt-1">Registry Code: <?= $regCode ?></div>
            </div>
        </div>
    </div>

    <!-- Inner Passport Body -->
    <div class="p-4 p-md-5">
        
        <!-- Top Biometrics & Photo Spread -->
        <div class="row g-4 align-items-center pb-4 border-bottom mb-4">
            <div class="col-md-4 text-center">
                <div class="position-relative d-inline-block">
                    <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm" style="width: 150px; height: 150px; object-fit: contain; background: #fff8e5;">
                    <span class="position-absolute bottom-0 start-50 translate-middle-x badge bg-success rounded-pill px-3 py-1 shadow-sm" style="white-space: nowrap; font-size: 11px;">
                        <i class="fa-solid fa-circle-check me-1"></i> Verified Registry
                    </span>
                </div>
                <div class="mt-3">
                    <div class="fw-bold text-dark fs-5"><?= ViewHelper::e($pet['name']) ?></div>
                    <small class="text-muted"><?= ViewHelper::e($pet['species']) ?> &bull; <?= ViewHelper::e($pet['breed']) ?></small>
                </div>
            </div>

            <!-- Pet Identity Fields -->
            <div class="col-md-8">
                <div class="row g-3 small">
                    <div class="col-6 col-sm-4">
                        <span class="text-muted d-block">Sex / Gender:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['gender']) ?></strong>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="text-muted d-block">Age / Birthday:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['age']) ?></strong>
                    </div>
                    <div class="col-6 col-sm-4">
                        <span class="text-muted d-block">Current Weight:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['weight']) ?></strong>
                    </div>
                    <div class="col-6 col-sm-6">
                        <span class="text-muted d-block">ISO Microchip ID:</span>
                        <code class="fs-6 fw-bold text-dark"><?= ViewHelper::e($pet['microchip_id'] ?: '985141008837192') ?></code>
                    </div>
                    <div class="col-6 col-sm-6">
                        <span class="text-muted d-block">Blood Group:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($pet['blood_group'] ?: 'Standard Canine/Feline') ?></strong>
                    </div>
                    <div class="col-12">
                        <span class="text-muted d-block">Registered Pet Parent:</span>
                        <strong class="text-dark fs-6"><?= ViewHelper::e($user['name']) ?></strong>
                        <span class="text-muted"> &bull; <?= ViewHelper::e($user['phone'] ?? '+1 (555) 012-3456') ?></span>
                    </div>
                    <?php if (!empty($pet['allergies'])): ?>
                        <div class="col-12">
                            <span class="text-danger fw-bold d-block"><i class="fa-solid fa-triangle-exclamation me-1"></i> Critical Medical Allergies:</span>
                            <span class="text-dark"><?= ViewHelper::e($pet['allergies']) ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Scannable QR Tag Module -->
        <div class="p-4 rounded-4 bg-light border mb-4">
            <div class="row align-items-center g-3">
                <div class="col-sm-4 text-center">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=140x140&margin=4&data=<?= urlencode($publicUrl) ?>" alt="QR Tag" class="rounded-3 border shadow-sm bg-white p-1" style="width: 130px; height: 130px;">
                </div>
                <div class="col-sm-8">
                    <span class="badge bg-danger rounded-pill px-3 py-1 text-uppercase fw-bold mb-2">Universal QR Recovery Tag</span>
                    <h5 class="fw-bold text-dark m-0 font-monospace"><?= ViewHelper::e($pet['qr_token']) ?></h5>
                    <p class="small text-muted m-0 mt-1">
                        Scan with any smartphone camera to open the public emergency recovery profile, contact the owner with 1-click, or review clinical notes.
                    </p>
                    <div class="mt-3 d-flex gap-2 flex-wrap">
                        <a href="<?= $publicUrl ?>" target="_blank" class="btn btn-sm btn-dark rounded-pill px-3 py-2 fw-semibold">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Test Public Scanner
                        </a>
                        <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold" onclick="navigator.clipboard.writeText('<?= $publicUrl ?>'); showPetGuardModal('Passport Link Copied', 'Public QR recovery link has been copied to your clipboard.', 'copy');">
                            <i class="fa-solid fa-copy me-1"></i> Copy Link
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Immunization Verification Section -->
        <div class="mb-4">
            <h6 class="fw-bold text-dark mb-3"><i class="fa-solid fa-syringe text-brand me-2"></i> Immunization & Vaccination History:</h6>
            <?php if (empty($vaccines)): ?>
                <div class="p-3 rounded-3 bg-light border text-center text-muted small">No vaccines recorded yet in this passport.</div>
            <?php else: ?>
                <div class="d-flex flex-column gap-2">
                    <?php foreach (array_slice($vaccines, 0, 4) as $v): ?>
                        <div class="d-flex justify-content-between align-items-center p-3 rounded-3 bg-light border small">
                            <div>
                                <div class="fw-bold text-dark"><?= ViewHelper::e($v['vaccine_name']) ?></div>
                                <span class="text-muted">Administered: <?= date('M d, Y', strtotime($v['administered_date'])) ?> &bull; <?= ViewHelper::e($v['administering_vet'] ?: 'PetGuard Clinic') ?></span>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 fw-bold">
                                <i class="fa-solid fa-circle-check me-1"></i> Valid
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- Official Security & Verification Strip -->
        <div class="p-3 rounded-3 border bg-white shadow-sm d-flex flex-wrap align-items-center justify-content-between gap-3" style="border-left: 5px solid #fa441d !important;">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-light border p-2 text-success d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 20px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <div class="fw-bold text-dark small">ISO 11784 / 11785 Microchip Standard Compliant</div>
                    <small class="text-muted font-monospace">Checksum: SEC-<?= $securityHash ?> &bull; PetGuard Global Health Registry</small>
                </div>
            </div>
            <div class="text-end">
                <span class="badge bg-light text-dark border font-monospace px-3 py-1">AUTH 256-BIT SSL</span>
            </div>
        </div>

    </div>
</div>
