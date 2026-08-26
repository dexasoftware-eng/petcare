<?php
use Helpers\ViewHelper;
?>
<form action="<?= ViewHelper::url('register/owner') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>

    <div class="mb-3">
        <label class="form-label fw-semibold">Full Name *</label>
        <input type="text" name="name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('name')) ?>" required placeholder="Alex Morgan">
    </div>

    <div class="mb-3">
        <label class="form-label fw-semibold">Email Address *</label>
        <input type="email" name="email" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="alex@example.com">
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label fw-semibold">Phone Number *</label>
            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('phone')) ?>" required placeholder="+1 555-012-3456">
        </div>
        <div class="col-md-6">
            <label class="form-label fw-semibold">Home Address *</label>
            <input type="text" name="address" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('address')) ?>" required placeholder="88 Magnolia Court">
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
        <i class="fa-solid fa-paw me-2"></i> Register as Pet Owner
    </button>

    <div class="text-center small text-muted">
        Already registered? <a href="<?= ViewHelper::url('login') ?>" class="text-brand fw-bold text-decoration-none">Sign In Here</a>
    </div>
</form>
