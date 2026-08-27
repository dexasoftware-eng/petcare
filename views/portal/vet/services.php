<?php
use Helpers\ViewHelper;
?>

<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title"><i class="fa-solid fa-briefcase-medical text-brand me-2"></i> Clinical Services & Consultation Fees</h2>
        <p class="admin-page-subtitle">Configure services, consultation durations, and fees available to pet parents.</p>
    </div>
    <div>
        <button type="button" class="btn btn-admin-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#serviceModal" onclick="resetServiceForm()">
            <i class="fa-solid fa-plus me-1"></i> Add New Service
        </button>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h3 class="admin-card-title m-0"><i class="fa-solid fa-list-check text-brand me-2"></i> Active Service Catalog</h3>
        <span class="badge bg-light text-dark border"><?= count($services ?? []) ?> Services</span>
    </div>

    <div class="admin-card-body p-0">
        <?php if (empty($services)): ?>
            <div class="p-5 text-center text-muted">
                <i class="fa-solid fa-stethoscope fa-3x mb-3 text-muted"></i>
                <h5 class="fw-bold">No clinical services defined</h5>
                <p class="small text-muted">Click "+ Add New Service" to publish consultation options.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive m-0">
                <table class="table table-hover align-middle m-0">
                    <thead class="table-light small">
                        <tr>
                            <th class="ps-4">Service Name</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Fee ($)</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services as $srv): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-dark"><?= ViewHelper::e($srv['name']) ?></div>
                                    <div class="small text-muted"><?= ViewHelper::e($srv['description'] ?: 'No description provided') ?></div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-secondary border px-2 py-1"><?= ViewHelper::e($srv['category']) ?></span>
                                </td>
                                <td>
                                    <span class="small text-muted"><i class="fa-regular fa-clock me-1"></i><?= $srv['duration_minutes'] ?> mins</span>
                                </td>
                                <td>
                                    <span class="fw-bold text-dark fs-6">$<?= number_format((float)$srv['price'], 2) ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($srv['is_active'])): ?>
                                        <span class="admin-badge badge-success">Active</span>
                                    <?php else: ?>
                                        <span class="admin-badge badge-neutral">Disabled</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-end pe-4">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3 me-1" onclick='editService(<?= json_encode($srv) ?>)'>
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="deleteService(<?= $srv['id'] ?>)">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal: Add/Edit Service -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header border-bottom">
                <h5 class="modal-title fw-bold" id="serviceModalTitle">Add Clinical Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="saveServiceForm" action="<?= ViewHelper::url('vet/services') ?>" method="POST">
                <?= ViewHelper::csrfField() ?>
                <input type="hidden" name="service_id" id="formServiceId" value="">

                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Service Title</label>
                        <input type="text" name="name" id="formServiceName" class="form-control" placeholder="e.g. Comprehensive Physical Wellness Exam" required>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Category</label>
                            <select name="category" id="formServiceCategory" class="form-select" required>
                                <option value="Preventive Care">Preventive Care</option>
                                <option value="Telehealth">Telehealth</option>
                                <option value="Vaccinations">Vaccinations</option>
                                <option value="Surgery">Surgery</option>
                                <option value="Specialty">Specialty</option>
                                <option value="Dental">Dental</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Consultation Fee ($ USD)</label>
                            <input type="number" step="0.01" name="price" id="formServicePrice" class="form-control" placeholder="50.00" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Estimated Duration (Mins)</label>
                            <input type="number" name="duration_minutes" id="formServiceDuration" class="form-control" value="30" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Catalog Status</label>
                            <select name="is_active" id="formServiceActive" class="form-select">
                                <option value="1">Active / Bookable</option>
                                <option value="0">Draft / Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label small fw-bold">Clinical Description / Inclusions</label>
                        <textarea name="description" id="formServiceDescription" class="form-control" rows="3" placeholder="Explain what is included in this clinical appointment..."></textarea>
                    </div>
                </div>

                <div class="modal-footer border-top p-3 bg-light rounded-bottom-4">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-admin-primary rounded-pill px-4">Save Service</button>
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
    document.getElementById('formServicePrice').value = '';
    document.getElementById('formServiceDuration').value = '30';
    document.getElementById('formServiceDescription').value = '';
    document.getElementById('formServiceActive').value = '1';
}

function editService(srv) {
    document.getElementById('serviceModalTitle').textContent = 'Edit Clinical Service';
    document.getElementById('formServiceId').value = srv.id;
    document.getElementById('formServiceName').value = srv.name;
    document.getElementById('formServiceCategory').value = srv.category;
    document.getElementById('formServicePrice').value = srv.price;
    document.getElementById('formServiceDuration').value = srv.duration_minutes;
    document.getElementById('formServiceDescription').value = srv.description || '';
    document.getElementById('formServiceActive').value = srv.is_active;

    const modal = new bootstrap.Modal(document.getElementById('serviceModal'));
    modal.show();
}

async function deleteService(id) {
    const confirmed = await PetGuardModal.danger({
        title: 'Delete Service?',
        message: 'Are you sure you want to remove this service from your clinical offerings?'
    });

    if (confirmed) {
        const res = await PetGuardAjax.post(`vet/services/${id}/delete`);
        if (res.ok) {
            PetGuardToast.success('Service removed.');
            setTimeout(() => window.location.reload(), 600);
        } else {
            PetGuardToast.error(res.message || 'Unable to delete service.');
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    PetGuardAjax.bindForm('#saveServiceForm', {
        loadingText: 'Saving Service...',
        reload: true
    });
});
</script>
