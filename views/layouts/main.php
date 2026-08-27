<?php
use Helpers\ViewHelper;
use Core\View;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= ViewHelper::csrfToken() ?>">
    <title><?= ViewHelper::e($pageTitle ?? 'PetGuard — Pet Care & Clinic') ?></title>
    <link rel="icon" href="<?= ViewHelper::asset('img/heading-img.png') ?>">
    <script>window.PetGuardCsrf = '<?= ViewHelper::csrfToken() ?>';</script>

    <!-- Core Styles -->
    <link rel="stylesheet" type="text/css" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/owl.carousel.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/owl.theme.default.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/slick.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/slick-theme.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/jquery.fancybox.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive-overhaul.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/color.css') ?>">

    <!-- FontAwesome 6 CDN for modern icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        .hover-white:hover { color: #fff !important; }
        .hover-underline:hover { text-decoration: underline !important; }
        .bg-cream { background-color: #fff8e5; }
        .text-brand { color: #fa441d; }
        .bg-brand { background-color: #fa441d; }
        .btn-brand { background-color: #fa441d; color: #fff; border: 1px solid #fa441d; font-weight: 700; border-radius: 30px; padding: 10px 24px; text-decoration: none; display: inline-block; transition: all 0.2s ease-in-out; }
        .btn-brand:hover { background-color: #e03612; color: #fff; transform: translateY(-2px); box-shadow: 0 6px 16px rgba(250,68,29,0.3); }
        .btn-outline-brand { background-color: transparent; color: #fa441d; border: 2px solid #fa441d; font-weight: 700; border-radius: 30px; padding: 8px 22px; text-decoration: none; display: inline-block; transition: all 0.2s ease-in-out; }
        .btn-outline-brand:hover { background-color: #fa441d; color: #fff; transform: translateY(-2px); }
        
        #progress {
            position: fixed;
            bottom: 25px;
            right: 25px;
            height: 50px;
            width: 50px;
            display: none;
            place-items: center;
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            cursor: pointer;
            z-index: 10000;
        }
        #progress-value {
            display: block;
            height: calc(100% - 10px);
            width: calc(100% - 10px);
            background-color: #fff;
            border-radius: 50%;
            display: grid;
            place-items: center;
            font-size: 18px;
            color: #fa441d;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <?php View::partial('header'); ?>

    <!-- Flash Alerts -->
    <?php View::partial('alerts'); ?>

    <!-- Dynamic Main Content -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->
    <?php View::partial('footer'); ?>

    <!-- Scroll to Top Progress Indicator -->
    <div id="progress">
        <span id="progress-value"><i class="fa-solid fa-arrow-up"></i></span>
    </div>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/owl.carousel.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/slick.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/jquery.fancybox.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/custom.js') ?>"></script>
</body>
</html>
