<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Slider Section -->
<section class="hero-section" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/background.png') ?>'); position: relative; overflow: hidden; min-height: 720px;">
    <div class="container">
        <div class="row hero-one-slider owl-carousel owl-theme">
            <!-- Slide 1 -->
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Connected Digital Pet Care & Health</h1>
                            <h3>A modern platform uniting Pet Owners, Veterinarians, and Animal Shelters in one secure, unified ecosystem.</h3>
                            <a href="<?= ViewHelper::url('register/owner') ?>" class="button">Create Pet Profile</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img position-relative text-center">
                            <img src="<?= ViewHelper::asset('img/hero-img-1.png') ?>" alt="Hero Mascot" class="img-fluid hero-main-img" />
                            <img src="<?= ViewHelper::asset('img/hero-shaps.png') ?>" alt="Hero Shape" class="img-1 position-absolute" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Smarter Veterinary Care & Records</h1>
                            <h3>Centralize medical history, track vaccination timelines, and schedule veterinary appointments with ease.</h3>
                            <a href="<?= ViewHelper::url('services') ?>" class="button">Find Veterinary Care</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img position-relative text-center">
                            <img src="<?= ViewHelper::asset('img/slide-3.png') ?>" alt="Hero Mascot" class="img-fluid hero-main-img" />
                            <img src="<?= ViewHelper::asset('img/hero-shaps.png') ?>" alt="Hero Shape" class="img-1 position-absolute" />
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="item">
                <div class="row align-items-center">
                    <div class="col-lg-5">
                        <div class="hero-text">
                            <h1>Shelter Network & Pet Adoption</h1>
                            <h3>Connecting animal rescue shelters with loving pet owners to make pet adoption transparent, organized, and accessible.</h3>
                            <a href="<?= ViewHelper::url('services') ?>" class="button">Explore Platform</a>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="hero-img position-relative text-center">
                            <img src="<?= ViewHelper::asset('img/slide-2.png') ?>" alt="Hero Mascot" class="img-fluid hero-main-img" />
                            <img src="<?= ViewHelper::asset('img/hero-shaps.png') ?>" alt="Hero Shape" class="img-1 position-absolute" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <img src="<?= ViewHelper::asset('img/hero-shaps-1.png') ?>" alt="Decorative Shape" class="img-2" />
    <img src="<?= ViewHelper::asset('img/dabal-foot-1.png') ?>" alt="Paw Prints" class="img-3" />
    <img src="<?= ViewHelper::asset('img/hero-shaps-1.png') ?>" alt="Decorative Shape" class="img-4" />
</section>

<!-- 2. We Provide 3-Card Grid Section -->
<section class="gap no-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="<?= ViewHelper::asset('img/we-provide-1.jpg') ?>" alt="Digital Pet Profiles" />
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                        </svg>
                    </div>
                    <a href="<?= ViewHelper::url('register/owner') ?>">
                        <h5>Digital Pet Profiles</h5>
                    </a>
                    <p>Maintain structured records of your pet's breed, age, medical history, allergies, and daily dietary care in one place.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="we-provide">
                    <div class="we-provide-img">
                        <img src="<?= ViewHelper::asset('img/we-provide-2.jpg') ?>" alt="Veterinary Coordination" />
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                        </svg>
                    </div>
                    <a href="<?= ViewHelper::url('register/veterinarian') ?>">
                        <h5>Veterinary Coordination</h5>
                    </a>
                    <p>Connect with certified veterinarians, coordinate clinic appointments, and maintain clinical health records securely.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="we-provide mb-0">
                    <div class="we-provide-img">
                        <img src="<?= ViewHelper::asset('img/we-provide-3.jpg') ?>" alt="Shelter & Adoption Hub" />
                        <svg width="326" height="326" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                        </svg>
                    </div>
                    <a href="<?= ViewHelper::url('register/shelter') ?>">
                        <h5>Shelter & Adoption Hub</h5>
                    </a>
                    <p>Empower rescue shelters with digital profiles to showcase adoptable animals and connect with responsible pet parents.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Welcome Section -->
