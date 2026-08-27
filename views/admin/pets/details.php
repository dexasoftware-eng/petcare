<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-shield-cat text-warning"></i>
            <span>Cryptographic Digital Passport</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">ID #<?= $pet['id'] ?></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($pet['name']) ?>'s Passport 🐾</h2>
        <p class="portal-hero-subtitle"><?= ViewHelper::e($pet['species']) ?> &middot; <?= ViewHelper::e($pet['breed']) ?> &middot; Owner: <?= ViewHelper::e($owner['name'] ?? '—') ?></p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <?php if (($pet['passport_status'] ?? 'active') === 'active'): ?>
            <button class="btn btn-admin-danger" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/pets/{$pet['id']}/passport") ?>', 'Revoke Digital Passport', 'Revoke public QR cryptographic passport for <?= ViewHelper::e($pet['name']) ?>?', 'Revoke Passport', 'btn-danger')">
                <i class="fa-solid fa-ban"></i>
                <span>Revoke Passport</span>
            </button>
        <?php else: ?>
            <button class="btn btn-admin-success" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/pets/{$pet['id']}/passport") ?>', 'Reactivate Passport', 'Reactivate verified passport for <?= ViewHelper::e($pet['name']) ?>?', 'Reactivate', 'btn-success')">
                <i class="fa-solid fa-check"></i>
                <span>Reactivate Passport</span>
            </button>
        <?php endif; ?>
        <a href="<?= ViewHelper::url('admin/pets') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Pets</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Pet Overview & Digital Passport Card -->
    <div class="col-lg-4">
        <!-- Digital Passport Visual Card -->
        <div class="admin-card mb-4" style="background: linear-gradient(145deg, #ffffff 0%, #fff8e5 100%); border: 1.5px solid rgba(250, 68, 29, 0.2);">
            <div class="admin-card-header bg-transparent border-0">
                <span class="badge bg-danger text-uppercase px-3 py-1 fw-bold">PetGuard Cryptographic Passport</span>
                <span class="badge-status status-<?= $pet['passport_status'] ?? 'active' ?>"><?= ViewHelper::e($pet['passport_status'] ?? 'active') ?></span>
            </div>
            <div class="admin-card-body text-center pt-0">
                <img src="<?= ViewHelper::asset($pet['avatar'] ?: ($pet['species'] === 'Cat' ? 'img/cat-1.png' : 'img/dog-1.png')) ?>" alt="" class="rounded-circle border border-3 border-white shadow-sm mb-3" style="width: 90px; height: 90px; object-fit: cover;">
                <h4 class="fw-bold m-0"><?= ViewHelper::e($pet['name']) ?></h4>
                <p class="text-muted small"><?= ViewHelper::e($pet['species']) ?> · <?= ViewHelper::e($pet['breed']) ?></p>

                <div class="p-3 bg-white rounded-3 shadow-sm text-start small border mb-3">
                    <div class="mb-1"><strong>Microchip:</strong> <span class="font-monospace text-primary"><?= ViewHelper::e($pet['microchip_id'] ?: 'Not chipped') ?></span></div>
                    <div class="mb-1"><strong>Blood Group:</strong> <?= ViewHelper::e($pet['blood_group'] ?: 'Pending') ?></div>
                    <div class="mb-1"><strong>Weight / Age:</strong> <?= ViewHelper::e($pet['weight']) ?> · <?= ViewHelper::e($pet['age']) ?></div>
                    <div><strong>QR Token:</strong> <code class="text-dark"><?= ViewHelper::e($pet['qr_token'] ?? 'FS-PET-849201') ?></code></div>
                </div>

                <div class="d-flex justify-content-between align-items-center bg-white p-2 px-3 rounded-pill border shadow-sm">
                    <span class="small fw-bold text-muted">Care Score</span>
                    <span class="badge bg-success fs-6"><?= $careScore['score'] ?> / 100</span>
                </div>
            </div>
        </div>

        <!-- Care Score Analysis Panel -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-brain text-brand"></i> Care Score Factors</h3>
            </div>
            <div class="admin-card-body">
                <p class="small text-muted mb-3"><?= ViewHelper::e($careScore['summary']) ?></p>
                <div class="d-flex flex-column gap-2">
                    <?php foreach ($careScore['factors'] as $factor): ?>
                        <div class="p-2 px-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                            <div>
                                <div class="fw-bold small"><?= ViewHelper::e($factor['name']) ?></div>
                                <small class="text-muted" style="font-size: 11px;"><?= ViewHelper::e($factor['detail']) ?></small>
                            </div>
                            <span class="badge bg-white text-dark border"><?= ViewHelper::e($factor['impact']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Health History & Consultations -->
    <div class="col-lg-8">
        <!-- Vaccinations Record -->
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-syringe text-brand"></i> Immunization & Vaccination Records</h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($vaccines)): ?>
                    <div class="p-4 text-center text-muted">No individual vaccine entries recorded in database. Status: <strong><?= ViewHelper::e($pet['vaccination_status'] ?: 'Up to Date') ?></strong></div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead><tr><th>Vaccine</th><th>Administered</th><th>Next Due</th><th>Batch</th></tr></thead>
                            <tbody>
                                <?php foreach ($vaccines as $v): ?>
                                    <tr>
                                        <td class="fw-bold"><?= ViewHelper::e($v['vaccine_name']) ?></td>
                                        <td><?= ViewHelper::e($v['administered_date']) ?></td>
                                        <td><span class="text-brand fw-semibold"><?= ViewHelper::e($v['next_due_date'] ?: '—') ?></span></td>
                                        <td><code><?= ViewHelper::e($v['batch_number'] ?: 'STANDARD') ?></code></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Clinical Consultations -->
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-stethoscope text-primary"></i> Clinical Appointments & Consultations</h3>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($appointments)): ?>
                    <div class="p-4 text-center text-muted">No clinical visits on file for this patient.</div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead><tr><th>Date</th><th>Type</th><th>Symptoms / Notes</th><th>Status</th></tr></thead>
                            <tbody>
                                <?php foreach ($appointments as $a): ?>
                                    <tr>
                                        <td><?= ViewHelper::e($a['appointment_date']) ?></td>
                                        <td class="fw-bold"><?= ViewHelper::e($a['consultation_type']) ?></td>
                                        <td><small><?= ViewHelper::e($a['symptoms']) ?></small></td>
                                        <td><span class="badge-status status-<?= $a['status'] ?>"><?= ViewHelper::e($a['status']) ?></span></td>
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
