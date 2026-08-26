<?php
use Helpers\ViewHelper;
?>
<form action="<?= ViewHelper::url('register/shelter') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>

    <div class="mb-3">
        <label class="form-label fw-semibold">Sanctuary / Shelter Name *</label>
        <input type="text" name="shelter_name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('shelter_name')) ?>" required placeholder="Hope Animal Rescue Sanctuary">
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Contact Person *</label>
            <input type="text" name="contact_person" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('contact_person')) ?>" required placeholder="Maria Rodriguez">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Shelter Capacity (Animals) *</label>
            <input type="number" name="capacity" class="form-control" min="1" value="<?= ViewHelper::e(ViewHelper::old('capacity', '50')) ?>" required>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Official Email *</label>
            <input type="email" name="email" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="shelter@hope-rescue.org">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Hotline Phone *</label>
            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" required placeholder="+1 555-098-7654">
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Sanctuary Physical Address *</label>
        <input type="text" name="address" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" required placeholder="12 Shelter Valley Road">
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Website URL (Optional)</label>
        <input type="url" name="website" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('website')) ?>" placeholder="https://hope-shelter.org">
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Password *</label>
            <input type="password" name="password" class="form-control" required placeholder="••••••••">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Confirm Password *</label>
            <input type="password" name="confirm_password" class="form-control" required placeholder="••••••••">
        </div>
    </div>

    <button type="submit" class="btn btn-brand fw-bold py-3 mb-3">
        <i class="fa-solid fa-house-medical me-2"></i> Register Rescue Shelter
    </button>

    <div class="text-center small text-muted">
        Already registered? <a href="<?= ViewHelper::url('login') ?>" class="text-brand fw-bold text-decoration-none">Sign In Here</a>
    </div>
</form>
