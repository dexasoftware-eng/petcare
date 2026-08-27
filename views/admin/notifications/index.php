<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Broadcast Notification Center</h2>
        <p class="admin-page-subtitle">Multi-channel platform announcements, clinical alerts, and emergency notifications.</p>
    </div>
</div>

<div class="row g-4">
    <!-- Broadcast Form -->
    <div class="col-lg-5">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-bullhorn text-brand"></i> Dispatch Notification</h3>
            </div>
            <div class="admin-card-body">
                <form action="<?= ViewHelper::url('admin/notifications/broadcast') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Target Audience *</label>
                        <select name="audience" class="form-select rounded-3" required>
                            <option value="everyone">All Users & Providers (Everyone)</option>
                            <option value="petowner">Pet Owners Only</option>
                            <option value="veterinarian">Verified Veterinarians Only</option>
                            <option value="shelter">Rescue Shelters Only</option>
                            <option value="admin">Administrators Only</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Priority Level *</label>
                        <select name="priority" class="form-select rounded-3" required>
                            <option value="normal">Normal (Standard Info)</option>
                            <option value="high">High (Action Required)</option>
                            <option value="urgent">Urgent (Immediate Safety Alert)</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notification Title *</label>
                        <input type="text" name="title" class="form-control rounded-3" required placeholder="e.g. Scheduled Maintenance Notice">
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Notification Message *</label>
                        <textarea name="message" class="form-control rounded-3" rows="4" required placeholder="Detailed announcement copy..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Action URL (Optional)</label>
                        <input type="text" name="action_url" class="form-control rounded-3" placeholder="/portal/appointments">
                    </div>

                    <button type="submit" class="btn btn-brand w-100 rounded-pill py-2 fw-bold">
                        <i class="fa-solid fa-paper-plane me-2"></i> Send Broadcast
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="col-lg-7">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title"><i class="fa-solid fa-history text-primary"></i> Broadcast Dispatch History</h3>
            </div>
            <div class="admin-card-body p-0">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Audience</th>
                                <th>Announcement</th>
                                <th>Priority</th>
                                <th>Dispatched</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($history as $notif): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-light text-dark border text-uppercase" style="font-size: 11px;">
                                            <?= ViewHelper::e($notif['audience']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($notif['title']) ?></div>
                                        <small class="text-muted"><?= ViewHelper::e(substr($notif['message'], 0, 60)) ?>...</small>
                                    </td>
                                    <td>
                                        <?php if ($notif['priority'] === 'urgent'): ?>
                                            <span class="badge bg-danger">Urgent</span>
                                        <?php elseif ($notif['priority'] === 'high'): ?>
                                            <span class="badge bg-warning text-dark">High</span>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border">Normal</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><small class="text-muted"><?= date('M d, Y H:i', strtotime($notif['created_at'])) ?></small></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
