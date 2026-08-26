<?php
use Helpers\ViewHelper;
?>

<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2>Contact Us</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
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

<!-- 2. Contact Info Cards Section -->
<section class="gap">
    <div class="container">
        <div class="heading">
            <h6>We would love to hear from you.</h6>
            <h2>Expert Pet Care with a personal touch</h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="content-us">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                    </svg>
                    <i>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;">
                            <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"/>
                        </svg>
                    </i>
                    <span>Email Address.</span>
                    <a href="mailto:info@Petguard.com">info@Petguard.com</a>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="content-us">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                    </svg>
                    <i>
                        <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg">
                            <g clip-rule="evenodd" fill="#ffffff" fill-rule="evenodd">
                                <path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"/>
                                <path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"/>
                                <path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"/>
                            </g>
                        </svg>
                    </i>
                    <span>Phone Number.</span>
                    <a href="tel:+923243284192">+92 324 3284 192</a>
                    <h6>24/7 Support team</h6>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="content-us mb-0">
                    <svg width="140" height="140" viewBox="0 0 673 673" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M9.82698 416.603C-19.0352 298.701 18.5108 173.372 107.497 90.7633L110.607 96.5197C24.3117 177.199 -12.311 298.935 15.0502 413.781L9.82698 416.603ZM89.893 565.433C172.674 654.828 298.511 692.463 416.766 663.224L414.077 658.245C298.613 686.363 175.954 649.666 94.9055 562.725L89.893 565.433ZM656.842 259.141C685.039 374.21 648.825 496.492 562.625 577.656L565.413 582.817C654.501 499.935 691.9 374.187 662.536 256.065L656.842 259.141ZM581.945 107.518C499.236 18.8371 373.997 -18.4724 256.228 10.5134L259.436 16.4515C373.888 -10.991 495.248 25.1518 576.04 110.708L581.945 107.518Z" fill="#000"/>
                    </svg>
                    <i>
                        <i class="fa-solid fa-clock text-white fs-2"></i>
                    </i>
                    <span>Working Hours.</span>
                    <a href="#hours">9:00 AM - 5:00 PM</a>
                    <h6>Monday - Friday</h6>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 3. Office Location & Interactive Pet Booking Form -->
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="find-a-dog contact">
                    <h2>Find a dog walker or pet care</h2>
                    <p>Place your trust in PetGuard, an award-winning dog walking and pet care</p>
                    <form action="<?= ViewHelper::url('contact') ?>" method="GET">
                        <input type="text" name="location" placeholder="Enter address or postcode..." />
                        <button type="submit" class="button border-0">Find Branch</button>
                    </form>
                    <div class="head-office">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-location-dot"></i>
                            <h6>Head Office United State:</h6>
                        </div>
                        <p>#201 1218 9th Avenue SE, Calgary, AB T2G 0T1</p>
                    </div>
                    <div class="head-office mb-lg-0">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-location-dot"></i>
                            <h6>Head Office United State:</h6>
                        </div>
                        <p>#201 1218 9th Avenue SE, Calgary, AB T2G 0T1</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="looking position-relative contact">
                    <form class="looking-form" action="<?= ViewHelper::url('contact') ?>" method="POST">
                        <?= ViewHelper::csrfField() ?>
                        <h3>Book Your Place or Find out More</h3>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="name" placeholder="Complete Name" required />
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Email Address" required />
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="phone" placeholder="Phone Number" />
                            </div>
                            <div class="col-lg-6">
                                <input type="text" name="postal_code" placeholder="Postal Code" />
                            </div>
                            <div class="col-lg-12">
                                <select name="service" class="nice-select Advice w-100" style="display: block; height: 60px; border: 3px solid #feda46; border-radius: 46px; padding: 0 20px; background-color: #ffffff; font-weight: 600; color: #222; margin-bottom: 15px;">
                                    <option value="General Inquiry">Select Service</option>
                                    <option value="Pet Sitting & Dog Walking">Pet Sitting &amp; Dog Walking</option>
                                    <option value="Veterinary Health Consultation">Veterinary Health Consultation</option>
                                    <option value="Vaccination & Immunization">Vaccination &amp; Immunization</option>
                                    <option value="Shelter Rescue & Adoption">Shelter Rescue &amp; Adoption</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <textarea name="message" placeholder="Please let us know how we can help you and your pet..." required></textarea>
                            </div>
                        </div>
                        <button type="submit" class="button border-0">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 4. Instagram Gallery Section -->
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
                    <a href="<?= ViewHelper::asset($photo) ?>" data-fancybox="contact-gallery" class="d-block overflow-hidden rounded position-relative">
                        <figure class="mb-0">
                            <img alt="Pet Gallery" src="<?= ViewHelper::asset($photo) ?>" class="w-100" style="height: 140px; object-fit: cover;" />
                        </figure>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
