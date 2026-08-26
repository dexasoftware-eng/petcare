<?php
use Helpers\ViewHelper;
?>
<footer style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/background.png') ?>'); position: relative; overflow: hidden;">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="logo">
                    <a href="<?= ViewHelper::url('/') ?>">
                        <img src="<?= ViewHelper::asset('img/logo.svg') ?>" alt="Petguard" style="height: 48px; width: auto;" />
                    </a>
                    <p>PetGuard is a multi-role digital platform connecting pet owners, veterinary clinics, and animal rescue shelters for smarter health management and streamlined care coordination.</p>
                    <div class="phone">
                        <i>
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;">
                                <path d="M0,81v350h512V81H0z M456.952,111L256,286.104L55.047,111H456.952z M30,128.967l134.031,116.789L30,379.787V128.967z M51.213,401l135.489-135.489L256,325.896l69.298-60.384L460.787,401H51.213z M482,379.788L347.969,245.756L482,128.967V379.788z"/>
                            </svg>
                        </i>
                        <a href="mailto:info@Petguard.com">info@Petguard.com</a>
                    </div>
                    <div class="phone d-flax align-items-center">
                        <i>
                            <svg version="1.1" xml:space="preserve" width="682.66669" height="682.66669" viewBox="0 0 682.66669 682.66669" xmlns="http://www.w3.org/2000/svg">
                                <clipPath clipPathUnits="userSpaceOnUse"><path d="M 0,512 H 512 V 0 H 0 Z"/></clipPath>
                                <g transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                    <g>
                                        <g clip-path="url(#clipPath2333)">
                                            <g transform="translate(256,92)">
                                                <path d="m 0,0 c -126.964,143.662 -160,165.23 -160,240 0,88.366 71.634,160 160,160 88.365,0 160,-71.634 160,-160 C 160,165.854 130.212,147.337 0,0 Z" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"/>
                                            </g>
                                            <g transform="translate(316,372)">
                                                <path d="m 0,0 -80,-80 -40,40" style="fill:none;stroke:#000;stroke-width:40;stroke-linecap:square;stroke-linejoin:miter;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"/>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </i>
                        <p>Eighth Avenue 487, New York</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="widget-title">
                    <h3>Platform Navigation</h3>
                    <div class="boder"></div>
                    <ul>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('services') ?>">Digital Pet Profiles</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('services') ?>">Veterinary Consultations</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('services') ?>">Vaccination Tracking</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('services') ?>">Shelter Adoption Hub</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('register/owner') ?>">Pet Owner Portal</a></li>
                        <li><i class="fa-solid fa-angle-right"></i><a href="<?= ViewHelper::url('register/veterinarian') ?>">Veterinarian Portal</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-xl-4 col-lg-6">
                <div class="working-hours">
                    <div class="widget-title">
                        <h3>working hours</h3>
                        <div class="boder"></div>
                        <div class="working-time">
                            <h6 class="pt-0">Monday - Saturday <span>08AM - 10PM</span></h6>
                            <h6>Sunday<span>08AM - 10PM</span></h6>
                            <div class="call-us">
                                <img src="<?= ViewHelper::asset('img/hadphon.png') ?>" alt="hadphon" />
                                <div>
                                    <a href="tel:+923243284192">+92 324 3284 192</a>
                                    <span>Got Questions? Call us 24/7</span>
                                </div>
                            </div>
                            <ul class="social-icon">
                                <li><a href="https://facebook.com" target="_blank" rel="noreferrer"><i class="fa-brands fa-facebook-f"></i></a></li>
                                <li><a href="https://twitter.com" target="_blank" rel="noreferrer"><i class="fa-brands fa-twitter"></i></a></li>
                                <li><a href="https://instagram.com" target="_blank" rel="noreferrer"><i class="fa-brands fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copyright">
            <p>Petguard Pet Care - Copyright 2024. All rights reserved.</p>
            <a href="#"><img src="<?= ViewHelper::asset('img/visa.jpg') ?>" alt="visa" /></a>
        </div>
    </div>

    <img src="<?= ViewHelper::asset('img/hero-shaps-1.png') ?>" alt="hero-shaps" class="img-2" />
    <img src="<?= ViewHelper::asset('img/dabal-foot-1.png') ?>" alt="hero-shaps" class="img-3" />
    <img src="<?= ViewHelper::asset('img/hero-shaps-1.png') ?>" alt="hero-shaps" class="img-4" />
</footer>
