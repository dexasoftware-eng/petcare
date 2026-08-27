<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title text-danger"><i class="fa-solid fa-truck-medical me-2"></i> Emergency Center & Triage</h2>
        <p class="admin-page-subtitle">Critical pet incidents, poisoning alerts, trauma triage, and emergency veterinarian dispatch.</p>
    </div>
</div>

<!-- Emergency Events Table -->
<div class="admin-card">
    <div class="admin-card-header bg-light">
        <h3 class="admin-card-title text-dark"><i class="fa-solid fa-triangle-exclamation text-danger"></i> Active & Historical Emergency Incidents (<?= count($events) ?>)</h3>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($events)): ?>
            <div class="p-4 text-center text-muted">
                <i class="fa-solid fa-circle-check text-success fs-3 mb-2 d-block"></i>
                No active emergency incidents logged.
            </div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Incident Type</th>
                            <th>Severity</th>
                            <th>Pet & Parent</th>
                            <th>Reported Symptoms</th>
                            <th>Assigned Doctor</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $ev): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($ev['emergency_type']) ?></div>
                                    <small class="text-muted"><i class="fa-solid fa-location-dot me-1"></i> <?= ViewHelper::e($ev['location'] ?: 'Not localized') ?></small>
                                </td>
                                <td>
                                    <?php if ($ev['severity'] === 'critical'): ?>
                                        <span class="badge bg-danger text-uppercase px-2 py-1">Critical</span>
                                    <?php elseif ($ev['severity'] === 'severe'): ?>
                                        <span class="badge bg-warning text-dark text-uppercase px-2 py-1">Severe</span>
                                    <?php else: ?>
                                        <span class="badge bg-info text-dark text-uppercase px-2 py-1">Moderate</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($ev['pet_name'] ?? 'Pet') ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($ev['owner_name']) ?> (<?= ViewHelper::e($ev['owner_phone']) ?>)</small>
                                </td>
                                <td>
                                    <small class="text-dark d-block" style="max-width: 200px;"><?= ViewHelper::e($ev['symptoms']) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border"><?= ViewHelper::e($ev['assigned_vet_name'] ?: 'Unassigned') ?></span>
                                </td>
                                <td><span class="badge-status status-<?= $ev['status'] ?>"><?= ViewHelper::e($ev['status']) ?></span></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-dark rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#emergModal<?= $ev['id'] ?>">Triage</button>

                                    <!-- Emergency Triage Modal -->
                                    <div class="modal fade" id="emergModal<?= $ev['id'] ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title fw-bold text-danger"><i class="fa-solid fa-truck-medical me-2"></i> Triage Incident #<?= $ev['id'] ?></h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <form action="<?= ViewHelper::url("admin/emergency/{$ev['id']}/status") ?>" method="POST">
                                                    <?= ViewHelper::csrfField() ?>
                                                    <div class="modal-body py-0">
                                                        <div class="p-3 bg-light rounded-3 mb-3 small">
                                                            <div><strong>Incident:</strong> <?= ViewHelper::e($ev['emergency_type']) ?></div>
                                                            <div><strong>Parent Contact:</strong> <?= ViewHelper::e($ev['owner_name']) ?> (<a href="tel:<?= ViewHelper::e($ev['owner_phone']) ?>"><?= ViewHelper::e($ev['owner_phone']) ?></a>)</div>
                                                            <div><strong>Symptoms:</strong> <?= ViewHelper::e($ev['symptoms']) ?></div>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Incident Status *</label>
                                                            <select name="status" class="form-select rounded-3">
                                                                <option value="active" <?= $ev['status'] === 'active' ? 'selected' : '' ?>>Active / Incoming</option>
                                                                <option value="in_triage" <?= $ev['status'] === 'in_triage' ? 'selected' : '' ?>>In Triage Evaluation</option>
                                                                <option value="assigned" <?= $ev['status'] === 'assigned' ? 'selected' : '' ?>>Assigned to On-Call Vet</option>
                                                                <option value="resolved" <?= $ev['status'] === 'resolved' ? 'selected' : '' ?>>Resolved / Stable</option>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Assign On-Call Veterinarian</label>
                                                            <select name="assigned_vet_id" class="form-select rounded-3">
                                                                <option value="">-- No Assigned Doctor --</option>
                                                                <?php foreach ($vets as $vet): ?>
                                                                    <option value="<?= $vet['id'] ?>" <?= ($ev['assigned_vet_id'] ?? 0) == $vet['id'] ? 'selected' : '' ?>><?= ViewHelper::e($vet['name']) ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label small fw-bold">Triage Notes & Clinical Actions</label>
                                                            <textarea name="triage_notes" class="form-control rounded-3" rows="3" placeholder="Emergency doctor notes, oxygen therapy, antidote administered..."><?= ViewHelper::e($ev['triage_notes'] ?? '') ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Update Incident</button>
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
