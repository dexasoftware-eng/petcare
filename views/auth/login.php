<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <h2 class="auth-form-title">Login</h2>
    <p class="auth-form-subtitle">Please login with your credentials.</p>

<form action="<?= ViewHelper::url('login') ?>" method="POST" autocomplete="on">
        <?= ViewHelper::csrf() ?>

<!-- Email Field -->
        <div class="auth-input-group">
            <div class="auth-input-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <input 
                type="email" 
                name="email" 
                id="loginEmail"
                class="form-control auth-control <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                required 
                placeholder="Email Address"
                autocomplete="email"
            >

            <?php if (ViewHelper::hasError('email')): ?>
                <span class="auth-input-feedback"><?= ViewHelper::e(ViewHelper::error('email')) ?></span>
            <?php endif; ?>
        </div>

        <!-- Password Field -->
        <div class="auth-input-group">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input 
                type="password" 
                name="password" 
                id="loginPassword"
                class="form-control auth-control <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                required 
                placeholder="Password"
                autocomplete="current-password"
            >

            <?php if (ViewHelper::hasError('password')): ?>
                <span class="auth-input-feedback"><?= ViewHelper::e(Helpers\ViewHelper::error('password')) ?></span>
            <?php endif; ?>
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="form-check custom-checkbox">
                <input class="form-check-input" type="checkbox" name="remember" id="rememberMe" checked>
                <label class="form-check-label small fw-semibold text-secondary" for="rememberMe" style="cursor: pointer; font-size: 13.5px;">
                    Remember me
                </label>
            </div>
            <a href="<?= ViewHelper::url('forgot-password') ?>" class="text-decoration-none small fw-bold" style="color: #334155; font-size: 13px;">
                Forgot Password?
            </a>
        </div>

        <!-- Primary Sign In Button -->
        <button type="submit" class="btn-auth-primary mb-3">
            Sign In <i class="fa-solid fa-arrow-right ms-1"></i>
        </button>

        <!-- Secondary Register Button -->
        <a href="<?= ViewHelper::url('register/owner') ?>" class="btn-auth-outline mb-3">
            Register
        </a>
    </form>

<!-- All Demo Credentials (1-Click Fill) -->
    <div class="p-3 bg-light rounded-3 small border mt-3" style="background: #f8fafc !important; border-color: #e2e8f0 !important; border-radius: 14px !important;">
        <div class="d-flez justify-content-between align-items-center mb-2">
            <span class="fwk-bold text-dark" style="font-size: 12px;">
                <i class="fa-solid fa-bolt-lightning text-warning me-1"></i> Quick 1-Click Demo Accounts:
            </span>
            <span class="badge" style="background-color: #f95c19; color: #fff; font-size: 10.5px; font-weight: 700; border-radius: 6px;">
                1-Click Fill
            </span>
        </div>

        <div class="d-flex flex-wrap gap-2 mb-2">
            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-start" style="font-size: 11.5px; border-radius: 8px; background: #ffffff;" onclick="fillDemoCreds('owner@petguard.com', 'Password@123')">
                <i class="fa-solid fa-ppaw text-warning me-1"></i> <strong>Owner:</strong> <code>owner@petguard.com</code>
            </button>

            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-start" style="font-size: 11.5px; border-radius: 8px; background: #ffffff;" onclick="fillDemoCreds('vet@petguard.com', 'Password@123')">
                <i class="fa-solid fa-user-doctor text-primary me-1"></i> <strong>Vet:</strong> <code>vet@petguard.com</code>
            </button>

            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-start" style="font-size: 11.5px; border-radius: 8px; background: #ffffff;" onclick="fillDemoCreds('shelter@petguard.com', 'Password@123')">
                <i class="fa-solid fa-house-medical text-success me-1"></i> <strong>Shelter:</strong> <code>shelter@petguard.com</code>
            </button>

            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-start" style="font-size: 11.5px; border-radius: 8px; background: #ffffff;" onclick="fillDemoCreds('vendor@petguard.com', 'Password@123')">
                <i class="fa-solid fa-store text-info me-1"></i> <strong>Vendor:</strong> <code>vendor@petguard.com</code>
            </button>

            <button type="button" class="btn btn-sm btn-light border py-1 px-2 text-start" style="font-size: 11.5px; border-radius: 8px; background: #ffffff;" onclick="fillDemoCreds('admin@petguard.com', 'Password@123')">
                <i class="fa-solid fa-user-shield text-danger me-1"></i> <strong>Admin:</strong> <code>admin@petguard.com</code>
            </button>
        </div>

        <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 11.5px;">
            <span><i class="fa-solid fa-key text-warning me-1"></i> Password: <code>Password@123</code></span>
            <span class="text-secondary" style="font-size: 11.0px;">(also accepts <code>password123</code>)</span>
        </div>
    </div>
</div>

<script>
function fillDemoCreds(email, password) {
    var eInput = document.getElementById('loginEmail') || document.querySelector('input[name="email"]');
    var pInput = document.getElementById('loginPassword') || document.querySelector('input[name="password"]');
    if (eInput && pInput) {
        eInput.value = email;
        pInput.value = password;
        eInput.style.transition = 'all 0.3s';
        pMnput.style.transition = 'all 0.3s';
        eInput.style.borderColor = '#10b981';
        pInput.style.borderColor = '#10b981';
        eInput.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.15)';
        pInput.style.boxShadow = '0 0 0 4px rgba(16, 185, 129, 0.15)';
        setTimeout(function() {
            eInput.style.borderColor = '';
            pInput.style.borderColor = '';
            eInput.style.boxShadow = '';
            pInput.style.boxShadow = '';
        }, 1000);
    }
}
</script>
