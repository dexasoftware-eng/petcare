<?php
use Helpers\ViewHelper;
?>
<form action="<?= ViewHelper::url('reset-password') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>
    <input type="hidden" name="token" value="<?= ViewHelper::e($token ?? '') ?>">

    <div class="mb-3">
        <label class="form-label fw-semibold">New Password *</label>
        <input type="password" name="password" class="form-control" required placeholder="••••••••">
    </div>

    <div class="mb-4">
        <label class="form-label fw-semibold">Confirm New Password *</label>
        <input type="password" name="confirm_password" class="form-control" required placeholder="••••••••">
    </div>

    <button type="submit" class="btn btn-brand fw-bold py-3 mb-3">
        <i class="fa-solid fa-check me-2"></i> Update Password
    </button>

    <div class="text-center small text-muted">
        <a href="<?= ViewHelper::url('login') ?>" class="text-brand fw-bold text-decoration-none">Back to Sign In</a>
    </div>
</form>
