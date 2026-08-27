<?php
use Helpers\ViewHelper;
?>

<!-- Banner Section -->
<section class="banner shop-hero-banner">
    <div class="container position-relative z-1">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill hero-badge mb-3 shadow-sm">
                    <i class="fa-solid fa-heart text-danger"></i>
                    <span class="fw-semibold">Personal Saved Items</span>
                </div>
                <h1 class="text-white fw-bold mb-2 hero-title" style="font-family: 'Anybody', sans-serif;">My Wishlist</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center m-0" style="background: transparent;">
                        <li class="breadcrumb-item"><a href="<?= ViewHelper::url() ?>" class="text-decoration-none">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= ViewHelper::url('our-products') ?>" class="text-decoration-none">Shop</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Wishlist Content Section -->
<section class="gap py-5" style="background: #f8fafc;">
    <div class="container">
        <?php if (empty($products)): ?>
            <!-- Empty State -->
            <div class="admin-card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4" style="max-width: 650px; margin: 0 auto;">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4 text-muted" style="width: 88px; height: 88px; background: #fef2f2; color: #ef4444; font-size: 38px;">
                    <i class="fa-regular fa-heart"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2" style="font-family: 'Anybody', sans-serif;">Your Wishlist is Empty</h3>
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    Explore our curated catalog of veterinarian-approved nutrition, joint care supplements, organic grooming essentials, and smart pet accessories.
                </p>
                <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 14px;">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Explore Products Catalog</span>
                </a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            Saved Items (<?= count($products) ?>)
                        </h4>
                        <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                            <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>

                    <div class="admin-card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="table-responsive m-0">
                            <table class="table table-hover align-middle m-0">
                                <thead class="bg-light text-muted small border-bottom">
                                    <tr>
                                        <th class="ps-4 py-3 fw-semibold">Product</th>
                                        <th class="py-3 fw-semibold">Category &amp; Species</th>
                                        <th class="py-3 fw-semibold">Price</th>
                                        <th class="py-3 fw-semibold">Stock Status</th>
                                        <th class="py-3 text-end pe-4 fw-semibold">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $prod): 
                                        $inStock = (int)$prod['in_stock'] === 1 && (int)($prod['stock'] ?? 0) > 0;
                                    ?>
                                        <tr id="wishlistRow-<?= $prod['id'] ?>">
                                            <!-- Product Thumbnail & Title -->
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="<?= ViewHelper::url('product-details/' . $prod['slug']) ?>" class="flex-shrink-0 rounded-3 border p-1 bg-light d-flex align-items-center justify-content-center" style="width: 64px; height: 64px;">
                                                        <img src="<?= ViewHelper::asset($prod['img']) ?>" alt="<?= ViewHelper::e($prod['name']) ?>" class="img-fluid rounded-2" style="max-height: 54px; object-fit: contain;">
                                                    </a>
                                                    <div>
                                                        <a href="<?= ViewHelper::url('product-details/' . $prod['slug']) ?>" class="fw-bold text-dark text-decoration-none d-block hover-brand" style="font-size: 14px;">
                                                            <?= ViewHelper::e($prod['name']) ?>
                                                        </a>
                                                        <span class="text-muted small font-monospace" style="font-size: 11px;">SKU: <?= ViewHelper::e($prod['sku']) ?></span>
                                                    </div>
                                                </div>
                                            </td>

                                            <!-- Category -->
                                            <td class="py-3">
                                                <span class="badge bg-light text-dark border px-2 py-1 rounded-pill small" style="font-size: 11.5px;">
                                                    <?= ViewHelper::e($prod['category']) ?>
                                                </span>
                                                <span class="d-block text-muted small mt-1" style="font-size: 11px;">
                                                    <i class="fa-solid fa-paw me-1 text-muted"></i><?= ViewHelper::e($prod['target_species'] ?? 'All Pets') ?>
                                                </span>
                                            </td>

                                            <!-- Price -->
                                            <td class="py-3">
                                                <div class="fw-bold text-dark" style="font-size: 15px;">$<?= number_format((float)$prod['price'], 2) ?></div>
                                                <?php if (!empty($prod['old_price'])): ?>
                                                    <span class="text-muted text-decoration-line-through small" style="font-size: 11.5px;">$<?= number_format((float)$prod['old_price'], 2) ?></span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Stock Status -->
                                            <td class="py-3">
                                                <?php if ($inStock): ?>
                                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
                                                        <i class="fa-solid fa-circle-check me-1"></i> In Stock (<?= (int)$prod['stock'] ?>)
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1" style="font-size: 11px;">
                                                        <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                                                    </span>
                                                <?php endif; ?>
                                            </td>

                                            <!-- Actions -->
                                            <td class="py-3 text-end pe-4">
                                                <div class="d-inline-flex align-items-center gap-2">
                                                    <?php if ($inStock): ?>
                                                        <form action="<?= ViewHelper::url('wishlist/move-to-cart/' . $prod['id']) ?>" method="POST" class="m-0">
                                                            <?= ViewHelper::csrfField() ?>
                                                            <button type="submit" class="btn btn-sm btn-admin-primary rounded-pill px-3 fw-bold shadow-sm" style="font-size: 12px;">
                                                                <i class="fa-solid fa-cart-shopping me-1"></i> Move to Cart
                                                            </button>
                                                        </form>
                                                    <?php else: ?>
                                                        <button type="button" class="btn btn-sm btn-light rounded-pill px-3 disabled" style="font-size: 12px;">
                                                            Unavailable
                                                        </button>
                                                    <?php endif; ?>

                                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 d-inline-flex align-items-center justify-content-center" style="width: 32px; height: 32px;" onclick="removeFromWishlist(<?= $prod['id'] ?>)" title="Remove from Wishlist">
                                                        <i class="fa-solid fa-trash-can" style="font-size: 12px;"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
async function removeFromWishlist(productId) {
    if (!confirm('Remove this product from your saved wishlist?')) return;

    const res = await PetGuardAjax.post(`wishlist/remove/${productId}`);
    if (res.ok) {
        const row = document.getElementById(`wishlistRow-${productId}`);
        if (row) {
            row.style.transition = 'opacity 0.3s ease';
            row.style.opacity = '0';
            setTimeout(() => {
                row.remove();
                window.location.reload();
            }, 300);
        }
        PetGuardToast.info('Product removed from wishlist.');
    } else {
        PetGuardToast.error('Failed to remove item.');
    }
}
</script>
