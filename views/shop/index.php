<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our Pet Products</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
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

<!-- Category Slider Section -->
<section class="gap">
    <div class="container">
        <div class="heading">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading ornament" />
            <h6>Find Healthy Product By Category</h6>
            <h2>Browse By Categories</h2>
        </div>
        <div class="row justify-content-center g-4 mt-2">
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="food-categorie text-center">
                    <img src="<?= ViewHelper::asset('img/food-categorie-1.png') ?>" alt="Cat Nutrition" class="mb-3" />
                    <a href="<?= ViewHelper::url('our-products?category=cat-nutrition') ?>" class="d-block">Cat Nutrition & Care</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="food-categorie text-center">
                    <img src="<?= ViewHelper::asset('img/food-categorie-2.png') ?>" alt="Dog Wellness" class="mb-3" />
                    <a href="<?= ViewHelper::url('our-products?category=dog-wellness') ?>" class="d-block">Dog Wellness Supplies</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="food-categorie text-center">
                    <img src="<?= ViewHelper::asset('img/food-categorie-3.png') ?>" alt="Therapeutic Diet" class="mb-3" />
                    <a href="<?= ViewHelper::url('our-products?category=therapeutic-diet') ?>" class="d-block">Therapeutic Pet Diet</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="food-categorie text-center">
                    <img src="<?= ViewHelper::asset('img/food-categorie-4.png') ?>" alt="Care Accessories" class="mb-3" />
                    <a href="<?= ViewHelper::url('our-products?category=care-accessories') ?>" class="d-block">Care & Hygiene Accessories</a>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-6 col-6">
                <div class="food-categorie text-center">
                    <img src="<?= ViewHelper::asset('img/food-categorie-5.png') ?>" alt="Equine Care" class="mb-3" />
                    <a href="<?= ViewHelper::url('our-products?category=specialty-care') ?>" class="d-block">Equine & Specialty Care</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Healthy Products Section -->
