<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-calendar-check text-brand me-2"></i> Consultations & Telehealth Queue</h2>
        <p class="admin-page-subtitle">Review, approve, and launch live video consultations with pet parents.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list text-brand me-2"></i> All Scheduled Appointments</h3>
        <span class="badge bg-light text-dark border"><?= count($appointments ?? []) ?> Bookings</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($appointments)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-regular fa-calendar-xmark fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No appointments found</h5>
                <p class="small text-muted">Appointments booked by pet parents will appear in this queue.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Patient (Pet)</th>
                            <th>Pet Parent</th>
                            <th>Date & Time</th>
                            <th>Type & Symptoms</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($appointments as $appt): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($appt['pet_avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                            <div class="small text-muted"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?> &middot; <?= ViewHelper::e($appt['pet_breed'] ?? '') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($appt['owner_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($appt['owner_phone'] ?? $appt['owner_email']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?></div>
                                    <div class="small text-muted"><i class="fa-regular fa-clock me-1"></i><?= ViewHelper::e($appt['appointment_time']) ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-0"><?= ViewHelper::e($appt['type'] ?? 'Consultation') ?></span>
                                    <div class="small text-muted text-truncate" style="max-width: 180px;"><?= ViewHelper::e($appt['notes'] ?: 'No symptoms specified') ?></div>
                                </td>
                                <td>
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
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$appt['owner_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)">
                                            <i class="fa-solid fa-video me-1"></i> Call
                                        </button>
                                        <a href="<?= ViewHelper::url('vet/appointments/' . $appt['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            Details
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
