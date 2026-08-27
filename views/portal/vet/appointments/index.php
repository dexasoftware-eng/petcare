<?php
use Helpers\ViewHelper;

$appointments = $appointments ?? [];
$totalAppts = count($appointments);
$confirmedCount = 0;
$pendingCount = 0;
$completedCount = 0;

foreach ($appointments as $a) {
    $st = $a['status'] ?? 'pending';
    if ($st === 'confirmed') $confirmedCount++;
    elseif ($st === 'pending') $pendingCount++;
    elseif ($st === 'completed') $completedCount++;
}
?>

<style>
@media (max-width: 767.98px) {
    .appts-desktop-table { display: none !important; }
    .appts-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .appts-desktop-table { display: block !important; }
    .appts-mobile-grid { display: none !important; }
}
</style>

<div class="vet-appointments-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-calendar-check text-warning"></i>
                <span>Clinical Telehealth &amp; Clinic Queue</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= $confirmedCount ?> Confirmed</span>
            </div>
            <h2 class="portal-hero-title">Consultations &amp; Appointments 🩺</h2>
            <p class="portal-hero-subtitle">
                Review upcoming patient bookings, launch instant WebRTC encrypted video consultations, and manage triage.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('vet/availability') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-clock"></i>
                <span>Availability Slots</span>
            </a>
            <a href="<?= ViewHelper::url('portal/calls') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-video"></i>
                <span>Consultation Hub</span>
            </a>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Bookings</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-calendar-days"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalAppts ?></div>
                <small class="text-muted" style="font-size: 11px;">Patient Sessions</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Confirmed</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $confirmedCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Ready for Care</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Pending Approval</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $pendingCount > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $pendingCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Awaiting Review</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Completed</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-clipboard-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $completedCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Finished Consultations</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Appointments Content -->
    <?php if (empty($appointments)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-regular fa-calendar-xmark"></i>
            </div>
            <h5 class="fw-bold text-dark">No Appointments Found</h5>
            <p class="small text-muted mb-0" style="max-width: 480px; margin: 0 auto;">When pet owners schedule physical or virtual visits, they will appear here with instant call actions.</p>
        </div>
    <?php else: ?>

        <!-- A. Desktop Data Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden appts-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Scheduled Consultations (<?= $totalAppts ?> Bookings)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Active Queue</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 220px;">Patient (Pet)</th>
                            <th class="py-3" style="min-width: 180px;">Pet Parent</th>
                            <th class="py-3" style="min-width: 160px;">Date &amp; Time</th>
                            <th class="py-3" style="min-width: 170px;">Type &amp; Reason</th>
                            <th class="py-3" style="min-width: 120px;">Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appt): 
                            $statusMap = [
                                'confirmed' => 'bg-success-subtle text-success border-success-subtle',
                                'pending' => 'bg-warning-subtle text-warning border-warning-subtle',
                                'completed' => 'bg-secondary-subtle text-secondary border-secondary-subtle',
                                'cancelled' => 'bg-danger-subtle text-danger border-danger-subtle',
                                'rejected' => 'bg-danger-subtle text-danger border-danger-subtle'
                            ];
                        ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($appt['pet_avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div class="min-w-0">
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                            <span class="text-muted small"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?> &middot; <?= ViewHelper::e($appt['pet_breed'] ?? 'Unknown Breed') ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($appt['owner_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($appt['owner_phone'] ?? $appt['owner_email']) ?></small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?></div>
                                    <small class="text-muted"><i class="fa-regular fa-clock me-1 text-brand"></i><?= ViewHelper::e($appt['appointment_time']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-0 mb-1 d-inline-block"><?= ViewHelper::e($appt['type'] ?? 'Consultation') ?></span>
                                    <div class="small text-muted text-truncate" style="max-width: 180px;"><?= ViewHelper::e($appt['notes'] ?: 'No symptoms specified') ?></div>
                                </td>
                                <td>
                                    <span class="badge <?= $statusMap[$appt['status']] ?? 'bg-light text-dark border' ?> rounded-pill px-2 py-1 text-uppercase fw-bold" style="font-size: 10.5px;">
                                        <?= ViewHelper::e($appt['status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm d-inline-flex align-items-center gap-1" onclick="PetGuardCall.initiateCall(<?= (int)$appt['owner_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)">
                                            <i class="fa-solid fa-video"></i>
                                            <span>Call</span>
                                        </button>
                                        <a href="<?= ViewHelper::url('vet/appointments/' . $appt['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold">
                                            Details
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile & Tablet Card Grid (<768px) -->
        <div class="row g-3 appts-mobile-grid mb-4">
            <?php foreach ($appointments as $appt): 
                $statusClass = ($appt['status'] === 'confirmed') ? 'bg-success-subtle text-success border-success-subtle' : (($appt['status'] === 'pending') ? 'bg-warning-subtle text-warning border-warning-subtle' : 'bg-light text-dark border');
            ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2 pb-2 border-bottom">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="<?= ViewHelper::asset($appt['pet_avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border flex-shrink-0" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                        <small class="text-muted"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?> &middot; <?= ViewHelper::e($appt['pet_breed'] ?? '') ?></small>
                                    </div>
                                </div>
                                <span class="badge <?= $statusClass ?> rounded-pill px-2 py-1 text-uppercase fw-bold" style="font-size: 9.5px;">
                                    <?= ViewHelper::e($appt['status']) ?>
                                </span>
                            </div>

                            <div class="mb-2 small">
                                <div class="text-dark fw-semibold mb-1">
                                    <i class="fa-solid fa-user text-brand me-1"></i><?= ViewHelper::e($appt['owner_name']) ?>
                                </div>
                                <div class="text-muted mb-1">
                                    <i class="fa-regular fa-calendar text-brand me-1"></i><?= date('M d, Y', strtotime($appt['appointment_date'])) ?> at <?= ViewHelper::e($appt['appointment_time']) ?>
                                </div>
                                <div class="p-2 bg-light rounded-3 border text-muted" style="font-size: 11.5px;">
                                    <strong>Reason:</strong> <?= ViewHelper::e($appt['notes'] ?: 'Standard physical exam') ?>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-success rounded-pill flex-grow-1 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-1" onclick="PetGuardCall.initiateCall(<?= (int)$appt['owner_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)">
                                <i class="fa-solid fa-video"></i> Video Call
                            </button>
                            <a href="<?= ViewHelper::url('vet/appointments/' . $appt['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold py-2">
                                Details
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
