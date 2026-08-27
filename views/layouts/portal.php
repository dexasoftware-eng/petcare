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
if ($role === 'admin') {
    $pendingVetsCount = \Models\VeterinarianProfile::count("verification_status = 'pending'");
    $pendingSheltersCount = \Models\ShelterProfile::count("verification_status = 'pending'");
    $pendingAdoptionsCount = \Models\AdoptionApplication::count("status = 'submitted' OR status = 'under_review'");
    $openReportsCount = \Models\ModerationReport::count("status = 'pending'");
    $activeEmergenciesCount = \Models\EmergencyEvent::count("status = 'active' OR status = 'in_triage'");
    $totalAdminNotifications = $pendingVetsCount + $pendingSheltersCount + $pendingAdoptionsCount + $openReportsCount + $activeEmergenciesCount;
    $unreadNotifications = $totalAdminNotifications;
} else {
    $unreadNotifications = \Models\Notification::getUnreadCountForUser($role);
    $totalAdminNotifications = 0;
}
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&family=Inter:wght@400;500;600;700&family=DynaPuff:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- CSS Dependencies -->
    <link rel="stylesheet" type="text/css" href="<?= ViewHelper::asset('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/admin.css') ?>?v=<?= time() ?>">
    <link rel="stylesheet" href="<?= ViewHelper::asset('css/responsive-overhaul.css') ?>?v=<?= time() ?>">
    <style>
        .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            left: auto;
            z-index: 99999 !important;
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            border-radius: 16px !important;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.16), 0 4px 12px rgba(0, 0, 0, 0.06) !important;
        }
        .dropdown-menu.show {
            display: block !important;
            visibility: visible !important;
            opacity: 1 !important;
            pointer-events: auto !important;
        }
        .admin-brand-logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        .admin-brand-logo img {
            max-height: 40px;
            width: auto;
            object-fit: contain;
        }
    </style>
