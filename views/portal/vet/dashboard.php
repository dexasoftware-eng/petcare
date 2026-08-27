<?php
use Helpers\ViewHelper;
use Helpers\Auth;
?>

<!-- 1. Practice Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-doctor text-warning"></i>
            <span>Certified Veterinary Practice</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= ViewHelper::e($profile['license_number'] ?? 'VET-DVM-98421') ?></span>
        </div>
        <h2 class="portal-hero-title">Good <?= (date('H') < 12 ? 'Morning' : (date('H') < 18 ? 'Afternoon' : 'Evening')) ?>, <?= ViewHelper::e((stripos($user['name'] ?? '', 'Dr') === 0 ? '' : 'Dr. ') . ($user['name'] ?? 'Doctor')) ?>! 🩺</h2>
        <p class="portal-hero-subtitle">
            <?= ViewHelper::e($profile['clinic_name'] ?? 'Pet Guard Central Hospital') ?> &middot; 
            <?= ViewHelper::e($profile['specialization'] ?? 'Veterinary Medicine') ?>
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('vet/availability') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-clock"></i>
            <span>Availability Slots</span>
        </a>
        <a href="<?= ViewHelper::url('vet/appointments') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-calendar-check"></i>
            <span>Consultations Queue</span>
        </a>
        <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-outline-danger rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-1" style="min-height: 44px;">
            <i class="fa-solid fa-truck-medical"></i>
            <span>Emergency Triage (<?= $kpi['activeEmergencies'] ?? 0 ?>)</span>
        </a>
    </div>
</div>

<!-- 2. Primary Metric KPI Cards Grid -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Today's Consultations</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['todayAppointments'] ?? 0 ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-bolt"></i> Consultations today
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Patient Queue</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= count($appointments ?? []) ?></div>
            <div class="stat-card-footer text-muted">
                <span class="text-primary fw-bold"><?= $kpi['pendingRequests'] ?? 0 ?></span> Awaiting confirmation
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Care Patients</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['totalPatients'] ?? 0 ?></div>
            <div class="stat-card-footer text-muted">
                <span class="text-success fw-bold"><i class="fa-solid fa-shield-heart me-1"></i> Registered</span> in care database
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Clinical Rating</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-star"></i>
                </div>
            </div>
            <div class="stat-card-value">4.95 <small class="fs-6 text-muted fw-normal">/ 5.0</small></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-certificate"></i> Verified Accredited
            </div>
        </div>
    </div>
</div>

