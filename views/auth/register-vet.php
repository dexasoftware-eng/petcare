<?php
use Helpers\ViewHelper;
?>

<!-- Role Switcher Tabs -->
<div class="auth-role-tabs">
    <a href="<?= ViewHelper::url('register/owner') ?>" class="auth-role-tab">
        <i class="fa-solid fa-paw"></i>
        <span>Pet Owner</span>
    </a>
    <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="auth-role-tab active">
        <i class="fa-solid fa-user-doctor"></i>
        <span>Veterinarian</span>
    </a>
    <a href="<?= ViewHelper::url('register/shelter') ?>" class="auth-role-tab">
        <i class="fa-solid fa-house-medical"></i>
        <span>Rescue Shelter</span>
    </a>
    <a href="<?= ViewHelper::url('register/vendor') ?>" class="auth-role-tab">
        <i class="fa-solid fa-store"></i>
        <span>Vendor</span>
    </a>
</div>

<div class="auth-form-header">
    <h2 class="auth-title">Register Clinical Practice</h2>
    <p class="auth-subtitle">Join the accredited Pet Guard veterinary network to receive patient bookings and maintain electronic medical records.</p>
</div>

<form action="<?= ViewHelper::url('register/veterinarian') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Full Name -->
    <div class="form-group-custom">
        <label for="vetName" class="form-label-custom">
            Doctor Full Name (with Title) <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-user-doctor input-icon-left"></i>
            <input 
                type="text" 
                name="name" 
                id="vetName" 
                class="input-custom <?= ViewHelper::hasError('name') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('name')) ?>" 
                placeholder="e.g. Dr. Sarah Jenkins, DVM" 
                required 
                autocomplete="name"
            >
        </div>
        <?php if (ViewHelper::hasError('name')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('name')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Email & Phone Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-6">
            <label for="vetEmail" class="form-label-custom">
                Professional Email <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-envelope input-icon-left"></i>
                <input 
                    type="email" 
                    name="email" 
                    id="vetEmail" 
                    class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                    placeholder="dr.jenkins@clinic.com" 
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

        <div class="col-sm-6">
            <label for="vetPhone" class="form-label-custom">
                Direct Phone <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-phone input-icon-left"></i>
                <input 
                    type="tel" 
                    name="phone" 
                    id="vetPhone" 
                    class="input-custom <?= ViewHelper::hasError('phone') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" 
                    placeholder="+1 (555) 019-2834" 
                    required 
                    autocomplete="tel"
                >
            </div>
            <?php if (ViewHelper::hasError('phone')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('phone')) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Specialization & Experience Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-8">
            <label for="vetSpec" class="form-label-custom">
                Specialization / Field <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-stethoscope input-icon-left"></i>
                <input 
                    type="text" 
                    name="specialization" 
                    id="vetSpec" 
                    class="input-custom <?= ViewHelper::hasError('specialization') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('specialization')) ?>" 
                    placeholder="e.g. Canine Surgery & Preventive Medicine" 
                    required
                >
            </div>
            <?php if (ViewHelper::hasError('specialization')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('specialization')) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-sm-4">
            <label for="vetExp" class="form-label-custom">
                Experience (Yrs) <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-award input-icon-left"></i>
                <input 
                    type="number" 
                    name="experience" 
                    id="vetExp" 
                    class="input-custom <?= ViewHelper::hasError('experience') ? 'is-invalid' : '' ?>" 
                    min="0" 
                    value="<?= ViewHelper::e(ViewHelper::old('experience', '5')) ?>" 
                    required
                >
            </div>
            <?php if (ViewHelper::hasError('experience')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('experience')) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Clinic Name & Address Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-6">
            <label for="vetClinic" class="form-label-custom">
                Primary Clinic Name <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-hospital input-icon-left"></i>
                <input 
                    type="text" 
                    name="clinic_name" 
                    id="vetClinic" 
                    class="input-custom <?= ViewHelper::hasError('clinic_name') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('clinic_name')) ?>" 
                    placeholder="PetGuard Central Pet Hospital" 
                    required
                >
            </div>
            <?php if (ViewHelper::hasError('clinic_name')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('clinic_name')) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-sm-6">
            <label for="vetAddress" class="form-label-custom">
                Clinic Address <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-location-dot input-icon-left"></i>
                <input 
                    type="text" 
                    name="address" 
                    id="vetAddress" 
                    class="input-custom <?= ViewHelper::hasError('address') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" 
                    placeholder="742 Evergreen Terrace, Suite 100" 
                    required
                >
            </div>
            <?php if (ViewHelper::hasError('address')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('address')) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Password & Confirm Password Row -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6">
            <label for="vetPassword" class="form-label-custom">
                Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock input-icon-left"></i>
                <input 
                    type="password" 
                    name="password" 
                    id="vetPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                    placeholder="At least 6 chars" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="vetPassword" title="Toggle password visibility">
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

        <div class="col-sm-6">
            <label for="vetConfirmPassword" class="form-label-custom">
                Confirm Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-shield-halved input-icon-left"></i>
                <input 
                    type="password" 
                    name="confirm_password" 
                    id="vetConfirmPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('confirm_password') ? 'is-invalid' : '' ?>" 
                    placeholder="Repeat password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="vetConfirmPassword" title="Toggle password visibility">
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
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-primary">
        <i class="fa-solid fa-user-doctor"></i>
        <span>Register Clinical Practice</span>
    </button>

    <div class="auth-card-footer">
        Already registered with PetGuard? 
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link">Sign In Here</a>
    </div>
</form>
