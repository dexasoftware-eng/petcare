<?php
use Helpers\ViewHelper;
?>

<!-- Executive Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); border-radius: 20px; padding: 28px 32px; color: #fff; box-shadow: 0 10px 30px rgba(15, 23, 42, 0.15);">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-user-shield text-warning"></i>
            <span>Platform Governance & Oversight</span>
            <span class="text-white-50">&middot;</span>
            <span class="badge bg-success text-white px-2 py-0" style="font-size: 10px;">Systems Healthy</span>
        </div>
        <h2 class="h3 fw-bold text-white mb-1">Executive Command Center <i class="fa-solid fa-bolt text-warning ms-1"></i></h2>
        <p class="text-white-50 mb-0 small">Real-time telemetry, multi-role verification queues & ecosystem operations.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/notifications') ?>" class="btn btn-light rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-2" style="font-size: 13px;">
            <i class="fa-solid fa-bullhorn text-primary"></i>
            <span>Broadcast Alert</span>
        </a>
        <a href="<?= ViewHelper::url('admin/emergency') ?>" class="btn btn-outline-danger rounded-pill px-3 py-2 fw-semibold d-flex align-items-center gap-2" style="font-size: 13px; background: rgba(239,68,68,0.15); border-color: #ef4444; color: #fff;">
            <i class="fa-solid fa-truck-medical"></i>
            <span>Emergency Center</span>
        </a>
    </div>
</div>

