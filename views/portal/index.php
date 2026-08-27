<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$role = $user['role'] ?? 'petowner';
?>

<!-- 1. Unified Dashboard Page Header -->
<div class="admin-page-header">
    <div>
        <h2 class="admin-page-title">Welcome back, <?= ViewHelper::e($user['name']) ?>! 👋</h2>
        <p class="admin-page-subtitle">
            <?= ucfirst($role) ?> Portal Workspace &middot; <?= ViewHelper::e($user['email']) ?>
            <?php if (!empty($user['phone'])): ?> &middot; <?= ViewHelper::e($user['phone']) ?><?php endif; ?>
        </p>
    </div>
    <div class="d-flex gap-2 flex-wrap">
        <?php if ($role === 'veterinarian'): ?>
            <a href="<?= ViewHelper::url('portal/emergency') ?>" class="btn btn-outline-danger rounded-pill px-3 fw-semibold">
                <i class="fa-solid fa-truck-medical me-1"></i> Emergency Triage
            </a>
        <?php elseif ($role === 'shelter'): ?>
            <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addRescuePetModal">
                <i class="fa-solid fa-plus me-1"></i> List Animal for Adoption
            </button>
        <?php endif; ?>
    </div>
</div>

<!-- 2. Role-Differentiated Main Content -->
<?php if ($role === 'veterinarian'): ?>
    <!-- VETERINARIAN WORKSPACE -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Patient Queue</span>
                    <div class="stat-card-icon icon-blue">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?= count($appointments ?? []) ?></div>
                <div class="stat-card-footer text-muted">Active scheduled consultations</div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Clinical Rating</span>
                    <div class="stat-card-icon icon-green">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                </div>
                <div class="stat-card-value">4.9 / 5.0</div>
                <div class="stat-card-footer text-success fw-bold"><i class="fa-solid fa-star text-warning"></i> Accredited Clinician</div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Practice Center</span>
                    <div class="stat-card-icon icon-orange">
                        <i class="fa-solid fa-hospital"></i>
                    </div>
                </div>
                <div class="stat-card-value" style="font-size: 20px;"><?= ViewHelper::e($profile['clinic_name'] ?? 'PetGuard Hospital') ?></div>
                <div class="stat-card-footer text-muted"><?= ViewHelper::e($profile['specialization'] ?? 'General Small Animal') ?></div>
            </div>
        </div>
    </div>

    <!-- Patient Consultations Table -->
    <div class="admin-card mb-4">
        <div class="admin-card-header d-flex justify-content-between align-items-center">
            <h3 class="admin-card-title m-0"><i class="fa-solid fa-clipboard-list text-brand me-2"></i> Patient Consultations Queue</h3>
            <span class="badge bg-light text-dark border"><?= count($appointments ?? []) ?> Booked</span>
        </div>
        <div class="admin-card-body p-0">
            <?php if (empty($appointments)): ?>
                <div class="p-5 text-center text-muted">No patient appointments currently booked in your queue.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light small">
                            <tr>
                                <th class="ps-4">Patient (Pet)</th>
                                <th>Owner Contact</th>
                                <th>Date & Time</th>
                                <th>Type & Symptoms</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Manage Slot</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $appt): ?>
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                        <div class="small text-muted"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?> • <?= ViewHelper::e($appt['pet_breed'] ?? '') ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?= ViewHelper::e($appt['owner_name'] ?? 'Pet Parent') ?></div>
                                        <div class="small text-muted"><i class="fa-solid fa-phone me-1 text-success"></i> <?= ViewHelper::e($appt['owner_phone'] ?? '—') ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?></div>
                                        <div class="small text-muted"><i class="fa-regular fa-clock me-1"></i> <?= ViewHelper::e($appt['appointment_time']) ?></div>
                                    </td>
                                    <td style="max-width: 250px;">
                                        <div class="badge bg-light text-dark border mb-1"><?= ViewHelper::e($appt['consultation_type']) ?></div>
                                        <div class="small text-muted text-truncate"><?= ViewHelper::e($appt['symptoms']) ?></div>
                                    </td>
                                    <td>
                                        <?php
                                            $badge = match($appt['status']) {
                                                'confirmed' => 'bg-primary',
                                                'completed' => 'bg-success',
                                                'cancelled' => 'bg-danger',
                                                default => 'bg-warning text-dark'
                                            };
                                        ?>
                                        <span class="badge <?= $badge ?> text-uppercase"><?= ucfirst($appt['status']) ?></span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-dark rounded-pill dropdown-toggle px-3" type="button" data-bs-toggle="dropdown">
                                                Update Status
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-2">
                                                <li>
                                                    <form action="<?= ViewHelper::url('portal/appointments/' . $appt['id'] . '/status') ?>" method="POST">
                                                        <?= ViewHelper::csrfField() ?>
                                                        <input type="hidden" name="status" value="confirmed">
                                                        <button type="submit" class="dropdown-item py-2 text-primary fw-semibold"><i class="fa-solid fa-check me-2"></i> Confirm</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="<?= ViewHelper::url('portal/appointments/' . $appt['id'] . '/status') ?>" method="POST">
                                                        <?= ViewHelper::csrfField() ?>
                                                        <input type="hidden" name="status" value="completed">
                                                        <button type="submit" class="dropdown-item py-2 text-success fw-semibold"><i class="fa-solid fa-circle-check me-2"></i> Mark Completed</button>
                                                    </form>
                                                </li>
                                                <li>
                                                    <form action="<?= ViewHelper::url('portal/appointments/' . $appt['id'] . '/status') ?>" method="POST">
                                                        <?= ViewHelper::csrfField() ?>
                                                        <input type="hidden" name="status" value="cancelled">
                                                        <button type="submit" class="dropdown-item py-2 text-danger fw-semibold"><i class="fa-solid fa-ban me-2"></i> Cancel</button>
                                                    </form>
                                                </li>
                                            </ul>
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

