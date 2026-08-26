<?php
use Helpers\ViewHelper;
use Helpers\Auth;

$role = $user['role'] ?? 'petowner';
?>

<!-- 1. Top Welcome Banner -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="p-4 rounded-4 shadow-sm border-0 d-flex flex-wrap justify-content-between align-items-center gap-3" style="background-color: #fff8e5; border-left: 5px solid #fa441d !important;">
            <div>
                <span class="badge bg-danger rounded-pill px-3 py-1 mb-2 text-uppercase fw-bold">
                    <i class="fa-solid fa-shield-cat me-1"></i> <?= $role === 'petowner' ? 'Pet Owner' : ucfirst($role) ?> Dashboard
                </span>
                <h3 class="fw-bold m-0 text-dark">Welcome back, <?= ViewHelper::e($user['name']) ?>!</h3>
                <p class="text-muted small m-0 mt-1">
                    <i class="fa-solid fa-envelope me-1"></i> <?= ViewHelper::e($user['email']) ?>
                    <?php if (!empty($user['phone'])): ?> • <i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($user['phone']) ?><?php endif; ?>
                    <?php if (!empty($user['address'])): ?> • <i class="fa-solid fa-location-dot me-1"></i> <?= ViewHelper::e($user['address']) ?><?php endif; ?>
                </p>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <?php if ($role === 'petowner'): ?>
                    <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#addPetModal">
                        <i class="fa-solid fa-plus me-1"></i> Register New Pet
                    </button>
                    <button type="button" class="btn btn-outline-dark rounded-pill fw-semibold px-3" data-bs-toggle="modal" data-bs-target="#bookApptModal">
                        <i class="fa-solid fa-calendar-check me-1"></i> Book Vet
                    </button>
                <?php elseif ($role === 'shelter'): ?>
                    <button type="button" class="btn btn-brand" data-bs-toggle="modal" data-bs-target="#addRescuePetModal">
                        <i class="fa-solid fa-plus me-1"></i> List Animal for Adoption
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- 2. Role-Differentiated Main Content -->

