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
                <a href="<?= ViewHelper::url('wishlist') ?>" class="position-relative d-inline-flex align-items-center text-dark text-decoration-none" title="View Wishlist">
                    <i class="fa-regular fa-heart" style="font-size: 19px;"></i>
                    <?php if (ViewHelper::wishlistCount() > 0): ?>
                        <span class="badge rounded-circle bg-danger position-absolute top-0 start-100 translate-middle d-flex align-items-center justify-content-center" style="width: 17px; height: 17px; font-size: 9px; padding: 0;">
                            <?= ViewHelper::wishlistCount() ?>
                        </span>
                    <?php endif; ?>
                </a>
                <div class="hamburger-icon">
                    <div class="donation">
                        <a href="<?= ViewHelper::url('shop-cart') ?>" class="mx-0 position-relative d-inline-flex align-items-center" id="show" aria-label="Shopping Cart">
                            <svg enable-background="new 0 0 512 512" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path d="m452 120h-60.946c-7.945-67.478-65.477-120-135.054-120s-127.109 52.522-135.054 120h-60.946c-11.046 0-20 8.954-20 20v352c0 11.046 8.954 20 20 20h392c11.046 0 20-8.954 20-20v-352c0-11.046-8.954-20-20-20zm-196-80c47.484 0 87.019 34.655 94.659 80h-189.318c7.64-45.345 47.175-80 94.659-80zm176 432h-352v-312h40v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h192v60c0 11.046 8.954 20 20 20s20-8.954 20-20v-60h40z"/>
                                </g>
                            </svg>
                            <?php if (ViewHelper::cartCount() > 0): ?>
                                <span class="badge rounded-circle bg-danger position-absolute top-0 start-100 translate-middle d-flex align-items-center justify-content-center" style="width: 17px; height: 17px; font-size: 9px; padding: 0;">
                                    <?= ViewHelper::cartCount() ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Mobile Navigation Off-Canvas Drawer -->
<div class="mobile-nav-backdrop" id="mobileNavBackdrop" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); z-index: 99998; opacity: 0; transition: opacity 0.3s ease;"></div>

