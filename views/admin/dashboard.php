<?php
use Helpers\ViewHelper;
?>

<!-- Executive Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-shield text-warning"></i>
            <span>Platform Governance & Oversight</span>
            <span class="text-white-50">&middot;</span>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0">Systems Healthy</span>
        </div>
        <h2 class="portal-hero-title">Executive Command Center ⚡</h2>
        <p class="portal-hero-subtitle">Real-time telemetry, multi-role verification queues & ecosystem operations.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/notifications') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-bullhorn"></i>
            <span>Broadcast Alert</span>
        </a>
        <a href="<?= ViewHelper::url('admin/emergency') ?>" class="btn btn-outline-danger rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-1" style="min-height: 44px;">
            <i class="fa-solid fa-truck-medical"></i>
            <span>Emergency Center</span>
        </a>
    </div>
</div>

<!-- Primary Metric KPI Cards Grid -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Users</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalUsers']) ?></div>
            <div class="stat-card-footer">
                <span class="text-success fw-bold"><i class="fa-solid fa-paw"></i> <?= $kpi['totalOwners'] ?></span> Pet Parents Active
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Verified Vets</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalVets']) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingVets'] ?> Pending Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Rescue Shelters</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-house-medical"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalShelters']) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingShelters'] ?> Pending Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Registered Pets</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalPets']) ?></div>
            <div class="stat-card-footer">
                <span class="text-primary fw-bold"><?= $kpi['activePets'] ?></span> Digital Passports Active
            </div>
        </div>
    </div>
</div>

<!-- Secondary Operational Metrics -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Monthly Appointments</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['monthlyAppointments']) ?></div>
            <div class="stat-card-footer text-muted">Current billing cycle</div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Adoption Success Rate</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['adoptionSuccessRate'] ?>%</div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingAdoptions'] ?> Under Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Marketplace Revenue</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <div class="stat-card-value">$<?= number_format($kpi['totalSales'], 2) ?></div>
            <div class="stat-card-footer text-muted"><?= number_format($kpi['totalOrders']) ?> Customer Orders</div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Platform Alerts</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['openReports'] + $kpi['activeEmergencies'] + $kpi['lowStockProducts'] ?></div>
            <div class="stat-card-footer">
                <span class="text-danger fw-bold"><?= $kpi['activeEmergencies'] ?> Emergencies</span> · <?= $kpi['lowStockProducts'] ?> Low Stock
            </div>
        </div>
    </div>
</div>

