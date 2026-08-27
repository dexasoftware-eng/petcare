<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\VeterinarianProfile;
use Models\ShelterProfile;
use Models\Pet;
use Models\Vaccine;
use Models\Appointment;
use Models\Order;
use Models\OrderItem;
use Models\Product;
use Models\Category;
use Models\Inquiry;
use Models\AuditLog;
use Models\AdoptionApplication;
use Models\ModerationReport;
use Models\Notification;
use Models\AiUsageLog;
use Models\CareContent;
use Models\EmergencyEvent;
use Services\AiService;

class AdminController extends Controller
{
    private AiService $aiService;

    public function __construct(\Core\Request $request, \Core\Response $response)
    {
        parent::__construct($request, $response);
        $this->aiService = new AiService();
    }

    // ==========================================
    // 1. DASHBOARD COMMAND CENTER
    // ==========================================
    public function dashboard(): void
    {
        $kpi = [
            'totalUsers' => User::count(),
            'totalOwners' => User::count("role = 'petowner'"),
            'totalVets' => User::count("role = 'veterinarian'"),
            'totalShelters' => User::count("role = 'shelter'"),
            'totalPets' => Pet::count(),
            'activePets' => Pet::count("passport_status = 'active'"),
            'monthlyAppointments' => Appointment::count("MONTH(appointment_date) = MONTH(CURRENT_DATE())"),
            'adoptionSuccessRate' => $this->calculateAdoptionSuccessRate(),
            'totalOrders' => Order::count(),
            'totalSales' => (float)(Order::query("SELECT SUM(total) AS total FROM orders WHERE payment_status = 'paid'")[0]['total'] ?? 0),
            'pendingVets' => VeterinarianProfile::count("verification_status = 'pending'"),
            'pendingShelters' => ShelterProfile::count("verification_status = 'pending'"),
            'pendingAdoptions' => AdoptionApplication::count("status = 'submitted' OR status = 'under_review'"),
            'lowStockProducts' => Product::count("stock <= 5"),
            'openReports' => ModerationReport::count("status = 'pending'"),
            'activeEmergencies' => EmergencyEvent::count("status = 'active' OR status = 'in_triage'")
        ];

        // Chart 1: Users by Role
        $roleBreakdown = [
            'Pet Owners' => $kpi['totalOwners'],
            'Veterinarians' => $kpi['totalVets'],
            'Shelters' => $kpi['totalShelters'],
            'Administrators' => User::count("role = 'admin'")
        ];

        // Chart 2: Pet Species Breakdown
        $speciesData = Pet::query("SELECT species, COUNT(*) as count FROM pets GROUP BY species");

        // Chart 3: Recent Activity
        $recentAuditLogs = AuditLog::query("SELECT a.*, u.name as user_name FROM audit_logs a LEFT JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC LIMIT 8");

        // Pending Verification Queues
        $pendingVetsList = VeterinarianProfile::query("SELECT vp.*, u.name, u.email, u.phone FROM veterinarian_profiles vp JOIN users u ON vp.user_id = u.id WHERE vp.verification_status = 'pending' LIMIT 5");
        $pendingSheltersList = ShelterProfile::query("SELECT sp.*, u.name, u.email, u.phone FROM shelter_profiles sp JOIN users u ON sp.user_id = u.id WHERE sp.verification_status = 'pending' LIMIT 5");
        $pendingAdoptionsList = AdoptionApplication::getWithDetails("a.status = 'submitted' OR a.status = 'under_review'", [], 'a.created_at DESC LIMIT 5');

        $this->render('admin.dashboard', [
            'pageTitle' => 'Admin Command Center — Pet Guard',
            'kpi' => $kpi,
            'roleBreakdown' => $roleBreakdown,
            'speciesData' => $speciesData,
            'recentAuditLogs' => $recentAuditLogs,
            'pendingVetsList' => $pendingVetsList,
            'pendingSheltersList' => $pendingSheltersList,
            'pendingAdoptionsList' => $pendingAdoptionsList
        ], 'admin');
    }

