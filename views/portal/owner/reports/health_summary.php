<?php
use Helpers\ViewHelper;

$reportId = 'PG-REP-' . date('Ymd') . '-' . str_pad($pet['id'], 4, '0', STR_PAD_LEFT);
$qrPayload = ViewHelper::url('passport/' . ($pet['qr_token'] ?? ''));
?>

<!-- Responsive & Print Stylesheet for All 5 Screens -->
<style>
/* Base Report Layout */
.clinical-report-wrapper {
    max-width: 960px;
    margin: 0 auto;
}
.clinical-report-card {
    background: #ffffff;
    border-radius: 24px;
    border: 1px solid rgba(0,0,0,0.08);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}
.clinical-top-accent {
    height: 6px;
    width: 100%;
    background: linear-gradient(90deg, #ff7a18, #ffb300, #ff7a18);
}
.report-field-label {
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #64748b;
    margin-bottom: 2px;
}
.report-field-value {
    font-size: 13.5px;
    font-weight: 600;
    color: #0f172a;
}
.report-table {
    border-collapse: separate;
    border-spacing: 0;
    border-radius: 12px;
    overflow: hidden;
}
.report-table thead th {
    background: #f8fafc;
    color: #475569;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    padding: 10px 14px;
    border-bottom: 1px solid #e2e8f0;
}
.report-table tbody td {
    padding: 11px 14px;
    font-size: 13px;
    border-bottom: 1px solid #f1f5f9;
}
.report-table tbody tr:last-child td {
    border-bottom: none;
}

/* 5 Screen Responsive Breakpoints */

/* SCREEN 1: Mobile (< 576px) */
@media (max-width: 575.98px) {
    .clinical-report-card {
        border-radius: 16px;
        padding: 1.25rem !important;
    }
    .report-action-bar {
        flex-direction: column;
        align-items: stretch !important;
        gap: 0.5rem;
    }
    .report-action-bar .btn {
        width: 100%;
        justify-content: center;
    }
    .report-header-flex {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    .report-header-flex .header-seal {
        margin: 0 auto;
    }
    .report-header-flex .header-badges {
        text-align: center !important;
        width: 100%;
    }
    .patient-bio-header {
        flex-direction: column;
        text-align: center;
        gap: 0.75rem;
    }
    .patient-avatar-box {
        margin: 0 auto;
    }
    .stamp-box-wrapper {
        width: 100% !important;
        text-align: center !important;
    }
    .stamp-box-wrapper .digital-stamp {
        width: 100% !important;
    }
}

/* SCREEN 2: Phablet (576px - 767.98px) */
@media (min-width: 576px) and (max-width: 767.98px) {
    .clinical-report-card {
        padding: 1.75rem !important;
    }
}

/* SCREEN 3: Tablet (768px - 991.98px) */
@media (min-width: 768px) and (max-width: 991.98px) {
    .clinical-report-card {
        padding: 2.25rem !important;
    }
}

/* SCREEN 4: Desktop (992px - 1399.98px) */
@media (min-width: 992px) {
    .clinical-report-card {
        padding: 3rem !important;
    }
}

/* SCREEN 5: Ultrawide (1400px+) */
@media (min-width: 1400px) {
    .clinical-report-wrapper {
        max-width: 980px;
    }
}

/* PRINT OPTIMIZATION */
@media print {
    .admin-sidebar,
    .admin-topbar,
    .mobile-bottom-nav,
    .report-action-bar,
    .admin-sidebar-overlay {
        display: none !important;
    }
    .admin-main {
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
    }
    .admin-body {
        background: #ffffff !important;
    }
    .clinical-report-card {
        box-shadow: none !important;
        border: none !important;
        padding: 0 !important;
        max-width: 100% !important;
    }
    body {
        -webkit-print-color-adjust: exact !important;
        print-color-adjust: exact !important;
    }
}
</style>

<div class="clinical-report-wrapper">
    <!-- Top Action & Navigation Bar (Screen Only) -->
    <div class="report-action-bar d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div class="d-flex align-items-center gap-2 flex-wrap">
            <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-semibold d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="fa-solid fa-arrow-left"></i> Back to Profile
            </a>
            <a href="<?= ViewHelper::url('portal/health') ?>" class="btn btn-sm btn-light border rounded-pill px-3 py-2 fw-semibold text-muted d-inline-flex align-items-center gap-1 shadow-sm">
                <i class="fa-solid fa-heart-pulse text-danger"></i> Health Hub
            </a>
        </div>
        <div class="d-flex align-items-center gap-2">
            <button type="button" onclick="window.print()" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                <i class="fa-solid fa-print"></i> Print / Save as PDF
            </button>
        </div>
    </div>

    <!-- Printable Clinical Health Dossier Card -->
    <div class="clinical-report-card shadow-sm mb-5">
        <!-- Top Ribbon Accent -->
        <div class="clinical-top-accent"></div>

        <div class="p-4 p-md-5">
            <!-- Official Document Header -->
            <div class="d-flex justify-content-between align-items-start border-bottom pb-4 mb-4 report-header-flex">
                <div class="d-flex align-items-center gap-3 header-seal">
                    <div class="rounded-4 p-2 border d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 60px; height: 60px; background: #fff8e5;">
                        <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard Seal" style="width: 42px; height: 42px; object-fit: contain;">
                    </div>
                    <div class="min-w-0">
                        <h4 class="fw-bold text-dark m-0" style="letter-spacing: -0.5px;">PETGUARD CLINICAL HEALTH REPORT</h4>
                        <div class="text-muted small fw-medium">Certified Comprehensive Veterinary Dossier &amp; Immunization Record</div>
                    </div>
                </div>
                <div class="text-end small header-badges">
                    <div class="badge bg-light text-dark border font-monospace px-3 py-1 mb-1 fw-bold"><?= $reportId ?></div>
                    <div class="text-muted" style="font-size: 11.5px;">Issued: <?= date('F j, Y - H:i') ?></div>
                    <div class="text-success fw-bold" style="font-size: 11.5px;"><i class="fa-solid fa-circle-check me-1"></i> Verified Active Registry</div>
                </div>
            </div>

            <!-- Patient Companion Demographic Dossier -->
            <div class="p-3 p-sm-4 rounded-4 bg-light border mb-4">
                <div class="row g-4 align-items-center">
                    <div class="col-12 col-sm-auto text-center patient-avatar-box">
                        <?php if (!empty($pet['avatar'])): ?>
                            <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border bg-white shadow-sm" style="width: 96px; height: 96px; object-fit: contain; background: #fff8e5;" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                        <?php else: ?>
                            <div class="rounded-4 bg-white border d-flex align-items-center justify-content-center fw-bold text-brand mx-auto shadow-sm" style="width: 96px; height: 96px; font-size: 32px;">
                                <i class="fa-solid fa-paw"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-12 col-sm min-w-0">
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2 patient-bio-header">
                            <div>
                                <h3 class="fw-bold text-dark m-0"><?= ViewHelper::e($pet['name']) ?></h3>
                                <div class="text-muted small"><?= ViewHelper::e($pet['species']) ?> • <?= ViewHelper::e($pet['breed']) ?> • <?= ViewHelper::e($pet['gender']) ?></div>
                            </div>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-2 fw-bold" style="font-size: 12px;">
                                <i class="fa-solid fa-shield-heart me-1"></i> Care Score: <?= $pet['care_score'] ?? 95 ?>/100
                            </span>
                        </div>

                        <div class="row g-3 pt-2 border-top">
                            <div class="col-6 col-md-3">
                                <div class="report-field-label">Age / Lifecycle</div>
                                <div class="report-field-value text-truncate"><?= ViewHelper::e($pet['age']) ?></div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="report-field-label">Current Weight</div>
                                <div class="report-field-value font-monospace text-truncate"><?= ViewHelper::e($pet['weight']) ?></div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="report-field-label">Blood Group</div>
                                <div class="report-field-value text-truncate"><?= ViewHelper::e($pet['blood_group'] ?: 'Standard') ?></div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="report-field-label">Microchip Tag</div>
                                <div class="report-field-value font-monospace text-truncate"><?= ViewHelper::e($pet['microchip_id'] ?: 'Unchipped') ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Allergies & Medical Warnings Notice -->
                <div class="mt-3 p-3 rounded-3 bg-white border border-danger-subtle d-flex align-items-start gap-2">
                    <i class="fa-solid fa-triangle-exclamation text-danger fs-5 mt-1 flex-shrink-0"></i>
                    <div>
                        <div class="fw-bold text-danger small text-uppercase">Allergies &amp; Clinical Dietary Warnings</div>
                        <div class="small text-dark"><?= ViewHelper::e($pet['allergies'] ?: 'No known drug allergies, adverse reactions, or chronic dietary intolerances recorded.') ?></div>
                    </div>
                </div>
            </div>

            <!-- Section 1: Immunization & Vaccine Records -->
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="stat-card-icon icon-green" style="width: 32px; height: 32px; font-size: 13px; border-radius: 10px;">
                        <i class="fa-solid fa-syringe"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">1. Certified Immunization &amp; Vaccine History</h5>
                </div>
                <?php if (empty($vaccines)): ?>
                    <p class="small text-muted p-3 bg-light rounded-3">No vaccination records logged for this companion.</p>
                <?php else: ?>
                    <div class="table-responsive border rounded-3">
                        <table class="table report-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-3">Vaccine Name</th>
                                    <th>Dose / Batch</th>
                                    <th>Date Administered</th>
                                    <th>Next Due Date</th>
                                    <th>Administering Clinic / Vet</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vaccines as $v): ?>
                                    <tr>
                                        <td class="ps-3 fw-bold text-dark"><?= ViewHelper::e($v['vaccine_name']) ?></td>
                                        <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($v['dosage'] ?? '1st Dose') ?></span></td>
                                        <td class="text-nowrap"><i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($v['administered_date'])) ?></td>
                                        <td class="text-nowrap">
                                            <?php if (!empty($v['next_due_date'])): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle"><i class="fa-regular fa-clock me-1"></i> <?= date('M d, Y', strtotime($v['next_due_date'])) ?></span>
                                            <?php else: ?>
                                                <span class="text-muted">—</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($v['administering_vet'] ?? 'PetGuard Health Network') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Section 2: Active Prescriptions & Regimens -->
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="stat-card-icon icon-purple" style="width: 32px; height: 32px; font-size: 13px; border-radius: 10px;">
                        <i class="fa-solid fa-pills"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">2. Active Medications &amp; Therapeutic Treatments</h5>
                </div>
                <?php if (empty($medications)): ?>
                    <p class="small text-muted p-3 bg-light rounded-3">No active prescription medications registered.</p>
                <?php else: ?>
                    <div class="table-responsive border rounded-3">
                        <table class="table report-table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-3">Prescription Medication</th>
                                    <th>Dosage</th>
                                    <th>Administration Frequency</th>
                                    <th>Duration / Dates</th>
                                    <th>Prescribing Clinician</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($medications as $m): ?>
                                    <tr>
                                        <td class="ps-3">
                                            <strong class="text-dark d-block"><?= ViewHelper::e($m['name']) ?></strong>
                                            <small class="text-muted"><?= ViewHelper::e($m['instructions'] ?: 'Standard routine') ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($m['dosage']) ?></span></td>
                                        <td><?= ViewHelper::e($m['frequency']) ?></td>
                                        <td class="text-nowrap small">
                                            <?= date('M d, Y', strtotime($m['start_date'])) ?> <?= $m['end_date'] ? '→ ' . date('M d, Y', strtotime($m['end_date'])) : '(Ongoing)' ?>
                                        </td>
                                        <td><i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($m['prescribing_vet'] ?: 'Primary Care Vet') ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Section 3: Weight & Lifecycle Growth Progression -->
            <div class="mb-4">
                <div class="d-flex align-items-center gap-2 mb-3 pb-2 border-bottom">
                    <div class="stat-card-icon icon-blue" style="width: 32px; height: 32px; font-size: 13px; border-radius: 10px;">
                        <i class="fa-solid fa-weight-scale"></i>
                    </div>
                    <h5 class="fw-bold text-dark m-0">3. Weight &amp; Vital Growth Progression</h5>
                </div>
                <?php if (empty($weights)): ?>
                    <p class="small text-muted p-3 bg-light rounded-3">No periodic weight entries logged.</p>
                <?php else: ?>
                    <div class="row g-2">
                        <?php foreach ($weights as $w): ?>
                            <div class="col-6 col-sm-4 col-md-3">
                                <div class="p-3 border rounded-3 bg-light text-center">
                                    <div class="text-muted" style="font-size: 11px;"><i class="fa-regular fa-calendar me-1"></i> <?= date('M d, Y', strtotime($w['recorded_date'])) ?></div>
                                    <div class="fw-bold text-dark font-monospace fs-6 text-brand"><?= $w['weight_kg'] ?> kg</div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Official Attestation & Security Signoff -->
            <div class="pt-4 mt-4 border-top">
                <div class="row g-4 align-items-end">
                    <div class="col-12 col-sm-6 small">
                        <div class="report-field-label">Verified Registered Guardian</div>
                        <div class="fw-bold text-dark fs-6"><?= ViewHelper::e($user['name']) ?></div>
                        <div class="text-muted small"><i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($user['phone'] ?? '+1-555-012-3456') ?> • <i class="fa-solid fa-envelope me-1"></i> <?= ViewHelper::e($user['email']) ?></div>
                        <div class="text-muted mt-2" style="font-size: 10.5px;">
                            This document is an authenticated clinical summary generated by PetGuard Companion Management Platform.
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 text-sm-end stamp-box-wrapper">
                        <div class="d-inline-block p-3 border rounded-4 bg-light text-center shadow-sm digital-stamp" style="min-width: 220px;">
                            <div class="small fw-bold text-uppercase text-brand mb-1" style="font-size: 10.5px; letter-spacing: 0.5px;">Digital Clinical Stamp</div>
                            <div class="fw-bold text-dark small">PETGUARD VETERINARY NETWORK</div>
                            <div class="text-success fw-bold small my-1" style="font-size: 11px;"><i class="fa-solid fa-stamp me-1"></i> AUTHENTICATED CERTIFICATE</div>
                            <div class="text-muted font-monospace" style="font-size: 10px;">TOKEN: <?= substr(md5($pet['id'] . $reportId), 0, 16) ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