<!-- Main Dashboard Grid -->
<div class="row g-4 mb-4">
    <!-- Pending Vet & Shelter Approvals Queue -->
    <div class="col-lg-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-blue" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-dark">Pending Clinical Approvals</h6>
                </div>
                <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    View All &rarr;
                </a>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($pendingVetsList)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-circle-check text-success fs-3 mb-2 d-block"></i>
                        <span class="small">No pending veterinary applications in queue.</span>
                    </div>
                <?php else: ?>
                    <!-- Desktop Table (>=768px) -->
                    <div class="d-none d-md-block table-responsive m-0">
                        <table class="table table-hover align-middle m-0" style="min-width: 440px;">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Doctor / Clinic</th>
                                    <th>Specialization</th>
                                    <th class="text-end pe-4 text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingVetsList as $vet): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-light border text-brand d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 36px; height: 36px; font-size: 14px;">
                                                    <i class="fa-solid fa-user-doctor"></i>
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($vet['name']) ?></div>
                                                    <small class="text-muted text-truncate d-block"><i class="fa-regular fa-hospital me-1"></i><?= ViewHelper::e($vet['clinic_name'] ?: 'Independent Clinic') ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-secondary border px-2 py-1" style="font-size: 11px;"><?= ViewHelper::e($vet['specialization'] ?: 'General Practice') ?></span>
                                        </td>
                                        <td class="text-end pe-4 text-nowrap">
                                            <a href="<?= ViewHelper::url("admin/veterinarians/{$vet['id']}") ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold d-inline-flex align-items-center gap-1" style="font-size: 12px;">
                                                <span>Review</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards (<768px) -->
                    <div class="d-md-none p-3 d-flex flex-column gap-3">
                        <?php foreach ($pendingVetsList as $vet): ?>
                            <div class="p-3 rounded-4 border bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light border text-brand d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 38px; height: 38px; font-size: 14px;">
                                            <i class="fa-solid fa-user-doctor"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 15px;"><?= ViewHelper::e($vet['name']) ?></div>
                                            <small class="text-muted"><i class="fa-regular fa-hospital me-1 text-brand"></i><?= ViewHelper::e($vet['clinic_name'] ?: 'Independent Clinic') ?></small>
                                        </div>
                                    </div>
                                    <span class="badge bg-light text-secondary border px-2 py-1 small"><?= ViewHelper::e($vet['specialization'] ?: 'General') ?></span>
                                </div>
                                <div class="pt-2 border-top">
                                    <a href="<?= ViewHelper::url("admin/veterinarians/{$vet['id']}") ?>" class="btn btn-sm btn-admin-primary rounded-pill w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold" style="min-height: 42px; font-size: 13px;">
                                        <span>Review Application</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Adoption Applications Review -->
    <div class="col-lg-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-purple" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                        <i class="fa-solid fa-heart text-danger"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-dark">Adoption Pipeline Queue</h6>
                </div>
                <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    View Hub &rarr;
                </a>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($pendingAdoptionsList)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-circle-check text-success fs-3 mb-2 d-block"></i>
                        <span class="small">No pending adoption applications requiring triage.</span>
                    </div>
                <?php else: ?>
                    <!-- Desktop Table (>=768px) -->
                    <div class="d-none d-md-block table-responsive m-0">
                        <table class="table table-hover align-middle m-0" style="min-width: 480px;">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Applicant</th>
                                    <th>Adoptable Pet</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4 text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pendingAdoptionsList as $app): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-light border text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 36px; height: 36px; font-size: 13px;">
                                                    <?= strtoupper(substr($app['applicant_name'] ?? 'A', 0, 1)) ?>
                                                </div>
                                                <div class="min-w-0">
                                                    <div class="fw-bold text-dark text-truncate"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                                    <small class="text-muted text-truncate d-block"><i class="fa-regular fa-envelope me-1"></i><?= ViewHelper::e($app['applicant_email']) ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-brand"><i class="fa-solid fa-paw me-1"></i><?= ViewHelper::e($app['pet_name']) ?></div>
                                            <small class="text-muted d-block"><?= ViewHelper::e($app['pet_breed'] ?: 'Mixed Breed') ?></small>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php
                                            $statusLabel = ucwords(str_replace('_', ' ', $app['status'] ?? 'pending'));
                                            $badgeClass = match($app['status'] ?? '') {
                                                'approved' => 'badge-success',
                                                'under_review', 'pending' => 'badge-amber',
                                                'rejected', 'declined' => 'badge-danger',
                                                default => 'badge-neutral'
                                            };
                                            ?>
                                            <span class="admin-badge <?= $badgeClass ?> text-uppercase" style="font-size: 10.5px;">
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 text-nowrap">
                                            <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold d-inline-flex align-items-center gap-1" style="font-size: 12px;">
                                                <i class="fa-solid fa-file-signature"></i>
                                                <span>Triage</span>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards (<768px) -->
                    <div class="d-md-none p-3 d-flex flex-column gap-3">
                        <?php foreach ($pendingAdoptionsList as $app): ?>
                            <div class="p-3 rounded-4 border bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-start gap-2 mb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light border text-dark d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width: 38px; height: 38px; font-size: 13px;">
                                            <?= strtoupper(substr($app['applicant_name'] ?? 'A', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 15px;"><?= ViewHelper::e($app['applicant_name']) ?></div>
                                            <small class="text-muted"><i class="fa-regular fa-envelope me-1 text-brand"></i><?= ViewHelper::e($app['applicant_email']) ?></small>
                                        </div>
                                    </div>
                                    <?php
                                    $statusLabel = ucwords(str_replace('_', ' ', $app['status'] ?? 'pending'));
                                    $badgeClass = match($app['status'] ?? '') {
                                        'approved' => 'badge-success',
                                        'under_review', 'pending' => 'badge-amber',
                                        'rejected', 'declined' => 'badge-danger',
                                        default => 'badge-neutral'
                                    };
                                    ?>
                                    <span class="admin-badge <?= $badgeClass ?> text-uppercase" style="font-size: 10px;"><?= $statusLabel ?></span>
                                </div>
                                <div class="bg-light p-2 px-3 rounded-3 small mb-2 d-flex justify-content-between align-items-center flex-nowrap">
                                    <span class="text-muted text-nowrap"><i class="fa-solid fa-paw text-brand me-1"></i> Applied for:</span>
                                    <strong class="text-brand text-truncate ms-2"><?= ViewHelper::e($app['pet_name']) ?> (<?= ViewHelper::e($app['pet_breed'] ?: 'Mixed') ?>)</strong>
                                </div>
                                <div class="pt-2 border-top">
                                    <a href="<?= ViewHelper::url('admin/adoption') ?>" class="btn btn-sm btn-outline-brand rounded-pill w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold" style="min-height: 42px; font-size: 13px;">
                                        <i class="fa-solid fa-file-signature"></i>
                                        <span>Triage Application</span>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Real-time Activity Feed -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-clock-rotate-left text-brand"></i>
            <span>Real-time Administrative Audit Feed</span>
        </h3>
        <a href="<?= ViewHelper::url('admin/security') ?>" class="btn btn-sm btn-light rounded-pill">Audit Trail</a>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Operator</th>
                        <th>Action Performed</th>
                        <th>Target Entity</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentAuditLogs as $log): ?>
                        <tr>
                            <td><small class="text-muted"><?= ViewHelper::e($log['created_at']) ?></small></td>
                            <td><span class="fw-bold"><?= ViewHelper::e($log['user_name'] ?? 'System Core') ?></span></td>
                            <td><span class="badge bg-light text-dark border font-monospace"><?= ViewHelper::e($log['action']) ?></span></td>
                            <td><?= ViewHelper::e($log['entity_type'] ?? '—') ?> #<?= ViewHelper::e($log['entity_id'] ?? '0') ?></td>
                            <td><small class="text-muted font-monospace"><?= ViewHelper::e($log['ip_address'] ?? '127.0.0.1') ?></small></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
