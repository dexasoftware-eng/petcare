<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-paw text-brand me-2"></i> Patients Medical Database</h2>
        <p class="admin-page-subtitle">Access complete medical history, digital pet passports, and clinical records.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-database text-brand me-2"></i> Patient Health Records</h3>
        
        <form method="GET" action="<?= ViewHelper::url('vet/patients') ?>" class="d-flex gap-2" style="max-width: 320px;">
            <input type="text" name="search" class="form-control form-control-sm rounded-pill px-3" placeholder="Search pet, breed, chip..." value="<?= ViewHelper::e($search ?? '') ?>">
            <button type="submit" class="btn btn-sm btn-admin-primary rounded-pill px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($patients)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-paw fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No patient records found</h5>
                <p class="small text-muted">Try adjusting your search criteria.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Patient</th>
                            <th>Species & Breed</th>
                            <th>Parent Contact</th>
                            <th>Microchip ID</th>
                            <th>Passport Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($patients as $p): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($p['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($p['name']) ?></div>
                                            <div class="small text-muted"><?= ViewHelper::e($p['gender']) ?> &middot; <?= ViewHelper::e($p['age']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($p['species']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($p['breed']) ?></div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($p['owner_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($p['owner_phone'] ?? $p['owner_email']) ?></div>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($p['microchip_id'] ?? 'Not microchipped') ?>
                                </td>
                                <td>
                                    <span class="admin-badge badge-success text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($p['passport_status'] ?? 'active') ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= ViewHelper::url('vet/patients/' . $p['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                        <i class="fa-solid fa-folder-open me-1"></i> Medical History
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
