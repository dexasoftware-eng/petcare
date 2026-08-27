<?php
use Helpers\ViewHelper;

$cart = $cart ?? [];
$subtotal = $subtotal ?? 0.0;
$coupon = $coupon ?? null;
$discount = $discount ?? 0.0;
$shipping = $shipping ?? 0.0;
$total = $total ?? 0.0;
$user = $user ?? [];
$stripePublishableKey = $stripePublishableKey ?? 'pk_test_51T9VPQIgzswnI4l9tCQ8JXE91Hbllqc0jel22DPhGm2VvbY63UdqMzXkGMMveQ4bfO5ryFSRac8qai5eeKrr12A30090JoYaH1';

$nameParts = explode(' ', $user['name'] ?? '', 2);
$firstName = $nameParts[0] ?? '';
$lastName = $nameParts[1] ?? '';
?>

<!-- Stripe JS SDK -->
<script src="https://js.stripe.com/v3/"></script>

<!-- 1. Hero Banner -->
<section class="banner" style="background-color: #fff8e5; background-image:url(<?= ViewHelper::asset('img/banner.png') ?>);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white shadow-sm text-dark small mb-3 border">
                    <i class="fa-brands fa-stripe text-primary" style="font-size: 18px;"></i>
                    <span class="fw-semibold text-dark">Stripe 256-Bit Encrypted Payment</span>
                </div>
                <h1 class="text-dark fw-bold mb-2" style="font-family: 'Anybody', sans-serif; font-size: clamp(26px, 5vw, 40px);">
                    Checkout &amp; Payment
                </h1>
                <ul class="d-inline-flex list-unstyled gap-2 text-muted small justify-content-center m-0 align-items-center">
                    <li><a href="<?= ViewHelper::url() ?>" class="text-dark fw-semibold text-decoration-none hover-brand">Home</a></li>
                    <li class="text-muted">/</li>
                    <li><a href="<?= ViewHelper::url('shop-cart') ?>" class="text-dark fw-semibold text-decoration-none hover-brand">Cart</a></li>
                    <li class="text-muted">/</li>
                    <li class="text-brand fw-bold">Stripe Checkout</li>
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
            <input type="hidden" name="payment_method" value="card">
            <input type="hidden" name="stripe_token" id="stripeTokenInput" value="">

            <div class="row g-4">
                
                <!-- Left: Billing, Shipping & Stripe Payment Form (col-lg-7) -->
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
                                <input type="email" name="email" id="customerEmail" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['email'] ?? '') ?>" placeholder="john@example.com" required>
                                <div class="form-text small text-muted" style="font-size: 11px;">Your Stripe receipt and order tracking will be sent here.</div>
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

                    <!-- Section 2: Dedicated Stripe Payment Gateway -->
                    <div class="admin-card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom flex-wrap gap-2">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 36px; height: 36px; background: #635bff;">
                                    2
                                </div>
                                <div>
                                    <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                                        Stripe Card Payment
                                    </h4>
                                    <p class="text-muted small m-0">Direct 256-bit encrypted card authorization via Stripe.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-brands fa-cc-visa text-primary fs-3"></i>
                                <i class="fa-brands fa-cc-mastercard text-danger fs-3"></i>
                                <i class="fa-brands fa-cc-amex text-info fs-3"></i>
                                <i class="fa-brands fa-cc-discover text-warning fs-3"></i>
                            </div>
                        </div>

                        <!-- Stripe Card Entry Box -->
                        <div class="p-4 rounded-4 bg-light border border-primary border-opacity-25 mb-3 position-relative">
                            <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
                                <span class="small fw-bold text-dark d-flex align-items-center gap-2">
                                    <i class="fa-solid fa-credit-card text-primary"></i> Credit or Debit Card
                                </span>
                                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 py-1 fw-bold d-inline-flex align-items-center gap-1 shadow-sm" style="font-size: 11.5px;" onclick="fillTestCard()">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i> Auto-Fill Test Card
                                </button>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark">Name on Card *</label>
                                <input type="text" name="card_name" id="stripeCardName" class="form-control rounded-3 py-2 bg-white" placeholder="Full name as printed on card" value="<?= ViewHelper::e($user['name'] ?? 'Pet Parent') ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-dark">Card Number *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0 text-muted ps-3" id="cardBrandIcon">
                                        <i class="fa-solid fa-credit-card"></i>
                                    </span>
                                    <input type="text" name="card_number" id="stripeCardNumber" class="form-control border-start-0 border-end-0 rounded-0 py-2 bg-white font-monospace" placeholder="4242 •••• •••• 4242" maxlength="19" value="4242 4242 4242 4242" required oninput="formatCardNumber(this)">
                                    <span class="input-group-text bg-white border-start-0 text-success pe-3">
                                        <i class="fa-solid fa-lock small"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-dark">Expiration Date *</label>
                                    <input type="text" name="card_expiry" id="stripeCardExpiry" class="form-control rounded-3 py-2 bg-white font-monospace text-center" placeholder="MM / YY" maxlength="5" value="12/28" required oninput="formatExpiry(this)">
                                </div>
                                <div class="col-6">
                                    <label class="form-label small fw-bold text-dark">CVC / CVV *</label>
                                    <div class="input-group">
                                        <input type="text" name="card_cvc" id="stripeCardCvc" class="form-control rounded-start-3 py-2 bg-white font-monospace text-center" placeholder="123" maxlength="4" value="123" required>
                                        <span class="input-group-text bg-white rounded-end-3 text-muted" title="3 or 4 digit code on the back of your card">
                                            <i class="fa-solid fa-circle-question small"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Stripe Trust Banner -->
                        <div class="p-3 rounded-3 bg-white border d-flex align-items-center gap-3">
                            <i class="fa-solid fa-shield-check text-success fs-3 flex-shrink-0"></i>
                            <div class="small">
                                <div class="fw-bold text-dark">Guaranteed Safe &amp; Secure Checkout</div>
                                <div class="text-muted" style="font-size: 11.5px;">Your card details are processed directly through Stripe's certified PCI-DSS Level 1 payment vault.</div>
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
                            <i class="fa-brands fa-stripe me-1" style="font-size: 22px;"></i>
                            <span>Pay with Stripe ($<?= number_format($total, 2) ?>)</span>
                        </button>

                        <div class="mt-4 text-center">
                            <div class="d-flex items-center justify-content-center gap-3 text-muted small mb-2" style="font-size: 11px;">
                                <span><i class="fa-solid fa-truck-fast text-brand me-1"></i> Fast Shipping</span>
                                <span><i class="fa-solid fa-rotate-left text-primary me-1"></i> Easy Returns</span>
                                <span><i class="fa-solid fa-lock text-success me-1"></i> Stripe Protected</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</section>

