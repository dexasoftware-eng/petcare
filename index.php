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
use Controllers\OwnerPortalController;
use Controllers\VetPortalController;
use Controllers\ShelterPortalController;
use Controllers\VendorPortalController;
use Controllers\CallController;
use Controllers\MessageController;
use Controllers\AdminController;
use Controllers\ApiController;
use Middleware\AuthMiddleware;
use Middleware\AdminMiddleware;
use Middleware\VendorMiddleware;
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

$router->get('/register/vendor', [AuthController::class, 'showVendorRegister'], [GuestMiddleware::class]);
$router->post('/register/vendor', [AuthController::class, 'registerVendor'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/forgot-password', [AuthController::class, 'showForgotPassword'], [GuestMiddleware::class]);
$router->post('/forgot-password', [AuthController::class, 'forgotPassword'], [GuestMiddleware::class, CsrfMiddleware::class]);

$router->get('/reset-password', [AuthController::class, 'showResetPassword'], [GuestMiddleware::class]);
$router->post('/reset-password', [AuthController::class, 'resetPassword'], [GuestMiddleware::class, CsrfMiddleware::class]);

// Logout (Authenticated users)
$router->post('/logout', [AuthController::class, 'logout'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ==========================================
// 5. UNIFIED PORTAL & MULTI-ROLE DISPATCHER
// ==========================================
$router->get('/portal', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/portal/overview', [PortalController::class, 'index'], [AuthMiddleware::class]);
$router->get('/owner/dashboard', [OwnerPortalController::class, 'dashboard'], [AuthMiddleware::class]);
$router->get('/veterinarian/dashboard', [VetPortalController::class, 'dashboard'], [AuthMiddleware::class]);
$router->get('/shelter/dashboard', [ShelterPortalController::class, 'dashboard'], [AuthMiddleware::class]);
$router->get('/vendor/dashboard', [VendorPortalController::class, 'dashboard'], [AuthMiddleware::class]);

// Communication: WebRTC Calling & Messaging Endpoints
$router->post('/call/request', [CallController::class, 'requestCall'], [AuthMiddleware::class]);
$router->get('/call/check-incoming', [CallController::class, 'checkIncoming'], [AuthMiddleware::class]);
$router->post('/call/:token/accept', [CallController::class, 'acceptCall'], [AuthMiddleware::class]);
$router->post('/call/:token/decline', [CallController::class, 'declineCall'], [AuthMiddleware::class]);
$router->post('/call/:token/end', [CallController::class, 'endCall'], [AuthMiddleware::class]);
$router->post('/call/:token/signal', [CallController::class, 'signal'], [AuthMiddleware::class]);
$router->get('/call/:token/poll-signal', [CallController::class, 'pollSignal'], [AuthMiddleware::class]);
$router->get('/call/room/:token', [CallController::class, 'room'], [AuthMiddleware::class]);
$router->get('/portal/calls', [CallController::class, 'history'], [AuthMiddleware::class]);

// Route Aliases for seamless sub-path AJAX calls
$router->post('/portal/call/request', [CallController::class, 'requestCall'], [AuthMiddleware::class]);
$router->get('/portal/call/check-incoming', [CallController::class, 'checkIncoming'], [AuthMiddleware::class]);
$router->post('/portal/call/:token/accept', [CallController::class, 'acceptCall'], [AuthMiddleware::class]);
$router->post('/portal/call/:token/decline', [CallController::class, 'declineCall'], [AuthMiddleware::class]);
$router->post('/portal/call/:token/end', [CallController::class, 'endCall'], [AuthMiddleware::class]);
$router->post('/portal/call/:token/signal', [CallController::class, 'signal'], [AuthMiddleware::class]);
$router->post('/call/:token/timeout', [CallController::class, 'timeoutCall'], [AuthMiddleware::class]);
$router->post('/portal/call/:token/timeout', [CallController::class, 'timeoutCall'], [AuthMiddleware::class]);
$router->get('/portal/call/:token/poll-signal', [CallController::class, 'pollSignal'], [AuthMiddleware::class]);
$router->get('/portal/call/room/:token', [CallController::class, 'room'], [AuthMiddleware::class]);

$router->get('/portal/messages', [MessageController::class, 'index'], [AuthMiddleware::class]);
$router->get('/messages/conversation/:id', [MessageController::class, 'conversation'], [AuthMiddleware::class]);
$router->post('/messages/send', [MessageController::class, 'send'], [AuthMiddleware::class]);
$router->post('/messages/start', [MessageController::class, 'start'], [AuthMiddleware::class]);
$router->get('/messages/unread-count', [MessageController::class, 'unreadCount'], [AuthMiddleware::class]);

// Route Aliases for /portal/messages sub-paths
$router->get('/portal/messages/conversation/:id', [MessageController::class, 'conversation'], [AuthMiddleware::class]);
$router->post('/portal/messages/send', [MessageController::class, 'send'], [AuthMiddleware::class]);
$router->post('/portal/messages/start', [MessageController::class, 'start'], [AuthMiddleware::class]);
$router->get('/portal/messages/unread-count', [MessageController::class, 'unreadCount'], [AuthMiddleware::class]);

// ==========================================
// 6. VETERINARIAN PORTAL ROUTES
// ==========================================
$vetGuards = [AuthMiddleware::class];
$vetActionGuards = [AuthMiddleware::class, CsrfMiddleware::class];

$router->get('/vet/dashboard', [VetPortalController::class, 'dashboard'], $vetGuards);
$router->get('/vet/profile', [VetPortalController::class, 'profile'], $vetGuards);
$router->post('/vet/profile/edit', [VetPortalController::class, 'updateProfile'], $vetActionGuards);
$router->get('/vet/services', [VetPortalController::class, 'services'], $vetGuards);
$router->post('/vet/services', [VetPortalController::class, 'saveService'], $vetActionGuards);
$router->post('/vet/services/:id/delete', [VetPortalController::class, 'deleteService'], $vetGuards);
$router->get('/vet/availability', [VetPortalController::class, 'availability'], $vetGuards);
$router->post('/vet/availability', [VetPortalController::class, 'updateAvailability'], $vetActionGuards);
$router->get('/vet/appointments', [VetPortalController::class, 'appointments'], $vetGuards);
$router->get('/vet/appointments/:id', [VetPortalController::class, 'appointmentDetails'], $vetGuards);
$router->post('/vet/appointments/:id/status', [VetPortalController::class, 'updateAppointmentStatus'], $vetGuards);
$router->get('/vet/patients', [VetPortalController::class, 'patients'], $vetGuards);
$router->get('/vet/patients/:id', [VetPortalController::class, 'patientDetails'], $vetGuards);
$router->post('/vet/consultations/create', [VetPortalController::class, 'createConsultation'], $vetActionGuards);
$router->get('/vet/reviews', [VetPortalController::class, 'reviews'], $vetGuards);

// ==========================================
// 7. PET SHELTER PORTAL ROUTES
// ==========================================
$shelterGuards = [AuthMiddleware::class];
$shelterActionGuards = [AuthMiddleware::class, CsrfMiddleware::class];

$router->get('/shelter/dashboard', [ShelterPortalController::class, 'dashboard'], $shelterGuards);
$router->get('/shelter/profile', [ShelterPortalController::class, 'profile'], $shelterGuards);
$router->post('/shelter/profile/edit', [ShelterPortalController::class, 'updateProfile'], $shelterActionGuards);
$router->get('/shelter/animals', [ShelterPortalController::class, 'animals'], $shelterGuards);
$router->get('/shelter/animals/create', [ShelterPortalController::class, 'createAnimalView'], $shelterGuards);
$router->post('/shelter/animals/create', [ShelterPortalController::class, 'createAnimal'], $shelterActionGuards);
$router->get('/shelter/animals/:id', [ShelterPortalController::class, 'animalDetails'], $shelterGuards);
$router->get('/shelter/animals/:id/edit', [ShelterPortalController::class, 'editAnimalView'], $shelterGuards);
$router->post('/shelter/animals/:id/edit', [ShelterPortalController::class, 'updateAnimal'], $shelterActionGuards);
$router->post('/shelter/animals/:id/delete', [ShelterPortalController::class, 'deleteAnimal'], $shelterGuards);
$router->get('/shelter/applications', [ShelterPortalController::class, 'applications'], $shelterGuards);
$router->get('/shelter/applications/:id', [ShelterPortalController::class, 'applicationDetails'], $shelterGuards);
$router->post('/shelter/applications/:id/status', [ShelterPortalController::class, 'updateApplicationStatus'], $shelterActionGuards);
$router->get('/shelter/interviews', [ShelterPortalController::class, 'interviews'], $shelterGuards);

// ==========================================
// 8. VENDOR STORE PORTAL ROUTES
// ==========================================
$vendorGuards = [AuthMiddleware::class, VendorMiddleware::class];
$vendorActionGuards = [AuthMiddleware::class, VendorMiddleware::class, CsrfMiddleware::class];

$router->get('/vendor/dashboard', [VendorPortalController::class, 'dashboard'], $vendorGuards);
$router->get('/vendor/store', [VendorPortalController::class, 'store'], $vendorGuards);
$router->post('/vendor/store/edit', [VendorPortalController::class, 'updateStore'], $vendorActionGuards);
$router->get('/vendor/products', [VendorPortalController::class, 'products'], $vendorGuards);
$router->get('/vendor/products/create', [VendorPortalController::class, 'createProductView'], $vendorGuards);
$router->post('/vendor/products/create', [VendorPortalController::class, 'createProduct'], $vendorActionGuards);
$router->get('/vendor/products/:id', [VendorPortalController::class, 'productDetails'], $vendorGuards);
$router->get('/vendor/products/:id/edit', [VendorPortalController::class, 'editProductView'], $vendorGuards);
$router->post('/vendor/products/:id/edit', [VendorPortalController::class, 'updateProduct'], $vendorActionGuards);
$router->post('/vendor/products/:id/delete', [VendorPortalController::class, 'deleteProduct'], $vendorGuards);
$router->get('/vendor/inventory', [VendorPortalController::class, 'inventory'], $vendorGuards);
$router->post('/vendor/inventory/:id/stock', [VendorPortalController::class, 'updateStock'], $vendorGuards);
$router->get('/vendor/orders', [VendorPortalController::class, 'orders'], $vendorGuards);
$router->get('/vendor/orders/:id', [VendorPortalController::class, 'orderDetails'], $vendorGuards);
$router->post('/vendor/orders/:id/status', [VendorPortalController::class, 'updateOrderStatus'], $vendorActionGuards);
$router->get('/vendor/customers', [VendorPortalController::class, 'customers'], $vendorGuards);
$router->get('/vendor/reports', [VendorPortalController::class, 'reports'], $vendorGuards);

// ==========================================
// 9. PET OWNER ECOSYSTEM
// ==========================================

// Pet Owner Ecosystem Endpoints
$ownerGuards = [AuthMiddleware::class];
$ownerActionGuards = [AuthMiddleware::class, CsrfMiddleware::class];

$router->get('/portal/pets', [OwnerPortalController::class, 'pets'], $ownerGuards);
$router->get('/portal/pets/create', [OwnerPortalController::class, 'createPetView'], $ownerGuards);
$router->get('/portal/pets/register', [OwnerPortalController::class, 'createPetView'], $ownerGuards);
$router->get('/portal/pets/:id', [OwnerPortalController::class, 'petDetails'], $ownerGuards);
$router->post('/portal/pets/create', [OwnerPortalController::class, 'createPet'], $ownerActionGuards);
$router->post('/portal/pets/:id/update', [OwnerPortalController::class, 'updatePet'], $ownerActionGuards);
$router->post('/portal/pets/:id/delete', [OwnerPortalController::class, 'deletePet'], $ownerActionGuards);
$router->post('/portal/pets/:id/lost', [OwnerPortalController::class, 'toggleLostMode'], $ownerActionGuards);
$router->post('/portal/pets/:id/found', [OwnerPortalController::class, 'markFound'], $ownerActionGuards);

// Care Routines & Smart Schedule
$router->get('/portal/care', [OwnerPortalController::class, 'careSchedule'], $ownerGuards);
$router->post('/portal/care/tasks/create', [OwnerPortalController::class, 'createCareTask'], $ownerActionGuards);
$router->post('/portal/care/tasks/:id/toggle', [OwnerPortalController::class, 'toggleCareTask'], $ownerActionGuards);
$router->post('/portal/care/tasks/:id/delete', [OwnerPortalController::class, 'deleteCareTask'], $ownerActionGuards);

// Health, Vaccines, Medications, Weights
$router->get('/portal/health', [OwnerPortalController::class, 'healthOverview'], $ownerGuards);
$router->post('/portal/medications/create', [OwnerPortalController::class, 'addMedication'], $ownerActionGuards);
$router->post('/portal/medications/:id/administer', [OwnerPortalController::class, 'administerMedication'], $ownerActionGuards);
$router->post('/portal/medications/:id/delete', [OwnerPortalController::class, 'deleteMedication'], $ownerActionGuards);
$router->post('/portal/vaccinations/create', [OwnerPortalController::class, 'addVaccination'], $ownerActionGuards);
$router->post('/portal/vaccinations/:id/delete', [OwnerPortalController::class, 'deleteVaccination'], $ownerActionGuards);
$router->post('/portal/weights/create', [OwnerPortalController::class, 'addWeight'], $ownerActionGuards);
$router->post('/portal/weights/:id/delete', [OwnerPortalController::class, 'deleteWeight'], $ownerActionGuards);

// Appointments & Certified Vets
$router->get('/portal/appointments', [OwnerPortalController::class, 'appointments'], $ownerGuards);
$router->post('/portal/appointments/book', [OwnerPortalController::class, 'bookAppointment'], $ownerActionGuards);
$router->post('/portal/appointments/:id/cancel', [OwnerPortalController::class, 'cancelAppointment'], $ownerActionGuards);
$router->get('/portal/vets', [OwnerPortalController::class, 'vets'], $ownerGuards);
$router->get('/portal/vets/:id', [OwnerPortalController::class, 'vetProfile'], $ownerGuards);
$router->post('/portal/vets/:id/favorite', [OwnerPortalController::class, 'toggleFavoriteVet'], $ownerActionGuards);

// Emergency Center & Printable Cards
$router->get('/portal/emergency', [OwnerPortalController::class, 'emergency'], $ownerGuards);
$router->get('/portal/emergency/card/:id', [OwnerPortalController::class, 'emergencyCard'], $ownerGuards);

// Digital Passport & Public Lost Pet QR Scanner
$router->get('/portal/passport/:token', [OwnerPortalController::class, 'passport'], $ownerGuards);
$router->get('/pet-passport/:token', [OwnerPortalController::class, 'publicQrPassport']); // Public QR Scan Route

// AI Pet Care Assistant
$router->get('/portal/ai-assistant', [OwnerPortalController::class, 'aiAssistant'], $ownerGuards);
$router->post('/portal/ai-assistant/chat', [OwnerPortalController::class, 'aiChat'], $ownerActionGuards);

// Family & Pet Sitter Sharing
$router->get('/portal/family', [OwnerPortalController::class, 'family'], $ownerGuards);
$router->post('/portal/family/invite', [OwnerPortalController::class, 'inviteFamily'], $ownerActionGuards);
$router->post('/portal/family/:id/revoke', [OwnerPortalController::class, 'revokeFamily'], $ownerActionGuards);

// Document Vault
$router->get('/portal/documents', [OwnerPortalController::class, 'documents'], $ownerGuards);
$router->get('/portal/documents/:id/download', [OwnerPortalController::class, 'downloadDocument'], $ownerGuards);
$router->post('/portal/documents/create', [OwnerPortalController::class, 'uploadDocument'], $ownerActionGuards);
$router->post('/portal/documents/:id/delete', [OwnerPortalController::class, 'deleteDocument'], $ownerActionGuards);

// Adoption & Orders
$router->get('/portal/adoption', [OwnerPortalController::class, 'adoption'], $ownerGuards);
$router->post('/portal/adoption/apply', [OwnerPortalController::class, 'submitAdoptionApp'], $ownerActionGuards);
$router->get('/portal/orders', [OwnerPortalController::class, 'orders'], $ownerGuards);

// Notifications & Reports
$router->get('/portal/notifications', [OwnerPortalController::class, 'notifications'], $ownerGuards);
$router->post('/portal/notifications/read-all', [OwnerPortalController::class, 'markAllNotificationsRead'], $ownerActionGuards);
$router->get('/portal/reports/health/:id', [OwnerPortalController::class, 'healthReport'], $ownerGuards);

// Settings
$router->get('/portal/settings', [OwnerPortalController::class, 'settings'], $ownerGuards);
$router->post('/portal/settings/profile', [OwnerPortalController::class, 'updateProfile'], $ownerActionGuards);

// Super-Fast Live Search API (Strict Owner Privacy)
$router->get('/portal/api/search', [OwnerPortalController::class, 'apiSearch'], $ownerGuards);

// Legacy/Role-based Portal actions
$router->post('/portal/appointments/:id/status', [PortalController::class, 'updateAppointmentStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/create', [PortalController::class, 'createRescuePet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/:id/status', [PortalController::class, 'updateAdoptionStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/adoptions/:id/delete', [PortalController::class, 'deleteRescuePet'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/governance/users/:id/status', [PortalController::class, 'updateUserStatus'], [AuthMiddleware::class, CsrfMiddleware::class]);
$router->post('/portal/governance/inquiries/:id/status', [PortalController::class, 'resolveInquiry'], [AuthMiddleware::class, CsrfMiddleware::class]);

// ==========================================
// 6. ADMIN COMMAND CENTER & PORTAL
// ==========================================
$adminGuards = [AuthMiddleware::class, AdminMiddleware::class];
$adminActionGuards = [AuthMiddleware::class, AdminMiddleware::class, CsrfMiddleware::class];

$router->get('/admin', [AdminController::class, 'dashboard'], $adminGuards);
$router->get('/admin/dashboard', [AdminController::class, 'dashboard'], $adminGuards);

// Users Governance
$router->get('/admin/users', [AdminController::class, 'users'], $adminGuards);
$router->get('/admin/users/activity', [AdminController::class, 'users'], $adminGuards);
$router->get('/admin/users/:id', [AdminController::class, 'userDetails'], $adminGuards);
$router->post('/admin/users/:id/status', [AdminController::class, 'updateUserStatus'], $adminActionGuards);
$router->post('/admin/users/:id/reset-password', [AdminController::class, 'resetUserPassword'], $adminActionGuards);

// Veterinarians
$router->get('/admin/veterinarians', [AdminController::class, 'veterinarians'], $adminGuards);
$router->get('/admin/veterinarians/pending', [AdminController::class, 'veterinarians'], $adminGuards);
$router->get('/admin/veterinarians/:id', [AdminController::class, 'veterinarianDetails'], $adminGuards);
$router->post('/admin/veterinarians/:id/verification', [AdminController::class, 'updateVetVerification'], $adminActionGuards);

// Shelters
$router->get('/admin/shelters', [AdminController::class, 'shelters'], $adminGuards);
$router->get('/admin/shelters/pending', [AdminController::class, 'shelters'], $adminGuards);
$router->get('/admin/shelters/:id', [AdminController::class, 'shelterDetails'], $adminGuards);
$router->post('/admin/shelters/:id/verification', [AdminController::class, 'updateShelterVerification'], $adminActionGuards);

// Product Vendors
$router->get('/admin/vendors', [AdminController::class, 'vendors'], $adminGuards);
$router->get('/admin/vendors/:id', [AdminController::class, 'vendorDetails'], $adminGuards);
$router->post('/admin/vendors/:id/verification', [AdminController::class, 'updateVendorVerification'], $adminActionGuards);

// Pets & Passports
$router->get('/admin/pets', [AdminController::class, 'pets'], $adminGuards);
$router->get('/admin/pets/health', [AdminController::class, 'pets'], $adminGuards);
$router->get('/admin/pets/passports', [AdminController::class, 'pets'], $adminGuards);
$router->get('/admin/pets/:id', [AdminController::class, 'petDetails'], $adminGuards);
$router->post('/admin/pets/:id/passport', [AdminController::class, 'togglePassport'], $adminActionGuards);

// Adoption Hub
$router->get('/admin/adoption', [AdminController::class, 'adoption'], $adminGuards);
$router->get('/admin/adoption/listings', [AdminController::class, 'adoption'], $adminGuards);
$router->get('/admin/adoption/applications', [AdminController::class, 'adoption'], $adminGuards);
$router->get('/admin/adoption/disputes', [AdminController::class, 'adoption'], $adminGuards);
$router->post('/admin/adoption/applications/:id/status', [AdminController::class, 'updateAdoptionApplication'], $adminActionGuards);

// Marketplace & Orders
$router->get('/admin/marketplace/products', [AdminController::class, 'products'], $adminGuards);
$router->post('/admin/marketplace/products', [AdminController::class, 'saveProduct'], $adminActionGuards);
$router->post('/admin/marketplace/products/:id/delete', [AdminController::class, 'deleteProduct'], $adminActionGuards);
$router->get('/admin/marketplace/inventory', [AdminController::class, 'inventory'], $adminGuards);
$router->post('/admin/marketplace/products/:id/stock', [AdminController::class, 'updateStock'], $adminActionGuards);
$router->get('/admin/marketplace/orders', [AdminController::class, 'orders'], $adminGuards);
$router->get('/admin/marketplace/orders/:id', [AdminController::class, 'orderDetails'], $adminGuards);
$router->post('/admin/marketplace/orders/:id/status', [AdminController::class, 'updateOrderStatus'], $adminActionGuards);

// Content Management
$router->get('/admin/content', [AdminController::class, 'careContent'], $adminGuards);
$router->get('/admin/content/articles', [AdminController::class, 'careContent'], $adminGuards);
$router->get('/admin/content/faqs', [AdminController::class, 'careContent'], $adminGuards);
$router->get('/admin/content/health-tips', [AdminController::class, 'careContent'], $adminGuards);
$router->post('/admin/content', [AdminController::class, 'saveCareContent'], $adminActionGuards);
$router->post('/admin/content/:id/delete', [AdminController::class, 'deleteCareContent'], $adminActionGuards);

// Moderation
$router->get('/admin/moderation', [AdminController::class, 'moderation'], $adminGuards);
$router->get('/admin/moderation/reviews', [AdminController::class, 'moderation'], $adminGuards);
$router->get('/admin/moderation/reports', [AdminController::class, 'moderation'], $adminGuards);
$router->post('/admin/moderation/:id/resolve', [AdminController::class, 'resolveModerationReport'], $adminActionGuards);

// Notifications & Broadcasts
$router->get('/admin/notifications', [AdminController::class, 'notifications'], $adminGuards);
$router->get('/admin/notifications/broadcast', [AdminController::class, 'notifications'], $adminGuards);
$router->get('/admin/notifications/history', [AdminController::class, 'notifications'], $adminGuards);
$router->post('/admin/notifications/broadcast', [AdminController::class, 'broadcastNotification'], $adminActionGuards);

// Emergency Center
$router->get('/admin/emergency', [AdminController::class, 'emergency'], $adminGuards);
$router->post('/admin/emergency/:id/status', [AdminController::class, 'updateEmergencyStatus'], $adminActionGuards);

// AI & Intelligence
$router->get('/admin/ai', [AdminController::class, 'aiOverview'], $adminGuards);
$router->get('/admin/ai/assistant', [AdminController::class, 'aiAssistant'], $adminGuards);
$router->get('/admin/ai/care-score', [AdminController::class, 'aiOverview'], $adminGuards);
$router->get('/admin/ai/adoption-matching', [AdminController::class, 'aiOverview'], $adminGuards);
$router->post('/admin/ai/ask', [AdminController::class, 'askAiApi'], $adminActionGuards);

// Reports & Security & Settings
$router->get('/admin/reports', [AdminController::class, 'reports'], $adminGuards);
$router->get('/admin/security', [AdminController::class, 'security'], $adminGuards);
$router->get('/admin/security/audit-logs', [AdminController::class, 'security'], $adminGuards);
$router->get('/admin/security/events', [AdminController::class, 'security'], $adminGuards);
$router->get('/admin/settings', [AdminController::class, 'settings'], $adminGuards);
$router->post('/admin/settings', [AdminController::class, 'updateSettings'], $adminActionGuards);

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
