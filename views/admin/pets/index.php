<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Pet Registry & Digital Passports</h2>
        <p class="admin-page-subtitle">Centralized health registry, cryptographic QR passports, and wellness metrics.</p>
    </div>
</div>

<!-- Filter Bar -->
<div class="admin-filter-bar">
    <form action="<?= ViewHelper::url('admin/pets') ?>" method="GET" class="d-flex flex-wrap gap-2 align-items-center w-100">
        <div class="flex-grow-1" style="min-width: 200px;">
            <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" placeholder="Search pet name, breed, microchip, owner..." value="<?= ViewHelper::e($filters['q']) ?>">
        </div>
        <div>
            <select name="species" class="form-select form-select-sm rounded-pill px-3">
                <option value="">All Species</option>
                <option value="Dog" <?= $filters['species'] === 'Dog' ? 'selected' : '' ?>>Dogs</option>
                <option value="Cat" <?= $filters['species'] === 'Cat' ? 'selected' : '' ?>>Cats</option>
                <option value="Bird" <?= $filters['species'] === 'Bird' ? 'selected' : '' ?>>Birds</option>
                <option value="Other" <?= $filters['species'] === 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>
        <div>
            <select name="status" class="form-select form-select-sm rounded-pill px-3">
                <option value="">All Passports</option>
                <option value="active" <?= $filters['status'] === 'active' ? 'selected' : '' ?>>Active Passport</option>
                <option value="revoked" <?= $filters['status'] === 'revoked' ? 'selected' : '' ?>>Revoked Passport</option>
            </select>
        </div>
        <button type="submit" class="btn btn-sm btn-dark rounded-pill px-4">Filter</button>
        <a href="<?= ViewHelper::url('admin/pets') ?>" class="btn btn-sm btn-light rounded-pill px-3">Reset</a>
    </form>
</div>

<!-- Pets Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Pet Name</th>
                        <th>Species & Breed</th>
                        <th>Parent / Caretaker</th>
                        <th>Care Score</th>
                        <th>Passport Status</th>
                        <th>Immunization</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($pets)): ?>
                        <tr><td colspan="7" class="text-center p-4 text-muted">No pet records found matching criteria.</td></tr>
                    <?php else: ?>
                        <?php foreach ($pets as $pet): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($pet['avatar'] ?: ($pet['species'] === 'Cat' ? 'img/cat-1.png' : 'img/dog-1.png')) ?>" alt="" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">
                                        <div>
                                            <a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="fw-bold text-dark text-decoration-none hover-underline">
                                                <?= ViewHelper::e($pet['name']) ?>
                                            </a>
                                            <small class="text-muted d-block"><?= ViewHelper::e($pet['gender']) ?> · <?= ViewHelper::e($pet['age']) ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= ViewHelper::e($pet['species']) ?></span>
                                    <small class="text-muted d-block"><?= ViewHelper::e($pet['breed']) ?></small>
                                </td>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/users/{$pet['user_id']}") ?>" class="fw-semibold text-dark text-decoration-none">
                                        <?= ViewHelper::e($pet['owner_name']) ?>
                                    </a>
                                    <small class="badge bg-light text-muted border text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($pet['owner_role']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-success fw-bold px-2 py-1"><?= $pet['care_score'] ?>/100</span>
                                </td>
                                <td>
                                    <span class="badge-status status-<?= $pet['passport_status'] ?? 'active' ?>"><?= ViewHelper::e($pet['passport_status'] ?? 'active') ?></span>
                                </td>
                                <td>
                                    <span class="small text-muted"><i class="fa-solid fa-syringe text-brand me-1"></i> <?= ViewHelper::e($pet['vaccination_status'] ?: 'Scheduled') ?></span>
                                </td>
                                <td>
                                    <a href="<?= ViewHelper::url("admin/pets/{$pet['id']}") ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">Passport</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
