<?php
use Helpers\ViewHelper;
?>

<!-- 1. Lost Pet Emergency Banner (If any pet is marked lost) -->
<?php if (!empty($lostPets)): ?>
    <?php foreach ($lostPets as $lp): ?>
        <div class="alert alert-danger rounded-4 border-2 border-danger shadow-sm p-4 mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
            <div class="d-flex align-items-center gap-3">
                <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; min-width: 48px; font-size: 22px;">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h5 class="fw-bold m-0 text-danger">⚠️ URGENT: <?= ViewHelper::e($lp['name']) ?> is marked as LOST!</h5>
                    <p class="m-0 small text-dark">
                        Last seen near: <strong><?= ViewHelper::e($lp['lost_location'] ?: 'Unknown Location') ?></strong> • 
                        QR Public Scans are currently routing to your Emergency Finder Card.
                    </p>
                </div>
            </div>
            <div class="d-flex gap-2">
                <a href="<?= ViewHelper::url('portal/pets/' . $lp['id']) ?>" class="btn btn-sm btn-dark rounded-pill px-3">View Pet</a>
                <form action="<?= ViewHelper::url('portal/pets/' . $lp['id'] . '/found') ?>" method="POST" class="m-0">
                    <?= ViewHelper::csrfField() ?>
                    <button type="submit" class="btn btn-sm btn-success rounded-pill px-4 fw-bold"><i class="fa-solid fa-shield-cat me-1"></i> Mark as Safely Found</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- 2. Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-shield-cat text-warning"></i>
            <span>Pet Parent Command Center</span>
        </div>
        <h2 class="portal-hero-title">Good <?= (date('H') < 12 ? 'Morning' : (date('H') < 18 ? 'Afternoon' : 'Evening')) ?>, <?= ViewHelper::e($user['name']) ?>! 👋</h2>
        <p class="portal-hero-subtitle">Unified PetCare ecosystem &middot; Everything your pets need today.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus"></i>
            <span>Register Pet</span>
        </a>
        <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-calendar-plus"></i>
            <span>Book Clinic</span>
        </a>
        <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-outline-danger rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-1" style="min-height: 44px;">
            <i class="fa-solid fa-truck-medical"></i>
            <span>Emergency</span>
        </a>
    </div>
</div>

<!-- 3. Primary Metric KPI Cards Grid (Matching Admin Command Center) -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Registered Pets</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-paw"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= count($pets) ?></div>
            <div class="stat-card-footer">
                <span class="text-success fw-bold"><i class="fa-solid fa-shield-heart me-1"></i> 100%</span> Active Profiles
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Today's Care Tasks</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= count($pendingTasks) ?> <small class="fs-6 text-muted fw-normal">/ <?= count($careTasks) ?></small></div>
            <div class="stat-card-footer">
                <span class="badge bg-success"><?= count($completedTasks) ?> Completed Today</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Upcoming Vet Visits</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= count($upcomingAppts) ?></div>
            <div class="stat-card-footer">
                <span class="text-primary fw-bold"><?= count($appointments) ?></span> Total Consultations
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Digital Passports</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-qrcode"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= count($pets) ?></div>
            <div class="stat-card-footer">
                <span class="text-warning fw-bold"><i class="fa-solid fa-circle-check me-1"></i> QR Enabled</span>
            </div>
        </div>
    </div>
</div>

