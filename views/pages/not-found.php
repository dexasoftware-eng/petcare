<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$role = Auth::role();
$dashboardUrl = ViewHelper::url('portal');
if ($role === 'veterinarian') {
    $dashboardUrl = ViewHelper::url('vet/dashboard');
} elseif ($role === 'shelter') {
    $dashboardUrl = ViewHelper::url('shelter/dashboard');
} elseif ($role === 'vendor') {
    $dashboardUrl = ViewHelper::url('vendor/dashboard');
} elseif ($role === 'admin') {
    $dashboardUrl = ViewHelper::url('admin/dashboard');
} elseif ($role === 'petowner') {
    $dashboardUrl = ViewHelper::url('owner/dashboard');
}
?>

<section class="py-5 text-center d-flex align-items-center justify-content-center" style="background: radial-gradient(circle at 50% 30%, #fff8e5 0%, #ffffff 70%); min-height: 75vh;">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-9 text-center">
                
                <div class="position-relative d-inline-block mb-3">
                    <span style="font-size: 110px; font-weight: 900; line-height: 1; font-family: 'DynaPuff', cursive; background: linear-gradient(135deg, #fa441d 0%, #ff7043 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                        404
                    </span>
                    <div class="position-absolute top-50 start-50 translate-middle opacity-10" style="font-size: 180px; z-index: -1;">🐾</div>
                </div>

                <h2 class="fw-bold mb-2 text-dark" style="font-size: 28px;">Oops! Page Not Found 🐕</h2>
                <p class="text-muted lead mb-4 fs-6" style="max-width: 520px; margin: 0 auto; line-height: 1.6;">
                    The link you followed may be broken, or the page may have been moved or updated within the PetGuard ecosystem.
                </p>

                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <?php if (Auth::check()): ?>
                        <a href="<?= $dashboardUrl ?>" class="btn-brand shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="fa-solid fa-gauge-high"></i>
                            <span>Return to Dashboard</span>
                        </a>
                    <?php endif; ?>

                    <a href="<?= ViewHelper::url() ?>" class="btn-brand shadow-sm d-inline-flex align-items-center gap-2" style="<?= Auth::check() ? 'background: #0f172a;' : '' ?>">
                        <i class="fa-solid fa-house"></i>
                        <span>Return to Homepage</span>
                    </a>

                    <button onclick="window.history.length > 1 ? window.history.back() : window.location.href='<?= ViewHelper::url() ?>'" type="button" class="btn btn-outline-secondary rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                        <i class="fa-solid fa-arrow-left"></i>
                        <span>Go Back</span>
                    </button>
                </div>

                <div class="mt-5 pt-3 border-top border-light-subtle d-flex flex-wrap justify-content-center gap-4 text-muted small">
                    <a href="<?= ViewHelper::url('services') ?>" class="text-muted text-decoration-none hover-brand">Veterinary Services</a>
                    <a href="<?= ViewHelper::url('our-products') ?>" class="text-muted text-decoration-none hover-brand">Pet Store</a>
                    <a href="<?= ViewHelper::url('our-blog') ?>" class="text-muted text-decoration-none hover-brand">Care Articles</a>
                    <a href="<?= ViewHelper::url('contact') ?>" class="text-muted text-decoration-none hover-brand">Help &amp; Support</a>
                </div>

            </div>
        </div>
    </div>
</section>