<div class="mobile-nav-drawer" id="mobileNavSidebar" style="position: fixed; top: 0; bottom: 0; left: 0; width: 310px; max-width: 85vw; background: #ffffff; z-index: 99999; transform: translateX(-100%); transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; box-shadow: 0 0 40px rgba(0,0,0,0.25);">
    <!-- Drawer Header -->
    <div style="padding: 22px 20px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; justify-content: space-between;">
        <a href="<?= ViewHelper::url('/') ?>">
            <img src="<?= ViewHelper::asset('img/logo.svg') ?>" alt="PetGuard" style="height: 38px; width: auto;" />
        </a>
        <button type="button" id="closeMobileNavBtn" style="width: 38px; height: 38px; border-radius: 50%; background: #f8fafc; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 18px; color: #475569; cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <!-- User Status Banner in Drawer -->
    <div style="padding: 16px 20px; background: #fff8e5; border-bottom: 1px solid #faecd0;">
        <?php if ($isAuthenticated && $user): ?>
            <div style="font-weight: 700; font-size: 15px; color: #0f172a; margin-bottom: 2px;">
                <?= ViewHelper::e($user['name']) ?>
            </div>
            <div style="font-size: 12px; color: #64748b; text-transform: capitalize;">
                <span class="badge bg-danger" style="font-size: 10px; padding: 2px 6px;"><?= ViewHelper::e($user['role'] ?? 'petowner') ?></span>
                <?= ViewHelper::e($user['email']) ?>
            </div>
        <?php else: ?>
            <div style="font-weight: 700; font-size: 14px; color: #0f172a; margin-bottom: 6px;">
                Welcome to PetGuard
            </div>
            <div style="display: flex; gap: 8px;">
                <a href="<?= ViewHelper::url('login') ?>" class="btn-brand" style="padding: 6px 14px; font-size: 12px; border-radius: 20px;">Sign In</a>
                <a href="<?= ViewHelper::url('register/owner') ?>" style="padding: 6px 14px; font-size: 12px; border-radius: 20px; background: #ffffff; border: 1px solid #cbd5e1; color: #334155; text-decoration: none; font-weight: 600;">Register</a>
            </div>
        <?php endif; ?>
    </div>

    <!-- Navigation Links in Drawer -->
    <div style="flex: 1; overflow-y: auto; padding: 12px;">
        <ul style="list-style: none; margin: 0; padding: 0; display: flex; flex-direction: column; gap: 4px;">
            <li><a href="<?= ViewHelper::url('/') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-house text-muted" style="width: 20px;"></i> Home</a></li>
            <li><a href="<?= ViewHelper::url('about') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-circle-info text-muted" style="width: 20px;"></i> About Us</a></li>
            <li><a href="<?= ViewHelper::url('services') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-stethoscope text-muted" style="width: 20px;"></i> Clinical Services</a></li>
            <li><a href="<?= ViewHelper::url('our-products') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-bag-shopping text-muted" style="width: 20px;"></i> Pet Care Shop</a></li>
            <li><a href="<?= ViewHelper::url('wishlist') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-regular fa-heart text-danger" style="width: 20px;"></i> My Saved Wishlist</a></li>
            <li><a href="<?= ViewHelper::url('our-blog') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-newspaper text-muted" style="width: 20px;"></i> Health News</a></li>
            <li><a href="<?= ViewHelper::url('contact') ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #334155; text-decoration: none; font-weight: 600; font-size: 15px;"><i class="fa-solid fa-headset text-muted" style="width: 20px;"></i> Contact & Support</a></li>
            <?php if ($isAuthenticated): ?>
                <li><a href="<?= $dashboardLink ?>" style="display: flex; align-items: center; gap: 12px; padding: 12px 16px; border-radius: 12px; color: #fa441d; background: #fff2ee; text-decoration: none; font-weight: 700; font-size: 15px;"><i class="fa-solid fa-gauge-high text-brand" style="width: 20px;"></i> Portal Dashboard</a></li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- Drawer Footer Actions -->
    <div style="padding: 16px 20px; border-top: 1px solid #f1f5f9; background: #f8fafc; display: flex; align-items: center; justify-content: space-between;">
        <a href="<?= ViewHelper::url('wishlist') ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #334155; text-decoration: none; font-weight: 600; font-size: 13.5px;">
            <i class="fa-regular fa-heart text-danger"></i> Wishlist (<?= ViewHelper::wishlistCount() ?>)
        </a>
        <a href="<?= ViewHelper::url('shop-cart') ?>" style="display: inline-flex; align-items: center; gap: 6px; color: #334155; text-decoration: none; font-weight: 600; font-size: 13.5px;">
            <i class="fa-solid fa-cart-shopping text-brand"></i> Cart (<?= ViewHelper::cartCount() ?>)
        </a>
        <?php if ($isAuthenticated): ?>
            <form action="<?= ViewHelper::url('logout') ?>" method="POST" style="margin: 0;">
                <?= ViewHelper::csrfField() ?>
                <button type="submit" style="background: none; border: none; color: #dc2626; font-weight: 600; font-size: 13.5px; cursor: pointer; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i> Sign Out
                </button>
            </form>
        <?php endif; ?>
    </div>
</div>

<!-- Search Modal -->
<div id="searchModal" style="display: none; position: fixed; inset: 0; background: rgba(15, 23, 42, 0.85); backdrop-filter: blur(6px); -webkit-backdrop-filter: blur(6px); z-index: 999999; align-items: center; justify-content: center; padding: 20px;">
    <div style="width: 100%; max-width: 600px; position: relative;">
        <button type="button" id="closeSearchModalBtn" style="position: absolute; top: -45px; right: 0; background: none; border: none; color: #ffffff; font-size: 28px; cursor: pointer;">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <form action="<?= ViewHelper::url('our-products') ?>" method="GET">
            <div class="input-group input-group-lg shadow-lg rounded-pill overflow-hidden border">
                <input type="text" name="search" class="form-control px-4 border-0" placeholder="Search products, pet health, food..." autofocus style="font-size: 16px;">
                <button class="btn btn-brand px-4 border-0" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const openMobile = document.getElementById('openMobileNavBtn');
    const closeMobile = document.getElementById('closeMobileNavBtn');
    const mobileNav = document.getElementById('mobileNavSidebar');
    const backdrop = document.getElementById('mobileNavBackdrop');

    function showDrawer() {
        if (backdrop && mobileNav) {
            backdrop.style.display = 'block';
            setTimeout(() => { backdrop.style.opacity = '1'; }, 10);
            mobileNav.style.transform = 'translateX(0)';
            document.body.style.overflow = 'hidden';
        }
    }

    function hideDrawer() {
        if (backdrop && mobileNav) {
            backdrop.style.opacity = '0';
            mobileNav.style.transform = 'translateX(-100%)';
            setTimeout(() => {
                backdrop.style.display = 'none';
                document.body.style.overflow = '';
            }, 300);
        }
    }

    if (openMobile) openMobile.addEventListener('click', showDrawer);
    if (closeMobile) closeMobile.addEventListener('click', hideDrawer);
    if (backdrop) backdrop.addEventListener('click', hideDrawer);

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
