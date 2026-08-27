<?php
use Helpers\ViewHelper;

$totalArticles = $stats['totalArticles'] ?? count($articles);
$totalFaqs = $stats['totalFaqs'] ?? count($faqs);
$totalTips = $stats['totalTips'] ?? count($tips);
$totalPublished = $stats['totalPublished'] ?? ($totalArticles + $totalFaqs + $totalTips);
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-book-medical text-warning"></i>
            <span>Veterinary Knowledge Base</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= number_format($totalPublished) ?> Published Items</span>
        </div>
        <h2 class="portal-hero-title">Care Content &amp; Health Knowledge 📚</h2>
        <p class="portal-hero-subtitle">
            Educational wellness articles, clinical FAQs, and seasonal preventive health guidance.
        </p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <button class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#contentModal" onclick="resetContentModal()">
            <i class="fa-solid fa-plus"></i>
            <span>Create Content Item</span>
        </button>
    </div>
</div>

<!-- 4 Top Metric Stat Cards -->
<div class="row g-3 mb-4">
    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Care Articles</span>
                <div class="stat-card-icon icon-orange">
                    <i class="fa-solid fa-newspaper"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalArticles) ?></div>
            <div class="stat-card-footer text-muted">
                Educational Guides
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Clinical FAQs</span>
                <div class="stat-card-icon icon-blue">
                    <i class="fa-solid fa-circle-question"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalFaqs) ?></div>
            <div class="stat-card-footer text-muted">
                Doctor-Verified Answers
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Seasonal Tips</span>
                <div class="stat-card-icon icon-amber">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalTips) ?></div>
            <div class="stat-card-footer text-muted">
                Daily Wellness Warnings
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6">
        <div class="admin-stat-card">
            <div class="stat-card-header">
                <span class="stat-card-label">Active Published</span>
                <div class="stat-card-icon icon-green">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
            </div>
            <div class="stat-card-value"><?= number_format($totalPublished) ?></div>
            <div class="stat-card-footer text-success fw-bold">
                <i class="fa-solid fa-globe me-1"></i> Live on Knowledge Base
            </div>
        </div>
    </div>
</div>

<!-- Tabs Card -->
<div class="admin-card">
    <div class="admin-card-header border-bottom bg-white p-3">
        <ul class="nav nav-pills gap-2" id="contentTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" data-bs-toggle="tab" data-bs-target="#articles-pane" style="font-size: 13.5px;">
                    <i class="fa-solid fa-newspaper text-brand"></i>
                    <span>Care Articles</span>
                    <span class="badge bg-light text-dark rounded-pill border ms-1"><?= count($articles) ?></span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" data-bs-toggle="tab" data-bs-target="#faqs-pane" style="font-size: 13.5px;">
                    <i class="fa-solid fa-circle-question text-primary"></i>
                    <span>Clinical FAQs</span>
                    <span class="badge bg-light text-dark rounded-pill border ms-1"><?= count($faqs) ?></span>
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4 py-2 fw-semibold d-flex align-items-center gap-2" data-bs-toggle="tab" data-bs-target="#tips-pane" style="font-size: 13.5px;">
                    <i class="fa-solid fa-lightbulb text-warning"></i>
                    <span>Health & Seasonal Tips</span>
                    <span class="badge bg-light text-dark rounded-pill border ms-1"><?= count($tips) ?></span>
                </button>
            </li>
        </ul>
    </div>
    <div class="admin-card-body p-0">
        <div class="tab-content">
            
            <!-- Articles Tab Pane -->
            <div class="tab-pane fade show active" id="articles-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Article Title & Summary</th>
                                <th>Category</th>
                                <th>Target Species</th>
                                <th>Publish Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($articles)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-newspaper fa-2x mb-2 d-block text-muted"></i>
                                        No care articles published yet. Click "Create Content Item" to add one.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($articles as $art): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold text-brand" style="width: 40px; height: 40px; min-width: 40px; background: #feeae5; font-size: 15px;">
                                                    <i class="fa-solid fa-file-lines"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($art['title']) ?></div>
                                                    <small class="text-muted text-truncate d-block" style="max-width: 380px; font-size: 12px;"><?= ViewHelper::e(substr(strip_tags($art['content'] ?? ''), 0, 90)) ?>...</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-tag text-muted me-1"></i> <?= ViewHelper::e($art['category'] ?? 'General') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-paw me-1"></i> <?= ViewHelper::e($art['species'] ?? 'All') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= $art['status'] ?? 'published' ?>">
                                                <?= ucfirst(ViewHelper::e($art['status'] ?? 'published')) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="d-inline-flex gap-1">
                                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold" onclick='openEditContentModal(<?= json_encode($art, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                                    <i class="fa-solid fa-pen-to-square me-1 text-primary"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/content/' . $art['id'] . '/delete') ?>', 'Delete Care Article', 'Are you sure you want to permanently delete this article?', 'Delete Article', 'btn-danger')">
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

            <!-- FAQs Tab Pane -->
            <div class="tab-pane fade" id="faqs-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Clinical Question & Solution</th>
                                <th>Category</th>
                                <th>Target Species</th>
                                <th>Publish Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($faqs)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-circle-question fa-2x mb-2 d-block text-muted"></i>
                                        No clinical FAQs created yet.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($faqs as $faq): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold text-primary" style="width: 40px; height: 40px; min-width: 40px; background: #e0f2fe; font-size: 15px;">
                                                    <i class="fa-solid fa-question"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($faq['title']) ?></div>
                                                    <small class="text-muted text-truncate d-block" style="max-width: 380px; font-size: 12px;"><?= ViewHelper::e(substr(strip_tags($faq['content'] ?? ''), 0, 90)) ?>...</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-stethoscope text-primary me-1"></i> <?= ViewHelper::e($faq['category'] ?? 'Clinical') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-paw me-1"></i> <?= ViewHelper::e($faq['species'] ?? 'All') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= $faq['status'] ?? 'published' ?>">
                                                <?= ucfirst(ViewHelper::e($faq['status'] ?? 'published')) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="d-inline-flex gap-1">
                                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold" onclick='openEditContentModal(<?= json_encode($faq, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                                    <i class="fa-solid fa-pen-to-square me-1 text-primary"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/content/' . $faq['id'] . '/delete') ?>', 'Delete FAQ', 'Are you sure you want to permanently delete this clinical FAQ?', 'Delete FAQ', 'btn-danger')">
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

            <!-- Tips Tab Pane -->
            <div class="tab-pane fade" id="tips-pane">
                <div class="admin-table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Wellness Tip Headline</th>
                                <th>Category</th>
                                <th>Target Species</th>
                                <th>Publish Status</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($tips)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <i class="fa-solid fa-lightbulb fa-2x mb-2 d-block text-muted"></i>
                                        No seasonal or wellness tips added yet.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($tips as $tip): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center gap-3">
                                                <div class="rounded-3 d-flex align-items-center justify-content-center fw-bold text-warning" style="width: 40px; height: 40px; min-width: 40px; background: #fef3c7; font-size: 15px;">
                                                    <i class="fa-solid fa-lightbulb"></i>
                                                </div>
                                                <div>
                                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($tip['title']) ?></div>
                                                    <small class="text-muted text-truncate d-block" style="max-width: 380px; font-size: 12px;"><?= ViewHelper::e(substr(strip_tags($tip['content'] ?? ''), 0, 90)) ?>...</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-sun text-warning me-1"></i> <?= ViewHelper::e($tip['category'] ?? 'Seasonal') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2 py-1" style="font-size: 11.5px; border-radius: 6px;">
                                                <i class="fa-solid fa-paw me-1"></i> <?= ViewHelper::e($tip['species'] ?? 'All') ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge-status status-<?= $tip['status'] ?? 'published' ?>">
                                                <?= ucfirst(ViewHelper::e($tip['status'] ?? 'published')) ?>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <div class="d-inline-flex gap-1">
                                                <button class="btn btn-sm btn-outline-dark rounded-pill px-3 py-1 fw-semibold" onclick='openEditContentModal(<?= json_encode($tip, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'>
                                                    <i class="fa-solid fa-pen-to-square me-1 text-primary"></i> Edit
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger rounded-pill px-2 py-1" onclick="triggerConfirmModal('<?= ViewHelper::url('admin/content/' . $tip['id'] . '/delete') ?>', 'Delete Health Tip', 'Are you sure you want to permanently delete this health tip?', 'Delete Tip', 'btn-danger')">
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
    </div>
