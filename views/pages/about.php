<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>About Us</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">About Us</li>
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

<!-- 2. Company Story & Welcome Section -->
<section class="gap about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="heading two">
                    <h2>Welcome to The Pet Care Company</h2>
                </div>
                <div class="love-your-pets">
                    <p>PetGuard is a multi-role digital ecosystem engineered to unify and streamline pet health management. By bridging communication gaps between devoted pet parents, licensed veterinarians, and shelter adoption coordinators, we ensure every animal receives compassionate, high-quality, and transparent care throughout their life.</p>
                    <ul class="list">
                        <li><img src="<?= ViewHelper::asset('img/list.png') ?>" alt="list icon" /> Centralized clinical histories and digital vaccination tracking</li>
                        <li><img src="<?= ViewHelper::asset('img/list.png') ?>" alt="list icon" /> Certified veterinarians and modern diagnostic facilities</li>
                        <li><img src="<?= ViewHelper::asset('img/list.png') ?>" alt="list icon" /> Rescue shelter adoption workflows with verified pet profiles</li>
                        <li><img src="<?= ViewHelper::asset('img/list.png') ?>" alt="list icon" /> Comprehensive pet health marketplace and dietary nutrition</li>
                    </ul>
                    <div class="company-oner position-relative">
                        <img src="<?= ViewHelper::asset('img/girl.jpg') ?>" alt="Jessica Catty" />
                        <svg width="116" height="116" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                        </svg>
                        <div>
                            <h3>Jessica Catty</h3>
                            <p>Founder & Chief Operations Lead</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="dogs-img">
                    <img src="<?= ViewHelper::asset('img/dogs-1.png') ?>" alt="Happy Dogs" class="w-100" />
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. What We Provide 3-Card Grid -->
<section class="gap" style="padding-bottom: 90px;">
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

<!-- 4. Care Services Grid & Video Highlight -->
<section style="background-image: url('<?= ViewHelper::asset('img/healthy-product.png') ?>'); background-color: #f5f5f5;" class="gap care-services">
    <div class="container">
        <div class="heading text-center mb-5">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading ornament" />
            <h6>Connected Platform Capabilities</h6>
            <h2>Digital Pet Care Ecosystem</h2>
        </div>

        <div class="row g-4 justify-content-center align-items-stretch">
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="pet-grooming w-100" style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start; height: 100%; min-height: 290px; padding: 36px 24px; background-color: #ffffff; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.04); border: 1px solid #ede7db;">
                    <div style="position: relative; width: 138px; height: 138px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center;">
                        <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0;">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                        </svg>
                        <i style="position: relative; z-index: 2;"><img src="<?= ViewHelper::asset('img/welcome-to-1.png') ?>" alt="Digital Pet Profiles" style="max-width: 60px; max-height: 60px; object-fit: contain;" /></i>
                    </div>
                    <a href="<?= ViewHelper::url('services') ?>" style="text-decoration: none;">
                        <h4 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 10px;">Digital Pet Profiles</h4>
                    </a>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0; text-align: center; flex-grow: 1;">Centralized health records, allergy logs, microchip ID, and dietary care notes.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="pet-grooming w-100" style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start; height: 100%; min-height: 290px; padding: 36px 24px; background-color: #ffffff; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.04); border: 1px solid #ede7db;">
                    <div style="position: relative; width: 138px; height: 138px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center;">
                        <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0;">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                        </svg>
                        <i style="position: relative; z-index: 2;"><img src="<?= ViewHelper::asset('img/welcome-to-5.png') ?>" alt="Veterinary Care" style="max-width: 60px; max-height: 60px; object-fit: contain;" /></i>
                    </div>
                    <a href="<?= ViewHelper::url('services') ?>" style="text-decoration: none;">
                        <h4 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 10px;">Veterinary Care</h4>
                    </a>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0; text-align: center; flex-grow: 1;">Direct clinic appointment scheduling, diagnostic reviews, and wellness exams.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="pet-grooming w-100" style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start; height: 100%; min-height: 290px; padding: 36px 24px; background-color: #ffffff; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.04); border: 1px solid #ede7db;">
                    <div style="position: relative; width: 138px; height: 138px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center;">
                        <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0;">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                        </svg>
                        <i style="position: relative; z-index: 2;"><img src="<?= ViewHelper::asset('img/welcome-to-2.png') ?>" alt="Vaccine Tracking" style="max-width: 60px; max-height: 60px; object-fit: contain;" /></i>
                    </div>
                    <a href="<?= ViewHelper::url('services') ?>" style="text-decoration: none;">
                        <h4 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 10px;">Vaccine Tracking</h4>
                    </a>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0; text-align: center; flex-grow: 1;">Automated booster timeline reminders and downloadable immunization records.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 d-flex">
                <div class="pet-grooming w-100" style="display: flex; flex-direction: column; align-items: center; justify-content: flex-start; height: 100%; min-height: 290px; padding: 36px 24px; background-color: #ffffff; border-radius: 20px; box-shadow: 0 8px 25px rgba(0,0,0,0.04); border: 1px solid #ede7db;">
                    <div style="position: relative; width: 138px; height: 138px; margin-bottom: 16px; display: flex; align-items: center; justify-content: center;">
                        <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg" style="position: absolute; top: 0; left: 0;">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                        </svg>
                        <i style="position: relative; z-index: 2;"><img src="<?= ViewHelper::asset('img/welcome-to-4.png') ?>" alt="Shelter Adoptions" style="max-width: 60px; max-height: 60px; object-fit: contain;" /></i>
                    </div>
                    <a href="<?= ViewHelper::url('services') ?>" style="text-decoration: none;">
                        <h4 style="font-size: 20px; font-weight: 700; color: #222; margin-bottom: 10px;">Shelter Adoptions</h4>
                    </a>
                    <p style="font-size: 14px; color: #666; line-height: 1.6; margin: 0; text-align: center; flex-grow: 1;">Browse rescue pet profiles, submit adoption inquiries, and connect with shelters.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-4 align-items-stretch">
            <div class="col-lg-6 col-md-6 d-flex">
                <div class="video position-relative w-100" style="border-radius: 24px; overflow: hidden; box-shadow: 0 12px 35px rgba(0,0,0,0.08); height: 330px; background-color: #e6ded3;">
                    <figure style="width: 100%; height: 100%; margin: 0;">
                        <img src="<?= ViewHelper::asset('img/about-1.jpg') ?>" alt="Veterinary Facility" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                    </figure>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 d-flex">
                <div class="video position-relative w-100" style="border-radius: 24px; overflow: hidden; box-shadow: 0 12px 35px rgba(0,0,0,0.08); height: 330px; background-color: #e6ded3;">
                    <a href="https://www.youtube.com/watch?v=xKxrkht7CpY" class="video-play-btn" data-fancybox style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #ffffff; border-radius: 50%; width: 68px; height: 68px; display: flex; align-items: center; justify-content: center; box-shadow: 0 12px 30px rgba(0,0,0,0.3); z-index: 3;">
                        <i style="color: #fa441d; font-size: 22px; margin-left: 4px;" class="fa-solid fa-play"></i>
                    </a>
                    <figure style="width: 100%; height: 100%; margin: 0;">
                        <img src="<?= ViewHelper::asset('img/about-2.jpg') ?>" alt="Pet Play Area" style="width: 100%; height: 100%; object-fit: cover; display: block;" />
                    </figure>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 5. Meet Our Experts / Best Working Team Section -->