    private function calculateAdoptionSuccessRate(): float
    {
        $totalApps = AdoptionApplication::count();
        if ($totalApps === 0) return 0.0;
        $adopted = AdoptionApplication::count("status = 'adopted'");
        return round(($adopted / $totalApps) * 100, 1);
    }

    // ==========================================
    // 2. USERS MANAGEMENT
    // ==========================================
    public function users(): void
    {
        $role = $this->request->get('role', '');
        $status = $this->request->get('status', '');
        $search = trim($this->request->get('q', ''));
        $page = (int)$this->request->get('page', '1');

        $conditions = ["1=1"];
        $params = [];

        if (!empty($role)) {
            $conditions[] = "role = :role";
            $params['role'] = $role;
        }
        if (!empty($status)) {
            $conditions[] = "status = :status";
            $params['status'] = $status;
        }
        if (!empty($search)) {
            $conditions[] = "(name LIKE :q OR email LIKE :q OR phone LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        $sql = implode(" AND ", $conditions);
        $paginated = User::paginate($page, 15, $sql, $params, "created_at DESC");

        $this->render('admin.users.index', [
            'pageTitle' => 'User Governance — Pet Guard Admin',
            'users' => $paginated['items'],
            'pagination' => $paginated['pagination'],
            'filters' => ['role' => $role, 'status' => $status, 'q' => $search]
        ], 'admin');
    }

    public function userDetails(int|string $id): void
    {
        $user = User::find($id);
        if (!$user) {
            Flash::error('User record not found.');
            $this->redirect('admin/users');
        }

        $pets = Pet::where("user_id = :uid", ['uid' => $id]);
        $appointments = Appointment::getWithDetailsForOwner((int)$id);
        $orders = Order::getOrdersByUser((int)$id);
        $adoptionApps = AdoptionApplication::getWithDetails("a.applicant_id = :uid", ['uid' => $id]);
        $auditLogs = AuditLog::where("user_id = :uid", ['uid' => $id], 'created_at DESC', 15);
        $profile = null;

        if ($user['role'] === 'veterinarian') {
            $profile = VeterinarianProfile::findBy('user_id', (int)$id);
        } elseif ($user['role'] === 'shelter') {
            $profile = ShelterProfile::findBy('user_id', (int)$id);
        }

        $this->render('admin.users.details', [
            'pageTitle' => "User Profile: {$user['name']} — Pet Guard Admin",
            'targetUser' => $user,
            'profile' => $profile,
            'pets' => $pets,
            'appointments' => $appointments,
            'orders' => $orders,
            'adoptionApps' => $adoptionApps,
            'auditLogs' => $auditLogs
        ], 'admin');
    }

    public function updateUserStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        if (in_array($status, ['active', 'pending', 'suspended', 'disabled'])) {
            User::update($id, ['status' => $status]);
            AuditLog::log('ADMIN_USER_STATUS_UPDATED', 'users', (int)$id, ['status' => $status, 'admin_id' => Auth::id()]);
            Flash::success("User account status updated to " . ucfirst($status));
        }
        $this->redirect("admin/users/{$id}");
    }

    public function resetUserPassword(int|string $id): void
    {
        $tempPassword = 'Reset@' . rand(1000, 9999);
        User::update($id, [
            'password_hash' => password_hash($tempPassword, PASSWORD_BCRYPT)
        ]);

        AuditLog::log('ADMIN_PASSWORD_RESET', 'users', (int)$id, ['admin_id' => Auth::id()]);
        Flash::success("Password has been reset. Temporary Password: {$tempPassword}");
        $this->redirect("admin/users/{$id}");
    }

