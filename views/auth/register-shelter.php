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
    <a href="<?= ViewHelper::url('register/shelter') ?>" class="auth-role-tab active">
        <i class="fa-solid fa-house-medical"></i>
        <span>Rescue Shelter</span>
    </a>
    <a href="<?= ViewHelper::url('register/vendor') ?>" class="auth-role-tab">
        <i class="fa-solid fa-store"></i>
        <span>Vendor</span>
    </a>
</div>

<div class="auth-form-header">
    <h2 class="auth-title">Register Animal Shelter</h2>
    <p class="auth-subtitle">Publish rescue animals for adoption, review applications, and coordinate preventive veterinary care.</p>
</div>

<form action="<?= ViewHelper::url('register/shelter') ?>" method="POST" autocomplete="on">
    <?= ViewHelper::csrfField() ?>

    <!-- Sanctuary Name -->
    <div class="form-group-custom">
        <label for="shelterName" class="form-label-custom">
            Sanctuary / Shelter Name <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-house-medical input-icon-left"></i>
            <input 
                type="text" 
                name="shelter_name" 
                id="shelterName" 
                class="input-custom <?= ViewHelper::hasError('shelter_name') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('shelter_name')) ?>" 
                placeholder="e.g. Hope Animal Rescue Sanctuary" 
                required 
                autocomplete="organization"
            >
        </div>
        <?php if (ViewHelper::hasError('shelter_name')): ?>
            <span class="invalid-feedback-custom">
                <i class="fa-solid fa-circle-exclamation"></i>
                <?= ViewHelper::e(ViewHelper::error('shelter_name')) ?>
            </span>
        <?php endif; ?>
    </div>

    <!-- Contact Person & Shelter Capacity Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-7">
            <label for="shelterContact" class="form-label-custom">
                Lead Contact Person <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-user input-icon-left"></i>
                <input 
                    type="text" 
                    name="contact_person" 
                    id="shelterContact" 
                    class="input-custom <?= ViewHelper::hasError('contact_person') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('contact_person')) ?>" 
                    placeholder="Maria Rodriguez" 
                    required 
                    autocomplete="name"
                >
            </div>
            <?php if (ViewHelper::hasError('contact_person')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('contact_person')) ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-sm-5">
            <label for="shelterCap" class="form-label-custom">
                Capacity (Animals) <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-shield-cat input-icon-left"></i>
                <input 
                    type="number" 
                    name="capacity" 
                    id="shelterCap" 
                    class="input-custom <?= ViewHelper::hasError('capacity') ? 'is-invalid' : '' ?>" 
                    min="1" 
                    value="<?= ViewHelper::e(ViewHelper::old('capacity', '50')) ?>" 
                    required
                >
            </div>
            <?php if (ViewHelper::hasError('capacity')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::e(ViewHelper::error('capacity')) ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Email & Phone Row -->
    <div class="row g-3 mb-3">
        <div class="col-sm-6">
            <label for="shelterEmail" class="form-label-custom">
                Official Email <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-envelope input-icon-left"></i>
                <input 
                    type="email" 
                    name="email" 
                    id="shelterEmail" 
                    class="input-custom <?= ViewHelper::hasError('email') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" 
                    placeholder="shelter@hope-rescue.org" 
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
            <label for="shelterPhone" class="form-label-custom">
                Hotline Phone <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-phone input-icon-left"></i>
                <input 
                    type="tel" 
                    name="phone" 
                    id="shelterPhone" 
                    class="input-custom <?= ViewHelper::hasError('phone') ? 'is-invalid' : '' ?>" 
                    value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" 
                    placeholder="+1 (555) 098-7654" 
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

    <!-- Physical Address -->
    <div class="form-group-custom">
        <label for="shelterAddress" class="form-label-custom">
            Sanctuary Physical Address <span class="required-star">*</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-location-dot input-icon-left"></i>
            <input 
                type="text" 
                name="address" 
                id="shelterAddress" 
                class="input-custom <?= ViewHelper::hasError('address') ? 'is-invalid' : '' ?>" 
                value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" 
                placeholder="12 Shelter Valley Road, San Francisco, CA" 
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

    <!-- Website URL (Optional) -->
    <div class="form-group-custom">
        <label for="shelterWebsite" class="form-label-custom">
            Website URL <span class="text-muted fw-normal">(Optional)</span>
        </label>
        <div class="input-wrapper">
            <i class="fa-solid fa-globe input-icon-left"></i>
            <input 
                type="url" 
                name="website" 
                id="shelterWebsite" 
                class="input-custom" 
                value="<?= ViewHelper::e(ViewHelper::old('website')) ?>" 
                placeholder="https://hope-rescue.org"
            >
        </div>
    </div>

    <!-- Password & Confirm Password Row -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6">
            <label for="shelterPassword" class="form-label-custom">
                Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock input-icon-left"></i>
                <input 
                    type="password" 
                    name="password" 
                    id="shelterPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('password') ? 'is-invalid' : '' ?>" 
                    placeholder="At least 6 chars" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="shelterPassword" title="Toggle password visibility">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <?php if (ViewHelper::hasError('password')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::error('password') ?>
                </span>
            <?php endif; ?>
        </div>

        <div class="col-sm-6">
            <label for="shelterConfirmPassword" class="form-label-custom">
                Confirm Password <span class="required-star">*</span>
            </label>
            <div class="input-wrapper">
                <i class="fa-solid fa-shield-halved input-icon-left"></i>
                <input 
                    type="password" 
                    name="confirm_password" 
                    id="shelterConfirmPassword" 
                    class="input-custom has-toggle <?= ViewHelper::hasError('confirm_password') ? 'is-invalid' : '' ?>" 
                    placeholder="Repeat password" 
                    required 
                    autocomplete="new-password"
                >
                <button type="button" class="password-toggle-btn" data-target="shelterConfirmPassword" title="Toggle password visibility">
                    <i class="fa-regular fa-eye"></i>
                </button>
            </div>
            <?php if (ViewHelper::hasError('confirm_password')): ?>
                <span class="invalid-feedback-custom">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <?= ViewHelper::error('confirm_password') ?>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-auth-primary">
        <i class="fa-solid fa-house-medical"></i>
        <span>Register Rescue Shelter</span>
    </button>

    <div class="auth-card-footer">
        Already registered with PetGuard? 
        <a href="<?= ViewHelper::url('login') ?>" class="auth-link">Sign In Here</a>
    </div>
</form>
