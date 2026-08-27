<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-file-signature text-brand me-2"></i> Adoption Applications Workflow</h2>
        <p class="admin-page-subtitle">Review questionnaires, schedule video interviews, and finalize forever home adoptions.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-inbox text-brand me-2"></i> All Adoption Applications</h3>
        <span class="badge bg-light text-dark border"><?= count($applications ?? []) ?> Total Applications</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($applications)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-regular fa-folder-open fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No applications currently</h5>
                <p class="small text-muted">When prospective adopters submit questionnaires, they will appear here.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Applicant</th>
                            <th>Target Animal</th>
                            <th>Living Setup</th>
                            <th>Experience</th>
                            <th>Workflow Status</th>
                            <th>Submitted</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $app): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($app['applicant_email']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($app['pet_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($app['species'] ?? 'Pet') ?> &middot; <?= ViewHelper::e($app['breed'] ?? '') ?></div>
                                </td>
                                <td class="small text-muted">
                                    <?= ViewHelper::e($app['living_arrangement'] ?? 'House with Yard') ?>
                                </td>
                                <td class="small text-muted">
                                    <?= ViewHelper::e($app['experience_level'] ?? 'Experienced') ?>
                                </td>
                                <td>
                                    <?php
                                    $statusMap = [
                                        'submitted' => 'badge-amber',
                                        'under_review' => 'badge-blue',
                                        'interview' => 'badge-purple',
                                        'approved' => 'badge-success',
                                        'adopted' => 'badge-success',
                                        'rejected' => 'badge-danger'
                                    ];
                                    ?>
                                    <span class="admin-badge <?= $statusMap[$app['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($app['status']) ?>
                                    </span>
                                </td>
                                <td class="small text-muted">
                                    <?= date('M d, Y', strtotime($app['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <button type="button" class="btn btn-sm btn-success rounded-pill px-3" onclick="PetGuardCall.initiateCall(<?= (int)$app['applicant_id'] ?>, 'video', 'adoption', <?= (int)$app['id'] ?>)">
                                            <i class="fa-solid fa-video me-1"></i> Interview
                                        </button>
                                        <a href="<?= ViewHelper::url('shelter/applications/' . $app['id']) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            Review
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
