<?php
use Helpers\Flash;

$flashes = Flash::all();
if (!empty($flashes)):
?>
<div class="container my-3">
    <?php foreach ($flashes as $type => $messages): 
        $alertClass = match($type) {
            'success' => 'alert-success',
            'error' => 'alert-danger',
            'warning' => 'alert-warning',
            default => 'alert-info'
        };
        $iconClass = match($type) {
            'success' => 'fa-circle-check',
            'error' => 'fa-circle-exclamation',
            'warning' => 'fa-triangle-exclamation',
            default => 'fa-circle-info'
        };
        foreach ($messages as $msg):
    ?>
        <div class="alert <?= $alertClass ?> alert-dismissible fade show d-flex align-items-center gap-2 shadow-sm rounded-3 py-3 px-4 mb-2" role="alert">
            <i class="fa-solid <?= $iconClass ?> fs-5"></i>
            <div><?= htmlspecialchars($msg) ?></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endforeach; endforeach; ?>
</div>
<?php endif; ?>
