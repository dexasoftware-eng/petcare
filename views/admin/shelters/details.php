<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-house-medical text-warning"></i>
            <span>Sanctuary Facility Review</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">Status: <?= ucfirst($shelter['verification_status'] ?? 'pending') ?></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($shelter['shelter_name']) ?> 🏡</h2>
        <p class="portal-hero-subtitle">
            Capacity: <?= ViewHelper::e($shelter['capacity'] ?? '50') ?> Animals &middot; License: <?= ViewHelper::e($shelter['license_number'] ?? 'SHL-TX-88219') ?>
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <?php if ($shelter['verification_status'] !== 'approved'): ?>
            <button class="btn btn-admin-success" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/shelters/' . $shelter['id'] . '/verification') ?>', 'Approve Shelter', 'Approve sanctuary credentials for <?= ViewHelper::e($shelter['shelter_name']) ?>?', 'Approve Sanctuary', 'btn-success', 'approved')">
                <i class="fa-solid fa-check"></i>
                <span>Approve Sanctuary</span>
            </button>
        <?php endif; ?>
        <?php if ($shelter['verification_status'] !== 'rejected'): ?>
            <button class="btn btn-admin-danger" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/shelters/' . $shelter['id'] . '/verification') ?>', 'Reject Application', 'Reject sanctuary verification for <?= ViewHelper::e($shelter['shelter_name']) ?>?', 'Reject', 'btn-danger', 'rejected')">
                <i class="fa-solid fa-ban"></i>
                <span>Reject</span>
            </button>
        <?php endif; ?>
        <a href="<?= ViewHelper::url('admin/shelters') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Shelters</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-building-shield text-success me-2"></i> Facility Profile</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Contact Person</label>
                    <div class="fw-bold text-dark"><?= ViewHelper::e($shelter['contact_person'] ?? $shelter['name']) ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Hotline Phone & Email</label>
                    <div class="fw-semibold"><?= ViewHelper::e($shelter['phone']) ?></div>
                    <small class="text-muted"><?= ViewHelper::e($shelter['email']) ?></small>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Sanctuary Address</label>
                    <div class="fw-semibold text-dark"><?= ViewHelper::e($shelter['address']) ?></div>
                </div>
                <div class="mb-0">
                    <label class="text-muted small fwk-bold text-uppercase">Max Holding Capacity</label>
                    <div class="fw-bold fs-5 text-success"><?= ViewHelper::e($shelter['capacity'] ?? '50') ?> Animals</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title">
                    <i class="fa-solid fa-ppaw text-success me-2"></i> Rescue Animals Listed for Adoption (<?= count($animals) ?>)
                </h3>
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
                                    <th style="text-align: right;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($animals as $pet): ?>
                                    <tr>
                                        <td class="fw-bold"><?= ViewHelper::e($pet['name']) ?></td>
                                        <td><?= ViewHelper::e($pet['species']) ?> (<?= ViewHelper::e($pet['breed']) ?>)</td>
                                        <td><span class="badge bg-success"><?= $pet['care_score'] ?? '90' ?>/100</span></td>
                                        <td><span class="badge-status status-<?= $pet['adoption_status'] ?? 'available' ?>"><?= ucfirst(ViewHelper::e($pet['adoption_status'] ?? 'available')) ?></span></td>
                                        <td style="text-align: right;"><a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="btn btn-sm btn-light border rounded-pill px-3">Inspect</a></td>
                                    </tr>
                                <<?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <<?php endif; ?>
            </div>
        </div>
    </div>
</div>
