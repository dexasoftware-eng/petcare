<?php
use Helpers\ViewHelper;

$days = [
    'monday' => 'Monday',
    'tuesday' => 'Tuesday',
    'wednesday' => 'Wednesday',
    'thursday' => 'Thursday',
    'friday' => 'Friday',
    'saturday' => 'Saturday',
    'sunday' => 'Sunday'
];

$schedMap = [];
foreach ($schedule ?? [] as $s) {
    $schedMap[$s['day_of_week']] = $s;
}
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-calendar-check text-brand me-2"></i> Weekly Practice Hours & Availability</h2>
        <p class="admin-page-subtitle">Configure slot intervals and operating hours to prevent double bookings.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-clock text-brand me-2"></i> Weekly Operating Schedule</h3>
    </div>
    <div class="admin-card-body">
        <form id="vetAvailabilityForm" action="<?= ViewHelper::url('vet/availability') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>

            <div class="list-group list-group-flush mb-4">
                <?php foreach ($days as $key => $label): 
                    $dayData = $schedMap[$key] ?? [
                        'is_available' => in_array($key, ['saturday', 'sunday']) ? 0 : 1,
                        'start_time' => '09:00:00',
                        'end_time' => '17:00:00',
                        'slot_duration_minutes' => 30
                    ];
                    $startFormatted = substr($dayData['start_time'], 0, 5);
                    $endFormatted = substr($dayData['end_time'], 0, 5);
                ?>
                    <div class="list-group-item py-3">
                        <div class="row align-items-center g-3">
                            <div class="col-md-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="avail_<?= $key ?>" id="check_<?= $key ?>" value="1" <?= !empty($dayData['is_available']) ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark" for="check_<?= $key ?>">
                                        <?= $label ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="small text-muted d-block">Start Time</label>
                                <input type="time" name="start_<?= $key ?>" class="form-control form-control-sm" value="<?= $startFormatted ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="small text-muted d-block">End Time</label>
                                <input type="time" name="end_<?= $key ?>" class="form-control form-control-sm" value="<?= $endFormatted ?>">
                            </div>
                            <div class="col-md-3">
                                <label class="small text-muted d-block">Slot Duration</label>
                                <select name="duration_<?= $key ?>" class="form-select form-select-sm">
                                    <option value="15" <?= $dayData['slot_duration_minutes'] == 15 ? 'selected' : '' ?>>15 Minutes</option>
                                    <option value="20" <?= $dayData['slot_duration_minutes'] == 20 ? 'selected' : '' ?>>20 Minutes</option>
                                    <option value="30" <?= $dayData['slot_duration_minutes'] == 30 ? 'selected' : '' ?>>30 Minutes (Standard)</option>
                                    <option value="45" <?= $dayData['slot_duration_minutes'] == 45 ? 'selected' : '' ?>>45 Minutes</option>
                                    <option value="60" <?= $dayData['slot_duration_minutes'] == 60 ? 'selected' : '' ?>>60 Minutes</option>
                                </select>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                    <i class="fa-solid fa-check me-1"></i> Save Schedule
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vetAvailabilityForm', {
        loadingText: 'Saving Schedule...',
        reload: true
    });
});
</script>
