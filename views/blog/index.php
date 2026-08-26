<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our News &amp; Blog</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Blog</li>
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

<!-- Blog Listing Section -->
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
                                <h3>Essential Guide to Pet Vaccination Schedules &amp; Digital Records</h3>
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
                        <h6>Shelter &amp; Adoption</h6>
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
                    <a href="<?= ViewHelper::asset($photo) ?>" data-fancybox="blog-gallery" class="d-block overflow-hidden rounded position-relative">
                        <figure class="mb-0">
                            <img alt="Pet Gallery" src="<?= ViewHelper::asset($photo) ?>" class="w-100" style="height: 140px; object-fit: cover;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
