<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-list-check text-warning"></i>
            <span>Daily Care Schedule &amp; Habit Streak</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">Smart Reminders</span>
        </div>
        <h2 class="portal-hero-title">Care &amp; Daily Schedule 🐾</h2>
        <p class="portal-hero-subtitle">Track feeding, walking, medications, and grooming tasks for all your companion animals.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#newCareTaskModal">
            <i class="fa-solid fa-plus"></i>
            <span>New Care Routine</span>
        </button>
    </div>
</div>

<!-- Daily Streak & Goals Banner (5-Screen Optimized) -->
<div class="row g-3 mb-4">
    <!-- Card 1: 7-Day Care Streak with Daily Dot Micro-Tracker -->
    <div class="col-12 col-md-6 col-xl-4">
        <div class="stat-card p-4 h-100 position-relative overflow-hidden text-white border-0 shadow-sm d-flex flex-column justify-content-between" style="background: linear-gradient(135deg, #fa441d 0%, #d93814 100%); border-radius: 20px;">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle bg-white text-brand d-inline-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 46px; height: 46px; font-size: 22px;">
                        🔥
                    </div>
                    <div>
                        <span class="text-white-50 small fw-bold text-uppercase" style="letter-spacing: 0.8px; font-size: 11px;">Care Continuity</span>
                        <h4 class="fw-bold m-0 text-white" style="font-family: var(--font-heading, inherit);">7-Day Care Streak</h4>
                    </div>
                </div>
                <span class="badge bg-white text-brand rounded-pill px-3 py-1 fw-bold shadow-sm" style="font-size: 11px;">
                    Top 5%
                </span>
            </div>
            
            <!-- 7-Day Micro Check Dots -->
            <div>
                <div class="d-flex justify-content-between align-items-center gap-1 mb-2 pt-2 border-top border-white border-opacity-25">
                    <?php 
                    $days = ['M', 'T', 'W', 'T', 'F', 'S', 'S'];
                    foreach ($days as $idx => $d): 
                    ?>
                        <div class="text-center flex-grow-1">
                            <span class="text-white-50" style="font-size: 10px; font-weight: 700;"><?= $d ?></span>
                            <div class="rounded-circle bg-white text-brand d-flex align-items-center justify-content-center mx-auto mt-1 shadow-sm" style="width: 22px; height: 22px; font-size: 10px;">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <small class="text-white-50 d-block text-center mt-1" style="font-size: 11px;">Consistent care rewards unlocked &bull; Next goal: 14 Days</small>
            </div>
        </div>
    </div>

    <!-- Card 2: Nutrition & Hydration Target -->
    <div class="col-12 col-md-6 col-xl-4">
        <div class="stat-card p-4 h-100 bg-white border d-flex flex-column justify-content-between shadow-sm" style="border-radius: 20px;">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-2 d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #ecfdf5; color: #10b981;">
                            <i class="fa-solid fa-bowl-food fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.8px; font-size: 11px;">Daily Nutrition</span>
                            <h5 class="fw-bold m-0 text-dark">Hydration &amp; Meals</h5>
                        </div>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                        <i class="fa-solid fa-circle-check me-1"></i> 100%
                    </span>
                </div>

                <!-- Gradient Progress Bar -->
                <div class="progress rounded-pill my-3" style="height: 10px; background-color: #f1f5f9;">
                    <div class="progress-bar rounded-pill" role="progressbar" style="width: 100%; background: linear-gradient(90deg, #10b981, #059669); box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-2 border-top small text-muted">
                <span><i class="fa-solid fa-check text-success me-1"></i> All daily meals completed</span>
                <span class="fw-bold text-dark font-monospace">2 / 2 Fed</span>
            </div>
        </div>
    </div>

    <!-- Card 3: Physical Activity & Exercise Target -->
    <div class="col-12 col-md-12 col-xl-4">
        <div class="stat-card p-4 h-100 bg-white border d-flex flex-column justify-content-between shadow-sm" style="border-radius: 20px;">
            <div>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle p-2 d-inline-flex align-items-center justify-content-center flex-shrink-0" style="width: 46px; height: 46px; background: #eff6ff; color: #3b82f6;">
                            <i class="fa-solid fa-person-walking fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small fw-bold text-uppercase" style="letter-spacing: 0.8px; font-size: 11px;">Daily Exercise</span>
                            <h5 class="fw-bold m-0 text-dark">Walks &amp; Playtime</h5>
                        </div>
                    </div>
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1 fw-bold" style="font-size: 11px;">
                        85% Goal
                    </span>
                </div>

                <!-- Gradient Progress Bar -->
                <div class="progress rounded-pill my-3" style="height: 10px; background-color: #f1f5f9;">
                    <div class="progress-bar rounded-pill" role="progressbar" style="width: 85%; background: linear-gradient(90deg, #3b82f6, #2563eb); box-shadow: 0 2px 8px rgba(59, 130, 246, 0.4);" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center pt-2 border-top small text-muted">
                <span><i class="fa-solid fa-clock text-primary me-1"></i> 25 of 30 min daily activity logged</span>
                <span class="fw-bold text-dark font-monospace">25 / 30m</span>
            </div>
        </div>
    </div>
