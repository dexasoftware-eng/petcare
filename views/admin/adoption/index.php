<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Shelter Adoption Hub</h2>
        <p class="admin-page-subtitle">Rescue listings, lifestyle suitability vetting, and adoption application workflow.</p>
    </div>
</div>

<!-- Adoption Stats Grid -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Active Listings</span>
                <div class="stat-card-icon icon-orange"><i class="fa-solid fa-paw"></i></div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['totalListings']) ?></div>
            <div class="stat-card-footer text-muted"><?= $stats['available'] ?> currently available</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Applications Under Review</span>
                <div class="stat-card-icon icon-amber"><i class="fa-solid fa-clock"></i></div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['pendingAdoptions']) ?></div>
            <div class="stat-card-footer"><span class="badge bg-warning text-dark">Requires Triage</span></div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Successful Adoptions</span>
                <div class="stat-card-icon icon-green"><i class="fa-solid fa-heart"></i></div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['totalAdopted']) ?></div>
            <div class="stat-card-footer text-success fw-bold">Permanent Happy Homes</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Applications</span>
                <div class="stat-card-icon icon-blue"><i class="fa-solid fa-file-signature"></i></div>
            </div>
            <div class="stat-card-value"><?= count($applications) ?></div>
            <div class="stat-card-footer text-muted">All time submissions</div>
        </div>
    </div>
</div>

<!-- Adoption Applications Pipeline -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-file-signature text-brand"></i> Incoming Adoption Applications (<?= count($applications) ?>)</h3>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($applications)): ?>
            <div class="p-4 text-center text-muted">No adoption applications in the pipeline.</div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Applicant</th>
                            <th>Adoptable Pet</th>
                            <th>Living Space</th>
                            <th>Experience</th>
                            <th>Application Status</th>
                            <th>Submitted</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($applications as $app): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($app['applicant_email']) ?> · <?= ViewHelper::e($app['applicant_phone']) ?></small>
                                </td>
                                <td>
                                    <span class="fw-bold text-brand"><?= ViewHelper::e($app['pet_name']) ?></span>
                                    <small class="text-muted d-block"><?= ViewHelper::e($app['pet_species']) ?> (<?= ViewHelper::e($app['pet_breed']) ?>)</small>
                                </td>
                                <td><?= ViewHelper::e($app['living_arrangement']) ?></td>
                                <td><?= ViewHelper::e($app['experience_level']) ?></td>
                                <td><span class="badge-status status-<?= $app['status'] ?>"><?= ViewHelper::e($app['status']) ?></span></td>
                                <td><small class="text-muted"><?= date('M d, Y', strtotime($app['created_at'])) ?></small></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#appModal<?= $app['id'] ?>">Review</button>

                                    <!-- Application Triage Modal -->
                                    <div class="modal fade" id="appModal<?= $app['id'] ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold">Adoption Application #<?= $app['id'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="<?= ViewHelper::url("admin/adoption/applications/{$app['id']}/status") ?>" method="POST">
                                                    <?= ViewHelper::csrfField() ?>
                                                    <div class="modal-body py-0">
                                                        <div class="p-3 bg-light rounded-3 mb-3 small">
                                                            <div><strong>Applicant:</strong> <?= ViewHelper::e($app['applicant_name']) ?> (<?= ViewHelper::e($app['applicant_email']) ?>)</div>
                                                            <div><strong>Target Pet:</strong> <?= ViewHelper::e($app['pet_name']) ?></div>
                                                            <div><strong>Statement:</strong> <em>"<?= ViewHelper::e($app['message'] ?: 'No personal statement provided.') ?>"</em></div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Update Pipeline Status</label>
                                                            <select name="status" class="form-select rounded-3">
                                                                <option value="submitted" <?= $app['status'] === 'submitted' ? 'selected' : '' ?>>Submitted</option>
                                                                <option value="under_review" <?= $app['status'] === 'under_review' ? 'selected' : '' ?>>Under Review</option>
                                                                <option value="interview" <?= $app['status'] === 'interview' ? 'selected' : '' ?>>Schedule Interview</option>
                                                                <option value="approved" <?= $app['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                                                                <option value="rejected" <?= $app['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                                                                <option value="adopted" <?= $app['status'] === 'adopted' ? 'selected' : '' ?>>Finalized Adopted</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Reviewer Internal Notes</label>
                                                            <textarea name="reviewer_notes" class="form-control rounded-3" rows="3" placeholder="Notes on home visit, screening, or interview..."><?= ViewHelper::e($app['reviewer_notes'] ?? '') ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-brand rounded-pill px-4 fw-bold">Save Pipeline Status</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
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
