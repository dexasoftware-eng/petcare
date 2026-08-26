<?php
use Helpers\ViewHelper;
use Core\View;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= ViewHelper::e($pageTitle ?? 'Authentication — PetGuard') ?></title>
    <link rel="icon" href="<?= ViewHelper::asset('img/heading-img.png') ?>">

    <!-- Core Styles -->
    <link rel="stylesheet" type="text/css" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

        * {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #ffeedd;
            background-image: 
                radial-gradient(at 10% 10%, rgba(250, 68, 29, 0.4) 0px, transparent 50%),
                radial-gradient(at 90% 10%, rgba(251, 146, 60, 0.45) 0px, transparent 50%),
                radial-gradient(at 90% 90%, rgba(250, 68, 29, 0.35) 0px, transparent 50%),
                radial-gradient(at 10% 90%, rgba(251, 146, 60, 0.3) 0px, transparent 50%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
            margin: 0;
        }

        /* Large Organic Corner Shapes */
        .bg-shape-top-left {
            position: fixed;
            top: -120px;
            left: -120px;
            width: 480px;
            height: 480px;
            background: linear-gradient(135deg, #fa441d 0%, #ff8c2c 100%);
            border-radius: 42% 58% 70% 30% / 45% 45% 55% 55%;
            opacity: 0.85;
            z-index: 0;
            pointer-events: none;
        }
        .bg-shape-top-right {
            position: fixed;
            top: -100px;
            right: -100px;
            width: 420px;
            height: 420px;
            background: linear-gradient(135deg, #ff8c2c 0%, #fa441d 100%);
            border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            opacity: 0.8;
            z-index: 0;
            pointer-events: none;
        }
        .bg-shape-bottom-right {
            position: fixed;
            bottom: -140px;
            right: -120px;
            width: 520px;
            height: 520px;
            background: linear-gradient(135deg, #fa441d 0%, #f97316 100%);
            border-radius: 50% 50% 35% 65% / 40% 60% 40% 60%;
            opacity: 0.85;
            z-index: 0;
            pointer-events: none;
        }
        .bg-shape-bottom-left {
            position: fixed;
            bottom: -150px;
            left: -150px;
            width: 450px;
            height: 450px;
            background: linear-gradient(135deg, #ff9f43 0%, #fa441d 100%);
            border-radius: 40% 60% 60% 40% / 50% 40% 60% 50%;
            opacity: 0.75;
            z-index: 0;
            pointer-events: none;
        }

        .auth-container {
            position: relative;
            z-index: 2;
            width: 100%;
            max-width: 1180px;
            margin: auto;
        }

        .auth-card {
            background: #ffffff;
            border-radius: 40px;
            box-shadow: 0 30px 80px rgba(234, 88, 12, 0.2), 0 10px 30px rgba(0,0,0,0.04);
            border: 1px solid rgba(255, 255, 255, 0.8);
            padding: 16px;
            display: flex;
            flex-direction: row;
            min-height: 660px;
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        /* Left Hero Panel (Orange) */
        .auth-hero-panel {
            flex: 0 0 44%;
            max-width: 44%;
            background: linear-gradient(155deg, #ff8c2c 0%, #fa441d 100%);
            border-radius: 32px;
            padding: 42px 38px 0 38px;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            color: #ffffff;
        }

        /* Dot matrix texture in hero */
        .auth-hero-panel::before {
            content: '';
            position: absolute;
            top: 24px;
            right: 24px;
            width: 140px;
            height: 140px;
            background-image: radial-gradient(rgba(255, 255, 255, 0.4) 1.5px, transparent 1.5px);
            background-size: 15px 15px;
            pointer-events: none;
            opacity: 0.85;
        }
        .auth-hero-panel::after {
            content: '';
            position: absolute;
            bottom: 150px;
            left: 20px;
            width: 120px;
            height: 120px;
            background-image: radial-gradient(rgba(255, 255, 255, 0.35) 1.5px, transparent 1.5px);
            background-size: 15px 15px;
            pointer-events: none;
            opacity: 0.7;
        }

        .auth-brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            margin-bottom: 32px;
            position: relative;
            z-index: 2;
        }

        .auth-brand-icon {
            width: 48px;
            height: 48px;
            background: #ffffff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 16px rgba(0,0,0,0.12);
        }

        .auth-hero-title {
            font-size: 32px !important;
            font-weight: 800 !important;
            line-height: 1.25 !important;
            color: #ffffff !important;
            margin-bottom: 16px !important;
            position: relative;
            z-index: 2;
            letter-spacing: -0.5px;
        }

        .auth-hero-desc {
            font-size: 15px !important;
            color: rgba(255, 255, 255, 0.95) !important;
            line-height: 1.65 !important;
            margin-bottom: 24px !important;
            position: relative;
            z-index: 2;
            max-width: 360px;
        }

        .auth-hero-illustration {
            margin-top: auto;
            text-align: center;
            position: relative;
            z-index: 2;
            line-height: 0;
        }

        .auth-character-img {
            max-width: 95% !important;
            height: auto !important;
            max-height: 330px !important;
            object-fit: contain !important;
            filter: drop-shadow(0 14px 28px rgba(0,0,0,0.15));
            transition: transform 0.3s ease;
        }
        .auth-character-img:hover {
            transform: scale(1.02);
        }

        /* Right Form Panel */
        .auth-form-panel {
            flex: 0 0 56%;
            max-width: 56%;
            padding: 44px 54px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            background: #ffffff;
        }

        .auth-form-title {
            font-size: 32px !important;
            font-weight: 800 !important;
            color: #1e293b !important;
            letter-spacing: -0.5px;
            margin-bottom: 6px !important;
        }

        .auth-form-subtitle {
            font-size: 15px !important;
            color: #64748b !important;
            margin-bottom: 28px !important;
        }

        /* Input styling with modern icon container */
        .auth-input-group {
            position: relative;
            margin-bottom: 18px !important;
        }

        .auth-input-icon {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 16px;
            z-index: 4;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 22px;
            height: 22px;
        }

        .auth-card input.auth-control,
        .auth-card select.auth-select {
            height: 52px !important;
            border-radius: 14px !important;
            border: 1.5px solid #e2e8f0 !important;
            padding: 10px 18px 10px 50px !important;
            font-size: 15px !important;
            font-weight: 500 !important;
            color: #1e293b !important;
            background-color: #ffffff !important;
            transition: all 0.2s ease;
            width: 100% !important;
            margin: 0 !important;
            display: block !important;
            box-shadow: none !important;
        }

        .auth-card input.auth-control::placeholder {
            color: #94a3b8 !important;
            font-weight: 400 !important;
            font-size: 14.5px !important;
        }

        .auth-card input.auth-control:focus,
        .auth-card select.auth-select:focus {
            border-color: #fa441d !important;
            box-shadow: 0 0 0 4px rgba(250, 68, 29, 0.12) !important;
            background-color: #ffffff !important;
            outline: none !important;
        }

        .auth-card select.auth-select {
            cursor: pointer;
            appearance: auto;
        }

        /* Buttons */
        .btn-auth-primary {
            background: linear-gradient(135deg, #fa441d 0%, #f97316 100%) !important;
            color: #ffffff !important;
            border: none !important;
            height: 52px !important;
            border-radius: 50px !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            width: 100% !important;
            box-shadow: 0 10px 25px rgba(250, 68, 29, 0.3) !important;
            transition: all 0.25s ease !important;
            text-decoration: none !important;
            cursor: pointer !important;
            margin: 0 !important;
        }

        .btn-auth-primary:hover {
            background: linear-gradient(135deg, #e03612 0%, #ea580c 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 14px 30px rgba(250, 68, 29, 0.4) !important;
            transform: translateY(-2px);
        }

        .btn-auth-outline {
            background: transparent !important;
            color: #fa441d !important;
            border: 1.5px solid #fa441d !important;
            height: 52px !important;
            border-radius: 50px !important;
            font-weight: 700 !important;
            font-size: 16px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 10px !important;
            width: 100% !important;
            transition: all 0.25s ease !important;
            text-decoration: none !important;
        }

        .btn-auth-outline:hover {
            background: #fa441d !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }

        /* Role switcher pill buttons */
        .role-pill-switch {
            background: #f1f5f9;
            padding: 5px;
            border-radius: 50px;
            display: inline-flex;
            gap: 5px;
            margin-bottom: 24px;
            width: 100%;
        }

        .role-pill-btn {
            flex: 1;
            text-align: center;
            padding: 10px 14px;
            border-radius: 50px;
            font-size: 13.5px;
            font-weight: 600;
            color: #64748b;
            text-decoration: none;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .role-pill-btn.active, .role-pill-btn:hover {
            background: #fa441d;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(250, 68, 29, 0.25);
        }

        /* OTP Inputs */
        .otp-inputs-wrapper {
            display: flex !important;
            flex-direction: row !important;
            gap: 14px !important;
            justify-content: center !important;
            align-items: center !important;
            margin: 28px auto !important;
            max-width: 440px !important;
        }

        .auth-card input.otp-box {
            width: 56px !important;
            height: 62px !important;
            border-radius: 14px !important;
            border: 1.5px solid #e2e8f0 !important;
            text-align: center !important;
            font-size: 24px !important;
            font-weight: 800 !important;
            color: #1e293b !important;
            background-color: #ffffff !important;
            padding: 0 !important;
            margin: 0 !important;
            display: inline-block !important;
            transition: all 0.2s ease !important;
            box-shadow: none !important;
        }

        .auth-card input.otp-box:focus {
            border-color: #fa441d !important;
            box-shadow: 0 0 0 4px rgba(250, 68, 29, 0.15) !important;
            outline: none !important;
        }

        /* Custom Checkbox */
        .custom-checkbox .form-check-input {
            width: 20px;
            height: 20px;
            border-radius: 6px;
            border: 1.5px solid #cbd5e1;
            cursor: pointer;
        }
        .custom-checkbox .form-check-input:checked {
            background-color: #fa441d;
            border-color: #fa441d;
        }

        /* Responsive Layout for Mobile */
        @media (max-width: 991px) {
            .auth-card {
                flex-direction: column;
                border-radius: 28px;
                padding: 12px;
                min-height: auto;
            }
            .auth-hero-panel {
                max-width: 100%;
                flex: 0 0 100%;
                padding: 32px 24px 10px;
                border-radius: 24px;
            }
            .auth-character-img {
                max-height: 220px !important;
            }
            .auth-form-panel {
                max-width: 100%;
                flex: 0 0 100%;
                padding: 32px 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative background wave shapes -->
    <div class="bg-shape-top-left"></div>
    <div class="bg-shape-top-right"></div>
    <div class="bg-shape-bottom-right"></div>
    <div class="bg-shape-bottom-left"></div>

    <div class="auth-container">
        <div class="auth-card">
            <!-- Left Hero Panel -->
            <div class="auth-hero-panel">
                <!-- Brand Badge -->
                <a href="<?= ViewHelper::url() ?>" class="auth-brand-badge">
                    <div class="auth-brand-icon">
                        <i class="fa-solid fa-paw" style="color: #fa441d; font-size: 22px;"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold text-white mb-0" style="font-size: 21px; letter-spacing: -0.5px;">PetGuard</h5>
                        <span class="text-white small" style="font-size: 12px; opacity: 0.9;">Happy Pets, Happy Life</span>
                    </div>
                </a>

                <!-- Dynamic Headline & Subtext -->
                <h2 class="auth-hero-title"><?= $heroTitle ?? 'Welcome to PetGuard' ?></h2>
                <p class="auth-hero-desc"><?= $heroDesc ?? 'Join our verified ecosystem to access premium healthcare and pet companion services.' ?></p>

                <!-- Mascot Illustration -->
                <div class="auth-hero-illustration">
                    <img src="<?= ViewHelper::asset('img/auth-character.png') ?>" alt="PetGuard Mascot" class="img-fluid auth-character-img">
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="auth-form-panel">
                <!-- Flash Alerts -->
                <?php View::partial('alerts'); ?>

                <!-- Form Content Injection -->
                <?= $content ?>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
