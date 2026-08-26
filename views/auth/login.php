<?php
use Helpers\ViewHelper;
?>
<form action="<?= ViewHelper::url('login') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>

    <div class="mb-3">
        <label class="form-label fw-semibold">Email Address</label>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control border-start-0" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="name@example.com">
        </div>
    </div>

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <label class="form-label fw-semibold m-0">Password</label>
            <a href="<?= ViewHelper::url('forgot-password') ?>" class="small text-brand text-decoration-none hover-underline">Forgot?</a>
        </div>
        <div class="input-group">
            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
            <input type="password" name="password" class="form-control border-start-0" required placeholder="••••••••">
        </div>
    </div>

    <div class="mb-4 form-check">
        <input type="checkbox" class="form-check-input" id="rememberMe">
        <label class="form-check-label small text-muted" for="rememberMe">Remember my device</label>
    </div>

    <button type="submit" class="btn btn-brand fw-bold py-3 mb-3">
        <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In to Account
    </button>

    <div class="p-3 bg-light rounded-3 small mb-3 border">
        <span class="fw-bold text-dark d-block mb-1"><i class="fa-solid fa-key text-warning me-1"></i> Quick Test Credentials:</span>
        <div class="text-muted"><strong>Admin:</strong> <code>admin@petguard.com</code> / <code>Password@123</code></div>
        <div class="text-muted"><strong>Pet Owner:</strong> <code>owner@petguard.com</code> / <code>Password@123</code></div>
        <div class="text-muted"><strong>Veterinarian:</strong> <code>vet@petguard.com</code> / <code>Password@123</code></div>
        <div class="text-muted"><strong>Shelter:</strong> <code>shelter@petguard.com</code> / <code>Password@123</code></div>
    </div>

    <div class="text-center small text-muted">
        New to PetGuard? Register as:
        <div class="d-flex justify-content-center gap-2 mt-2">
            <a href="<?= ViewHelper::url('register/owner') ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="fa-solid fa-paw me-1"></i> Owner</a>
            <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="fa-solid fa-user-doctor me-1"></i> Vet</a>
            <a href="<?= ViewHelper::url('register/shelter') ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3"><i class="fa-solid fa-house-medical me-1"></i> Shelter</a>
        </div>
    </div>
</form>
