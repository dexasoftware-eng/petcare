<?php
use Helpers\ViewHelper;

$totalReports = $stats['totalReports'] ?? count($reports);
$pendingReports = $stats['pendingReports'] ?? 0;
$resolvedReports = $stats['resolvedReports'] ?? 0;
$totalInquiries = $stats['totalInquiries'] ?? count($inquiries);
?>

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 w-100">
        <div class="page-title-group">
            <h2 class="admin-page-title">
                <i class="fa-solid fa-shield-halved text-brand me-2"></i>
                Moderation & User Reports
            </h2>
            <p class="admin-page-subtitle">
                Community safety governance, reported reviews, spam filtering, and customer support inquiries.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2 rounded-pill fw-semibold" style="font-size: 13px;">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> <?= $pendingReports ?> Action Items Pending
            </span>
        </div>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Flagged Reports</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-flag"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalReports) ?></div>
            <div class="stat-card-footer text-muted">
                User Moderation Cases
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Pending Triage</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-clock-rotate-left text-danger"></i>
                </div>
            </div>
            <div class="stat-card-value text-danger"><?= number_format($pendingReports) ?></div>
            <div class="stat-card-footer text-danger fw-bold">
                <i class="fa-solid fa-circle-exclamation me-1"></i> Requires Review
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Support Inquiries</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-headset text-primary"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalInquiries) ?></div>
            <div class="stat-card-footer text-muted">
                Contact Messages
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Resolved / Settled</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check text-success"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($resolvedReports) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-shield-check me-1"></i> Closed & Archived
            </div>
        </div>
    </div>
</div>

