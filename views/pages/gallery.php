<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Photo Gallery</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
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

<!-- Gallery Grid Section -->
<section class="gap">
    <div class="container">
        <div class="row g-4">
            <?php
            $galleryPhotos = [
                ['src' => 'img/gallery-1.jpg', 'alt' => 'Healthy dog at clinic checkup'],
                ['src' => 'img/gallery-2.jpg', 'alt' => 'Playful kitten receiving wellness care'],
                ['src' => 'img/gallery-3.jpg', 'alt' => 'Shelter rescue pet ready for adoption'],
                ['src' => 'img/gallery-4.jpg', 'alt' => 'Veterinarian providing gentle clinical examination'],
                ['src' => 'img/gallery-5.jpg', 'alt' => 'Happy pet owner with companion dog'],
                ['src' => 'img/gallery-6.jpg', 'alt' => 'Pet grooming and wellness hygiene session'],
                ['src' => 'img/gallery-7.jpg', 'alt' => 'Outdoor pet exercise and behavioral enrichment'],
                ['src' => 'img/gallery-img-1.jpg', 'alt' => 'Pet Clinic Examination'],
                ['src' => 'img/gallery-img-2.jpg', 'alt' => 'Playful Dog Companion'],
            ];
            foreach ($galleryPhotos as $img):
            ?>
                <div class="col-lg-4 col-md-6">
                    <div class="gallery-item overflow-hidden" style="border-radius: 16px;">
                        <a href="<?= ViewHelper::asset($img['src']) ?>" data-fancybox="main-gallery">
                            <img src="<?= ViewHelper::asset($img['src']) ?>" alt="<?= ViewHelper::e($img['alt']) ?>" style="width: 100%; height: 280px; object-fit: cover; transition: transform 0.4s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" />
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
