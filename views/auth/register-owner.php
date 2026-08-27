<?php
use Helpers\ViewHelper;
?>

<!-- Role Switcher Tabs -->
<div class="auth-role-tabs">
    <a href="<?= ViewHelper::url('register/owner') ?>" class="auth-role-tab active">
        <i class="fa-solid fa-paw"></i>
        <span>Pet Owner</span>
    </a>
    <a href="<?= ViewHelper::url('register/veterinarian') ?>" class="auth-role-tab">
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
    <h2 class="auth-title">Join as a Pet Parent</h2>
    <p class="auth-subtitle">Create a centralized profile for your pets, manage wellness records, and connect with certified vets.</p>
</div>

<form action="<?= ViewHelper::url('register/owner') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Full Name -->
    <div class="form-group-custom">
        <label for="ownerName" class="form-label-custom">
            Full Name <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-user input-icon-left"></i>
            <input 
                type="text" 
                name="name" 
                id="ownerName" 
                class="input-custom <?= ViewHelper::hasError('name') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('name')) ?>" 
                placeholder="e.g. Alex Morgan" 
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

    <!-- Email Address -->
    <div class="form-group-custom">
        <label for="ownerEmail" class="form-label-custom">
            Email Address <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon-left"></i>
            <input 
                type="email" 
                name="email" 
                id="ownerEmail" 
                class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                placeholder="alex@example.com" 
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

    <!-- Phone & Address Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-6">
            <label for="ownerPhone" class="form-label-custom">
                Phone Number <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-phone input-icon-left"></i>
                <input 
                    type="tel" 
                    name="phone" 
                    id="ownerPhone" 
                    class="input-custom <?= ViewHelper::hasError('phone') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" 
                    placeholder="+1 (555) 012-3456" 
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
        
        <div class="col-sm-6">
            <label for="ownerAddress" class="form-label-custom">
                Home Address <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-location-dot input-icon-left"></i>
                <input 
                    type="text" 
                    name="address" 
                    id="ownerAddress" 
                    class="input-custom <?= ViewHelper::hasError('address') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" 
                    placeholder="88 Magnolia Court, NY" 
                    required 
                    autocomplete="street-address"
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
            <label for="ownerPassword" class="form-label-custom">
                Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock input-icon-left"></i>
                <input 
                    type="password" 
                    name="password" 
                    id="ownerPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                    placeholder="At least 6 chars" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="ownerPassword" title="Toggle password visibility">
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
            <label for="ownerConfirmPassword" class="form-label-custom">
                Confirm Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-shield-halved input-icon-left"></i>
                <input 
                    type="password" 
                    name="confirm_password" 
                    id="ownerConfirmPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('confirm_password') ? 'is-invalid' : '' ?>" 
                    placeholder="Repeat password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="ownerConfirmPassword" title="Toggle password visibility">
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
        <i class="fa-solid fa-paw"></i>
        <span>Create Pet Owner Account</span>
    </button>

    <div class="auth-card-footer">
        Already have a PetGuard account? 
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link">Sign In Here</a>
    </div>
</form>
