<?php
use Helpers\ViewHelper;

$services = $services ?? [];
$totalServices = count($services);
$activeServices = 0;
$totalPrice = 0.0;

foreach ($services as $s) {
    if (!empty($s['is_active'])) $activeServices++;
    $totalPrice += (float)($s['price'] ?? 0);
}

$avgPrice = $totalServices > 0 ? ($totalPrice / $totalServices) : 0.0;
?>

<style>
@media (max-width: 767.98px) {
    .services-desktop-table { display: none !important; }
    .services-mobile-grid { display: flex !important; }
}
@media (min-width: 768px) {
    .services-desktop-table { display: block !important; }
    .services-mobile-grid { display: none !important; }
}
</style>

<div class="vet-services-container py-2">

    <!-- 1. Hero Header Banner -->
    <div class="rounded-4 p-4 p-md-5 mb-4 text-white position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%);">
        <div class="position-absolute top-0 end-0 w-50 h-100 opacity-20 pointer-events-none d-none d-lg-block" style="background: radial-gradient(circle at right, #818cf8 0%, transparent 70%);"></div>
        <div class="row align-items-center position-relative z-1 g-3">
            <div class="col-12 col-lg-8">
                <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill bg-white bg-opacity-10 text-white small fw-bold mb-2 border border-white border-opacity-10">
                    <i class="fa-solid fa-stethoscope text-warning"></i> Certified Clinical Services
                </div>
                <h1 class="display-6 fw-bold text-white mb-2" style="font-family: 'Anybody', sans-serif;">
                    Clinical Services &amp; Consultation Fees
                </h1>
                <p class="text-white text-opacity-80 small mb-0" style="max-width: 620px; line-height: 1.6;">
                    Configure consultation options, telemedicine session fees, and clinical duration schedules published to pet parents.
                </p>
            </div>
            <div class="col-12 col-lg-4 text-lg-end">
                <button type="button" class="btn btn-admin-primary rounded-pill px-4 py-2 fw-bold shadow-sm d-inline-flex align-items-center gap-2" data-bs-toggle="modal" data-bs-target="#serviceModal" onclick="resetServiceForm()" style="font-size: 13.5px;">
                    <i class="fa-solid fa-plus"></i>
                    <span>Add New Service</span>
                </button>
            </div>
        </div>
    </div>

    <!-- 2. 4 Top Metric Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Catalog Offerings</span>
                    <div class="stat-card-icon icon-blue rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-briefcase-medical"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0"><?= $totalServices ?></div>
                <small class="text-muted" style="font-size: 11px;">Published Services</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Active Services</span>
                    <div class="stat-card-icon icon-green rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-success mb-0"><?= $activeServices ?></div>
                <small class="text-success fw-semibold" style="font-size: 11px;">Bookable Now</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Avg Consult Fee</span>
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-dark mb-0">$<?= number_format($avgPrice, 2) ?></div>
                <small class="text-muted" style="font-size: 11px;">Per Standard Visit</small>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="admin-card p-3 p-md-4 shadow-sm border h-100 rounded-4 bg-white">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <span class="text-muted small fw-bold text-uppercase" style="font-size: 10.5px;">Telehealth Ready</span>
                    <div class="stat-card-icon icon-purple rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 14px;">
                        <i class="fa-solid fa-video"></i>
                    </div>
                </div>
                <div class="fs-4 fw-bold text-primary mb-0">Enabled</div>
                <small class="text-muted" style="font-size: 11px;">WebRTC Encrypted</small>
            </div>
        </div>
    </div>

    <!-- 3. Main Services Content -->
    <?php if (empty($services)): ?>
        <div class="admin-card p-5 text-center text-muted shadow-sm rounded-4 bg-white">
            <div class="rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 72px; height: 72px; background: #f8fafc; color: #94a3b8; font-size: 32px;">
                <i class="fa-solid fa-stethoscope"></i>
            </div>
            <h5 class="fw-bold text-dark">No Clinical Services Defined</h5>
            <p class="small text-muted mb-3" style="max-width: 480px; margin: 0 auto;">Add clinical offerings, routine wellness exams, or virtual telehealth fees to start accepting appointments.</p>
            <button type="button" class="btn btn-admin-primary rounded-pill px-4 fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#serviceModal" onclick="resetServiceForm()">
                <i class="fa-solid fa-plus me-1"></i> Add Service
            </button>
        </div>
    <?php else: ?>

        <!-- A. Desktop Data Table (>=768px) -->
        <div class="admin-card shadow-sm border overflow-hidden services-desktop-table mb-4 rounded-4 bg-white">
            <div class="admin-card-header d-flex justify-content-between align-items-center p-3 px-4 border-bottom bg-light">
                <div class="d-flex align-items-center gap-2">
                    <div class="stat-card-icon icon-orange rounded-3 d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 13px;">
                        <i class="fa-solid fa-list-check"></i>
                    </div>
                    <h6 class="fw-bold text-dark m-0">Active Service Catalog (<?= $totalServices ?> Offerings)</h6>
                </div>
                <span class="badge bg-white text-dark border px-3 py-1 rounded-pill small">Public Offerings</span>
            </div>

            <div class="table-responsive m-0">
                <table class="table vendor-table align-middle m-0" style="font-size: 13px;">
                    <thead class="table-light text-muted text-uppercase" style="font-size: 11px; letter-spacing: 0.5px;">
                        <tr>
                            <th class="ps-4 py-3" style="min-width: 250px;">Service Name &amp; Description</th>
                            <th class="py-3" style="min-width: 140px;">Category</th>
                            <th class="py-3" style="min-width: 130px;">Duration</th>
                            <th class="py-3" style="min-width: 120px;">Fee ($)</th>
                            <th class="py-3" style="min-width: 110px;">Status</th>
                            <th class="text-end pe-4 py-3" style="min-width: 140px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $srv): ?>
                            <tr>
                                <td class="ps-4 py-3">
                                    <div class="fw-bold text-dark" style="font-size: 14px;"><?= ViewHelper::e($srv['name']) ?></div>
                                    <div class="text-muted small text-truncate" style="max-width: 280px;"><?= ViewHelper::e($srv['description'] ?: 'General veterinary consultation') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1 rounded-pill"><?= ViewHelper::e($srv['category']) ?></span>
                                </td>
                                <td>
                                    <span class="small text-muted"><i class="fa-regular fa-clock me-1 text-brand"></i><?= (int)$srv['duration_minutes'] ?> mins</span>
                                </td>
                                <td class="fw-bold text-dark fs-6">
                                    $<?= number_format((float)$srv['price'], 2) ?>
                                </td>
                                <td>
                                    <?php if (!empty($srv['is_active'])): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 fw-bold">Active</span>
                                    <?php else: ?>
                                        <span class="badge bg-light text-secondary border rounded-pill px-2 py-1">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4 py-3">
                                    <div class="d-inline-flex align-items-center gap-1 justify-content-end">
                                        <button type="button" class="btn btn-sm btn-outline-brand rounded-pill px-3 fw-bold" onclick='editService(<?= json_encode($srv) ?>)'>
                                            <i class="fa-solid fa-pen-to-square me-1"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-danger rounded-circle" style="width: 32px; height: 32px; padding: 0;" onclick="deleteService(<?= $srv['id'] ?>)">
                                            <i class="fa-solid fa-trash" style="font-size: 11px;"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- B. Mobile Card Grid (<768px) -->
        <div class="row g-3 services-mobile-grid mb-4">
            <?php foreach ($services as $srv): ?>
                <div class="col-12 col-sm-6">
                    <div class="admin-card p-3 rounded-4 border shadow-sm bg-white h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-start mb-2 pb-2 border-bottom">
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 14.5px;"><?= ViewHelper::e($srv['name']) ?></div>
                                    <span class="badge bg-light text-secondary border rounded-pill mt-1" style="font-size: 10px;"><?= ViewHelper::e($srv['category']) ?></span>
                                </div>
                                <span class="badge <?= !empty($srv['is_active']) ? 'bg-success-subtle text-success border-success-subtle' : 'bg-light text-muted border' ?> rounded-pill px-2 py-1 fw-bold" style="font-size: 10px;">
                                    <?= !empty($srv['is_active']) ? 'Active' : 'Disabled' ?>
                                </span>
                            </div>

                            <p class="small text-muted mb-3" style="font-size: 12px; line-height: 1.5;">
                                <?= ViewHelper::e($srv['description'] ?: 'Standard clinical exam') ?>
                            </p>

                            <div class="p-2 px-3 bg-light rounded-3 border mb-3 d-flex justify-content-between align-items-center">
                                <span class="small text-muted"><i class="fa-regular fa-clock me-1 text-brand"></i><?= (int)$srv['duration_minutes'] ?> mins</span>
                                <span class="fw-bold text-dark fs-6">$<?= number_format((float)$srv['price'], 2) ?></span>
                            </div>
                        </div>

                        <div class="pt-2 border-top d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-admin-primary rounded-pill flex-grow-1 fw-bold py-2 shadow-sm d-flex align-items-center justify-content-center gap-1" onclick='editService(<?= json_encode($srv) ?>)'>
                                <i class="fa-solid fa-pen-to-square"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold py-2" onclick="deleteService(<?= $srv['id'] ?>)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

