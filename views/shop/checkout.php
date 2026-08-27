<?php
use Helpers\ViewHelper;

$cart = $cart ?? [];
$subtotal = $subtotal ?? 0.0;
$coupon = $coupon ?? null;
$discount = $discount ?? 0.0;
$shipping = $shipping ?? 0.0;
$total = $total ?? 0.0;
$user = $user ?? [];

$nameParts = explode(' ', $user['name'] ?? '', 2);
$firstName = $nameParts[0] ?? '';
$lastName = $nameParts[1] ?? '';
?>

<!-- 1. Hero Banner -->
<section class="banner" style="background-image:url(<?= ViewHelper::asset('img/banner.png') ?>); background-size: cover; background-position: center; padding: 65px 0 45px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-25 text-white small mb-3">
                    <i class="fa-solid fa-lock text-success"></i>
                    <span class="fw-semibold">256-Bit End-to-End Encrypted Checkout</span>
                </div>
                <h1 class="text-white fw-bold mb-2" style="font-family: 'Anybody', sans-serif; font-size: 36px;">
                    Checkout &amp; Payment
                </h1>
                <ul class="d-inline-flex list-unstyled gap-2 text-white small justify-content-center m-0">
                    <li><a href="<?= ViewHelper::url() ?>" class="text-white text-decoration-none">Home</a></li>
                    <li>/</li>
                    <li><a href="<?= ViewHelper::url('shop-cart') ?>" class="text-white text-decoration-none">Cart</a></li>
                    <li>/</li>
                    <li class="text-white opacity-75">Checkout</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- 2. Checkout Main Section -->
