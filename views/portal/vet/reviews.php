<?php
use Helpers\ViewHelper;
?>

<div class="vet-reviews-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-star text-warning"></i> Certified Clinical Feedback &amp; Ratings
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Practitioner Ratings &amp; Reviews
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Verified ratings and testimonials submitted by pet parents following completed clinical video consultations and physical visits.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('vet/appointments') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-calendar-check"></i>
                    <span>Manage Appointments</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Overall Rating</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-star"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-warning mb-0">4.95 ★</div>
                <small class="text-muted" style="font-size: 11px;">Out of 5.0 Stars</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">5-Star Ratio</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-thumbs-up"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0">98.2%</div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Excellence Rating</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Verified Reviews</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">148</div>
                <small class="text-muted" style="font-size: 11px;">Verified Pet Parents</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Accreditation</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-award"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-primary mb-0">Top Tier</div>
                <small class="text-muted" style="font-size: 11px;">Accredited Specialist</small>
            </div>
        </div>
    </div>

    <!-- 3. Reviews Breakdown & Stream -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Star Distribution Breakdown (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card text-center p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-warning fw-bold shadow-sm" style="width: 80px; height: 80px; background: #fffbeb; font-size: 36px;">
                    <i class="fa-solid fa-award"></i>
                </div>
                <h1 class="display-5 fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">4.95</h1>
                <div class="text-warning mb-2 fs-5">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star-half-stroke"></i>
                </div>
                <p class="text-muted small mb-3">Based on 148 verified patient consultations</p>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-bold">
                    <i class="fa-solid fa-shield-check me-1"></i> 100% Certified Practitioner
                </span>

                <hr class="my-4">

                <!-- Star Rating Bars -->
                <div class="d-flex flex-column gap-2 text-start small">
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted" style="width: 35px;">5 <i class="fa-solid fa-star text-warning" style="font-size: 10px;"></i></span>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 95%;"></div>
                        </div>
                        <span class="text-dark fw-bold">95%</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted" style="width: 35px;">4 <i class="fa-solid fa-star text-warning" style="font-size: 10px;"></i></span>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 4%;"></div>
                        </div>
                        <span class="text-dark fw-bold">4%</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="text-muted" style="width: 35px;">3 <i class="fa-solid fa-star text-warning" style="font-size: 10px;"></i></span>
                        <div class="progress flex-grow-1" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 1%;"></div>
                        </div>
                        <span class="text-dark fw-bold">1%</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right: Verified Review Comments Stream (col-lg-8) -->
        <div class="col-12 col-lg-8">
            <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden">
                <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-comments text-brand me-2"></i> Verified Pet Parent Feedback
                        </h4>
                        <p class="text-muted small m-0 mt-1">Real feedback submitted after verified video and physical consultations.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">Verified Reviews</span>
                </div>

                <div class="admin-card-body p-0">
                    <div class="list-group list-group-flush">
                        
                        <!-- Review Item 1 -->
                        <div class="list-group-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                        A
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block">Alex Morgan (Bella's Parent)</strong>
                                        <div class="text-warning small" style="font-size: 12px;">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-light text-muted border">2 days ago</span>
                            </div>
                            <p class="small text-secondary m-0" style="line-height: 1.6; font-size: 13.5px;">
                                "Extremely thorough during our HD video consultation. Bella’s dermatology allergies cleared up rapidly after following the digital prescription plan. Highly recommended!"
                            </p>
                        </div>

                        <!-- Review Item 2 -->
                        <div class="list-group-item p-4 border-bottom">
                            <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%); color: #991b1b; font-size: 16px;">
                                        D
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block">David Miller (Max's Parent)</strong>
                                        <div class="text-warning small" style="font-size: 12px;">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-light text-muted border">1 week ago</span>
                            </div>
                            <p class="small text-secondary m-0" style="line-height: 1.6; font-size: 13.5px;">
                                "Outstanding veterinary care and quick availability booking. The electronic prescription was available immediately in our digital passport."
                            </p>
                        </div>

                        <!-- Review Item 3 -->
                        <div class="list-group-item p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2 flex-wrap gap-2">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%); color: #065f46; font-size: 16px;">
                                        S
                                    </div>
                                    <div>
                                        <strong class="text-dark d-block">Sarah Jenkins (Oliver's Parent)</strong>
                                        <div class="text-warning small" style="font-size: 12px;">
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                            <i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                </div>
                                <span class="badge bg-light text-muted border">2 weeks ago</span>
                            </div>
                            <p class="small text-secondary m-0" style="line-height: 1.6; font-size: 13.5px;">
                                "The seamless WebRTC audio/video calling directly in the browser made triage so fast when Oliver fell sick on the weekend. Exceptional bedside manner."
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
