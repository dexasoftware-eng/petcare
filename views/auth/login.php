<?php
use Helpers\ViewHelper;
?>

<div class="auth-form-header">
    <h2 class="auth-title">Welcome Back</h2>
    <p class="auth-subtitle">Sign in to manage your pets, clinic schedule, or animal shelter portal.</p>
</div>

<!-- 1-Click Demo Accounts -->
<div class="quick-creds-box">
    <div class="quick-creds-header">
        <span class="quick-creds-title">
            <i class="fa-solid fa-bolt-lightning text-warning"></i>
            Quick-Test Credentials
        </span>
        <span class="quick-creds-badge">1-Click Fill</span>
    </div>
    <div class="quick-creds-grid" style="grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));">
        <button type="button" class="quick-cred-btn" onclick="fillDemoCreds('admin@petguard.com', 'password123')">
            <i class="fa-solid fa-user-shield"></i>
            <div>
                <strong class="d-block">Administrator</strong>
                <small class="text-muted">admin@petguard.com</small>
            </div>
        </button>
        <button type="button" class="quick-cred-btn" onclick="fillDemoCreds('owner@petguard.com', 'password123')">
            <i class="fa-solid fa-paw"></i>
            <div>
                <strong class="d-block">Pet Owner</strong>
                <small class="text-muted">owner@petguard.com</small>
            </div>
        </button>
        <button type="button" class="quick-cred-btn" onclick="fillDemoCreds('vet@petguard.com', 'password123')">
            <i class="fa-solid fa-user-doctor"></i>
            <div>
                <strong class="d-block">Veterinarian</strong>
                <small class="text-muted">vet@petguard.com</small>
            </div>
        </button>
        <button type="button" class="quick-cred-btn" onclick="fillDemoCreds('shelter@petguard.com', 'password123')">
            <i class="fa-solid fa-house-medical"></i>
            <div>
                <strong class="d-block">Rescue Shelter</strong>
                <small class="text-muted">shelter@petguard.com</small>
            </div>
        </button>
        <button type="button" class="quick-cred-btn" onclick="fillDemoCreds('vendor@petguard.com', 'password123')">
            <i class="fa-solid fa-store"></i>
            <div>
                <strong class="d-block">Store Vendor</strong>
                <small class="text-muted">vendor@petguard.com</small>
            </div>
        </button>
    </div>
</div>

<form action="<?= ViewHelper::url('login') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Email Address -->
    <div class="form-group-custom">
        <label for="loginEmail" class="form-label-custom">
            Email Address <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon-left"></i>
            <input 
                type="email" 
                name="email" 
                id="loginEmail" 
                class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                placeholder="name@example.com" 
                required 
                autocomplete="email"
            >
        </div>
        <?php if (ViewHelper::hasError('email')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('email')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Password -->
    <div class="form-group-custom">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label for="loginPassword" class="form-label-custom m-0">
                Password <span class="required-star">*</span>
            </label>
            <a href="<?= ViewHelper::url('forgot-password') ?>" class="auth-link small">
                Forgot password?
            </a>
        </div>
        <div class="input-wrapper">
            <i class="fa-solid fa-lock input-icon-left"></i>
            <input 
                type="password" 
                name="password" 
                id="loginPassword" 
                class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                placeholder="Enter your password" 
                required 
                autocomplete="current-password"
            >
            <button type="button" class="password-toggle-btn" data-target="loginPassword" title="Toggle password visibility">
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

    <!-- Remember device -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check-custom">
            <input type="checkbox" id="rememberDevice" name="remember" value="1">
            <label for="rememberDevice">Remember this device for 30 days</label>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-primary">
        <span>Sign In to Account</span>
        <i class="fa-solid fa-arrow-right"></i>
    </button>

    <div class="auth-divider">
        <span>New to PetGuard?</span>
    </div>

    <div class="auth-card-footer m-0 text-center">
        <p class="text-muted small mb-2">Select your account type to register:</p>
        <div class="d-flex justify-content-center flex-wrap gap-2">
            <a href="<?= ViewHelper::url('register/owner') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-semibold text-dark">
                <i class="fa-solid fa-paw text-brand me-1"></i> Pet Owner
            </a>
            <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-semibold text-dark">
                <i class="fa-solid fa-user-doctor text-brand me-1"></i> Veterinarian
            </a>
            <a href="<?= ViewHelper::url('register/shelter') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-semibold text-dark">
                <i class="fa-solid fa-house-medical text-brand me-1"></i> Rescue Shelter
            </a>
        </div>
    </div>
</form>