</div>

<!-- Daily Schedule Task Checklist -->
<div class="admin-card mb-4">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-regular fa-calendar-days text-brand me-2"></i> Daily Care Checklist</h3>
        <span class="text-muted small"><?= date('l, F j, Y') ?></span>
    </div>
    <div class="admin-card-body p-4">
        <?php if (empty($tasks)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-clipboard-list fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold">No care routines scheduled</h5>
                <p class="small mb-3">Add daily feeding, walking, or medication routines to maintain care consistency.</p>
                <button class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#newCareTaskModal">+ Add First Routine</button>
            </div>
        <?php else: ?>
            <div class="d-flex flex-column gap-3">
                <?php foreach ($tasks as $task): ?>
                    <div class="care-task-item p-3 rounded-4 d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 <?= $task['is_completed'] ? 'care-task-completed' : 'bg-white shadow-sm' ?>">
                        
                        <!-- Left Section: Checkbox + Avatar + Details -->
                        <div class="d-flex align-items-start align-items-sm-center gap-3 flex-grow-1 min-w-0">
                            <!-- Toggle Button Form -->
                            <form action="<?= ViewHelper::url('portal/care/tasks/' . $task['id'] . '/toggle') ?>" method="POST" class="m-0 flex-shrink-0 mt-1 mt-sm-0">
                                <?= ViewHelper::csrfField() ?>
                                <input type="hidden" name="redirect" value="portal/care">
                                <button type="submit" class="btn btn-sm rounded-circle p-0 d-flex align-items-center justify-content-center <?= $task['is_completed'] ? 'btn-success shadow-sm' : 'btn-outline-secondary' ?>" style="width: 34px; height: 34px;" title="<?= $task['is_completed'] ? 'Mark as Pending' : 'Mark as Completed' ?>">
                                    <i class="fa-solid fa-check <?= $task['is_completed'] ? 'text-white' : 'text-muted' ?>" style="font-size: 14px;"></i>
                                </button>
                            </form>

                            <!-- Companion Avatar -->
                            <img src="<?= ViewHelper::asset($task['pet_avatar']) ?>" alt="<?= ViewHelper::e($task['pet_name']) ?>" class="rounded-3 border flex-shrink-0 shadow-sm" style="width: 46px; height: 46px; object-fit: contain; background: #fff8e5;">

                            <!-- Title & Subtitle Info -->
                            <div class="min-w-0 flex-grow-1">
                                <div class="fw-bold <?= $task['is_completed'] ? 'text-decoration-line-through text-muted' : 'text-dark' ?> fs-6 mb-1 text-break">
                                    <?= ViewHelper::e($task['title']) ?>
                                </div>
                                <div class="small text-muted d-flex flex-wrap align-items-center gap-1">
                                    <span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($task['pet_name']) ?></span>
                                    <span class="text-muted">&bull;</span>
                                    <span class="text-nowrap"><i class="fa-regular fa-clock me-1 text-brand"></i><?= ViewHelper::e($task['time_due']) ?></span>
                                    <span class="badge bg-light text-secondary border text-uppercase font-monospace"><?= ViewHelper::e($task['frequency']) ?></span>
                                    <?php if (!empty($task['notes'])): ?>
                                        <span class="text-muted d-none d-sm-inline">&bull;</span>
                                        <span class="fst-italic text-truncate d-block d-sm-inline" style="max-width: 260px;" title="<?= ViewHelper::e($task['notes']) ?>">
                                            <?= ViewHelper::e($task['notes']) ?>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Right Section: Badges & Delete Action -->
                        <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-2 pt-2 pt-md-0 border-top border-md-0">
                            <span class="badge <?= $task['is_completed'] ? 'bg-success text-white' : 'bg-warning text-dark' ?> text-uppercase px-3 py-1 fw-bold rounded-pill">
                                <i class="fa-solid <?= $task['is_completed'] ? 'fa-circle-check' : 'fa-hourglass-half' ?> me-1"></i>
                                <?= $task['is_completed'] ? 'Completed' : 'Pending' ?>
                            </span>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 d-inline-flex align-items-center justify-content-center delete-task-btn" 
                                    style="width: 32px; height: 32px;"
                                    data-task-id="<?= $task['id'] ?>" 
                                    data-task-title="<?= ViewHelper::e($task['title']) ?>"
                                    title="Delete Routine">
                                <i class="fa-solid fa-trash-can" style="font-size: 13px;"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- 1. Luxury Custom Modal: New Care Routine -->
<div class="modal fade" id="newCareTaskModal" tabindex="-1" aria-labelledby="newCareTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 540px;">
        <div class="modal-content custom-modal-card">
            
            <!-- Custom Header -->
            <div class="modal-header custom-modal-header">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #fff2ee; color: #fa441d;">
                        <i class="fa-solid fa-calendar-plus fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark m-0" id="newCareTaskModalLabel">Add Care Routine</h5>
                        <small class="text-muted">Schedule daily reminders and habits for your companions.</small>
                    </div>
                </div>
                <button type="button" class="modal-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <!-- Custom Form Body -->
            <form action="<?= ViewHelper::url('portal/care/tasks/create') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body custom-modal-body">
                    
                    <!-- Companion Selector -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Select Companion <span class="text-danger">*</span></label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>">🐾 <?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?> - <?= ViewHelper::e($p['breed']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Routine Title -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Routine Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="careRoutineTitle" class="form-control rounded-3" required placeholder="e.g. Morning Kibble & Fresh Water, Dental Chew, Park Walk">
                    </div>

                    <!-- Category Quick Pills -->
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark mb-2">Category</label>
                        <div class="d-flex flex-wrap gap-2" id="routineTypePills">
                            <button type="button" class="routine-type-pill active" data-type="feeding" data-title-hint="Morning Feeding & Fresh Water">🥣 Feeding</button>
                            <button type="button" class="routine-type-pill" data-type="walking" data-title-hint="30-Min Exercise Walk">🐕 Walking</button>
                            <button type="button" class="routine-type-pill" data-type="medication" data-title-hint="Daily Rx Medication Dose">💊 Medication</button>
                            <button type="button" class="routine-type-pill" data-type="grooming" data-title-hint="Coat Brushing & Grooming">✂️ Grooming</button>
                            <button type="button" class="routine-type-pill" data-type="dental" data-title-hint="Dental Chew & Toothbrushing">🦷 Dental</button>
                            <button type="button" class="routine-type-pill" data-type="custom" data-title-hint="Custom Wellness Routine">✨ Custom</button>
                        </div>
                        <input type="hidden" name="task_type" id="selectedTaskType" value="feeding">
                    </div>

                    <!-- Schedule Details Row -->
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Time Due <span class="text-danger">*</span></label>
                            <input type="text" name="time_due" id="careTimeDue" class="form-control rounded-3" value="08:00 AM" required>
                            <!-- Quick Time Chips -->
                            <div class="d-flex gap-1 flex-wrap mt-1">
                                <button type="button" class="btn btn-sm btn-light border p-0 px-2 small quick-time-chip" data-time="07:30 AM" style="font-size: 10px;">7:30 AM</button>
                                <button type="button" class="btn btn-sm btn-light border p-0 px-2 small quick-time-chip" data-time="12:00 PM" style="font-size: 10px;">12:00 PM</button>
                                <button type="button" class="btn btn-sm btn-light border p-0 px-2 small quick-time-chip" data-time="05:30 PM" style="font-size: 10px;">5:30 PM</button>
                                <button type="button" class="btn btn-sm btn-light border p-0 px-2 small quick-time-chip" data-time="08:30 PM" style="font-size: 10px;">8:30 PM</button>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Frequency</label>
                            <select name="frequency" class="form-select rounded-3">
                                <option value="daily" selected>🔁 Daily</option>
                                <option value="weekly">📅 Weekly</option>
                                <option value="monthly">🗓️ Monthly</option>
                                <option value="once">🎯 Once</option>
                            </select>
                        </div>
                    </div>

                    <!-- Notes & Instructions -->
                    <div class="mb-2">
                        <label class="form-label small fw-bold text-dark">Notes / Instructions (Optional)</label>
                        <input type="text" name="notes" class="form-control rounded-3" placeholder="e.g. 1.5 cups kibble with omega-3 drops">
                    </div>
                </div>

                <!-- Custom Footer -->
                <div class="modal-footer custom-modal-footer">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4 fw-bold">
                        <i class="fa-solid fa-plus me-1"></i> Add Routine
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- 2. Luxury Custom Confirmation Modal: Delete Care Routine -->
<div class="modal fade" id="deleteCareTaskModal" tabindex="-1" aria-labelledby="deleteCareTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content custom-modal-card">
            
            <div class="modal-header custom-modal-header border-0 pb-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="rounded-circle p-2 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background: #fee2e2; color: #dc2626;">
                        <i class="fa-solid fa-trash-can fs-5"></i>
                    </div>
                    <div>
                        <h5 class="modal-title fw-bold text-dark m-0" id="deleteCareTaskModalLabel">Delete Routine</h5>
                        <small class="text-muted">Remove task from schedule</small>
                    </div>
                </div>
                <button type="button" class="modal-btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="modal-body custom-modal-body pt-3 pb-2 text-center">
                <p class="text-dark mb-2">Are you sure you want to remove this care routine?</p>
                <div class="p-3 bg-light rounded-3 border text-start mb-2">
                    <strong class="text-danger d-block fs-6" id="deleteTaskTitle">Routine Title</strong>
                    <small class="text-muted">This routine and its streak records will be permanently removed.</small>
                </div>
            </div>

            <form id="deleteTaskForm" method="POST" action="">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-footer custom-modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">
                        <i class="fa-solid fa-trash me-1"></i> Confirm Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Interaction Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Category Quick Pill Selection
    const typePills = document.querySelectorAll('.routine-type-pill');
    const selectedTaskType = document.getElementById('selectedTaskType');
    const titleInput = document.getElementById('careRoutineTitle');

    typePills.forEach(pill => {
        pill.addEventListener('click', function() {
            typePills.forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const type = this.getAttribute('data-type');
            const hint = this.getAttribute('data-title-hint');
            if (selectedTaskType) selectedTaskType.value = type;
            if (titleInput && (!titleInput.value || typePills.some(p => p.getAttribute('data-title-hint') === titleInput.value))) {
                titleInput.value = hint;
            }
        });
    });

    // 2. Quick Time Chips
    const timeChips = document.querySelectorAll('.quick-time-chip');
    const timeInput = document.getElementById('careTimeDue');
    timeChips.forEach(chip => {
        chip.addEventListener('click', function() {
            if (timeInput) timeInput.value = this.getAttribute('data-time');
        });
    });

    // 3. Delete Task Modal Binding (Zero raw alerts)
    const deleteBtns = document.querySelectorAll('.delete-task-btn');
    const deleteTaskModalEl = document.getElementById('deleteCareTaskModal');
    const deleteTaskForm = document.getElementById('deleteTaskForm');
    const deleteTaskTitle = document.getElementById('deleteTaskTitle');
    const bsDeleteModal = deleteTaskModalEl ? new bootstrap.Modal(deleteTaskModalEl) : null;

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const taskId = this.getAttribute('data-task-id');
            const taskTitle = this.getAttribute('data-task-title');
            if (deleteTaskTitle) deleteTaskTitle.innerText = taskTitle;
            if (deleteTaskForm) {
                deleteTaskForm.action = '<?= ViewHelper::url('portal/care/tasks/') ?>' + taskId + '/delete';
            }
            if (bsDeleteModal) bsDeleteModal.show();
        });
    });
});
</script>
