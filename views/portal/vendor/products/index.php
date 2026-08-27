<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-tags text-brand me-2"></i> Merchant Product Catalog</h2>
        <p class="admin-page-subtitle">Manage store inventory, prices, SKU codes, and marketplace listings.</p>
    </div>
    <div>
        <a href="<?= ViewHelper::url('vendor/products/create') ?>" class="btn btn-admin-primary rounded-pill px-4">
            <i class="fa-solid fa-plus me-1"></i> Add New Product
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-boxes-stacked text-brand me-2"></i> Catalog Items (<?= count($products ?? []) ?>)</h3>
        
        <form method="GET" action="<?= ViewHelper::url('vendor/products') ?>" class="d-flex gap-2 flex-wrap" style="max-width: 500px;">
            <select name="category" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= ViewHelper::e($cat['title']) ?>" <?= ($selectedCategory ?? '') === $cat['title'] ? 'selected' : '' ?>>
                        <?= ViewHelper::e($cat['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="text" name="search" class="form-control form-control-sm rounded-pill px-3" placeholder="Search name or SKU..." value="<?= ViewHelper::e($search ?? '') ?>">
            <button type="submit" class="btn btn-sm btn-admin-primary rounded-pill px-3"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($products)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-box-open fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No products found</h5>
                <p class="small text-muted">Click "+ Add New Product" to list an item in your store.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Product Details</th>
                            <th>Category</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $prod): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="<?= ViewHelper::asset($prod['img'] ?? 'img/product-1.jpg') ?>" alt="Product" class="rounded-3 border" style="width: 44px; height: 44px; object-fit: cover;">
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($prod['name']) ?></div>
                                            <div class="small text-muted"><?= ViewHelper::e($prod['target_species'] ?? 'All Pets') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border"><?= ViewHelper::e($prod['category']) ?></span>
                                </td>
                                <td class="font-monospace small text-muted">
                                    <?= ViewHelper::e($prod['sku']) ?>
                                </td>
                                <td class="fw-bold text-dark">
                                    $<?= number_format((float)$prod['price'], 2) ?>
                                </td>
                                <td>
                                    <?php if ((int)$prod['stock'] > 5): ?>
                                        <span class="admin-badge badge-success"><?= $prod['stock'] ?> In Stock</span>
                                    <?php elseif ((int)$prod['stock'] > 0): ?>
                                        <span class="admin-badge badge-amber"><?= $prod['stock'] ?> Low Stock</span>
                                    <?php else: ?>
                                        <span class="admin-badge badge-danger">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($prod['in_stock'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-0">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1">
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id']) ?>" class="btn btn-sm btn-outline-brand rounded-pill px-3">
                                            View
                                        </a>
                                        <a href="<?= ViewHelper::url('vendor/products/' . $prod['id'] . '/edit') ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                                            Edit
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="deleteProduct(<?= $prod['id'] ?>)">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
async function deleteProduct(id) {
    const confirmed = await PetGuardModal.danger({
        title: 'Archive Product?',
        message: 'This will remove the product from your active storefront.'
    });

    if (confirmed) {
        const res = await PetGuardAjax.post(`vendor/products/${id}/delete`);
        if (res.ok) {
            PetGuardToast.success('Product archived.');
            setTimeout(() => window.location.reload(), 600);
        } else {
            PetGuardToast.error(res.message);
        }
    }
}
</script>