<?php if ($role === 'petowner'): ?>
    <!-- PET OWNER DASHBOARD -->
    <!-- Registered Pets Grid -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold m-0"><i class="fa-solid fa-dog text-brand me-2"></i> Registered Pets (<?= count($pets ?? []) ?>)</h4>
        </div>

        <?php if (empty($pets)): ?>
            <div class="card card-custom text-center p-5">
                <i class="fa-solid fa-paw fs-1 text-muted mb-3"></i>
                <h5 class="fw-bold">No pets registered yet</h5>
                <p class="text-muted small mb-4">Register your dog, cat, or companion animal to track health scores and generate their Digital QR Passport.</p>
                <button type="button" class="btn btn-brand mx-auto" data-bs-toggle="modal" data-bs-target="#addPetModal">
                    <i class="fa-solid fa-plus me-1"></i> Add Your First Pet
                </button>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($pets as $pet): ?>
                    <div class="col-lg-6">
                        <div class="card card-custom p-4 h-100">
                            <div class="d-flex gap-3 align-items-start mb-3">
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2" style="width: 85px; height: 85px; object-fit: contain; background: #fff8e5;">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="fw-bold m-0"><?= ViewHelper::e($pet['name']) ?></h4>
                                        <span class="badge bg-success rounded-pill px-3 py-1">Care Score: <?= $pet['care_score'] ?? 90 ?>/100</span>
                                    </div>
                                    <span class="text-muted small"><?= ViewHelper::e($pet['breed']) ?> • <?= ViewHelper::e($pet['gender']) ?> • <?= ViewHelper::e($pet['age']) ?></span>
                                    <div class="mt-2 small">
                                        <span class="badge bg-light text-dark border"><i class="fa-solid fa-weight-scale me-1"></i> <?= ViewHelper::e($pet['weight']) ?></span>
                                        <span class="badge bg-light text-dark border"><i class="fa-solid fa-syringe me-1"></i> <?= ViewHelper::e($pet['vaccination_status']) ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="p-3 rounded-3 bg-light border mb-3">
                                <div class="row g-2 small">
                                    <div class="col-6"><strong>Microchip:</strong> <?= ViewHelper::e($pet['microchip_id'] ?: 'Pending Chip') ?></div>
                                    <div class="col-6"><strong>QR Passport:</strong> <code><?= ViewHelper::e($pet['qr_token'] ?: 'QR-ACTIVE') ?></code></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <span class="small text-muted"><i class="fa-solid fa-shield-halved text-success me-1"></i> PetGuard Protected</span>
                                <form action="<?= ViewHelper::url('portal/pets/' . $pet['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Remove pet profile?');">
                                    <?= ViewHelper::csrfField() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                        <i class="fa-solid fa-trash me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Scheduled Appointments Table -->
    <div class="mb-5">
        <h4 class="fw-bold mb-3"><i class="fa-solid fa-calendar-check text-brand me-2"></i> Vet Appointments (<?= count($appointments ?? []) ?>)</h4>
        <div class="card card-custom p-0 overflow-hidden">
            <?php if (empty($appointments)): ?>
                <div class="p-4 text-center text-muted small">No scheduled vet appointments. Use "Book Vet" to schedule a clinic visit.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Pet</th>
                                <th>Consultation Type</th>
                                <th>Date & Time</th>
                                <th>Symptoms / Notes</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $appt): ?>
                                <tr>
                                    <td class="ps-4 fw-bold"><?= ViewHelper::e($appt['pet_name']) ?> (<?= ViewHelper::e($appt['pet_breed']) ?>)</td>
                                    <td><?= ViewHelper::e($appt['consultation_type']) ?></td>
                                    <td><?= date('M d, Y', strtotime($appt['appointment_date'])) ?> at <?= ViewHelper::e($appt['appointment_time']) ?></td>
                                    <td class="small text-muted" style="max-width: 250px;"><?= ViewHelper::e($appt['symptoms']) ?></td>
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
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal: Add Pet -->
    <div class="modal fade" id="addPetModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-paw text-brand me-2"></i> Register New Pet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= ViewHelper::url('portal/pets/create') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pet Name *</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Milo">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Species *</label>
                                <select name="species" class="form-select">
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Bird">Bird</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Breed *</label>
                                <input type="text" name="breed" class="form-control" required placeholder="e.g. Golden Retriever">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Gender *</label>
                                <select name="gender" class="form-select">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Age *</label>
                                <input type="text" name="age" class="form-control" required placeholder="e.g. 2 yrs">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Weight *</label>
                                <input type="text" name="weight" class="form-control" required placeholder="e.g. 28 kg">
                            </div>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Microchip ID (Optional)</label>
                                <input type="text" name="microchip_id" class="form-control" placeholder="985141000...">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Blood Group (Optional)</label>
                                <input type="text" name="blood_group" class="form-control" placeholder="e.g. DEA 1.1 Pos">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-brand px-4"><i class="fa-solid fa-check me-1"></i> Save Pet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal: Book Appointment -->
    <div class="modal fade" id="bookApptModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold"><i class="fa-solid fa-stethoscope text-brand me-2"></i> Book Vet Consultation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= ViewHelper::url('portal/appointments/book') ?>" method="POST">
                    <?= ViewHelper::csrfField() ?>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Pet *</label>
                            <select name="pet_id" class="form-select" required>
                                <?php foreach ($pets ?? [] as $p): ?>
                                    <option value="<?= $p['id'] ?>"><?= ViewHelper::e($p['name']) ?> (<?= ViewHelper::e($p['breed']) ?>)</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Preferred Date *</label>
                                <input type="date" name="appointment_date" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Preferred Time *</label>
                                <select name="appointment_time" class="form-select">
                                    <option value="09:00 AM">09:00 AM</option>
                                    <option value="11:00 AM">11:00 AM</option>
                                    <option value="02:00 PM">02:00 PM</option>
                                    <option value="04:30 PM">04:30 PM</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Consultation Type *</label>
                            <select name="consultation_type" class="form-select">
                                <option value="General Health Checkup">General Health Checkup</option>
                                <option value="Vaccination & Immunization">Vaccination & Immunization</option>
                                <option value="Surgical Follow-up">Surgical Follow-up</option>
                                <option value="Emergency Care">Emergency Care</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Select Clinic Doctor (Optional)</label>
                            <select name="vet_id" class="form-select">
                                <option value="">Any Available Specialist</option>
                                <?php foreach ($vets ?? [] as $v): ?>
                                    <option value="<?= $v['id'] ?>"><?= ViewHelper::e($v['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Symptoms / Notes *</label>
                            <textarea name="symptoms" rows="3" class="form-control" required placeholder="Describe what symptoms your pet is showing..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-brand px-4"><i class="fa-solid fa-calendar-check me-1"></i> Confirm Booking</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($role === 'veterinarian'): ?>
    <!-- VETERINARIAN DASHBOARD -->
    <div class="mb-5">
        <h4 class="fw-bold mb-3"><i class="fa-solid fa-clipboard-list text-brand me-2"></i> Patient Consultations Queue (<?= count($appointments ?? []) ?>)</h4>
        <div class="card card-custom p-0 overflow-hidden">
            <?php if (empty($appointments)): ?>
                <div class="p-5 text-center text-muted">No patient appointments currently booked in your queue.</div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle m-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Patient (Pet)</th>
                                <th>Owner Details</th>
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
                                        <div class="fw-bold"><?= ViewHelper::e($appt['pet_name']) ?></div>
                                        <div class="small text-muted"><?= ViewHelper::e($appt['species'] ?? 'Pet') ?> • <?= ViewHelper::e($appt['pet_breed']) ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold"><?= ViewHelper::e($appt['owner_name']) ?></div>
                                        <div class="small text-muted"><i class="fa-solid fa-phone me-1"></i> <?= ViewHelper::e($appt['owner_phone']) ?></div>
                                    </td>
                                    <td>
                                        <div class="fw-bold"><?= date('M d, Y', strtotime($appt['appointment_date'])) ?></div>
                                        <div class="small text-muted"><?= ViewHelper::e($appt['appointment_time']) ?></div>
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
                                                Action
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
                                                        <button type="submit" class="dropdown-item py-2 text-success fw-semibold"><i class="fa-solid fa-circle-check me-2"></i> Completed</button>
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
    <!-- SHELTER RESCUE DASHBOARD -->
    <div class="mb-5">
        <h4 class="fw-bold mb-3"><i class="fa-solid fa-heart text-danger me-2"></i> Rescue Animals for Adoption (<?= count($pets ?? []) ?>)</h4>
        <?php if (empty($pets)): ?>
            <div class="card card-custom p-5 text-center text-muted">
                <i class="fa-solid fa-hand-holding-heart fs-1 mb-3 text-warning"></i>
                <h5>No rescue animals listed</h5>
                <p class="small mb-3">List animals available at your sanctuary for prospective adopters to see.</p>
                <button type="button" class="btn btn-brand mx-auto" data-bs-toggle="modal" data-bs-target="#addRescuePetModal">Add Rescue Animal</button>
            </div>
        <?php else: ?>
            <div class="row g-4">
                <?php foreach ($pets as $pet): ?>
                    <div class="col-lg-6">
                        <div class="card card-custom p-4 h-100">
                            <div class="d-flex gap-3 align-items-start mb-3">
                                <img src="<?= ViewHelper::asset($pet['avatar']) ?>" alt="<?= ViewHelper::e($pet['name']) ?>" class="rounded-4 p-2" style="width: 80px; height: 80px; object-fit: contain; background: #fff8e5;">
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <h4 class="fw-bold m-0"><?= ViewHelper::e($pet['name']) ?></h4>
                                        <span class="badge bg-primary rounded-pill px-3 py-1 text-uppercase"><?= $pet['adoption_status'] ?? 'Available' ?></span>
                                    </div>
                                    <span class="text-muted small"><?= ViewHelper::e($pet['species']) ?> • <?= ViewHelper::e($pet['breed']) ?> (<?= ViewHelper::e($pet['age']) ?>)</span>
                                    <div class="mt-2 small text-muted"><?= ViewHelper::e($pet['medical_notes'] ?: 'Vaccinated rescue animal.') ?></div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                <form action="<?= ViewHelper::url('portal/adoptions/' . $pet['id'] . '/status') ?>" method="POST" class="d-flex gap-2">
                                    <?= ViewHelper::csrfField() ?>
                                    <select name="adoption_status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="available" <?= ($pet['adoption_status'] ?? '') === 'available' ? 'selected' : '' ?>>Available</option>
                                        <option value="pending" <?= ($pet['adoption_status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                                        <option value="adopted" <?= ($pet['adoption_status'] ?? '') === 'adopted' ? 'selected' : '' ?>>Adopted 🎉</option>
                                    </select>
                                </form>
                                <form action="<?= ViewHelper::url('portal/adoptions/' . $pet['id'] . '/delete') ?>" method="POST" onsubmit="return confirm('Remove listing?');">
                                    <?= ViewHelper::csrfField() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

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
                            <label class="form-label fw-semibold">Animal Name *</label>
                            <input type="text" name="name" class="form-control" required placeholder="e.g. Bella">
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Species *</label>
                                <select name="species" class="form-select">
                                    <option value="Dog">Dog</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Breed *</label>
                                <input type="text" name="breed" class="form-control" required placeholder="Labrador Mix">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Gender *</label>
                                <select name="gender" class="form-select">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Age *</label>
                                <input type="text" name="age" class="form-control" required placeholder="1.5 yrs">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold">Weight *</label>
                                <input type="text" name="weight" class="form-control" required placeholder="22 kg">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Behavioral & Medical Notes</label>
                            <textarea name="medical_notes" rows="3" class="form-control" placeholder="House-trained, friendly..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-brand px-4">Publish Listing</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php elseif ($role === 'admin'): ?>
    <!-- ADMIN DASHBOARD -->
    <div class="row g-4 mb-4">
        <div class="col-lg-3 col-md-6">
            <div class="card card-custom p-4">
                <span class="text-muted small fw-bold text-uppercase">Total Users</span>
                <h2 class="fw-bolder my-1 text-dark"><?= $stats['totalUsers'] ?? 0 ?></h2>
                <span class="small text-muted"><?= $stats['totalOwners'] ?? 0 ?> Owners • <?= $stats['totalVets'] ?? 0 ?> Vets</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-custom p-4">
                <span class="text-muted small fw-bold text-uppercase">Registered Pets</span>
                <h2 class="fw-bolder my-1 text-dark"><?= $stats['totalPets'] ?? 0 ?></h2>
                <span class="small text-success fw-semibold"><i class="fa-solid fa-shield-halved me-1"></i> Active Passports</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-custom p-4">
                <span class="text-muted small fw-bold text-uppercase">Shop Orders</span>
                <h2 class="fw-bolder my-1 text-dark"><?= $stats['totalOrders'] ?? 0 ?></h2>
                <span class="small text-muted">Marketplace Orders</span>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card card-custom p-4">
                <span class="text-muted small fw-bold text-uppercase">Audit Logs</span>
                <h2 class="fw-bolder my-1 text-dark"><?= $stats['recentLogsCount'] ?? 0 ?></h2>
                <span class="small text-muted">Security Audit Trace</span>
            </div>
        </div>
    </div>

    <!-- User Governance Table -->
    <div class="card card-custom p-0 overflow-hidden mb-4">
        <div class="p-3 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold m-0"><i class="fa-solid fa-users me-2"></i> User Directory</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle m-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th class="text-end pe-4">Status Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users ?? [] as $u): ?>
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark"><?= ViewHelper::e($u['name']) ?></div>
                                <div class="small text-muted"><?= ViewHelper::e($u['email']) ?></div>
                            </td>
                            <td><span class="badge bg-secondary text-uppercase"><?= $u['role'] ?></span></td>
                            <td><span class="badge bg-success text-uppercase"><?= $u['status'] ?></span></td>
                            <td class="small text-muted"><?= date('M d, Y', strtotime($u['created_at'])) ?></td>
                            <td class="text-end pe-4">
                                <form action="<?= ViewHelper::url('portal/governance/users/' . $u['id'] . '/status') ?>" method="POST" class="d-inline-flex gap-1">
                                    <?= ViewHelper::csrfField() ?>
                                    <select name="status" class="form-select form-select-sm py-1" onchange="this.form.submit()" style="font-size: 12px; width: 110px;">
                                        <option value="active" <?= $u['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="suspended" <?= $u['status'] === 'suspended' ? 'selected' : '' ?>>Suspend</option>
                                        <option value="disabled" <?= $u['status'] === 'disabled' ? 'selected' : '' ?>>Disable</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>
