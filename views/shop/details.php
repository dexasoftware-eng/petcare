<?php
use Helpers\ViewHelper;
?>
<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2><?= ViewHelper::e($product['name']) ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('our-products') ?>">Shop</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ViewHelper::e($product['name']) ?></li>
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
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6 text-center">
                <div class="p-5 rounded-4 bg-light position-relative">
                    <?php if (!empty($product['discount'])): ?>
                        <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-pill px-3 py-2 fs-6"><?= ViewHelper::e($product['discount']) ?></span>
                    <?php endif; ?>
                    <img src="<?= ViewHelper::asset($product['img']) ?>" alt="<?= ViewHelper::e($product['name']) ?>" class="img-fluid" style="max-height: 380px; object-fit: contain;">
                </div>
            </div>

            <div class="col-lg-6">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2"><?= ViewHelper::e($product['category']) ?></span>
                <h2 class="fw-bold mb-3"><?= ViewHelper::e($product['name']) ?></h2>
                
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="text-warning small">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </div>
                    <span class="fw-bold"><?= $product['rating'] ?></span>
                    <span class="text-muted small">(<?= $product['reviews_count'] ?> customer reviews)</span>
                </div>

                <div class="mb-4">
                    <span class="display-6 fw-bold text-brand">$<?= number_format($product['price'], 2) ?></span>
                    <?php if ($product['old_price']): ?>
                        <span class="text-muted text-decoration-line-through fs-5 ms-2">$<?= number_format($product['old_price'], 2) ?></span>
                    <?php endif; ?>
                </div>

                <p class="text-muted leading-relaxed mb-4"><?= nl2br(ViewHelper::e($product['description'])) ?></p>

                <div class="p-3 rounded-3 bg-light border mb-4">
                    <div class="row g-2 small">
                        <div class="col-6"><strong>SKU:</strong> <?= ViewHelper::e($product['sku']) ?></div>
                        <div class="col-6"><strong>Availability:</strong> <span class="text-success fw-bold">In Stock</span></div>
                    </div>
                </div>

                <form action="<?= ViewHelper::url('cart/add') ?>" method="POST" class="d-flex gap-3">
                    <?= ViewHelper::csrfField() ?>
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <input type="number" name="quantity" value="1" min="1" max="99" class="form-control text-center fw-bold" style="width: 80px;">
                    <button type="submit" class="btn btn-brand px-5 py-3 fw-bold flex-grow-1">
                        <i class="fa-solid fa-cart-shopping me-2"></i> Add to Cart
                    </button>
                </form>
            </div>
        </div>

        <!-- Related Products -->
        <?php if (!empty($relatedProducts)): ?>
            <div class="pt-5 border-top">
                <h4 class="fw-bold mb-4">Related Nutrition & Care Products</h4>
                <div class="row g-4">
                    <?php foreach ($relatedProducts as $rel): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="card h-100 rounded-4 border-0 shadow-sm p-3 bg-light">
                                <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="text-center p-3 bg-white rounded-3 mb-3 d-block">
                                    <img src="<?= ViewHelper::asset($rel['img']) ?>" alt="<?= ViewHelper::e($rel['name']) ?>" style="height: 150px; object-fit: contain;">
                                </a>
                                <h6 class="fw-bold mb-2">
                                    <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="text-dark text-decoration-none"><?= ViewHelper::e($rel['name']) ?></a>
                                </h6>
                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                    <span class="fw-bold text-brand">$<?= number_format($rel['price'], 2) ?></span>
                                    <a href="<?= ViewHelper::url('product-details/' . $rel['slug']) ?>" class="btn btn-sm btn-dark rounded-pill px-3">View</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
