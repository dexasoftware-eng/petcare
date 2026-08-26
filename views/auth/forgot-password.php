<?php
use Helpers\ViewHelper;
?>
<p class="text-muted small text-center mb-4">Enter your registered email address and we'll generate a secure password reset token.</p>

<form action="<?= ViewHelper::url('forgot-password') ?>" method="POST">
    <?= ViewHelper::csrfField() ?>

    <div class="mb-4">
        <label class="form-label fw-semibold">Registered Email</label>
        <div class="input-group">
            <span class="input-group-text bg-light"><i class="fa-solid fa-envelope text-muted"></i></span>
            <input type="email" name="email" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('email')) ?>" required placeholder="name@example.com">
        </div>
    </div>

    <button type="submit" class="btn btn-brand fw-bold py-3 mb-3">
        <i class="fa-solid fa-paper-plane me-2"></i> Request Reset Link
    </button>

    <div class="text-center small text-muted">
        Remembered your password? <a href="<?= ViewHelper::url('login') ?>" class="text-brand fw-bold text-decoration-none">Sign In</a>
    </div>
</form>