<section class="gap no-bottom">
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
                    <a href="<?= ViewHelper::url('team-details/1') ?>"><h4>Gorjona Hiller</h4></a>
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
                    <a href="<?= ViewHelper::url('team-details/2') ?>"><h4>Willimes Domson</h4></a>
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
                    <a href="<?= ViewHelper::url('team-details/3') ?>"><h4>Thomas Walkar</h4></a>
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

<!-- 7. Testimonial Section -->
<section class="section-client gap" style="background-image: url('<?= ViewHelper::asset('img/client-b.jpg') ?>');">
    <div class="container">
        <div class="heading two">
            <h2>Ecosystem Feedback & Community Impact</h2>
        </div>
        <div class="client-slider">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-12 mb-4">
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
                            <i class="quote"><img src="<?= ViewHelper::asset('img/quote.png') ?>" alt="quote" /></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mb-4">
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
                            <i class="quote"><img src="<?= ViewHelper::asset('img/quote.png') ?>" alt="quote" /></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 8. Pet Care Memories Photo Gallery -->
<div class="gap">
    <div class="container">
        <div class="heading text-center mb-5">
            <img src="<?= ViewHelper::asset('img/heading-img.png') ?>" alt="heading ornament" />
            <h6>Life at PetGuard</h6>
            <h2>Pet Care Memories</h2>
        </div>
        <ul class="image-gallery list-unstyled d-flex flex-wrap gap-2 justify-content-between p-0 mb-0">
            <?php
            $galleryList = [
                'img/gallery-img-1.jpg',
                'img/gallery-img-3.jpg',
                'img/gallery-img-4.jpg',
                'img/gallery-img-5.jpg',
                'img/gallery-img-6.jpg',
                'img/gallery-img-7.jpg',
                'img/gallery-img-2.jpg',
            ];
            foreach ($galleryList as $gImg):
            ?>
                <li style="flex: 1 1 calc(14% - 10px); min-width: 130px;">
                    <a href="<?= ViewHelper::asset($gImg) ?>" data-fancybox="about-gallery" class="d-block overflow-hidden rounded position-relative">
                        <figure class="mb-0">
                            <img alt="Pet Care Memory" src="<?= ViewHelper::asset($gImg) ?>" class="w-100" style="height: 140px; object-fit: cover; transition: transform 0.4s ease;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- 9. Promo Mockup / CTA Section -->
<section class="gap no-top">
    <div class="container">
        <div class="discount" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/background.png') ?>'); border-radius: 24px; padding: 60px 40px; text-align: center;">
            <h2 style="font-size: 32px; font-weight: 800; color: #222; margin-bottom: 16px;">Create your pet's digital health profile with PetGuard today</h2>
            <p style="font-size: 16px; color: #666; max-width: 650px; margin: 0 auto 30px;">Join proactive pet owners, certified veterinary clinics, and rescue shelters collaborating on one connected platform.</p>
            <a href="<?= ViewHelper::url('register/owner') ?>" class="button">Create Pet Profile</a>
        </div>
    </div>
</section>
