<?php
use Helpers\ViewHelper;

$images = $images ?? [];
$isFav = ViewHelper::isInWishlist((int)$product['id']);
$hasDiscount = !empty($product['old_price']) && (float)$product['old_price'] > (float)$product['price'];
?>

<!-- 1. Breadcrumb Banner -->
<section class="banner shop-hero-banner" style="background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <span class="badge bg-white bg-opacity-25 text-white px-3 py-1 rounded-pill mb-2 small hero-badge">
                    <?= ViewHelper::e($product['category']) ?>
                </span>
                <h1 class="text-white fw-bold mb-2 hero-title" style="font-family: 'Anybody', sans-serif;">
                    <?= ViewHelper::e($product['name']) ?>
                </h1>
                <ul class="d-inline-flex list-unstyled gap-2 text-white small justify-content-center m-0">
                    <li><a href="<?= ViewHelper::url() ?>" class="text-white text-decoration-none">Home</a></li>
                    <li>/</li>
                    <li><a href="<?= ViewHelper::url('our-products') ?>" class="text-white text-decoration-none">Shop</a></li>
                    <li>/</li>
                    <li class="text-white opacity-75 text-truncate" style="max-width: 250px;"><?= ViewHelper::e($product['name']) ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- 2. Product Details Section -->
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container">
        <div class="admin-card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-5">
            <div class="row g-5 align-items-center">
                
                <!-- Left: Product Image & Gallery -->
                <div class="col-lg-6">
                    <div class="p-4 rounded-4 bg-light position-relative d-flex align-items-center justify-content-center mb-3" style="min-height: 380px; overflow: hidden;">
                        <?php if (!empty($product['is_deal_of_week'])): ?>
                            <span class="badge bg-warning text-dark position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 fw-bold shadow-sm" style="font-size: 11px;">
                                <i class="fa-solid fa-bolt me-1"></i> DEAL OF THE WEEK
                            </span>
                        <?php elseif ($hasDiscount): ?>
                            <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 fw-bold shadow-sm" style="font-size: 11px;">
                                SALE
                            </span>
                        <?php endif; ?>
                        
                        <img id="mainProductPhoto" src="<?= ViewHelper::asset($product['img']) ?>" alt="<?= ViewHelper::e($product['name']) ?>" class="img-fluid" style="max-height: 340px; object-fit: contain; transition: transform 0.3s ease;">
                    </div>

                    <!-- Gallery Thumbnails -->
                    <?php if (!empty($images) && count($images) > 1): ?>
                        <div class="d-flex gap-2 justify-content-center flex-wrap">
                            <?php foreach ($images as $idx => $img): ?>
                                <button type="button" class="btn p-1 bg-light rounded-3 border <?= $idx === 0 ? 'border-primary shadow-sm' : '' ?>" style="width: 65px; height: 65px;" onclick="switchMainPhoto('<?= ViewHelper::asset($img['img_path']) ?>', this)">
                                    <img src="<?= ViewHelper::asset($img['img_path']) ?>" class="img-fluid rounded-2" style="max-height: 50px; object-fit: contain;">
                                </button>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Right: Product Specifications & Actions -->
                <div class="col-lg-6">
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-1 rounded-pill small fw-bold">
                            <?= ViewHelper::e($product['category']) ?>
                        </span>
                        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">
                            <i class="fa-solid fa-paw text-brand me-1"></i><?= ViewHelper::e($product['target_species'] ?? 'All Pets') ?>
                        </span>
                    </div>

                    <h2 class="fw-bold text-dark mb-3" style="font-family: 'Anybody', sans-serif; font-size: 26px; line-height: 1.3;">
                        <?= ViewHelper::e($product['name']) ?>
                    </h2>
                    
                    <!-- Rating & Reviews -->
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <div class="text-warning small" style="font-size: 13px;">
                            <?php 
                            $rating = (float)($product['rating'] ?? 5.0);
                            for ($i = 1; $i <= 5; $i++): 
                                if ($i <= $rating): ?>
                                    <i class="fa-solid fa-star"></i>
                                <?php else: ?>
                                    <i class="fa-regular fa-star"></i>
                                <?php endif;
                            endfor; ?>
                        </div>
                        <span class="fw-bold text-dark small"><?= number_format($rating, 1) ?></span>
                        <span class="text-muted small">(<?= (int)($product['reviews_count'] ?? 12) ?> verified clinical reviews)</span>
                    </div>

                    <!-- Pricing -->
                    <div class="mb-4 d-flex align-items-baseline gap-3">
                        <span class="display-6 fw-bold text-brand" style="font-size: 32px;">$<?= number_format((float)$product['price'], 2) ?></span>
                        <?php if ($hasDiscount): ?>
                            <span class="text-muted text-decoration-line-through fs-5">$<?= number_format((float)$product['old_price'], 2) ?></span>
                            <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                                Save $<?= number_format((float)$product['old_price'] - (float)$product['price'], 2) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <p class="text-secondary leading-relaxed mb-4" style="font-size: 14.5px; line-height: 1.6;">
                        <?= nl2br(ViewHelper::e($product['description'])) ?>
                    </p>

                    <!-- Product Meta Attributes -->
                    <div class="p-3 rounded-3 bg-light border mb-4">
                        <div class="row g-2 small">
                            <div class="col-6"><strong>SKU:</strong> <span class="text-muted font-monospace"><?= ViewHelper::e($product['sku'] ?? 'N/A') ?></span></div>
                            <div class="col-6"><strong>Package Size:</strong> <span class="text-dark fw-semibold"><?= ViewHelper::e($product['weight'] ?? 'Standard') ?></span></div>
                            <div class="col-6"><strong>Target Pet:</strong> <span class="text-dark fw-semibold"><?= ViewHelper::e($product['target_species'] ?? 'All Pets') ?></span></div>
                            <div class="col-6"><strong>Availability:</strong> 
                                <?php if ((int)$product['in_stock'] === 1 && (int)($product['stock'] ?? 0) > 0): ?>
                                    <span class="text-success fw-bold"><i class="fa-solid fa-circle-check me-1"></i> In Stock (<?= (int)$product['stock'] ?>)</span>
                                <?php else: ?>
                                    <span class="text-danger fw-bold"><i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Cart & Wishlist Actions -->
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-inline-flex align-items-center border rounded-pill bg-light p-1" style="width: 120px;">
                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none px-2" onclick="adjustQty(-1)"><i class="fa-solid fa-minus" style="font-size: 11px;"></i></button>
                            <input type="number" id="detailQtyInput" value="1" min="1" max="<?= (int)($product['stock'] ?? 99) ?>" class="form-control form-control-sm border-0 bg-transparent text-center fw-bold shadow-none p-0" style="font-size: 15px;">
                            <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none px-2" onclick="adjustQty(1)"><i class="fa-solid fa-plus" style="font-size: 11px;"></i></button>
                        </div>

                        <button type="button" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm flex-grow-1 d-inline-flex align-items-center justify-content-center gap-2" onclick="addDetailsToCart(<?= $product['id'] ?>, '<?= addslashes($product['name']) ?>')">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span>Add to Cart</span>
                        </button>

                        <button type="button" class="btn btn-outline-secondary rounded-circle shadow-sm p-0 d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;" onclick="toggleDetailsWishlist(this, <?= $product['id'] ?>)" title="Save to Wishlist">
                            <i class="<?= $isFav ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart text-muted' ?>" style="font-size: 18px;"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <?php if (!empty($relatedProducts)): ?>
            <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                        Related Clinical Nutrition &amp; Care
                    </h3>
                    <a href="<?= ViewHelper::url('our-products?category=' . urlencode($product['category'])) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">
                        View More in <?= ViewHelper::e($product['category']) ?>
                    </a>
                </div>
                <div class="row g-4">
                    <?php foreach ($relatedProducts as $rel): ?>
                        <div class="col-6 col-md-6 col-lg-3">
                            <div class="admin-card border-0 shadow-sm rounded-4 h-100 d-flex flex-column bg-white overflow-hidden p-3">
                                <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="d-flex align-items-center justify-content-center p-3 bg-light rounded-3 mb-3 text-decoration-none" style="height: 160px;">
                                    <img src="<?= ViewHelper::asset($rel['img']) ?>" alt="<?= ViewHelper::e($rel['name']) ?>" class="img-fluid" style="max-height: 130px; object-fit: contain;">
                                </a>
                                <div class="text-muted small mb-1" style="font-size: 11px;"><?= ViewHelper::e($rel['category']) ?></div>
                                <h6 class="fw-bold mb-2 text-truncate">
                                    <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="text-dark text-decoration-none hover-brand">
                                        <?= ViewHelper::e($rel['name']) ?>
                                    </a>
                                </h6>
                                <div class="d-flex justify-content-between align-items-center mt-auto pt-2 border-top">
                                    <span class="fw-bold text-dark">$<?= number_format((float)$rel['price'], 2) ?></span>
                                    <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3 fw-semibold" style="font-size: 12px;">
                                        View
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>

