<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-store text-brand me-2"></i> <?= ViewHelper::e($vendor['store_name']) ?></h2>
        <p class="admin-page-subtitle">Merchant Business Registration: <span class="font-monospace fw-bold text-dark"><?= ViewHelper::e($vendor['business_registration'] ?? 'TX-BUS-98231') ?></span></p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('admin/vendors') ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="fa-solid fa-arrow-left me-1"></i> Back to Vendors
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Left Column: Verification Action -->
    <div class="col-lg-4">
        <div class="admin-card mb-4 text-center p-4">
            <div class="avatar-circle mx-auto mb-3 bg-brand text-white fw-bold d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; font-size: 32px; border-radius: 50%;">
                <i class="fa-solid fa-shop"></i>
            </div>
            <h4 class="fw-bold mb-1"><?= ViewHelper::e($vendor['store_name']) ?></h4>
            <p class="text-muted small mb-3"><?= ViewHelper::e($vendor['email']) ?></p>

            <div class="text-start small border-top pt-3">
                <div class="mb-2"><strong>Tax / Business ID:</strong> <?= ViewHelper::e($vendor['business_registration']) ?></div>
                <div class="mb-2"><strong>Phone:</strong> <?= ViewHelper::e($vendor['phone']) ?></div>
                <div class="mb-2"><strong>Rating:</strong> ★ <?= number_format((float)($vendor['rating'] ?? 5.0), 2) ?></div>
                <div><strong>Registered:</strong> <?= date('M d, Y', strtotime($vendor['registered_at'])) ?></div>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-shield-halved text-brand me-2"></i> Verification Decision</h3>
            </div>
            <div class="admin-card-body">
                <form action="<?= ViewHelper::url('admin/vendors/' . $vendor['id'] . '/verification') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Verification Decision</label>
                        <select name="verification_status" class="form-select" required>
                            <option value="approved" <?= $vendor['verification_status'] === 'approved' ? 'selected' : '' ?>>Approve (Active Vendor)</option>
                            <option value="pending" <?= $vendor['verification_status'] === 'pending' ? 'selected' : '' ?>>Pending Additional Docs</option>
                            <option value="rejected" <?= $vendor['verification_status'] === 'rejected' ? 'selected' : '' ?>>Reject Application</option>
                            <option value="suspended" <?= $vendor['verification_status'] === 'suspended' ? 'selected' : '' ?>>Suspend Store</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Rejection / Suspension Reason</label>
                        <textarea name="rejection_reason" class="form-control" rows="3" placeholder="Provide feedback if rejected or suspended..."><?= ViewHelper::e($vendor['rejection_reason'] ?? '') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-admin-primary rounded-pill w-100 py-2">
                        Update Verification Status
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Right Column: Products & Store Information -->
    <div class="col-lg-8">
        <div class="admin-card mb-4">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-file-lines text-brand me-2"></i> Merchant Description & Policies</h3>
            </div>
            <div class="admin-card-body">
                <p class="text-secondary mb-3"><?= nl2br(ViewHelper::e($vendor['description'] ?: 'No store description provided.')) ?></p>
                <div class="p-3 bg-light rounded-3 small">
                    <strong class="d-block text-dark mb-1">Shipping Terms:</strong>
                    <?= ViewHelper::e($vendor['shipping_policy'] ?: 'Standard platform shipping terms.') ?>
                </div>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-tags text-brand me-2"></i> Catalog Items by this Vendor</h3>
                <span class="badge bg-light text-dark border"><?= count($products ?? []) ?> Items</span>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($products)): ?>
                    <div class="p-4 text-center text-muted">No products cataloged by this vendor yet.</div>
                <?php else: ?>
                    <div class="table-responsive m-0">
                        <table class="table table-hover align-middle m-0">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Product Name</th>
                                    <th>Category</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $p): ?>
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark"><?= ViewHelper::e($p['name']) ?></td>
                                        <td><span class="badge bg-light text-secondary border"><?= ViewHelper::e($p['category']) ?></span></td>
                                        <td class="font-monospace small"><?= ViewHelper::e($p['sku']) ?></td>
                                        <td class="fw-bold">$<?= number_format((float)$p['price'], 2) ?></td>
                                        <td><?= (int)$p['stock'] ?> Units</td>
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
