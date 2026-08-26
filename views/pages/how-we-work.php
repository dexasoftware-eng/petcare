<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>How We Work</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">How We Work</li>
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

<!-- We Provide Section -->
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
                    <a href="<?= ViewHelper::url('register/owner') ?>"><h5>Digital Pet Profiles</h5></a>
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
                    <a href="<?= ViewHelper::url('register/veterinarian') ?>"><h5>Veterinary Coordination</h5></a>
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
                    <a href="<?= ViewHelper::url('register/shelter') ?>"><h5>Shelter & Adoption Hub</h5></a>
                    <p>Empower rescue shelters with digital profiles to showcase adoptable animals and connect with responsible pet parents.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Section -->
<section class="gap no-bottom">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="welcome-to">
                    <h2>Welcome to PetGuard Connected Pet Care</h2>
                    <p>PetGuard is a modern, unified platform designed to bridge the gap between pet owners, veterinary professionals, and animal rescue shelters. From digital health records and vaccination tracking to clinical consultations and adoption workflows, we bring every facet of pet wellbeing into one secure, accessible ecosystem.</p>
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

<!-- Find Dog Walker Section -->
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
