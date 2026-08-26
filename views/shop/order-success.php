<?php
use Helpers\ViewHelper;
?>
<section class="py-5" style="background-color: #fff8e5; min-height: 75vh; display: flex; align-items: center;">
    <div class="container py-5">
        <div class="card max-w-lg mx-auto p-5 rounded-4 border-0 shadow text-center" style="max-width: 650px; margin: 0 auto; background: #fff;">
            <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 75px; height: 75px;">
                <i class="fa-solid fa-check fs-2"></i>
            </div>
            
            <span class="badge bg-success text-uppercase px-3 py-2 rounded-pill mx-auto mb-2 fw-bold">Order Received</span>
            <h2 class="fw-bold mb-2">Thank You for Your Order!</h2>
            <p class="text-muted mb-4">Your order reference is <strong class="text-dark">#<?= ViewHelper::e($order['order_number']) ?></strong>. A confirmation summary has been saved to your account.</p>

            <div class="p-4 rounded-3 bg-light text-start mb-4">
                <h6 class="fw-bold mb-3 border-bottom pb-2">Order Items (<?= count($order['items'] ?? []) ?>)</h6>
                <div class="d-flex flex-column gap-2 mb-3">
                    <?php foreach ($order['items'] as $item): ?>
                        <div class="d-flex justify-content-between small">
                            <span><?= ViewHelper::e($item['name']) ?> × <?= $item['quantity'] ?></span>
                            <span class="fw-bold">$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="border-top pt-2 d-flex justify-content-between fw-bold">
                    <span>Total Amount Paid:</span>
                    <span class="text-brand fs-5">$<?= number_format($order['total'], 2) ?></span>
                </div>
            </div>

            <div class="d-flex justify-content-center gap-3">
                <a href="<?= ViewHelper::url('our-products') ?>" class="btn btn-outline-dark rounded-pill px-4">Continue Shopping</a>
                <a href="<?= ViewHelper::url('owner/dashboard') ?>" class="btn-brand">Go to Dashboard</a>
            </div>
        </div>
    </div>
</section>
