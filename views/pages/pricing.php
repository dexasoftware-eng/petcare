<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Pricing Packages</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Pricing</li>
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

<!-- Pricing Packages Section -->
<section class="gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card p-5 text-center" style="background-color: #fff8e5; border-radius: 16px; position: relative;">
                    <h3 style="font-weight: bold; margin-bottom: 15px;">Standard Care</h3>
                    <div class="d-flex align-items-baseline justify-content-center mb-4">
                        <span style="font-size: 42px; font-weight: bold; color: #fa441d;">$29</span>
                        <span style="color: #777; margin-left: 5px;">/ visit</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin-bottom: 30px; text-align: left;">
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> 30 Min Dog Walking</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Fresh Food &amp; Water</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Medication Administration</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Daily Photo Updates</li>
                    </ul>
                    <a href="<?= ViewHelper::url('contact') ?>" class="button d-block text-center">Choose Plan</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card p-5 text-center" style="background-color: #fff8e5; border-radius: 16px; border: 2px solid #fa441d; position: relative;">
                    <span style="position: absolute; top: -14px; left: 50%; transform: translateX(-50%); background-color: #fa441d; color: #fff; padding: 4px 14px; border-radius: 20px; font-size: 12px; font-weight: bold;">Most Popular</span>
                    <h3 style="font-weight: bold; margin-bottom: 15px;">Premium Grooming</h3>
                    <div class="d-flex align-items-baseline justify-content-center mb-4">
                        <span style="font-size: 42px; font-weight: bold; color: #fa441d;">$59</span>
                        <span style="color: #777; margin-left: 5px;">/ session</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin-bottom: 30px; text-align: left;">
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Full Bath &amp; Styling</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Nail Trimming &amp; Filing</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Ear Cleaning &amp; Teeth Check</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Coat Conditioning</li>
                    </ul>
                    <a href="<?= ViewHelper::url('contact') ?>" class="button d-block text-center">Choose Plan</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="package-card p-5 text-center" style="background-color: #fff8e5; border-radius: 16px; position: relative;">
                    <h3 style="font-weight: bold; margin-bottom: 15px;">All-Inclusive Stay</h3>
                    <div class="d-flex align-items-baseline justify-content-center mb-4">
                        <span style="font-size: 42px; font-weight: bold; color: #fa441d;">$99</span>
                        <span style="color: #777; margin-left: 5px;">/ day</span>
                    </div>
                    <ul style="list-style: none; padding: 0; margin-bottom: 30px; text-align: left;">
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> 24/7 Supervised Boarding</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Private Luxury Suite</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> 3 Daily Play Sessions</li>
                        <li class="mb-2 d-flex align-items-center"><i class="fa-solid fa-check me-2" style="color: #fa441d;"></i> Grooming &amp; Treats Included</li>
                    </ul>
                    <a href="<?= ViewHelper::url('contact') ?>" class="button d-block text-center">Choose Plan</a>
                </div>
            </div>
        </div>
    </div>
</section>
