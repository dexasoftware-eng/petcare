<?php
use Helpers\ViewHelper;
?>

<!-- Page Header -->
<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title text-danger"><i class="fa-solid fa-truck-medical me-2"></i> Emergency Center & Rapid Response</h2>
        <p class="admin-page-subtitle">Instant triage access, emergency contact cards, and 24/7 on-call veterinary assistance.</p>
    </div>
</div>

<!-- 24/7 Hotline Urgent Alert -->
<div class="admin-card p-4 mb-4 text-white" style="background: linear-gradient(135deg, #dc2626 0%, #991b1b 100%);">
    <div class="row align-items-center g-3">
        <div class="col-lg-8">
            <span class="badge bg-white text-danger px-3 py-1 rounded-pill fw-bold text-uppercase mb-2">Critical Acute Support</span>
            <h3 class="fw-bold m-0">Need Immediate Emergency Veterinary Help?</h3>
            <p class="small text-white-50 m-0 mt-1">If your pet is suffering from breathing distress, toxic ingestion, severe trauma, or seizures, call immediately.</p>
        </div>
        <div class="col-lg-4 text-lg-end">
            <a href="tel:+18005557389" class="btn btn-light rounded-pill px-4 py-2 fs-5 fw-bold text-danger">
                <i class="fa-solid fa-phone me-2"></i> +1 (800) 555-PET-911
            </a>
        </div>
    </div>
</div>

<!-- Quick Emergency Cards per Pet -->
<h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-id-card-clip text-brand me-2"></i> Printable Emergency Pet Cards</h4>
<div class="row g-4 mb-4">
    <?php foreach ($pets as $pet): ?>
        <div class="col-md-6 col-lg-4">
            <div class="admin-card p-4 h-100 border border-danger-subtle d-flex flex-column justify-content-between" style="background: #fffafa;">
                <div>
                    <div class="d-flex gap-3 align-items-center mb-3">
                        <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="" class="rounded-3 border p-1" style="width: 54px; height: 54px; object-fit: contain; background: #ffffff;">
                        <div>
                            <h5 class="fw-bold text-dark m-0"><?= ViewHelper::e($pet['name']) ?></h5>
                            <small class="text-muted"><?= ViewHelper::e($pet['species']) ?> • <?= ViewHelper::e($pet['breed']) ?></small>
                        </div>
                    </div>

                    <div class="p-3 bg-white rounded-3 border mb-3 small">
                        <div class="mb-1 text-danger"><strong>Allergies:</strong> <?= ViewHelper::e($pet['allergies'] ?: 'None recorded') ?></div>
                        <div class="mb-1"><strong>Blood Group:</strong> <?= ViewHelper::e($pet['blood_group'] ?: 'Standard') ?></div>
                        <div><strong>Microchip:</strong> <?= ViewHelper::e($pet['microchip_id'] ?: 'Pending') ?></div>
                    </div>
                </div>

                <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-sm btn-outline-danger w-100 rounded-pill fw-bold" target="_blank">
                    <i class="fa-solid fa-print me-1"></i> Print Emergency Card
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<!-- Registered Emergency Contacts -->
<div class="admin-card p-4">
    <div class="admin-card-header d-flex justify-content-between align-items-center mb-3 p-0 pb-3 border-bottom">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-address-book text-primary me-2"></i> Registered Emergency Contacts</h3>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($contacts)): ?>
            <p class="text-muted text-center py-4 small">No dedicated emergency contacts registered.</p>
        <?php else: ?>
            <div class="row g-3">
                <?php foreach ($contacts as $c): ?>
                    <div class="col-md-6">
                        <div class="p-3 rounded-3 border bg-light d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold text-dark"><?= ViewHelper::e($c['contact_name']) ?> <span class="badge bg-light text-dark border"><?= ViewHelper::e($c['relationship']) ?></span></div>
                                <div class="small text-muted mt-1"><i class="fa-solid fa-phone text-success me-1"></i> <strong><?= ViewHelper::e($c['phone']) ?></strong></div>
                                <?php if (!empty($c['clinic_name'])): ?><small class="text-muted d-block"><?= ViewHelper::e($c['clinic_name']) ?></small><?php endif; ?>
                            </div>
                            <a href="tel:<?= urlencode($c['phone']) ?>" class="btn btn-sm btn-success rounded-pill px-3"><i class="fa-solid fa-phone"></i> Call</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
