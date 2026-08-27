<?php
use Helpers\ViewHelper;
?>

<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-shield text-warning"></i>
            <span class="text-uppercase"><?= ViewHelper::e($targetUser['role']) ?> Account</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">UID #<?= $targetUser['id'] ?></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($targetUser['name']) ?> 👤</h2>
        <p class="portal-hero-subtitle">Email: <?= ViewHelper::e($targetUser['email']) ?> &middot; Joined: <?= date('F d, Y', strtotime($targetUser['created_at'])) ?> &middot; Status: <span class="badge <?= $targetUser['status'] === 'active' ? 'bg-success' : 'bg-danger' ?> text-white"><?= ucfirst($targetUser['status']) ?></span></p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <button class="btn btn-admin-secondary" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/users/{$targetUser['id']}/reset-password") ?>', 'Reset Password', 'Generate temporary password for <?= ViewHelper::e($targetUser['name']) ?>?', 'Reset Password', 'btn-warning')">
            <i class="fa-solid fa-key"></i>
            <span>Reset Password</span>
        </button>
        <?php if ($targetUser['status'] === 'active'): ?>
            <button class="btn btn-admin-danger" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/users/{$targetUser['id']}/status") ?>', 'Suspend Account', 'Suspend access for <?= ViewHelper::e($targetUser['name']) ?>?', 'Suspend User', 'btn-danger', 'suspended')">
                <i class="fa-solid fa-ban"></i>
                <span>Suspend User</span>
            </button>
        <?php else: ?>
            <button class="btn btn-admin-success" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/users/{$targetUser['id']}/status") ?>', 'Activate Account', 'Restore access for <?= ViewHelper::e($targetUser['name']) ?>?', 'Activate User', 'btn-success', 'active')">
                <i class="fa-solid fa-check"></i>
                <span>Activate Account</span>
            </button>
        <?php endif; ?>
        <a href="<?= ViewHelper::url('admin/users') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Users</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- User Bio Card -->
    <div class="col-lg-4">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-id-card text-brand"></i> Account Information</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Email Address</label>
                    <div class="fw-bold"><?= ViewHelper::e($targetUser['email']) ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Phone</label>
                    <div class="fw-bold"><?= ViewHelper::e($targetUser['phone'] ?: 'Not provided') ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Physical Address</label>
                    <div class="fw-bold"><?= ViewHelper::e($targetUser['address'] ?: 'Not provided') ?></div>
                </div>
                <div class="mb-3">
                    <label class="text-muted small fw-bold text-uppercase">Status</label>
                    <div><span class="badge-status status-<?= $targetUser['status'] ?>"><?= ViewHelper::e($targetUser['status']) ?></span></div>
                </div>
                <?php if ($profile): ?>
                    <hr>
                    <h6 class="fw-bold text-dark mb-2">Role Profile Info</h6>
                    <?php if (isset($profile['clinic_name'])): ?>
                        <div class="mb-2"><strong class="small text-muted">Clinic:</strong> <?= ViewHelper::e($profile['clinic_name']) ?></div>
                        <div class="mb-2"><strong class="small text-muted">Specialization:</strong> <?= ViewHelper::e($profile['specialization']) ?></div>
                        <div class="mb-2"><strong class="small text-muted">Experience:</strong> <?= ViewHelper::e($profile['experience']) ?> Years</div>
                    <?php elseif (isset($profile['shelter_name'])): ?>
                        <div class="mb-2"><strong class="small text-muted">Sanctuary:</strong> <?= ViewHelper::e($profile['shelter_name']) ?></div>
                        <div class="mb-2"><strong class="small text-muted">Capacity:</strong> <?= ViewHelper::e($profile['capacity']) ?> Animals</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Related Entities Tabs -->
    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header border-0 pb-0">
                <ul class="nav nav-tabs border-0" id="userTab" role="tablist">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold text-dark border-0 pb-3" id="pets-tab" data-bs-toggle="tab" data-bs-target="#pets-pane">
                            <i class="fa-solid fa-paw text-brand me-1"></i> Pets (<?= count($pets) ?>)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold text-dark border-0 pb-3" id="appts-tab" data-bs-toggle="tab" data-bs-target="#appts-pane">
                            <i class="fa-solid fa-calendar-check text-primary me-1"></i> Appointments (<?= count($appointments) ?>)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold text-dark border-0 pb-3" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-pane">
                            <i class="fa-solid fa-cart-shopping text-success me-1"></i> Orders (<?= count($orders) ?>)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold text-dark border-0 pb-3" id="adoptions-tab" data-bs-toggle="tab" data-bs-target="#adoptions-pane">
                            <i class="fa-solid fa-heart text-danger me-1"></i> Adoptions (<?= count($adoptionApps) ?>)
                        </button>
                    </li>
                </ul>
            </div>
            <div class="admin-card-body p-0 border-top">
                <div class="tab-content" id="userTabContent">
                    <!-- Pets Pane -->
                    <div class="tab-pane fade show active" id="pets-pane">
                        <?php if (empty($pets)): ?>
                            <div class="p-4 text-center text-muted">No pets registered under this account.</div>
                        <?php else: ?>
                            <div class="admin-table-container">
                                <table class="admin-table">
                                    <thead><tr><th>Pet</th><th>Species</th><th>Care Score</th><th>Passport</th><th>Action</th></tr></thead>
                                    <tbody>
                                        <?php foreach ($pets as $p): ?>
                                            <tr>
                                                <td class="fw-bold"><?= ViewHelper::e($p['name']) ?></td>
                                                <td><?= ViewHelper::e($p['species']) ?> (<?= ViewHelper::e($p['breed']) ?>)</td>
                                                <td><span class="badge bg-success"><?= $p['care_score'] ?>/100</span></td>
                                                <td><span class="badge-status status-<?= $p['passport_status'] ?? 'active' ?>"><?= ViewHelper::e($p['passport_status'] ?? 'active') ?></span></td>
                                                <td><a href="<?= ViewHelper::url("admin/pets/{$p['id']}") ?>" class="btn btn-sm btn-light rounded-pill">View</a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Appointments Pane -->
                    <div class="tab-pane fade" id="appts-pane">
                        <?php if (empty($appointments)): ?>
                            <div class="p-4 text-center text-muted">No clinical appointments on record.</div>
                        <?php else: ?>
                            <div class="admin-table-container">
                                <table class="admin-table">
                                    <thead><tr><th>Date & Time</th><th>Pet</th><th>Consultation</th><th>Status</th></tr></thead>
                                    <tbody>
                                        <?php foreach ($appointments as $a): ?>
                                            <tr>
                                                <td><?= ViewHelper::e($a['appointment_date']) ?> <?= ViewHelper::e($a['appointment_time']) ?></td>
                                                <td class="fw-bold"><?= ViewHelper::e($a['pet_name'] ?? '—') ?></td>
                                                <td><?= ViewHelper::e($a['consultation_type']) ?></td>
                                                <td><span class="badge-status status-<?= $a['status'] ?>"><?= ViewHelper::e($a['status']) ?></span></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Orders Pane -->
                    <div class="tab-pane fade" id="orders-pane">
                        <?php if (empty($orders)): ?>
                            <div class="p-4 text-center text-muted">No marketplace orders placed.</div>
                        <?php else: ?>
                            <div class="admin-table-container">
                                <table class="admin-table">
                                    <thead><tr><th>Order #</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                                    <tbody>
                                        <?php foreach ($orders as $o): ?>
                                            <tr>
                                                <td class="fw-bold"><a href="<?= ViewHelper::url("admin/marketplace/orders/{$o['id']}") ?>">#<?= ViewHelper::e($o['order_number']) ?></a></td>
                                                <td>$<?= number_format((float)$o['total_amount'], 2) ?></td>
                                                <td><span class="badge-status status-<?= $o['status'] ?>"><?= ViewHelper::e($o['status']) ?></span></td>
                                                <td><?= date('M d, Y', strtotime($o['created_at'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Adoptions Pane -->
                    <div class="tab-pane fade" id="adoptions-pane">
                        <?php if (empty($adoptionApps)): ?>
                            <div class="p-4 text-center text-muted">No adoption applications submitted.</div>
                        <?php else: ?>
                            <div class="admin-table-container">
                                <table class="admin-table">
                                    <thead><tr><th>Pet</th><th>Living Setup</th><th>Status</th><th>Date</th></tr></thead>
                                    <tbody>
                                        <?php foreach ($adoptionApps as $app): ?>
                                            <tr>
                                                <td class="fw-bold"><?= ViewHelper::e($app['pet_name']) ?></td>
                                                <td><?= ViewHelper::e($app['living_arrangement']) ?></td>
                                                <td><span class="badge-status status-<?= $app['status'] ?>"><?= ViewHelper::e($app['status']) ?></span></td>
                                                <td><?= date('M d, Y', strtotime($app['created_at'])) ?></td>
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
    </div>
</div>