<script>
function switchMainPhoto(src, btn) {
    document.getElementById('mainProductPhoto').src = src;
    document.querySelectorAll('.btn-group button, .d-flex button').forEach(b => b.classList.remove('border-primary', 'shadow-sm'));
    btn.classList.add('border-primary', 'shadow-sm');
}

function adjustQty(delta) {
    const input = document.getElementById('detailQtyInput');
    let val = parseInt(input.value || '1') + delta;
    if (val < 1) val = 1;
    input.value = val;
}

async function addDetailsToCart(productId, productName) {
    const qty = parseInt(document.getElementById('detailQtyInput').value || '1');
    try {
        const res = await PetGuardAjax.post('cart/add', { product_id: productId, quantity: qty });
        if (res.ok && res.data.success) {
            PetGuardToast.success(`Added (${qty}) "${productName}" to your cart!`);
            const cartBadges = document.querySelectorAll('a[href*="shop-cart"] span.badge');
            cartBadges.forEach(b => {
                b.textContent = res.data.cartCount || (parseInt(b.textContent || '0') + qty);
            });
        } else {
            PetGuardToast.error('Could not add product to cart.');
        }
    } catch (e) {
        PetGuardToast.error('An unexpected error occurred.');
    }
}

async function toggleDetailsWishlist(btn, productId) {
    try {
        const res = await PetGuardAjax.post('wishlist/toggle', { product_id: productId });
        if (res.ok && res.data.success) {
            const icon = btn.querySelector('i');
            if (res.data.in_wishlist) {
                icon.className = 'fa-solid fa-heart text-danger';
                PetGuardToast.success(res.data.message);
            } else {
                icon.className = 'fa-regular fa-heart text-muted';
                PetGuardToast.info(res.data.message);
            }
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
