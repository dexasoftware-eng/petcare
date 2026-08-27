<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-brain text-purple me-2"></i> AI & Intelligence Hub</h2>
        <p class="admin-page-subtitle">OpenRouter LLM integrations, real-time latency telemetry, emergency detection logs, and Care Score engines.</p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('admin/ai/assistant') ?>" class="btn-admin-primary">
            <i class="fa-solid fa-robot"></i> Open AI Assistant Sandbox
        </a>
    </div>
</div>

<!-- AI Telemetry Grid -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total AI Queries</span>
                <div class="stat-card-icon icon-purple"><i class="fa-solid fa-microchip"></i></div>
            </div>
            <div class="stat-card-value"><?= number_format($stats['totalRequests']) ?></div>
            <div class="stat-card-footer text-muted">OpenRouter Gateway</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Emergencies Triaged</span>
                <div class="stat-card-icon icon-red"><i class="fa-solid fa-shield-virus"></i></div>
            </div>
            <div class="stat-card-value text-danger"><?= number_format($stats['emergenciesDetected']) ?></div>
            <div class="stat-card-footer text-danger fw-bold">Safety Fast-Path Triggered</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Average Latency</span>
                <div class="stat-card-icon icon-blue"><i class="fa-solid fa-bolt"></i></div>
            </div>
            <div class="stat-card-value"><?= $stats['avgLatency'] ?> ms</div>
            <div class="stat-card-footer text-success fw-bold">Optimized Pipeline</div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Model Reliability</span>
                <div class="stat-card-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
            </div>
            <div class="stat-card-value"><?= $stats['successRate'] ?>%</div>
            <div class="stat-card-footer text-muted">Fallback Redundancy Active</div>
        </div>
    </div>
</div>

<!-- AI Usage Logs Table -->
<div class="admin-card">
    <div class="admin-card-header">
        <h3 class="admin-card-title"><i class="fa-solid fa-list-check text-brand"></i> Real-time AI Query Audit Stream</h3>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($logs)): ?>
            <div class="p-4 text-center text-muted">No AI queries recorded yet. Launch the sandbox to run live tests.</div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Query Type</th>
                            <th>Model Provider</th>
                            <th>Prompt Preview</th>
                            <th>Safety Status</th>
                            <th>Latency</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td><small class="text-muted"><?= ViewHelper::e($log['created_at']) ?></small></td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($log['query_type']) ?></span></td>
                                <td><code class="text-dark"><?= ViewHelper::e($log['model']) ?></code></td>
                                <td>
                                    <small class="text-dark fw-semibold"><?= ViewHelper::e($log['prompt_preview']) ?>...</small>
                                </td>
                                <td>
                                    <?php if ($log['safety_status'] === 'emergency'): ?>
                                        <span class="badge bg-danger text-uppercase">Emergency Triage</span>
                                    <?php else: ?>
                                        <span class="badge bg-success text-uppercase">Safe</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= (int)$log['latency_ms'] ?> ms</td>
                                <td><span class="badge-status status-<?= $log['status'] === 'success' ? 'active' : 'suspended' ?>"><?= ViewHelper::e($log['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
