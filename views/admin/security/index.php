<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-lock text-brand me-2"></i> Security, Governance & Audit Trail</h2>
        <p class="admin-page-subtitle">Immutable access logs, sensitive entity modifications, credential changes, and role assertions.</p>
    </div>
</div>

<!-- Security Audit Log Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-shield-halved text-brand"></i> System Audit Stream (Last 50 Events)</h3>
    </div>
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Timestamp (UTC)</th>
                        <th>User / Operator</th>
                        <th>Role</th>
                        <th>Action Logged</th>
                        <th>Target Model</th>
                        <th>IP Address</th>
                        <th>Details Payload</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($logs as $log): ?>
                        <tr>
                            <td><small class="text-muted font-monospace"><?= ViewHelper::e($log['created_at']) ?></small></td>
                            <td>
                                <div class="fw-bold text-dark"><?= ViewHelper::e($log['user_name'] ?? 'System Core') ?></div>
                                <small class="text-muted"><?= ViewHelper::e($log['user_email'] ?? '') ?></small>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border text-uppercase" style="font-size: 10px;">
                                    <?= ViewHelper::e($log['user_role'] ?? 'SYSTEM') ?>
                                </span>
                            </td>
                            <td><span class="badge bg-dark font-monospace text-light"><?= ViewHelper::e($log['action']) ?></span></td>
                            <td>
                                <span class="fw-semibold"><?= ViewHelper::e($log['entity_type'] ?: '—') ?></span>
                                <?php if ($log['entity_id']): ?>
                                    <small class="text-muted">#<?= ViewHelper::e($log['entity_id']) ?></small>
                                <?php endif; ?>
                            </td>
                            <td><small class="font-monospace text-muted"><?= ViewHelper::e($log['ip_address'] ?? '127.0.0.1') ?></small></td>
                            <td>
                                <small class="font-monospace text-muted" style="max-width: 250px; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                    <?= ViewHelper::e($log['details'] ?: '—') ?>
                                </small>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
