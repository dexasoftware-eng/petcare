<?php
use Helpers\ViewHelper;
?>

<section class="py-5" style="background-color: #f8fafc; min-height: 80vh; display: flex; align-items: center;">
    <div class="container py-4">
        <div class="admin-card border-0 shadow-lg rounded-4 p-4 p-md-5 bg-white mx-auto text-center" style="max-width: 720px;">
            
            <!-- Success Icon -->
            <div class="rounded-circle text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3 shadow" style="width: 76px; height: 76px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); font-size: 32px;">
                <i class="fa-solid fa-check"></i>
            </div>
            
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-success-subtle text-success border border-success-subtle small fw-bold mb-2">
                <i class="fa-solid fa-circle-check"></i> Order Authorized &amp; Confirmed
            </div>

            <h2 class="fw-bold text-dark mb-2" style="font-family: 'Anybody', sans-serif; font-size: 30px;">
                Thank You for Your Order!
            </h2>
            <p class="text-muted small mb-4" style="line-height: 1.6;">
                Your order reference is <strong class="text-dark font-monospace">#<?= ViewHelper::e($order['order_number']) ?></strong>. We've initiated fulfillment and packed your pet's essentials.
            </p>

            <!-- Fulfillment Tracker Timeline -->
            <div class="p-3 bg-light rounded-4 border mb-4 text-start">
                <div class="d-flex align-items-center justify-content-between text-center position-relative my-2">
                    <div class="d-flex flex-column align-items-center z-1">
                        <span class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="small fw-bold text-dark mt-1" style="font-size: 11px;">Placed</span>
                    </div>
                    <div class="d-flex flex-column align-items-center z-1">
                        <span class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow-sm" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-box-open"></i>
                        </span>
                        <span class="small fw-bold text-primary mt-1" style="font-size: 11px;">Packing</span>
                    </div>
                    <div class="d-flex flex-column align-items-center z-1 opacity-50">
                        <span class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-truck-fast"></i>
                        </span>
                        <span class="small fw-semibold text-muted mt-1" style="font-size: 11px;">Shipped</span>
                    </div>
                    <div class="d-flex flex-column align-items-center z-1 opacity-50">
                        <span class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                            <i class="fa-solid fa-house"></i>
                        </span>
                        <span class="small fw-semibold text-muted mt-1" style="font-size: 11px;">Delivered</span>
                    </div>
                </div>
            </div>

            <!-- Invoice Summary Card -->
            <div class="p-4 rounded-4 bg-light text-start mb-4 border">
                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                    <span class="fw-bold text-dark small">Order Summary (<?= count($order['items'] ?? []) ?> Items)</span>
                    <button type="button" class="btn btn-sm btn-link text-decoration-none p-0 text-muted small" onclick="window.print();">
                        <i class="fa-solid fa-print me-1"></i> Print Invoice
                    </button>
                </div>

                <div class="d-flex flex-column gap-2 mb-3">
                    <?php foreach ($order['items'] ?? [] as $item): ?>
                        <div class="d-flex justify-content-between align-items-center small">
                            <div class="d-flex align-items-center gap-2 overflow-hidden">
                                <?php if (!empty($item['img'])): ?>
                                    <img src="<?= ViewHelper::asset($item['img']) ?>" class="rounded-2" style="width: 32px; height: 32px; object-fit: contain;">
                                <?php endif; ?>
                                <span class="text-truncate"><?= ViewHelper::e($item['name']) ?> <strong class="text-muted">× <?= (int)$item['quantity'] ?></strong></span>
                            </div>
                            <span class="fw-bold text-dark flex-shrink-0 ms-2">$<?= number_format((float)$item['price'] * (int)$item['quantity'], 2) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="border-top pt-3 d-flex flex-column gap-1 small">
                    <div class="d-flex justify-content-between text-muted">
                        <span>Payment Method:</span>
                        <span class="text-dark text-uppercase fw-semibold"><?= ViewHelper::e($order['payment_method'] ?? 'card') ?> (<?= ucfirst($order['payment_status'] ?? 'paid') ?>)</span>
                    </div>
                    <div class="d-flex justify-content-between text-muted">
                        <span>Shipping Destination:</span>
                        <span class="text-dark fw-semibold"><?= ViewHelper::e($order['address'] ?? '') ?>, <?= ViewHelper::e($order['city'] ?? '') ?></span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold pt-2 border-top mt-1" style="font-size: 15px;">
                        <span>Total Paid:</span>
                        <span class="text-brand fs-5">$<?= number_format((float)$order['total'], 2) ?></span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-outline-secondary rounded-pill px-4 fw-bold small">
                    <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                </a>
                <a href="<?= ViewHelper::url('portal/orders') ?>" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm small">
                    <i class="fa-solid fa-box me-1"></i> Track Order in Portal
                </a>
            </div>

        </div>
    </div>
</section>
