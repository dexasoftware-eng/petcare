<?php
use Helpers\ViewHelper;

$interviews = $interviews ?? [];
$totalInterviews = count($interviews);
?>

<style>
@media (max-width: 767.98px) {
    .interviews-desktop-table { display: none !important; }
    .interviews-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .interviews-desktop-table { display: block !important; }
    .interviews-mobile-grid { display: none !important; }
}
</style>

<div class="shelter-interviews-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                <i class="fa-solid fa-video text-warning"></i>
                <span>Adoption Video Assessment</span>
                <span class="text-white-50">&middot;</span>
                <span class="font-monospace text-warning"><?= $totalInterviews ?> Interviews</span>
            </div>
            <h2 class="portal-hero-title">Adoption Video Interviews 🎥</h2>
            <p class="portal-hero-subtitle">
                Host virtual home checks and face-to-face video assessments with prospective adoptive families via WebRTC.
            </p>
        </div>
        <div class="d-flex flex-wrap gap-2">
            <a href="<?= ViewHelper::url('shelter/dashboard') ?>" class="btn btn-admin-secondary">
                <i class="fa-solid fa-gauge-high"></i>
                <span>Sanctuary Portal</span>
            </a>
            <a href="<?= ViewHelper::url('shelter/applications') ?>" class="btn btn-admin-primary">
                <i class="fa-solid fa-file-signature"></i>
                <span>All Applications</span>
            </a>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Active Queue</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalInterviews ?></div>
                <small class="text-muted" style="font-size: 11px;">Candidate Interviews</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Verification</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-shield-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0">100%</div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Identity Screened</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Virtual Home Check</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-house-chimney-user"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">Live HD</div>
                <small class="text-muted" style="font-size: 11px;">Real-Time Video</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Outcome Rate</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-primary mb-0">92%</div>
                <small class="text-muted" style="font-size: 11px;">Forever Placements</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Interviews Content -->
    <?php if (empty($interviews)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-solid fa-video-slash"></i>
            </div>
            <h5 class="fw-bold text-dark">No Active Interviews Queued</h5>
            <p class="small text-muted mb-3" style="max-width: 480px; margin: 0 auto;">When you approve an application for virtual assessment or change its status to "Schedule Video Interview", candidates will appear here.</p>
            <a href="<?= ViewHelper::url('shelter/applications') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm">
                <i class="fa-solid fa-file-signature me-1"></i> Review Applications
            </a>
        </div>
    <?php else: ?>

        <!-- A. Desktop Data Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden interviews-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Eligible Interview Candidates (<?= $totalInterviews ?> Queued)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Ready for Assessment</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 220px;">Applicant Profile</th>
                            <th class="py-3" style="min-width: 200px;">Target Rescue Animal</th>
                            <th class="py-3" style="min-width: 170px;">Living Arrangement</th>
                            <th class="py-3" style="min-width: 140px;">Submitted Date</th>
                            <th class="text-end pe-4 py-3" style="min-width: 160px;">Launch Call</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($interviews as $iv): ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                            <?= strtoupper(substr($iv['applicant_name'] ?? 'A', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($iv['applicant_name']) ?></div>
                                            <small class="text-muted"><?= ViewHelper::e($iv['applicant_email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($iv['pet_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($iv['species']) ?> &middot; <?= ViewHelper::e($iv['breed']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                        <i class="fa-solid fa-house text-brand me-1"></i><?= ViewHelper::e($iv['living_arrangement'] ?? 'House with Yard') ?>
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    <?= date('M d, Y', strtotime($iv['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <button type="button" class="btn btn-sm btn-success rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2" onclick="PetGuardCall.initiateCall(<?= (int)$iv['applicant_id'] ?>, 'video', 'adoption', <?= (int)$iv['id'] ?>)">
                                        <i class="fa-solid fa-video"></i>
                                        <span>Start Video Call</span>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile Card Grid (<768px) -->
        <div class="row g-3 interviews-mobile-grid mb-4">
            <?php foreach ($interviews as $iv): ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex align-items-center gap-3 mb-2 pb-2 border-bottom">
                                <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                    <?= strtoupper(substr($iv['applicant_name'] ?? 'A', 0, 1)) ?>
                                </div>
                                <div class="min-w-0 flex-grow-1">
                                    <div class="fw-bold text-dark text-truncate" style="font-size: 14.5px;"><?= ViewHelper::e($iv['applicant_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($iv['applicant_email']) ?></small>
                                </div>
                            </div>

                            <div class="mb-3 small">
                                <div class="text-dark mb-1">
                                    <i class="fa-solid fa-paw text-brand me-1"></i><strong>Applying For:</strong> <?= ViewHelper::e($iv['pet_name']) ?> (<?= ViewHelper::e($iv['species']) ?>)
                                </div>
                                <div class="text-muted">
                                    <i class="fa-solid fa-house text-brand me-1"></i><?= ViewHelper::e($iv['living_arrangement'] ?? 'House with Yard') ?>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-top">
                            <button type="button" class="btn btn-sm btn-success rounded-pill w-100 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-2" onclick="PetGuardCall.initiateCall(<?= (int)$iv['applicant_id'] ?>, 'video', 'adoption', <?= (int)$iv['id'] ?>)">
                                <i class="fa-solid fa-video"></i>
                                <span>Start Video Call</span>
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
