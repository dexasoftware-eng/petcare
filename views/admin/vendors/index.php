<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-store text-brand me-2"></i> Merchant Vendors Network & Verification</h2>
        <p class="admin-page-subtitle">Governance of registered Pet Guard marketplace vendors, merchant licenses, and store status.</p>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-store text-brand me-2"></i> Registered Vendors (<?= count($vendors ?? []) ?>)</h3>
        
        <form method="GET" action="<?= ViewHelper::url('admin/vendors') ?>" class="d-flex gap-2">
            <select name="status" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                <option value="">All Verification Statuses</option>
                <option value="pending" <?= ($selectedStatus ?? '') === 'pending' ? 'selected' : '' ?>>Pending Review</option>
                <option value="approved" <?= ($selectedStatus ?? '') === 'approved' ? 'selected' : '' ?>>Approved / Active</option>
                <option value="rejected" <?= ($selectedStatus ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                <option value="suspended" <?= ($selectedStatus ?? '') === 'suspended' ? 'selected' : '' ?>>Suspended</option>
            </select>
            <input type="text" name="q" class="form-control form-control-sm rounded-pill px-3" placeholder="Search store name..." value="<?= ViewHelper::e($search ?? '') ?>">
            <button type="submit" class="btn btn-sm btn-admin-primary rounded-pill px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($vendors)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-shop fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No vendor stores found</h5>
                <p class="small text-muted">Registered merchant partners will appear here for verification review.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Store / Merchant</th>
                            <th>Tax ID / Reg #</th>
                            <th>Contact Phone</th>
                            <th>Rating</th>
                            <th>Verification Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vendors as $v): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($v['store_name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($v['email']) ?></div>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($v['business_registration'] ?? 'Pending') ?>
                                </td>
                                <td>
                                    <?= ViewHelper::e($v['phone']) ?>
                                </td>
                                <td>
                                    <span class="text-warning fw-bold small">★ <?= number_format((float)($v['rating'] ?? 5.0), 2) ?></span>
                                </td>
                                <td>
                                    <?php
                                    $statusMap = [
                                        'approved' => 'badge-success',
                                        'pending' => 'badge-amber',
                                        'rejected' => 'badge-danger',
                                        'suspended' => 'badge-danger'
                                    ];
                                    ?>
                                    <span class="admin-badge <?= $statusMap[$v['verification_status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 11px;">
                                        <?= ViewHelper::e($v['verification_status']) ?>
                                    </span>
                                </td>
                                <td class="text-end pe-4">
                                    <a href="<?= ViewHelper::url('admin/vendors/' . $v['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                        Review & Governance
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
