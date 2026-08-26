<?php
use Helpers\ViewHelper;
?>

<div class="w-100 text-center">
    <!-- Top Icon Badge -->
    <div class="mb-3 d-flex justify-content-center">
        <div style="width: 72px; height: 72px; background: #fff0eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; position: relative;">
            <i class="fa-solid fa-envelope-open-text" style="color: #fa441d; font-size: 30px;"></i>
            <span style="position: absolute; top: 2px; right: 2px; background: #10b981; color: #fff; width: 22px; height: 22px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 11px; border: 2px solid #fff;">
                <i class="fa-solid fa-check"></i>
            </span>
        </div>
    </div>

    <h2 class="auth-form-title">Verify Your Email</h2>
    <p class="auth-form-subtitle mb-3">Enter the 6-digit code sent to <br><strong><?= ViewHelper::e($email ?? 'user@example.com') ?></strong></p>

    <form action="<?= ViewHelper::url('verify-email') ?>" method="POST" id="otpForm">
        <?= ViewHelper::csrf() ?>
        <input type="hidden" name="email" value="<?= ViewHelper::e($email ?? '') ?>">
        <input type="hidden" name="otp" id="finalOtp" value="">

        <!-- 6 OTP Input Boxes -->
        <div class="otp-inputs-wrapper">
            <input type="text" maxlength="1" class="otp-box" autofocus inputmode="numeric" pattern="[0-9]*">
            <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*">
            <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*">
            <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*">
            <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*">
            <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*">
        </div>

        <div class="small text-muted mb-4" style="font-size: 13.5px;">
            Didn't receive the code? 
            <a href="javascript:void(0)" id="resendBtn" class="fw-bold text-decoration-none" style="color: #fa441d;">
                Resend Code <span id="countdown">(00:45)</span>
            </a>
        </div>

        <!-- Verify Button -->
        <button type="submit" class="btn-auth-primary mb-3">
            Verify <i class="fa-solid fa-arrow-right ms-1"></i>
        </button>

        <!-- Back to Login -->
        <div>
            <a href="<?= ViewHelper::url('login') ?>" class="text-decoration-none fw-semibold small text-muted">
                <i class="fa-solid fa-arrow-left me-1"></i> Back to Login
            </a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('.otp-box');
    const form = document.getElementById('otpForm');
    const finalOtp = document.getElementById('finalOtp');

    inputs.forEach((input, index) => {
        input.addEventListener('keyup', function(e) {
            if (e.key >= '0' && e.key <= '9') {
                if (index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            } else if (e.key === 'Backspace') {
                if (index > 0 && !input.value) {
                    inputs[index - 1].focus();
                }
            }
        });

        // Paste support
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();
            if (/^\d{6}$/.test(pasteData)) {
                pasteData.split('').forEach((char, i) => {
                    if (inputs[i]) inputs[i].value = char;
                });
                inputs[5].focus();
            }
        });
    });

    form.addEventListener('submit', function(e) {
        let code = '';
        inputs.forEach(i => code += i.value);
        finalOtp.value = code;
    });

    // Countdown Timer
    let timeLeft = 45;
    const countdownEl = document.getElementById('countdown');
    const resendBtn = document.getElementById('resendBtn');

    const timer = setInterval(() => {
        timeLeft--;
        const seconds = timeLeft < 10 ? '0' + timeLeft : timeLeft;
        countdownEl.innerText = '(00:' + seconds + ')';
        if (timeLeft <= 0) {
            clearInterval(timer);
            countdownEl.innerText = '';
            resendBtn.innerText = 'Resend Code Now';
        }
    }, 1000);
});
</script>
