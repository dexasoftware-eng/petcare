<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <h2 class="auth-form-title">Forgot Password</h2>
    <p class="auth-form-subtitle">Enter your registered email to receive a recovery link.</p>

    <form action="<?= ViewHelper::url('forgot-password') ?>" method="POST">
        <?= ViewHelper::csrf() ?>

        <div class="auth-input-group mb-4">
            <div class="auth-input-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <input type="email" name="email" class="form-control auth-control" required placeholder="Registered Email Address">
        </div>

        <button type="submit" class="btn-auth-primary mb-3">
            Send Reset Link <i class="fa-solid fa-paper-plane ms-1"></i>
        </button>

        <div class="text-center">
            <a href="<?= ViewHelper::url('login') ?>" class="text-decoration-none fw-semibold small text-muted">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Sign In
            </a>
        </div>
    </form>
</div>
