<?php
use Helpers\ViewHelper;

$cart = $cart ?? [];
$subtotal = $subtotal ?? 0.0;
$coupon = $coupon ?? null;
$discount = $discount ?? 0.0;
$shipping = $shipping ?? 0.0;
$total = $total ?? 0.0;

$freeShippingThreshold = 50.0;
$neededForFreeShip = max(0.0, $freeShippingThreshold - ($subtotal - $discount));
$progressPercent = min(100, round((($subtotal - $discount) / $freeShippingThreshold) * 100));
?>

<!-- 1. Hero Banner -->
<section class="banner" style="background-color: #fff8e5; background-image:url(<?= ViewHelper::asset('img/banner.png') ?>);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm text-dark small mb-3 border">
                    <i class="fa-solid fa-cart-shopping text-warning"></i>
                    <span class="fw-semibold text-dark">Review &amp; Update Order</span>
                </div>
                <h1 class="text-dark fw-bold mb-2" style="font-family: 'Anybody', sans-serif; font-size: clamp(26px, 5vw, 40px);">
                    Shopping Cart
                </h1>
                <ul class="d-inline-flex list-unstyled gap-2 text-muted small justify-content-center m-0 align-items-center">
                    <li><a href="<?= ViewHelper::url() ?>" class="text-dark fw-semibold text-decoration-none hover-brand">Home</a></li>
                    <li class="text-muted">/</li>
                    <li><a href="<?= ViewHelper::url('our-products') ?>" class="text-dark fw-semibold text-decoration-none hover-brand">Shop</a></li>
                    <li class="text-muted">/</li>
                    <li class="text-brand fw-bold">Cart</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- 2. Cart Content Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <?php if (empty($cart)): ?>
            <!-- Empty Cart State -->
            <div class="admin-card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4" style="max-width: 620px; margin: 0 auto;">
                <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-4 text-muted" style="width: 88px; height: 88px; background: #fff2ee; color: #fa441d; font-size: 38px;">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <h3 class="fw-bold text-dark mb-2" style="font-family: 'Anybody', sans-serif;">Your Cart is Currently Empty</h3>
                <p class="text-muted small mb-4" style="line-height: 1.6;">
                    Looks like you haven't added any products to your cart yet. Check out our certified pet diets, supplements, and accessories.
                </p>
                <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Explore Products</span>
                </a>
            </div>
        <?php else: ?>
            <div class="row g-4">
                
                <!-- Left: Cart Items Table (col-lg-8) -->
                <div class="col-lg-8">
                    
                    <!-- Free Shipping Goal Banner -->
                    <div class="p-3 mb-4 rounded-4 bg-white border shadow-sm">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div class="small fw-bold text-dark">
                                <?php if ($neededForFreeShip <= 0): ?>
                                    <span class="text-success"><i class="fa-solid fa-circle-check me-1"></i> You unlocked <strong>FREE Standard Delivery</strong>!</span>
                                <?php else: ?>
                                    <i class="fa-solid fa-truck-fast text-brand me-1"></i> Add <strong>$<?= number_format($neededForFreeShip, 2) ?></strong> more for <strong>FREE Shipping</strong>!
                                <?php endif; ?>
                            </div>
                            <span class="small fw-bold text-muted"><?= $progressPercent ?>%</span>
                        </div>
                        <div class="progress rounded-pill" style="height: 7px;">
                            <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: <?= $progressPercent ?>%;" aria-valuenow="<?= $progressPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Items Card -->
                    <div class="admin-card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
                        <div class="admin-card-header bg-white border-bottom p-4 d-flex justify-content-between align-items-center">
                            <h4 class="admin-card-title m-0 fw-bold" style="font-family: 'Anybody', sans-serif;">
                                Cart Items (<?= count($cart) ?>)
                            </h4>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="clearCart()">
                                <i class="fa-solid fa-trash-can me-1"></i> Clear Cart
                            </button>
                        </div>
                        
                        <div class="table-responsive m-0">
                            <table class="table table-hover align-middle m-0">
                                <thead class="bg-light text-muted small border-bottom">
                                    <tr>
                                        <th class="ps-4 py-3 fw-semibold">Product</th>
                                        <th class="py-3 fw-semibold">Price</th>
                                        <th class="py-3 fw-semibold text-center">Quantity</th>
                                        <th class="py-3 fw-semibold text-end">Subtotal</th>
                                        <th class="py-3 text-center pe-4" style="width: 50px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $id => $item): 
                                        $lineSubtotal = (float)$item['price'] * (int)$item['quantity'];
                                    ?>
                                        <tr id="cartRow-<?= $id ?>">
                                            <td class="ps-4 py-3">
                                                <div class="d-flex align-items-center gap-3">
                                                    <a href="<?= ViewHelper::url('product-details/' . ($item['slug'] ?? '')) ?>" class="flex-shrink-0 rounded-3 border p-1 bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                                        <img src="<?= ViewHelper::asset($item['img'] ?? 'img/food-1.png') ?>" alt="<?= ViewHelper::e($item['name']) ?>" class="img-fluid rounded-2" style="max-height: 50px; object-fit: contain;">
                                                    </a>
                                                    <div>
                                                        <a href="<?= ViewHelper::url('product-details/' . ($item['slug'] ?? '')) ?>" class="fw-bold text-dark text-decoration-none d-block hover-brand" style="font-size: 14px;">
                                                            <?= ViewHelper::e($item['name']) ?>
                                                        </a>
                                                        <span class="text-muted small" style="font-size: 11.5px;"><?= ViewHelper::e($item['category'] ?? 'Pet Nutrition') ?></span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="py-3">
                                                <span class="fw-bold text-dark" style="font-size: 14.5px;">$<?= number_format((float)$item['price'], 2) ?></span>
                                            </td>
                                            <td class="py-3 text-center">
                                                <div class="d-inline-flex align-items-center border rounded-pill bg-light p-1" style="width: 105px;">
                                                    <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none px-2" onclick="changeQty(<?= $id ?>, -1)"><i class="fa-solid fa-minus" style="font-size: 10px;"></i></button>
                                                    <input type="number" id="qty-<?= $id ?>" value="<?= (int)$item['quantity'] ?>" min="1" max="99" class="form-control form-control-sm border-0 bg-transparent text-center fw-bold shadow-none p-0" style="font-size: 14px;" onchange="updateRowQty(<?= $id ?>, this.value)">
                                                    <button type="button" class="btn btn-sm btn-link text-dark text-decoration-none px-2" onclick="changeQty(<?= $id ?>, 1)"><i class="fa-solid fa-plus" style="font-size: 10px;"></i></button>
                                                </div>
                                            </td>
                                            <td class="py-3 text-end fw-bold text-brand" id="lineTotal-<?= $id ?>" style="font-size: 15px;">
                                                $<?= number_format($lineSubtotal, 2) ?>
                                            </td>
                                            <td class="py-3 text-center pe-4">
                                                <button type="button" class="btn btn-sm btn-outline-danger rounded-circle p-0 d-inline-flex align-items-center justify-content-center" style="width: 30px; height: 30px;" onclick="removeCartItem(<?= $id ?>)" title="Remove Item">
                                                    <i class="fa-solid fa-trash-can" style="font-size: 11px;"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Cart Bottom Navigation -->
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-outline-secondary rounded-pill px-4 fw-bold small">
                            <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>

                <!-- Right: Promo Code & Order Summary (col-lg-4) -->
                <div class="col-lg-4">
                    
                    <!-- Promo Code Card -->
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                        <h5 class="fw-bold text-dark mb-3" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-tag text-brand me-2"></i> Promotional Voucher
                        </h5>
                        <form id="couponForm" onsubmit="applyCoupon(event)">
                            <div class="input-group mb-2">
                                <input type="text" id="couponCodeInput" class="form-control rounded-start-3 text-uppercase" placeholder="e.g. PETGUARD10" value="<?= $coupon ? ViewHelper::e($coupon['code']) : '' ?>">
                                <button type="submit" class="btn btn-dark rounded-end-3 px-3 fw-bold">Apply</button>
                            </div>
                        </form>
                        <div class="d-flex items-center gap-1 mt-2">
                            <span class="badge bg-light text-muted border font-monospace cursor-pointer" onclick="document.getElementById('couponCodeInput').value='PETGUARD10';">PETGUARD10 (10% OFF)</span>
                            <span class="badge bg-light text-muted border font-monospace cursor-pointer" onclick="document.getElementById('couponCodeInput').value='WELCOME5';">WELCOME5 ($5 OFF)</span>
                        </div>
                        <?php if ($coupon): ?>
                            <div class="mt-3 p-2 rounded-3 bg-success-subtle border border-success-subtle text-success small d-flex align-items-center justify-content-between">
                                <span><i class="fa-solid fa-circle-check me-1"></i> Coupon <strong><?= ViewHelper::e($coupon['code']) ?></strong> Applied</span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Order Summary Card -->
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 bg-white">
                        <h5 class="fw-bold text-dark mb-3" style="font-family: 'Anybody', sans-serif;">
                            Order Summary
                        </h5>

                        <div class="d-flex flex-column gap-2 mb-4">
                            <div class="d-flex justify-content-between text-muted small">
                                <span>Items Subtotal</span>
                                <span class="fw-bold text-dark" id="summarySubtotal">$<?= number_format($subtotal, 2) ?></span>
                            </div>

                            <?php if ($discount > 0): ?>
                                <div class="d-flex justify-content-between text-success small" id="summaryDiscountRow">
                                    <span>Discount (<?= ViewHelper::e($coupon['code'] ?? '') ?>)</span>
                                    <span class="fw-bold" id="summaryDiscount">-$<?= number_format($discount, 2) ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex justify-content-between text-muted small">
                                <span>Estimated Shipping</span>
                                <span class="fw-bold <?= $shipping == 0 ? 'text-success' : 'text-dark' ?>" id="summaryShipping">
                                    <?= $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2) ?>
                                </span>
                            </div>

                            <hr class="my-2">

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 16px;">Estimated Total</span>
                                <span class="fw-bold text-brand" id="summaryTotal" style="font-size: 22px;">$<?= number_format($total, 2) ?></span>
                            </div>
                        </div>

                        <a href="<?= ViewHelper::url('checkout') ?>" class="btn btn-admin-primary w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="font-size: 15px;">
                            <i class="fa-solid fa-lock"></i>
                            <span>Proceed to Checkout</span>
                        </a>

                        <div class="mt-3 text-center text-muted small" style="font-size: 11.5px;">
                            <i class="fa-solid fa-shield-halved text-success me-1"></i> Guaranteed 256-Bit Encrypted Checkout
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
function changeQty(id, delta) {
    const input = document.getElementById(`qty-${id}`);
    let val = parseInt(input.value || '1') + delta;
    if (val < 1) val = 1;
    input.value = val;
    updateRowQty(id, val);
}