<section class="gap no-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="welcome-to">
                    <h2>Welcome to PetGuard Connected Pet Care</h2>
                    <p>PetGuard is a modern, unified platform designed to bridge the gap between pet owners, veterinary professionals, and animal rescue shelters. From digital health records and vaccination tracking to clinical consultations and adoption workflows, we bring every facet of pet wellbeing into one secure, accessible ecosystem.</p>
                    <div class="row mt-lg-5">
                        <div class="col-md-6">
                            <div class="pet-grooming">
                                <i>
                                    <img src="<?= ViewHelper::asset('img/welcome-to-1.png') ?>" alt="Digital Pet Profile Icon" />
                                </i>
                                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                                </svg>
                                <a href="<?= ViewHelper::url('services') ?>">
                                    <h4>Digital Health Hub</h4>
                                </a>
                                <p>Store medical history, vaccinations, dietary needs, and microchip IDs in one central profile.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pet-grooming mb-0">
                                <i>
                                    <img src="<?= ViewHelper::asset('img/welcome-to-2.png') ?>" alt="Veterinary Care Icon" />
                                </i>
                                <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                                </svg>
                                <a href="<?= ViewHelper::url('services') ?>">
                                    <h4>Veterinary Care</h4>
                                </a>
                                <p>Coordinate appointments, review clinical summaries, and collaborate with certified vets.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dog-walker two d-block position-relative">
                    <img src="<?= ViewHelper::asset('img/puppies.png') ?>" class="puppies position-absolute" alt="puppies" />
                    <img src="<?= ViewHelper::asset('img/dog-walker-1.png') ?>" class="w-100" alt="dog walker mascot" />
                    <img src="<?= ViewHelper::asset('img/line.png') ?>" class="line position-absolute" alt="curved line" />
                    <img src="<?= ViewHelper::asset('img/dabal-foot.png') ?>" class="dabal-foot position-absolute" alt="paws" />
                    <img src="<?= ViewHelper::asset('img/haddi.png') ?>" class="haddi position-absolute" alt="bone" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Category Slider Section -->
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

<!-- 5. Healthy Products Section -->
<section class="gap section-healthy-product" style="background-image: url('<?= ViewHelper::asset('img/healthy-product.png') ?>'); background-color: #f5f5f5;">
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
                                <button type="button" class="btn btn-sm btn-brand rounded-pill px-3 py-1 fw-bold text-white border-0" onclick="quickAddToCart(<?= (int)$prod['id'] ?>, '<?= addslashes($prod['title']) ?>')">
                                    <i class="fa-solid fa-cart-plus me-1"></i> Add to Cart
                                </button>
                                <button type="button" class="heart-wishlist border-0 bg-transparent cursor-pointer p-0 ms-2" onclick="toggleMarketWishlist(this, <?= (int)$prod['id'] ?>)" aria-label="Add to wishlist">
                                    <i class="<?= ViewHelper::isInWishlist((int)$prod['id']) ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart' ?>"></i>
                                </button>
                            </div>
                            <?php if (!empty($prod['discount'])): ?>
                                <h4><?= $prod['discount'] ?></h4>
                            <?php endif; ?>
                        </div>
                        <span><?= $prod['category'] ?></span>
                        <a href="<?= ViewHelper::url('product-details/' . ($prod['slug'] ?? 'royal-canin-veterinary-diet-gastrointestinal-dog-food-12kg')) ?>"><?= ViewHelper::e($prod['title']) ?></a>
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
                        <a href="<?= ViewHelper::url('product-details/royal-canin-veterinary-diet-gastrointestinal-dog-food-12kg') ?>">Royal Canin Gastrointestinal Diet 12kg</a>
                        <h6>
                            <del>$89.99</del>
                            $74.99
                        </h6>
                        <h5>17% off</h5>
                        <div class="add-to-cart">
                            <button type="button" class="button border-0 cursor-pointer" onclick="quickAddToCart(1, 'Royal Canin Gastrointestinal Diet 12kg')">
                                <i class="fa-solid fa-cart-plus me-1"></i> Add to Cart
                            </button>
                            <button type="button" class="heart-wishlist ms-2 border-0 bg-transparent cursor-pointer p-0" onclick="toggleMarketWishlist(this, 1)" aria-label="Add to wishlist">
                                <i class="<?= ViewHelper::isInWishlist(1) ? 'fa-solid fa-heart text-danger' : 'fa-regular fa-heart' ?>"></i>
                            </button>
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

