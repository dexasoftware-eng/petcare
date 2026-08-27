<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-people-roof text-warning"></i>
            <span>Family Care Coordination</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= count($members ?? []) ?> Active Passes</span>
        </div>
        <h2 class="portal-hero-title">Family Sharing &amp; Sitter Passes 👨‍👩‍👧</h2>
        <p class="portal-hero-subtitle">Grant temporary or permanent pet care passes to family members, walkers, and sitters.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#inviteFamilyModal">
            <i class="fa-solid fa-user-plus"></i>
            <span>Grant Care Pass</span>
        </button>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Recipient</th>
                        <th>Associated Pet</th>
                        <th>Permission Level</th>
                        <th>Pass Validity</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($members)): ?>
                        <tr>
                            <td colspan="5" class="text-center p-5 text-muted">
                                <i class="fa-solid fa-people-roof fs-1 text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">No shared passes granted yet</h5>
                                <p class="small mb-3">Invite your spouse, family members, or pet sitters to log feeding, walking, and care tasks.</p>
                                <button class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#inviteFamilyModal">Grant First Pass</button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($members as $m): ?>
                            <tr>
                                <td>
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($m['invited_email']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($m['relationship'] ?: 'Caregiver') ?></small>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($m['pet_name']) ?></span></td>
                                <td><span class="badge bg-primary text-uppercase"><?= str_replace('_', ' ', $m['access_level']) ?></span></td>
                                <td><?= $m['expires_at'] ? '<span class="text-warning fw-bold">Expires: ' . date('M d, Y', strtotime($m['expires_at'])) . '</span>' : '<span class="text-success fw-bold">Permanent Family Pass</span>' ?></td>
                                <td class="text-end">
                                    <form action="<?= ViewHelper::url('portal/family/' . $m['id'] . '/revoke') ?>" method="POST" class="d-inline m-0" onsubmit="return confirm('Revoke caregiver pass?');">
                                        <?= ViewHelper::csrfField() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">Revoke</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal: Grant Care Pass -->
<div class="modal fade" id="inviteFamilyModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-people-roof text-brand me-2"></i> Grant Caregiver Pass</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/family/invite') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Pet *</label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Caregiver Email Address *</label>
                        <input type="email" name="email" class="form-control rounded-3" required placeholder="sitter@example.com">
                    </div>
                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold">Role / Relationship</label>
                            <select name="relationship" class="form-select rounded-3">
                                <option value="Spouse">Spouse / Partner</option>
                                <option value="Family Member">Family Member</option>
                                <option value="Pet Sitter">Pet Sitter</option>
                                <option value="Dog Walker">Dog Walker</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold">Permission Scope</label>
                            <select name="access_level" class="form-select rounded-3">
                                <option value="view_care">View & Mark Care</option>
                                <option value="view_only">View Only</option>
                                <option value="full_access">Full Access</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Temporary Expiration Date (Leave blank for permanent)</label>
                        <input type="date" name="expires_at" class="form-control rounded-3" min="<?= date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-admin-primary px-4">Grant Pass</button>
                </div>
            </form>
        </div>
    </div>
</div>