</div>

<!-- Modal: Add/Edit Service -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header border-bottom p-4 bg-light">
                <h5 class="modal-title fw-bold text-dark" id="serviceModalTitle" style="font-family: 'Anybody', sans-serif;">Add Clinical Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveServiceForm" action="<?= ViewHelper::url('vet/services') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="service_id" id="formServiceId" value="">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-dark">Service Title *</label>
                        <input type="text" name="name" id="formServiceName" class="form-control rounded-3 py-2" placeholder="e.g. Comprehensive Physical Wellness Exam" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Category *</label>
                            <select name="category" id="formServiceCategory" class="form-select rounded-3 py-2" required>
                                <option value="General Checkup">General Checkup</option>
                                <option value="Vaccination">Vaccination</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Dental">Dental Care</option>
                                <option value="Emergency">Emergency Triage</option>
                                <option value="Telehealth">Telehealth Video</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Duration (Minutes) *</label>
                            <input type="number" name="duration_minutes" id="formServiceDuration" class="form-control rounded-3 py-2 text-center font-monospace" value="30" min="10" step="5" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Fee ($ USD) *</label>
                            <input type="number" step="0.01" name="price" id="formServicePrice" class="form-control rounded-3 py-2 text-center font-monospace" placeholder="45.00" required>
                        </div>
                        <div class="col-6">
                            <label class="form-label small fw-bold text-dark">Status *</label>
                            <select name="is_active" id="formServiceActive" class="form-select rounded-3 py-2">
                                <option value="1">Active (Published)</option>
                                <option value="0">Disabled (Hidden)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-0">
                        <label class="form-label small fw-bold text-dark">Clinical Notes &amp; Scope</label>
                        <textarea name="description" id="formServiceDesc" class="form-control rounded-3" rows="3" placeholder="Describe clinical examination details, diagnostic prerequisites, or preparation instructions..."></textarea>
                    </div>
                </div>

                <div class="modal-footer p-3 px-4 border-top bg-light">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-5 fw-bold shadow-sm">Save Service</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function resetServiceForm() {
    document.getElementById('serviceModalTitle').textContent = 'Add Clinical Service';
    document.getElementById('formServiceId').value = '';
    document.getElementById('formServiceName').value = '';
    document.getElementById('formServiceCategory').value = 'General Checkup';
    document.getElementById('formServiceDuration').value = '30';
    document.getElementById('formServicePrice').value = '45.00';
    document.getElementById('formServiceActive').value = '1';
    document.getElementById('formServiceDesc').value = '';
}

function editService(srv) {
    document.getElementById('serviceModalTitle').textContent = 'Edit Clinical Service';
    document.getElementById('formServiceId').value = srv.id;
    document.getElementById('formServiceName').value = srv.name;
    document.getElementById('formServiceCategory').value = srv.category;
    document.getElementById('formServiceDuration').value = srv.duration_minutes;
    document.getElementById('formServicePrice').value = srv.price;
    document.getElementById('formServiceActive').value = srv.is_active ? '1' : '0';
    document.getElementById('formServiceDesc').value = srv.description || '';

    const modalEl = document.getElementById('serviceModal');
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modal.show();
}

async function deleteService(id) {
    if (!confirm('Are you sure you want to remove this service from your catalog?')) return;
    try {
        const res = await PetGuardAjax.post(`vet/services/${id}/delete`, {});
        if (res.ok) {
            PetGuardToast.success(res.message || 'Service deleted.');
            window.location.reload();
        } else {
            PetGuardToast.error(res.message || 'Failed to delete service.');
        }
    } catch (e) {
        PetGuardToast.error('Network error deleting service.');
    }
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#saveServiceForm', {
        loadingText: 'Saving Clinical Service...',
        reload: true
    });
});
</script>
