<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\User;
use Models\VendorProfile;
use Models\Product;
use Models\ProductImage;
use Models\Category;
use Models\Order;
use Models\OrderItem;
use Models\AuditLog;
use Services\AiService;

class VendorPortalController extends Controller
{
    private function getVendorUserId(): int
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
        }
        return (int)$userId;
    }

    /**
     * Store Dashboard
     */
    public function dashboard(): void
    {
        $vendorId = $this->getVendorUserId();
        $user = Auth::user();
        $profile = VendorProfile::findBy('user_id', $vendorId);

        $totalSales = (float)(Order::query("SELECT SUM(total) as total FROM orders WHERE payment_status = 'paid'")[0]['total'] ?? 0);
        $totalOrders = Order::count();
        $pendingOrders = Order::count("status = 'pending' OR status = 'processing'");
        $totalProducts = Product::count("(vendor_id = {$vendorId} OR vendor_id IS NULL) AND is_archived = 0");
        $lowStockCount = Product::count("(vendor_id = {$vendorId} OR vendor_id IS NULL) AND stock <= 5 AND is_archived = 0");

        $kpi = [
            'totalSales' => $totalSales,
            'totalOrders' => $totalOrders,
            'pendingOrders' => $pendingOrders,
            'totalProducts' => $totalProducts,
            'lowStockCount' => $lowStockCount,
            'storeRating' => $profile['rating'] ?? 4.95
        ];

        $recentOrders = Order::where('1=1', [], 'id DESC', 6);
        $lowStockProducts = Product::where("(vendor_id = :vid OR vendor_id IS NULL) AND stock <= 5 AND is_archived = 0", ['vid' => $vendorId], 'stock ASC', 5);

        $this->render('portal.vendor.dashboard', [
            'pageTitle' => 'Vendor Store Dashboard — Pet Guard',
            'user' => $user,
            'profile' => $profile,
            'kpi' => $kpi,
            'recentOrders' => $recentOrders,
            'lowStockProducts' => $lowStockProducts
        ], 'portal');
    }

    /**
     * Store Profile & Policies
     */
    public function store(): void
    {
        $vendorId = $this->getVendorUserId();
        $user = Auth::user();
        $profile = VendorProfile::findBy('user_id', $vendorId);

        $this->render('portal.vendor.store', [
            'pageTitle' => 'Store Profile & Policies — Pet Guard',
            'user' => $user,
            'profile' => $profile
        ], 'portal');
    }

    public function updateStore(): void
    {
        $vendorId = $this->getVendorUserId();
        $data = $this->validate($this->request->all(), [
            'store_name' => 'required|min:2|max:150',
            'phone' => 'required|min:6',
            'business_registration' => 'required',
            'description' => 'required|min:10'
        ]);

        User::update($vendorId, [
            'name' => $data['store_name'],
            'phone' => $data['phone']
        ]);

        $profile = VendorProfile::findBy('user_id', $vendorId);
        $payload = [
            'store_name' => $data['store_name'],
            'business_registration' => $data['business_registration'],
            'description' => $data['description'],
            'shipping_policy' => $this->request->input('shipping_policy', ''),
            'refund_policy' => $this->request->input('refund_policy', '')
        ];

        if ($profile) {
            VendorProfile::update($profile['id'], $payload);
        } else {
            $payload['user_id'] = $vendorId;
            VendorProfile::create($payload);
        }

        AuditLog::log('VENDOR_STORE_UPDATED', 'vendor_profiles', $vendorId);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Store profile and policies updated.');
        } else {
            Flash::success('Store profile and policies updated.');
            $this->redirect('vendor/store');
        }
    }

    /**
     * Products Management CRUD
     */
    public function products(): void
    {
        $vendorId = $this->getVendorUserId();
        $search = trim((string)$this->request->get('search', ''));
        $category = trim((string)$this->request->get('category', ''));
        $stockStatus = trim((string)$this->request->get('stock_status', ''));

        $products = Product::getForVendor($vendorId, $search, $category, $stockStatus);
        $categories = Category::all();

        $this->render('portal.vendor.products.index', [
            'pageTitle' => 'Store Products Catalog — Pet Guard',
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'selectedCategory' => $category,
            'selectedStock' => $stockStatus
        ], 'portal');
    }

    public function createProductView(): void
    {
        $categories = Category::all();
        $this->render('portal.vendor.products.create', [
            'pageTitle' => 'Add New Product — Pet Guard',
            'categories' => $categories
        ], 'portal');
    }

    public function createProduct(): void
    {
        $vendorId = $this->getVendorUserId();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:3|max:200',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $data['name'])));
        $sku = $this->request->input('sku') ?: 'PG-SKU-' . rand(1000, 9999);

        // Ensure unique slug
        $existing = Product::findBySlug($slug);
        if ($existing) {
            $slug .= '-' . rand(100, 999);
        }

        // Multi-Image Handling
        $uploadedImages = [];

        // Check multiple images array 'images'
        if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
            $fileCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                if (!empty($_FILES['images']['name'][$i]) && $_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                        $filename = 'prod_' . uniqid() . '_' . $i . '.' . $ext;
                        $dest = dirname(__DIR__) . '/assets/img/' . $filename;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $dest)) {
                            $uploadedImages[] = 'assets/img/' . $filename;
                        }
                    }
                }
            }
        }

        // Check single image fallback 'image'
        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $filename = 'prod_' . uniqid() . '.' . $ext;
                $dest = dirname(__DIR__) . '/assets/img/' . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    array_unshift($uploadedImages, 'assets/img/' . $filename);
                }
            }
        }

        $imgPath = !empty($uploadedImages) ? $uploadedImages[0] : 'assets/img/product-1.jpg';
        $stock = max(0, (int)$data['stock']);

        $productId = Product::create([
            'vendor_id' => $vendorId,
            'category' => $data['category'],
            'name' => $data['name'],
            'slug' => $slug,
            'sku' => $sku,
            'price' => (float)$data['price'],
            'old_price' => $this->request->input('old_price') ? (float)$this->request->input('old_price') : null,
            'sale_price' => $this->request->input('sale_price') ? (float)$this->request->input('sale_price') : null,
            'stock' => $stock,
            'in_stock' => $stock > 0 ? 1 : 0,
            'img' => $imgPath,
            'description' => $this->request->input('description', ''),
            'weight' => $this->request->input('weight', '1.0 kg'),
            'target_species' => $this->request->input('target_species', 'All Pets'),
            'is_deal_of_week' => (int)$this->request->input('is_deal_of_week', 0),
            'rating' => 5.0,
            'is_archived' => 0
        ]);

        // Save all uploaded photos to product_images table
        if (!empty($uploadedImages)) {
            foreach ($uploadedImages as $idx => $path) {
                ProductImage::create([
                    'product_id' => (int)$productId,
                    'img_path' => $path,
                    'is_primary' => $idx === 0 ? 1 : 0,
                    'sort_order' => $idx
                ]);
            }
        }

        AuditLog::log('PRODUCT_CREATED', 'products', $productId, ['name' => $data['name'], 'sku' => $sku]);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Product created successfully with ' . count($uploadedImages) . ' images.', ['product_id' => $productId]);
        } else {
            Flash::success('Product published to store catalog.');
            $this->redirect('vendor/products');
        }
    }

    /**
     * AI Product Metadata Generator Endpoint
     */
    public function aiGenerateProduct(): void
    {
        $this->getVendorUserId();
        $title = trim((string)$this->request->input('title', ''));
        if (empty($title)) {
            $this->jsonError('Please provide a product title or prompt.');
            return;
        }

        $categories = array_column(Category::all() ?? [], 'title');
        $aiService = new AiService();

        try {
            $data = $aiService->generateProductDetails($title, $categories);
            $this->jsonSuccess('Product details generated successfully by AI.', $data);
        } catch (\Exception $e) {
            $this->jsonError('AI generation failed: ' . $e->getMessage());
        }
    }

    /**
     * AI Instant Product Creator Endpoint (1-Click Auto Add)
     */
    public function aiCreateProductInstant(): void
    {
        $vendorId = $this->getVendorUserId();
        $this->validateCsrf();

        $title = trim((string)$this->request->input('title', ''));
        if (empty($title)) {
            Flash::error('Please provide a product title.');
            $this->redirect('vendor/products');
            return;
        }

        $categories = array_column(Category::all() ?? [], 'title');
        $aiService = new AiService();

        try {
            $data = $aiService->generateProductDetails($title, $categories);
            $slug = ViewHelper::slug($data['name']) . '-' . rand(100, 999);

            $productId = Product::create([
                'vendor_id' => $vendorId,
                'name' => $data['name'],
                'slug' => $slug,
                'sku' => $data['sku'],
                'category' => $data['category'],
                'price' => (float)$data['price'],
                'old_price' => !empty($data['old_price']) ? (float)$data['old_price'] : null,
                'stock' => (int)$data['stock'],
                'in_stock' => 1,
                'img' => 'img/product-1.jpg',
                'description' => $data['description'],
                'weight' => $data['weight'],
                'target_species' => $data['target_species'],
                'is_deal_of_week' => 0,
                'rating' => 5.0,
                'is_archived' => 0
            ]);

            AuditLog::log('AI_PRODUCT_CREATED', 'products', $productId, ['name' => $data['name'], 'sku' => $data['sku']]);

            if ($this->request->isAjax()) {
                $this->jsonSuccess("Product '{$data['name']}' automatically generated and added to catalog!", ['product_id' => $productId]);
            } else {
                Flash::success("AI generated product '{$data['name']}' published to catalog!");
                $this->redirect('vendor/products');
            }
        } catch (\Exception $e) {
            if ($this->request->isAjax()) {
                $this->jsonError('Failed to generate product: ' . $e->getMessage());
            } else {
                Flash::error('Failed to generate product: ' . $e->getMessage());
                $this->redirect('vendor/products');
            }
        }
    }

    public function productDetails(int|string $id): void
    {
        $product = Product::find($id);
        if (!$product) {
            Flash::error('Product not found.');
            $this->redirect('vendor/products');
        }

        $images = ProductImage::getForProduct((int)$id);

        $this->render('portal.vendor.products.details', [
            'pageTitle' => "Product: {$product['name']} — Pet Guard",
            'product' => $product,
            'images' => $images
        ], 'portal');
    }

    public function editProductView(int|string $id): void
    {
        $product = Product::find($id);
        if (!$product) {
            Flash::error('Product not found.');
            $this->redirect('vendor/products');
        }

        $categories = Category::all();
        $images = ProductImage::getForProduct((int)$id);

        $this->render('portal.vendor.products.edit', [
            'pageTitle' => "Edit Product: {$product['name']} — Pet Guard",
            'product' => $product,
            'categories' => $categories,
            'images' => $images
        ], 'portal');
    }

    public function updateProduct(int|string $id): void
    {
        $product = Product::find($id);
        if (!$product) {
            $this->jsonError('Product not found.');
        }

        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:3|max:200',
            'category' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        // Multi-Image Uploads for updates
        $uploadedImages = [];
        if (isset($_FILES['images']) && is_array($_FILES['images']['name'])) {
            $fileCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                if (!empty($_FILES['images']['name'][$i]) && $_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $ext = strtolower(pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                        $filename = 'prod_' . uniqid() . '_' . $i . '.' . $ext;
                        $dest = dirname(__DIR__) . '/assets/img/' . $filename;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $dest)) {
                            $uploadedImages[] = 'assets/img/' . $filename;
                        }
                    }
                }
            }
        }

        if (isset($_FILES['image']) && !empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                $filename = 'prod_' . uniqid() . '.' . $ext;
                $dest = dirname(__DIR__) . '/assets/img/' . $filename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $dest)) {
                    array_unshift($uploadedImages, 'assets/img/' . $filename);
                }
            }
        }

        $stock = max(0, (int)$data['stock']);
        $payload = [
            'name' => $data['name'],
            'category' => $data['category'],
            'price' => (float)$data['price'],
            'old_price' => $this->request->input('old_price') ? (float)$this->request->input('old_price') : null,
            'sale_price' => $this->request->input('sale_price') ? (float)$this->request->input('sale_price') : null,
            'stock' => $stock,
            'in_stock' => $stock > 0 ? 1 : 0,
            'description' => $this->request->input('description', $product['description']),
            'weight' => $this->request->input('weight', $product['weight'] ?? '1.0 kg'),
            'target_species' => $this->request->input('target_species', $product['target_species'] ?? 'All Pets'),
            'is_deal_of_week' => (int)$this->request->input('is_deal_of_week', $product['is_deal_of_week'])
        ];

        if (!empty($uploadedImages)) {
            $payload['img'] = $uploadedImages[0];
            foreach ($uploadedImages as $idx => $path) {
                ProductImage::create([
                    'product_id' => (int)$id,
                    'img_path' => $path,
                    'is_primary' => $idx === 0 ? 1 : 0,
                    'sort_order' => $idx
                ]);
            }
        }

        Product::update((int)$id, $payload);
        AuditLog::log('PRODUCT_UPDATED', 'products', (int)$id);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Product updated successfully.');
        } else {
            Flash::success('Product updated successfully.');
            $this->redirect('vendor/products/' . $id);
        }
    }

    public function deleteProductImage(int|string $productId, int|string $imageId): void
    {
        $this->getVendorUserId();
        $this->validateCsrf();

        $image = ProductImage::find((int)$imageId);
        if ($image && (int)$image['product_id'] === (int)$productId) {
            ProductImage::delete((int)$imageId);
            $this->jsonSuccess('Image removed from gallery.');
        } else {
            $this->jsonError('Image not found or unauthorized.');
        }
    }

    public function deleteProduct(int|string $id): void
    {
        $product = Product::find($id);
        if ($product) {
            // Soft delete/archive to preserve order history integrity
            Product::update((int)$id, ['is_archived' => 1]);
            AuditLog::log('PRODUCT_ARCHIVED', 'products', (int)$id);
            $this->jsonSuccess('Product removed from active catalog.');
        } else {
            $this->jsonError('Product not found.');
        }
    }

    /**
     * Inventory Management
     */
    public function inventory(): void
    {
        $vendorId = $this->getVendorUserId();
        $products = Product::where("(vendor_id = :vid OR vendor_id IS NULL) AND is_archived = 0", ['vid' => $vendorId], 'stock ASC');

        $this->render('portal.vendor.inventory', [
            'pageTitle' => 'Stock & Inventory Control — Pet Guard',
            'products' => $products
        ], 'portal');
    }

    public function updateStock(int|string $id): void
    {
        $newStock = (int)$this->request->input('stock', 0);
        $success = Product::updateStockLevel((int)$id, $newStock);

        if ($success) {
            AuditLog::log('INVENTORY_ADJUSTED', 'products', (int)$id, ['new_stock' => $newStock]);
            $this->jsonSuccess("Stock level updated to {$newStock} units.");
        } else {
            $this->jsonError('Unable to update stock level.');
        }
    }

    /**
     * Customer Orders Management
     */
    public function orders(): void
    {
        $orders = Order::where('1=1', [], 'id DESC');

        $this->render('portal.vendor.orders.index', [
            'pageTitle' => 'Customer Orders Fulfillment — Pet Guard',
            'orders' => $orders
        ], 'portal');
    }

    public function orderDetails(int|string $id): void
    {
        $order = Order::find($id);
        if (!$order) {
            Flash::error('Order not found.');
            $this->redirect('vendor/orders');
        }

        $items = OrderItem::getForOrder((int)$order['id']);
        $customer = User::find($order['user_id']);

        $this->render('portal.vendor.orders.details', [
            'pageTitle' => "Order #{$order['order_number']} — Pet Guard",
            'order' => $order,
            'items' => $items,
            'customer' => $customer
        ], 'portal');
    }

    public function updateOrderStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        $valid = ['pending', 'confirmed', 'processing', 'ready_to_ship', 'shipped', 'out_for_delivery', 'delivered', 'cancelled', 'refunded'];

        if (!in_array($status, $valid, true)) {
            $this->jsonError('Invalid order status.');
        }

        Order::update((int)$id, ['status' => $status]);
        AuditLog::log('ORDER_STATUS_UPDATED', 'orders', (int)$id, ['status' => $status]);

        if ($this->request->isAjax()) {
            $this->jsonSuccess("Order status updated to {$status}.");
        } else {
            Flash::success("Order status updated to {$status}.");
            $this->redirect('vendor/orders/' . $id);
        }
    }

    /**
     * Customers & Analytics Reports
     */
    public function customers(): void
    {
        $customers = User::query("SELECT DISTINCT u.*, COUNT(o.id) as order_count, SUM(o.total) as total_spent 
                                  FROM `users` u 
                                  JOIN `orders` o ON u.id = o.user_id 
                                  GROUP BY u.id 
                                  ORDER BY total_spent DESC");

        $this->render('portal.vendor.customers', [
            'pageTitle' => 'Customer Accounts & History — Pet Guard',
            'customers' => $customers
        ], 'portal');
    }

    public function reports(): void
    {
        $salesByMonth = Order::query("SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as count, SUM(total) as revenue 
                                      FROM `orders` 
                                      WHERE payment_status = 'paid' 
                                      GROUP BY DATE_FORMAT(created_at, '%Y-%m') 
                                      ORDER BY month DESC LIMIT 6");

        $this->render('portal.vendor.reports', [
            'pageTitle' => 'Store Sales & Performance Analytics — Pet Guard',
            'salesByMonth' => $salesByMonth
        ], 'portal');
    }
}
