<?php
use Helpers\ViewHelper;
?>
<form action="<?= ViewHelper::url('register/veterinarian') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>

    <div class="mb-3">
        <label class="form-label fw-semibold">Doctor Full Name (with Title) *</label>
        <input type="text" name="name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('name')) ?>" required placeholder="Dr. Sarah Jenkins, DVM">
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Professional Email *</label>
            <input type="email" name="email" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="dr.jenkins@clinic.com">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Direct Phone *</label>
            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" required placeholder="+1 555-019-2834">
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Specialization / Discipline *</label>
            <input type="text" name="specialization" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('specialization')) ?>" required placeholder="Small Animal Surgery & Canine Medicine">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Years of Clinical Experience *</label>
            <input type="number" name="experience" class="form-control" min="0" value="<?= ViewHelper::e(ViewHelper::old('experience', '5')) ?>" required>
        </div>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Primary Clinic Name *</label>
            <input type="text" name="clinic_name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('clinic_name')) ?>" required placeholder="PetGuard Central Pet Hospital">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Clinic Address *</label>
            <input type="text" name="address" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" required placeholder="742 Evergreen Terrace">
        </div>
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
        <i class="fa-solid fa-user-doctor me-2"></i> Register Clinical Practice
    </button>

    <div class="text-center small text-muted">
        Already registered? <a href="<?= ViewHelper::url('login') ?>" class="text-brand fw-bold text-decoration-none">Sign In Here</a>
    </div>
</form>
