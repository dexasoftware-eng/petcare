<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <h2 class="auth-form-title">Login</h2>
    <p class="auth-form-subtitle">Please login with your credentials.</p>

    <form action="<?= ViewHelper::url('login') ?>" method="POST">
        <?= ViewHelper::csrf() ?>

        <!-- Email Field -->
        <div class="auth-input-group">
            <div class="auth-input-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <input type="email" name="email" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="Email Address">
        </div>

        <!-- Password Field -->
        <div class="auth-input-group">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="password" name="password" class="form-control auth-control" required placeholder="Password">
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
        <a href="<?= ViewHelper::url('register/owner') ?>" class="btn-auth-outline mb-4">
            Register
        </a>
    </form>

    <!-- Quick Test Credentials Box -->
    <div class="p-3 bg-light rounded-3 small border mt-2">
        <span class="fw-bold text-dark d-block mb-1"><i class="fa-solid fa-key text-warning me-1"></i> Quick Test Credentials:</span>
        <div class="d-flex flex-wrap gap-2 text-muted" style="font-size: 12px;">
            <span><strong>Admin:</strong> <code>admin@petguard.com</code></span> |
            <span><strong>Owner:</strong> <code>owner@petguard.com</code></span> |
            <span><strong>Vet:</strong> <code>vet@petguard.com</code></span>
        </div>
        <div class="text-muted small mt-1" style="font-size: 11px;">Password: <code>Password@123</code></div>
    </div>
</div>
