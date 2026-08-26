<?php
use Helpers\ViewHelper;
?>
<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Shopping Cart</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('our-products') ?>">Shop</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
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
        <?php if (empty($cart)): ?>
            <div class="text-center py-5">
                <i class="fa-solid fa-cart-arrow-down fs-1 text-muted mb-3"></i>
                <h3 class="fw-bold">Your Cart is Empty</h3>
                <p class="text-muted mb-4">Explore our vet-recommended food, health essentials, and accessories.</p>
                <a href="<?= ViewHelper::url('our-products') ?>" class="btn-brand">
                    <i class="fa-solid fa-arrow-left me-2"></i> Browse Products
                </a>
            </div>
        <?php else: ?>
            <form action="<?= ViewHelper::url('cart/update') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="row g-5">
                    <!-- Cart Items Table -->
                    <div class="col-lg-8">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 100px;">Product</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" style="width: 120px;">Quantity</th>
                                        <th scope="col">Total</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($cart as $id => $item): ?>
                                        <tr>
                                            <td>
                                                <img src="<?= ViewHelper::asset($item['img']) ?>" alt="<?= ViewHelper::e($item['name']) ?>" class="rounded-3" style="width: 70px; height: 70px; object-fit: contain; background: #fafafa;">
                                            </td>
                                            <td>
                                                <a href="<?= ViewHelper::url('product-details/' . $item['slug']) ?>" class="fw-bold text-dark text-decoration-none"><?= ViewHelper::e($item['name']) ?></a>
                                            </td>
                                            <td class="fw-semibold text-muted">$<?= number_format($item['price'], 2) ?></td>
                                            <td>
                                                <input type="number" name="quantities[<?= $id ?>]" value="<?= $item['quantity'] ?>" min="1" max="99" class="form-control text-center py-1">
                                            </td>
                                            <td class="fw-bold text-brand">$<?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                            <td>
                                                <a href="<?= ViewHelper::url('cart/remove/' . $id) ?>" class="btn btn-sm btn-outline-danger rounded-circle" title="Remove"><i class="fa-solid fa-trash-can"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-outline-dark rounded-pill px-4"><i class="fa-solid fa-arrow-left me-2"></i> Continue Shopping</a>
                            <div class="d-flex gap-2">
                                <a href="<?= ViewHelper::url('cart/clear') ?>" class="btn btn-outline-danger rounded-pill px-4">Clear Cart</a>
                                <button type="submit" class="btn btn-dark rounded-pill px-4">Update Cart</button>
                            </div>
                        </div>
                    </div>

                    <!-- Cart Totals Card -->
                    <div class="col-lg-4">
                        <div class="p-4 rounded-4 shadow-sm" style="background-color: #fdfbf7; border: 1px solid #e2e8f0;">
                            <h5 class="fw-bold mb-4">Cart Summary</h5>
                            
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Subtotal:</span>
                                <span class="fw-bold">$<?= number_format($subtotal, 2) ?></span>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted">Standard Shipping:</span>
                                <span class="text-success fw-bold">FREE</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between mb-4">
                                <span class="fs-5 fw-bold">Grand Total:</span>
                                <span class="fs-4 fw-bolder text-brand">$<?= number_format($subtotal, 2) ?></span>
                            </div>

                            <a href="<?= ViewHelper::url('cart-checkout') ?>" class="btn btn-brand w-100 py-3 fw-bold text-center">
                                Proceed to Checkout <i class="fa-solid fa-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    </div>
</section>
