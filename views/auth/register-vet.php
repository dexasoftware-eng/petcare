<?php
use Helpers\ViewHelper;
?>

<div class="w-100">
    <!-- Role Switcher Pills -->
    <div class="role-pill-switch">
        <a href="<?= ViewHelper::url('register/owner') ?>" class="role-pill-btn">
            <i class="fa-solid fa-paw"></i> Pet Owner
        </a>
        <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="role-pill-btn active">
            <i class="fa-solid fa-user-doctor"></i> Veterinarian
        </a>
        <a href="<?= ViewHelper::url('register/shelter') ?>" class="role-pill-btn">
            <i class="fa-solid fa-house-medical"></i> Rescue Shelter
        </a>
    </div>

    <h2 class="auth-form-title">Doctor Registration</h2>
    <p class="auth-form-subtitle">Join PetGuard clinical network and consult patients.</p>

    <form action="<?= ViewHelper::url('register/veterinarian') ?>" method="POST">
        <?= ViewHelper::csrf() ?>

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <input type="text" name="first_name" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('first_name')) ?>" required placeholder="Dr. First Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <input type="text" name="last_name" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('last_name')) ?>" required placeholder="Last Name">
                </div>
            </div>
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                    <input type="email" name="email" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="Doctor Email">
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <input type="tel" name="phone" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" required placeholder="Clinic Contact">
                </div>
            </div>
        </div>

        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-hospital"></i>
                    </div>
                    <input type="text" name="clinic_name" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('clinic_name')) ?>" required placeholder="Primary Clinic Name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-stethoscope"></i>
                    </div>
                    <input type="text" name="specialization" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('specialization')) ?>" placeholder="Specialization (e.g. Surgery)">
                </div>
            </div>
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
            Already have an account? <a href="<?= ViewHelper::url('login') ?>" class="fw-bold text-decoration-none" style="color: #fa441d;">Login</a>
        </div>

        <button type="submit" class="btn-auth-primary">
            Register as Doctor <i class="fa-solid fa-user-doctor ms-1"></i>
        </button>
    </form>
</div>