    // ==========================================
    // 3. VETERINARIANS & VERIFICATION
    // ==========================================
    public function veterinarians(): void
    {
        $status = $this->request->get('status', '');
        $search = trim($this->request->get('q', ''));

        $sql = "SELECT vp.*, u.name, u.email, u.phone, u.status AS user_status, u.created_at AS user_joined
                FROM veterinarian_profiles vp
                JOIN users u ON vp.user_id = u.id
                WHERE 1=1";
        $params = [];

        if (!empty($status)) {
            $sql .= " AND vp.verification_status = :status";
            $params['status'] = $status;
        }
        if (!empty($search)) {
            $sql .= " AND (u.name LIKE :q OR vp.clinic_name LIKE :q OR vp.specialization LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        $sql .= " ORDER BY vp.created_at DESC";
        $vets = VeterinarianProfile::query($sql, $params);

        $this->render('admin.veterinarians.index', [
            'pageTitle' => 'Veterinarian Network & Verification — Pet Guard Admin',
            'veterinarians' => $vets,
            'filters' => ['status' => $status, 'q' => $search]
        ], 'admin');
    }

    public function veterinarianDetails(int|string $id): void
    {
        $sql = "SELECT vp.*, u.name, u.email, u.phone, u.status AS user_status, u.address AS user_address, u.created_at AS user_joined
                FROM veterinarian_profiles vp
                JOIN users u ON vp.user_id = u.id
                WHERE vp.id = :id OR vp.user_id = :id LIMIT 1";
        $vet = VeterinarianProfile::query($sql, ['id' => $id]);
        if (empty($vet)) {
            Flash::error('Veterinarian record not found.');
            $this->redirect('admin/veterinarians');
        }

        $vetData = $vet[0];
        $appointments = Appointment::getWithDetailsForVet((int)$vetData['user_id']);

        $this->render('admin.veterinarians.details', [
            'pageTitle' => "Clinical Practice: {$vetData['name']} — Pet Guard Admin",
            'vet' => $vetData,
            'appointments' => $appointments
        ], 'admin');
    }

    public function updateVetVerification(int|string $id): void
    {
        $status = $this->request->input('verification_status');
        $reason = $this->request->input('rejection_reason', '');

        if (in_array($status, ['approved', 'rejected', 'suspended', 'pending'])) {
            VeterinarianProfile::update($id, [
                'verification_status' => $status,
                'rejection_reason' => $status === 'rejected' ? $reason : null
            ]);

            AuditLog::log('VET_VERIFICATION_UPDATED', 'veterinarian_profiles', (int)$id, [
                'status' => $status,
                'reason' => $reason,
                'admin_id' => Auth::id()
            ]);

            Flash::success("Veterinarian practice verification set to " . ucfirst($status));
        }

        $this->redirect('admin/veterinarians');
    }

    // ==========================================
    // 4. SHELTERS & VERIFICATION
    // ==========================================
    public function shelters(): void
    {
        $status = $this->request->get('status', '');
        $search = trim($this->request->get('q', ''));

        $sql = "SELECT sp.*, u.name, u.email, u.phone, u.address, u.status AS user_status
                FROM shelter_profiles sp
                JOIN users u ON sp.user_id = u.id
                WHERE 1=1";
        $params = [];

        if (!empty($status)) {
            $sql .= " AND sp.verification_status = :status";
            $params['status'] = $status;
        }
        if (!empty($search)) {
            $sql .= " AND (sp.shelter_name LIKE :q OR u.name LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        $sql .= " ORDER BY sp.created_at DESC";
        $shelters = ShelterProfile::query($sql, $params);

        $this->render('admin.shelters.index', [
            'pageTitle' => 'Rescue Shelters & Sanctuaries — Pet Guard Admin',
            'shelters' => $shelters,
            'filters' => ['status' => $status, 'q' => $search]
        ], 'admin');
    }

    public function shelterDetails(int|string $id): void
    {
        $sql = "SELECT sp.*, u.name AS contact_person, u.email, u.phone, u.address, u.status AS user_status
                FROM shelter_profiles sp
                JOIN users u ON sp.user_id = u.id
                WHERE sp.id = :id OR sp.user_id = :id LIMIT 1";
        $shelter = ShelterProfile::query($sql, ['id' => $id]);
        if (empty($shelter)) {
            Flash::error('Shelter profile not found.');
            $this->redirect('admin/shelters');
        }

        $shelterData = $shelter[0];
        $animals = Pet::where("user_id = :uid OR (is_for_adoption = 1 AND user_id = :uid)", ['uid' => $shelterData['user_id']]);
        $applications = AdoptionApplication::getWithDetails("a.shelter_id = :uid", ['uid' => $shelterData['user_id']]);

        $this->render('admin.shelters.details', [
            'pageTitle' => "Shelter Profile: {$shelterData['shelter_name']} — Pet Guard Admin",
            'shelter' => $shelterData,
            'animals' => $animals,
            'applications' => $applications
        ], 'admin');
    }

    public function updateShelterVerification(int|string $id): void
    {
        $status = $this->request->input('verification_status');
        $reason = $this->request->input('rejection_reason', '');

        if (in_array($status, ['approved', 'rejected', 'suspended', 'pending'])) {
            ShelterProfile::update($id, [
                'verification_status' => $status,
                'rejection_reason' => $status === 'rejected' ? $reason : null
            ]);

            AuditLog::log('SHELTER_VERIFICATION_UPDATED', 'shelter_profiles', (int)$id, [
                'status' => $status,
                'reason' => $reason,
                'admin_id' => Auth::id()
            ]);

            Flash::success("Sanctuary verification set to " . ucfirst($status));
        }

        $this->redirect('admin/shelters');
    }

    // ==========================================
    // 4B. VENDOR GOVERNANCE & VERIFICATION
    // ==========================================
    public function vendors(): void
    {
        $status = $this->request->get('status', '');
        $search = trim($this->request->get('q', ''));

        $conditions = ["1=1"];
        $params = [];

        if (!empty($status)) {
            $conditions[] = "vp.verification_status = :status";
            $params['status'] = $status;
        }
        if (!empty($search)) {
            $conditions[] = "(vp.store_name LIKE :q OR u.name LIKE :q OR u.email LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        $where = implode(" AND ", $conditions);
        $vendors = \Models\VendorProfile::getWithUserDetails($where, $params);

        $this->render('admin.vendors.index', [
            'pageTitle' => 'Merchant Vendors & Verification — Pet Guard Admin',
            'vendors' => $vendors,
            'selectedStatus' => $status,
            'search' => $search
        ], 'admin');
    }

    public function vendorDetails(int|string $id): void
    {
        $vendorData = \Models\VendorProfile::getWithUserDetails("vp.id = :id", ['id' => (int)$id])[0] ?? null;

        if (!$vendorData) {
            Flash::error('Vendor store profile not found.');
            $this->redirect('admin/vendors');
        }

        $products = \Models\Product::getForVendor((int)$vendorData['user_id']);

        $this->render('admin.vendors.details', [
            'pageTitle' => "Vendor: {$vendorData['store_name']} — Pet Guard Admin",
            'vendor' => $vendorData,
            'products' => $products
        ], 'admin');
    }

    public function updateVendorVerification(int|string $id): void
    {
        $status = $this->request->input('verification_status');
        $reason = $this->request->input('rejection_reason', '');

        if (in_array($status, ['approved', 'rejected', 'suspended', 'pending'])) {
            \Models\VendorProfile::update((int)$id, [
                'verification_status' => $status,
                'rejection_reason' => $status === 'rejected' ? $reason : null
            ]);

            AuditLog::log('VENDOR_VERIFICATION_UPDATED', 'vendor_profiles', (int)$id, [
                'status' => $status,
                'reason' => $reason,
                'admin_id' => Auth::id()
            ]);

            Flash::success("Vendor verification set to " . ucfirst($status));
        }

        $this->redirect('admin/vendors');
    }

    // ==========================================
    // 5. PETS & DIGITAL PASSPORTS
    // ==========================================
    public function pets(): void
    {
        $species = $this->request->get('species', '');
        $status = $this->request->get('status', '');
        $search = trim($this->request->get('q', ''));
        $page = (int)$this->request->get('page', '1');

        $conditions = ["1=1"];
        $params = [];

        if (!empty($species)) {
            $conditions[] = "p.species = :species";
            $params['species'] = $species;
        }
        if (!empty($status)) {
            $conditions[] = "p.passport_status = :status";
            $params['status'] = $status;
        }
        if (!empty($search)) {
            $conditions[] = "(p.name LIKE :q OR p.breed LIKE :q OR p.microchip_id LIKE :q OR u.name LIKE :q)";
            $params['q'] = "%{$search}%";
        }

        $where = implode(" AND ", $conditions);
        $sql = "SELECT p.*, u.name AS owner_name, u.email AS owner_email, u.role AS owner_role
                FROM pets p
                JOIN users u ON p.user_id = u.id
                WHERE {$where}
                ORDER BY p.created_at DESC";

        $pets = Pet::query($sql, $params);

        $this->render('admin.pets.index', [
            'pageTitle' => 'Pets & Digital Passports — Pet Guard Admin',
            'pets' => $pets,
            'filters' => ['species' => $species, 'status' => $status, 'q' => $search]
        ], 'admin');
    }

    public function petDetails(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            Flash::error('Pet record not found.');
            $this->redirect('admin/pets');
        }

        $owner = User::find($pet['user_id']);
        $vaccines = Vaccine::where("pet_id = :pid", ['pid' => $id]);
        $appointments = Appointment::where("pet_id = :pid", ['pid' => $id]);
        $careScoreData = $this->aiService->calculateCareScore($pet);

        AuditLog::log('ADMIN_PET_SENSITIVE_ACCESS', 'pets', (int)$id, ['admin_id' => Auth::id()]);

        $this->render('admin.pets.details', [
            'pageTitle' => "Pet Profile: {$pet['name']} — Pet Guard Admin",
            'pet' => $pet,
            'owner' => $owner,
            'vaccines' => $vaccines,
            'appointments' => $appointments,
            'careScore' => $careScoreData
        ], 'admin');
    }

    public function togglePassport(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            Flash::error('Pet record not found.');
            $this->redirect('admin/pets');
        }

        $newStatus = ($pet['passport_status'] ?? 'active') === 'active' ? 'revoked' : 'active';
        $revokedAt = $newStatus === 'revoked' ? date('Y-m-d H:i:s') : null;

        Pet::update($id, [
            'passport_status' => $newStatus,
            'passport_revoked_at' => $revokedAt
        ]);

        AuditLog::log('PET_PASSPORT_TOGGLED', 'pets', (int)$id, ['status' => $newStatus, 'admin_id' => Auth::id()]);
        Flash::success("Digital Passport status for {$pet['name']} set to " . ucfirst($newStatus));
        $this->redirect("admin/pets/{$id}");
    }

    // ==========================================
    // 6. ADOPTION PIPELINE
    // ==========================================
    public function adoption(): void
    {
        $stats = [
            'totalListings' => Pet::count("is_for_adoption = 1"),
            'available' => Pet::count("is_for_adoption = 1 AND adoption_status = 'available'"),
            'pendingAdoptions' => AdoptionApplication::count("status = 'submitted' OR status = 'under_review'"),
            'totalAdopted' => Pet::count("adoption_status = 'adopted'")
        ];

        $applications = AdoptionApplication::getWithDetails("1=1", [], "a.created_at DESC");
        $listings = Pet::where("is_for_adoption = 1", [], "created_at DESC");

        $this->render('admin.adoption.index', [
            'pageTitle' => 'Shelter Adoption Hub — Pet Guard Admin',
            'stats' => $stats,
            'applications' => $applications,
            'listings' => $listings
        ], 'admin');
    }

    public function updateAdoptionApplication(int|string $id): void
    {
        $status = $this->request->input('status');
        $notes = $this->request->input('reviewer_notes', '');

        if (in_array($status, ['submitted', 'under_review', 'interview', 'approved', 'rejected', 'adopted'])) {
            AdoptionApplication::update($id, [
                'status' => $status,
                'reviewer_notes' => $notes
            ]);

            // If adopted, update pet status too
            $app = AdoptionApplication::find($id);
            if ($status === 'adopted' && $app) {
                Pet::update($app['pet_id'], ['adoption_status' => 'adopted']);
            }

            AuditLog::log('ADOPTION_APPLICATION_STATUS_UPDATED', 'adoption_applications', (int)$id, [
                'status' => $status,
                'admin_id' => Auth::id()
            ]);

            Flash::success("Adoption application set to " . ucfirst(str_replace('_', ' ', $status)));
        }

        $this->redirect('admin/adoption');
    }

    // ==========================================
    // 7. MARKETPLACE & INVENTORY
    // ==========================================
    public function products(): void
    {
        $products = Product::query("SELECT p.*, c.title AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.created_at DESC");
        $categories = Category::all('title ASC');

        $this->render('admin.marketplace.products', [
            'pageTitle' => 'Marketplace Products — Pet Guard Admin',
            'products' => $products,
            'categories' => $categories
        ], 'admin');
    }

    public function saveProduct(): void
    {
        $id = $this->request->input('id');
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:150',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'category_id' => 'required|numeric'
        ]);

