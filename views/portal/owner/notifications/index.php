<?php
use Helpers\ViewHelper;
?>

<!-- Page Header -->
<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Notification Center</h2>
        <p class="admin-page-subtitle">Platform broadcasts, vaccination alerts, appointment updates, and clinical notices.</p>
    </div>
    <div>
        <form action="<?= ViewHelper::url('portal/notifications/read-all') ?>" method="POST" class="m-0">
            <?= ViewHelper::csrfField() ?>
            <button type="submit" class="btn btn-sm btn-outline-secondary rounded-pill px-4 fw-semibold">
                <i class="fa-solid fa-check-double me-1"></i> Mark All as Read
            </button>
        </form>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body p-4">
        <?php if (empty($notifications)): ?>
            <div class="text-center py-5 text-muted">
                <i class="fa-regular fa-bell-slash fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold">No notifications right now</h5>
                <p class="small m-0">You're all caught up with your pet reminders and clinic notices.</p>
            </div>
        <?php else: ?>
            <div class="d-flex flex-column gap-3">
                <?php foreach ($notifications as $n): ?>
                    <div class="p-3 rounded-3 border d-flex gap-3 align-items-start <?= empty($n['is_read']) ? 'bg-light border-primary' : 'bg-white' ?>">
                        <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-brand" style="width: 44px; height: 44px; min-width: 44px;">
                            <i class="fa-solid fa-bell"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start">
                                <h6 class="fw-bold text-dark m-0"><?= ViewHelper::e($n['title']) ?></h6>
                                <small class="text-muted"><?= date('M d, Y H:i', strtotime($n['created_at'])) ?></small>
                            </div>
                            <p class="small text-muted m-0 mt-1"><?= ViewHelper::e($n['message']) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