<section class="py-5" style="background: #f8fafc;">
    <div class="container">
        <form id="checkoutForm" action="<?= ViewHelper::url('checkout') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>

            <div class="row g-4">
                
                <!-- Left: Billing, Shipping & Payment Form (col-lg-7) -->
                <div class="col-lg-7">
                    
                    <!-- Section 1: Customer Contact & Shipping Details -->
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white mb-4">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 36px; height: 36px; background: #fa441d;">
                                1
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                                    Delivery &amp; Customer Information
                                </h4>
                                <p class="text-muted small m-0">Where should we deliver your clinical nutrition order?</p>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">First Name *</label>
                                <input type="text" name="first_name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($firstName) ?>" placeholder="e.g. John" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Last Name *</label>
                                <input type="text" name="last_name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($lastName) ?>" placeholder="e.g. Doe" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Email Address *</label>
                                <input type="email" name="email" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['email'] ?? '') ?>" placeholder="john@example.com" required>
                                <div class="form-text small text-muted" style="font-size: 11px;">Your order receipt will be sent here.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Phone Number *</label>
                                <input type="tel" name="phone" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['phone'] ?? '') ?>" placeholder="+1 (555) 000-0000" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Street Address *</label>
                            <input type="text" name="address" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['address'] ?? '') ?>" placeholder="House / Flat #, Street, Neighborhood" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">City / District *</label>
                                <input type="text" name="city" class="form-control rounded-3 py-2" placeholder="e.g. Los Angeles" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Postal / ZIP Code *</label>
                                <input type="text" name="postcode" class="form-control rounded-3 py-2" placeholder="e.g. 90001" required>
                            </div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label small fw-bold text-dark">Special Delivery Instructions (Optional)</label>
                            <textarea name="notes" class="form-control rounded-3" rows="2" placeholder="Gate codes, porch drop instructions, or pet security precautions..."></textarea>
                        </div>
                    </div>

                    <!-- Section 2: Payment Gateway & Stripe Integration -->
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 36px; height: 36px; background: #0f172a;">
                                2
                            </div>
                            <div>
                                <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                                    Payment Method &amp; Security
                                </h4>
                                <p class="text-muted small m-0">Encrypted transmission backed by Stripe.</p>
                            </div>
                        </div>

                        <!-- Payment Method Radios / Tabs -->
                        <div class="d-flex flex-column gap-3 mb-4">
                            
                            <!-- Option 1: Stripe Card -->
                            <label class="p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer payment-option-card bg-light border-primary" id="cardOptionLabel">
                                <input type="radio" name="payment_method" value="card" class="form-check-input mt-1" checked onchange="selectPaymentMethod('card')">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="text-dark">Credit / Debit Card (Stripe)</strong>
                                        <div class="d-flex align-items-center gap-1 text-muted">
                                            <i class="fa-brands fa-cc-visa text-primary" style="font-size: 22px;"></i>
                                            <i class="fa-brands fa-cc-mastercard text-danger" style="font-size: 22px;"></i>
                                            <i class="fa-brands fa-cc-amex text-info" style="font-size: 22px;"></i>
                                        </div>
                                    </div>
                                    <p class="text-muted small m-0 mt-1" style="font-size: 12px;">Instant authorization via Stripe's encrypted payment network.</p>
                                </div>
                            </label>

                            <!-- Option 2: Cash on Delivery -->
                            <label class="p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer payment-option-card" id="codOptionLabel">
                                <input type="radio" name="payment_method" value="cod" class="form-check-input mt-1" onchange="selectPaymentMethod('cod')">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="text-dark">Cash on Delivery (COD)</strong>
                                        <i class="fa-solid fa-hand-holding-dollar text-success" style="font-size: 18px;"></i>
                                    </div>
                                    <p class="text-muted small m-0 mt-1" style="font-size: 12px;">Pay with cash or card upon package arrival at your doorstep.</p>
                                </div>
                            </label>

                            <!-- Option 3: Direct Bank Wire -->
                            <label class="p-3 rounded-3 border d-flex align-items-start gap-3 cursor-pointer payment-option-card" id="bankOptionLabel">
                                <input type="radio" name="payment_method" value="bank" class="form-check-input mt-1" onchange="selectPaymentMethod('bank')">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <strong class="text-dark">Direct Bank Wire Transfer</strong>
                                        <i class="fa-solid fa-building-columns text-secondary" style="font-size: 18px;"></i>
                                    </div>
                                    <p class="text-muted small m-0 mt-1" style="font-size: 12px;">Make your payment directly into our corporate bank account.</p>
                                </div>
                            </label>

                        </div>

                        <!-- Stripe Card Input Mock / Elements Box -->
                        <div id="stripeCardBox" class="p-4 rounded-4 bg-light border">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="small fw-bold text-dark"><i class="fa-solid fa-credit-card text-primary me-2"></i> Card Information</span>
                                <button type="button" class="badge bg-primary text-white border-0 py-1 px-2 cursor-pointer" onclick="fillTestCard()">
                                    Auto-Fill Test Card
                                </button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted">Cardholder Name</label>
                                <input type="text" id="stripeCardName" class="form-control rounded-3 py-2 bg-white" placeholder="Name on card" value="<?= ViewHelper::e($user['name'] ?? 'Pet Parent') ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label small text-muted">Card Number</label>
                                <div class="input-group">
                                    <input type="text" id="stripeCardNumber" class="form-control rounded-start-3 py-2 bg-white font-monospace" placeholder="4242 •••• •••• 4242" maxlength="19" value="4242 •••• •••• 4242">
                                    <span class="input-group-text bg-white border-start-0 text-muted">
                                        <i class="fa-solid fa-lock text-success small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label small text-muted">Expiration Date</label>
                                    <input type="text" id="stripeCardExpiry" class="form-control rounded-3 py-2 bg-white font-monospace" placeholder="MM / YY" maxlength="5" value="12/28">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small text-muted">CVC / CVV</label>
                                    <input type="text" id="stripeCardCvc" class="form-control rounded-3 py-2 bg-white font-monospace" placeholder="CVC" maxlength="4" value="123">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Right: Order Summary Sidebar (col-lg-5) -->
                <div class="col-lg-5">
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white position-sticky" style="top: 100px;">
                        <h4 class="fw-bold text-dark mb-4" style="font-family: 'Anybody', sans-serif;">
                            Order Summary (<?= count($cart) ?>)
                        </h4>

                        <!-- Line Items -->
                        <div class="d-flex flex-column gap-3 mb-4 max-h-300 overflow-y-auto pe-1" style="max-height: 280px;">
                            <?php foreach ($cart as $item): 
                                $lineTotal = (float)$item['price'] * (int)$item['quantity'];
                            ?>
                                <div class="d-flex align-items-center justify-content-between p-2 rounded-3 bg-light border">
                                    <div class="d-flex align-items-center gap-2 overflow-hidden">
                                        <img src="<?= ViewHelper::asset($item['img'] ?? 'img/food-1.png') ?>" alt="<?= ViewHelper::e($item['name']) ?>" class="rounded-2 flex-shrink-0" style="width: 44px; height: 44px; object-fit: contain;">
                                        <div class="overflow-hidden">
                                            <div class="fw-bold text-dark text-truncate small"><?= ViewHelper::e($item['name']) ?></div>
                                            <span class="text-muted small" style="font-size: 11px;">Qty: <?= (int)$item['quantity'] ?> × $<?= number_format((float)$item['price'], 2) ?></span>
                                        </div>
                                    </div>
                                    <span class="fw-bold text-dark flex-shrink-0 ms-2 small">$<?= number_format($lineTotal, 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Calculations -->
                        <div class="d-flex flex-column gap-2 mb-4 pt-3 border-top">
                            <div class="d-flex justify-content-between text-muted small">
                                <span>Subtotal</span>
                                <span class="fw-bold text-dark">$<?= number_format($subtotal, 2) ?></span>
                            </div>

                            <?php if ($discount > 0): ?>
                                <div class="d-flex justify-content-between text-success small">
                                    <span>Discount (<?= ViewHelper::e($coupon['code'] ?? '') ?>)</span>
                                    <span class="fw-bold">-$<?= number_format($discount, 2) ?></span>
                                </div>
                            <?php endif; ?>

                            <div class="d-flex justify-content-between text-muted small">
                                <span>Standard Delivery</span>
                                <span class="fw-bold <?= $shipping == 0 ? 'text-success' : 'text-dark' ?>">
                                    <?= $shipping == 0 ? 'FREE' : '$' . number_format($shipping, 2) ?>
                                </span>
                            </div>

                            <hr class="my-2">

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-dark" style="font-size: 17px;">Total Payable</span>
                                <span class="fw-bold text-brand" style="font-size: 24px;">$<?= number_format($total, 2) ?></span>
                            </div>
                        </div>

                        <!-- Place Order Button -->
                        <button type="submit" id="placeOrderBtn" class="btn btn-admin-primary w-100 rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="font-size: 16px;">
                            <i class="fa-solid fa-lock"></i>
                            <span>Authorize &amp; Place Order ($<?= number_format($total, 2) ?>)</span>
                        </button>

                        <div class="mt-4 text-center">
                            <div class="d-flex items-center justify-content-center gap-3 text-muted small mb-2" style="font-size: 11px;">
                                <span><i class="fa-solid fa-truck-fast text-brand me-1"></i> Fast Shipping</span>
                                <span><i class="fa-solid fa-rotate-left text-primary me-1"></i> Easy Returns</span>
                                <span><i class="fa-solid fa-shield-check text-success me-1"></i> SSL Protected</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

<script>
function selectPaymentMethod(method) {
    document.querySelectorAll('.payment-option-card').forEach(el => el.classList.remove('bg-light', 'border-primary'));
    const stripeBox = document.getElementById('stripeCardBox');
    
    if (method === 'card') {
        document.getElementById('cardOptionLabel').classList.add('bg-light', 'border-primary');
        stripeBox.style.display = 'block';
    } else if (method === 'cod') {
        document.getElementById('codOptionLabel').classList.add('bg-light', 'border-primary');
        stripeBox.style.display = 'none';
    } else if (method === 'bank') {
        document.getElementById('bankOptionLabel').classList.add('bg-light', 'border-primary');
        stripeBox.style.display = 'none';
    }
}

function fillTestCard() {
    document.getElementById('stripeCardNumber').value = '4242 4242 4242 4242';
    document.getElementById('stripeCardExpiry').value = '12/28';
    document.getElementById('stripeCardCvc').value = '123';
    PetGuardToast.success('Stripe test card details applied.');
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#checkoutForm', {
        loadingText: 'Processing Secure Order...',
        onSuccess: (data) => {
            PetGuardToast.success('Payment authorized! Redirecting to confirmation...');
            if (data.redirect) {
                window.location.href = data.redirect;
            }
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Payment processing failed. Please check your inputs.');
        }
    });
});
</script>
