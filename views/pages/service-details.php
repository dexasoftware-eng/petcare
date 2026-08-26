<?php
use Helpers\ViewHelper;
$features = !empty($service['features']) ? json_decode($service['features'], true) : [];
?>
<section class="banner py-5" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/background.png') ?>');">
    <div class="container py-4">
        <h1 class="fw-bold display-5 mb-2"><?= ViewHelper::e($service['title']) ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= ViewHelper::url() ?>" class="text-brand text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= ViewHelper::url('services') ?>" class="text-brand text-decoration-none">Services</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ViewHelper::e($service['title']) ?></li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5" style="background-color: #fff;">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Main Details -->
            <div class="col-lg-8">
                <img src="<?= ViewHelper::asset($service['banner_img'] ?? 'img/we-provide-1.jpg') ?>" alt="<?= ViewHelper::e($service['title']) ?>" class="img-fluid rounded-4 shadow-sm mb-4 w-100" style="max-height: 400px; object-fit: cover;">
                <h3 class="fw-bold mb-3"><?= ViewHelper::e($service['title']) ?></h3>
                <p class="text-muted leading-relaxed mb-4"><?= nl2br(ViewHelper::e($service['full_desc'])) ?></p>

                <?php if (!empty($features)): ?>
                    <h5 class="fw-bold mb-3">Service Inclusions & Protocols:</h5>
                    <div class="row g-3 mb-4">
                        <?php foreach ($features as $f): ?>
                            <div class="col-md-6">
                                <div class="d-flex align-items-center gap-2 p-3 rounded-3" style="background-color: #f8fafc; border: 1px solid #e2e8f0;">
                                    <i class="fa-solid fa-circle-check text-success fs-5"></i>
                                    <span class="fw-semibold text-dark"><?= ViewHelper::e($f) ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="p-4 rounded-4 bg-light d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div>
                        <span class="text-muted small d-block">Starting Consultation Fee:</span>
                        <h4 class="fw-bold text-brand m-0"><?= ViewHelper::e($service['price']) ?></h4>
                    </div>
                    <a href="<?= ViewHelper::url('register/owner') ?>" class="btn-brand">
                        <i class="fa-solid fa-calendar-check me-2"></i> Book Appointment
                    </a>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card p-4 rounded-4 border-0 shadow-sm mb-4" style="background-color: #fdfbf7;">
                    <h5 class="fw-bold mb-3">All Services</h5>
                    <ul class="list-unstyled d-flex flex-column gap-2 m-0">
                        <?php foreach ($allServices as $s): ?>
                            <li>
                                <a href="<?= ViewHelper::url('service-details/' . $s['slug']) ?>" class="d-flex justify-content-between align-items-center p-2 rounded-2 text-decoration-none <?= $s['id'] === $service['id'] ? 'fw-bold text-brand bg-white shadow-sm' : 'text-dark hover-underline' ?>">
                                    <span><?= ViewHelper::e($s['title']) ?></span>
                                    <i class="fa-solid fa-chevron-right small text-muted"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="card p-4 rounded-4 border-0 text-white" style="background-color: #1e293b;">
                    <h5 class="fw-bold mb-2">Emergency Pet Care?</h5>
                    <p class="small text-white-50 mb-3">Our 24/7 hotline is always active to coordinate urgent triage.</p>
                    <a href="tel:+18003877453" class="btn btn-danger w-100 rounded-pill fw-bold py-2">
                        <i class="fa-solid fa-phone me-2"></i> +1 (800) FUR-SHLD
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
