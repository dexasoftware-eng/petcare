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
    </div>

    <h2 class="auth-form-title">Registration</h2>
    <p class="auth-form-subtitle">Please fill up the form to get started as a Pet Parent.</p>

    <form action="<?= ViewHelper::url('register/owner') ?>" method="POST">
        <?= ViewHelper::csrf() ?>

        <!-- Name 2 Columns (First Name, Last Name) -->
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <input type="text" name="first_name" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('first_name')) ?>" required placeholder="First Name">
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

        <!-- Contact 2 Columns (Email Address, Phone Number) -->
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
                    <input type="tel" name="phone" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" placeholder="Phone Number">
                </div>
            </div>
        </div>

        <!-- Location 2 Columns (Country, State/City) -->
        <div class="row g-2 mb-2">
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-globe"></i>
                    </div>
                    <select name="country" class="form-select auth-select">
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Canada">Canada</option>
                        <option value="Australia">Australia</option>
                        <option value="Pakistan">Pakistan</option>
                        <option value="India">India</option>
                        <option value="Germany">Germany</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="auth-input-group">
                    <div class="auth-input-icon">
                        <i class="fa-solid fa-location-dot"></i>
                    </div>
                    <input type="text" name="address" class="form-control auth-control" value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" placeholder="City / State">
                </div>
            </div>
        </div>

        <!-- Password -->
        <div class="auth-input-group mb-2">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="password" name="password" class="form-control auth-control" required placeholder="Password">
        </div>

        <!-- Confirm Password -->
        <div class="auth-input-group mb-3">
            <div class="auth-input-icon">
                <i class="fa-solid fa-lock"></i>
            </div>
            <input type="password" name="confirm_password" class="form-control auth-control" required placeholder="Confirm Password">
        </div>

        <!-- Already have an account? Login -->
        <div class="text-start small text-muted mb-3" style="font-size: 13.5px;">
            Already have an account? <a href="<?= ViewHelper::url('login') ?>" class="fw-bold text-decoration-none" style="color: #fa441d;">Login</a>
        </div>

        <!-- Register Button -->
        <button type="submit" class="btn-auth-primary">
            Register <i class="fa-solid fa-paw ms-1"></i>
        </button>
    </form>
</div>