<?php elseif ($role === 'shelter'): ?>
    <!-- SHELTER RESCUE WORKSPACE -->
    <div class="row g-3 mb-4">
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Rescue Animals</span>
                    <div class="stat-card-icon icon-purple">
                        <i class="fa-solid fa-paw"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?= count($pets ?? []) ?></div>
                <div class="stat-card-footer text-muted">Currently hosted in sanctuary</div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Shelter Capacity</span>
                    <div class="stat-card-icon icon-blue">
                        <i class="fa-solid fa-house-medical"></i>
                    </div>
                </div>
                <div class="stat-card-value"><?= (int)($profile['capacity'] ?? 50) ?></div>
                <div class="stat-card-footer text-success fw-bold">Licensed Animal Sanctuary</div>
            </div>
        </div>
        <div class="col-xl-4 col-sm-6">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-label">Adoption Pipeline</span>
                    <div class="stat-card-icon icon-green">
                        <i class="fa-solid fa-heart"></i>
                    </div>
                </div>
                <div class="stat-card-value">Active</div>
                <div class="stat-card-footer text-muted">Adoption applications open</div>
            </div>
        </div>
    </div>

    <!-- Rescue Animals Showcase -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold text-dark m-0"><i class="fa-solid fa-heart text-danger me-2"></i> Rescue Animals for Adoption (<?= count($pets ?? []) ?>)</h4>
        <button type="button" class="btn-admin-primary" data-bs-toggle="modal" data-bs-target="#addRescuePetModal">+ List Animal</button>
    </div>

    <?php if (empty($pets)): ?>
        <div class="admin-card p-5 text-center text-muted mb-4">
            <i class="fa-solid fa-hand-holding-heart fs-1 mb-3 text-warning"></i>
            <h5>No rescue animals listed</h5>
            <p class="small mb-3">List animals available at your sanctuary for prospective adopters to see.</p>
            <button type="button" class="btn-admin-primary mx-auto" data-bs-toggle="modal" data-bs-target="#addRescuePetModal">Add Rescue Animal</button>
        </div>
    <?php else: ?>
        <div class="row g-4 mb-4">
            <?php foreach ($pets as $pet): ?>
                <div class="col-lg-6">
                    <div class="admin-card p-4 h-100 border">
                        <div class="d-flex gap-3 align-items-start mb-3">
                            <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2 border" style="width: 80px; height: 80px; object-fit: contain; background: #fff8e5;">
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h4 class="fw-bold text-dark m-0"><?= ViewHelper::e($pet['name']) ?></h4>
                                    <span class="badge bg-primary rounded-pill px-3 py-1 text-uppercase"><?= $pet['adoption_status'] ?? 'Available' ?></span>
                                </div>
                                <span class="text-muted small"><?= ViewHelper::e($pet['species']) ?> • <?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['age']) ?>)</span>
                                <div class="mt-2 small text-muted"><?= ViewHelper::e($pet['medical_notes'] ?: 'Vaccinated rescue animal ready for forever home.') ?></div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                            <form action="<?= ViewHelper::url('portal/adoptions/' . $pet['id'] . '/status') ?>" method="POST" class="d-flex gap-2">
                                <?= ViewHelper::csrfField() ?>
                                <select name="adoption_status" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()">
                                    <option value="available" <?= ($pet['adoption_status'] ?? '') === 'available' ? 'selected' : '' ?>>Available</option>
                                    <option value="pending" <?= ($pet['adoption_status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="adopted" <?= ($pet['adoption_status'] ?? '') === 'adopted' ? 'selected' : '' ?>>Adopted 🎉</option>
                                </select>
                            </form>
                            <form action="<?= ViewHelper::url('portal/adoptions/' . $pet['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Remove listing?');">
                                <?= ViewHelper::csrfField() ?>
                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="fa-solid fa-trash me-1"></i> Remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Modal: Add Rescue Pet -->
    <div class="modal fade" id="addRescuePetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-paw text-brand me-2"></i> List Animal for Adoption</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= ViewHelper::url('portal/adoptions/create') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Animal Name *</label>
                            <input type="text" name="name" class="form-control rounded-3" required placeholder="e.g. Bella">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Species *</label>
                                <select name="species" class="form-select rounded-3">
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold">Breed *</label>
                                <input type="text" name="breed" class="form-control rounded-3" required placeholder="Labrador Mix">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Gender *</label>
                                <select name="gender" class="form-select rounded-3">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Age *</label>
                                <input type="text" name="age" class="form-control rounded-3" required placeholder="2 yrs">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold">Weight *</label>
                                <input type="text" name="weight" class="form-control rounded-3" required placeholder="18 kg">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Rescue & Behavioral Notes</label>
                            <textarea name="medical_notes" rows="3" class="form-control rounded-3" placeholder="Friendly with other dogs, vaccinated, spayed/neutered..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn-admin-primary px-4"><i class="fa-solid fa-plus me-1"></i> List for Adoption</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endif; ?>
