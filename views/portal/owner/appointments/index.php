<?php
use Helpers\ViewHelper;

// Compute metrics
$totalAppts = count($appointments ?? []);
$upcomingCount = count(array_filter($appointments ?? [], fn($a) => in_array($a['status'], ['pending', 'confirmed'])));
$telehealthCount = count(array_filter($appointments ?? [], fn($a) => !empty($a['vet_id']) && in_array($a['status'], ['pending', 'confirmed'])));
$completedCount = count(array_filter($appointments ?? [], fn($a) => $a['status'] === 'completed'));
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-calendar-check text-warning"></i>
            <span>Clinical Appointments &amp; Telehealth</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= $upcomingCount ?> Upcoming</span>
        </div>
        <h2 class="portal-hero-title">Appointments &amp; Consultations 🩺</h2>
        <p class="portal-hero-subtitle">
            Schedule clinic visits, manage follow-ups, and launch encrypted telehealth consultations.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/vets') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-user-doctor"></i>
            <span>Find Doctors</span>
        </a>
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#bookApptModal">
            <i class="fa-solid fa-calendar-plus"></i>
            <span>Book Consultation</span>
        </button>
    </div>
</div>

<!-- 2. Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-blue">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $totalAppts ?></div>
                <div class="stat-card-label">Total Bookings</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-orange">
                <i class="fa-solid fa-clock"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $upcomingCount ?></div>
                <div class="stat-card-label">Upcoming Visits</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-purple">
                <i class="fa-solid fa-video"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $telehealthCount ?></div>
                <div class="stat-card-label">Telemedicine Ready</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-3">
        <div class="stat-card shadow-sm h-100" style="border-radius: 18px;">
            <div class="stat-card-icon icon-green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="stat-card-info">
                <div class="stat-card-value"><?= $completedCount ?></div>
                <div class="stat-card-label">Completed Care</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Appointments Card -->
