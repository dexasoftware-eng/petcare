<?php
use Helpers\ViewHelper;
?>
<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Order Checkout</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('shop-cart') ?>">Cart</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-img">
                    <div class="banner-img-1">
                        <svg width="260" height="260" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                        </svg>
                        <img src="<?= ViewHelper::asset('img/banner-img-1.jpg') ?>" alt="banner-img" />
                    </div>
                    <div class="banner-img-2">
                        <svg width="320" height="320" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                        </svg>
                        <img src="<?= ViewHelper::asset('img/banner-img-2.jpg') ?>" alt="banner-img" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5" style="background-color: #fff;">
    <div class="container py-4">
        <form action="<?= ViewHelper::url('cart-checkout') ?>" method="POST">
            <?= ViewHelper::csrfField() ?>
            <div class="row g-5">
                <!-- Customer Information -->
                <div class="col-lg-7">
                    <h4 class="fw-bold mb-4">Delivery & Contact Details</h4>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">First Name *</label>
                            <input type="text" name="first_name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('first_name', explode(' ', $user['name'] ?? '')[0])) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Last Name *</label>
                            <input type="text" name="last_name" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('last_name', explode(' ', $user['name'] ?? '')[1] ?? '')) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address *</label>
                            <input type="email" name="email" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('email', $user['email'] ?? '')) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Phone Number *</label>
                            <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('phone', $user['phone'] ?? '')) ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Street Address *</label>
                            <input type="text" name="address" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('address', $user['address'] ?? '')) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Town / City *</label>
                            <input type="text" name="city" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('city', 'New York')) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Postcode / ZIP *</label>
                            <input type="text" name="postcode" class="form-control" value="<?= ViewHelper::e(ViewHelper::old('postcode', '10001')) ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Order Delivery Notes (Optional)</label>
                            <textarea name="notes" rows="3" class="form-control" placeholder="Special delivery instructions or gate code..."><?= ViewHelper::e(ViewHelper::old('notes')) ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Order Review & Payment -->
                <div class="col-lg-5">
                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #fdfbf7; border: 1px solid #e2e8f0;">
                        <h4 class="fw-bold mb-4">Your Order</h4>

                        <div class="d-flex flex-column gap-3 mb-4">
                            <?php foreach ($cart as $item): ?>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="fw-bold m-0"><?= ViewHelper::e($item['name']) ?></h6>
                                        <span class="text-muted small">Qty: <?= $item['quantity'] ?> × $<?= number_format($item['price'], 2) ?></span>
                                    </div>
                                    <span class="fw-bold text-dark">$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Subtotal:</span>
                            <span class="fw-bold">$<?= number_format($subtotal, 2) ?></span>
                        </div>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Total Amount:</span>
                            <span class="fs-4 fw-bolder text-brand">$<?= number_format($subtotal, 2) ?></span>
                        </div>

                        <h5 class="fw-bold mb-3">Payment Method</h5>
                        <div class="d-flex flex-column gap-2 mb-4">
                            <div class="form-check p-3 rounded-3 border bg-white">
                                <input class="form-check-input" type="radio" name="payment_method" id="payCard" value="card" checked>
                                <label class="form-check-label fw-bold" for="payCard">
                                    <i class="fa-solid fa-credit-card me-2 text-primary"></i> Credit / Debit Card
                                </label>
                            </div>
                            <div class="form-check p-3 rounded-3 border bg-white">
                                <input class="form-check-input" type="radio" name="payment_method" id="payCod" value="cod">
                                <label class="form-check-label fw-bold" for="payCod">
                                    <i class="fa-solid fa-money-bill-wave me-2 text-success"></i> Cash on Delivery (COD)
                                </label>
                            </div>
                            <div class="form-check p-3 rounded-3 border bg-white">
                                <input class="form-check-input" type="radio" name="payment_method" id="payBank" value="bank">
                                <label class="form-check-label fw-bold" for="payBank">
                                    <i class="fa-solid fa-building-columns me-2 text-secondary"></i> Direct Bank Wire
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-brand w-100 py-3 fw-bold fs-5">
                            <i class="fa-solid fa-lock me-2"></i> Place Order Now
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
