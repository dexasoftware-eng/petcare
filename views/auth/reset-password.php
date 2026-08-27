<?php
use Helpers\ViewHelper;
?>

<div class="auth-form-header text-center">
    <div class="d-inline-flex align-items-center justify-content-center bg-light text-brand rounded-circle mb-3" style="width: 64px; height: 64px; font-size: 24px; border: 2px dashed rgba(250, 68, 29, 0.3);">
        <i class="fa-solid fa-lock-open"></i>
    </div>
    <h2 class="auth-title">Set New Password</h2>
    <p class="auth-subtitle">Please enter and confirm your new secure password below.</p>
</div>

<form action="<?= ViewHelper::url('reset-password') ?>" method="POST" autocomplete="off">
    <?= ViewHelper::csrfField() ?>
    <input type="hidden" name="token" value="<?= ViewHelper::e($token ?? '') ?>">

    <!-- New Password -->
    <div class="form-group-custom">
        <label for="newPassword" class="form-label-custom">
            New Password <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-lock input-icon-left"></i>
            <input 
                type="password" 
                name="password" 
                id="newPassword" 
                class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                placeholder="At least 6 characters" 
                required 
                autocomplete="new-password"
                autofocus
            >
            <button type="button" class="password-toggle-btn" data-target="newPassword" title="Toggle password visibility">
                <i class="fa-regular fa-eye"></i>
            </button>
        </div>
        <?php if (ViewHelper::hasError('password')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('password')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Confirm New Password -->
    <div class="form-group-custom mb-4">
        <label for="confirmNewPassword" class="form-label-custom">
            Confirm New Password <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-shield-halved input-icon-left"></i>
            <input 
                type="password" 
                name="confirm_password" 
                id="confirmNewPassword" 
                class="input-custom has-toggle <?= ViewHelper::hasError('confirm_password') ? 'is-invalid' : '' ?>" 
                placeholder="Repeat new password" 
                required 
                autocomplete="new-password"
            >
            <button type="button" class="password-toggle-btn" data-target="confirmNewPassword" title="Toggle password visibility">
                <i class="fa-regular fa-eye"></i>
            </button>
        </div>
        <?php if (ViewHelper::hasError('confirm_password')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('confirm_password')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-primary mb-3">
        <i class="fa-solid fa-circle-check"></i>
        <span>Save New Password</span>
    </button>

    <div class="auth-card-footer text-center">
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link d-inline-flex align-items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Sign In</span>
        </a>
    </div>
</form>
