<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-video text-brand me-2"></i> Adoption Video Interviews</h2>
        <p class="admin-page-subtitle">Schedule, coordinate, and host virtual home checks and adoption interviews with prospective parents.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list-check text-brand me-2"></i> Eligible Interview Candidates</h3>
        <span class="badge bg-light text-dark border"><?= count($interviews ?? []) ?> In Queue</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($interviews)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-video-slash fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No active interviews queued</h5>
                <p class="small text-muted">When you set an application status to "Schedule Video Interview", candidates will appear here.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Applicant</th>
                            <th>Target Animal</th>
                            <th>Living Arrangement</th>
                            <th>Submitted Date</th>
                            <th class="text-end pe-4">Launch Interview</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($interviews as $iv): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($iv['applicant_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($iv['applicant_email']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($iv['pet_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($iv['species']) ?> &middot; <?= ViewHelper::e($iv['breed']) ?></div>
                                </td>
                                <td class="small text-muted">
                                    <?= ViewHelper::e($iv['living_arrangement'] ?? 'House with Yard') ?>
                                </td>
                                <td class="small text-muted">
                                    <?= date('M d, Y', strtotime($iv['created_at'])) ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-success rounded-pill px-4" onclick="PetGuardCall.initiateCall(<?= (int)$iv['applicant_id'] ?>, 'video', 'adoption', <?= (int)$iv['id'] ?>)">
                                        <i class="fa-solid fa-video me-1"></i> Start Video Call
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
