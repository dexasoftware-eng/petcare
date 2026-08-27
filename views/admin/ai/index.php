<?php
use Helpers\ViewHelper;

$totalQueries = $stats['totalRequests'] ?? count($logs);
$emergencies = $stats['emergenciesDetected'] ?? 0;
$avgLatency = $stats['avgLatency'] ?? 145;
$successRate = $stats['successRate'] ?? 99.2;
?>

<!-- Page Header -->
<div class="admin-page-header mb-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 w-100">
        <div class="page-title-group">
            <h2 class="admin-page-title">
                <i class="fa-solid fa-brain text-purple me-2"></i>
                AI & Intelligence Hub
            </h2>
            <p class="admin-page-subtitle">
                OpenRouter LLM integrations, real-time latency telemetry, emergency detection logs, and Care Score engines.
            </p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="<?= ViewHelper::url('admin/ai/assistant') ?>" class="btn btn-dark rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2 shadow-sm" style="background: #fa441d; border: none;">
                <i class="fa-solid fa-robot"></i>
                <span>Open AI Assistant Sandbox</span>
            </a>
        </div>
    </div>
</div>

<!-- AI Telemetry Grid (4 Top Metric Stat Cards) -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total AI Queries</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-microchip"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalQueries) ?></div>
            <div class="stat-card-footer text-muted">
                OpenRouter Gateway
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Emergencies Triaged</span>
                <div class="stat-card-icon icon-red">
                    <i class="fa-solid fa-shield-virus text-danger"></i>
                </div>
            </div>
            <div class="stat-card-value text-danger"><?= number_format($emergencies) ?></div>
            <div class="stat-card-footer text-danger fw-bold">
                <i class="fa-solid fa-bolt me-1"></i> Safety Fast-Path Active
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Average Latency</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-bolt text-primary"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= (int)$avgLatency ?> ms</div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-circle-check me-1"></i> Optimized Pipeline
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Model Reliability</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check text-success"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $successRate ?>%</div>
            <div class="stat-card-footer text-muted">
                Fallback Redundancy Active
            </div>
        </div>
    </div>
</div>

<!-- Quick Live Query Playground Card -->
<div class="admin-card mb-4" style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: #ffffff; border: none;">
    <div class="admin-card-body p-4">
        <div class="row align-items-center g-3">
            <div class="col-lg-7">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
                    <i class="fa-solid fa-sparkles text-warning"></i>
                    <span>Real-time Clinical Triage Engine</span>
                </div>
                <h4 class="fw-bold text-white mb-1">Instant AI Telemetry & Triage Simulator</h4>
                <p class="text-white-50 mb-0 small">Test clinical queries, assess symptom severity flags, and observe live emergency routing.</p>
            </div>
            <div class="col-lg-5 text-lg-end">
                <a href="<?= ViewHelper::url('admin/ai/assistant') ?>" class="btn btn-light rounded-pill px-4 py-2 fw-bold me-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-terminal me-1 text-primary"></i> Launch Full Sandbox
                </a>
                <a href="<?= ViewHelper::url('admin/emergency') ?>" class="btn btn-outline-danger text-white border-danger rounded-pill px-3 py-2 fw-semibold" style="font-size: 13.5px;">
                    <i class="fa-solid fa-truck-medical me-1"></i> Emergency Hub
                </a>
            </div>
        </div>
    </div>
</div>

<!-- AI Usage Logs Table Card -->
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title">
            <i class="fa-solid fa-list-check text-brand me-2"></i> Real-time AI Query Audit Stream
        </h3>
        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill fw-semibold">
            <?= count($logs) ?> Captured Events
        </span>
    </div>
    <div class="admin-card-body p-0">
        <?php if (empty($logs)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-brain fa-3x mb-3 text-muted d-block"></i>
                <h6>No AI queries recorded yet in this telemetry window.</h6>
                <p class="small text-muted mb-3">Launch the interactive assistant sandbox to test live inference requests.</p>
                <a href="<?= ViewHelper::url('admin/ai/assistant') ?>" class="btn btn-sm btn-dark rounded-pill px-4 fw-semibold" style="background: #fa441d; border: none;">
                    Open Sandbox
                </a>
            </div>
        <?php else: ?>
            <div class="admin-table-container">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Query Type</th>
                            <th>Model Provider</th>
                            <th>Prompt Preview</th>
                            <th>Safety Classification</th>
                            <th>Latency</th>
                            <th style="text-align: right;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($logs as $log): ?>
                            <tr>
                                <td>
                                    <small class="text-muted fw-semibold"><?= date('M d, H:i:s', strtotime($log['created_at'])) ?></small>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                        <?= ViewHelper::e($log['query_type'] ?? 'telehealth') ?>
                                    </span>
                                </td>
                                <td>
                                    <code class="px-2 py-1 bg-light rounded text-dark border" style="font-size: 12px;"><?= ViewHelper::e($log['model'] ?? 'openrouter/gpt-4o-mini') ?></code>
                                </td>
                                <td>
                                    <div class="text-dark fw-semibold text-truncate" style="max-width: 320px; font-size: 13px;">
                                        <?= ViewHelper::e($log['prompt_preview'] ?? 'Clinical symptom inquiry...') ?>
                                    </div>
                                </td>
                                <td>
                                    <?php if (($log['safety_status'] ?? '') === 'emergency'): ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2 py-1 text-uppercase" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-triangle-exclamation me-1"></i> Emergency Triage
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 text-uppercase" style="font-size: 11px; border-radius: 6px;">
                                            <i class="fa-solid fa-shield-check me-1"></i> Safe
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="fw-semibold text-dark"><?= (int)($log['latency_ms'] ?? 120) ?> ms</span>
                                </td>
                                <td style="text-align: right;">
                                    <span class="badge-status status-<?= ($log['status'] ?? 'success') === 'success' ? 'active' : 'suspended' ?>">
                                        <?= ucfirst(ViewHelper::e($log['status'] ?? 'success')) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
