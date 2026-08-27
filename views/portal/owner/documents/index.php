<?php
use Helpers\ViewHelper;
?>

<!-- 1. Hero Header Banner -->
<div class="portal-hero-welcome d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
    <div>
        <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small mb-2">
            <i class="fa-solid fa-folder-open text-warning"></i>
            <span>Encrypted Health Vault</span>
            <span class="text-white-50">&middot;</span>
            <span class="font-monospace text-warning"><?= count($docs ?? []) ?> Files</span>
        </div>
        <h2 class="portal-hero-title">Pet Document Vault 📁</h2>
        <p class="portal-hero-subtitle">Store vaccination certificates, diagnostic reports, adoption agreements, and insurance policies.</p>
    </div>
    <div class="d-flex flex-wrap gap-2">
        <button type="button" class="btn btn-admin-primary" data-bs-toggle="modal" data-bs-target="#uploadDocVaultModal">
            <i class="fa-solid fa-cloud-arrow-up"></i>
            <span>Upload Document</span>
        </button>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-body p-0">
        <div class="admin-table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Document Title</th>
                        <th>Associated Pet</th>
                        <th>Category</th>
                        <th>Date Stored</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($docs)): ?>
                        <tr>
                            <td colspan="5" class="text-center p-5 text-muted">
                                <i class="fa-solid fa-folder-open fs-1 text-muted mb-3 d-block"></i>
                                <h5 class="fw-bold">Your document vault is empty</h5>
                                <p class="small mb-3">Upload your pet's vaccination certificates, rabies records, and clinical files for instant mobile access.</p>
                                <button class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#uploadDocVaultModal">Upload First Document</button>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($docs as $doc): ?>
                            <?php
                                $ext = strtolower(pathinfo($doc['file_path'] ?? '', PATHINFO_EXTENSION));
                                $iconClass = 'fa-file-pdf text-danger';
                                if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) $iconClass = 'fa-file-image text-primary';
                                elseif (in_array($ext, ['doc', 'docx'])) $iconClass = 'fa-file-word text-info';
                            ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <i class="fa-solid <?= $iconClass ?> fs-4"></i>
                                        <div>
                                            <div class="fw-bold text-dark"><?= ViewHelper::e($doc['title']) ?></div>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <small class="text-muted font-monospace"><?= $doc['file_size'] ?? '1.2 MB' ?></small>
                                                <span class="text-muted">•</span>
                                                <a href="<?= ViewHelper::url('portal/documents/' . $doc['id'] . '/download') ?>" class="small text-brand text-decoration-none fw-semibold">
                                                    <i class="fa-solid fa-download me-1"></i> View / Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><span class="badge bg-light text-dark border"><?= ViewHelper::e($doc['pet_name']) ?></span></td>
                                <td><span class="badge bg-light text-dark border text-uppercase"><?= strtoupper(str_replace('_', ' ', $doc['doc_type'])) ?></span></td>
                                <td class="text-muted small"><?= date('M d, Y', strtotime($doc['created_at'])) ?></td>
                                <td class="text-end">
                                    <div class="d-inline-flex align-items-center gap-2">
                                        <a href="<?= ViewHelper::url('portal/documents/' . $doc['id'] . '/download') ?>" class="btn btn-sm btn-light text-brand rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Download Document">
                                            <i class="fa-solid fa-download"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-circle border shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 34px; height: 34px; min-width: 34px; padding: 0;" title="Delete Document"
                                            data-confirm-delete
                                            data-action="<?= ViewHelper::url('portal/documents/' . $doc['id'] . '/delete') ?>"
                                            data-title="Remove Document from Vault?"
                                            data-message="Are you sure you want to remove &quot;<?= ViewHelper::e($doc['title']) ?>&quot; for <?= ViewHelper::e($doc['pet_name']) ?> from your encrypted vault?">
                                            <i class="fa-regular fa-trash-can"></i>
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

<!-- Modal: Upload Doc -->
<div class="modal fade" id="uploadDocVaultModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-cloud-arrow-up text-brand me-2"></i> Store Document in Vault</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="<?= ViewHelper::url('portal/documents/create') ?>" method="POST" enctype="multipart/form-data">
                <?= ViewHelper::csrfField() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select Pet *</label>
                        <select name="pet_id" class="form-select rounded-3" required>
                            <?php foreach ($pets as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['species']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Document Title *</label>
                        <input type="text" name="title" class="form-control rounded-3" required placeholder="e.g. 2026 Rabies Certificate, Blood Panel Results">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Document Category</label>
                        <select name="doc_type" class="form-select rounded-3">
                            <option value="vaccine_cert">Vaccination Certificate</option>
                            <option value="medical_report">Clinical / Vet Medical Report</option>
                            <option value="lab_results">Laboratory Diagnostic Results</option>
                            <option value="adoption_papers">Adoption & Microchip Registration</option>
                            <option value="insurance">Pet Insurance Policy Document</option>
                            <option value="other">Other Pet Record</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Select File (PDF, Image, Word DOC) *</label>
                        <input type="file" name="document_file" class="form-control rounded-3" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                        <small class="text-muted" style="font-size: 11px;">Supported formats: PDF, JPG, PNG, DOC, DOCX (Max 10MB)</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary px-4"><i class="fa-solid fa-cloud-arrow-up me-1"></i> Store Document</button>
                </div>
            </form>
        </div>
    </div>
</div>
