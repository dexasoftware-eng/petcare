<?php
use Helpers\ViewHelper;
use Helpers\Auth;
use Helpers\Flash;
use Core\View;

$user = Auth::user() ?? [];
$currentPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
$currentRoute = ltrim(str_replace('/petcaretw', '', $currentPath), '/');

// Fetch real-time badge counts from DB
$pendingVetsCount = \Models\VeterinarianProfile::count("verification_status = 'pending'");
$pendingSheltersCount = \Models\ShelterProfile::count("verification_status = 'pending'");
$pendingAdoptionsCount = \Models\AdoptionApplication::count("status = 'submitted' OR status = 'under_review'");
$openReportsCount = \Models\ModerationReport::count("status = 'pending'");
$activeEmergenciesCount = \Models\EmergencyEvent::count("status = 'active' OR status = 'in_triage'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?= ViewHelper::csrfToken() ?>">
    <title><?= ViewHelper::e($pageTitle ?? 'Admin Command Center — PetGuard') ?></title>
    <link rel="icon" href="<?= ViewHelper::asset('img/heading-img.png') ?>">
    <script>window.PetGuardCsrf = '<?= ViewHelper::csrfToken() ?>';</script>

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

    <!-- Admin Mobile Backdrop Overlay -->
    <div class="admin-sidebar-overlay" id="adminBackdrop"></div>

    <!-- Admin Sidebar Navigation -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Brand Header -->
        <div class="admin-brand-header">
            <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="admin-brand-logo">
                <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="PetGuard Logo">
                <h1 class="admin-brand-title">Pet<span>Guard</span></h1>
            </a>
            <button class="btn btn-sm btn-light d-lg-none" onclick="toggleAdminSidebar()">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Scroll Container -->
        <div class="admin-sidebar-scroll">
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
                <?php if ($pendingVetsCount > 0): ?>
                    <span class="admin-nav-badge badge-amber"><?= $pendingVetsCount ?></span>
                <?php endif; ?>
            </a>
            <a href="<?= ViewHelper::url('admin/shelters') ?>" class="admin-nav-link <?= str_starts_with($currentRoute, 'admin/shelters') ? 'active' : '' ?>">
                <span class="admin-nav-link-content">
                    <i class="fa-solid fa-house-medical"></i>
                    <span>Rescue Shelters</span>
                </span>
                <?php if ($pendingSheltersCount > 0): ?>
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
                <?php if ($pendingAdoptionsCount > 0): ?>
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
                <?php if ($openReportsCount > 0): ?>
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
                <?php if ($activeEmergenciesCount > 0): ?>
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

    <!-- Main Admin Container -->
    <div class="admin-main-wrap">
        
        <!-- Sticky Topbar (Perfect on all 5 screens, enhanced mobile header) -->
        <header class="admin-topbar">
            <!-- Left: Mobile Menu Toggle + Mobile Brand Logo + Desktop Search -->
            <div class="d-flex align-items-center gap-2 flex-grow-1 min-w-0" style="max-width: 520px;">
                <button class="btn btn-light d-lg-none rounded-circle flex-shrink-0 d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px;" onclick="toggleAdminSidebar()" title="Toggle Navigation">
                    <i class="fa-solid fa-bars fs-6"></i>
                </button>

                <!-- Mobile Brand Badge (Visible on <992px) -->
                <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="d-flex d-lg-none align-items-center gap-2 text-decoration-none flex-shrink-0">
                    <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" style="width: 28px; height: 28px; object-fit: contain;" alt="PetGuard">
                    <span class="fw-bold text-dark d-none d-sm-inline" style="font-family: 'DynaPuff', cursive; font-size: 16px; letter-spacing: -0.3px;">Pet<span class="text-brand">Guard</span></span>
                </a>

                <!-- Desktop Search Input (Visible on >=768px) -->
                <div class="admin-topbar-search d-none d-md-block w-100">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Global search users, shelters, pets, audits..." onkeyup="handleGlobalSearch(this.value)">
                </div>
            </div>

            <!-- Right: Notification Bell, User Menu -->
            <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
                <!-- Notification Bell Icon -->
                <a href="<?= ViewHelper::url('admin/notifications') ?>" class="btn btn-light rounded-circle position-relative d-flex align-items-center justify-content-center shadow-sm flex-shrink-0" style="width: 40px; height: 40px;" title="Broadcast & Notifications">
                    <i class="fa-regular fa-bell text-secondary"></i>
                    <?php if (($openReportsCount ?? 0) > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 9px; padding: 3px 6px;">
                            <?= $openReportsCount ?>
                        </span>
                    <?php endif; ?>
                </a>

                <!-- Admin Profile Dropdown Menu -->
                <div class="dropdown">
                    <button class="btn admin-user-menu p-1 border-0 bg-transparent dropdown-toggle text-start d-flex align-items-center gap-2 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="admin-avatar-pill shadow-sm" style="width: 38px; height: 38px; font-size: 14px; background: linear-gradient(135deg, #fa441d 0%, #1e293b 100%);">
                            <?= strtoupper(substr($user['name'] ?? 'A', 0, 1)) ?>
                        </div>
                        <div class="d-none d-lg-block text-start">
                            <div class="fw-bold fs-6 text-dark lh-1"><?= ViewHelper::e($user['name'] ?? 'Administrator') ?></div>
                            <small class="text-muted fw-semibold" style="font-size: 11px;">Super Admin</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border rounded-4 p-2 mt-2" style="min-width: 220px;">
                        <li class="px-3 py-2 border-bottom mb-1 d-lg-none">
                            <div class="fw-bold text-dark"><?= ViewHelper::e($user['name'] ?? 'Administrator') ?></div>
                            <small class="badge bg-danger-subtle text-danger border border-danger-subtle">Super Admin</small>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('admin/settings') ?>">
                                <i class="fa-solid fa-sliders text-muted"></i> Platform Settings
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item rounded-3 py-2 d-flex align-items-center gap-2 small" href="<?= ViewHelper::url('admin/security') ?>">
                                <i class="fa-solid fa-shield-halved text-muted"></i> Audit Logs & Security
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
            <?php View::partial('alerts'); ?>

            <!-- Injected View Body -->
            <?= $content ?>
        </main>
    </div>

    <!-- Reusable Confirmation Action Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="confirmModalTitle">Confirm Action</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="text-muted mb-0" id="confirmModalMessage">Are you sure you want to proceed with this administrative action?</p>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <form id="confirmModalForm" action="" method="POST">
                        <?= ViewHelper::csrfField() ?>
                        <input type="hidden" name="action_param" id="confirmModalParam" value="">
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-semibold" id="confirmModalBtn">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="<?= ViewHelper::asset('js/jquery-3.6.0.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?= ViewHelper::asset('js/bootstrap.bundle.min.js') ?>"></script>
    <script>
        function toggleAdminSidebar() {
            var sidebar = document.getElementById('adminSidebar');
            var backdrop = document.getElementById('adminBackdrop');
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

        document.addEventListener('DOMContentLoaded', function() {
            var backdrop = document.getElementById('adminBackdrop');
            if (backdrop) {
                backdrop.addEventListener('click', toggleAdminSidebar);
            }
        });

        function triggerConfirmModal(actionUrl, title, message, btnText = 'Confirm', btnClass = 'btn-danger', paramValue = '') {
            document.getElementById('confirmModalForm').action = actionUrl;
            document.getElementById('confirmModalTitle').textContent = title;
            document.getElementById('confirmModalMessage').textContent = message;
            document.getElementById('confirmModalParam').value = paramValue;
            var btn = document.getElementById('confirmModalBtn');
            btn.textContent = btnText;
            btn.className = 'btn ' + btnClass + ' rounded-pill px-4 fw-semibold';
            var modal = new bootstrap.Modal(document.getElementById('confirmationModal'));
            modal.show();
        }

        function handleGlobalSearch(query) {
            // Client side quick table search if data table exists
            var filter = query.toLowerCase();
            document.querySelectorAll('.admin-table tbody tr').forEach(function(row) {
                var text = row.textContent.toLowerCase();
                row.style.display = text.indexOf(filter) > -1 ? '' : 'none';
            });
        }
    </script>

    <!-- Mobile Bottom Quick Navigation Bar for Admin -->
    <nav class="mobile-bottom-nav">
        <div class="mobile-bottom-nav-grid">
            <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="mobile-bottom-nav-item <?= $currentRoute === 'admin/dashboard' || $currentRoute === 'admin' ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Command</span>
            </a>
            <a href="<?= ViewHelper::url('admin/users') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'admin/users') ? 'active' : '' ?>">
                <i class="fa-solid fa-users-gear"></i>
                <span>Users</span>
            </a>
            <a href="<?= ViewHelper::url('admin/marketplace/orders') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'admin/marketplace/orders') ? 'active' : '' ?>">
                <i class="fa-solid fa-cart-shopping"></i>
                <span>Orders</span>
            </a>
            <a href="<?= ViewHelper::url('portal/messages') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'portal/messages') ? 'active' : '' ?>">
                <i class="fa-solid fa-comments"></i>
                <span>Messages</span>
            </a>
            <a href="<?= ViewHelper::url('admin/settings') ?>" class="mobile-bottom-nav-item <?= str_starts_with($currentRoute, 'admin/settings') ? 'active' : '' ?>">
                <i class="fa-solid fa-gears"></i>
                <span>Config</span>
            </a>
        </div>
    </nav>

    <script src="<?= ViewHelper::asset('js/petguard.js') ?>?v=<?= time() ?>"></script>
</body>
</html>