<div class="admin-card shadow-sm mb-4" style="border-radius: 20px; overflow: hidden;">
    <div class="p-4 d-flex justify-content-between align-items-center flex-wrap gap-3 border-bottom bg-white">
        <div class="d-flex align-items-center gap-3">
            <div class="stat-card-icon icon-blue" style="width: 40px; height: 40px; font-size: 16px; border-radius: 12px;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div>
                <h5 class="fw-bold text-dark m-0">Veterinary Consultations &amp; Visits</h5>
                <p class="text-muted small m-0">Schedule clinical consultations, track upcoming appointments, and launch video telemedicine.</p>
            </div>
        </div>
        <button type="button" class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#bookApptModal">
            <i class="fa-solid fa-calendar-plus me-1"></i> Book New Consultation
        </button>
    </div>

    <?php if (empty($appointments)): ?>
        <div class="p-5 text-center text-muted">
            <div class="stat-card-icon icon-blue mx-auto mb-3" style="width: 48px; height: 48px; font-size: 20px; border-radius: 14px;">
                <i class="fa-solid fa-calendar-xmark"></i>
            </div>
            <h6 class="fw-bold text-dark mb-1">No Consultations Booked Yet</h6>
            <p class="small text-muted mb-3">Schedule your first routine checkup, vaccination booster, or diagnostic veterinary consultation.</p>
            <button class="btn btn-admin-primary px-3 py-2 fw-bold rounded-pill shadow-sm" style="font-size: 13px;" data-bs-toggle="modal" data-bs-target="#bookApptModal">
                <i class="fa-solid fa-calendar-plus me-1"></i> Book Appointment
            </button>
        </div>
    <?php else: ?>
        <div class="admin-table-container">
            <table class="admin-table align-middle">
                <thead>
                    <tr>
                        <th class="ps-4">Companion Patient</th>
                        <th>Consultation Type</th>
                        <th>Date &amp; Schedule</th>
                        <th>Assigned Doctor / Clinic</th>
                        <th>Symptoms &amp; Notes</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appt): ?>
                        <?php
                            $badgeClass = match($appt['status']) {
                                'confirmed' => 'bg-success-subtle text-success border border-success-subtle',
                                'completed' => 'bg-primary-subtle text-primary border border-primary-subtle',
                                'cancelled' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                default => 'bg-warning-subtle text-warning border border-warning-subtle'
                            };
                        ?>
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <?php if (!empty($appt['pet_avatar'])): ?>
                                        <img src="<?= ViewHelper::asset($appt['pet_avatar']) ?>" class="rounded-3 border object-fit-cover flex-shrink-0" style="width: 40px; height: 40px;" alt="<?= ViewHelper::e($appt['pet_name']) ?>" onerror="this.onerror=null; this.src='<?= ViewHelper::asset('img/heading-img.png') ?>';">
                                    <?php else: ?>
                                        <div class="rounded-3 bg-light border d-flex align-items-center justify-content-center fw-bold text-brand flex-shrink-0" style="width: 40px; height: 40px; font-size: 15px;">
                                            <i class="fa-solid fa-paw"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="min-w-0">
                                        <a href="<?= ViewHelper::url('portal/pets/' . $appt['pet_id']) ?>" class="fw-bold text-dark text-decoration-none d-block text-truncate">
                                            <?= ViewHelper::e($appt['pet_name']) ?>
                                        </a>
                                        <small class="text-muted text-truncate d-block" style="font-size: 11px;">
                                            <?= ViewHelper::e($appt['pet_breed'] ?: 'Companion') ?>
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border fw-medium"><?= ViewHelper::e($appt['consultation_type']) ?></span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark text-nowrap">
                                    <i class="fa-regular fa-calendar text-muted me-1"></i> <?= date('M d, Y', strtotime($appt['appointment_date'])) ?>
                                </div>
                                <small class="text-muted text-nowrap" style="font-size: 11px;">
                                    <i class="fa-regular fa-clock text-brand me-1"></i> <?= ViewHelper::e($appt['appointment_time']) ?>
                                </small>
                            </td>
                            <td>
                                <div class="fw-semibold text-dark text-nowrap">
                                    <i class="fa-solid fa-user-doctor text-muted me-1"></i> <?= ViewHelper::e($appt['vet_name'] ?: 'Clinical Specialist') ?>
                                </div>
                                <small class="text-muted d-block text-nowrap" style="font-size: 11px;">PetGuard Central Hospital</small>
                            </td>
                            <td>
                                <div class="small text-muted text-truncate" style="max-width: 200px;" title="<?= ViewHelper::e($appt['symptoms']) ?>">
                                    <?= ViewHelper::e($appt['symptoms']) ?>
                                </div>
                            </td>
                            <td>
                                <span class="badge <?= $badgeClass ?> text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                                    <?= ucfirst($appt['status']) ?>
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-inline-flex align-items-center gap-2 justify-content-end">
                                    <?php if (!empty($appt['vet_id']) && in_array($appt['status'], ['pending', 'confirmed'])): ?>
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 12px; min-height: 34px;" onclick="PetGuardCall.initiateCall(<?= (int)$appt['vet_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)" title="Launch Telemedicine Video Call">
                                            <i class="fa-solid fa-video"></i> Call Vet
                                        </button>
                                    <?php endif; ?>
                                    <?php if ($appt['status'] === 'pending' || $appt['status'] === 'confirmed'): ?>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Cancel Consultation"
                                            data-confirm-delete
                                            data-action="<?= ViewHelper::url('portal/appointments/' . $appt['id'] . '/cancel') ?>"
                                            data-title="Cancel Appointment Consultation?"
                                            data-message="Are you sure you want to cancel the scheduled consultation for <?= ViewHelper::e($appt['pet_name']) ?> on <?= date('M d, Y', strtotime($appt['appointment_date'])) ?> at <?= ViewHelper::e($appt['appointment_time']) ?>?">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<!-- Modal: Book Appointment -->
<div class="modal fade" id="bookApptModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-calendar-plus text-brand me-2"></i> Book Veterinary Consultation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/appointments/book') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Pet *</label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?> — <?= ViewHelper::e($p['breed'] ?? 'Mixed') ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Veterinarian / Clinic</label>
                        <select name="vet_id" class="form-select rounded-3">
                            <option value="">Any Available Certified Veterinarian</option>
                            <?php foreach ($vets as $v): ?>
                                <option value="<?= $v['id'] ?>"><?= ViewHelper::e($v['name']) ?> (Licensed Doctor)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Date *</label>
                            <input type="date" name="appointment_date" class="form-control rounded-3" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d', strtotime('+1 day')) ?>" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Time Slot *</label>
                            <select name="appointment_time" class="form-select rounded-3" required>
                                <option value="09:00 AM">09:00 AM</option>
                                <option value="10:30 AM">10:30 AM</option>
                                <option value="01:00 PM">01:00 PM</option>
                                <option value="03:30 PM">03:30 PM</option>
                                <option value="05:00 PM">05:00 PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Consultation Type</label>
                        <select name="consultation_type" class="form-select rounded-3">
                            <option value="General Health Checkup">General Health Checkup</option>
                            <option value="Vaccination & Immunization">Vaccination & Immunization</option>
                            <option value="Dermatology & Skin Allergy">Dermatology & Skin Allergy</option>
                            <option value="Dental Examination">Dental Examination</option>
                            <option value="Urgent Care Visit">Urgent Care Visit</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Symptoms / Reason for Visit *</label>
                        <textarea name="symptoms" rows="3" class="form-control rounded-3" required placeholder="Describe any observed symptoms, dietary changes, or questions for the veterinarian..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4"><i class="fa-solid fa-calendar-check me-1"></i> Confirm Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
