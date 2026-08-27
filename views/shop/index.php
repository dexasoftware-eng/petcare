<?php
use Helpers\ViewHelper;

$selectedCategory = $selectedCategory ?? '';
$selectedSpecies = $selectedSpecies ?? '';
$sort = $sort ?? 'featured';
$search = $search ?? '';
$minPrice = $minPrice ?? '';
$maxPrice = $maxPrice ?? '';
?>

<!-- 1. Hero Marketplace Banner -->
<section class="banner" style="background-color: #fff8e5; background-image:url(<?= ViewHelper::asset('img/banner.png') ?>);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-8 mx-auto text-center px-3">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm text-dark small mb-3 border" style="max-width: 100%; word-break: break-word;">
                    <i class="fa-solid fa-shield-cat text-warning"></i>
                    <span class="fw-semibold text-dark">100% Certified Veterinary Diets &amp; Supplies</span>
                </div>
                <h1 class="text-dark fw-bold mb-2" style="font-family: 'Anybody', sans-serif; font-size: clamp(26px, 5vw, 42px); line-height: 1.25;">
                    Pet Care Shop &amp; Marketplace
                </h1>
                <p class="text-secondary mb-4 small" style="max-width: 580px; margin: 0 auto; line-height: 1.6;">
                    Discover clinical nutrition, mobility supplements, organic grooming, and smart safety gear for dogs, cats, and companion pets.
                </p>

                <!-- Search Input Bar in Hero -->
                <form action="<?= ViewHelper::url('our-products') ?>" method="GET" class="d-flex bg-white rounded-pill p-1 shadow border" style="max-width: 520px; margin: 0 auto; width: 100%;">
                    <?php if (!empty($selectedCategory)): ?>
                        <input type="hidden" name="category" value="<?= ViewHelper::e($selectedCategory) ?>">
                    <?php endif; ?>
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 bg-transparent py-2 shadow-none text-dark" placeholder="Search diets, joint care, flea drops..." value="<?= ViewHelper::e($search) ?>" style="font-size: 14px;">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-3 px-sm-4 fw-bold shadow-sm flex-shrink-0" style="font-size: 13.5px;">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- 2. Marketplace Main Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <div class="row g-4">
            
            <!-- Left Sidebar Filters (Desktop col-lg-3) -->
            <div class="col-lg-3">
                <div class="admin-card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-sliders text-brand me-2"></i> Filters
                        </h5>
                        <?php if (!empty($selectedCategory) || !empty($selectedSpecies) || !empty($search) || !empty($minPrice) || !empty($maxPrice)): ?>
                            <a href="<?= ViewHelper::url('our-products') ?>" class="text-danger small text-decoration-none fw-semibold">Clear All</a>
                        <?php endif; ?>
                    </div>

                    <!-- Category Filter -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px; font-size: 11px;">Categories</label>
                        <div class="d-flex flex-column gap-1">
                            <a href="<?= ViewHelper::url('our-products' . ($search ? '?search=' . urlencode($search) : '')) ?>" 
                               class="d-flex align-items-center justify-content-between p-2 rounded-3 text-decoration-none <?= empty($selectedCategory) ? 'bg-primary-subtle text-primary fw-bold' : 'text-dark hover-light' ?>" style="font-size: 13px;">
                                <span><i class="fa-solid fa-border-all me-2 opacity-50"></i> All Products</span>
                                <span class="badge bg-white text-dark border rounded-pill"><?= $totalCatalogCount ?? 0 ?></span>
                            </a>
                            <?php foreach ($categories as $cat): 
                                $isActive = ($selectedCategory === $cat['slug'] || $selectedCategory === $cat['title']);
                            ?>
                                <a href="<?= ViewHelper::url('our-products?category=' . urlencode($cat['slug']) . ($search ? '&search=' . urlencode($search) : '')) ?>" 
                                   class="d-flex align-items-center justify-content-between p-2 rounded-3 text-decoration-none <?= $isActive ? 'bg-primary-subtle text-primary fw-bold' : 'text-dark hover-light' ?>" style="font-size: 13px;">
                                    <span class="text-truncate me-2"><?= ViewHelper::e($cat['title']) ?></span>
                                    <span class="badge bg-light text-muted border rounded-pill"><?= (int)$cat['count'] ?></span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Species Filter Form -->
                    <form action="<?= ViewHelper::url('our-products') ?>" method="GET" id="speciesFilterForm">
                        <?php if (!empty($selectedCategory)): ?>
                            <input type="hidden" name="category" value="<?= ViewHelper::e($selectedCategory) ?>">
                        <?php endif; ?>
                        <?php if (!empty($search)): ?>
                            <input type="hidden" name="search" value="<?= ViewHelper::e($search) ?>">
                        <?php endif; ?>
                        <input type="hidden" name="sort" value="<?= ViewHelper::e($sort) ?>">

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px; font-size: 11px;">Target Species</label>
                            <div class="d-flex flex-column gap-2">
                                <label class="form-check d-flex align-items-center justify-content-between m-0 p-2 rounded-2 bg-light border cursor-pointer">
                                    <span class="form-check-label small fw-semibold text-dark">
                                        <input class="form-check-input me-2" type="radio" name="species" value="all" <?= (empty($selectedSpecies) || $selectedSpecies === 'all') ? 'checked' : '' ?> onchange="this.form.submit()"> All Species
                                    </span>
                                    <i class="fa-solid fa-paw text-muted small"></i>
                                </label>
                                <label class="form-check d-flex align-items-center justify-content-between m-0 p-2 rounded-2 bg-light border cursor-pointer">
                                    <span class="form-check-label small fw-semibold text-dark">
                                        <input class="form-check-input me-2" type="radio" name="species" value="Dog" <?= ($selectedSpecies === 'Dog') ? 'checked' : '' ?> onchange="this.form.submit()"> Dogs &amp; Puppies
                                    </span>
                                    <i class="fa-solid fa-dog text-muted small"></i>
                                </label>
                                <label class="form-check d-flex align-items-center justify-content-between m-0 p-2 rounded-2 bg-light border cursor-pointer">
                                    <span class="form-check-label small fw-semibold text-dark">
                                        <input class="form-check-input me-2" type="radio" name="species" value="Cat" <?= ($selectedSpecies === 'Cat') ? 'checked' : '' ?> onchange="this.form.submit()"> Cats &amp; Kittens
                                    </span>
                                    <i class="fa-solid fa-cat text-muted small"></i>
                                </label>
                                <label class="form-check d-flex align-items-center justify-content-between m-0 p-2 rounded-2 bg-light border cursor-pointer">
                                    <span class="form-check-label small fw-semibold text-dark">
                                        <input class="form-check-input me-2" type="radio" name="species" value="Bird" <?= ($selectedSpecies === 'Bird') ? 'checked' : '' ?> onchange="this.form.submit()"> Birds &amp; Exotics
                                    </span>
                                    <i class="fa-solid fa-dove text-muted small"></i>
                                </label>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-uppercase text-muted" style="letter-spacing: 0.5px; font-size: 11px;">Price Range ($)</label>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <input type="number" name="min_price" class="form-control form-control-sm rounded-3" placeholder="Min" value="<?= $minPrice !== '' ? ViewHelper::e($minPrice) : '' ?>" min="0" step="5">
                                <span class="text-muted">-</span>
                                <input type="number" name="max_price" class="form-control form-control-sm rounded-3" placeholder="Max" value="<?= $maxPrice !== '' ? ViewHelper::e($maxPrice) : '' ?>" min="0" step="5">
                            </div>
                            <button type="submit" class="btn btn-sm btn-outline-dark rounded-pill w-100 fw-bold">Apply Price</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Main Marketplace Grid (col-lg-9) -->
            <div class="col-lg-9">
                
                <!-- Sort & Header Bar -->
                <div class="admin-card border-0 shadow-sm rounded-4 p-3 mb-4 bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <div>
                        <span class="text-dark fw-bold" style="font-size: 14.5px;">
                            Showing <?= count($products) ?> Products
                        </span>
                        <?php if (!empty($search)): ?>
                            <span class="text-muted small ms-1">for "<strong><?= ViewHelper::e($search) ?></strong>"</span>
                        <?php endif; ?>
                    </div>

                    <!-- Sort By Selector -->
                    <div class="d-flex align-items-center gap-2">
                        <label class="text-muted small text-nowrap fw-semibold">Sort By:</label>
                        <select class="form-select form-select-sm rounded-pill shadow-none border" style="width: 185px; font-size: 13px;" onchange="window.location.href = this.value;">
                            <?php
                            $buildSortUrl = function($sortKey) use ($selectedCategory, $selectedSpecies, $search, $minPrice, $maxPrice) {
                                $params = ['sort' => $sortKey];
                                if (!empty($selectedCategory)) $params['category'] = $selectedCategory;
                                if (!empty($selectedSpecies)) $params['species'] = $selectedSpecies;
                                if (!empty($search)) $params['search'] = $search;
                                if ($minPrice !== '' && $minPrice !== null) $params['min_price'] = $minPrice;
                                if ($maxPrice !== '' && $maxPrice !== null) $params['max_price'] = $maxPrice;
                                return ViewHelper::url('our-products?' . http_build_query($params));
                            };
                            ?>
                            <option value="<?= $buildSortUrl('featured') ?>" <?= $sort === 'featured' ? 'selected' : '' ?>>Featured / Deals</option>
                            <option value="<?= $buildSortUrl('price_low') ?>" <?= $sort === 'price_low' ? 'selected' : '' ?>>Price: Low to High</option>
                            <option value="<?= $buildSortUrl('price_high') ?>" <?= $sort === 'price_high' ? 'selected' : '' ?>>Price: High to Low</option>
                            <option value="<?= $buildSortUrl('rating') ?>" <?= $sort === 'rating' ? 'selected' : '' ?>>Highest Rated</option>
                            <option value="<?= $buildSortUrl('newest') ?>" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest Arrivals</option>
                        </select>
                    </div>
                </div>

                <!-- Products Grid -->
                <?php if (empty($products)): ?>
                    <div class="admin-card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4">
                        <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3 text-muted" style="width: 72px; height: 72px; background: #f1f5f9; font-size: 28px;">
                            <i class="fa-solid fa-box-open"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-2">No Products Found</h4>
                        <p class="text-muted small mb-4">We couldn't find any products matching your specific filters. Try expanding your search or clearing price/category constraints.</p>
                        <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-admin-primary rounded-pill px-4">View All Products</a>
                    </div>
                <?php else: ?>
                    <div class="row g-4">
                        <?php foreach ($products as $prod): 
                            $isFav = ViewHelper::isInWishlist((int)$prod['id']);
                            $hasDiscount = !empty($prod['old_price']) && (float)$prod['old_price'] > (float)$prod['price'];
                        ?>
                            <div class="col-6 col-md-6 col-lg-4">
                                <div class="admin-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column bg-white overflow-hidden position-relative product-hover-card" style="transition: all 0.3s ease;">
                                    
                                    <!-- Badges & Wishlist Trigger Top Bar -->
                                    <div class="position-absolute top-0 start-0 end-0 p-3 d-flex justify-content-between align-items-start z-2 pointer-events-none">
                                        <div>
                                            <?php if (!empty($prod['is_deal_of_week'])): ?>
                                                <span class="badge bg-warning text-dark border-0 rounded-pill px-2 py-1 shadow-sm" style="font-size: 10px; font-weight: 700;">
                                                    <i class="fa-solid fa-bolt me-1"></i> DEAL
                                                </span>
                                            <?php elseif ($hasDiscount): ?>
                                                <span class="badge bg-danger text-white rounded-pill px-2 py-1 shadow-sm" style="font-size: 10px; font-weight: 700;">
                                                    SALE
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Wishlist Heart Button -->
                                        <button type="button" class="btn btn-sm btn-white bg-white rounded-circle shadow-sm border p-0 d-flex align-items-center justify-content-center pointer-events-auto wishlist-toggle-btn" 
                                                style="width: 34px; height: 34px; transition: transform 0.2s ease;" 
                                                data-product-id="<?= $prod['id'] ?>"
                                                onclick="toggleMarketWishlist(this, <?= $prod['id'] ?>)"
                                                title="<?= $isFav ? 'Remove from Wishlist' : 'Add to Wishlist' ?>">
                                            <i class="<?= $isFav ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-muted' ?>" style="font-size: 15px;"></i>
                                        </button>
                                    </div>

                                    <!-- Product Image Showcase -->
                                    <a href="<?= ViewHelper::url('product-details/' . $prod['slug']) ?>" class="d-flex align-items-center justify-content-center p-4 bg-light text-decoration-none" style="height: 220px; overflow: hidden;">
                                        <img src="<?= ViewHelper::asset($prod['img']) ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="img-fluid product-img-zoom" style="max-height: 180px; object-fit: contain; transition: transform 0.3s ease;">
                                    </a>

                                    <!-- Product Information Body -->
                                    <div class="p-3 p-md-4 d-flex flex-column flex-grow-1">
                                        <!-- Category & Species Tag -->
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <span class="text-muted small text-truncate" style="font-size: 11.5px;">
                                                <?= ViewHelper::e($prod['category']) ?>
                                            </span>
                                            <span class="badge bg-light text-dark border rounded-pill px-2 py-0" style="font-size: 10px;">
                                                <i class="fa-solid fa-paw text-brand me-1"></i><?= ViewHelper::e($prod['target_species'] ?? 'All') ?>
                                            </span>
                                        </div>

                                        <!-- Product Title -->
                                        <h5 class="fw-bold mb-2" style="font-size: 14.5px; line-height: 1.4; height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                            <a href="<?= ViewHelper::url('product-details/' . $prod['slug']) ?>" class="text-dark text-decoration-none hover-brand">
                                                <?= ViewHelper::e($prod['name']) ?>
                                            </a>
                                        </h5>

                                        <!-- Rating Stars -->
                                        <div class="d-flex align-items-center gap-1 mb-3">
                                            <div class="text-warning small" style="font-size: 11px;">
                                                <?php 
                                                $rating = (float)($prod['rating'] ?? 5.0);
                                                for ($i = 1; $i <= 5; $i++): 
                                                    if ($i <= $rating): ?>
                                                        <i class="fa-solid fa-star"></i>
                                                    <?php else: ?>
                                                        <i class="fa-regular fa-star"></i>
                                                    <?php endif;
                                                endfor; ?>
                                            </div>
                                            <span class="text-muted small" style="font-size: 11px;">(<?= (int)($prod['reviews_count'] ?? 12) ?>)</span>
                                        </div>

                                        <!-- Price & Add to Cart Footer -->
                                        <div class="mt-auto pt-2 border-top d-flex align-items-center justify-content-between">
                                            <div>
                                                <div class="fw-bold text-dark" style="font-size: 16px;">
                                                    $<?= number_format((float)$prod['price'], 2) ?>
                                                </div>
                                                <?php if ($hasDiscount): ?>
                                                    <div class="text-muted text-decoration-line-through small" style="font-size: 11px;">
                                                        $<?= number_format((float)$prod['old_price'], 2) ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Add to Cart AJAX Button -->
                                            <button type="button" class="btn btn-sm btn-admin-primary rounded-pill px-3 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-1 add-to-cart-ajax-btn"
                                                    onclick="quickAddToCart(<?= $prod['id'] ?>, '<?= addslashes($prod['name']) ?>')">
                                                <i class="fa-solid fa-cart-plus"></i>
                                                <span class="d-none d-sm-inline">Add</span>
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
                    <?php 
                    $totalPages = (int)($pagination['total_pages'] ?? $pagination['totalPages'] ?? 1);
                    $currentPage = (int)($pagination['current_page'] ?? $pagination['page'] ?? 1);
                    if ($totalPages > 1): 
                    ?>
                        <div class="d-flex justify-content-center mt-5">
                            <nav aria-label="Product pages">
                                <ul class="pagination pagination-rounded gap-1">
                                    <?php for ($p = 1; $p <= $totalPages; $p++): 
                                        $pageUrl = ViewHelper::url('our-products?' . http_build_query(array_merge($_GET, ['page' => $p])));
                                    ?>
                                        <li class="page-item <?= $p === $currentPage ? 'active' : '' ?>">
                                            <a class="page-link rounded-circle px-3 py-2 fw-bold" href="<?= $pageUrl ?>"><?= $p ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<style>
