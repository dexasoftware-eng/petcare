<?php
use Helpers\ViewHelper;
?>

<!-- Role Switcher Tabs -->
<div class="auth-role-tabs">
    <a href="<?= ViewHelper::url('register/owner') ?>" class="auth-role-tab">
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
    <a href="<?= ViewHelper::url('register/vendor') ?>" class="auth-role-tab active">
        <i class="fa-solid fa-store"></i>
        <span>Vendor</span>
    </a>
</div>

<div class="auth-form-header">
    <h2 class="auth-title">Merchant Partner Registration</h2>
    <p class="auth-subtitle">Sell pet nutrition, veterinary supplies, toys, and accessories on the Pet Guard marketplace.</p>
</div>

<form action="<?= ViewHelper::url('register/vendor') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Store Name -->
    <div class="form-group-custom">
        <label for="vendorStoreName" class="form-label-custom">
            Store / Business Name <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-store input-icon-left"></i>
            <input 
                type="text" 
                name="store_name" 
                id="vendorStoreName" 
                class="input-custom <?= ViewHelper::hasError('store_name') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('store_name')) ?>" 
                placeholder="e.g. Pet Guard Nutrition & Supplies" 
                required 
            >
        </div>
        <?php if (ViewHelper::hasError('store_name')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('store_name')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Email Address -->
    <div class="form-group-custom">
        <label for="vendorEmail" class="form-label-custom">
            Merchant Business Email <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-envelope input-icon-left"></i>
            <input 
                type="email" 
                name="email" 
                id="vendorEmail" 
                class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                placeholder="vendor@company.com" 
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

    <!-- Phone & Business Reg Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-6">
            <label for="vendorPhone" class="form-label-custom">
                Business Phone <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-phone input-icon-left"></i>
                <input 
                    type="tel" 
                    name="phone" 
                    id="vendorPhone" 
                    class="input-custom <?= ViewHelper::hasError('phone') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" 
                    placeholder="+1 (555) 018-7744" 
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
            <label for="vendorTaxId" class="form-label-custom">
                Tax ID / Business Reg # <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-id-card input-icon-left"></i>
                <input 
                    type="text" 
                    name="business_registration" 
                    id="vendorTaxId" 
                    class="input-custom font-monospace <?= ViewHelper::hasError('business_registration') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('business_registration')) ?>" 
                    placeholder="TX-BUS-98231" 
                    required 
                >
            </div>
            <?php if (ViewHelper::hasError('business_registration')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('business_registration')) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Warehouse / Headquarter Address -->
    <div class="form-group-custom">
        <label for="vendorAddress" class="form-label-custom">
            Warehouse / Headquarter Address <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-location-dot input-icon-left"></i>
            <input 
                type="text" 
                name="address" 
                id="vendorAddress" 
                class="input-custom <?= ViewHelper::hasError('address') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" 
                placeholder="500 Commerce Blvd, Austin TX" 
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

    <!-- Password & Confirm Password Row -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6">
            <label for="vendorPassword" class="form-label-custom">
                Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock input-icon-left"></i>
                <input 
                    type="password" 
                    name="password" 
                    id="vendorPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                    placeholder="At least 6 chars" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="vendorPassword" title="Toggle password visibility">
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
            <label for="vendorConfirmPassword" class="form-label-custom">
                Confirm Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-shield-halved input-icon-left"></i>
                <input 
                    type="password" 
                    name="confirm_password" 
                    id="vendorConfirmPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('confirm_password') ? 'is-invalid' : '' ?>" 
                    placeholder="Repeat password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="vendorConfirmPassword" title="Toggle password visibility">
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
        <i class="fa-solid fa-shop"></i>
        <span>Register Vendor Store</span>
    </button>

    <div class="auth-card-footer">
        Already have a Pet Guard partner account? 
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link">Sign In Here</a>
    </div>
</form>
