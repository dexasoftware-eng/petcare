<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-gear text-warning"></i>
            <span>Global Ecosystem Engine</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning">PHP <?= phpversion() ?></span>
        </div>
        <h2 class="portal-hero-title">Platform Settings &amp; Configuration ⚙️</h2>
        <p class="portal-hero-subtitle">
            Ecosystem parameters, AI engine configuration, emergency hotlines, and security policies.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('admin/dashboard') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-gauge-high"></i>
            <span>Command Center</span>
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Platform Config Form -->
    <div class="col-lg-6">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-sliders text-brand"></i> Application Parameters</h3>
            </div>
            <div class="admin-card-body">
                <form action="<?= ViewHelper::url('admin/settings') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Platform Brand Name</label>
                        <input type="text" name="app_name" class="form-control rounded-3" value="<?= ViewHelper::e($config['app_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Application Base URL</label>
                        <input type="text" name="app_url" class="form-control rounded-3 font-monospace" value="<?= ViewHelper::e($config['app_url']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Environment Mode</label>
                        <input type="text" class="form-control rounded-3 bg-light" value="<?= ViewHelper::e($config['app_env']) ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Session Lifetime (Seconds)</label>
                        <input type="number" class="form-control rounded-3 bg-light" value="<?= (int)($config['session']['lifetime'] ?? 604800) ?>" readonly>
                    </div>

                    <button type="submit" class="btn btn-brand rounded-pill px-4 fw-bold">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Save Settings
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- AI & Gateway Configurations -->
    <div class="col-lg-6">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-brain text-purple"></i> AI Intelligence Gateway (OpenRouter)</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Provider Engine</label>
                    <div class="fw-bold text-dark">OpenRouter Unified API Gateway</div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Active Model</label>
                    <div class="p-2 px-3 bg-light rounded-3 font-monospace text-primary border">
                        <?= ViewHelper::e($config['ai']['model'] ?? 'meta-llama/llama-3.2-3b-instruct:free') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">API Gateway Base URL</label>
                    <div class="p-2 px-3 bg-light rounded-3 font-monospace small text-dark border">
                        <?= ViewHelper::e($config['ai']['base_url'] ?? 'https://openrouter.ai/api/v1') ?>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Key Security</label>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-success"><i class="fa-solid fa-shield-check me-1"></i> Key Configured in .env</span>
                        <small class="text-muted">Zero client-side key leakage</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-phone-volume text-danger"></i> Emergency Hotline & Triage Center</h3>
            </div>
            <div class="admin-card-body">
                <div class="mb-2"><strong>Emergency 24/7 Hotline:</strong> <code class="fs-6 text-danger">+1 (800) 555-FUR-911</code></div>
                <div class="mb-2"><strong>Triage Response SLA:</strong> Under 3 Minutes</div>
                <div class="mb-0"><strong>Emergency Routing:</strong> Nearest Licensed Veterinary Emergency Hospital</div>
            </div>
        </div>
    </div>
</div>
