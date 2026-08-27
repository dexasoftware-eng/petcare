<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Marketplace Products Catalog</h2>
        <p class="admin-page-subtitle">Pet nutritional supplies, healthcare therapeutics, grooming equipment, and accessories.</p>
    </div>
    <div>
        <button class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#productModal">
            <i class="fa-solid fa-plus"></i> Add New Product
        </button>
    </div>
</div>

<!-- Products Table Card -->
<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>SKU</th>
                        <th>Stock Level</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($products)): ?>
                        <tr><td colspan="7" class="text-center p-4 text-muted">No products found in catalog.</td></tr>
                    <?php else: ?>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="<?= ViewHelper::asset($p['img'] ?? ($p['image'] ?? 'img/food-1.png')) ?>" alt="" class="rounded-3 border" style="width: 44px; height: 44px; object-fit: contain; background: #fff;">
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($p['name']) ?></div>
                                            <small class="text-muted"><?= ViewHelper::e(substr($p['description'] ?? '', 0, 45)) ?>...</small>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($p['category_name'] ?? ($p['category'] ?? 'General')) ?></span></td>
                                <td class="fw-bold text-dark">$<?= number_format((float)$p['price'], 2) ?></td>
                                <td><code><?= ViewHelper::e($p['sku']) ?></code></td>
                                <td>
                                    <?php if (($p['stock'] ?? 0) <= 5): ?>
                                        <span class="badge bg-danger"><?= $p['stock'] ?? 0 ?> In Stock</span>
                                    <?php else: ?>
                                        <span class="badge bg-success"><?= $p['stock'] ?? 25 ?> In Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge-status status-<?= ($p['status'] ?? (($p['in_stock'] ?? 1) ? 'active' : 'out_of_stock')) ?>"><?= ViewHelper::e($p['status'] ?? (($p['in_stock'] ?? 1) ? 'active' : 'out_of_stock')) ?></span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-dark rounded-pill px-2" title="Edit Product" onclick='openEditProductModal(<?= json_encode($p) ?>)'>
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-2" title="Delete Product" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/marketplace/products/{$p['id']}/delete") ?>', 'Delete Product', 'Are you sure you want to remove <?= ViewHelper::e($p['name']) ?> from the catalog?', 'Delete Product', 'btn-danger')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Product Add/Edit Modal -->
<div class="modal fade" id="productModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="productModalTitle">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('admin/marketplace/products') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="id" id="prodId" value="">
                
                <div class="modal-body py-0">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Product Name *</label>
                            <input type="text" name="name" id="prodName" class="form-control rounded-3" required placeholder="Premium Grain-Free Dog Food">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Category *</label>
                            <select name="category_id" id="prodCategory" class="form-select rounded-3" required>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= ViewHelper::e($cat['title'] ?? ($cat['name'] ?? 'General')) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Price ($) *</label>
                            <input type="number" step="0.01" name="price" id="prodPrice" class="form-control rounded-3" required placeholder="29.99">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Initial Stock *</label>
                            <input type="number" name="stock" id="prodStock" class="form-control rounded-3" required placeholder="50">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Status *</label>
                            <select name="status" id="prodStatus" class="form-select rounded-3">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="out_of_stock">Out of Stock</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Description</label>
                            <textarea name="description" id="prodDesc" class="form-control rounded-3" rows="3" placeholder="Nutritional formulation, organic ingredients, and feeding guide..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-brand rounded-pill px-4 fw-bold">Save Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditProductModal(prod) {
        document.getElementById('productModalTitle').textContent = 'Edit Product #' + prod.id;
        document.getElementById('prodId').value = prod.id;
        document.getElementById('prodName').value = prod.name;
        document.getElementById('prodCategory').value = prod.category_id;
        document.getElementById('prodPrice').value = prod.price;
        document.getElementById('prodStock').value = prod.stock;
        document.getElementById('prodStatus').value = prod.status;
        document.getElementById('prodDesc').value = prod.description || '';
        var modal = new bootstrap.Modal(document.getElementById('productModal'));
        modal.show();
    }
</script>