<!-- Primary Metric KPI Cards Grid -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Users</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalUsers'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="text-success fw-bold"><i class="fa-solid fa-paw"></i> <?= $kpi['totalOwners'] ?? 0 ?></span> Pet Parents Active
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Verified Vets</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalVets'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingVets'] ?? 0 ?> Pending Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Rescue Shelters</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-house-medical"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalShelters'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingShelters'] ?? 0 ?> Pending Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Registered Pets</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-shield-cat"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['totalPets'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="text-primary fw-bold"><?= $kpi['activePets'] ?? 0 ?></span> Passports Active
            </div>
        </div>
    </div>
</div>

<!-- Secondary Operational Metrics -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Monthly Appointments</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($kpi['monthlyAppointments'] ?? 0) ?></div>
            <div class="stat-card-footer text-muted">
                Current billing cycle
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Adoption Success Rate</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-heart"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['adoptionRate'] ?? 0 ?>%</div>
            <div class="stat-card-footer">
                <span class="badge bg-warning text-dark"><?= $kpi['pendingAdoptions'] ?? 0 ?> Under Review</span>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Marketplace Revenue</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
            <div class="stat-card-value">$<?= number_format($kpi['marketplaceRevenue'] ?? 0, 2) ?></div>
            <div class="stat-card-footer text-muted">
                <?= $kpi['paidOrdersCount'] ?? 0 ?> Orders Processed
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Platform Alerts</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= ($kpi['activeEmergencies'] ?? 0) + ($kpi['openReports'] ?? 0) ?></div>
            <div class="stat-card-footer">
                <span class="text-danger fw-bold"><?= $kpi['activeEmergencies'] ?? 0 ?> Emergencies</span> &middot; <?= $kpi['lowStockProducts'] ?? 0 ?> Low Stock
            </div>
        </div>
    </div>
</div>

<!-- Pending Approvals & Telemetry Section -->
<div class="row g-4 mb-4">
    <!-- Pending Vet Approvals -->
    <div class="col-xl-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title"><i class="fa-solid fa-user-doctor text-primary me-2"></i> Pending Clinical Approvals</h3>
                <a href="<?= ViewHelper::url('admin/veterinarians') ?>" class="small text-decoration-none fw-bold" style="color: #fa441d;">View All &rarr;</a>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Doctor</th>
                                <th>Specialization</th>
                                <th>Phone</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pendingVetsList)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-circle-check text-success fs-4 d-block mb-1"></i>
                                        No pending veterinary applications in queue.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pendingVetsList as $v): ?>
                                    <tr>
                                        <td>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($v['name']) ?></div>
                                            <small class="text-muted"><?= ViewHelper::e($v['clinic_name'] ?? 'Private Practice') ?></small>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($v['specialization'] ?? 'General') ?></span></td>
                                        <td><small><?= ViewHelper::e($v['phone'] ?? '—') ?></small></td>
                                        <td>
                                            <a href="<?= ViewHelper::url("admin/veterinarians/{$v['id']}") ?>" class="btn-admin-action">
                                                <i class="fa-solid fa-clipboard-check text-primary"></i> Review
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Adoption Applications Pipeline -->
    <div class="col-xl-6">
        <div class="admin-card h-100 mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title"><i class="fa-solid fa-heart text-danger me-2"></i> Adoption Pipeline Queue</h3>
                <a href="<?= ViewHelper::url('admin/adoption') ?>" class="small text-decoration-none fw-bold" style="color: #fa441d;">View Hub &rarr;</a>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Applicant</th>
                                <th>Adoptable Pet</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recentAdoptions)): ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-paw text-muted fs-4 d-block mb-1"></i>
                                        No active adoption applications.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($recentAdoptions as $app): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; min-width: 32px; font-size: 11px;">
                                                    <?= strtoupper(substr($app['applicant_name'] ?? 'U', 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark"><?= ViewHelper::e($app['applicant_name'] ?? 'Applicant') ?></div>
                                                    <small class="text-muted"><?= ViewHelper::e($app['applicant_email'] ?? '') ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-semibold text-dark"><i class="fa-solid fa-paw text-brand me-1"></i> <?= ViewHelper::e($app['pet_name'] ?? 'Pet') ?></div>
                                            <small class="text-muted"><?= ViewHelper::e($app['breed'] ?? '') ?></small>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= $app['status'] ?? 'pending' ?>"><?= strtoupper(str_replace('_', ' ', $app['status'] ?? 'pending')) ?></span>
                                        </td>
                                        <td>
                                            <a href="<?= ViewHelper::url("admin/adoption/{$app['id']}") ?>" class="btn-admin-action">
                                                <i class="fa-solid fa-file-signature text-warning"></i> Triage
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Ecosystem Audit Trail -->
<div class="admin-card mb-0">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title"><i class="fa-solid fa-shield-halved text-success me-2"></i> Security & Audit Trail</h3>
        <a href="<?= ViewHelper::url('admin/security') ?>" class="btn btn-sm btn-light border rounded-pill px-3">Full Audit Trail</a>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Operator</th>
                        <th>Action Performed</th>
                        <th>Target Entity</th>
                        <th>IP Address</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($auditLogs)): ?>
                        <tr><td colspan="5" class="text-center py-4 text-muted">No recent audit logs available.</td></tr>
                    <?php else: ?>
                        <?php foreach ($auditLogs as $log): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="rounded-circle bg-light border d-flex align-items-center justify-content-center text-danger fw-bold" style="width: 32px; height: 32px; min-width: 32px; font-size: 11px;">
                                            <?= strtoupper(substr($log['user_name'] ?? 'A', 0, 1)) ?>
                                        </div>
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($log['user_name'] ?? 'Administrator') ?></div>
                                    </div>
                                </td>
                                <td>
                                    <code class="px-2 py-1 bg-light rounded text-dark border" style="font-size: 11.5px;"><?= ViewHelper::e($log['action']) ?></code>
                                </td>
                                <td><span class="text-muted small"><?= ViewHelper::e($log['entity_type']) ?> #<?= ViewHelper::e($log['entity_id']) ?></span></td>
                                <td><span class="text-muted small"><?= ViewHelper::e($log['ip_address'] ?? '::1') ?></span></td>
                                <td><small class="text-muted"><?= date('M d, Y · H:i:s', strtotime($log['created_at'])) ?></small></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
