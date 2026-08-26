<?php
use Helpers\ViewHelper;
$skills = !empty($member['skills']) ? json_decode($member['skills'], true) : [];
?>
<section class="banner py-5" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/background.png') ?>');">
    <div class="container py-4">
        <h1 class="fw-bold display-5 mb-2"><?= ViewHelper::e($member['name']) ?></h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= ViewHelper::url() ?>" class="text-brand text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="<?= ViewHelper::url('about') ?>" class="text-brand text-decoration-none">Team</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= ViewHelper::e($member['name']) ?></li>
            </ol>
        </nav>
    </div>
</section>

<section class="py-5" style="background-color: #fff;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center">
                <img src="<?= ViewHelper::asset($member['img']) ?>" alt="<?= ViewHelper::e($member['name']) ?>" class="img-fluid rounded-4 shadow-sm" style="max-height: 420px; object-fit: cover;">
            </div>
            <div class="col-lg-7">
                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold mb-2"><?= ViewHelper::e($member['role']) ?></span>
                <h2 class="fw-bold mb-3"><?= ViewHelper::e($member['name']) ?></h2>
                <p class="text-muted leading-relaxed mb-4"><?= ViewHelper::e($member['bio']) ?></p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small d-block">Direct Contact Phone:</span>
                            <strong><?= ViewHelper::e($member['phone'] ?? '+1-555-019-2834') ?></strong>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="p-3 rounded-3 bg-light border">
                            <span class="text-muted small d-block">Official Email:</span>
                            <strong><?= ViewHelper::e($member['email'] ?? 'staff@petguard.com') ?></strong>
                        </div>
                    </div>
                </div>

                <?php if (!empty($skills)): ?>
                    <h5 class="fw-bold mb-3">Core Clinical Competencies:</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($skills as $sk): ?>
                            <div>
                                <div class="d-flex justify-content-between small fw-bold mb-1">
                                    <span><?= ViewHelper::e($sk['label']) ?></span>
                                    <span><?= $sk['percentage'] ?>%</span>
                                </div>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $sk['percentage'] ?>%"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
