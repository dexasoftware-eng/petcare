<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-store text-brand me-2"></i> Store Branding & Commercial Policies</h2>
        <p class="admin-page-subtitle">Configure merchant store identity, customer shipping policies, and refund guidelines.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="admin-card text-center p-4">
            <div class="avatar-circle mx-auto mb-3 bg-brand text-white fw-bold d-flex align-items-center justify-content-center" style="width: 84px; height: 84px; font-size: 32px; border-radius: 50%;">
                <i class="fa-solid fa-shop"></i>
            </div>
            <h4 class="fw-bold mb-1"><?= ViewHelper::e($profile['store_name'] ?? $user['name']) ?></h4>
            <p class="text-muted small mb-2 font-monospace">Registration: <?= ViewHelper::e($profile['business_registration'] ?? 'TX-BUS-98231') ?></p>
            <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-3">
                <i class="fa-solid fa-certificate me-1"></i> Verified Merchant Partner
            </span>

            <hr class="my-3">

            <div class="text-start small">
                <div class="mb-2"><strong>Merchant Phone:</strong> <?= ViewHelper::e($user['phone'] ?? '+1-555-018-7744') ?></div>
                <div class="mb-2"><strong>Support Email:</strong> <?= ViewHelper::e($user['email']) ?></div>
                <div><strong>Overall Rating:</strong> <span class="text-warning fw-bold">★ <?= number_format((float)($profile['rating'] ?? 4.95), 2) ?></span></div>
            </div>
        </div>
    </div>

    <div class="col-lg-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Merchant Profile</h3>
            </div>
            <div class="admin-card-body">
                <form id="vendorStoreForm" action="<?= ViewHelper::url('vendor/store/edit') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Public Store Name *</label>
                            <input type="text" name="store_name" class="form-control" value="<?= ViewHelper::e($profile['store_name'] ?? $user['name']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Business Registration Number *</label>
                            <input type="text" name="business_registration" class="form-control font-monospace" value="<?= ViewHelper::e($profile['business_registration'] ?? 'TX-BUS-98231') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Merchant Direct Phone *</label>
                        <input type="text" name="phone" class="form-control" value="<?= ViewHelper::e($user['phone']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Store Description & Brand Mission *</label>
                        <textarea name="description" class="form-control" rows="3" required><?= ViewHelper::e($profile['description'] ?? 'Direct manufacturer and certified organic pet nutrition, orthopedic beds, interactive toys, and veterinary-grade supplements.') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Shipping & Fulfillment Terms</label>
                        <textarea name="shipping_policy" class="form-control" rows="2"><?= ViewHelper::e($profile['shipping_policy'] ?? 'Free express shipping on all orders over $49. 2-day delivery across continental US.') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Refund & Exchange Policy</label>
                        <textarea name="refund_policy" class="form-control" rows="2"><?= ViewHelper::e($profile['refund_policy'] ?? '30-day hassle-free returns on unopened items.') ?></textarea>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-admin-primary rounded-pill px-5">
                            <i class="fa-solid fa-check me-1"></i> Save Store Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vendorStoreForm', {
        loadingText: 'Saving Store Settings...',
        reload: true
    });
});
</script>
