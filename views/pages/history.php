<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Our History</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">History</li>
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

<section class="gap">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <img src="<?= ViewHelper::asset('img/we-provide-1.jpg') ?>" alt="history" style="width: 100%; border-radius: 16px;" />
            </div>
            <div class="col-lg-6 ps-lg-5 mt-4 mt-lg-0">
                <h2 style="font-size: 36px; font-weight: bold; margin-bottom: 20px;">
                    The Vision Behind PetGuard
                </h2>
                <p style="line-height: 1.8; margin-bottom: 20px; color: #555;">
                    PetGuard was created to solve one of modern pet ownership's biggest pain points: fragmented pet records and uncoordinated care. Between changing vet clinics, tracking immunization boosters, managing medications, and navigating rescue adoptions, pet information is too often lost in scattered paperwork.
                </p>
                <p style="line-height: 1.8; margin-bottom: 20px; color: #555;">
                    Our platform unites Pet Owners, licensed Veterinarians, and Animal Rescue Shelters into one secure, connected ecosystem. Today, PetGuard provides a unified digital space where pet wellness, clinical consultations, and responsible adoptions thrive together.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Fun Facts Section -->
<section class="gap no-top">
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
