<?php
use Helpers\ViewHelper;

$applications = $applications ?? [];
$totalApps = count($applications);
$reviewCount = 0;
$interviewCount = 0;
$approvedCount = 0;

foreach ($applications as $app) {
    $st = $app['status'] ?? 'submitted';
    if ($st === 'under_review' || $st === 'submitted') $reviewCount++;
    elseif ($st === 'interview') $interviewCount++;
    elseif ($st === 'approved' || $st === 'adopted') $approvedCount++;
}
?>

<style>
@media (max-width: 767.98px) {
    .apps-desktop-table { display: none !important; }
    .apps-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .apps-desktop-table { display: block !important; }
    .apps-mobile-grid { display: none !important; }
}
</style>

<div class="shelter-applications-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-file-signature text-warning"></i> Rescue Adoption Pipeline
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Adoption Applications &amp; Placement
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Screen prospective pet parent questionnaires, verify home setups, launch virtual interviews, and approve forever home adoptions.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-plus"></i>
                    <span>List Rescue Animal</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Total Applications</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalApps ?></div>
                <small class="text-muted" style="font-size: 11px;">Parent Inquiries</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Under Review</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold <?= $reviewCount > 0 ? 'text-warning' : 'text-dark' ?> mb-0"><?= $reviewCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Awaiting Screening</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Interviews</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-primary mb-0"><?= $interviewCount ?></div>
                <small class="text-muted" style="font-size: 11px;">Virtual Home Checks</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Approved / Adopted</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $approvedCount ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Placed in Homes</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Applications Content -->
    <?php if (empty($applications)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-regular fa-folder-open"></i>
            </div>
            <h5 class="fw-bold text-dark">No Applications Found</h5>
            <p class="small text-muted mb-0" style="max-width: 480px; margin: 0 auto;">When prospective pet parents submit adoption questionnaires for your rescue animals, their profiles will appear here.</p>
        </div>
    <?php else: ?>

        <!-- A. Desktop High-Density Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden apps-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-inbox"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Submitted Adoption Questionnaires (<?= $totalApps ?> Total)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Screening Hub</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 200px;">Applicant Profile</th>
                            <th class="py-3" style="min-width: 180px;">Target Animal</th>
                            <th class="py-3" style="min-width: 150px;">Living Setup</th>
                            <th class="py-3" style="min-width: 130px;">Experience</th>
                            <th class="py-3" style="min-width: 130px;">Status</th>
                            <th class="py-3" style="min-width: 120px;">Submitted</th>
                            <th class="text-end pe-4 py-3" style="min-width: 180px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $app): 
                            $statusMap = [
                                'submitted' => 'bg-warning-subtle text-warning border-warning-subtle',
                                'under_review' => 'bg-info-subtle text-info border-info-subtle',
                                'interview' => 'bg-purple-subtle text-purple border-purple-subtle',
                                'approved' => 'bg-success-subtle text-success border-success-subtle',
                                'adopted' => 'bg-success-subtle text-success border-success-subtle',
                                'rejected' => 'bg-danger-subtle text-danger border-danger-subtle'
                            ];
                        ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="rounded-circle border d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 44px; height: 44px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); color: #1e40af; font-size: 16px;">
                                            <?= strtoupper(substr($app['applicant_name'] ?? 'A', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                            <small class="text-muted"><?= ViewHelper::e($app['applicant_email']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($app['pet_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($app['species'] ?? 'Pet') ?> &middot; <?= ViewHelper::e($app['breed'] ?? '') ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill">
                                        <?= ViewHelper::e($app['living_arrangement'] ?? 'House') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="small text-muted"><?= ViewHelper::e($app['experience_level'] ?? 'Experienced') ?></span>
                                </td>
                                <td>
                                    <span class="badge <?= $statusMap[$app['status']] ?? 'bg-light text-dark border' ?> rounded-pill px-2 py-1 text-uppercase fw-bold" style="font-size: 10px;">
                                        <?= str_replace('_', ' ', ViewHelper::e($app['status'])) ?>
                                    </span>
                                </td>
                                <td class="text-muted small">
                                    <?= date('M d, Y', strtotime($app['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3 fw-bold shadow-sm d-inline-flex align-items-center gap-1" onclick="PetGuardCall.initiateCall(<?= (int)$app['applicant_id'] ?>, 'video', 'adoption', <?= (int)$app['id'] ?>)">
                                            <i class="fa-solid fa-video"></i>
                                            <span>Interview</span>
                                        </button>
                                        <a href="<?= ViewHelper::url('shelter/applications/' . $app['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold">
                                            Review
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile Card Grid (<768px) -->
        <div class="row g-3 apps-mobile-grid mb-4">
            <?php foreach ($applications as $app): 
                $statusClass = ($app['status'] === 'approved' || $app['status'] === 'adopted') ? 'bg-success-subtle text-success border-success-subtle' : (($app['status'] === 'interview') ? 'bg-purple-subtle text-purple border-purple-subtle' : 'bg-warning-subtle text-warning border-warning-subtle');
            ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2 pb-2 border-bottom">
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 14.5px;"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($app['applicant_email']) ?></small>
                                </div>
                                <span class="badge <?= $statusClass ?> rounded-pill px-2 py-1 text-uppercase fw-bold" style="font-size: 9.5px;">
                                    <?= str_replace('_', ' ', ViewHelper::e($app['status'])) ?>
                                </span>
                            </div>

                            <div class="mb-3 small">
                                <div class="text-dark mb-1">
                                    <i class="fa-solid fa-paw text-brand me-1"></i><strong>Applying For:</strong> <?= ViewHelper::e($app['pet_name']) ?>
                                </div>
                                <div class="text-muted mb-1">
                                    <i class="fa-solid fa-house text-brand me-1"></i><strong>Home:</strong> <?= ViewHelper::e($app['living_arrangement'] ?? 'House') ?>
                                </div>
                                <div class="text-muted">
                                    <i class="fa-regular fa-clock text-brand me-1"></i><?= date('M d, Y', strtotime($app['created_at'])) ?>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-success rounded-pill flex-grow-1 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-1" onclick="PetGuardCall.initiateCall(<?= (int)$app['applicant_id'] ?>, 'video', 'adoption', <?= (int)$app['id'] ?>)">
                                <i class="fa-solid fa-video"></i> Interview
                            </button>
                            <a href="<?= ViewHelper::url('shelter/applications/' . $app['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold py-2">
                                Review
                            </a>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>
