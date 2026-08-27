<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Moderation & User Reports</h2>
        <p class="admin-page-subtitle">User-flagged content, review moderation, spam filtering, and inquiry resolution.</p>
    </div>
</div>

<!-- Moderation Reports Table -->
<div class="admin-card mb-4">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-flag text-danger"></i> User Flagged Content & Reviews (<?= count($reports) ?>)</h3>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($reports)): ?>
            <div class="p-4 text-center text-muted">
                <i class="fa-solid fa-circle-check text-success fs-3 mb-2 d-block"></i>
                No active moderation flags or reported content.
            </div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Flagged Entity</th>
                            <th>Reason</th>
                            <th>Reporter</th>
                            <th>Status</th>
                            <th>Reported On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reports as $r): ?>
                            <tr>
                                <td>
                                    <span class="badge bg-light text-dark border text-uppercase"><?= ViewHelper::e($r['entity_type']) ?></span>
                                    <span class="fw-bold ms-1">#<?= ViewHelper::e($r['entity_id']) ?></span>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark"><?= ViewHelper::e($r['reason']) ?></div>
                                    <small class="text-muted"><?= ViewHelper::e($r['details'] ?: 'No further comment') ?></small>
                                </td>
                                <td><?= ViewHelper::e($r['reporter_name'] ?? 'Anonymous') ?></td>
                                <td><span class="badge-status status-<?= $r['status'] ?>"><?= ViewHelper::e($r['status']) ?></span></td>
                                <td><small class="text-muted"><?= date('M d, Y', strtotime($r['created_at'])) ?></small></td>
                                <td>
                                    <?php if ($r['status'] === 'pending'): ?>
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/moderation/{$r['id']}/resolve") ?>', 'Resolve Report', 'Mark this report as resolved?', 'Mark Resolved', 'btn-success', 'resolved')">
                                            Resolve
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-2" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/moderation/{$r['id']}/resolve") ?>', 'Dismiss Report', 'Dismiss this report as not actionable?', 'Dismiss', 'btn-secondary', 'dismissed')">
                                            Dismiss
                                        </button>
                                    <?php else: ?>
                                        <small class="text-muted"><?= ViewHelper::e($r['resolution_notes'] ?: 'Resolved') ?></small>
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

<!-- Support Inquiries -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-headset text-primary"></i> General Support & Contact Inquiries</h3>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Sender</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inq): ?>
                        <tr>
                            <td>
                                <div class="fw-bold"><?= ViewHelper::e($inq['name']) ?></div>
                                <small class="text-muted"><?= ViewHelper::e($inq['email']) ?></small>
                            </td>
                            <td><?= ViewHelper::e($inq['subject'] ?: 'Support Request') ?></td>
                            <td><small><?= ViewHelper::e($inq['message']) ?></small></td>
                            <td><span class="badge-status status-<?= $inq['status'] ?>"><?= ViewHelper::e($inq['status']) ?></span></td>
                            <td><small class="text-muted"><?= date('M d, Y', strtotime($inq['created_at'])) ?></small></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