<!-- 6. Fun Facts Counter Section -->
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text text-center">
                    <img alt="Milestone Icon" src="<?= ViewHelper::asset('img/fun-facts-1.png') ?>" class="mb-3" />
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h2 class="count mb-0">100</h2>
                            <span style="color: #fa441d; font-size: 28px; font-weight: bold;">+</span>
                        </div>
                        <h3 class="text mt-1">Client Served</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text text-center">
                    <img alt="Milestone Icon" src="<?= ViewHelper::asset('img/fun-facts-2.png') ?>" class="mb-3" />
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h2 class="count mb-0">99</h2>
                            <span style="color: #fa441d; font-size: 28px; font-weight: bold;">%</span>
                        </div>
                        <h3 class="text mt-1">Client Served</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="count-text text-center">
                    <img alt="Milestone Icon" src="<?= ViewHelper::asset('img/fun-facts-3.png') ?>" class="mb-3" />
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h2 class="count mb-0">2</h2>
                            <span style="color: #fa441d; font-size: 28px; font-weight: bold;">k</span>
                        </div>
                        <h3 class="text mt-1">Client Served</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 mb-0">
                <div class="count-text text-center">
                    <img alt="Milestone Icon" src="<?= ViewHelper::asset('img/fun-facts-4.png') ?>" class="mb-3" />
                    <div>
                        <div class="d-flex justify-content-center align-items-center">
                            <h2 class="count mb-0">400</h2>
                            <span style="color: #fa441d; font-size: 28px; font-weight: bold;">+</span>
                        </div>
                        <h3 class="text mt-1">Client Served</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 7. Meet Our Experts / Best Working Team Section -->
<section>
    <div class="container">
        <div class="heading">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading ornament" />
            <h6>Meet Our Experts</h6>
            <h2>Best Working Team</h2>
        </div>
        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="team-working text-center">
                    <div class="position-relative d-inline-block">
                        <img src="<?= ViewHelper::asset('img/team-1.jpg') ?>" alt="Gorjona Hiller" />
                        <svg width="188" height="188" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    </div>
                    <span>Veterinary Clinical Coordinator</span>
                    <a href="<?= ViewHelper::url('team-details/1') ?>">
                        <h4>Gorjona Hiller</h4>
                    </a>
                    <ul class="social-icon list-unstyled d-flex justify-content-center gap-2 mt-3">
                        <li><a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="team-working text-center">
                    <div class="position-relative d-inline-block">
                        <img src="<?= ViewHelper::asset('img/team-2.jpg') ?>" alt="Willimes Domson" />
                        <svg width="188" height="188" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    </div>
                    <span>Pet Care & Behavior Specialist</span>
                    <a href="<?= ViewHelper::url('team-details/2') ?>">
                        <h4>Willimes Domson</h4>
                    </a>
                    <ul class="social-icon list-unstyled d-flex justify-content-center gap-2 mt-3">
                        <li><a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-0">
                <div class="team-working text-center">
                    <div class="position-relative d-inline-block">
                        <img src="<?= ViewHelper::asset('img/team-3.jpg') ?>" alt="Thomas Walkar" />
                        <svg width="188" height="188" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                    </div>
                    <span>Senior Veterinary Technician</span>
                    <a href="<?= ViewHelper::url('team-details/3') ?>">
                        <h4>Thomas Walkar</h4>
                    </a>
                    <ul class="social-icon list-unstyled d-flex justify-content-center gap-2 mt-3">
                        <li><a href="https://facebook.com" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                        <li><a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. Find Dog Walker & Care CTA Section -->