<!-- 3. Main Two-Column Content Grid -->
<div class="row g-4">
    <!-- Left Column: Patient Consultations Queue & Patients Showcase -->
    <div class="col-lg-8">
        
        <!-- A. Live Consultations Queue Table -->
        <div class="admin-card mb-4">
            <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-calendar-days text-brand fs-5"></i>
                    <h3 class="admin-card-title m-0">Live Patient Consultations Queue</h3>
                </div>
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    View All Queue &rarr;
                </a>
            </div>

            <div class="admin-card-body p-0">
                <?php if (empty($appointments)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-regular fa-calendar-xmark fa-3x mb-3 text-muted"></i>
                        <h5 class="fw-bold">No active appointments scheduled</h5>
                        <p class="small text-muted mb-0">Upcoming consultations booked by pet parents will appear in your queue.</p>
                    </div>
                <?php else: ?>
                    <!-- 1. Desktop & Tablet Responsive Table View (>=768px) -->
                    <div class="d-none d-md-block table-responsive m-0">
                        <table class="table table-hover align-middle m-0" style="min-width: 640px;">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Patient (Pet)</th>
                                    <th>Pet Parent</th>
                                    <th>Date & Time</th>
                                    <th>Type & Symptoms</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4 text-nowrap">Clinical Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_slice($appointments, 0, 6) as $appt): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <img src="<?= ViewHelper::asset($appt['pet_avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 42px; height: 42px; object-fit: cover;">
                                                <div class="min-w-0">
                                                    <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                                    <div class="small text-muted text-truncate">
                                                        <span class="badge bg-light text-secondary border px-1 py-0 font-monospace" style="font-size: 10px;"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?></span>
                                                        <?= ViewHelper::e($appt['pet_breed'] ?? '') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark text-truncate" style="max-width: 140px;"><?= ViewHelper::e($appt['owner_name']) ?></div>
                                            <div class="small text-muted text-truncate" style="max-width: 140px;"><i class="fa-regular fa-envelope me-1"></i><?= ViewHelper::e($appt['owner_email'] ?? $appt['owner_phone']) ?></div>
                                        </td>
                                        <td class="text-nowrap">
                                            <div class="fw-bold text-dark"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?></div>
                                            <div class="small text-muted"><i class="fa-regular fa-clock me-1 text-brand"></i><?= ViewHelper::e($appt['appointment_time']) ?></div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border"><?= ViewHelper::e($appt['type'] ?? 'General Checkup') ?></span>
                                            <div class="small text-muted text-truncate" style="max-width: 160px;"><?= ViewHelper::e($appt['notes'] ?? 'Routine wellness check') ?></div>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php
                                            $statusMap = [
                                                'confirmed' => 'badge-success',
                                                'pending' => 'badge-amber',
                                                'completed' => 'badge-neutral',
                                                'cancelled' => 'badge-danger',
                                                'rejected' => 'badge-danger'
                                            ];
                                            ?>
                                            <span class="admin-badge <?= $statusMap[$appt['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 11px;">
                                                <?= ViewHelper::e($appt['status']) ?>
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 text-nowrap">
                                            <div class="d-inline-flex gap-1 align-items-center">
                                                <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-bold d-flex align-items-center gap-1" style="font-size: 12px;" onclick="PetGuardCall.initiateCall(<?= (int)$appt['owner_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)" title="Start Video Consultation">
                                                    <i class="fa-solid fa-video"></i>
                                                    <span>Start Call</span>
                                                </button>
                                                <a href="<?= ViewHelper::url('vet/appointments/' . $appt['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1" style="font-size: 12px;">
                                                    Details
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- 2. Mobile Adaptive Stacked Cards View (<768px) -->
                    <div class="d-md-none p-3 d-flex flex-column gap-3">
                        <?php foreach (array_slice($appointments, 0, 6) as $appt): ?>
                            <div class="p-3 rounded-4 border bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($appt['pet_avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 15px;"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                            <div class="small text-muted">
                                                <span class="badge bg-light text-secondary border px-1 py-0 font-monospace" style="font-size: 10px;"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?></span>
                                                <?= ViewHelper::e($appt['pet_breed'] ?? '') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $statusMap = [
                                        'confirmed' => 'badge-success',
                                        'pending' => 'badge-amber',
                                        'completed' => 'badge-neutral',
                                        'cancelled' => 'badge-danger',
                                        'rejected' => 'badge-danger'
                                    ];
                                    ?>
                                    <span class="admin-badge <?= $statusMap[$appt['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 10.5px;">
                                        <?= ViewHelper::e($appt['status']) ?>
                                    </span>
                                </div>

                                <div class="bg-light p-2 px-3 rounded-3 small mb-3 d-flex flex-column gap-1">
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-user me-1 text-brand"></i> Parent:</span>
                                        <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($appt['owner_name']) ?></strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-regular fa-clock me-1 text-brand"></i> Time:</span>
                                        <strong class="text-dark text-truncate ms-2"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?> &middot; <?= ViewHelper::e($appt['appointment_time']) ?></strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-tag me-1 text-brand"></i> Type:</span>
                                        <span class="text-secondary text-truncate ms-2"><?= ViewHelper::e($appt['type'] ?? 'General Checkup') ?></span>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-sm btn-success rounded-pill flex-grow-1 py-2 fw-bold d-flex align-items-center justify-content-center gap-1" style="min-height: 42px; font-size: 13px;" onclick="PetGuardCall.initiateCall(<?= (int)$appt['owner_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)">
                                        <i class="fa-solid fa-video"></i>
                                        <span>Start Video Call</span>
                                    </button>
                                    <a href="<?= ViewHelper::url('vet/appointments/' . $appt['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 d-flex align-items-center justify-content-center" style="min-height: 42px; font-size: 13px;">
                                        Details
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- B. Clinical Patients Showcase Cards -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="fw-bold text-dark m-0" style="font-family: var(--font-heading, inherit);">
                <i class="fa-solid fa-paw text-brand me-2"></i> Clinical Patients Under Care (<?= count($patients ?? []) ?>)
            </h4>
            <a href="<?= ViewHelper::url('vet/patients') ?>" class="btn btn-sm btn-admin-primary px-3 py-2 fw-bold shadow-sm d-flex align-items-center gap-1 text-decoration-none">
                <i class="fa-solid fa-folder-open"></i>
                <span>Patients Database</span>
            </a>
        </div>

        <?php if (empty($patients)): ?>
            <div class="admin-card text-center p-5 mb-4">
                <i class="fa-solid fa-paw fs-1 text-muted mb-3"></i>
                <h5 class="fw-bold">No patient profiles registered yet</h5>
                <p class="text-muted small mb-0">When pet parents book appointments, their clinical records will appear here.</p>
            </div>
        <?php else: ?>
            <div class="row g-3 mb-4">
                <?php foreach ($patients as $pet): ?>
                    <div class="col-12 col-md-6">
                        <div class="admin-card p-4 h-100 position-relative border d-flex flex-column justify-content-between shadow-sm" style="border-radius: 20px;">
                            <div>
                                <!-- Avatar + Identity Header -->
                                <div class="d-flex gap-3 align-items-start mb-2">
                                    <div class="position-relative flex-shrink-0">
                                        <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm" style="width: 70px; height: 70px; object-fit: contain; background: #fff8e5;">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden min-w-0">
                                        <div class="d-flex justify-content-between align-items-center gap-1 mb-1">
                                            <h5 class="fw-bold text-dark m-0 text-truncate" style="font-family: var(--font-heading, inherit); font-size: 16px;"><?= ViewHelper::e($pet['name']) ?></h5>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold flex-shrink-0" style="font-size: 11px;">
                                                <i class="fa-solid fa-shield-heart me-1"></i> Score: <?= $pet['care_score'] ?? 95 ?>
                                            </span>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 flex-wrap mb-1">
                                            <span class="badge bg-dark text-warning rounded-pill px-2 py-0 font-monospace text-uppercase" style="font-size: 9.5px;">
                                                <?= ViewHelper::e($pet['species']) ?>
                                            </span>
                                            <span class="text-muted small text-truncate">
                                                <?= ViewHelper::e($pet['breed'] ?: 'Purebred/Mixed') ?> &bull; <?= ViewHelper::e($pet['gender']) ?>
                                            </span>
                                        </div>
                                        <div class="d-flex flex-wrap gap-1 align-items-center">
                                            <span class="badge bg-light text-dark border font-monospace small"><i class="fa-solid fa-weight-scale text-primary me-1"></i><?= ViewHelper::e($pet['weight'] ?: '15 kg') ?></span>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small"><i class="fa-solid fa-shield-halved me-1"></i> Verified Record</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Parent & Microchip Info Box -->
                                <div class="p-2 px-3 rounded-3 bg-light border my-3 small d-flex flex-column gap-1">
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-user text-brand me-1"></i> Parent:</span>
                                        <strong class="text-dark text-truncate ms-2"><?= ViewHelper::e($pet['owner_name'] ?? 'Pet Parent') ?></strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-microchip text-primary me-1"></i> Microchip:</span>
                                        <strong class="font-monospace text-dark text-truncate ms-2"><?= ViewHelper::e($pet['microchip_id'] ?: 'Pending / Unassigned') ?></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons Row -->
                            <div class="d-flex gap-2 mt-auto pt-3 border-top align-items-center">
                                <a href="<?= ViewHelper::url('vet/patients/' . $pet['id']) ?>" class="btn btn-admin-primary flex-grow-1 text-center text-decoration-none py-2 px-3 d-flex align-items-center justify-content-center gap-1 fw-bold shadow-sm" style="min-height: 42px; font-size: 13px;">
                                    <i class="fa-solid fa-folder-open"></i>
                                    <span>Medical Vault</span>
                                </a>
                                <?php if (!empty($pet['user_id'])): ?>
                                    <button type="button" class="btn btn-outline-success rounded-pill px-3 py-2 d-flex align-items-center justify-content-center" style="min-height: 42px;" onclick="PetGuardCall.initiateCall(<?= (int)$pet['user_id'] ?>, 'video', 'consultation', <?= (int)$pet['id'] ?>)" title="Video Call Pet Parent">
                                        <i class="fa-solid fa-video"></i>
                                    </button>
                                <?php endif; ?>
                                <a href="<?= ViewHelper::url('portal/passport/' . ($pet['qr_token'] ?? '')) ?>" target="_blank" class="btn btn-outline-dark rounded-pill px-3 py-2 d-flex align-items-center justify-content-center" style="min-height: 42px;" title="Digital Passport">
                                    <i class="fa-solid fa-qrcode"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Right Side Column (AI Diagnostic Assistant, Clinical Services, Emergency) -->
    <div class="col-lg-4">

        <!-- AI Assistant Mini Card -->
        <div class="admin-card p-4 mb-4 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="fa-solid fa-brain fs-5" style="color: #a78bfa;"></i>
                <h6 class="fw-bold m-0">AI Clinical Diagnostic Assistant</h6>
            </div>
            <p class="small text-light opacity-75 mb-3">Instant veterinary triage assistant for pharmacology, drug dosage calculators, and differential symptom analysis.</p>
            <a href="<?= ViewHelper::url('portal/ai-assistant') ?>" class="btn btn-sm rounded-pill fw-bold text-dark w-100 py-2 d-flex align-items-center justify-content-center gap-1" style="background: #feda46;">
                <i class="fa-solid fa-stethoscope"></i>
                <span>Open Diagnostic Assistant</span>
            </a>
        </div>

        <!-- Active Clinical Services Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                        <i class="fa-solid fa-briefcase-medical"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-dark">Clinical Services</h6>
                </div>
                <a href="<?= ViewHelper::url('vet/services') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    + Manage &rarr;
                </a>
            </div>
            <div class="admin-card-body p-0">
                <div class="list-group list-group-flush">
                    <?php if (empty($services)): ?>
                        <div class="p-4 text-center text-muted small">No clinical services listed yet.</div>
                    <?php else: ?>
                        <?php foreach (array_slice($services, 0, 4) as $srv): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3 px-4">
                                <div>
                                    <h6 class="fw-bold mb-1 text-dark" style="font-size: 14px;"><?= ViewHelper::e($srv['name']) ?></h6>
                                    <span class="badge bg-light text-secondary border px-2 py-0" style="font-size: 11px;"><?= ViewHelper::e($srv['category']) ?></span>
                                    <span class="text-muted small ms-2"><i class="fa-regular fa-clock me-1 text-brand"></i><?= $srv['duration_minutes'] ?> mins</span>
                                </div>
                                <div class="fw-bold text-brand fs-5">
                                    $<?= number_format((float)$srv['price'], 2) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- 24/7 Emergency Veterinary Triage Card -->
        <div class="admin-card p-4 border border-danger-subtle position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);">
            <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #ef4444 0%, #fa441d 100%);"></div>
            
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-4 bg-danger text-white d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 44px; height: 44px; font-size: 20px;">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <div>
                    <h6 class="fw-bold m-0 text-danger" style="font-size: 15px;">24/7 Emergency Triage</h6>
                    <small class="text-muted">On-call triage & emergency hotline</small>
                </div>
            </div>

            <p class="small text-muted mb-3" style="line-height: 1.5;">
                Active on-call emergencies from pet parents in your geographic radius route directly here.
            </p>

            <div class="d-flex flex-column gap-2">
                <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-danger rounded-pill fw-bold w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="min-height: 46px; font-size: 13.5px;">
                    <i class="fa-solid fa-truck-medical"></i>
                    <span>Emergency Response Queue (<?= $kpi['activeEmergencies'] ?? 0 ?>)</span>
                </a>
                <a href="tel:+18005557389" class="btn btn-outline-danger rounded-pill fw-semibold w-100 d-flex align-items-center justify-content-center gap-2" style="min-height: 42px; font-size: 13px;">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>Triage Hotline: (800) 555-PET-911</span>
                </a>
            </div>
        </div>

    </div>
</div>
