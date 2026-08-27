<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <a href="<?= ViewHelper::url('admin/shelters') ?>" class="btn btn-sm btn-light rounded-pill mb-2">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Shelters
        </a>
        <h2 class="admin-page-title"><?= ViewHelper::e($shelter['shelter_name']) ?></h2>
        <p class="admin-page-subtitle">Capacity: <?= ViewHelper::e($shelter['capacity']) ?> Animals · Verification: <span class="badge-status status-<?= $shelter['verification_status'] ?>"><?= ViewHelper::e($shelter['verification_status']) ?></span></p>
    </div>
    <div class="d-flex gap-2">
        <?php if ($shelter['verification_status'] !== 'approved'): ?>
            <button class="btn btn-sm btn-success rounded-pill px-3" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/shelters/{$shelter['id']}/verification") ?>', 'Approve Shelter', 'Approve sanctuary credentials for <?= ViewHelper::e($shelter['shelter_name']) ?>?', 'Approve Shelter', 'btn-success', 'approved')">
                <i class="fa-solid fa-check me-1"></i> Approve Sanctuary
            </button>
        <?php endif; ?>
        <?php if ($shelter['verification_status'] !== 'rejected'): ?>
            <button class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/shelters/{$shelter['id']}/verification") ?>', 'Reject Application', 'Reject sanctuary verification for <?= ViewHelper::e($shelter['shelter_name']) ?>?', 'Reject Application', 'btn-danger', 'rejected')">
                <i class="fa-solid fa-ban me-1"></i> Reject
            </button>
        <?php endif; ?>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-building-shield text-brand"></i> Facility Profile</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Contact Person</label>
                    <div class="fw-bold"><?= ViewHelper::e($shelter['contact_person']) ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Hotline Phone & Email</label>
                    <div><?= ViewHelper::e($shelter['phone']) ?></div>
                    <small class="text-muted"><?= ViewHelper::e($shelter['email']) ?></small>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Sanctuary Address</label>
                    <div class="fw-semibold"><?= ViewHelper::e($shelter['address']) ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Max Holding Capacity</label>
                    <div class="fw-bold fs-5 text-success"><?= ViewHelper::e($shelter['capacity']) ?> Animals</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-paw text-brand"></i> Rescue Animals Listed for Adoption (<?= count($animals) ?>)</h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($animals)): ?>
                    <div class="p-4 text-center text-muted">No animals published for adoption by this sanctuary.</div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Pet Name</th>
                                    <th>Species</th>
                                    <th>Care Score</th>
                                    <th>Adoption Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($animals as $pet): ?>
                                    <tr>
                                        <td class="fw-bold"><?= ViewHelper::e($pet['name']) ?></td>
                                        <td><?= ViewHelper::e($pet['species']) ?> (<?= ViewHelper::e($pet['breed']) ?>)</td>
                                        <td><span class="badge bg-success"><?= $pet['care_score'] ?>/100</span></td>
                                        <td><span class="badge-status status-<?= $pet['adoption_status'] ?>"><?= ViewHelper::e($pet['adoption_status']) ?></span></td>
                                        <td><a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="btn btn-sm btn-light rounded-pill">Inspect</a></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
