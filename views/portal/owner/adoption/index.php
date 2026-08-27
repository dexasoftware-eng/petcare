<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-heart text-warning"></i>
            <span>Sanctuary Adoption Network</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= count($myApplications ?? []) ?> Applications</span>
        </div>
        <h2 class="portal-hero-title">Shelter Adoption Hub 🐾</h2>
        <p class="portal-hero-subtitle">Browse rescue animals available for adoption, submit adoption requests, and track status.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('portal/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>My Portal</span>
        </a>
    </div>
</div>

<!-- My Applications Tracker -->
<?php if (!empty($myApplications)): ?>
    <div class="admin-card mb-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-signature text-primary me-2"></i> My Submitted Adoption Applications</h3>
            <span class="badge bg-light text-dark border"><?= count($myApplications) ?> Submitted</span>
        </div>
        <div class="admin-card-body p-0">
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Pet Name</th>
                            <th>Species & Breed</th>
                            <th>Application Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($myApplications as $app): ?>
                            <tr>
                                <td class="fw-bold text-dark"><?= ViewHelper::e($app['pet_name']) ?></td>
                                <td><?= ViewHelper::e($app['species']) ?> • <?= ViewHelper::e($app['breed']) ?></td>
                                <td><?= date('M d, Y', strtotime($app['created_at'])) ?></td>
                                <td>
                                    <?php
                                        $appBadge = match($app['status']) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            'under_review' => 'bg-info',
                                            default => 'bg-warning text-dark'
                                        };
                                    ?>
                                    <span class="badge <?= $appBadge ?> text-uppercase"><?= str_replace('_', ' ', $app['status']) ?></span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Adoptable Pets Showcase -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-bold text-dark m-0"><i class="fa-solid fa-paw text-brand me-2"></i> Animals Looking for Loving Homes</h4>
</div>

<div class="row g-4">
    <?php if (empty($availablePets)): ?>
        <div class="col-12">
            <div class="admin-card p-5 text-center text-muted">
                <p>No shelter pets currently listed for adoption.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($availablePets as $p): ?>
            <div class="col-md-6 col-lg-4">
                <div class="admin-card p-4 h-100 border d-flex flex-column justify-content-between">
                    <div>
                        <img src="<?= ViewHelper::asset($p['avatar']) ?>" alt="" class="rounded-4 p-2 border mb-3 w-100" style="height: 160px; object-fit: contain; background: #fff8e5;">
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h4 class="fw-bold text-dark m-0"><?= ViewHelper::e($p['name']) ?></h4>
                            <span class="badge bg-success-subtle text-success border text-uppercase">Available</span>
                        </div>
                        <div class="text-muted small mb-2"><?= ViewHelper::e($p['species']) ?> • <?= ViewHelper::e($p['breed']) ?> • <?= ViewHelper::e($p['gender']) ?></div>
                        <p class="small text-muted" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            <?= ViewHelper::e($p['medical_notes'] ?: 'Sweet, gentle companion looking for a loving forever family.') ?>
                        </p>
                    </div>
                    <div class="pt-3 border-top">
                        <button type="button" class="btn-admin-primary w-100 text-center py-2" data-bs-toggle="modal" data-bs-target="#adoptModal<?= $p['id'] ?>">
                            <i class="fa-solid fa-heart me-1"></i> Apply for Adoption
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal: Apply for Adoption -->
            <div class="modal fade" id="adoptModal<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-4 border-0 shadow">
                        <div class="modal-header border-0 pb-0">
                            <h5 class="modal-title fw-bold">Adoption Application for <?= ViewHelper::e($p['name']) ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?= ViewHelper::url('portal/adoption/apply') ?>" method="POST">
                            <?= ViewHelper::csrfField() ?>
                            <input type="hidden" name="pet_id" value="<?= $p['id'] ?>">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Housing Type</label>
                                    <select name="home_type" class="form-select rounded-3">
                                        <option value="House with Fenced Yard">House with Fenced Yard</option>
                                        <option value="Apartment / Condo">Apartment / Condo</option>
                                        <option value="Townhouse">Townhouse</option>
                                        <option value="Rural / Farm Property">Rural / Farm Property</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Previous Pet Experience</label>
                                    <input type="text" name="experience" class="form-control rounded-3" value="Experienced dog/cat owner" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label small fw-bold">Household Notes & Daily Schedule</label>
                                    <textarea name="notes" rows="3" class="form-control rounded-3" placeholder="Tell the shelter team about your household, daily work schedule, and other pets in the home..."></textarea>
                                </div>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn-admin-primary px-4">Submit Application</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