async function updateRowQty(id, qty) {
    const payload = { quantities: {} };
    payload.quantities[id] = qty;

    try {
        const res = await PetGuardAjax.post('cart/update', payload);
        if (res.ok && res.data.success) {
            window.location.reload();
        }
    } catch (e) {
        PetGuardToast.error('Cart update failed.');
    }
}

async function removeCartItem(id) {
    if (!confirm('Remove this product from your cart?')) return;
    try {
        const res = await PetGuardAjax.post(`cart/remove/${id}`);
        if (res.ok) {
            window.location.reload();
        }
    } catch (e) {
        PetGuardToast.error('Failed to remove item.');
    }
}

async function clearCart() {
    if (!confirm('Are you sure you want to empty your entire cart?')) return;
    try {
        const res = await PetGuardAjax.get('cart/clear');
        window.location.reload();
    } catch (e) {
        PetGuardToast.error('Failed to empty cart.');
    }
}

async function applyCoupon(e) {
    e.preventDefault();
    const code = document.getElementById('couponCodeInput').value.trim();
    if (!code) {
        PetGuardToast.warning('Please enter a voucher code.');
        return;
    }

    try {
        const res = await PetGuardAjax.post('cart/apply-coupon', { code });
        if (res.ok && res.data.success) {
            PetGuardToast.success(res.data.message);
            setTimeout(() => window.location.reload(), 500);
        } else {
            PetGuardToast.error(res.data.message || 'Invalid coupon code.');
        }
    } catch (e) {
        PetGuardToast.error('Coupon validation failed.');
    }
}
</script>
