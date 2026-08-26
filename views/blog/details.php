<?php
use Helpers\ViewHelper;
?>
<!-- 1. Banner Section -->
<section class="banner" style="background-color: #fff8e5; background-image: url('<?= ViewHelper::asset('img/banner.png') ?>');">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="banner-text">
                    <h2><?= ViewHelper::e($blog['title']) ?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('/') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="<?= ViewHelper::url('our-blog') ?>">Blog</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ViewHelper::e($blog['title']) ?></li>
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

<section class="py-5" style="background-color: #fff;">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Article Body -->
            <div class="col-lg-8">
                <img src="<?= ViewHelper::asset($blog['img']) ?>" alt="<?= ViewHelper::e($blog['title']) ?>" class="img-fluid rounded-4 shadow-sm w-100 mb-4" style="max-height: 440px; object-fit: cover;">

                <div class="d-flex align-items-center gap-3 mb-4 text-muted small pb-3 border-bottom">
                    <span class="badge bg-warning text-dark"><?= ViewHelper::e($blog['category']) ?></span>
                    <span><i class="fa-solid fa-user-doctor me-1 text-brand"></i> <?= ViewHelper::e($blog['author']) ?></span>
                    <span><i class="fa-regular fa-calendar me-1"></i> <?= $blog['day'] ?> <?= $blog['month_year'] ?></span>
                    <span><i class="fa-solid fa-eye me-1"></i> <?= $blog['views'] ?? 1 ?> views</span>
                </div>

                <div class="article-content leading-relaxed mb-5" style="font-size: 17px; line-height: 1.8;">
                    <?= $blog['content'] ?>
                </div>

                <!-- Comments Section -->
                <div class="pt-5 border-top">
                    <h4 class="fw-bold mb-4">Comments (<?= count($blog['comments'] ?? []) ?>)</h4>

                    <?php if (!empty($blog['comments'])): ?>
                        <div class="d-flex flex-column gap-3 mb-5">
                            <?php foreach ($blog['comments'] as $com): ?>
                                <div class="p-3 rounded-3 bg-light border d-flex gap-3 align-items-start">
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center fw-bold" style="width: 45px; height: 45px; flex-shrink: 0;">
                                        <?= strtoupper(substr($com['name'], 0, 1)) ?>
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <h6 class="fw-bold m-0"><?= ViewHelper::e($com['name']) ?></h6>
                                            <span class="text-muted small"><?= date('M d, Y', strtotime($com['created_at'])) ?></span>
                                        </div>
                                        <p class="m-0 text-muted small"><?= nl2br(ViewHelper::e($com['text'])) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Add Comment Form -->
                    <div class="p-4 rounded-4 shadow-sm" style="background-color: #fdfbf7;">
                        <h5 class="fw-bold mb-3">Leave a Thought</h5>
                        <form action="<?= ViewHelper::url('blog/' . $blog['slug'] . '/comment') ?>" method="POST">
                            <?= ViewHelper::csrfField() ?>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Your Name *</label>
                                    <input type="text" name="name" class="form-control" required placeholder="John Doe">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Your Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="john@example.com">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Comment *</label>
                                    <textarea name="text" rows="4" class="form-control" required placeholder="Write your feedback or clinical inquiry..."></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-brand px-4 py-2 fw-bold">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="card p-4 rounded-4 border-0 shadow-sm mb-4" style="background-color: #fdfbf7;">
                    <h5 class="fw-bold mb-3">Recent Posts</h5>
                    <div class="d-flex flex-column gap-3">
                        <?php foreach ($recentBlogs as $rb): ?>
                            <div class="d-flex gap-3 align-items-center">
                                <img src="<?= ViewHelper::asset($rb['img']) ?>" alt="<?= ViewHelper::e($rb['title']) ?>" class="rounded-3" style="width: 70px; height: 70px; object-fit: cover;">
                                <div>
                                    <h6 class="fw-bold m-0" style="font-size: 14px;">
                                        <a href="<?= ViewHelper::url('blog/' . $rb['slug']) ?>" class="text-dark text-decoration-none hover-underline"><?= ViewHelper::e($rb['title']) ?></a>
                                    </h6>
                                    <span class="text-muted small"><?= $rb['day'] ?> <?= $rb['month_year'] ?></span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