<!-- 4. Main Two-Column Content Grid -->
<div class="row g-4">
    <!-- Left Column: Today's Care & Pets Showcase -->
    <div class="col-lg-8">
        
        <!-- A. Today's Care Routine & Smart Daily Plan -->
        <div class="admin-card mb-4">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-list-check text-brand fs-5"></i>
                    <h3 class="admin-card-title m-0">Today's Care & Smart Schedule</h3>
                </div>
                <a href="<?= ViewHelper::url('portal/care') ?>" class="text-brand small fw-bold text-decoration-none">Manage Schedule &rarr;</a>
            </div>
            <div class="admin-card-body p-4">
                <?php if (empty($careTasks)): ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fa-solid fa-clipboard-check fs-2 text-muted mb-2"></i>
                        <p class="small m-0">No daily tasks scheduled for today. Add feeding, walking, or medication routines!</p>
                    </div>
                <?php else: ?>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach ($careTasks as $task): ?>
                            <div class="p-3 rounded-3 border d-flex align-items-center justify-content-between gap-3 <?= $task['is_completed'] ? 'bg-light text-muted' : 'bg-white shadow-sm' ?>">
                                <div class="d-flex align-items-center gap-3">
                                    <form action="<?= ViewHelper::url('portal/care/tasks/' . $task['id'] . '/toggle') ?>" method="POST" class="m-0">
                                        <?= ViewHelper::csrfField() ?>
                                        <input type="hidden" name="redirect" value="portal">
                                        <button type="submit" class="btn btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center <?= $task['is_completed'] ? 'btn-success' : 'btn-outline-secondary' ?>" style="width: 30px; height: 30px;">
                                            <i class="fa-solid fa-check <?= $task['is_completed'] ? 'text-white' : 'text-muted' ?>" style="font-size: 13px;"></i>
                                        </button>
                                    </form>
                                    <div>
                                        <div class="fw-bold <?= $task['is_completed'] ? 'text-decoration-line-through text-muted' : 'text-dark' ?>">
                                            <?= ViewHelper::e($task['title']) ?>
                                        </div>
                                        <div class="small text-muted">
                                            <span class="badge bg-light text-dark border"><?= ViewHelper::e($task['pet_name']) ?></span> • 
                                            <i class="fa-regular fa-clock me-1"></i> <?= ViewHelper::e($task['time_due']) ?>
                                            <?php if (!empty($task['notes'])): ?> • <span class="fst-italic"><?= ViewHelper::e($task['notes']) ?></span><?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge <?= $task['is_completed'] ? 'bg-success' : 'bg-warning text-dark' ?> text-uppercase" style="font-size: 10px;">
                                    <?= $task['is_completed'] ? 'Completed' : 'Pending' ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- B. Family Pets Showcase Cards -->
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <h4 class="fw-bold text-dark m-0" style="font-family: var(--font-heading, inherit);">
                <i class="fa-solid fa-paw text-brand me-2"></i> My Family Pets (<?= count($pets) ?>)
            </h4>
            <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn btn-sm btn-admin-primary px-3 py-2 fw-bold shadow-sm d-flex align-items-center gap-1 text-decoration-none">
                <i class="fa-solid fa-plus"></i>
                <span>Register Pet</span>
            </a>
        </div>

        <?php if (empty($pets)): ?>
            <div class="admin-card text-center p-5 mb-4">
                <i class="fa-solid fa-dog fs-1 text-muted mb-3"></i>
                <h5 class="fw-bold">No pets registered yet</h5>
                <p class="text-muted small mb-4">Register your dog, cat, or companion to unlock digital passports and health score tracking.</p>
                <a href="<?= ViewHelper::url('portal/pets/create') ?>" class="btn-admin-primary mx-auto text-decoration-none">Register Pet Profile</a>
            </div>
        <?php else: ?>
            <div class="row g-3 mb-4">
                <?php foreach ($pets as $pet): ?>
                    <div class="col-12 col-md-6">
                        <div class="admin-card p-4 h-100 position-relative border d-flex flex-column justify-content-between shadow-sm" style="border-radius: 20px;">
                            <div>
                                <!-- Avatar + Identity Header -->
                                <div class="d-flex gap-3 align-items-start mb-2">
                                    <div class="position-relative flex-shrink-0">
                                        <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border shadow-sm" style="width: 70px; height: 70px; object-fit: contain; background: #fff8e5;">
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden min-w-0">
                                        <div class="d-flex justify-content-between align-items-center gap-1 mb-1">
                                            <h5 class="fw-bold text-dark m-0 text-truncate" style="font-family: var(--font-heading, inherit); font-size: 16px;"><?= ViewHelper::e($pet['name']) ?></h5>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold flex-shrink-0" style="font-size: 11px;">
                                                <i class="fa-solid fa-shield-heart me-1"></i> Score: <?= $pet['care_score'] ?? 90 ?>
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
                                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill small"><i class="fa-solid fa-shield-halved me-1"></i> Passport Active</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Security Monospace Credentials Box -->
                                <div class="p-2 px-3 rounded-3 bg-light border my-3 small d-flex flex-column gap-1">
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-qrcode text-brand me-1"></i> QR Token:</span>
                                        <code class="text-dark fw-bold text-truncate ms-2"><?= ViewHelper::e($pet['qr_token']) ?></code>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                        <span class="text-muted text-nowrap"><i class="fa-solid fa-microchip text-primary me-1"></i> Microchip:</span>
                                        <strong class="font-monospace text-dark text-truncate ms-2"><?= ViewHelper::e($pet['microchip_id'] ?: 'Pending / Unassigned') ?></strong>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons Row (Precision 42px touch targets across all 5 screens) -->
                            <div class="d-flex gap-2 mt-auto pt-3 border-top align-items-center flex-nowrap">
                                <a href="<?= ViewHelper::url('portal/pets/' . $pet['id']) ?>" class="btn btn-admin-primary flex-grow-1 text-center text-decoration-none py-2 px-3 d-flex align-items-center justify-content-center gap-2 fw-bold shadow-sm" style="min-height: 42px; font-size: 13px; border-radius: 50px; white-space: nowrap;">
                                    <i class="fa-solid fa-id-card-clip"></i>
                                    <span>Pet Profile</span>
                                </a>
                                <a href="<?= ViewHelper::url('portal/passport/' . $pet['qr_token']) ?>" class="btn btn-outline-dark rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; padding: 0;" title="Digital QR Passport">
                                    <i class="fa-solid fa-qrcode fs-6"></i>
                                </a>
                                <a href="<?= ViewHelper::url('portal/emergency/card/' . $pet['id']) ?>" class="btn btn-outline-danger rounded-circle d-inline-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 42px; height: 42px; min-width: 42px; min-height: 42px; padding: 0;" title="Emergency Medical Card">
                                    <i class="fa-solid fa-truck-medical fs-6"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Right Side Column (Appointments, AI Health Tips, Notifications) -->
    <div class="col-lg-4">

        <!-- AI Assistant Mini Card -->
        <div class="admin-card p-4 mb-4 text-white" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);">
            <div class="d-flex align-items-center gap-2 mb-2">
                <i class="fa-solid fa-brain fs-5" style="color: #a78bfa;"></i>
                <h6 class="fw-bold m-0">PetGuard AI Assistant</h6>
            </div>
            <p class="small text-light opacity-75 mb-3">Ask clinical wellness questions, diet guidance, or generate custom care plans powered by OpenRouter.</p>
            <a href="<?= ViewHelper::url('portal/ai-assistant') ?>" class="btn btn-sm rounded-pill fw-bold text-dark w-100 py-2" style="background: #feda46;">
                <i class="fa-solid fa-comments me-1"></i> Open AI Pet Assistant
            </a>
        </div>

        <!-- Upcoming Consultations Card -->
        <div class="admin-card mb-4">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-dark">Vet Consultations</h6>
                </div>
                <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    View All &rarr;
                </a>
            </div>
            <div class="admin-card-body p-3">
                <?php if (empty($upcomingAppts)): ?>
                    <div class="text-center py-4 text-muted">
                        <i class="fa-regular fa-calendar-xmark fa-2x mb-2 text-muted"></i>
                        <p class="small m-0 mb-3">No upcoming consultations booked.</p>
                        <a href="<?= ViewHelper::url('portal/appointments') ?>" class="btn btn-sm btn-admin-primary rounded-pill px-3">
                            <i class="fa-solid fa-plus me-1"></i> Book Consultation
                        </a>
                    </div>
                <?php else: ?>
                    <div class="d-flex flex-column gap-2">
                        <?php foreach (array_slice($upcomingAppts, 0, 3) as $appt): ?>
                            <div class="p-3 rounded-4 border bg-white shadow-sm transition-all">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                    <div class="min-w-0 flex-grow-1">
                                        <div class="fw-bold text-dark text-truncate" style="font-size: 14px;">
                                            <i class="fa-solid fa-paw text-brand me-1"></i>
                                            <?= ViewHelper::e($appt['pet_name']) ?>
                                        </div>
                                        <span class="badge bg-light text-secondary border px-2 py-0" style="font-size: 11px;">
                                            <?= ViewHelper::e($appt['consultation_type'] ?: 'General Checkup') ?>
                                        </span>
                                    </div>
                                    <?php
                                    $badgeClass = match($appt['status']) {
                                        'confirmed' => 'bg-primary',
                                        'completed' => 'bg-success',
                                        'cancelled' => 'bg-danger',
                                        default => 'bg-warning text-dark'
                                    };
                                    ?>
                                    <span class="badge <?= $badgeClass ?> text-uppercase rounded-pill px-2 py-1" style="font-size: 10px;">
                                        <?= ucfirst(ViewHelper::e($appt['status'])) ?>
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center pt-2 border-top gap-2 flex-wrap">
                                    <div class="small text-muted">
                                        <i class="fa-regular fa-clock me-1 text-brand"></i>
                                        <?= date('M d, Y', strtotime($appt['appointment_date'])) ?> &middot; <?= ViewHelper::e($appt['appointment_time']) ?>
                                    </div>
                                    <?php if (!empty($appt['vet_id']) && ($appt['status'] === 'confirmed' || $appt['status'] === 'pending')): ?>
                                        <button type="button" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-bold d-flex align-items-center gap-1" style="font-size: 11.5px;" onclick="PetGuardCall.initiateCall(<?= (int)$appt['vet_id'] ?>, 'video', 'appointment', <?= (int)$appt['id'] ?>)">
                                            <i class="fa-solid fa-video"></i>
                                            <span>Call Vet</span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- 24/7 Emergency Support Card -->
        <div class="admin-card p-4 border border-danger-subtle position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #fff5f5 0%, #ffffff 100%);">
            <div class="position-absolute top-0 start-0 end-0" style="height: 4px; background: linear-gradient(90deg, #ef4444 0%, #fa441d 100%);"></div>
            
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="rounded-4 bg-danger text-white d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 44px; height: 44px; font-size: 20px;">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <div>
                    <h6 class="fw-bold m-0 text-danger" style="font-size: 15px;">24/7 Emergency Triage</h6>
                    <small class="text-muted">Instant hotline & veterinary response</small>
                </div>
            </div>

            <p class="small text-muted mb-3" style="line-height: 1.5;">
                Need urgent care? Call our dedicated triage hotline or locate the nearest emergency clinic.
            </p>

            <div class="d-flex flex-column gap-2">
                <a href="tel:+18005557389" class="btn btn-danger rounded-pill fw-bold w-100 d-flex align-items-center justify-content-center gap-2 shadow-sm" style="min-height: 46px; font-size: 13.5px;">
                    <i class="fa-solid fa-phone-volume"></i>
                    <span>Call Hotline: (800) 555-PET-911</span>
                </a>
                <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-outline-danger rounded-pill fw-semibold w-100 d-flex align-items-center justify-content-center gap-2" style="min-height: 42px; font-size: 13px;">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Open Emergency Center &rarr;</span>
                </a>
            </div>
        </div>

    </div>
</div>
