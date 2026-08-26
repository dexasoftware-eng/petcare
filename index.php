<?php
/**
 * PetGuard — PHP MVC Application Front Controller
 */

declare(strict_types=1);

require_once __DIR__ . '/core/App.php';

use Core\App;
use Controllers\HomeController;
use Controllers\AuthController;
use Controllers\ShopController;
use Controllers\CartController;
use Controllers\CheckoutController;
use Controllers\BlogController;
use Controllers\ServiceController;
use Controllers\TeamController;
use Controllers\ContactController;
use Controllers\PortalController;
use Controllers\ApiController;
use Middleware\AuthMiddleware;
use Middleware\GuestMiddleware;
use Middleware\CsrfMiddleware;

$app = new App(__DIR__);
$router = $app->getRouter();

// ==========================================
// 1. PUBLIC MARKETING & WEBSITE ROUTES
// ==========================================
$router->get('/', [HomeController::class, 'index']);
$router->get('/index.html', [HomeController::class, 'index']);
$router->get('/about', [HomeController::class, 'about']);
$router->get('/about.html', [HomeController::class, 'about']);
$router->get('/how-we-works', [HomeController::class, 'howWeWork']);
$router->get('/how-we-works.html', [HomeController::class, 'howWeWork']);
$router->get('/history', [HomeController::class, 'history']);
$router->get('/history.html', [HomeController::class, 'history']);
$router->get('/pricing-packages', [HomeController::class, 'pricing']);
$router->get('/pricing-packages.html', [HomeController::class, 'pricing']);
$router->get('/photo-gallery', [HomeController::class, 'gallery']);
$router->get('/photo-gallery.html', [HomeController::class, 'gallery']);

// Services
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services.html', [ServiceController::class, 'index']);
$router->get('/service-details/:slug', [ServiceController::class, 'details']);

// Contact & Inquiries
$router->get('/contact', [ContactController::class, 'show']);
$router->get('/contact.html', [ContactController::class, 'show']);
$router->post('/contact', [ContactController::class, 'submit'], [CsrfMiddleware::class]);

// Team Details
$router->get('/team-details/:id', [TeamController::class, 'details']);
$router->get('/team-details', [TeamController::class, 'details']);

// ==========================================
// 2. SHOP & E-COMMERCE ROUTES
// ==========================================
$router->get('/our-products', [ShopController::class, 'index']);
$router->get('/our-products.html', [ShopController::class, 'index']);
$router->get('/product-details/:slug', [ShopController::class, 'details']);
$router->get('/shop-cart', [CartController::class, 'index']);
$router->get('/shop-cart.html', [CartController::class, 'index']);
$router->post('/cart/add', [CartController::class, 'add'], [CsrfMiddleware::class]);
$router->post('/cart/update', [CartController::class, 'update'], [CsrfMiddleware::class]);
$router->get('/cart/remove/:id', [CartController::class, 'remove']);
$router->get('/cart/clear', [CartController::class, 'clear']);
$router->get('/cart-checkout', [CheckoutController::class, 'index']);
$router->get('/cart-checkout.html', [CheckoutController::class, 'index']);
$router->post('/cart-checkout', [CheckoutController::class, 'process'], [CsrfMiddleware::class]);
$router->get('/order-success/:orderNumber', [CheckoutController::class, 'success']);

// ==========================================
// 3. BLOG & ARTICLES ROUTES
// ==========================================
$router->get('/our-blog', [BlogController::class, 'index']);
$router->get('/our-blog.html', [BlogController::class, 'index']);
$router->get('/blog/:slug', [BlogController::class, 'details']);
$router->post('/blog/:slug/comment', [BlogController::class, 'addComment'], [CsrfMiddleware::class]);

// ==========================================
// 4. AUTHENTICATION ROUTES (GUESTS ONLY)
// ==========================================
$router->get('/login', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
$router->get('/login.html', [AuthController::class, 'showLogin'], [GuestMiddleware::class]);
$router->post('/login', [AuthController::class, 'login'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/register/owner', [AuthController::class, 'showOwnerRegister'], [GuestMiddleware::class]);
$router->post('/register/owner', [AuthController::class, 'registerOwner'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/register/veterinarian', [AuthController::class, 'showVetRegister'], [GuestMiddleware::class]);
$router->post('/register/veterinarian', [AuthController::class, 'registerVet'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/register/shelter', [AuthController::class, 'showShelterRegister'], [GuestMiddleware::class]);
$router->post('/register/shelter', [AuthController::class, 'registerShelter'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/verify-email', [AuthController::class, 'showVerifyEmail']);
$router->post('/verify-email', [AuthController::class, 'verifyEmail'], [CsrfMiddleware::class]);

$router->get('/forgot-password', [AuthController::class, 'showForgotPassword'], [GuestMiddleware::class]);
$router->post('/forgot-password', [AuthController::class, 'sendResetLink'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/reset-password', [AuthController::class, 'showResetPassword'], [GuestMiddleware::class]);
$router->post('/reset-password', [AuthController::class, 'resetPassword'], [GuestMiddleware::class, CsrfMiddleware::class]);

// Logout (Authenticated users)
$router->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ==========================================
// 5. SIMPLE UNIFIED PORTAL & DASHBOARD
// ==========================================
$router->get('/portal', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/portal/overview', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/owner/dashboard', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/veterinarian/dashboard', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/shelter/dashboard', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/admin/dashboard', [PortalController::class, 'index'], [AuthMiddleware::class]);

// Portal actions
$router->post('/portal/pets/create', [PortalController::class, 'createPet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/pets/:id/delete', [PortalController::class, 'deletePet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/appointments/book', [PortalController::class, 'bookAppointment'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/appointments/:id/status', [PortalController::class, 'updateAppointmentStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/create', [PortalController::class, 'createRescuePet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/:id/status', [PortalController::class, 'updateAdoptionStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/:id/delete', [PortalController::class, 'deleteRescuePet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/governance/users/:id/status', [PortalController::class, 'updateUserStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/governance/inquiries/:id/status', [PortalController::class, 'resolveInquiry'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ==========================================
// 6. DATABASE MIGRATION RUNNER
// ==========================================
$router->get('/migrate', function ($req, $res) {
    $db = Core\Database::getInstance();
    $runner = new Core\MigrationRunner($db, __DIR__ . '/migrations');
    $results = $runner->applyMigrations();
    
    echo "<!DOCTYPE html><html><head><title>Database Migrations — PetGuard</title><link rel='stylesheet' href='assets/css/bootstrap.min.css'></head><body class='bg-light p-5'><div class='container max-w-lg bg-white p-5 rounded-4 shadow-sm'><h2>🐾 PetGuard Database Migrations</h2><hr><ul class='list-group my-4'>";
    foreach ($results as $msg) {
        echo "<li class='list-group-item'>" . htmlspecialchars($msg) . "</li>";
    }
    echo "</ul><a href='index.php' class='btn btn-dark rounded-pill px-4'>Go to Home</a></div></body></html>";
    exit;
});

// ==========================================
// 7. REST API ENDPOINTS
// ==========================================
$router->get('/api/v1/health', [ApiController::class, 'health']);
$router->get('/api/v1/stats', [ApiController::class, 'stats']);
$router->get('/api/v1/products', [ApiController::class, 'products']);
$router->get('/api/v1/services', [ApiController::class, 'services']);
$router->get('/api/v1/pets', [ApiController::class, 'pets']);

// Run application
$app->run();
