<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-file-contract text-brand me-2"></i> Review Application #<?= $app['id'] ?></h2>
        <p class="admin-page-subtitle">Applicant: <?= ViewHelper::e($applicant['name']) ?> &middot; Animal: <?= ViewHelper::e($pet['name']) ?></p>
    </div>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success rounded-pill px-4" onclick="PetGuardCall.initiateCall(<?= (int)$applicant['id'] ?>, 'video', 'adoption', <?= (int)$app['id'] ?>)">
            <i class="fa-solid fa-video me-1"></i> Launch Video Interview
        </button>
        <a href="<?= ViewHelper::url('portal/messages?target=' . $applicant['id']) ?>" class="btn btn-outline-secondary rounded-pill px-3">
            <i class="fa-solid fa-comments me-1"></i> Chat
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Applicant & Pet Summary -->
    <div class="col-lg-4">
        <!-- Target Animal -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Requested Animal</h3>
            </div>
            <div class="admin-card-body text-center">
                <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-4 border mb-3" style="width: 90px; height: 90px; object-fit: cover;">
                <h4 class="fw-bold mb-1"><?= ViewHelper::e($pet['name']) ?></h4>
                <p class="text-muted small mb-3"><?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['species']) ?>)</p>
                <div class="small text-start border-top pt-2">
                    <div><strong>Gender:</strong> <?= ViewHelper::e($pet['gender']) ?></div>
                    <div><strong>Age:</strong> <?= ViewHelper::e($pet['age']) ?></div>
                    <div><strong>Vaccines:</strong> <span class="text-success"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to date') ?></span></div>
                </div>
            </div>
        </div>

        <!-- Applicant Info -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-user me-2"></i> Applicant Contact</h3>
            </div>
            <div class="admin-card-body small">
                <div class="fw-bold text-dark fs-6 mb-1"><?= ViewHelper::e($applicant['name']) ?></div>
                <div class="text-muted mb-2"><i class="fa-solid fa-envelope me-1"></i> <?= ViewHelper::e($applicant['email']) ?></div>
                <div class="text-muted mb-2"><i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($applicant['phone'] ?? 'N/A') ?></div>
                <div class="text-muted"><i class="fa-solid fa-location-dot me-1"></i> <?= ViewHelper::e($applicant['address']) ?></div>
            </div>
        </div>
    </div>

    <!-- Right Column: Questionnaire Responses & Decision Workflow -->
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-clipboard-question text-brand me-2"></i> Adoption Questionnaire Responses</h3>
            </div>
            <div class="admin-card-body">
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="small text-muted d-block">Living Arrangement</label>
                        <div class="fw-bold text-dark p-2 bg-light rounded-3"><?= ViewHelper::e($app['living_arrangement'] ?? 'Single Family Home') ?></div>
                    </div>
                    <div class="col-md-6">
                        <label class="small text-muted d-block">Pet Ownership Experience</label>
                        <div class="fw-bold text-dark p-2 bg-light rounded-3"><?= ViewHelper::e($app['experience_level'] ?? 'Experienced') ?></div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="small text-muted d-block">Has Other Pets in Household?</label>
                    <div class="fw-bold text-dark p-2 bg-light rounded-3"><?= !empty($app['has_other_pets']) ? 'Yes, currently has other pets' : 'No other pets' ?></div>
                </div>

                <div class="mb-0">
                    <label class="small text-muted d-block">Applicant Personal Statement / Motivation</label>
                    <div class="p-3 bg-light rounded-3 small text-secondary"><?= nl2br(ViewHelper::e($app['message'] ?: 'We would love to provide a caring and active home for this pet.')) ?></div>
                </div>
            </div>
        </div>

        <!-- Decision Workflow Form -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-gavel text-brand me-2"></i> Shelter Reviewer Decision & Status</h3>
            </div>
            <div class="admin-card-body">
                <form id="adoptionDecisionForm" action="<?= ViewHelper::url('shelter/applications/' . $app['id'] . '/status') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Update Application Workflow State</label>
                        <select name="status" class="form-select form-select-lg" required>
                            <option value="submitted" <?= $app['status'] === 'submitted' ? 'selected' : '' ?>>1. Submitted / New</option>
                            <option value="under_review" <?= $app['status'] === 'under_review' ? 'selected' : '' ?>>2. Under Review</option>
                            <option value="interview" <?= $app['status'] === 'interview' ? 'selected' : '' ?>>3. Schedule Video Interview</option>
                            <option value="approved" <?= $app['status'] === 'approved' ? 'selected' : '' ?>>4. Approved (Eligible for Final Placement)</option>
                            <option value="adopted" <?= $app['status'] === 'adopted' ? 'selected' : '' ?>>5. Adoption Finalized (Placed in Forever Home)</option>
                            <option value="rejected" <?= $app['status'] === 'rejected' ? 'selected' : '' ?>>6. Rejected / Incompatible</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Reviewer Internal Notes & Decision Feedback</label>
                        <textarea name="reviewer_notes" class="form-control" rows="3" placeholder="Add interview feedback, landlord verification check, yard safety verification..."><?= ViewHelper::e($app['reviewer_notes'] ?? '') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                            <i class="fa-solid fa-check me-1"></i> Save Application Decision
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#adoptionDecisionForm', {
        loadingText: 'Saving Decision...',
        reload: true
    });
});
</script>
