<?php
use Helpers\ViewHelper;

$profile = $profile ?? [];
$user = $user ?? [];
?>

<div class="vendor-store-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-store text-warning"></i> Merchant Identity &amp; Policies
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Store Branding &amp; Commercial Terms
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Customize your public storefront brand identity, commercial registration, nationwide shipping terms, and customer return policies.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <a href="<?= ViewHelper::url('our-products') ?>" target="_blank" class="btn btn-outline-light rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" style="font-size: 13.5px;">
                    <i class="fa-solid fa-globe"></i>
                    <span>Preview Storefront</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Main Store Configuration Grid -->
    <div class="row g-4 mb-4">
        
        <!-- Left: Store Badge & Credibility Card (col-lg-4) -->
        <div class="col-12 col-lg-4">
            <div class="admin-card text-center p-4 rounded-4 border-0 shadow-sm bg-white mb-4">
                <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold shadow" style="width: 88px; height: 88px; background: linear-gradient(135deg, #fa441d 0%, #ff5722 100%); font-size: 36px;">
                    <i class="fa-solid fa-shop"></i>
                </div>
                <h4 class="fw-bold text-dark mb-1" style="font-family: 'Anybody', sans-serif;">
                    <?= ViewHelper::e($profile['store_name'] ?? $user['name']) ?>
                </h4>
                <p class="text-muted small font-monospace mb-2">
                    Reg: <?= ViewHelper::e($profile['business_registration'] ?? 'TX-BUS-98231') ?>
                </p>
                <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-1 rounded-pill mb-4 fw-bold">
                    <i class="fa-solid fa-certificate me-1"></i> Verified Merchant Partner
                </span>

                <div class="p-3 bg-light rounded-3 text-start small border">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Direct Phone:</span>
                        <strong class="text-dark font-monospace"><?= ViewHelper::e($user['phone'] ?? '+1-555-018-7744') ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Support Email:</span>
                        <strong class="text-dark text-truncate" style="max-width: 160px;"><?= ViewHelper::e($user['email']) ?></strong>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Store Rating:</span>
                        <strong class="text-warning fw-bold">★ <?= number_format((float)($profile['rating'] ?? 4.95), 2) ?> / 5.0</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Orders Fulfilled:</span>
                        <strong class="text-success fw-bold"><?= (int)($profile['total_sales_count'] ?? 142) ?> Items</strong>
                    </div>
                </div>
            </div>

            <!-- Merchant Trust Notice -->
            <div class="p-4 rounded-4 bg-white border shadow-sm">
                <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold small">
                    <i class="fa-solid fa-shield-check text-success fs-5"></i>
                    <span>Compliance &amp; Quality Standards</span>
                </div>
                <p class="text-muted small m-0" style="font-size: 12px; line-height: 1.6;">
                    All vendor listings are verified against veterinary diet guidelines and consumer safety standards before publication on the PetGuard marketplace.
                </p>
            </div>
        </div>

        <!-- Right: Store Edit Form (col-lg-8) -->
        <div class="col-12 col-lg-8">
            <div class="admin-card rounded-4 border-0 shadow-sm bg-white overflow-hidden">
                <div class="admin-card-header p-4 border-bottom bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="fw-bold text-dark m-0" style="font-family: 'Anybody', sans-serif;">
                            <i class="fa-solid fa-pen-to-square text-brand me-2"></i> Update Merchant Profile
                        </h4>
                        <p class="text-muted small m-0 mt-1">Changes are reflected immediately across the public pet store catalog.</p>
                    </div>
                    <span class="badge bg-light text-dark border px-3 py-1 rounded-pill small">Store Details</span>
                </div>

                <div class="admin-card-body p-4 p-md-5">
                    <form id="vendorStoreForm" action="<?= ViewHelper::url('vendor/store/edit') ?>" method="POST">
                        <?= ViewHelper::csrfField() ?>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Public Store Name *</label>
                                <input type="text" name="store_name" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($profile['store_name'] ?? $user['name']) ?>" placeholder="e.g. Pet Guard Official Emporium" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-dark">Business Registration # *</label>
                                <input type="text" name="business_registration" class="form-control rounded-3 py-2 font-monospace" value="<?= ViewHelper::e($profile['business_registration'] ?? 'TX-BUS-98231') ?>" placeholder="e.g. TX-BUS-98231" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Merchant Customer Care Phone *</label>
                            <input type="text" name="phone" class="form-control rounded-3 py-2" value="<?= ViewHelper::e($user['phone']) ?>" placeholder="+1 (555) 000-0000" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Store Description &amp; Brand Mission *</label>
                            <textarea name="description" class="form-control rounded-3 p-3" rows="3" required><?= ViewHelper::e($profile['description'] ?? 'Direct manufacturer and certified organic pet nutrition, orthopedic beds, interactive toys, and veterinary-grade supplements.') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-dark">Shipping &amp; Express Delivery Policy</label>
                            <textarea name="shipping_policy" class="form-control rounded-3 p-3" rows="2"><?= ViewHelper::e($profile['shipping_policy'] ?? 'Free express shipping on all orders over $49. 2-day delivery across continental US.') ?></textarea>
                            <div class="form-text small text-muted">Displayed on product details and shopping cart pages.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small fw-bold text-dark">Refund &amp; Return Guarantee Policy</label>
                            <textarea name="refund_policy" class="form-control rounded-3 p-3" rows="2"><?= ViewHelper::e($profile['refund_policy'] ?? '30-day hassle-free returns on unopened items.') ?></textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-admin-primary rounded-pill px-5 py-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="fa-solid fa-check"></i>
                                <span>Save Store Settings</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#vendorStoreForm', {
        loadingText: 'Saving Store Settings...',
        onSuccess: (data) => {
            PetGuardToast.success(data.message || 'Store profile updated successfully!');
        },
        onError: (err) => {
            PetGuardToast.error(err.message || 'Failed to update store settings.');
        }
    });
});
</script>