</head>
<body class="admin-body">

    <!-- Mobile Backdrop Overlay -->
    <div class="admin-sidebar-overlay" id="portalBackdrop"></div>

    <!-- Sidebar Navigation -->
    <aside class="admin-sidebar" id="portalSidebar">
        <!-- Brand Header with Official Website SVG Logo -->
        <div class="admin-brand-header">
            <a href="<?= ViewHelper::url($role === 'admin' ? 'admin/dashboard' : 'portal') ?>" class="admin-brand-logo">
                <img src="<?= ViewHelper::asset('img/logo.svg') ?>" alt="PetGuard Logo">
            </a>
            <button class="btn btn-sm btn-light d-lg-none" onclick="togglePortalSidebar()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Scroll Container -->
        <div class="admin-sidebar-scroll">
            <?php if ($role === 'admin'): ?>
                <!-- ADMIN COMPLETE NAVIGATION IN PORTAL -->
                <div class="admin-nav-section">Command Center</div>
                <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/dashboard') || $currentRoute === 'admin' ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard</span>
                    </span>
                </a>

                <div class="admin-nav-section">User Governance</div>
                <a href="<?= ViewHelper::url('admin/users') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/users') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-users"></i>
                        <span>Users & Owners</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/veterinarians') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Veterinarians</span>
                    </span>
                    <?php if (($pendingVetsCount ?? 0) > 0): ?>
                        <span class="admin-nav-badge badge-amber"><?= $pendingVetsCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= ViewHelper::url('admin/shelters') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/shelters') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-house-medical"></i>
                        <span>Rescue Shelters</span>
                    </span>
                    <?php if (($pendingSheltersCount ?? 0) > 0): ?>
                        <span class="admin-nav-badge badge-amber"><?= $pendingSheltersCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= ViewHelper::url('admin/vendors') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/vendors') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-store"></i>
                        <span>Product Vendors</span>
                    </span>
                </a>

                <div class="admin-nav-section">Pet Healthcare & Adoption</div>
                <a href="<?= ViewHelper::url('admin/pets') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/pets') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-paw"></i>
                        <span>Pets & Passports</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/adoption') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/adoption') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-heart"></i>
                        <span>Adoptions Hub</span>
                    </span>
                    <?php if (($pendingAdoptionsCount ?? 0) > 0): ?>
                        <span class="admin-nav-badge badge-amber"><?= $pendingAdoptionsCount ?></span>
                    <?php endif; ?>
                </a>

                <div class="admin-nav-section">Marketplace & Orders</div>
                <a href="<?= ViewHelper::url('admin/marketplace/products') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/marketplace/products') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-box-open"></i>
                        <span>Products Catalog</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/marketplace/inventory') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/marketplace/inventory') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-warehouse"></i>
                        <span>Stock & Inventory</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/marketplace/orders') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/marketplace/orders') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <span>Customer Orders</span>
                    </span>
                </a>

                <div class="admin-nav-section">Communication & Telehealth</div>
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

                <div class="admin-nav-section">Content & Moderation</div>
                <a href="<?= ViewHelper::url('admin/content') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/content') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-newspaper"></i>
                        <span>Care Articles & FAQs</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/moderation') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/moderation') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-shield-halved"></i>
                        <span>Moderation & Reports</span>
                    </span>
                    <?php if (($openReportsCount ?? 0) > 0): ?>
                        <span class="admin-nav-badge badge-red"><?= $openReportsCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= ViewHelper::url('admin/notifications') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/notifications') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-bullhorn"></i>
                        <span>Broadcast Engine</span>
                    </span>
                </a>

                <div class="admin-nav-section">Intelligence & Safety</div>
                <a href="<?= ViewHelper::url('admin/emergency') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/emergency') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-truck-medical text-danger"></i>
                        <span>Emergency Center</span>
                    </span>
                    <?php if (($activeEmergenciesCount ?? 0) > 0): ?>
                        <span class="admin-nav-badge badge-red"><?= $activeEmergenciesCount ?></span>
                    <?php endif; ?>
                </a>
                <a href="<?= ViewHelper::url('admin/ai') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/ai') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-brain text-purple"></i>
                        <span>AI & Intelligence</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/reports') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/reports') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Reports & Analytics</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/security') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/security') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-lock"></i>
                        <span>Audit Logs & Security</span>
                    </span>
                </a>
                <a href="<?= ViewHelper::url('admin/settings') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/settings') ? 'active' : '' ?>">
                    <span class="admin-nav-link-content">
                        <i class="fa-solid fa-gear"></i>
                        <span>Platform Settings</span>
                    </span>
                </a>

            <?php elseif ($role === 'petowner'): ?>
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
        
        <!-- Sticky Topbar -->
        <header class="admin-topbar">
            <!-- Left: Mobile Menu Toggle + Mobile Brand Logo + Desktop Search -->
            <div class="d-flex align-items-center gap-2 flex-grow-1 min-w-0" style="max-width: 520px;">
                <button class="btn btn-light d-lg-none rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;" onclick="togglePortalSidebar()" title="Toggle Navigation">
                    <i class="fa-solid fa-bars fs-6"></i>
                </button>
                
                <!-- Mobile Brand Badge with Official SVG Logo (Visible on <992px) -->
                <a href="<?= ViewHelper::url($role === 'admin' ? 'admin/dashboard' : 'portal') ?>" class="d-flex d-lg-none align-items-center text-decoration-none flex-shrink-0">
                    <img src="<?= ViewHelper::asset('img/logo.svg') ?>" style="height: 32px; width: auto; object-fit: contain;" alt="PetGuard">
                </a>

                <!-- Desktop Search Input (Visible on >=768px) -->
                <div class="admin-topbar-search position-relative w-100 d-none d-md-block">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="portalGlobalSearchInput" placeholder="Search records, appointments..." autocomplete="off">
                </div>
            </div>

            <!-- Right: Role Badges, Notification Bell, User Menu -->
            <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">

                <!-- Notifications Dropdown -->
                <div class="position-relative">
                    <button class="btn btn-light rounded-circle position-relative d-flex align-items-center justify-content-center shadow-sm flex-shrink-0 border-0" style="width: 40px; height: 40px;" id="portalNotificationBtn" onclick="event.stopPropagation(); toggleCustomDropdown('portalNotificationMenu')" title="Notifications">
                        <i class="fa-solid fa-bell text-secondary"></i>
                        <?php if ($unreadNotifications > 0): ?>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 3px 6px;">
                                <?= $unreadNotifications ?>
                            </span>
                        <?php endif; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end shadow border rounded-4 p-0 mt-2" id="portalNotificationMenu" style="min-width: 300px; max-width: 340px;">
                        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light rounded-top-4">
                            <h6 class="mb-0 fw-bold text-dark"><i class="fa-solid fa-bell text-primary me-2"></i> Notifications</h6>
                            <span class="badge bg-danger rounded-pill"><?= $unreadNotifications ?> Alerts</span>
                        </div>
                        <div class="p-3 text-center text-muted small">
                            <?php if ($unreadNotifications > 0): ?>
                                <p class="mb-2">You have <?= $unreadNotifications ?> operational queue items awaiting attention.</p>
                            <?php else: ?>
                                <i class="fa-solid fa-circle-check text-success fs-4 d-block mb-1"></i>
                                <p class="mb-0">You're all caught up!</p>
                            <?php endif; ?>
                        </div>
                        <div class="p-2 border-top bg-light text-center rounded-bottom-4">
                            <a href="<?= ViewHelper::url($role === 'admin' ? 'admin/notifications' : 'portal/notifications') ?>" class="text-decoration-none small fw-bold text-brand">View All Notifications &rarr;</a>
                        </div>
                    </div>
                </div>

                <!-- User Profile Dropdown Menu -->
                <div class="position-relative">
                    <button class="btn admin-user-menu p-1 border-0 bg-transparent text-start d-flex align-items-center gap-2 shadow-none" type="button" id="portalUserDropdownBtn" onclick="event.stopPropagation(); toggleCustomDropdown('portalUserMenu')">
                        <div class="admin-avatar-pill shadow-sm" style="width: 38px; height: 38px; font-size: 14px; background: linear-gradient(135deg, #fa441d 0%, #1e293b 100%);">
                            <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
                        </div>
                        <div class="d-none d-lg-block text-start">
                            <div class="fw-bold fs-6 text-dark lh-1"><?= ViewHelper::e($user['name'] ?? 'User') ?></div>
                            <small class="text-muted fw-semibold" style="font-size: 11px;"><?= $role === 'admin' ? 'Super Admin' : ucfirst($role) ?></small>
                        </div>
                        <i class="fa-solid fa-caret-down text-muted small ms-1"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border rounded-4 p-2 mt-2" id="portalUserMenu" style="min-width: 220px;">
                        <li class="px-3 py-2 border-bottom mb-1">
                            <div class="fw-bold text-dark"><?= ViewHelper::e($user['name'] ?? 'User') ?></div>
                            <small class="text-muted d-block mb-1"><?= ViewHelper::e($user['email'] ?? '') ?></small>
                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle" style="font-size: 10px;"><?= $role === 'admin' ? 'Super Admin' : ucfirst($role) ?></span>
                        </li>
                        <?php if ($role === 'admin'): ?>
                            <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('admin/dashboard') ?>"><i class="fa-solid fa-gauge-high text-muted"></i> Command Center</a></li>
                            <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('admin/settings') ?>"><i class="fa-solid fa-gear text-muted"></i> Platform Settings</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('portal/settings') ?>"><i class="fa-solid fa-gear text-muted"></i> Account Settings</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('our-products') ?>"><i class="fa-solid fa-store text-muted"></i> Switch to Store</a></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <form action="<?= ViewHelper::url('logout') ?>" method="POST" class="m-0">
                                <?= ViewHelper::csrfField() ?>
                                <button type="submit" class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 text-danger small">
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
            <?php View::partial('alerts'); ?>

            <!-- Injected View Body -->
            <?= $content ?>
        </main>
    </div>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= ViewHelper::asset('js/petguard.js') ?>?v=<?= time() ?>"></script>
    <script>
        function togglePortalSidebar() {
            var sidebar = document.getElementById('portalSidebar');
            var backdrop = document.getElementById('portalBackdrop');
            if (sidebar && backdrop) {
                sidebar.classList.toggle('show');
                backdrop.classList.toggle('active');
                if (backdrop.classList.contains('active')) {
                    backdrop.style.display = 'block';
                    setTimeout(function() { backdrop.style.opacity = '1'; }, 10);
                    document.body.style.overflow = 'hidden';
                } else {
                    backdrop.style.opacity = '0';
                    setTimeout(function() {
                        backdrop.style.display = 'none';
                        document.body.style.overflow = '';
                    }, 300);
                }
            }
        }

        function toggleCustomDropdown(menuId) {
            var menu = document.getElementById(menuId);
            if (!menu) return;
            var isShown = menu.classList.contains('show');
            
            // Close all dropdowns
            document.querySelectorAll('.dropdown-menu.show').forEach(function(el) {
                el.classList.remove('show');
            });

            if (!isShown) {
                menu.classList.add('show');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var backdrop = document.getElementById('portalBackdrop');
            if (backdrop) {
                backdrop.addEventListener('click', togglePortalSidebar);
            }

            // Close dropdowns on outside click
            document.addEventListener('click', function(e) {
                if (!e.target.closest('.dropdown-menu') && !e.target.closest('#portalNotificationBtn') && !e.target.closest('#portalUserDropdownBtn')) {
                    document.querySelectorAll('.dropdown-menu.show').forEach(function(m) {
                        m.classList.remove('show');
                    });
                }
            });
        });
    </script>
</body>
</html>
