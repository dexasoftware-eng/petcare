<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Services</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Services</li>
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

<!-- 2. Services 6-Card Grid Section with Video Banner -->
<section class="gap services">
    <div class="container">
        <div class="row g-4">
            <!-- Top 3 Services -->
            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-1.png') ?>" alt="Digital Health Profiles" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/health-profiles') ?>">
                        <h4>Digital Health Profiles</h4>
                    </a>
                    <p>Structured medical histories, allergy logging, weight tracking, and microchip ID records in one secure master hub.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-5.png') ?>" alt="Veterinary Consultations" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/veterinary-care') ?>">
                        <h4>Veterinary Consultations</h4>
                    </a>
                    <p>Real-time appointment booking with verified clinicians, diagnostic reviews, and digital prescription tracking.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-2.png') ?>" alt="Vaccine Tracking" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fedc4f"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/vaccine-tracking') ?>">
                        <h4>Vaccine Tracking</h4>
                    </a>
                    <p>Automated booster schedules, rabies validation certificates, and immutable clinical inoculation histories.</p>
                </div>
            </div>

            <!-- Middle Video Presentation Banner -->
            <div class="col-lg-12">
                <div class="video position-relative rounded overflow-hidden" style="border-radius: 16px;">
                    <a href="https://www.youtube.com/watch?v=xKxrkht7CpY" class="video-play-btn position-absolute top-50 start-50 translate-middle" data-fancybox style="width: 74px; height: 74px; background-color: #ffffff; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 8px 30px rgba(0,0,0,0.3); z-index: 3;">
                        <i class="fa-solid fa-play" style="color: #fa441d; fontSize: 22px; margin-left: 4px;"></i>
                    </a>
                    <figure class="mb-0">
                        <img src="<?= ViewHelper::asset('img/services-video.jpg') ?>" alt="Service Presentation" class="w-100" style="display: block; max-height: 420px; object-fit: cover;" />
                    </figure>
                </div>
            </div>

            <!-- Bottom 3 Services -->
            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center mt-0">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-4.png') ?>" alt="Shelter Adoption Hub" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#940c69"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/shelter-adoption') ?>">
                        <h4>Shelter Adoption Hub</h4>
                    </a>
                    <p>Verified rescue listings, adoption applicant screening, and digital foster intake workflows.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center mt-0">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-3.png') ?>" alt="Pet Nutrition & Diet" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fb5e3c"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/pet-nutrition') ?>">
                        <h4>Pet Nutrition &amp; Diet</h4>
                    </a>
                    <p>Curated therapeutic feeds, caloric guidance, and personalized supplement plans tailored to breed and age.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="pet-grooming text-center mt-0">
                    <i><img src="<?= ViewHelper::asset('img/welcome-to-6.png') ?>" alt="Emergency QR Passport" /></i>
                    <svg width="138" height="138" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#fa441d"/>
                    </svg>
                    <a href="<?= ViewHelper::url('service-details/emergency-passport') ?>">
                        <h4>Emergency QR Passport</h4>
                    </a>
                    <p>Scannable collar QR tag providing immediate emergency contact, critical allergies, and vet clinic details.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Pet Benefits & Membership FAQs Accordion -->
<section class="gap position-relative" style="background-image: url('<?= ViewHelper::asset('img/client-b.jpg') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="heading two w-100 mb-4">
                    <h6>PLATFORM FAQS</h6>
                    <h2>Pet Benefits of<br />Membership</h2>
                </div>
                <div class="accordion">
                    <div class="accordion-item active" style="margin-bottom: 14px; position: relative;">
                        <a href="#faq-1" class="heading position-relative d-block text-decoration-none">
                            <div class="title" style="background-color: #feda46; color: #000; font-weight: 700; font-size: 18px; border-radius: 50px; padding: 16px 24px 16px 64px;">
                                Centralized Pet Healthcare Records
                            </div>
                            <div class="icon" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #fa441d; display: flex; align-items: center; justify-content: center; color: #fff;">
                                <i class="fa-solid fa-minus"></i>
                            </div>
                        </a>
                        <div class="content" style="display: block; padding: 14px 20px 10px 24px;">
                            <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">PetGuard stores all medical records, booster dates, microchips, and veterinarian clinical summaries in one easily shareable digital profile.</p>
                        </div>
                    </div>

                    <div class="accordion-item" style="margin-bottom: 14px; position: relative;">
                        <a href="#faq-2" class="heading position-relative d-block text-decoration-none">
                            <div class="title" style="background-color: #fff; color: #000; font-weight: 700; font-size: 18px; border-radius: 50px; padding: 16px 24px 16px 64px;">
                                Direct Veterinary Clinic Coordination
                            </div>
                            <div class="icon" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #feda46; display: flex; align-items: center; justify-content: center; color: #000;">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </a>
                        <div class="content" style="display: none; padding: 14px 20px 10px 24px;">
                            <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Book consultations directly with certified veterinary clinics and receive diagnostic summaries straight to your dashboard.</p>
                        </div>
                    </div>

                    <div class="accordion-item" style="margin-bottom: 14px; position: relative;">
                        <a href="#faq-3" class="heading position-relative d-block text-decoration-none">
                            <div class="title" style="background-color: #fff; color: #000; font-weight: 700; font-size: 18px; border-radius: 50px; padding: 16px 24px 16px 64px;">
                                Shelter Adoption & Foster Bridge
                            </div>
                            <div class="icon" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); width: 38px; height: 38px; border-radius: 50%; background-color: #feda46; display: flex; align-items: center; justify-content: center; color: #000;">
                                <i class="fa-solid fa-plus"></i>
                            </div>
                        </a>
                        <div class="content" style="display: none; padding: 14px 20px 10px 24px;">
                            <p style="color: #666; font-size: 15px; line-height: 1.7; margin: 0;">Verified animal shelters list rescue animals with full health disclosure, making adoption safe, quick, and transparent.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="faq-img">
                            <img src="<?= ViewHelper::asset('img/faq-1.jpg') ?>" alt="Pet Eating Treat" class="img-fluid" />
                            <img src="<?= ViewHelper::asset('img/faq-2.jpg') ?>" alt="Girl High-Fiving Dog" class="img-fluid" />
                            <img src="<?= ViewHelper::asset('img/faq-3.jpg') ?>" alt="Cat Grooming" class="img-fluid" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="faq-img two">
                            <img src="<?= ViewHelper::asset('img/faq-4.jpg') ?>" alt="Man Hugging Golden Retriever" class="img-fluid" />
                            <img src="<?= ViewHelper::asset('img/faq-5.jpg') ?>" alt="Girl Petting Horse" class="img-fluid" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <img src="<?= ViewHelper::asset('img/faq-shaps.png') ?>" alt="faq-shaps" class="faq-shaps" />
</section>

<!-- 4. Find Dog Walker & Care CTA -->
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

<!-- 5. Instagram Gallery Section -->
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
                    <a href="<?= ViewHelper::asset($photo) ?>" data-fancybox="services-gallery" class="d-block overflow-hidden rounded position-relative">
                        <figure class="mb-0">
                            <img alt="Pet Gallery" src="<?= ViewHelper::asset($photo) ?>" class="w-100" style="height: 140px; object-fit: cover;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
