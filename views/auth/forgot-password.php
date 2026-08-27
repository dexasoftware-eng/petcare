<?php
use Helpers\ViewHelper;
?>

<div class="auth-form-header text-center">
    <div class="d-inline-flex align-items-center justify-content-center bg-light text-brand rounded-circle mb-3" style="width: 64px; height: 64px; font-size: 24px; border: 2px dashed rgba(250, 68, 29, 0.3);">
        <i class="fa-solid fa-key"></i>
    </div>
    <h2 class="auth-title">Forgot Password?</h2>
    <p class="auth-subtitle">No worries! Enter your registered account email and we'll generate a secure password reset authorization token.</p>
</div>

<form action="<?= ViewHelper::url('forgot-password') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Email Address -->
    <div class="form-group-custom mb-4">
        <label for="resetEmail" class="form-label-custom">
            Registered Email Address <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon-left"></i>
            <input 
                type="email" 
                name="email" 
                id="resetEmail" 
                class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                placeholder="name@example.com" 
                required 
                autocomplete="email"
                autofocus
            >
        </div>
        <?php if (ViewHelper::hasError('email')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('email')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-primary mb-3">
        <i class="fa-solid fa-paper-plane"></i>
        <span>Send Reset Instructions</span>
    </button>

    <div class="auth-card-footer text-center">
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Sign In</span>
        </a>
    </div>
</form>
