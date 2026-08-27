<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-bell text-warning"></i>
            <span>Real-Time Alert Feed</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">Direct Updates</span>
        </div>
        <h2 class="portal-hero-title">Notification Center 🔔</h2>
        <p class="portal-hero-subtitle">Platform broadcasts, vaccination alerts, appointment updates, and clinical notices.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <form action="<?= ViewHelper::url('portal/notifications/read-all') ?>" method="POST" class="m-0">
            <?= ViewHelper::csrfField() ?>
            <button type="submit" class="btn btn-admin-secondary">
                <i class="fa-solid fa-check-double"></i>
                <span>Mark All as Read</span>
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
