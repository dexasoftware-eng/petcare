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

<div class="vet-availability-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-clock text-warning"></i> Operating Hours &amp; Practice Availability
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Weekly Availability &amp; Booking Slots
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Configure your weekly telemedicine video consultation hours, physical clinic slots, and buffer intervals to prevent booking conflicts.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>View Scheduled Queue</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Weekly Operating Schedule Card -->
    <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden mb-4">
        <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                    <i class="fa-solid fa-calendar-week text-brand me-2"></i> Weekly Practice Operating Schedule
                </h4>
                <p class="text-muted small m-0 mt-1">Available time windows are automatically synchronized with the public booking calendar.</p>
            </div>
            <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">Auto-Sync</span>
        </div>

        <div class="admin-card-body p-4 p-md-5">
            <form id="vetAvailabilityForm" action="<?= ViewHelper::url('vet/availability') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>

                <div class="d-flex flex-column gap-3 mb-4">
                    <?php foreach ($days as $key => $label): 
                        $dayData = $schedMap[$key] ?? [
                            'is_available' => in_array($key, ['saturday', 'sunday']) ? 0 : 1,
                            'start_time' => '09:00:00',
                            'end_time' => '17:00:00',
                            'slot_duration_minutes' => 30
                        ];
                        $startFormatted = substr($dayData['start_time'], 0, 5);
                        $endFormatted = substr($dayData['end_time'], 0, 5);
                        $isAvail = !empty($dayData['is_available']);
                    ?>
                        <div class="p-3 px-4 rounded-4 border <?= $isAvail ? 'bg-light border-primary border-opacity-25' : 'bg-white' ?> d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                            <!-- Day Toggle -->
                            <div style="min-width: 160px;">
                                <div class="form-check form-switch m-0">
                                    <input class="form-check-input" type="checkbox" name="avail_<?= $key ?>" id="check_<?= $key ?>" value="1" <?= $isAvail ? 'checked' : '' ?>>
                                    <label class="form-check-label fw-bold text-dark fs-6" for="check_<?= $key ?>">
                                        <?= $label ?>
                                    </label>
                                </div>
                            </div>

                            <!-- Time Pickers -->
                            <div class="d-flex flex-wrap align-items-center gap-3 flex-grow-1 justify-content-md-end">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="small text-muted fw-bold">From:</span>
                                    <input type="time" name="start_<?= $key ?>" class="form-control rounded-3 py-1 bg-white text-center font-monospace" style="width: 120px;" value="<?= $startFormatted ?>">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="small text-muted fw-bold">To:</span>
                                    <input type="time" name="end_<?= $key ?>" class="form-control rounded-3 py-1 bg-white text-center font-monospace" style="width: 120px;" value="<?= $endFormatted ?>">
                                </div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="small text-muted fw-bold">Slot Duration:</span>
                                    <select name="duration_<?= $key ?>" class="form-select rounded-3 py-1 bg-white" style="width: 150px;">
                                        <option value="15" <?= $dayData['slot_duration_minutes'] == 15 ? 'selected' : '' ?>>15 Minutes</option>
                                        <option value="20" <?= $dayData['slot_duration_minutes'] == 20 ? 'selected' : '' ?>>20 Minutes</option>
                                        <option value="30" <?= $dayData['slot_duration_minutes'] == 30 ? 'selected' : '' ?>>30 Mins (Std)</option>
                                        <option value="45" <?= $dayData['slot_duration_minutes'] == 45 ? 'selected' : '' ?>>45 Minutes</option>
                                        <option value="60" <?= $dayData['slot_duration_minutes'] == 60 ? 'selected' : '' ?>>60 Minutes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-check"></i>
                        <span>Save Practice Availability</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vetAvailabilityForm', {
        loadingText: 'Saving Practice Schedule...',
        onSuccess: (data) => {
            PetGuardToast.success(data.message || 'Weekly availability saved.');
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to save schedule.');
        }
    });
});
</script>
