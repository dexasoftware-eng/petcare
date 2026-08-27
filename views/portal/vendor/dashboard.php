<?php
use Helpers\ViewHelper;
?>

<!-- 1. Commerce Store Hero Welcome Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-store text-warning"></i>
            <span>Verified Merchant Store</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= ViewHelper::e($profile['business_registration'] ?? 'TX-BUS-98231') ?></span>
        </div>
        <h2 class="portal-hero-title"><?= ViewHelper::e($profile['store_name'] ?? 'Pet Guard Official Emporium') ?> 🛍️</h2>
        <p class="portal-hero-subtitle">Catalog inventory management, customer order fulfillment & merchant sales metrics.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary">
            <i class="fa-solid fa-plus"></i>
            <span>Add New Product</span>
        </a>
        <a href="<?= ViewHelper::url('vendor/orders') ?>" class="btn btn-admin-secondary">
            <i class="fa-solid fa-cart-flatbed"></i>
            <span>Fulfill Orders</span>
        </a>
    </div>
</div>

<!-- KPI Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Total Revenue</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-dollar-sign"></i>
                </div>
            </div>
            <div class="stat-card-value">$<?= number_format((float)($kpi['totalSales'] ?? 0), 2) ?></div>
            <div class="stat-card-footer text-success fw-bold"><i class="fa-solid fa-arrow-trend-up me-1"></i> Paid Store Orders</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Active Orders</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-box-open"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['totalOrders'] ?? 0 ?></div>
            <div class="stat-card-footer text-muted"><?= $kpi['pendingOrders'] ?? 0 ?> pending fulfillment</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Catalog Products</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-tags"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['totalProducts'] ?? 0 ?></div>
            <div class="stat-card-footer text-muted">Active items for sale</div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6">
        <div class="stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Stock Alerts</span>
                <div class="stat-card-icon icon-purple">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= $kpi['lowStockCount'] ?? 0 ?></div>
            <div class="stat-card-footer text-danger fw-bold"><i class="fa-solid fa-circle-exclamation me-1"></i> Low stock items</div>
        </div>
    </div>
</div>