<section class="gap">
    <div class="container">
        <div class="dog-walker">
            <img src="<?= ViewHelper::asset('img/dog-walker.png') ?>" alt="dog walker" />
            <img src="<?= ViewHelper::asset('img/line.png') ?>" class="line" alt="line" />
            <img src="<?= ViewHelper::asset('img/dabal-foot.png') ?>" class="dabal-foot" alt="dabal-foot" />
            <div class="dog-walker-text">
                <h2>Find Trusted Veterinary & Pet Care</h2>
                <p>Connect with licensed veterinarians, certified clinics, and shelter adoption centers in your area.</p>
                <form action="<?= ViewHelper::url('contact') ?>" method="GET">
                    <input placeholder="Enter city, address, or postal code..." name="location" type="text" required />
                    <button type="submit" class="button border-0">Find Care</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- 9. Testimonial / Feedback Section -->
<section class="section-client gap" style="background-image: url('<?= ViewHelper::asset('img/client-b.jpg') ?>');">
    <div class="container">
        <div class="heading two">
            <h2>Ecosystem Feedback & Community Impact</h2>
        </div>

        <div class="client-slider owl-carousel owl-theme">
            <div class="item">
                <div class="client">
                    <img src="<?= ViewHelper::asset('img/client.png') ?>" alt="Sarah Jenkins" />
                    <div class="client-text">
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <p>PetGuard makes managing my golden retriever's vaccinations and medical history completely effortless. Having all records in one digital profile during vet visits is a game-changer.</p>
                        <h4>Sarah Jenkins</h4>
                        <span>Verified Pet Owner</span>
                        <i class="quote">
                            <img src="<?= ViewHelper::asset('img/quote.png') ?>" alt="quote" />
                        </i>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="client">
                    <img src="<?= ViewHelper::asset('img/client.png') ?>" alt="Dr. Marcus Vance" />
                    <div class="client-text">
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <p>As a practicing veterinarian, having centralized pet records and direct owner appointment coordination streamlines our clinic workflow and significantly improves patient care.</p>
                        <h4>Dr. Marcus Vance</h4>
                        <span>Licensed Veterinarian</span>
                        <i class="quote">
                            <img src="<?= ViewHelper::asset('img/quote.png') ?>" alt="quote" />
                        </i>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="client">
                    <img src="<?= ViewHelper::asset('img/client.png') ?>" alt="Elena Rostova" />
                    <div class="client-text">
                        <ul class="star">
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                            <li><i class="fa-solid fa-star"></i></li>
                        </ul>
                        <p>Listing rescue animals and managing adoption inquiries has never been more organized. PetGuard provides the exact digital bridge animal shelters need to reach loving families.</p>
                        <h4>Elena Rostova</h4>
                        <span>Shelter Operations Lead</span>
                        <i class="quote">
                            <img src="<?= ViewHelper::asset('img/quote.png') ?>" alt="quote" />
                        </i>
                    </div>
                </div>
            </div>
        </div>

        <div class="rated">
            <ul class="star">
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
                <li><i class="fa-solid fa-star"></i></li>
            </ul>
            <h4>Unified Experience for Owners, Clinics & Rescues</h4>
        </div>
    </div>
</section>

