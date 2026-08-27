<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <h2 class="auth-form-title">Reset Password</h2>
    <p class="auth-form-subtitle">Create a secure new password for your account.</p>

    <form action="<?= ViewHelper::url('reset-password') ?>" method="POST">
        <?= ViewHelper::csrf() ?>
        <input type="hidden" name="token" value="<?= ViewHelper::e($token ?? '') ?>">

        <div class="auth-input-group mb-3">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="password" name="password" class="form-control auth-control" required placeholder="New Password (min. 6 chars)">
        </div>

        <div class="auth-input-group mb-4">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="password" name="confirm_password" class="form-control auth-control" required placeholder="Confirm New Password">
        </div>

        <button type="submit" class="btn-auth-primary mb-3">
            Update Password <i class="fa-solid fa-check ms-1"></i>
        </button>

        <div class="text-center">
            <a href="<?= ViewHelper::url('login') ?>" class="text-decoration-none fw-semibold small text-muted">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</div>
