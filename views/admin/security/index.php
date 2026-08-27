<?php
use Helpers\ViewHelper;

$totalLogs = $stats['totalLogs'] ?? count($logs);
$todayEvents = $stats['todayEvents'] ?? 0;
$authEvents = $stats['authEvents'] ?? 0;
$adminActions = $stats['adminActions'] ?? 0;
?>

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 w-100">
        <div class="page-title-group">
            <h2 class="admin-page-title">
                <i class="fa-solid fa-shield-halved text-brand me-2"></i>
                Security, Governance & Audit Trail
            </h2>
            <p class="admin-page-subtitle">
                Immutable access telemetry, administrative modifications, authentication logs, and role authorizations.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2 rounded-pill fw-semibold" style="font-size: 13px;">
                <i class="fa-solid fa-circle-check me-1"></i> Audit Engine Active
            </span>
        </div>
    </div>
</div>

<!-- 4 Top Metric KPI Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Audited Events</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalLogs) ?></div>
            <div class="stat-card-footer text-muted">
                Immutable Database Logs
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Today's Activity</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-calendar-day text-primary"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($todayEvents) ?></div>
            <div class="stat-card-footer text-primary fw-bold">
                <i class="fa-solid fa-bolt me-1"></i> Live Session Stream
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Auth & Sessions</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-key text-success"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($authEvents) ?></div>
            <div class="stat-card-footer text-muted">
                Logins & Signouts
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Admin Modifications</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-user-shield text-purple"></i>
                </div>
            </div>
            <div class="stat-card-value text-dark"><?= number_format($adminActions) ?></div>
            <div class="stat-card-footer text-muted">
                Privileged Operations
            </div>
        </div>
    </div>
</div>

<!-- Security Audit Log Table Card -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-clock-rotate-left text-brand me-2"></i> System Audit Event Stream
        </h3>
        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
            Latest <?= count($logs) ?> Events
        </span>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($logs)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-shield fa-3x mb-3 text-muted d-block"></i>
                <h5>No audit logs recorded in this period.</h5>
            </div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>User / Operator</th>
                            <th>Role</th>
                            <th>Action Logged</th>
                            <th>Target Model</th>
                            <th>IP Address</th>
                            <th style="text-align: right;">Payload / Context</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <?php
                            $action = $log['action'] ?? 'SYSTEM_EVENT';
                            $actionClass = 'bg-secondary text-white';
                            if (str_contains($action, 'LOGIN')) $actionClass = 'bg-primary-subtle text-primary border border-primary-subtle';
                            elseif (str_contains($action, 'LOGOUT')) $actionClass = 'bg-light text-dark border';
                            elseif (str_contains($action, 'UPDATE') || str_contains($action, 'TOGGLE')) $actionClass = 'bg-warning-subtle text-dark border border-warning-subtle';
                            elseif (str_contains($action, 'DELETE') || str_contains($action, 'REVOKE')) $actionClass = 'bg-danger-subtle text-danger border border-danger-subtle';
                            elseif (str_contains($action, 'ADMIN') || str_contains($action, 'APPROVE')) $actionClass = 'bg-success-subtle text-success border border-success-subtle';
                            ?>
                            <tr>
                                <td>
                                    <div class="fw-semibold text-dark" style="font-size: 12.5px;">
                                        <i class="fa-regular fa-clock text-muted me-1"></i>
                                        <?= date('M d, Y', strtotime($log['created_at'])) ?>
                                    </div>
                                    <small class="text-muted font-monospace" style="font-size: 11px;"><?= date('H:i:s T', strtotime($log['created_at'])) ?></small>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="admin-avatar-pill" style="width: 32px; height: 32px; font-size: 12px; background: #475569;">
                                            <?= strtoupper(substr($log['user_name'] ?? 'S', 0, 1)) ?>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px;"><?= ViewHelper::e($log['user_name'] ?? 'System Core') ?></div>
                                            <small class="text-muted" style="font-size: 11.5px;"><?= ViewHelper::e($log['user_email'] ?? 'system@petguard.internal') ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border text-uppercase px-2 py-1" style="font-size: 10.5px; border-radius: 6px;">
                                        <?= ViewHelper::e($log['user_role'] ?? 'SYSTEM') ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge <?= $actionClass ?> font-monospace px-2 py-1" style="font-size: 11px; border-radius: 6px; letter-spacing: 0.2px;">
                                        <?= ViewHelper::e($action) ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark" style="font-size: 13px;">
                                        <?= ViewHelper::e($log['entity_type'] ?: '—') ?>
                                        <?php if ($log['entity_id']): ?>
                                            <span class="badge bg-light text-secondary border font-monospace ms-1" style="font-size: 10.5px;">#<?= ViewHelper::e($log['entity_id']) ?></span>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-muted border font-monospace px-2 py-1" style="font-size: 11px; border-radius: 6px;">
                                        <?= ViewHelper::e($log['ip_address'] ?? '127.0.0.1') ?>
                                    </span>
                                </td>
                                <td style="text-align: right;">
                                    <?php if (!empty($log['details'])): ?>
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 font-monospace" style="font-size: 11px;" onclick="viewPayloadModal(<?= htmlspecialchars(json_encode($log['details']), ENT_QUOTES, 'UTF-8') ?>)">
                                            <i class="fa-solid fa-code me-1 text-primary"></i> View JSON
                                        </button>
                                    <?php else: ?>
                                        <small class="text-muted">—</small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- JSON Payload Modal -->
<div class="modal fade" id="payloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="fa-solid fa-code text-primary me-2"></i> Audit Event Payload
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body py-3">
                <pre class="bg-light p-3 rounded-3 border font-monospace small mb-0" id="payloadContent" style="max-height: 280px; overflow-y: auto;"></pre>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewPayloadModal(details) {
    try {
        var parsed = typeof details === 'string' ? JSON.parse(details) : details;
        document.getElementById('payloadContent').textContent = JSON.stringify(parsed, null, 2);
    } catch(e) {
        document.getElementById('payloadContent').textContent = details || 'No additional payload';
    }
    var modal = new bootstrap.Modal(document.getElementById('payloadModal'));
    modal.show();
}
</script>