<script>
const stripePublishableKey = '<?= $stripePublishableKey ?>';
let stripeInstance = null;

try {
    if (typeof Stripe !== 'undefined') {
        stripeInstance = Stripe(stripePublishableKey);
    }
} catch (e) {
    console.warn('Stripe client initialization:', e);
}

function fillTestCard() {
    document.getElementById('stripeCardNumber').value = '4242 4242 4242 4242';
    document.getElementById('stripeCardExpiry').value = '12/28';
    document.getElementById('stripeCardCvc').value = '123';
    document.getElementById('cardBrandIcon').innerHTML = '<i class="fa-brands fa-cc-visa text-primary fs-5"></i>';
    PetGuardToast.success('Stripe test credentials auto-filled.');
}

function formatCardNumber(input) {
    let value = input.value.replace(/\D/g, '');
    let formatted = '';
    for (let i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) formatted += ' ';
        formatted += value[i];
    }
    input.value = formatted.substring(0, 19);

    // Detect card brand
    const iconEl = document.getElementById('cardBrandIcon');
    if (value.startsWith('4')) {
        iconEl.innerHTML = '<i class="fa-brands fa-cc-visa text-primary fs-5"></i>';
    } else if (value.startsWith('5')) {
        iconEl.innerHTML = '<i class="fa-brands fa-cc-mastercard text-danger fs-5"></i>';
    } else if (value.startsWith('3')) {
        iconEl.innerHTML = '<i class="fa-brands fa-cc-amex text-info fs-5"></i>';
    } else if (value.startsWith('6')) {
        iconEl.innerHTML = '<i class="fa-brands fa-cc-discover text-warning fs-5"></i>';
    } else {
        iconEl.innerHTML = '<i class="fa-solid fa-credit-card text-muted"></i>';
    }
}

function formatExpiry(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length > 2) {
        input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
    } else {
        input.value = value;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#checkoutForm', {
        loadingText: 'Authorizing with Stripe...',
        onSuccess: (data) => {
            PetGuardToast.success(data.message || 'Stripe payment authorized! Redirecting to confirmation...');
            if (data.redirect) {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 600);
            }
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Stripe payment processing failed. Please check your card details.');
        }
    });
});
</script>