<!-- Tabs Card -->
<div class="admin-card">
    <div class="admin-card-header border-bottom bg-white p-3">
        <ul class="nav nav-pills gap-2" id="moderationTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" data-bs-toggle="tab" data-bs-target="#reports-pane" style="font-size: 13.5px;">
                    <i class="fa-solid fa-flag text-danger"></i>
                    <span>User Flagged Content</span>
                    <span class="badge bg-light text-dark rounded-pill border ms-1"><?= count($reports) ?></span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" data-bs-toggle="tab" data-bs-target="#inquiries-pane" style="font-size: 13.5px;">
                    <i class="fa-solid fa-headset text-primary"></i>
                    <span>Support & Inquiries</span>
                    <span class="badge bg-light text-dark rounded-pill border ms-1"><?= count($inquiries) ?></span>
                </button>
            </li>
        </ul>
    </div>
    <div class="admin-card-body p-0">
        <div class="tab-content">
            
            <!-- Flagged Content Tab Pane -->
            <div class="tab-pane fade show active" id="reports-pane">
                <?php if (empty($reports)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-circle-check text-success fa-3x mb-3 d-block"></i>
                        <h5>No active moderation flags or reported content!</h5>
                        <p class="small text-muted mb-0">The community review feeds and comments are completely clean.</p>
                    </div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Flagged Item</th>
                                    <th>Report Reason & Detail</th>
                                    <th>Reporter</th>
                                    <th>Status</th>
                                    <th>Reported Date</th>
                                    <th style="text-align: right;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reports as $r): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold text-danger" style="width: 38px; height: 38px; min-width: 38px; background: #fee2e2; font-size: 14px;">
                                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                                </div>
                                                <div>
                                                    <span class="badge bg-light text-dark border text-uppercase" style="font-size: 10.5px;"><?= ViewHelper::e($r['entity_type']) ?></span>
                                                    <div class="fw-bold text-dark" style="font-size: 13.5px;">ID #<?= ViewHelper::e($r['entity_id']) ?></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="fw-bold text-dark" style="font-size: 13.5px;">
                                                <i class="fa-solid fa-tag text-danger me-1 small"></i> <?= ViewHelper::e($r['reason']) ?>
                                            </div>
                                            <small class="text-muted text-truncate d-block" style="max-width: 360px; font-size: 12px;">
                                                <?= ViewHelper::e($r['details'] ?: 'No additional explanation provided.') ?>
                                            </small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="admin-avatar-pill" style="width: 28px; height: 28px; font-size: 11px; background: #64748b;">
                                                    <?= strtoupper(substr($r['reporter_name'] ?? 'U', 0, 1)) ?>
                                                </div>
                                                <span class="fw-semibold text-dark small"><?= ViewHelper::e($r['reporter_name'] ?? 'Community Member') ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= $r['status'] ?>">
                                                <?= ucfirst(ViewHelper::e($r['status'])) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <small class="text-muted fw-semibold"><?= date('M d, Y', strtotime($r['created_at'])) ?></small>
                                        </td>
                                        <td style="text-align: right;">
                                            <?php if ($r['status'] === 'pending'): ?>
                                                <div class="d-inline-flex gap-1">
                                                    <button class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold" onclick="openResolveModal('<?= ViewHelper::url("admin/moderation/{$r['id']}/resolve") ?>', '<?= ViewHelper::e($r['reason']) ?>')">
                                                        <i class="fa-solid fa-check me-1"></i> Resolve
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-1 fw-semibold" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/moderation/{$r['id']}/resolve") ?>', 'Dismiss Report', 'Are you sure you want to dismiss this report as not actionable?', 'Dismiss Report', 'btn-secondary', 'dismissed')">
                                                        <i class="fa-solid fa-ban me-1"></i> Dismiss
                                                    </button>
                                                </div>
                                            <?php else: ?>
                                                <div class="small text-muted">
                                                    <i class="fa-solid fa-circle-check text-success me-1"></i>
                                                    <?= ViewHelper::e($r['resolution_notes'] ?: 'Resolved by admin') ?>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Support Inquiries Tab Pane -->
            <div class="tab-pane fade" id="inquiries-pane">
                <?php if (empty($inquiries)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-headset fa-3x mb-3 text-muted d-block"></i>
                        <h5>No support inquiries found.</h5>
                    </div>
                <?php else: ?>
                    <div class="admin-table-container">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Sender Details</th>
                                    <th>Subject</th>
                                    <th>Message Inquiry</th>
                                    <th>Status</th>
                                    <th style="text-align: right;">Received Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($inquiries as $inq): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="admin-avatar-pill" style="width: 32px; height: 32px; font-size: 12px; background: #3b82f6;">
                                                    <?= strtoupper(substr($inq['name'] ?? 'U', 0, 1)) ?>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 13.5px;"><?= ViewHelper::e($inq['name']) ?></div>
                                                    <small class="text-muted" style="font-size: 11.5px;"><?= ViewHelper::e($inq['email']) ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 12px; border-radius: 6px;">
                                                <?= ViewHelper::e($inq['subject'] ?: 'General Support') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-dark" style="max-width: 400px; font-size: 13px;">
                                                <?= ViewHelper::e($inq['message']) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= ($inq['status'] ?? 'pending') === 'resolved' ? 'active' : 'pending' ?>">
                                                <?= ucfirst(ViewHelper::e($inq['status'] ?? 'pending')) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <small class="text-muted fw-semibold"><?= date('M d, Y', strtotime($inq['created_at'])) ?></small>
                                        </td>
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

<!-- Resolution Modal -->
<div class="modal fade" id="resolveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark">
                    <i class="fa-solid fa-shield-check text-success me-2"></i> Resolve Moderation Case
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="resolveForm" action="" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="status" value="resolved">
                <div class="modal-body py-3">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Issue Summary</label>
                        <input type="text" class="form-control rounded-3 bg-light" id="resolveIssueText" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Resolution Notes / Action Taken *</label>
                        <textarea name="resolution_notes" class="form-control rounded-3" rows="3" required placeholder="e.g. Content reviewed and removed, warning issued to user."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success rounded-pill px-4 fw-semibold">Mark Resolved</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openResolveModal(actionUrl, reason) {
        document.getElementById('resolveForm').action = actionUrl;
        document.getElementById('resolveIssueText').value = reason;
        var modal = new bootstrap.Modal(document.getElementById('resolveModal'));
        modal.show();
    }
</script>