<section class="gap section-healthy-product no-top" style="background-image: url('<?= ViewHelper::asset('img/healthy-product.png') ?>'); background-color: #f5f5f5; padding-top: 80px;">
    <div class="container">
        <div class="heading">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading-img" />
            <h6>Find Healthy Product</h6>
            <h2>Healthy Products</h2>
        </div>

        <div class="row">
            <?php
            $productsList = [
                ['id' => 1, 'category' => 'Therapeutic Diet', 'title' => 'Procan Complete Adult Canine Nutrition', 'price' => '$32.00', 'oldPrice' => null, 'discount' => null, 'image' => 'img/food-1.png', 'rating' => 5],
                ['id' => 2, 'category' => 'Organic Nutrition', 'title' => 'PureCare Organic Puppy & Senior Blend', 'price' => '$22.00', 'oldPrice' => '$32.00', 'discount' => '-24%', 'image' => 'img/food-2.png', 'rating' => 5],
                ['id' => 3, 'category' => 'Digestive Care', 'title' => 'DigestPlus Prebiotic Pet Dietary Supplement', 'price' => '$32.00', 'oldPrice' => null, 'discount' => null, 'image' => 'img/food-3.png', 'rating' => 5],
                ['id' => 4, 'category' => 'Recovery & Kitten', 'title' => 'KMR Vitality Formula Milk Replacer 12oz', 'price' => '$22.00', 'oldPrice' => '$32.00', 'discount' => '-24%', 'image' => 'img/food-4.png', 'rating' => 5],
                ['id' => 5, 'category' => 'Specialized Feed', 'title' => 'NutriGuard Herbivore High-Fiber Meal', 'price' => '$22.00', 'oldPrice' => '$32.00', 'discount' => '-24%', 'image' => 'img/food-5.png', 'rating' => 5],
            ];
            foreach ($productsList as $idx => $prod):
            ?>
                <div class="<?= $idx < 3 ? 'col-lg-3 col-md-4 col-sm-6' : 'col-lg-3 col-md-6 col-sm-6' ?>">
                    <div class="healthy-product <?= $idx === 4 ? 'mb-lg-0' : '' ?>">
                        <div class="healthy-product-img">
                            <img src="<?= ViewHelper::asset($prod['image']) ?>" alt="<?= ViewHelper::e($prod['title']) ?>" />
                            <ul class="star">
                                <?php for($s = 0; $s < $prod['rating']; $s++): ?>
                                    <li><i class="fa-solid fa-star"></i></li>
                                <?php endfor; ?>
                            </ul>
                            <div class="add-to-cart">
                                <form action="<?= ViewHelper::url('cart/add') ?>" method="POST" class="d-inline">
                                    <?= ViewHelper::csrfField() ?>
                                    <input type="hidden" name="product_id" value="<?= $prod['id'] ?>">
                                    <input type="hidden" name="name" value="<?= ViewHelper::e($prod['title']) ?>">
                                    <input type="hidden" name="price" value="<?= floatval(str_replace('$', '', $prod['price'])) ?>">
                                    <input type="hidden" name="quantity" value="1">
                                    <input type="hidden" name="image" value="<?= $prod['image'] ?>">
                                    <button type="submit" style="background: none; border: none; color: inherit; font: inherit; cursor: pointer; padding: 0;">Add to Cart</button>
                                </form>
                                <a href="<?= ViewHelper::url('our-products') ?>" class="heart-wishlist" aria-label="Add to wishlist">
                                    <i class="fa-regular fa-heart"></i>
                                </a>
                            </div>
                            <?php if (!empty($prod['discount'])): ?>
                                <h4><?= $prod['discount'] ?></h4>
                            <?php endif; ?>
                        </div>
                        <span><?= $prod['category'] ?></span>
                        <a href="<?= ViewHelper::url('our-products') ?>"><?= ViewHelper::e($prod['title']) ?></a>
                        <h6>
                            <?php if (!empty($prod['oldPrice'])): ?><del><?= $prod['oldPrice'] ?></del><?php endif; ?>
                            <?= $prod['price'] ?>
                        </h6>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- Deal of the Week Card -->
            <div class="col-lg-9">
                <div class="deal-of-the-week">
                    <div class="healthy-product-img">
                        <h6>Featured Wellness Product</h6>
                        <img src="<?= ViewHelper::asset('img/food-6.png') ?>" alt="deal of the week" />
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                    </div>
                    <div class="healthy-product">
                        <span>Canine Health Diet</span>
                        <a href="<?= ViewHelper::url('our-products') ?>">Balanced Organic Chicken & Rice Formula</a>
                        <h6>
                            <del>$32.00</del>
                            $22.00
                        </h6>
                        <h5>14% off</h5>
                        <div class="add-to-cart">
                            <form action="<?= ViewHelper::url('cart/add') ?>" method="POST" class="d-inline">
                                <?= ViewHelper::csrfField() ?>
                                <input type="hidden" name="product_id" value="6">
                                <input type="hidden" name="name" value="Balanced Organic Chicken & Rice Formula">
                                <input type="hidden" name="price" value="22.00">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="image" value="img/food-6.png">
                                <button type="submit" class="button border-0">Add to Cart</button>
                            </form>
                            <a href="<?= ViewHelper::url('our-products') ?>" class="heart-wishlist ms-2" aria-label="Add to wishlist">
                                <i class="fa-regular fa-heart"></i>
                            </a>
                        </div>
                        <div id="countdown">
                            <ul>
                                <li><span id="days">14</span>days</li>
                                <li><span id="hours">08</span>Hour</li>
                                <li><span id="minutes">42</span>Min</li>
                                <li class="mb-0"><span id="seconds">30</span>Sec</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Instagram Gallery Section -->
<div class="gap">
    <div class="container">
        <ul class="image-gallery list-unstyled d-flex flex-wrap gap-2 justify-content-between p-0 mb-0">
            <?php
            $galleryPhotos = [
                'img/gallery-1.jpg',
                'img/gallery-2.jpg',
                'img/gallery-3.jpg',
                'img/gallery-4.jpg',
                'img/gallery-5.jpg',
                'img/gallery-6.jpg',
                'img/gallery-7.jpg'
            ];
            foreach ($galleryPhotos as $photo):
            ?>
                <li style="flex: 1 1 calc(14% - 10px); min-width: 130px;">
                    <a href="<?= ViewHelper::asset($photo) ?>" data-fancybox="shop-gallery" class="d-block overflow-hidden rounded position-relative">
                        <figure class="mb-0">
                            <img alt="Pet Gallery" src="<?= ViewHelper::asset($photo) ?>" class="w-100" style="height: 140px; object-fit: cover;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