.product-hover-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 16px 30px -10px rgba(15, 23, 42, 0.15) !important;
}
.product-hover-card:hover .product-img-zoom {
    transform: scale(1.06);
}
.hover-brand:hover {
    color: #fa441d !important;
}
.hover-light:hover {
    background-color: #f1f5f9;
}
.cursor-pointer {
    cursor: pointer;
}
</style>

<script>
async function quickAddToCart(productId, productName) {
    try {
        const res = await PetGuardAjax.post('cart/add', { product_id: productId, quantity: 1 });
        if (res.ok && res.data.success) {
            PetGuardToast.success(`Added "${productName}" to your cart!`);
            // Update cart badge in header if exists
            const cartBadges = document.querySelectorAll('a[href*="shop-cart"] span.badge');
            cartBadges.forEach(b => {
                b.textContent = res.data.cartCount || (parseInt(b.textContent || '0') + 1);
            });
        } else {
            PetGuardToast.error('Could not add product to cart.');
        }
    } catch (e) {
        PetGuardToast.error('An unexpected error occurred.');
    }
}

async function toggleMarketWishlist(btn, productId) {
    btn.style.transform = 'scale(1.25)';
    setTimeout(() => btn.style.transform = 'scale(1)', 200);

    try {
        const res = await PetGuardAjax.post('wishlist/toggle', { product_id: productId });
        if (res.ok && res.data.success) {
            const icon = btn.querySelector('i');
            if (res.data.in_wishlist) {
                icon.className = 'fa-solid fa-heart text-danger';
                btn.title = 'Remove from Wishlist';
                PetGuardToast.success(res.data.message);
            } else {
                icon.className = 'fa-regular fa-heart text-muted';
                btn.title = 'Add to Wishlist';
                PetGuardToast.info(res.data.message);
            }

            // Update header wishlist counters
            const wishlistBadges = document.querySelectorAll('a[href*="wishlist"] span.badge');
            wishlistBadges.forEach(b => {
                b.textContent = res.data.count;
            });
        }
    } catch (e) {
        PetGuardToast.error('Wishlist update failed.');
    }
}
</script>