<!-- 10. Blog & Recent Articles Section -->
<section class="gap no-bottom">
    <div class="container">
        <div class="heading">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading ornament" />
            <h6>Blog and News</h6>
            <h2>Recent Articles</h2>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-4 col-md-6">
                <div class="blog-style">
                    <figure class="mb-0 overflow-hidden">
                        <img src="<?= ViewHelper::asset('img/blog-1.jpg') ?>" alt="Blog Post" class="w-100" />
                    </figure>
                    <a href="<?= ViewHelper::url('our-blog') ?>">
                        <h6>Pet Health</h6>
                    </a>
                    <div class="blog-style-text">
                        <h5>14<span>Aug, 2024</span></h5>
                        <div>
                            <a href="<?= ViewHelper::url('blog/pet-vaccination-schedules') ?>">
                                <h3>Essential Guide to Pet Vaccination Schedules & Digital Records</h3>
                            </a>
                            <p>Understand core vaccines, timing guidelines, and how digital health profiles keep your pet protected year-round.</p>
                            <div class="d-flex align-items-center">
                                <img src="<?= ViewHelper::asset('img/man.jpg') ?>" alt="Dr. Marcus Vance" class="rounded-circle me-2" style="width: 32px; height: 32px;" />
                                <h4>Dr. Marcus Vance</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="blog-style">
                    <figure class="mb-0 overflow-hidden">
                        <img src="<?= ViewHelper::asset('img/blog-2.jpg') ?>" alt="Blog Post" class="w-100" />
                    </figure>
                    <a href="<?= ViewHelper::url('our-blog') ?>">
                        <h6>Veterinary Care</h6>
                    </a>
                    <div class="blog-style-text">
                        <h5>10<span>Aug, 2024</span></h5>
                        <div>
                            <a href="<?= ViewHelper::url('blog/stress-free-vet-checkup') ?>">
                                <h3>Preparing Your Pet for a Stress-Free Veterinary Checkup</h3>
                            </a>
                            <p>Practical steps to prepare health records, reduce clinical anxiety, and make annual wellness exams seamless.</p>
                            <div class="d-flex align-items-center">
                                <img src="<?= ViewHelper::asset('img/man.jpg') ?>" alt="Dr. Marcus Vance" class="rounded-circle me-2" style="width: 32px; height: 32px;" />
                                <h4>Dr. Marcus Vance</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-0">
                <div class="blog-style">
                    <figure class="mb-0 overflow-hidden">
                        <img src="<?= ViewHelper::asset('img/blog-3.jpg') ?>" alt="Blog Post" class="w-100" />
                    </figure>
                    <a href="<?= ViewHelper::url('our-blog') ?>">
                        <h6>Shelter & Adoption</h6>
                    </a>
                    <div class="blog-style-text">
                        <h5>02<span>Aug, 2024</span></h5>
                        <div>
                            <a href="<?= ViewHelper::url('blog/welcoming-rescue-pet') ?>">
                                <h3>Welcoming a Rescue Pet: The 3-3-3 Adjustment Rule</h3>
                            </a>
                            <p>A compassionate step-by-step roadmap for helping newly adopted shelter pets transition comfortably to their new home.</p>
                            <div class="d-flex align-items-center">
                                <img src="<?= ViewHelper::asset('img/man.jpg') ?>" alt="Elena Rostova" class="rounded-circle me-2" style="width: 32px; height: 32px;" />
                                <h4>Elena Rostova</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="btn-center text-center mt-5">
            <a href="<?= ViewHelper::url('our-blog') ?>" class="button">View All News</a>
        </div>
    </div>
</section>

<!-- 11. Instagram Gallery Section -->
<div class="gap">
    <div class="container">
        <div class="insta-img d-flex flex-column flex-sm-row justify-content-between align-items-center mb-4">
            <h3 class="mb-3 mb-sm-0">
                <i class="fa-brands fa-instagram me-2 text-danger"></i>
                Follow @Petguard
            </h3>
            <a href="https://instagram.com" target="_blank" rel="noreferrer" class="button">
                Follow Us
            </a>
        </div>

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
                    <a href="<?= ViewHelper::asset($photo) ?>" class="d-block overflow-hidden rounded position-relative" data-fancybox="gallery">
                        <figure class="mb-0">
                            <img alt="Pet Gallery" src="<?= ViewHelper::asset($photo) ?>" class="w-100" style="height: 140px; object-fit: cover; transition: transform 0.4s ease;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
