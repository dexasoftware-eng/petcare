<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-paw text-brand me-2"></i> Rescue Animals Directory</h2>
        <p class="admin-page-subtitle">Manage all animals in shelter care, medical certifications, and adoption status.</p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('shelter/animals/create') ?>" class="btn btn-admin-primary rounded-pill px-4">
            <i class="fa-solid fa-plus me-1"></i> Add Rescue Animal
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list text-brand me-2"></i> Active Animals</h3>
        <span class="badge bg-light text-dark border"><?= count($animals ?? []) ?> Total Animals</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($animals)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-paw fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No rescue animals listed</h5>
                <p class="small text-muted">Click "+ Add Rescue Animal" to list a pet for adoption.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Animal</th>
                            <th>Species & Breed</th>
                            <th>Age & Gender</th>
                            <th>Microchip</th>
                            <th>Adoption Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($animals as $pet): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($pet['avatar'] ?? 'img/dog-1.png') ?>" alt="Pet" class="rounded-circle border" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($pet['name']) ?></div>
                                            <span class="badge bg-light text-muted border px-2 py-0" style="font-size: 10px;"><?= ViewHelper::e($pet['vaccination_status'] ?? 'Up to date') ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($pet['species']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($pet['breed']) ?></div>
                                </td>
                                <td class="small text-muted">
                                    <?= ViewHelper::e($pet['gender']) ?> &middot; <?= ViewHelper::e($pet['age']) ?>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($pet['microchip_id'] ?? 'Not microchipped') ?>
                                </td>
                                <td>
                                    <?php if (!empty($pet['is_for_adoption'])): ?>
                                        <span class="admin-badge badge-success">Available for Adoption</span>
                                    <?php else: ?>
                                        <span class="admin-badge badge-neutral">Adopted / Placed</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                            View
                                        </a>
                                        <a href="<?= ViewHelper::url('shelter/animals/' . $pet['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="deleteAnimal(<?= $pet['id'] ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
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

<script>
async function deleteAnimal(id) {
    const confirmed = await PetGuardModal.danger({
        title: 'Delete Animal Record?',
        message: 'This will remove the animal listing from the adoption directory.'
    });

    if (confirmed) {
        const res = await PetGuardAjax.post(`shelter/animals/${id}/delete`);
        if (res.ok) {
            PetGuardToast.success('Animal removed.');
            setTimeout(() => window.location.reload(), 600);
        } else {
            PetGuardToast.error(res.message);
        }
    }
}
</script>
