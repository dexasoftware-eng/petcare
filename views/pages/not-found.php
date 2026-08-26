<?php
use Helpers\ViewHelper;
?>
<section class="py-5 text-center" style="background-color: #fff8e5; min-height: 70vh; display: flex; align-items: center;">
    <div class="container py-5">
        <h1 style="font-size: 100px; font-weight: 900; color: #fa441d; margin: 0; line-height: 1;">404</h1>
        <h2 class="fw-bold my-3 text-dark">Oops! Page Not Found</h2>
        <p class="text-muted lead mb-4" style="max-width: 500px; margin: 0 auto;">
            The page you are looking for does not exist or has been moved within the PetGuard website.
        </p>
        <a href="<?= ViewHelper::url() ?>" class="btn-brand">
            <i class="fa-solid fa-house me-2"></i> Return to Homepage
        </a>
    </div>
</section>
