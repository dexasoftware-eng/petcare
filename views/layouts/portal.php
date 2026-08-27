<?php
use Helpers\ViewHelper;
use Helpers\Auth;
use Helpers\Flash;
use Core\View;

$user = Auth::user() ?? [];
$role = $user['role'] ?? 'petowner';

$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$currentRoute = ltrim(str_replace('/petcaretw', '', $currentPath), '/');

// Real-time notification count
$unreadNotifications = \Models\Notification::getUnreadCountForUser($role);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= ViewHelper::csrfToken() ?>">
    <title><?= ViewHelper::e($pageTitle ?? 'PetCare Portal — PetGuard') ?></title>
    <link rel="icon" href="<?= ViewHelper::asset('img/heading-img.png') ?>">
    <script>
        window.PetGuardAppBase = '<?= ViewHelper::url() ?>';
        window.PetGuardCsrf = '<?= ViewHelper::csrfToken() ?>';
    </script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anybody:wght@400;500;600;700;800;900&family=DynaPuff:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" type="text/css" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/admin.css') ?>?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive-overhaul.css') ?>?v=<?= time() ?>">
</head>
<body class="admin-body">

    <!-- Mobile Backdrop Overlay -->
    <div class="admin-sidebar-overlay" id="portalBackdrop"></div>

    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar" id="portalSidebar">
        <!-- Brand Header -->
        <div class="admin-brand-header">
            <a href="<?= ViewHelper::url('portal') ?>" class="admin-brand-logo">
                <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard Logo">
                <h1 class="admin-brand-title">Pet<span>Guard</span></h1>
            </a>
            <button class="btn btn-sm btn-light d-lg-none" onclick="togglePortalSidebar()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Scroll Container -->
        <div class="admin-sidebar-scroll">
            <?php if ($role === 'petowner'): ?>
                <div class="admin-nav-section">Pet Parent Center</div>
                <a href="<?= ViewHelper::url('portal') ?>" class="admin-nav-link <?= $currentRoute === 'portal' || $currentRoute === 'portal/dashboard' || $currentRoute === 'owner/dashboard' ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/pets') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/pets') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-paw"></i>
                        <span>My Family Pets</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/care') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/care') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Today's Care Tasks</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/health') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/health') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-heart-pulse"></i>
                        <span>Health & Meds</span>
                    </span>
                </a>

                <div class="admin-nav-section">Clinical & Emergency</div>
                <a href="<?= ViewHelper::url('portal/appointments') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/appointments') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Appointments</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/vets') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/vets') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Find Veterinarians</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/emergency') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/emergency') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-truck-medical text-danger"></i>
                        <span>Emergency Center</span>
                    </span>
                </a>

                <div class="admin-nav-section">AI, Family & Vault</div>
                <a href="<?= ViewHelper::url('portal/ai-assistant') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/ai-assistant') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-brain" style="color: #8b5cf6;"></i>
                        <span>AI Pet Assistant</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/family') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/family') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-people-roof"></i>
                        <span>Family & Sitters</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/documents') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/documents') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-folder-closed"></i>
                        <span>Document Vault</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/adoption') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/adoption') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                        <span>Adoptions Hub</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/orders') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/orders') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Store Orders</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/notifications') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/notifications') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-bell"></i>
                        <span>Notifications</span>
                    </span>
                    <?php if ($unreadNotifications > 0): ?>
                        <span class="admin-nav-badge badge-amber"><?= $unreadNotifications ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= ViewHelper::url('portal/settings') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/settings') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings & Privacy</span>
                    </span>
                </a>

            <?php elseif ($role === 'veterinarian'): ?>
                <div class="admin-nav-section">Clinical Practice</div>
                <a href="<?= ViewHelper::url('vet/dashboard') ?>" class="admin-nav-link <?= $currentRoute === 'vet/dashboard' || $currentRoute === 'portal' ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Practice Dashboard</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/appointments') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-calendar-check"></i>
                        <span>Consultations Queue</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/patients') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/patients') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-notes-medical"></i>
                        <span>Patients Database</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/services') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/services') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-briefcase-medical"></i>
                        <span>Services & Pricing</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/availability') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/availability') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-clock"></i>
                        <span>Availability Schedule</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-comments"></i>
                        <span>Messages</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/calls') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-phone-volume text-success"></i>
                        <span>Telemedicine Calls</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/profile') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/profile') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Clinical Profile</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vet/reviews') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vet/reviews') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-star text-warning"></i>
                        <span>Reviews & Ratings</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/settings') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/settings') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </span>
                </a>

            <?php elseif ($role === 'shelter'): ?>
                <div class="admin-nav-section">Rescue Operations</div>
                <a href="<?= ViewHelper::url('shelter/dashboard') ?>" class="admin-nav-link <?= $currentRoute === 'shelter/dashboard' || $currentRoute === 'portal' ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Shelter Dashboard</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('shelter/animals') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'shelter/animals') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-paw"></i>
                        <span>Rescue Animals</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'shelter/animals/create') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-plus-circle text-brand"></i>
                        <span>List for Adoption</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('shelter/applications') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'shelter/applications') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-file-signature"></i>
                        <span>Adoption Inquiries</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('shelter/interviews') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'shelter/interviews') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-video text-success"></i>
                        <span>Video Interviews</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-comments"></i>
                        <span>Messages</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/calls') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span>Call Logs</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('shelter/profile') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'shelter/profile') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-house-medical"></i>
                        <span>Shelter Profile</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/settings') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/settings') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </span>
                </a>

            <?php elseif ($role === 'vendor'): ?>
                <div class="admin-nav-section">Merchant Commerce</div>
                <a href="<?= ViewHelper::url('vendor/dashboard') ?>" class="admin-nav-link <?= $currentRoute === 'vendor/dashboard' || $currentRoute === 'portal' ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Store Dashboard</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/products') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/products') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-tags"></i>
                        <span>Product Catalog</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/products/create') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-plus-circle text-brand"></i>
                        <span>Add Product</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/inventory') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/inventory') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        <span>Inventory Control</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/orders') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/orders') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-truck-fast"></i>
                        <span>Customer Orders</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/customers') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/customers') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-users"></i>
                        <span>Store Customers</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-comments"></i>
                        <span>Order Support Chat</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/calls') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-phone-volume"></i>
                        <span>Call Logs</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/store') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/store') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-shop"></i>
                        <span>Store Profile</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('vendor/reports') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'vendor/reports') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-chart-line"></i>
                        <span>Sales Analytics</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('portal/settings') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'portal/settings') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gear"></i>
                        <span>Settings</span>
                    </span>
                </a>
            <?php endif; ?>

            <div class="admin-nav-section">Public Platform</div>
            <a href="<?= ViewHelper::url('/') ?>" class="admin-nav-link">
                <span class="admin-nav-link-content">
                    <i class="fa-solid fa-globe"></i>
                    <span>Main Website</span>
                </span>
            </a>
            <a href="<?= ViewHelper::url('our-products') ?>" class="admin-nav-link">
                <span class="admin-nav-link-content">
                    <i class="fa-solid fa-shop"></i>
                    <span>Pet Store</span>
                </span>
            </a>
        </div>

        <!-- Sidebar Footer -->
        <div class="p-3 border-top bg-light d-flex align-items-center justify-content-between">
            <a href="<?= ViewHelper::url('/') ?>" class="btn btn-sm btn-outline-secondary rounded-pill fw-semibold">
                <i class="fa-solid fa-globe me-1"></i> Main Site
            </a>
            <form action="<?= ViewHelper::url('logout') ?>" method="POST" class="m-0">
                <?= ViewHelper::csrfField() ?>
                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill fw-semibold" title="Sign Out">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Workspace Layout -->
    <div class="admin-main-wrap">
        
        <!-- Sticky Topbar (Perfect on all 5 screens, enhanced mobile header) -->
        <header class="admin-topbar">
            <!-- Left: Mobile Menu Toggle + Mobile Brand Logo + Desktop Search -->
            <div class="d-flex align-items-center gap-2 flex-grow-1 min-w-0" style="max-width: 520px;">
                <button class="btn btn-light d-lg-none rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;" onclick="togglePortalSidebar()" title="Toggle Navigation">
                    <i class="fa-solid fa-bars fs-6"></i>
                </button>
                
                <!-- Mobile Brand Badge (Visible on <992px) -->
                <a href="<?= ViewHelper::url('portal') ?>" class="d-flex d-lg-none align-items-center gap-2 text-decoration-none flex-shrink-0">
                    <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" style="width: 28px; height: 28px; object-fit: contain;" alt="PetGuard">
                    <span class="fw-bold text-dark d-none d-sm-inline" style="font-family: 'DynaPuff', cursive; font-size: 16px; letter-spacing: -0.3px;">Pet<span class="text-brand">Guard</span></span>
                </a>

                <!-- Desktop Search Input (Visible on >=768px) -->
                <div class="admin-topbar-search position-relative w-100 d-none d-md-block">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="portalGlobalSearchInput" placeholder="Search pets, health, records..." autocomplete="off">
                    <div id="portalGlobalSearchSpinner" class="spinner-border spinner-border-sm text-brand position-absolute d-none" style="right: 14px; top: 50%; transform: translateY(-50%); width: 14px; height: 14px;" role="status"></div>
                    
                    <!-- Floating Live Search Dropdown -->
                    <div id="portalGlobalSearchResults" class="portal-search-dropdown d-none"></div>
                </div>
            </div>

            <!-- Right: Notification Bell, User Menu -->
            <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
                <!-- Notification Bell Icon -->
                <a href="<?= ViewHelper::url('portal/notifications') ?>" class="btn btn-light rounded-circle position-relative d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 40px; height: 40px;" title="Notifications">
                    <i class="fa-regular fa-bell text-secondary"></i>
                    <?php if ($unreadNotifications > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 9px; padding: 3px 6px;">
                            <?= $unreadNotifications > 99 ? '99+' : $unreadNotifications ?>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- User Profile Dropdown Menu -->
                <div class="dropdown">
                    <button class="btn admin-user-menu p-1 border-0 bg-transparent dropdown-toggle text-start d-flex align-items-center gap-2 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="admin-avatar-pill shadow-sm" style="width: 38px; height: 38px; font-size: 14px;">
                            <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="d-none d-lg-block text-start">
                            <div class="fw-bold fs-6 text-dark lh-1"><?= ViewHelper::e($user['name'] ?? 'Pet Parent') ?></div>
                            <small class="text-muted fw-semibold" style="font-size: 11px;"><?= ucfirst($role) ?></small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-4 p-2 mt-2" style="min-width: 220px;">
                        <li class="px-3 py-2 border-bottom mb-1 d-lg-none">
                            <div class="fw-bold text-dark"><?= ViewHelper::e($user['name'] ?? 'Pet Parent') ?></div>
                            <small class="badge bg-light text-secondary border"><?= ucfirst($role) ?></small>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('portal/settings') ?>">
                                <i class="fa-solid fa-user-gear text-muted"></i> Account Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('portal/notifications') ?>">
                                <i class="fa-solid fa-bell text-muted"></i> Notifications
                                <?php if ($unreadNotifications > 0): ?>
                                    <span class="badge bg-danger rounded-pill ms-auto" style="font-size: 10px;"><?= $unreadNotifications ?></span>
                                <?php endif; ?>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form action="<?= ViewHelper::url('logout') ?>" method="POST" class="m-0">
                                <?= ViewHelper::csrfField() ?>
                                <button type="submit" class="dropdown-item rounded-3 py-2 text-danger d-flex align-items-center gap-2 small">
                                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Main Dynamic Viewport -->
        <main class="admin-content">
            <!-- Flash Alerts -->
            <?php
            $successMsg = Flash::get('success');
            $errorMsg = Flash::get('error');
            $infoMsg = Flash::get('info');
            ?>
            <!-- Floating Top-Right Flash Alert Toasts -->
            <?php if ($successMsg || $errorMsg || $infoMsg): ?>
                <div class="petguard-toast-container" id="petguardToastContainer">
                    <?php if ($successMsg): ?>
                        <div class="petguard-flash-toast flash-success" role="alert">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 18px;">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">Success</strong>
                                    <span class="text-muted small"><?= ViewHelper::e($successMsg) ?></span>
                                </div>
                            </div>
                            <button type="button" class="btn-close ms-2" onclick="this.closest('.petguard-flash-toast').remove()"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($errorMsg): ?>
                        <div class="petguard-flash-toast flash-danger" role="alert">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-danger-subtle text-danger d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 18px;">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">Notice</strong>
                                    <span class="text-muted small"><?= ViewHelper::e($errorMsg) ?></span>
                                </div>
                            </div>
                            <button type="button" class="btn-close ms-2" onclick="this.closest('.petguard-flash-toast').remove()"></button>
                        </div>
                    <?php endif; ?>
                    <?php if ($infoMsg): ?>
                        <div class="petguard-flash-toast flash-info" role="alert">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center flex-shrink-0" style="width: 38px; height: 38px; font-size: 18px;">
                                    <i class="fa-solid fa-circle-info"></i>
                                </div>
                                <div>
                                    <strong class="text-dark d-block">Information</strong>
                                    <span class="text-muted small"><?= ViewHelper::e($infoMsg) ?></span>
                                </div>
                            </div>
                            <button type="button" class="btn-close ms-2" onclick="this.closest('.petguard-flash-toast').remove()"></button>
                        </div>
                    <?php endif; ?>
                </div>
                <script>
                setTimeout(function() {
                    var container = document.getElementById('petguardToastContainer');
                    if (container) {
                        container.style.transition = 'opacity 0.4s ease';
                        container.style.opacity = '0';
                        setTimeout(function() { container.remove(); }, 400);
                    }
                }, 5000);
                </script>
            <?php endif; ?>

            <!-- Injected View Body -->
            <?= $content ?>
        </main>
    </div>

    <!-- Global Custom Feedback / Alert Modal -->
    <div class="modal fade" id="petGuardGlobalModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-4 border-0 shadow-lg p-2 text-center">
                <div class="modal-body p-4">
                    <div id="pgModalIconWrapper" class="rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 64px; height: 64px; font-size: 26px; background: #fff8e5;">
                        <i id="pgModalIcon" class="fa-solid fa-circle-check text-success"></i>
                    </div>
                    <h5 id="pgModalTitle" class="fw-bold text-dark mb-2">Notification</h5>
                    <p id="pgModalMessage" class="text-muted small mb-4">Message content here.</p>
                    <button type="button" class="btn btn-admin-primary w-100 rounded-pill py-2 fw-bold" data-bs-dismiss="modal" id="pgModalBtn">Got it</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Custom Delete Confirmation Modal -->
    <div class="modal fade" id="petGuardDeleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
            <div class="modal-content rounded-4 border-0 shadow-lg p-2 text-center">
                <div class="modal-body p-4">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center mx-auto mb-3 shadow-sm" style="width: 64px; height: 64px; font-size: 26px; background: #fef2f2; color: #ef4444;">
                        <i class="fa-regular fa-trash-can"></i>
                    </div>
                    <h5 id="pgDeleteModalTitle" class="fw-bold text-dark mb-2">Confirm Removal</h5>
                    <p id="pgDeleteModalMessage" class="text-muted small mb-4">Are you sure you want to delete this record? This action cannot be undone.</p>
                    <form id="pgDeleteModalForm" method="POST" action="">
                        <?= ViewHelper::csrfField() ?>
                        <input type="hidden" name="redirect" id="pgDeleteModalRedirect" value="">
                        <div class="d-flex gap-2 justify-content-center">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4 flex-grow-1" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger rounded-pill px-4 flex-grow-1 fw-bold"><i class="fa-solid fa-trash me-1"></i> Yes, Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts (Bootstrap with CDN fallback) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
    window.showPetGuardModal = function(title, message, iconType = 'success', btnText = 'Got it') {
        const modalEl = document.getElementById('petGuardGlobalModal');
        if (!modalEl) {
            console.log(title + ': ' + message);
            return;
        }
        
        document.getElementById('pgModalTitle').innerText = title;
        document.getElementById('pgModalMessage').innerText = message;
        document.getElementById('pgModalBtn').innerText = btnText;
        
        const iconEl = document.getElementById('pgModalIcon');
        const iconWrap = document.getElementById('pgModalIconWrapper');
        
        if (iconType === 'success') {
            iconEl.className = 'fa-solid fa-circle-check text-success';
            iconWrap.style.background = '#f0fdf4';
        } else if (iconType === 'error' || iconType === 'danger') {
            iconEl.className = 'fa-solid fa-triangle-exclamation text-danger';
            iconWrap.style.background = '#fef2f2';
        } else if (iconType === 'info') {
            iconEl.className = 'fa-solid fa-circle-info text-primary';
            iconWrap.style.background = '#eff6ff';
        } else if (iconType === 'copy') {
            iconEl.className = 'fa-solid fa-clipboard-check text-brand';
            iconWrap.style.background = '#fff8e5';
        }
        
        if (typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }
    };

    function togglePortalSidebar() {
        const sidebar = document.getElementById('portalSidebar');
        const backdrop = document.getElementById('portalBackdrop');
        if (sidebar && backdrop) {
            sidebar.classList.toggle('show');
            backdrop.classList.toggle('active');
            if (backdrop.classList.contains('active')) {
                backdrop.style.display = 'block';
                setTimeout(() => backdrop.style.opacity = '1', 10);
                document.body.style.overflow = 'hidden';
            } else {
                backdrop.style.opacity = '0';
                setTimeout(() => {
                    backdrop.style.display = 'none';
                    document.body.style.overflow = '';
                }, 300);
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const backdrop = document.getElementById('portalBackdrop');
        if (backdrop) {
            backdrop.addEventListener('click', togglePortalSidebar);
        }
        if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
        }

        // Global Custom Delete Confirmation Modal Trigger
        document.addEventListener('click', function(e) {
            const deleteBtn = e.target.closest('[data-confirm-delete]');
            if (deleteBtn) {
                e.preventDefault();
                e.stopPropagation();

                const action = deleteBtn.getAttribute('data-action') || (deleteBtn.form ? deleteBtn.form.action : '');
                const title = deleteBtn.getAttribute('data-title') || 'Confirm Removal';
                const message = deleteBtn.getAttribute('data-message') || 'Are you sure you want to permanently remove this item? This action cannot be undone.';
                const redirect = deleteBtn.getAttribute('data-redirect') || '';

                const form = document.getElementById('pgDeleteModalForm');
                const titleEl = document.getElementById('pgDeleteModalTitle');
                const msgEl = document.getElementById('pgDeleteModalMessage');
                const redirectEl = document.getElementById('pgDeleteModalRedirect');

                if (form && titleEl && msgEl) {
                    form.action = action;
                    titleEl.textContent = title;
                    msgEl.textContent = message;
                    if (redirectEl) redirectEl.value = redirect;

                    const modalEl = document.getElementById('petGuardDeleteConfirmModal');
                    if (modalEl && typeof bootstrap !== 'undefined') {
                        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                        modalInstance.show();
                    }
                }
            }
        });

        // PetGuard Super-Fast Live Search Controller (Strict Owner Privacy)
        const searchInput = document.getElementById('portalGlobalSearchInput');
        const searchSpinner = document.getElementById('portalGlobalSearchSpinner');
        const resultsContainer = document.getElementById('portalGlobalSearchResults');
        let debounceTimer = null;

        if (searchInput && resultsContainer) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                clearTimeout(debounceTimer);

                if (query.length < 2) {
                    resultsContainer.innerHTML = '';
                    resultsContainer.classList.add('d-none');
                    if (searchSpinner) searchSpinner.classList.add('d-none');
                    return;
                }

                if (searchSpinner) searchSpinner.classList.remove('d-none');

                debounceTimer = setTimeout(() => {
                    fetch('<?= ViewHelper::url("portal/api/search") ?>?q=' + encodeURIComponent(query))
                        .then(res => res.json())
                        .then(data => {
                            if (searchSpinner) searchSpinner.classList.add('d-none');
                            if (!data.success || !data.results || data.results.length === 0) {
                                resultsContainer.innerHTML = `
                                    <div class="p-3 text-center text-muted small">
                                        <i class="fa-solid fa-magnifying-glass mb-1 d-block text-brand fs-5"></i>
                                        No personal records found for "<strong>${escapeHtml(query)}</strong>"
                                    </div>`;
                                resultsContainer.classList.remove('d-none');
                                return;
                            }

                            // Group results by category
                            const groups = {};
                            data.results.forEach(item => {
                                if (!groups[item.category]) groups[item.category] = [];
                                groups[item.category].push(item);
                            });

                            let html = '';
                            for (const [category, items] of Object.entries(groups)) {
                                html += `<div class="portal-search-category-header">${escapeHtml(category)}</div>`;
                                items.forEach(item => {
                                    const avatarHtml = item.avatar ? 
                                        `<img src="${item.avatar}" class="rounded-3 border" style="width: 34px; height: 34px; object-fit: cover;">` :
                                        `<div class="portal-search-icon-wrap"><i class="${item.icon}"></i></div>`;
                                    
                                    html += `
                                        <a href="${item.url}" class="portal-search-item">
                                            ${avatarHtml}
                                            <div class="min-w-0 flex-grow-1">
                                                <div class="fw-bold text-dark text-truncate small">${escapeHtml(item.title)}</div>
                                                <div class="text-muted text-truncate" style="font-size: 11px;">${escapeHtml(item.subtitle)}</div>
                                            </div>
                                            <i class="fa-solid fa-chevron-right text-muted small ms-auto" style="font-size: 10px;"></i>
                                        </a>`;
                                });
                            }

                            resultsContainer.innerHTML = html;
                            resultsContainer.classList.remove('d-none');
                        })
                        .catch(err => {
                            if (searchSpinner) searchSpinner.classList.add('d-none');
                            console.error('Search error:', err);
                        });
                }, 150);
            });

            // Close on click outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !resultsContainer.contains(e.target)) {
                    resultsContainer.classList.add('d-none');
                }
            });

            // Escape key to close
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    resultsContainer.classList.add('d-none');
                }
            });
        }
    });
    </script>

    <!-- Mobile Bottom Quick Navigation Bar -->
    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav-grid">
            <?php if ($role === 'petowner'): ?>
                <a href="<?= ViewHelper::url('owner/dashboard') ?>" class="mobile-bottom-nav-item <?= $currentRoute === 'owner/dashboard' || $currentRoute === 'portal' ? 'active' : '' ?>">
                    <i class="fa-solid fa-gauge-high"></i>
                    <span>Dashboard</span>
                </a>
                <a href="<?= ViewHelper::url('portal/pets') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/pets') ? 'active' : '' ?>">
                    <i class="fa-solid fa-paw"></i>
                    <span>Pets</span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <i class="fa-solid fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/calls') ? 'active' : '' ?>">
                    <i class="fa-solid fa-video"></i>
                    <span>Calls</span>
                </a>
                <a href="<?= ViewHelper::url('portal/settings') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/settings') ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Account</span>
                </a>
            <?php elseif ($role === 'veterinarian'): ?>
                <a href="<?= ViewHelper::url('vet/dashboard') ?>" class="mobile-bottom-nav-item <?= $currentRoute === 'vet/dashboard' ? 'active' : '' ?>">
                    <i class="fa-solid fa-stethoscope"></i>
                    <span>Practice</span>
                </a>
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'vet/appointments') ? 'active' : '' ?>">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Queue</span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <i class="fa-solid fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="<?= ViewHelper::url('portal/calls') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/calls') ? 'active' : '' ?>">
                    <i class="fa-solid fa-video"></i>
                    <span>Calls</span>
                </a>
                <a href="<?= ViewHelper::url('vet/profile') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'vet/profile') ? 'active' : '' ?>">
                    <i class="fa-solid fa-user-doctor"></i>
                    <span>Profile</span>
                </a>
            <?php elseif ($role === 'shelter'): ?>
                <a href="<?= ViewHelper::url('shelter/dashboard') ?>" class="mobile-bottom-nav-item <?= $currentRoute === 'shelter/dashboard' ? 'active' : '' ?>">
                    <i class="fa-solid fa-house-medical"></i>
                    <span>Sanctuary</span>
                </a>
                <a href="<?= ViewHelper::url('shelter/animals') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'shelter/animals') ? 'active' : '' ?>">
                    <i class="fa-solid fa-paw"></i>
                    <span>Animals</span>
                </a>
                <a href="<?= ViewHelper::url('shelter/applications') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'shelter/applications') ? 'active' : '' ?>">
                    <i class="fa-solid fa-file-signature"></i>
                    <span>Adoptions</span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <i class="fa-solid fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="<?= ViewHelper::url('shelter/profile') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'shelter/profile') ? 'active' : '' ?>">
                    <i class="fa-solid fa-building-user"></i>
                    <span>Profile</span>
                </a>
            <?php elseif ($role === 'vendor'): ?>
                <a href="<?= ViewHelper::url('vendor/dashboard') ?>" class="mobile-bottom-nav-item <?= $currentRoute === 'vendor/dashboard' ? 'active' : '' ?>">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Store</span>
                </a>
                <a href="<?= ViewHelper::url('vendor/products') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'vendor/products') ? 'active' : '' ?>">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Catalog</span>
                </a>
                <a href="<?= ViewHelper::url('vendor/orders') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'vendor/orders') ? 'active' : '' ?>">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Orders</span>
                </a>
                <a href="<?= ViewHelper::url('portal/messages') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                    <i class="fa-solid fa-comments"></i>
                    <span>Messages</span>
                </a>
                <a href="<?= ViewHelper::url('vendor/store') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'vendor/store') ? 'active' : '' ?>">
                    <i class="fa-solid fa-store"></i>
                    <span>Shop</span>
                </a>
            <?php endif; ?>
        </div>
    </nav>

    <script src="<?= ViewHelper::asset('js/petguard.js') ?>?v=<?= time() ?>"></script>
</body>
</html>
