<?php
use Helpers\Auth;
use Helpers\ViewHelper;

$user = Auth::user();
$role = Auth::role();
$isAuthenticated = Auth::check();

$dashboardLink = $isAuthenticated ? ViewHelper::url('portal') : ViewHelper::url('login');
?>
<header>
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-slid">
                <div>
                    <div class="phone-data">
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
                                <svg height="112" viewBox="0 0 24 24" width="112" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-rule="evenodd" fill="#fe5716" fill-rule="evenodd">
                                        <path d="m7 2.75c-.41421 0-.75.33579-.75.75v17c0 .4142.33579.75.75.75h10c.4142 0 .75-.3358.75-.75v-17c0-.41421-.3358-.75-.75-.75zm-2.25.75c0-1.24264 1.00736-2.25 2.25-2.25h10c1.2426 0 2.25 1.00736 2.25 2.25v17c0 1.2426-1.0074 2.25-2.25 2.25h-10c-1.24264 0-2.25-1.0074-2.25-2.25z"/>
                                        <path d="m10.25 5c0-.41421.3358-.75.75-.75h2c.4142 0 .75.33579.75.75s-.3358.75-.75.75h-2c-.4142 0-.75-.33579-.75-.75z"/>
                                        <path d="m9.25 19c0-.4142.33579-.75.75-.75h4c.4142 0 .75.3358.75.75s-.3358.75-.75.75h-4c-.41421 0-.75-.3358-.75-.75z"/>
                                    </g>
                                </svg>
                            </i>
                            <a class="me-3" href="tel:+923243284192">+92 324 3284 192</a>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="time">
                        <div class="ordering">
                            <a href="<?= ViewHelper::url('services') ?>">Services</a>
                            <div class="line"></div>
                            <a href="<?= ViewHelper::url('our-products') ?>">Pet Shop</a>
                            <div class="line"></div>
                            <a href="<?= ViewHelper::url('contact') ?>">Emergency</a>
                        </div>
                        <div class="login">
                            <?php if ($isAuthenticated && $user): ?>
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fa-solid fa-user-circle" style="color: #fe5716;"></i>
                                    <a href="<?= $dashboardLink ?>" style="font-weight: 700;">
                                        <?= ViewHelper::e($user['name']) ?> (<?= ucfirst($role) ?>)
                                    </a>
                                    <form action="<?= ViewHelper::url('logout') ?>" method="POST" class="d-inline m-0 p-0">
                                        <?= ViewHelper::csrfField() ?>
                                        <button type="submit" style="background: none; border: none; color: #888; font-size: 13px; cursor: pointer; padding-left: 6px;" title="Log Out">
                                            <i class="fa-solid fa-right-from-bracket"></i>
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div style="display: flex; align-items: center;">
                                    <i class="fa-solid fa-user"></i>
                                    <a href="<?= ViewHelper::url('login') ?>">Login / Register</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="bottom-bar">
            <a href="<?= ViewHelper::url('/') ?>">
                <img src="<?= ViewHelper::asset('img/logo.svg') ?>" alt="Petguard" style="height: 48px; width: auto;" />
            </a>
            <nav class="navbar">
                <ul class="navbar-links">
                    <li><a href="<?= ViewHelper::url('/') ?>">Home</a></li>
                    <li><a href="<?= ViewHelper::url('about') ?>">About</a></li>
                    <li><a href="<?= ViewHelper::url('services') ?>">Services</a></li>
                    <li><a href="<?= ViewHelper::url('our-products') ?>">Shop</a></li>
                    <li><a href="<?= ViewHelper::url('our-blog') ?>">News</a></li>
                    <li><a href="<?= ViewHelper::url('contact') ?>">Contact</a></li>
                    <?php if ($isAuthenticated): ?>
                        <li>
                            <a href="<?= $dashboardLink ?>" style="color: #fe5716; font-weight: bold;">Dashboard</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="menu-end">
                <div class="bar-menu" id="openMobileNavBtn" style="cursor: pointer;">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div class="header-search-button search-box-outer" id="openSearchBtn" style="cursor: pointer;">
                    <a href="javascript:void(0)" class="search-btn">
                        <svg height="512" viewBox="0 0 24 24" width="512" xmlns="http://www.w3.org/2000/svg">
                            <g id="_12" data-name="12">
                                <path d="M21.71 20.29l-2.83-2.82A9.52 9.52 0 1 0 17.47 18.88l2.82 2.83a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42zM4 11.5a7.5 7.5 0 1 1 7.5 7.5A7.5 7.5 0 0 1 4 11.5z"/>
                            </g>
                        </svg>
                    </a>
                </div>
                <div class="line"></div>
                <a href="<?= ViewHelper::url('our-products') ?>">
                    <i class="fa-regular fa-heart"></i>
                </a>
                <div class="hamburger-icon">
                    <div class="donation">
                        <a href="<?= ViewHelper::url('shop-cart') ?>" class="mx-0" id="show" aria-label="Shopping Cart">
                            <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"/>
                                </g>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Navigation Sidebar -->