<!-- Orders and Low Stock Widgets -->
<div class="row g-4 mb-4">
    <div class="col-lg-7">
        <div class="admin-card h-100 overflow-hidden mb-0">
            <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange" style="width: 36px; height: 36px; font-size: 15px; border-radius: 10px;">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <h6 class="fw-bold m-0 text-dark">Recent Store Orders</h6>
                </div>
                <a href="<?= ViewHelper::url('vendor/orders') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold" style="font-size: 12px;">
                    View All &rarr;
                </a>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($recentOrders)): ?>
                    <div class="p-5 text-center text-muted">
                        <i class="fa-solid fa-cart-shopping fs-3 mb-2 d-block text-muted"></i>
                        <span class="small">No customer orders placed yet.</span>
                    </div>
                <?php else: ?>
                    <!-- Desktop Table (>=768px) -->
                    <div class="d-none d-md-block table-responsive m-0">
                        <table class="table table-hover align-middle m-0" style="min-width: 460px;">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Order #</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4 text-nowrap">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentOrders as $ord): ?>
                                    <tr>
                                        <td class="ps-4">
                                            <div class="fw-bold text-dark font-monospace" style="font-size: 13px;"><?= ViewHelper::e($ord['order_number']) ?></div>
                                            <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i><?= date('M d, Y', strtotime($ord['created_at'])) ?></small>
                                        </td>
                                        <td class="fw-bold text-dark text-nowrap">
                                            $<?= number_format((float)$ord['total'], 2) ?>
                                        </td>
                                        <td>
                                            <?php if ($ord['payment_status'] === 'paid'): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 text-uppercase" style="font-size: 10px;">Paid</span>
                                            <?php else: ?>
                                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2 py-1 text-uppercase" style="font-size: 10px;"><?= ViewHelper::e($ord['payment_status']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php
                                            $statusMap = [
                                                'pending' => 'badge-amber',
                                                'confirmed' => 'badge-blue',
                                                'processing' => 'badge-blue',
                                                'ready_to_ship' => 'badge-purple',
                                                'shipped' => 'badge-purple',
                                                'delivered' => 'badge-success',
                                                'cancelled' => 'badge-danger',
                                                'refunded' => 'badge-danger'
                                            ];
                                            $statusLabel = ucwords(str_replace('_', ' ', $ord['status'] ?? 'pending'));
                                            ?>
                                            <span class="admin-badge <?= $statusMap[$ord['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 10.5px;">
                                                <?= $statusLabel ?>
                                            </span>
                                        </td>
                                        <td class="text-end pe-4 text-nowrap">
                                            <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3 py-1 fw-bold d-inline-flex align-items-center gap-1" style="font-size: 12px;">
                                                <span>Fulfill</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Orders Cards (<768px) -->
                    <div class="d-md-none p-3 d-flex flex-column gap-3">
                        <?php foreach ($recentOrders as $ord): ?>
                            <div class="p-3 rounded-4 border bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <strong class="font-monospace text-dark d-block" style="font-size: 14px;"><?= ViewHelper::e($ord['order_number']) ?></strong>
                                        <small class="text-muted"><i class="fa-regular fa-calendar me-1"></i><?= date('M d, Y', strtotime($ord['created_at'])) ?></small>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-brand fs-5 d-block">$<?= number_format((float)$ord['total'], 2) ?></span>
                                    </div>
                                </div>
                                <div class="bg-light p-2 px-3 rounded-3 small mb-2 d-flex justify-content-between align-items-center flex-nowrap">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 text-uppercase" style="font-size: 10px;">Payment: <?= ViewHelper::e($ord['payment_status']) ?></span>
                                    <?php
                                    $statusMap = [
                                        'pending' => 'badge-amber',
                                        'confirmed' => 'badge-blue',
                                        'processing' => 'badge-blue',
                                        'ready_to_ship' => 'badge-purple',
                                        'shipped' => 'badge-purple',
                                        'delivered' => 'badge-success',
                                        'cancelled' => 'badge-danger',
                                        'refunded' => 'badge-danger'
                                    ];
                                    $statusLabel = ucwords(str_replace('_', ' ', $ord['status'] ?? 'pending'));
                                    ?>
                                    <span class="admin-badge <?= $statusMap[$ord['status']] ?? 'badge-neutral' ?> text-uppercase" style="font-size: 10px;"><?= $statusLabel ?></span>
                                </div>
                                <div class="pt-2 border-top">
                                    <a href="<?= ViewHelper::url('vendor/orders/' . $ord['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill w-100 py-2 d-flex align-items-center justify-content-center gap-1 fw-bold" style="min-height: 42px; font-size: 13px;">
                                        <span>Fulfill Order</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="admin-card h-100">
            <div class="admin-card-header d-flex justify-content-between align-items-center">
                <h3 class="admin-card-title m-0"><i class="fa-solid fa-boxes-stacked text-brand me-2"></i> Low Stock Thresholds</h3>
                <a href="<?= ViewHelper::url('vendor/inventory') ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">Inventory</a>
            </div>
            <div class="admin-card-body p-0">
                <?php if (empty($lowStockProducts)): ?>
                    <div class="p-4 text-center text-muted">All catalog items have healthy stock levels.</div>
                <?php else: ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($lowStockProducts as $prod): ?>
                            <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark"><?= ViewHelper::e($prod['name']) ?></h6>
                                    <span class="small text-muted font-monospace">SKU: <?= ViewHelper::e($prod['sku']) ?></span>
                                </div>
                                <div>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle fs-6 px-3 py-1 rounded-pill">
                                        <?= (int)$prod['stock'] ?> Left
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
