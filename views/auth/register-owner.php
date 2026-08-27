<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <!-- Role Switcher Pills -->
    <div class="role-pill-switch">
        <a href="<?= ViewHelper::url('register/owner') ?>" class="role-pill-btn active">
            <i class="fa-solid fa-paw"></i> Pet Owner
        </a>
        <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="role-pill-btn">
            <i class="fa-solid fa-user-doctor"></i> Veterinarian
        </a>
        <a href="<?= ViewHelper::url('register/shelter') ?>" class="role-pill-btn">
            <i class="fa-solid fa-house-medical"></i> Rescue Shelter
        </a>
        <a href="<?= ViewHelper::url('register/vendor') ?>" class="role-pill-btn">
            <i class="fa-solid fa-store"></i> Store Vendor
        </a>
    </div>

<h2 class="auth-form-title">Register as Pet Owner</h2>
    <p class="auth-form-subtitle">Join PetGuard to manage your furry family members.</p>

<form action="<?= ViewHelper::url('register/owner') ?>" method="POST">
        <?= ViewHelper::csrf() ?>

<div class="auth-input-group mb-2">
            <div class="auth-input-icon">
                <i class="fa-regular fa-user"></i>
            </div>
            <input type="text" name="name" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('name')) ?>" required placeholder="Full Name">
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <input type="email" name="email" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="Email Address">
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <input type="tel" name="phone" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" required placeholder="Phone Number">
                </div>
            </div>
        </div>

<div class="auth-input-group mb-2">
            <div class="auth-input-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <input type="text" name="address" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" required placeholder="Your Home Address">
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="password" class="form-control auth-control" required placeholder="Password">
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                    <input type="password" name="confirm_password" class="form-control auth-control" required placeholder="Confirm Password">
                </div>
            </div>
        </div>

        <div class="text-start small text-muted mb-3" style="font-size: 13.5px;">
            Already have an account? <a href="<?= ViewHelper::url('login') ?>" class="fwk-bold text-decoration-none" style="color: #fa441d;">Login</a>
        </div>

        <button type="submit" class="btn-auth-primary">
            Create Owner Account <i class="fa-solid fa-paw ms-1"></i>
        </button>
    </form>
</div>