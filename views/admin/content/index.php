<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Care Content & Pet Health Knowledge</h2>
        <p class="admin-page-subtitle">Educational articles, clinical FAQs, and seasonal pet wellness guidance.</p>
    </div>
    <div>
        <button class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#contentModal">
            <i class="fa-solid fa-plus"></i> Create Content Item
        </button>
    </div>
</div>

<!-- Tabs Card -->
<div class="admin-card">
    <div class="admin-card-header border-0 pb-0">
        <ul class="nav nav-tabs border-0" id="contentTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active fw-bold text-dark border-0 pb-3" data-bs-toggle="tab" data-bs-target="#articles-pane">
                    <i class="fa-solid fa-newspaper text-brand me-1"></i> Care Articles (<?= count($articles) ?>)
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold text-dark border-0 pb-3" data-bs-toggle="tab" data-bs-target="#faqs-pane">
                    <i class="fa-solid fa-circle-question text-primary me-1"></i> Clinical FAQs (<?= count($faqs) ?>)
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link fw-bold text-dark border-0 pb-3" data-bs-toggle="tab" data-bs-target="#tips-pane">
                    <i class="fa-solid fa-lightbulb text-warning me-1"></i> Health & Seasonal Tips (<?= count($tips) ?>)
                </button>
            </li>
        </ul>
    </div>
    <div class="admin-card-body p-0 border-top">
        <div class="tab-content">
            <!-- Articles Tab -->
            <div class="tab-pane fade show active" id="articles-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead><tr><th>Article Title</th><th>Category</th><th>Target Species</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php foreach ($articles as $art): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= ViewHelper::e($art['title']) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($art['category']) ?></span></td>
                                    <td><?= ViewHelper::e($art['species']) ?></td>
                                    <td><span class="badge-status status-<?= $art['status'] ?>"><?= ViewHelper::e($art['status']) ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-dark rounded-pill px-2" onclick='openEditContentModal(<?= json_encode($art) ?>)'><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/content/{$art['id']}/delete") ?>', 'Delete Article', 'Are you sure you want to remove this article?', 'Delete', 'btn-danger')"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- FAQs Tab -->
            <div class="tab-pane fade" id="faqs-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead><tr><th>Question</th><th>Category</th><th>Species</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php foreach ($faqs as $faq): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= ViewHelper::e($faq['title']) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($faq['category']) ?></span></td>
                                    <td><?= ViewHelper::e($faq['species']) ?></td>
                                    <td><span class="badge-status status-<?= $faq['status'] ?>"><?= ViewHelper::e($faq['status']) ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-dark rounded-pill px-2" onclick='openEditContentModal(<?= json_encode($faq) ?>)'><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/content/{$faq['id']}/delete") ?>', 'Delete FAQ', 'Delete this FAQ entry?', 'Delete', 'btn-danger')"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tips Tab -->
            <div class="tab-pane fade" id="tips-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead><tr><th>Tip Headline</th><th>Category</th><th>Species</th><th>Status</th><th>Actions</th></tr></thead>
                        <tbody>
                            <?php foreach ($tips as $tip): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= ViewHelper::e($tip['title']) ?></td>
                                    <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($tip['category']) ?></span></td>
                                    <td><?= ViewHelper::e($tip['species']) ?></td>
                                    <td><span class="badge-status status-<?= $tip['status'] ?>"><?= ViewHelper::e($tip['status']) ?></span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-dark rounded-pill px-2" onclick='openEditContentModal(<?= json_encode($tip) ?>)'><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn btn-sm btn-outline-danger rounded-pill px-2" onclick="triggerConfirmModal('<?= ViewHelper::url("admin/content/{$tip['id']}/delete") ?>', 'Delete Health Tip', 'Delete this health tip?', 'Delete', 'btn-danger')"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Content Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="contentModalTitle">Create Content Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('admin/content') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="id" id="contentId" value="">
                <div class="modal-body py-0">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Content Type *</label>
                            <select name="type" id="contentType" class="form-select rounded-3" required>
                                <option value="article">Educational Article</option>
                                <option value="faq">Clinical FAQ</option>
                                <option value="health_tip">Health / Seasonal Tip</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold">Title / Headline *</label>
                            <input type="text" name="title" id="contentTitle" class="form-control rounded-3" required placeholder="e.g. Essential Summer Hydration for Dogs">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Category</label>
                            <input type="text" name="category" id="contentCategory" class="form-control rounded-3" placeholder="Nutrition, Vaccinations...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Target Species</label>
                            <select name="species" id="contentSpecies" class="form-select rounded-3">
                                <option value="All">All Species</option>
                                <option value="Dog">Dogs Only</option>
                                <option value="Cat">Cats Only</option>
                                <option value="Bird">Birds</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">Status *</label>
                            <select name="status" id="contentStatus" class="form-select rounded-3">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold">Content Body *</label>
                            <textarea name="content" id="contentBody" class="form-control rounded-3" rows="5" required placeholder="Full educational advice, instructions, or FAQ answer..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-brand rounded-pill px-4 fw-bold">Save Content</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditContentModal(item) {
        document.getElementById('contentModalTitle').textContent = 'Edit Content #' + item.id;
        document.getElementById('contentId').value = item.id;
        document.getElementById('contentType').value = item.type;
        document.getElementById('contentTitle').value = item.title;
        document.getElementById('contentCategory').value = item.category;
        document.getElementById('contentSpecies').value = item.species;
        document.getElementById('contentStatus').value = item.status;
        document.getElementById('contentBody').value = item.content;
        var modal = new bootstrap.Modal(document.getElementById('contentModal'));
        modal.show();
    }
</script>
