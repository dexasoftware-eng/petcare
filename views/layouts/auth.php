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
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/style.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        body {
            background-color: #fff8e5;
            background-image: url('<?= ViewHelper::asset("img/background.png") ?>');
            background-repeat: repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }
        .auth-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            border: 1px solid rgba(0,0,0,0.05);
            overflow: hidden;
            width: 100%;
            max-width: 540px;
        }
        .auth-header {
            padding: 36px 36px 20px;
            text-align: center;
        }
        .auth-body {
            padding: 10px 36px 36px;
        }
        .btn-brand {
            background-color: #fa441d;
            border-color: #fa441d;
            color: #fff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            width: 100%;
        }
        .btn-brand:hover {
            background-color: #e03612;
            border-color: #e03612;
            color: #fff;
        }
        .form-control, .form-select {
            border-radius: 8px;
            padding: 10px 14px;
            border: 1px solid #cbd5e1;
        }
        .form-control:focus, .form-select:focus {
            border-color: #fa441d;
            box-shadow: 0 0 0 3px rgba(250, 68, 29, 0.15);
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <!-- Brand Logo Header -->
        <div class="auth-header">
            <a href="<?= ViewHelper::url() ?>" class="d-inline-flex align-items-center gap-2 text-decoration-none mb-3">
                <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard Logo" style="height: 36px;">
                <span class="fw-bolder fs-3" style="color: #222;">Pet<span style="color: #fa441d;">Guard</span></span>
            </a>
            <h4 class="fw-bold m-0 text-dark"><?= ViewHelper::e($pageTitle ?? 'Welcome') ?></h4>
        </div>

        <!-- Flash Alerts -->
        <?php View::partial('alerts'); ?>

        <!-- Auth Form Content -->
        <div class="auth-body">
            <?= $content ?>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
