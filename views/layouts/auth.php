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

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@400;500;600;700;800;900&family=DynaPuff:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Core Stylesheets -->
    <link rel="stylesheet" type="text/css" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/auth.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive-overhaul.css') ?>">
</head>
<body class="auth-page">

    <!-- Top Minimal Branded Header -->
    <header class="auth-navbar">
        <div class="container d-flex align-items-center justify-content-between">
            <a href="<?= ViewHelper::url() ?>" class="brand-logo">
                <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard Paw Logo">
                <h1 class="brand-title">Pet<span>Guard</span></h1>
            </a>
            
            <div class="d-flex align-items-center gap-2">
                <a href="<?= ViewHelper::url() ?>" class="auth-nav-link">
                    <i class="fa-solid fa-arrow-left"></i>
                    <span>Back to Website</span>
                </a>
                <a href="<?= ViewHelper::url('contact') ?>" class="auth-nav-link d-none d-sm-inline-flex">
                    <i class="fa-solid fa-headset"></i>
                    <span>Help & Support</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Authentication Viewport -->
    <main class="auth-main">
        <div class="container d-flex justify-content-center">
            <div class="auth-wrapper <?= isset($singleColumnLayout) && $singleColumnLayout ? 'auth-wrapper-single' : '' ?>">
                
                <?php if (!isset($singleColumnLayout) || !$singleColumnLayout): ?>
                <!-- Left Visual Branded Section (Desktop/Tablet) -->
                <div class="auth-visual-side">
                    <div>
                        <div class="visual-badge">
                            <i class="fa-solid fa-shield-heart"></i>
                            <span>Trusted Pet Ecosystem</span>
                        </div>
                        <h2 class="visual-headline">Smarter Care for <span>Every Paw</span> & Purr</h2>
                        <p class="visual-subtext">
                            A unified platform connecting pet parents, accredited veterinary clinics, and rescue shelters with seamless care coordination.
                        </p>
                    </div>

                    <div class="visual-image-box">
                        <img src="<?= ViewHelper::asset('img/pets-cutout.png') ?>" alt="Happy Pets" class="hero-pet-img">
                        <div class="visual-floating-card">
                            <span class="rating-stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </span>
                            <span>4.9 / 5.0 Rating · 5,000+ Pets</span>
                        </div>
                    </div>

                    <div>
                        <ul class="visual-features">
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Digital medical history & vaccination reminders</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Direct appointment booking with certified vets</span>
                            </li>
                            <li>
                                <i class="fa-solid fa-check"></i>
                                <span>Transparent shelter adoption & fostering hub</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Right Form Section -->
                <div class="auth-form-side">
                    <!-- Flash Alerts Notification -->
                    <?php View::partial('alerts'); ?>

                    <!-- Injected Page Content -->
                    <?= $content ?>
                </div>

            </div>
        </div>
    </main>

    <!-- Bottom Security & Copyright Bar -->
    <footer class="auth-footer-bar">
        <div class="container">
            <div class="auth-footer-badges">
                <div class="security-badge-item">
                    <i class="fa-solid fa-lock text-success"></i>
                    <span>256-Bit SSL Encrypted</span>
                </div>
                <div class="security-badge-divider"></div>
                <div class="security-badge-item">
                    <i class="fa-solid fa-shield-heart text-brand"></i>
                    <span>Secure Health Records</span>
                </div>
                <div class="security-badge-divider"></div>
                <div class="security-badge-item">
                    <i class="fa-solid fa-circle-check text-primary"></i>
                    <span>Verified Clinical Network</span>
                </div>
            </div>
            <div class="auth-copyright">
                <span>&copy; <?= date('Y') ?> PetGuard Care & Clinic Platform. All rights reserved.</span>
                <span class="auth-footer-links">
                    <a href="<?= ViewHelper::url('about') ?>">About Us</a>
                    <span class="dot">&middot;</span>
                    <a href="<?= ViewHelper::url('contact') ?>">Help & Support</a>
                    <span class="dot">&middot;</span>
                    <a href="<?= ViewHelper::url('services') ?>">Services</a>
                </span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        // Password Visibility Toggle Handler
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.password-toggle-btn').forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetId = this.getAttribute('data-target');
                    var input = document.getElementById(targetId);
                    var icon = this.querySelector('i');
                    if (input) {
                        if (input.type === 'password') {
                            input.type = 'text';
                            icon.classList.remove('fa-eye');
                            icon.classList.add('fa-eye-slash');
                        } else {
                            input.type = 'password';
                            icon.classList.remove('fa-eye-slash');
                            icon.classList.add('fa-eye');
                        }
                    }
                });
            });
        });

        // Quick Test Credentials Autofill
        function fillDemoCreds(email, password) {
            var emailInput = document.getElementById('loginEmail');
            var passwordInput = document.getElementById('loginPassword');
            if (emailInput && passwordInput) {
                emailInput.value = email;
                passwordInput.value = password;
                
                // Visual feedback pulse
                emailInput.style.borderColor = '#10b981';
                passwordInput.style.borderColor = '#10b981';
                setTimeout(function() {
                    emailInput.style.borderColor = '';
                    passwordInput.style.borderColor = '';
                }, 1000);
            }
        }
    </script>
</body>
</html>