<div class="mobile-nav" id="mobileNavSidebar" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 99999;">
    <div style="background: #fff; width: 300px; height: 100%; padding: 30px; position: relative;">
        <button type="button" id="closeMobileNavBtn" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 24px; cursor: pointer;">&times;</button>
        <a href="<?= ViewHelper::url('/') ?>" class="d-block mb-4">
            <img src="<?= ViewHelper::asset('img/logo.svg') ?>" alt="Petguard" style="height: 40px;" />
        </a>
        <ul class="list-unstyled" style="line-height: 2.5; font-size: 16px; font-weight: 600;">
            <li><a href="<?= ViewHelper::url('/') ?>" class="text-dark text-decoration-none">Home</a></li>
            <li><a href="<?= ViewHelper::url('about') ?>" class="text-dark text-decoration-none">About</a></li>
            <li><a href="<?= ViewHelper::url('services') ?>" class="text-dark text-decoration-none">Services</a></li>
            <li><a href="<?= ViewHelper::url('our-products') ?>" class="text-dark text-decoration-none">Shop</a></li>
            <li><a href="<?= ViewHelper::url('our-blog') ?>" class="text-dark text-decoration-none">News</a></li>
            <li><a href="<?= ViewHelper::url('contact') ?>" class="text-dark text-decoration-none">Contact</a></li>
            <?php if ($isAuthenticated): ?>
                <li><a href="<?= $dashboardLink ?>" style="color: #fe5716;" class="text-decoration-none">Dashboard (<?= ucfirst($role) ?>)</a></li>
            <?php else: ?>
                <li><a href="<?= ViewHelper::url('login') ?>" style="color: #fe5716;" class="text-decoration-none">Login / Register</a></li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<!-- Search Modal -->
<div id="searchModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.85); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
    <div style="width: 100%; max-width: 600px; position: relative;">
        <button type="button" id="closeSearchModalBtn" style="position: absolute; top: -40px; right: 0; background: none; border: none; color: #fff; font-size: 32px; cursor: pointer;">&times;</button>
        <form action="<?= ViewHelper::url('our-products') ?>" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-lg rounded-start-pill px-4" placeholder="Search products, pet food, accessories..." autofocus>
                <button class="btn btn-primary rounded-end-pill px-4" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openMobile = document.getElementById('openMobileNavBtn');
    const closeMobile = document.getElementById('closeMobileNavBtn');
    const mobileNav = document.getElementById('mobileNavSidebar');
    if (openMobile && mobileNav) {
        openMobile.addEventListener('click', () => mobileNav.style.display = 'block');
    }
    if (closeMobile && mobileNav) {
        closeMobile.addEventListener('click', () => mobileNav.style.display = 'none');
    }
    if (mobileNav) {
        mobileNav.addEventListener('click', (e) => {
            if (e.target === mobileNav) mobileNav.style.display = 'none';
        });
    }

    const openSearch = document.getElementById('openSearchBtn');
    const closeSearch = document.getElementById('closeSearchModalBtn');
    const searchModal = document.getElementById('searchModal');
    if (openSearch && searchModal) {
        openSearch.addEventListener('click', () => {
            searchModal.style.display = 'flex';
            const input = searchModal.querySelector('input');
            if (input) input.focus();
        });
    }
    if (closeSearch && searchModal) {
        closeSearch.addEventListener('click', () => searchModal.style.display = 'none');
    }
    if (searchModal) {
        searchModal.addEventListener('click', (e) => {
            if (e.target === searchModal) searchModal.style.display = 'none';
        });
    }
});
</script>
