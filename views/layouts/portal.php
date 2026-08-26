<?php
use Helpers\ViewHelper;
use Helpers\Auth;
use Helpers\Flash;

$user = Auth::user() ?? [];
$role = $user['role'] ?? 'petowner';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= ViewHelper::e($pageTitle ?? 'Dashboard — PetGuard') ?></title>
    
    <!-- CSS Dependencies -->
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/fontawesome.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --brand-primary: #fa441d;
            --brand-secondary: #feda46;
            --brand-dark: #222222;
            --brand-bg: #fdfbf7;
            --portal-sidebar-width: 260px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--brand-bg);
            color: #333;
            min-height: 100vh;
        }
        .portal-sidebar {
            width: var(--portal-sidebar-width);
            background: #ffffff;
            border-right: 1px solid #eee;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1000;
            display: flex;
            flex-direction: column;
        }
        .portal-main {
            margin-left: var(--portal-sidebar-width);
            padding: 30px;
            min-height: 100vh;
        }
        .portal-nav-link {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #555;
            text-decoration: none;
            font-weight: 500;
            border-radius: 12px;
            margin: 4px 15px;
            transition: all 0.2s ease;
        }
        .portal-nav-link i {
            width: 24px;
            font-size: 17px;
            margin-right: 10px;
        }
        .portal-nav-link:hover {
            background-color: #fff8e5;
            color: var(--brand-primary);
        }
        .portal-nav-link.active {
            background-color: var(--brand-primary);
            color: #ffffff !important;
            box-shadow: 0 4px 15px rgba(250, 68, 29, 0.25);
        }
        .card-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
            background: #ffffff;
        }
        .btn-brand {
            background-color: var(--brand-primary);
            color: #ffffff;
            border-radius: 50px;
            padding: 9px 24px;
            font-weight: 600;
            border: none;
            transition: all 0.2s ease;
        }
        .btn-brand:hover {
            background-color: #d83510;
            color: #ffffff;
            transform: translateY(-2px);
        }
        @media (max-width: 991px) {
            .portal-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .portal-sidebar.show {
                transform: translateX(0);
            }
            .portal-main {
                margin-left: 0;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="portal-sidebar shadow-sm">
    <!-- Brand Logo -->
    <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
        <a href="<?= ViewHelper::url('/') ?>" class="d-flex align-items-center text-decoration-none">
            <img src="<?= ViewHelper::asset('img/logo.png') ?>" alt="PetGuard Logo" style="height: 38px;">
        </a>
    </div>

    <!-- User Mini Profile -->
    <div class="p-3 mx-3 my-3 rounded-4" style="background: #fff8e5; border-left: 4px solid var(--brand-primary);">
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-circle bg-white d-flex align-items-center justify-content-center fw-bold text-danger shadow-sm" style="width: 40px; height: 40px; min-width: 40px;">
                <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="overflow-hidden">
                <div class="fw-bold text-dark text-truncate small"><?= ViewHelper::e($user['name'] ?? 'User') ?></div>
                <span class="badge bg-danger text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($role) ?></span>
            </div>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-grow-1 overflow-auto py-2">
        <a href="<?= ViewHelper::url('portal') ?>" class="portal-nav-link active">
            <i class="fa-solid fa-gauge-high"></i> Dashboard
        </a>

        <div class="px-4 pt-4 pb-1 text-uppercase text-muted fw-bold" style="font-size: 11px; letter-spacing: 0.5px;">Navigation</div>
        <a href="<?= ViewHelper::url('/') ?>" class="portal-nav-link">
            <i class="fa-solid fa-globe"></i> Main Website
        </a>
    </nav>

    <!-- Logout -->
    <div class="p-3 border-top">
        <form action="<?= ViewHelper::url('logout') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>
            <button type="submit" class="btn btn-outline-danger w-100 rounded-pill fw-semibold btn-sm py-2">
                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Sign Out
            </button>
        </form>
    </div>
</aside>

<!-- Main Portal Area -->
<main class="portal-main">
    <!-- Mobile Header Bar -->
    <div class="d-lg-none d-flex justify-content-between align-items-center mb-4 p-3 bg-white rounded-3 shadow-sm">
        <img src="<?= ViewHelper::asset('img/logo.png') ?>" alt="Logo" style="height: 30px;">
        <button class="btn btn-sm btn-outline-dark" onclick="document.querySelector('.portal-sidebar').classList.toggle('show')">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>

    <!-- Flash Notifications -->
    <?php
    $successMsg = Flash::get('success');
    $errorMsg = Flash::get('error');
    $infoMsg = Flash::get('info');
    ?>
    <?php if ($successMsg): ?>
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> <?= ViewHelper::e($successMsg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
    <?php if ($errorMsg): ?>
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm" role="alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i> <?= ViewHelper::e($errorMsg) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Injected Page View Content -->
    <?= $content ?>
</main>

<script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>