</div>

<!-- Add/Edit Content Modal -->
<div class="modal fade" id="contentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark" id="contentModalTitle">
                    <i class="fa-solid fa-pen-nib text-brand me-2"></i> Create Content Item
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('admin/content') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="id" id="contentId" value="">
                <div class="modal-body py-3">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Content Type *</label>
                            <select name="type" id="contentType" class="form-select rounded-3" required>
                                <option value="article">Educational Article</option>
                                <option value="faq">Clinical FAQ</option>
                                <option value="health_tip">Health / Seasonal Tip</option>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small fw-bold text-dark">Title / Headline *</label>
                            <input type="text" name="title" id="contentTitle" class="form-control rounded-3" required placeholder="e.g. Essential Summer Hydration for Dogs">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Category</label>
                            <input type="text" name="category" id="contentCategory" class="form-control rounded-3" placeholder="Nutrition, Vaccinations...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Target Species</label>
                            <select name="species" id="contentSpecies" class="form-select rounded-3">
                                <option value="All">All Species</option>
                                <option value="Dog">Dogs Only</option>
                                <option value="Cat">Cats Only</option>
                                <option value="Bird">Birds</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-dark">Status *</label>
                            <select name="status" id="contentStatus" class="form-select rounded-3">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-dark">Content Body *</label>
                            <textarea name="content" id="contentBody" class="form-control rounded-3" rows="6" required placeholder="Detailed clinical guidance, health instructions, or FAQ solution..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark rounded-pill px-4 fw-semibold" style="background: #fa441d; border: none;">Save & Publish</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function resetContentModal() {
        document.getElementById('contentModalTitle').innerHTML = '<i class="fa-solid fa-pen-nib text-brand me-2"></i> Create Content Item';
        document.getElementById('contentId').value = '';
        document.getElementById('contentType').value = 'article';
        document.getElementById('contentTitle').value = '';
        document.getElementById('contentCategory').value = 'General';
        document.getElementById('contentSpecies').value = 'All';
        document.getElementById('contentStatus').value = 'published';
        document.getElementById('contentBody').value = '';
    }

    function openEditContentModal(item) {
        document.getElementById('contentModalTitle').innerHTML = '<i class="fa-solid fa-pen-to-square text-brand me-2"></i> Edit Content #' + item.id;
        document.getElementById('contentId').value = item.id;
        document.getElementById('contentType').value = item.type;
        document.getElementById('contentTitle').value = item.title;
        document.getElementById('contentCategory').value = item.category || 'General';
        document.getElementById('contentSpecies').value = item.species || 'All';
        document.getElementById('contentStatus').value = item.status || 'published';
        document.getElementById('contentBody').value = item.content;
        var modal = new bootstrap.Modal(document.getElementById('contentModal'));
        modal.show();
    }
</script>