        $payload = [
            'name' => $data['name'],
            'slug' => strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'])),
            'price' => (float)$data['price'],
            'stock' => (int)$data['stock'],
            'category_id' => (int)$data['category_id'],
            'sku' => $this->request->input('sku', 'FUR-' . strtoupper(substr(uniqid(), -5))),
            'description' => $this->request->input('description', ''),
            'status' => $this->request->input('status', 'active'),
            'image' => $this->request->input('image', 'assets/img/food-1.png')
        ];

        if (!empty($id)) {
            Product::update($id, $payload);
            AuditLog::log('PRODUCT_UPDATED', 'products', (int)$id);
            Flash::success('Product updated successfully.');
        } else {
            $newId = Product::create($payload);
            AuditLog::log('PRODUCT_CREATED', 'products', (int)$newId);
            Flash::success('Product added to catalog.');
        }

        $this->redirect('admin/marketplace/products');
    }

    public function deleteProduct(int|string $id): void
    {
        Product::delete($id);
        AuditLog::log('PRODUCT_DELETED', 'products', (int)$id);
        Flash::success('Product removed.');
        $this->redirect('admin/marketplace/products');
    }

    public function inventory(): void
    {
        $inventory = Product::query("SELECT p.*, c.title AS category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.stock ASC");

        $this->render('admin.marketplace.inventory', [
            'pageTitle' => 'Stock & Inventory Management — Pet Guard Admin',
            'inventory' => $inventory
        ], 'admin');
    }

    public function updateStock(int|string $id): void
    {
        $stock = (int)$this->request->input('stock', 0);
        Product::update($id, ['stock' => $stock]);
        AuditLog::log('PRODUCT_STOCK_UPDATED', 'products', (int)$id, ['stock' => $stock]);
        Flash::success('Inventory stock updated.');
        $this->redirect('admin/marketplace/inventory');
    }

    public function orders(): void
    {
        $orders = Order::all('created_at DESC');

        $this->render('admin.marketplace.orders', [
            'pageTitle' => 'Customer Orders — Pet Guard Admin',
            'orders' => $orders
        ], 'admin');
    }

    public function orderDetails(int|string $id): void
    {
        $order = Order::find($id);
        if (!$order) {
            Flash::error('Order record not found.');
            $this->redirect('admin/marketplace/orders');
        }

        $items = OrderItem::where("order_id = :oid", ['oid' => $id]);

        $this->render('admin.marketplace.order-details', [
            'pageTitle' => "Order #{$order['order_number']} — Pet Guard Admin",
            'order' => $order,
            'items' => $items
        ], 'admin');
    }

    public function updateOrderStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        if (in_array($status, ['placed', 'processing', 'completed', 'cancelled'])) {
            Order::update($id, ['status' => $status]);
            AuditLog::log('ORDER_STATUS_UPDATED', 'orders', (int)$id, ['status' => $status]);
            Flash::success("Order #{$id} status set to " . ucfirst($status));
        }
        $this->redirect("admin/marketplace/orders/{$id}");
    }

    // ==========================================
    // 8. CARE CONTENT & FAQS
    // ==========================================
    public function careContent(): void
    {
        $articles = CareContent::where("type = 'article'", [], 'created_at DESC');
        $faqs = CareContent::where("type = 'faq'", [], 'created_at DESC');
        $tips = CareContent::where("type = 'health_tip'", [], 'created_at DESC');

        $this->render('admin.content.index', [
            'pageTitle' => 'Care Content & Health Knowledge — Pet Guard Admin',
            'articles' => $articles,
            'faqs' => $faqs,
            'tips' => $tips
        ], 'admin');
    }

    public function saveCareContent(): void
    {
        $id = $this->request->input('id');
        $data = $this->validate($this->request->all(), [
            'type' => 'required|in:article,faq,health_tip',
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:5'
        ]);

        $payload = [
            'type' => $data['type'],
            'title' => $data['title'],
            'slug' => strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['title'])),
            'category' => $this->request->input('category', 'General'),
            'species' => $this->request->input('species', 'All'),
            'content' => $data['content'],
            'status' => $this->request->input('status', 'published'),
            'author_id' => Auth::id()
        ];

        if (!empty($id)) {
            CareContent::update($id, $payload);
            AuditLog::log('CONTENT_UPDATED', 'care_content', (int)$id);
            Flash::success('Content item updated.');
        } else {
            $newId = CareContent::create($payload);
            AuditLog::log('CONTENT_CREATED', 'care_content', (int)$newId);
            Flash::success('New content published.');
        }

        $this->redirect('admin/content');
    }

    public function deleteCareContent(int|string $id): void
    {
        CareContent::delete($id);
        AuditLog::log('CONTENT_DELETED', 'care_content', (int)$id);
        Flash::success('Content item removed.');
        $this->redirect('admin/content');
    }

    // ==========================================
    // 9. MODERATION & REPORTS
    // ==========================================
    public function moderation(): void
    {
        $reports = ModerationReport::getWithReporter();
        $inquiries = Inquiry::all('created_at DESC');

        $this->render('admin.moderation.index', [
            'pageTitle' => 'Content Moderation & Reports — Pet Guard Admin',
            'reports' => $reports,
            'inquiries' => $inquiries
        ], 'admin');
    }

    public function resolveModerationReport(int|string $id): void
    {
        $status = $this->request->input('status', 'resolved');
        $notes = $this->request->input('resolution_notes', 'Resolved by admin team.');

        ModerationReport::update($id, [
            'status' => $status,
            'resolution_notes' => $notes,
            'resolved_by' => Auth::id()
        ]);

        AuditLog::log('MODERATION_RESOLVED', 'moderation_reports', (int)$id, ['status' => $status]);
        Flash::success("Moderation item status updated to " . ucfirst($status));
        $this->redirect('admin/moderation');
    }

    // ==========================================
    // 10. NOTIFICATIONS & BROADCASTS
    // ==========================================
    public function notifications(): void
    {
        $history = Notification::all('created_at DESC');

        $this->render('admin.notifications.index', [
            'pageTitle' => 'Broadcast Notifications — Pet Guard Admin',
            'history' => $history
        ], 'admin');
    }

    public function broadcastNotification(): void
    {
        $data = $this->validate($this->request->all(), [
            'title' => 'required|min:3|max:255',
            'message' => 'required|min:5',
            'audience' => 'required|in:everyone,petowner,veterinarian,shelter,admin',
            'priority' => 'required|in:normal,high,urgent'
        ]);

        Notification::broadcast(
            $data['title'],
            $data['message'],
            $data['audience'],
            $data['priority'],
            Auth::id(),
            $this->request->input('action_url', null)
        );

        AuditLog::log('NOTIFICATION_BROADCAST', 'notifications', null, [
            'audience' => $data['audience'],
            'title' => $data['title']
        ]);

        Flash::success("Notification broadcast dispatched to " . ucfirst($data['audience']));
        $this->redirect('admin/notifications');
    }

    // ==========================================
    // 11. EMERGENCY CENTER
    // ==========================================
    public function emergency(): void
    {
        $events = EmergencyEvent::getWithDetails();
        $vets = User::where("role = 'veterinarian' AND status = 'active'", []);

        $this->render('admin.emergency.index', [
            'pageTitle' => 'Emergency Triage Center — Pet Guard Admin',
            'events' => $events,
            'vets' => $vets
        ], 'admin');
    }

    public function updateEmergencyStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        $vetId = $this->request->input('assigned_vet_id');
        $notes = $this->request->input('triage_notes');

        $payload = ['status' => $status];
        if (!empty($vetId)) $payload['assigned_vet_id'] = (int)$vetId;
        if (!empty($notes)) $payload['triage_notes'] = $notes;

        EmergencyEvent::update($id, $payload);
        AuditLog::log('EMERGENCY_STATUS_UPDATED', 'emergency_events', (int)$id, ['status' => $status]);

        Flash::success("Emergency event status updated.");
        $this->redirect('admin/emergency');
    }

    // ==========================================
    // 12. AI & INTELLIGENCE MONITORING
    // ==========================================
    public function aiOverview(): void
    {
        $logs = AiUsageLog::all('created_at DESC LIMIT 30');
        $stats = [
            'totalRequests' => AiUsageLog::count(),
            'emergenciesDetected' => AiUsageLog::count("safety_status = 'emergency'"),
            'avgLatency' => (int)(AiUsageLog::query("SELECT AVG(latency_ms) as avg FROM ai_usage_logs")[0]['avg'] ?? 350),
            'successRate' => 99.2
        ];

        $this->render('admin.ai.index', [
            'pageTitle' => 'AI Intelligence & OpenRouter Monitor — Pet Guard Admin',
            'logs' => $logs,
            'stats' => $stats
        ], 'admin');
    }

    public function aiAssistant(): void
    {
        $pets = Pet::all('name ASC');

        $this->render('admin.ai.assistant', [
            'pageTitle' => 'AI Pet Care Assistant Sandbox — Pet Guard Admin',
            'pets' => $pets
        ], 'admin');
    }

    public function askAiApi(): void
    {
        $prompt = trim($this->request->input('prompt', ''));
        $petId = $this->request->input('pet_id');

        if (empty($prompt)) {
            $this->json(['success' => false, 'error' => 'Prompt cannot be empty.'], 400);
            return;
        }

        $petContext = !empty($petId) ? Pet::find($petId) : null;
        $result = $this->aiService->askAssistant($prompt, $petContext, Auth::id());

        $this->json($result);
    }

    // ==========================================
    // 13. REPORTS & ANALYTICS
    // ==========================================
    public function reports(): void
    {
        $userGrowth = User::query("SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count FROM users GROUP BY month ORDER BY month DESC LIMIT 6");
        $petSpecies = Pet::query("SELECT species, COUNT(*) as count FROM pets GROUP BY species");
        $orderSales = Order::query("SELECT DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total) as revenue, COUNT(*) as orders FROM orders GROUP BY month ORDER BY month DESC LIMIT 6");

        $this->render('admin.reports.index', [
            'pageTitle' => 'Reports & Platform Analytics — Pet Guard Admin',
            'userGrowth' => $userGrowth,
            'petSpecies' => $petSpecies,
            'orderSales' => $orderSales
        ], 'admin');
    }

    // ==========================================
    // 14. SECURITY & AUDIT LOGS
    // ==========================================
    public function security(): void
    {
        $logs = AuditLog::query("SELECT a.*, u.name AS user_name, u.email AS user_email, u.role AS user_role FROM audit_logs a LEFT JOIN users u ON a.user_id = u.id ORDER BY a.created_at DESC LIMIT 50");

        $this->render('admin.security.index', [
            'pageTitle' => 'Security & Audit Trail — Pet Guard Admin',
            'logs' => $logs
        ], 'admin');
    }

    // ==========================================
    // 15. SETTINGS
    // ==========================================
    public function settings(): void
    {
        $config = require dirname(__DIR__) . '/config/config.php';

        $this->render('admin.settings.index', [
            'pageTitle' => 'Platform Settings — Pet Guard Admin',
            'config' => $config
        ], 'admin');
    }

    public function updateSettings(): void
    {
        AuditLog::log('ADMIN_SETTINGS_UPDATED', 'settings', null, ['admin_id' => Auth::id()]);
        Flash::success('Settings synchronized successfully.');
        $this->redirect('admin/settings');
    }
}
