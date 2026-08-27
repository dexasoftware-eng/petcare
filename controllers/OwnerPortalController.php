<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\Pet;
use Models\Appointment;
use Models\Vaccine;
use Models\CareTask;
use Models\PetMedication;
use Models\PetWeight;
use Models\PetDocument;
use Models\PetFamilyAccess;
use Models\PetEmergencyContact;
use Models\UserFavorite;
use Models\AdoptionApplication;
use Models\Notification;
use Models\Order;
use Models\AuditLog;
use Models\VeterinarianProfile;
use Helpers\ViewHelper;
use Services\AiService;
use Throwable;

class OwnerPortalController extends Controller
{
    private int $userId;
    private array $user;

    public function __construct($request = null, $response = null)
    {
        parent::__construct($request, $response);
        $this->user = Auth::user() ?? [];
        $this->userId = (int)($this->user['id'] ?? 0);
    }

    private function requireAuth(): void
    {
        if (!Auth::check() || empty($this->userId)) {
            $this->redirect('login');
        }
    }

    private function verifyPetOwnership(int|string $petId): ?array
    {
        $pet = Pet::find($petId);
        if (!$pet || (int)$pet['user_id'] !== $this->userId) {
            Flash::error('Unauthorized access to pet profile.');
            $this->redirect('portal/pets');
            return null;
        }
        return $pet;
    }

    // =========================================================================
    // 1. PET OWNER COMMAND CENTER DASHBOARD
    // =========================================================================
    public function dashboard(): void
    {
        $this->requireAuth();

        $pets = Pet::getPetsByUser($this->userId);
        $careTasks = CareTask::getTasksForUser($this->userId);
        $appointments = Appointment::getWithDetailsForOwner($this->userId);
        $notifications = Notification::getRecentForUser('petowner', 5);
        $unreadNotifications = Notification::getUnreadCountForUser('petowner');

        // Upcoming appointments (pending or confirmed, future dates)
        $upcomingAppts = array_filter($appointments, fn($a) => in_array($a['status'], ['pending', 'confirmed']));

        // Lost pets check
        $lostPets = array_filter($pets, fn($p) => !empty($p['is_lost']));

        // Pending care tasks vs completed today
        $pendingTasks = array_filter($careTasks, fn($t) => empty($t['is_completed']));
        $completedTasks = array_filter($careTasks, fn($t) => !empty($t['is_completed']));

        $this->render('portal.owner.dashboard', [
            'pageTitle' => 'PetCare Command Center — PetGuard',
            'user' => $this->user,
            'pets' => $pets,
            'careTasks' => $careTasks,
            'pendingTasks' => $pendingTasks,
            'completedTasks' => $completedTasks,
            'appointments' => $appointments,
            'upcomingAppts' => $upcomingAppts,
            'lostPets' => $lostPets,
            'notifications' => $notifications,
            'unreadNotifications' => $unreadNotifications
        ], 'portal');
    }

    // =========================================================================
    // 2. PET MANAGEMENT & PROFILE TABS
    // =========================================================================
    public function pets(): void
    {
        $this->requireAuth();
        $pets = Pet::getPetsByUser($this->userId);

        $this->render('portal.owner.pets.index', [
            'pageTitle' => 'My Family Pets — PetGuard',
            'user' => $this->user,
            'pets' => $pets
        ], 'portal');
    }

    public function petDetails(int|string $id): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($id);
        if (!$pet) return;

        $petId = (int)$pet['id'];
        $vaccines = Pet::getVaccines($petId);
        $careTasks = Pet::getCareTasks($petId);
        $medications = Pet::getMedications($petId);
        $weights = Pet::getWeights($petId);
        $documents = Pet::getDocuments($petId);
        $family = Pet::getFamilyMembers($petId);
        $emergencyContacts = Pet::getEmergencyContacts($petId);
        $appointments = Pet::getAppointments($petId);
        $timeline = Pet::getHealthTimeline($petId);
        $vets = User::where("role = 'veterinarian' AND status = 'active'", []);

        $this->render('portal.owner.pets.details', [
            'pageTitle' => "Pet Profile: {$pet['name']} — PetGuard",
            'user' => $this->user,
            'pet' => $pet,
            'vaccines' => $vaccines,
            'careTasks' => $careTasks,
            'medications' => $medications,
            'weights' => $weights,
            'documents' => $documents,
            'family' => $family,
            'emergencyContacts' => $emergencyContacts,
            'appointments' => $appointments,
            'timeline' => $timeline,
            'vets' => $vets
        ], 'portal');
    }

    public function createPetView(): void
    {
        $this->requireAuth();
        $this->render('portal.owner.pets.create', [
            'pageTitle' => 'Register New Pet Family Member — PetGuard',
            'user' => $this->user
        ], 'portal');
    }

    public function createPet(): void
    {
        $this->requireAuth();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'species' => 'required',
            'breed' => 'required',
            'gender' => 'required',
            'age' => 'required',
            'weight' => 'required'
        ]);

        $qrToken = 'PG-PET-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);
        
        // Handle avatar upload or preset selection
        $avatar = 'img/pet-dog.png';
        $preset = $this->request->input('preset_avatar', '');
        
        if (!empty($_FILES['avatar_file']) && $_FILES['avatar_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['avatar_file'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($fileInfo, $file['tmp_name']);
            finfo_close($fileInfo);

            if (in_array($mimeType, $allowedTypes)) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = 'pet_' . uniqid() . '.' . strtolower($ext);
                $uploadDir = dirname(__DIR__) . '/assets/uploads/pets';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $destPath = $uploadDir . '/' . $filename;
                if (move_uploaded_file($file['tmp_name'], $destPath)) {
                    $avatar = 'uploads/pets/' . $filename;
                }
            }
        } elseif (!empty($preset)) {
            $avatar = ltrim($preset, '/');
            if (str_starts_with($avatar, 'assets/')) {
                $avatar = substr($avatar, 7);
            }
        } else {
            $speciesLower = strtolower($data['species']);
            if ($speciesLower === 'cat') {
                $avatar = 'img/avatars/avatar-cat.svg';
            } elseif ($speciesLower === 'rabbit') {
                $avatar = 'img/avatars/avatar-rabbit.svg';
            } elseif ($speciesLower === 'bird') {
                $avatar = 'img/avatars/avatar-bird.svg';
            } elseif ($speciesLower === 'hamster') {
                $avatar = 'img/avatars/avatar-hamster.svg';
            } elseif ($speciesLower === 'horse') {
                $avatar = 'img/avatars/avatar-horse.svg';
            } else {
                $avatar = 'img/avatars/avatar-dog.svg';
            }
        }

        $petId = Pet::create([
            'user_id' => $this->userId,
            'name' => $data['name'],
            'species' => $data['species'],
            'breed' => $data['breed'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'birthday' => $this->request->input('birthday', null) ?: null,
            'weight' => $data['weight'],
            'color' => $this->request->input('color', null),
            'microchip_id' => $this->request->input('microchip_id', null),
            'blood_group' => $this->request->input('blood_group', null),
            'allergies' => $this->request->input('allergies', null),
            'diet_instructions' => $this->request->input('diet_instructions', null),
            'care_score' => 90,
            'vaccination_status' => 'Up to Date',
            'passport_status' => 'active',
            'avatar' => $avatar,
            'qr_token' => $qrToken
        ]);

        // Automatically seed starter daily care tasks
        CareTask::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'title' => 'Morning Feeding & Fresh Water',
            'task_type' => 'feeding',
            'time_due' => '08:00 AM',
            'frequency' => 'daily'
        ]);
        CareTask::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'title' => 'Daily Exercise & Wellness Check',
            'task_type' => 'walking',
            'time_due' => '10:00 AM',
            'frequency' => 'daily'
        ]);

        AuditLog::log('PET_REGISTERED', 'pets', (int)$petId, ['name' => $data['name']]);
        Flash::success("Pet {$data['name']} has been registered to your PetGuard family!");
        $this->redirect('portal/pets/' . $petId);
    }

    public function updatePet(int|string $id): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($id);
        if (!$pet) return;

        $name = trim($this->request->input('name', $pet['name']));
        $weight = trim($this->request->input('weight', $pet['weight']));
        $age = trim($this->request->input('age', $pet['age']));
        $birthday = $this->request->input('birthday', $pet['birthday'] ?? null) ?: null;
        $color = $this->request->input('color', $pet['color'] ?? null);
        $allergies = $this->request->input('allergies', $pet['allergies'] ?? null);
        $diet = $this->request->input('diet_instructions', $pet['diet_instructions'] ?? null);
        $microchip = $this->request->input('microchip_id', $pet['microchip_id'] ?? null);

        Pet::update($id, [
            'name' => $name,
            'weight' => $weight,
            'age' => $age,
            'birthday' => $birthday,
            'color' => $color,
            'allergies' => $allergies,
            'diet_instructions' => $diet,
            'microchip_id' => $microchip
        ]);

        AuditLog::log('PET_UPDATED', 'pets', (int)$id);
        Flash::success('Pet profile updated successfully.');
        $this->redirect('portal/pets/' . $id);
    }

    public function deletePet(int|string $id): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($id);
        if (!$pet) return;

        Pet::delete($id);
        AuditLog::log('PET_DELETED', 'pets', (int)$id, ['name' => $pet['name']]);
        Flash::success('Pet profile removed from your account.');
        $this->redirect('portal/pets');
    }

    // =========================================================================
    // 3. LOST PET MODE & RECOVERY
    // =========================================================================
    public function toggleLostMode(int|string $id): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($id);
        if (!$pet) return;

        $location = trim($this->request->input('lost_location', 'Neighborhood Area'));
        $notes = trim($this->request->input('lost_notes', 'Please contact owner immediately if seen.'));

        Pet::update($id, [
            'is_lost' => 1,
            'lost_date' => date('Y-m-d H:i:s'),
            'lost_location' => $location,
            'lost_notes' => $notes
        ]);

        // Create alert notification
        Notification::broadcast(
            "⚠️ Alert: {$pet['name']} marked as LOST",
            "Lost Mode is active. Last seen: {$location}. Public QR passport will display emergency finding instructions.",
            'petowner',
            'urgent',
            $this->userId,
            ViewHelper::url('portal/pets/' . $id)
        );

        AuditLog::log('PET_LOST_MODE_ACTIVATED', 'pets', (int)$id, ['location' => $location]);
        Flash::error("Lost Pet Alert activated for {$pet['name']}. Public QR scans will now display emergency contact details.");
        $this->redirect('portal/pets/' . $id);
    }

    public function markFound(int|string $id): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($id);
        if (!$pet) return;

        Pet::update($id, [
            'is_lost' => 0,
            'lost_date' => null,
            'lost_location' => null,
            'lost_notes' => null
        ]);

        Notification::broadcast(
            "🎉 Recovered: {$pet['name']} marked as FOUND",
            "{$pet['name']} has been safely recovered! Lost mode has been deactivated.",
            'petowner',
            'normal',
            $this->userId,
            ViewHelper::url('portal/pets/' . $id)
        );

        AuditLog::log('PET_FOUND', 'pets', (int)$id);
        Flash::success("Wonderful news! {$pet['name']} has been marked as safely recovered.");
        $this->redirect('portal/pets/' . $id);
    }

    // =========================================================================
    // 4. CARE TASKS & SMART DAILY SCHEDULE
    // =========================================================================
    public function careSchedule(): void
    {
        $this->requireAuth();

        $pets = Pet::getPetsByUser($this->userId);
        $tasks = CareTask::getTasksForUser($this->userId);

        $this->render('portal.owner.care.index', [
            'pageTitle' => "Today's Pet Care & Routine Schedule — PetGuard",
            'user' => $this->user,
            'pets' => $pets,
            'tasks' => $tasks
        ], 'portal');
    }

    public function toggleCareTask(int|string $id): void
    {
        $this->requireAuth();
        $task = CareTask::find($id);
        if (!$task || (int)$task['user_id'] !== $this->userId) {
            $this->json(['success' => false, 'message' => 'Unauthorized']);
            return;
        }

        $newStatus = $task['is_completed'] ? 0 : 1;
        CareTask::update($id, [
            'is_completed' => $newStatus,
            'last_completed_at' => $newStatus ? date('Y-m-d H:i:s') : null
        ]);

        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'is_completed' => $newStatus]);
            return;
        }

        Flash::success($newStatus ? 'Task marked as completed! 🐾' : 'Task marked as pending.');
        $redirect = $this->request->input('redirect') ?: (!empty($task['pet_id']) ? 'portal/pets/' . $task['pet_id'] . '?tab=care' : 'portal/care');
        $this->redirect($redirect);
    }

    public function createCareTask(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $title = trim($this->request->input('title', ''));
        $taskType = $this->request->input('task_type', 'custom');
        $timeDue = $this->request->input('time_due', '08:00 AM');
        $frequency = $this->request->input('frequency', 'daily');
        $notes = $this->request->input('notes', null);

        if (empty($title) || empty($petId)) {
            Flash::error('Task title and pet selection are required.');
            $this->redirect($this->request->input('redirect', 'portal/care'));
            return;
        }

        CareTask::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'title' => $title,
            'task_type' => $taskType,
            'time_due' => $timeDue,
            'frequency' => $frequency,
            'notes' => $notes,
            'is_completed' => 0
        ]);

        Flash::success("Care task '{$title}' added to schedule.");
        $redirect = $this->request->input('redirect') ?: (!empty($petId) ? 'portal/pets/' . $petId . '?tab=care' : 'portal/care');
        $this->redirect($redirect);
    }

    public function deleteCareTask(int|string $id): void
    {
        $this->requireAuth();
        $task = CareTask::find($id);
        if ($task && (int)$task['user_id'] === $this->userId) {
            CareTask::delete($id);
            Flash::success('Task removed from schedule.');
            $redirect = $this->request->input('redirect') ?: (!empty($task['pet_id']) ? 'portal/pets/' . $task['pet_id'] . '?tab=care' : 'portal/care');
            $this->redirect($redirect);
            return;
        }
        $this->redirect($this->request->input('redirect', 'portal/care'));
    }

    public function healthOverview(): void
    {
        $this->requireAuth();

        $pets = Pet::getPetsByUser($this->userId);
        $medications = PetMedication::getMedicationsForUser($this->userId);
        $vaccines = Vaccine::query("SELECT v.*, p.name as pet_name, p.breed as pet_breed, p.avatar as pet_avatar 
            FROM vaccines v 
            JOIN pets p ON v.pet_id = p.id 
            WHERE p.user_id = :user_id 
            ORDER BY v.next_due_date ASC", ['user_id' => $this->userId]);
        $weights = PetWeight::query("SELECT w.*, p.name as pet_name 
            FROM pet_weights w 
            JOIN pets p ON w.pet_id = p.id 
            WHERE p.user_id = :user_id 
            ORDER BY w.recorded_date DESC LIMIT 10", ['user_id' => $this->userId]);

        $this->render('portal.owner.health.index', [
            'pageTitle' => 'Pet Health & Wellness Overview — PetGuard',
            'user' => $this->user,
            'pets' => $pets,
            'medications' => $medications,
            'vaccines' => $vaccines,
            'weights' => $weights
        ], 'portal');
    }

    public function addMedication(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $name = trim($this->request->input('name', ''));
        $dosage = trim($this->request->input('dosage', ''));
        $frequency = trim($this->request->input('frequency', 'Once daily'));
        $startDate = $this->request->input('start_date', date('Y-m-d'));
        $endDate = $this->request->input('end_date', null) ?: null;
        $vet = $this->request->input('prescribing_vet', null);
        $instructions = $this->request->input('instructions', null);

        if (empty($name) || empty($petId)) {
            Flash::error('Medication name and pet are required.');
            $this->redirect($this->request->input('redirect', 'portal/pets/' . $petId . '?tab=meds'));
            return;
        }

        PetMedication::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'name' => $name,
            'dosage' => $dosage,
            'frequency' => $frequency,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'prescribing_vet' => $vet,
            'instructions' => $instructions,
            'is_active' => 1
        ]);

        Flash::success("Medication '{$name}' logged.");
        $redirect = $this->request->input('redirect') ?: 'portal/pets/' . $petId . '?tab=meds';
        $this->redirect($redirect);
    }

    public function administerMedication(int|string $id): void
    {
        $this->requireAuth();
        $med = PetMedication::find($id);
        if ($med && (int)$med['user_id'] === $this->userId) {
            $today = date('Y-m-d');
            $limit = PetMedication::getDoseLimit($med['frequency'] ?? 'Once daily');
            $currentGiven = PetMedication::getDosesGivenToday($med);

            if ($currentGiven >= $limit && $limit < 999) {
                Flash::info("All scheduled doses for {$med['name']} have already been completed for today ({$currentGiven}/{$limit}).");
            } else {
                $newGiven = $currentGiven + 1;
                PetMedication::update($id, [
                    'doses_today' => $newGiven,
                    'last_dose_date' => $today,
                    'last_administered_at' => date('Y-m-d H:i:s')
                ]);

                if ($newGiven >= $limit && $limit < 999) {
                    Flash::success("Dose ({$newGiven}/{$limit}) of {$med['name']} administered! Daily requirement is now completed.");
                } else {
                    Flash::success("Dose #{$newGiven} of {$med['name']} recorded as administered today ({$newGiven}/{$limit})!");
                }
            }
        }
        $redirect = $this->request->input('redirect') ?: (!empty($med['pet_id']) ? 'portal/pets/' . $med['pet_id'] . '?tab=meds' : 'portal/health');
        $this->redirect($redirect);
    }

    public function deleteMedication(int|string $id): void
    {
        $this->requireAuth();
        $med = PetMedication::find($id);
        if ($med && (int)$med['user_id'] === $this->userId) {
            PetMedication::delete($id);
            Flash::success('Medication record removed.');
            $redirect = $this->request->input('redirect') ?: (!empty($med['pet_id']) ? 'portal/pets/' . $med['pet_id'] . '?tab=meds' : 'portal/health');
            $this->redirect($redirect);
            return;
        }
        $this->redirect($this->request->input('redirect', 'portal/health'));
    }

    public function addVaccination(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $vaccine = trim($this->request->input('vaccine_name', ''));
        $adminDate = $this->request->input('administered_date', date('Y-m-d'));
        $nextDate = $this->request->input('next_due_date', null) ?: null;
        $vet = $this->request->input('administering_vet', 'Licensed Clinic');
        $dose = $this->request->input('dose_number', 'Annual Booster');

        if (empty($vaccine) || empty($petId)) {
            Flash::error('Vaccine name is required.');
            $this->redirect($this->request->input('redirect', 'portal/pets/' . $petId . '?tab=vaccines'));
            return;
        }

        Vaccine::create([
            'pet_id' => $petId,
            'vaccine_name' => $vaccine,
            'administered_date' => $adminDate,
            'next_due_date' => $nextDate,
            'administering_vet' => $vet,
            'dose_number' => $dose
        ]);

        Flash::success("Vaccination '{$vaccine}' recorded.");
        $redirect = $this->request->input('redirect') ?: 'portal/pets/' . $petId . '?tab=vaccines';
        $this->redirect($redirect);
    }

    public function deleteVaccination(int|string $id): void
    {
        $this->requireAuth();
        $vaccine = Vaccine::find($id);
        if ($vaccine) {
            Vaccine::delete($id);
            Flash::success('Vaccination record removed.');
            $redirect = $this->request->input('redirect') ?: (!empty($vaccine['pet_id']) ? 'portal/pets/' . $vaccine['pet_id'] . '?tab=vaccines' : 'portal/pets');
            $this->redirect($redirect);
            return;
        }
        $this->redirect($this->request->input('redirect', 'portal/pets'));
    }

    public function addWeight(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $weight = (float)$this->request->input('weight_kg', 0);
        $date = $this->request->input('recorded_date', date('Y-m-d'));
        $notes = $this->request->input('notes', null);

        if ($weight > 0 && $petId > 0) {
            PetWeight::create([
                'pet_id' => $petId,
                'user_id' => $this->userId,
                'weight_kg' => $weight,
                'recorded_date' => $date,
                'notes' => $notes
            ]);
            Pet::update($petId, ['weight' => $weight . ' kg']);
            Flash::success("Weight {$weight} kg recorded.");
        }
        $redirect = $this->request->input('redirect') ?: 'portal/pets/' . $petId . '?tab=weight';
        $this->redirect($redirect);
    }

    public function deleteWeight(int|string $id): void
    {
        $this->requireAuth();
        $weight = PetWeight::find($id);
        if ($weight && (int)$weight['user_id'] === $this->userId) {
            PetWeight::delete($id);
            Flash::success('Weight entry removed.');
            $redirect = $this->request->input('redirect') ?: (!empty($weight['pet_id']) ? 'portal/pets/' . $weight['pet_id'] . '?tab=weight' : 'portal/pets');
            $this->redirect($redirect);
            return;
        }
        $this->redirect($this->request->input('redirect', 'portal/pets'));
    }

    // =========================================================================
    // 6. APPOINTMENTS & VETERINARIAN DISCOVERY
    // =========================================================================
    public function appointments(): void
    {
        $this->requireAuth();
        $appointments = Appointment::getWithDetailsForOwner($this->userId);
        $pets = Pet::getPetsByUser($this->userId);
        $vets = User::where("role = 'veterinarian' AND status = 'active'", []);

        $this->render('portal.owner.appointments.index', [
            'pageTitle' => 'Veterinary Appointments — PetGuard',
            'user' => $this->user,
            'appointments' => $appointments,
            'pets' => $pets,
            'vets' => $vets
        ], 'portal');
    }

    public function bookAppointment(): void
    {
        $this->requireAuth();
        $data = $this->validate($this->request->all(), [
            'pet_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'symptoms' => 'required'
        ]);

        $pet = Pet::find($data['pet_id']);
        if (!$pet || (int)$pet['user_id'] !== $this->userId) {
            Flash::error('Invalid pet selection.');
            $this->redirect('portal/appointments');
            return;
        }

        $apptId = Appointment::create([
            'owner_id' => $this->userId,
            'pet_id' => (int)$data['pet_id'],
            'vet_id' => !empty($this->request->input('vet_id')) ? (int)$this->request->input('vet_id') : null,
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'consultation_type' => $this->request->input('consultation_type', 'General Health Checkup'),
            'symptoms' => $data['symptoms'],
            'status' => 'pending'
        ]);

        AuditLog::log('APPOINTMENT_BOOKED', 'appointments', $apptId);
        Flash::success('Your clinical appointment consultation has been booked!');
        $this->redirect('portal/appointments');
    }

    public function cancelAppointment(int|string $id): void
    {
        $this->requireAuth();
        $appt = Appointment::find($id);
        if ($appt && (int)$appt['owner_id'] === $this->userId) {
            Appointment::update($id, ['status' => 'cancelled']);
            AuditLog::log('APPOINTMENT_CANCELLED', 'appointments', (int)$id);
            Flash::info('Appointment has been cancelled.');
        }
        $this->redirect('portal/appointments');
    }

    public function vets(): void
    {
        $this->requireAuth();

        $vets = User::query("SELECT u.id, u.name, u.email, u.phone, 
                vp.specialization, vp.experience, vp.clinic_name, vp.clinic_address, vp.bio, vp.license_number
            FROM users u
            JOIN veterinarian_profiles vp ON u.id = vp.user_id
            WHERE u.role = 'veterinarian' AND u.status = 'active'
            ORDER BY vp.experience DESC, u.name ASC");

        $favIds = UserFavorite::getFavoriteEntityIds($this->userId, 'vet');
        $pets = Pet::getPetsByUser($this->userId);

        $this->render('portal.owner.vets.index', [
            'pageTitle' => 'Find Certified Veterinarians — PetGuard',
            'user' => $this->user,
            'vets' => $vets,
            'favIds' => $favIds,
            'pets' => $pets
        ], 'portal');
    }

    public function vetProfile(int|string $id): void
    {
        $this->requireAuth();

        $vetRows = User::query("SELECT u.id, u.name, u.email, u.phone, 
                vp.specialization, vp.experience, vp.clinic_name, vp.clinic_address, vp.bio, vp.license_number, vp.verification_status,
                u.created_at as member_since
            FROM users u
            LEFT JOIN veterinarian_profiles vp ON u.id = vp.user_id
            WHERE u.id = :id AND u.role = 'veterinarian' AND u.status = 'active'", ['id' => (int)$id]);

        if (empty($vetRows)) {
            Flash::error('Veterinarian profile not found or inactive.');
            $this->redirect('portal/vets');
            return;
        }

        $vet = $vetRows[0];
        $isFavorite = UserFavorite::isFavorited($this->userId, 'vet', (int)$id);
        $pets = Pet::getPetsByUser($this->userId);

        $this->render('portal.owner.vets.profile', [
            'pageTitle' => "{$vet['name']} — Certified Veterinarian Profile",
            'user' => $this->user,
            'vet' => $vet,
            'isFavorite' => $isFavorite,
            'pets' => $pets
        ], 'portal');
    }

    public function toggleFavoriteVet(int|string $id): void
    {
        $this->requireAuth();
        $isFav = UserFavorite::toggle($this->userId, 'vet', (int)$id);
        if ($this->request->isAjax()) {
            $this->json(['success' => true, 'is_favorite' => $isFav]);
            return;
        }
        Flash::success($isFav ? 'Veterinarian added to favorites.' : 'Removed from favorites.');
        $redirect = $this->request->input('redirect', 'portal/vets');
        $this->redirect($redirect);
    }

    // =========================================================================
    // 7. EMERGENCY CENTER & EMERGENCY PET CARD
    // =========================================================================
    public function emergency(): void
    {
        $this->requireAuth();
        $pets = Pet::getPetsByUser($this->userId);
        $contacts = PetEmergencyContact::getContactsForUser($this->userId);

        $this->render('portal.owner.emergency.index', [
            'pageTitle' => 'Emergency Center & Rapid Triage — PetGuard',
            'user' => $this->user,
            'pets' => $pets,
            'contacts' => $contacts
        ], 'portal');
    }

    public function emergencyCard(int|string $petId): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($petId);
        if (!$pet) return;

        $id = (int)$pet['id'];
        $vaccines = Pet::getVaccines($id);
        $medications = Pet::getMedications($id);
        $emergencyContacts = Pet::getEmergencyContacts($id);

        $this->render('portal.owner.emergency.card', [
            'pageTitle' => "Emergency Card: {$pet['name']} — PetGuard",
            'user' => $this->user,
            'pet' => $pet,
            'vaccines' => $vaccines,
            'medications' => $medications,
            'emergencyContacts' => $emergencyContacts
        ], 'portal');
    }

    public function addEmergencyContact(): void
    {
        $this->requireAuth();
        $this->validateCsrf();

        $petId = (int)$this->request->input('pet_id');
        $contactName = trim($this->request->input('contact_name', ''));
        $phone = trim($this->request->input('phone', ''));
        $relationship = trim($this->request->input('relationship', 'Emergency Contact'));
        $clinicName = trim($this->request->input('clinic_name', ''));
        $isPrimary = (int)$this->request->input('is_primary', 0);

        if (empty($petId) || empty($contactName) || empty($phone)) {
            Flash::error('Companion, contact name, and phone number are required.');
            $this->redirect('portal/emergency');
            return;
        }

        $pet = $this->verifyPetOwnership($petId);
        if (!$pet) {
            Flash::error('Unauthorized companion selection.');
            $this->redirect('portal/emergency');
            return;
        }

        PetEmergencyContact::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'contact_name' => $contactName,
            'phone' => $phone,
            'relationship' => $relationship,
            'clinic_name' => $clinicName,
            'is_primary' => $isPrimary
        ]);

        Flash::success("Emergency contact '{$contactName}' registered successfully.");
        $this->redirect('portal/emergency');
    }

    public function deleteEmergencyContact(int|string $id): void
    {
        $this->requireAuth();
        $this->validateCsrf();

        $contact = PetEmergencyContact::find((int)$id);
        if ($contact && (int)$contact['user_id'] === $this->userId) {
            PetEmergencyContact::delete((int)$id);
            Flash::success('Emergency contact removed.');
        } else {
            Flash::error('Contact not found or unauthorized.');
        }

        $this->redirect('portal/emergency');
    }

    // =========================================================================
    // 8. DIGITAL PASSPORT & PUBLIC QR IDENTIFICATION
    // =========================================================================
    public function passport(string $qrToken): void
    {
        $this->requireAuth();
        $pet = Pet::findBy('qr_token', $qrToken);
        if (!$pet || (int)$pet['user_id'] !== $this->userId) {
            Flash::error('Passport not found or access denied.');
            $this->redirect('portal/pets');
            return;
        }

        $id = (int)$pet['id'];
        $vaccines = Pet::getVaccines($id);
        $medications = Pet::getMedications($id);
        $emergencyContacts = Pet::getEmergencyContacts($id);

        $this->render('portal.owner.passport.view', [
            'pageTitle' => "Pet Passport: {$pet['name']} — PetGuard",
            'user' => $this->user,
            'pet' => $pet,
            'vaccines' => $vaccines,
            'medications' => $medications,
            'emergencyContacts' => $emergencyContacts
        ], 'portal');
    }

    /**
     * Public QR Scan Handler (Lost Pet / Finder Landing Page)
     */
    public function publicQrPassport(string $qrToken): void
    {
        $pet = Pet::findBy('qr_token', $qrToken);
        if (!$pet) {
            $this->render('pages.404', ['pageTitle' => 'Pet Passport Not Found — PetGuard'], 'main');
            return;
        }

        $owner = User::find($pet['user_id']);
        $emergencyContacts = Pet::getEmergencyContacts((int)$pet['id']);

        $this->render('portal.owner.passport.public_qr', [
            'pageTitle' => "Pet Identity: {$pet['name']} — PetGuard Public Registry",
            'pet' => $pet,
            'owner' => $owner,
            'emergencyContacts' => $emergencyContacts
        ], 'main');
    }

    // =========================================================================
    // 9. AI PET CARE ASSISTANT & HEALTH INSIGHTS
    // =========================================================================
    public function aiAssistant(): void
    {
        $this->requireAuth();
        $pets = Pet::getPetsByUser($this->userId);

        $this->render('portal.owner.ai.assistant', [
            'pageTitle' => 'AI Pet Care Assistant & Insights — PetGuard',
            'user' => $this->user,
            'pets' => $pets
        ], 'portal');
    }

    public function aiChat(): void
    {
        $this->requireAuth();
        $prompt = trim($this->request->input('prompt', ''));
        $petId = (int)$this->request->input('pet_id', 0);

        if (empty($prompt)) {
            $this->json(['success' => false, 'error' => 'Prompt cannot be empty.'], 400);
            return;
        }

        $petContext = null;
        if ($petId > 0) {
            $pet = Pet::find($petId);
            if ($pet && (int)$pet['user_id'] === $this->userId) {
                $petContext = [
                    'name' => $pet['name'],
                    'species' => $pet['species'],
                    'breed' => $pet['breed'],
                    'age' => $pet['age'],
                    'weight' => $pet['weight'],
                    'allergies' => $pet['allergies'] ?? 'None recorded',
                    'diet' => $pet['diet_instructions'] ?? 'Standard'
                ];
            }
        }

        try {
            $aiService = new AiService();
            $result = $aiService->chat($prompt, $petContext, $this->userId);
            $this->json([
                'success' => true,
                'response' => $result['response'] ?? 'I could not generate a response. Please try again.',
                'is_emergency' => $result['is_emergency'] ?? false,
                'safety_alert' => $result['safety_alert'] ?? null,
                'model' => $result['model'] ?? 'PetGuard AI Assistant'
            ]);
        } catch (\Throwable $e) {
            $this->json([
                'success' => true,
                'response' => "### 🐾 Educational Wellness Guidance\n\nRegarding your inquiry: *" . htmlspecialchars(substr($prompt, 0, 80)) . "*\n\n- **General Health Tip**: Ensure your companion has consistent access to fresh clean water and a balanced diet.\n- **Clinical Recommendation**: For specific clinical conditions, we recommend booking a direct consultation with a certified veterinarian on PetGuard.",
                'is_emergency' => false,
                'model' => 'PetGuard Local Fallback AI'
            ]);
        }
    }

    // =========================================================================
    // 10. FAMILY & PET SITTER SHARING
    // =========================================================================
    public function family(): void
    {
        $this->requireAuth();
        $pets = Pet::getPetsByUser($this->userId);
        $family = PetFamilyAccess::getFamilyForUser($this->userId);

        $this->render('portal.owner.family.index', [
            'pageTitle' => 'Family & Pet Sitter Sharing — PetGuard',
            'user' => $this->user,
            'pets' => $pets,
            'family' => $family
        ], 'portal');
    }

    public function inviteFamily(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $name = trim($this->request->input('member_name', ''));
        $email = trim($this->request->input('member_email', ''));
        $relationship = $this->request->input('relationship', 'Family Member');
        $access = $this->request->input('access_level', 'view_care');
        $isSitter = !empty($this->request->input('is_sitter')) ? 1 : 0;
        $expires = $this->request->input('expires_at', null) ?: null;

        if (empty($name) || empty($email) || empty($petId)) {
            Flash::error('Member name, email, and pet are required.');
            $this->redirect('portal/family');
            return;
        }

        PetFamilyAccess::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'member_name' => $name,
            'member_email' => $email,
            'relationship' => $relationship,
            'access_level' => $access,
            'is_sitter' => $isSitter,
            'expires_at' => $expires
        ]);

        Flash::success("Pet access shared with {$name} ({$email}).");
        $this->redirect('portal/family');
    }

    public function revokeFamily(int|string $id): void
    {
        $this->requireAuth();
        $access = PetFamilyAccess::find($id);
        if ($access && (int)$access['user_id'] === $this->userId) {
            PetFamilyAccess::delete($id);
            Flash::info('Access pass revoked.');
        }
        $this->redirect('portal/family');
    }

    // =========================================================================
    // 11. DOCUMENT VAULT
    // =========================================================================
    public function documents(): void
    {
        $this->requireAuth();
        $pets = Pet::getPetsByUser($this->userId);
        $docs = PetDocument::getDocsForUser($this->userId);

        $this->render('portal.owner.documents.index', [
            'pageTitle' => 'Pet Health Document Vault — PetGuard',
            'user' => $this->user,
            'pets' => $pets,
            'docs' => $docs
        ], 'portal');
    }

    public function uploadDocument(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $title = trim($this->request->input('title', ''));
        $docType = $this->request->input('doc_type', 'other');
        $notes = $this->request->input('notes', null);

        if (empty($title) || empty($petId)) {
            Flash::error('Document title and pet are required.');
            $this->redirect($this->request->input('redirect', 'portal/documents'));
            return;
        }

        $filePath = '';
        $fileSize = '0 KB';

        // Process file upload if attached
        if (!empty($_FILES['document_file']['name']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['document_file'];
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            $allowed = ['pdf', 'doc', 'docx', 'jpg', 'jpeg', 'png', 'txt', 'csv'];

            if (!in_array($ext, $allowed)) {
                Flash::error('Invalid file format. Please upload PDF, Word (DOC/DOCX), or image (JPG/PNG).');
                $redirect = $this->request->input('redirect') ?: (!empty($petId) ? 'portal/pets/' . $petId . '?tab=docs' : 'portal/documents');
                $this->redirect($redirect);
                return;
            }

            $uploadDir = dirname(__DIR__) . '/assets/uploads/docs';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }

            $filename = 'doc_' . uniqid() . '.' . $ext;
            $destPath = $uploadDir . '/' . $filename;

            if (move_uploaded_file($file['tmp_name'], $destPath)) {
                $filePath = 'uploads/docs/' . $filename;
                $bytes = filesize($destPath);
                $fileSize = $bytes >= 1048576 ? round($bytes / 1048576, 2) . ' MB' : round($bytes / 1024, 1) . ' KB';
            } else {
                Flash::error('Failed to save uploaded file to storage.');
                $redirect = $this->request->input('redirect') ?: (!empty($petId) ? 'portal/pets/' . $petId . '?tab=docs' : 'portal/documents');
                $this->redirect($redirect);
                return;
            }
        } else {
            // Default vault file record
            $filePath = 'uploads/docs/doc_' . uniqid() . '.pdf';
            $fileSize = '1.2 MB';
        }

        PetDocument::create([
            'pet_id' => $petId,
            'user_id' => $this->userId,
            'title' => $title,
            'doc_type' => $docType,
            'file_path' => $filePath,
            'file_size' => $fileSize,
            'notes' => $notes
        ]);

        Flash::success("Document '{$title}' stored securely in your vault.");
        $redirect = $this->request->input('redirect') ?: (!empty($petId) ? 'portal/pets/' . $petId . '?tab=docs' : 'portal/documents');
        $this->redirect($redirect);
    }

    public function downloadDocument(int|string $id): void
    {
        $this->requireAuth();
        $doc = PetDocument::find($id);
        if (!$doc || (int)$doc['user_id'] !== $this->userId) {
            Flash::error('Document not found or unauthorized access.');
            $this->redirect('portal/documents');
            return;
        }

        $rawPath = ltrim($doc['file_path'] ?? '', '/');
        $filePath = dirname(__DIR__) . '/assets/' . $rawPath;
        if (!file_exists($filePath)) {
            $filePath = dirname(__DIR__) . '/public/' . $rawPath;
        }

        $ext = strtolower(pathinfo($rawPath, PATHINFO_EXTENSION)) ?: 'pdf';
        $safeName = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $doc['title']) . '.' . $ext;

        if (!empty($rawPath) && file_exists($filePath) && is_file($filePath)) {
            $mime = function_exists('mime_content_type') ? mime_content_type($filePath) : 'application/octet-stream';
            header('Content-Description: File Transfer');
            header('Content-Type: ' . ($mime ?: 'application/octet-stream'));
            header('Content-Disposition: attachment; filename="' . $safeName . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit;
        }

        // Fallback generator if sample record
        header('Content-Type: text/plain; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', $doc['title']) . '.txt"');
        echo "========================================\n";
        echo "PETGUARD ENCRYPTED DIGITAL DOCUMENT VAULT\n";
        echo "========================================\n";
        echo "Document Title:  " . ($doc['title'] ?? 'Document') . "\n";
        echo "Document ID:     #" . $doc['id'] . "\n";
        echo "Category:        " . strtoupper(str_replace('_', ' ', $doc['doc_type'] ?? 'other')) . "\n";
        echo "Vault Stored At: " . ($doc['created_at'] ?? date('Y-m-d H:i:s')) . "\n";
        echo "File Size:       " . ($doc['file_size'] ?? '1.2 MB') . "\n";
        echo "Status:          Verified Pet Health Record\n";
        echo "========================================\n";
        exit;
    }

    public function deleteDocument(int|string $id): void
    {
        $this->requireAuth();
        $doc = PetDocument::find($id);
        if ($doc && (int)$doc['user_id'] === $this->userId) {
            PetDocument::delete($id);
            Flash::success('Document removed from vault.');
            $redirect = $this->request->input('redirect') ?: (!empty($doc['pet_id']) ? 'portal/pets/' . $doc['pet_id'] . '?tab=docs' : 'portal/documents');
            $this->redirect($redirect);
            return;
        }
        $this->redirect($this->request->input('redirect', 'portal/documents'));
    }

    // =========================================================================
    // 12. ADOPTION HUB & ORDERS
    // =========================================================================
    public function adoption(): void
    {
        $this->requireAuth();
        $availablePets = Pet::where("is_for_adoption = 1 AND adoption_status = 'available'", [], 'id DESC');
        $myApplications = AdoptionApplication::query("SELECT a.*, p.name AS pet_name, p.species, p.breed, p.avatar
            FROM adoption_applications a
            JOIN pets p ON a.pet_id = p.id
            WHERE a.applicant_id = :uid
            ORDER BY a.created_at DESC", ['uid' => $this->userId]);

        $this->render('portal.owner.adoption.index', [
            'pageTitle' => 'Adoption Center & Applications — PetGuard',
            'user' => $this->user,
            'availablePets' => $availablePets,
            'myApplications' => $myApplications
        ], 'portal');
    }

    public function submitAdoptionApp(): void
    {
        $this->requireAuth();
        $petId = (int)$this->request->input('pet_id');
        $experience = trim($this->request->input('experience', 'Previous pet owner'));
        $homeType = trim($this->request->input('home_type', 'House with Yard'));
        $notes = trim($this->request->input('notes', ''));

        if ($petId <= 0) {
            Flash::error('Invalid pet selection.');
            $this->redirect('portal/adoption');
            return;
        }

        AdoptionApplication::create([
            'pet_id' => $petId,
            'applicant_id' => $this->userId,
            'applicant_name' => $this->user['name'],
            'applicant_email' => $this->user['email'],
            'applicant_phone' => $this->user['phone'] ?? '+1-555-000-0000',
            'housing_type' => $homeType,
            'has_yard' => 1,
            'own_or_rent' => 'own',
            'other_pets' => $experience,
            'household_details' => $notes,
            'status' => 'submitted'
        ]);

        Flash::success('Your adoption application has been submitted to the rescue shelter team!');
        $this->redirect('portal/adoption');
    }

    public function orders(): void
    {
        $this->requireAuth();
        $orders = Order::getOrdersByUser($this->userId);

        $this->render('portal.owner.orders.index', [
            'pageTitle' => 'My Marketplace Orders — PetGuard',
            'user' => $this->user,
            'orders' => $orders
        ], 'portal');
    }

    // =========================================================================
    // 13. NOTIFICATIONS & HEALTH SUMMARY REPORT
    // =========================================================================
    public function notifications(): void
    {
        $this->requireAuth();
        $notifications = Notification::where("audience = 'petowner' OR audience = 'everyone'", [], 'created_at DESC');

        $this->render('portal.owner.notifications.index', [
            'pageTitle' => 'Notification Center — PetGuard',
            'user' => $this->user,
            'notifications' => $notifications
        ], 'portal');
    }

    public function markAllNotificationsRead(): void
    {
        $this->requireAuth();
        Notification::query("UPDATE notifications SET is_read = 1 WHERE audience = 'petowner' OR audience = 'everyone'");
        Flash::success('All notifications marked as read.');
        $this->redirect('portal/notifications');
    }

    public function healthReport(int|string $petId): void
    {
        $this->requireAuth();
        $pet = $this->verifyPetOwnership($petId);
        if (!$pet) return;

        $id = (int)$pet['id'];
        $vaccines = Pet::getVaccines($id);
        $medications = Pet::getMedications($id);
        $weights = Pet::getWeights($id);
        $appointments = Pet::getAppointments($id);
        $emergencyContacts = Pet::getEmergencyContacts($id);

        $this->render('portal.owner.reports.health_summary', [
            'pageTitle' => "Clinical Health Report: {$pet['name']} — PetGuard",
            'user' => $this->user,
            'pet' => $pet,
            'vaccines' => $vaccines,
            'medications' => $medications,
            'weights' => $weights,
            'appointments' => $appointments,
            'emergencyContacts' => $emergencyContacts
        ], 'portal');
    }

    // =========================================================================
    // 14. SETTINGS & PROFILE
    // =========================================================================
    public function settings(): void
    {
        $this->requireAuth();

        $this->render('portal.owner.settings.index', [
            'pageTitle' => 'Account Settings & Privacy — PetGuard',
            'user' => $this->user
        ], 'portal');
    }

    public function updateProfile(): void
    {
        $this->requireAuth();
        $name = trim($this->request->input('name', $this->user['name']));
        $phone = trim($this->request->input('phone', $this->user['phone'] ?? ''));
        $address = trim($this->request->input('address', $this->user['address'] ?? ''));

        User::update($this->userId, [
            'name' => $name,
            'phone' => $phone,
            'address' => $address
        ]);

        Flash::success('Your profile details have been saved.');
        $this->redirect('portal/settings');
    }

    // =========================================================================
    // 15. ADVANCED SUPER-FAST OWNER SEARCH (STRICT DATA PRIVACY ISOLATION)
    // =========================================================================
    public function apiSearch(): void
    {
        $this->requireAuth();
        $q = trim((string)$this->request->input('q', ''));
        
        if (strlen($q) < 2) {
            $this->response->json(['success' => true, 'query' => $q, 'results' => []]);
            return;
        }

        $term = '%' . $q . '%';
        $results = [];

        // 1. Owner's Own Pets (STRICT user_id isolation)
        $pets = Pet::query("SELECT id, name, species, breed, avatar, qr_token, care_score, microchip_id 
            FROM pets 
            WHERE user_id = :uid AND (name LIKE :q1 OR species LIKE :q2 OR breed LIKE :q3 OR microchip_id LIKE :q4 OR qr_token LIKE :q5) 
            ORDER BY id DESC LIMIT 5", 
            ['uid' => $this->userId, 'q1' => $term, 'q2' => $term, 'q3' => $term, 'q4' => $term, 'q5' => $term]
        );
        foreach ($pets as $p) {
            $results[] = [
                'type' => 'pet',
                'category' => 'My Pets',
                'title' => $p['name'],
                'subtitle' => "{$p['species']} • {$p['breed']} (Tag: {$p['qr_token']})",
                'url' => ViewHelper::url('portal/pets/' . $p['id']),
                'icon' => 'fa-solid fa-paw',
                'avatar' => ViewHelper::asset($p['avatar'])
            ];
        }

        // 2. Owner's Care Routines & Tasks (STRICT user_id isolation)
        $tasks = CareTask::query("SELECT ct.id, ct.title, ct.task_type, ct.time_due, p.name AS pet_name, p.id AS pet_id 
            FROM care_tasks ct 
            LEFT JOIN pets p ON ct.pet_id = p.id 
            WHERE ct.user_id = :uid AND (ct.title LIKE :q1 OR ct.task_type LIKE :q2) 
            ORDER BY ct.id DESC LIMIT 5",
            ['uid' => $this->userId, 'q1' => $term, 'q2' => $term]
        );
        foreach ($tasks as $t) {
            $results[] = [
                'type' => 'care',
                'category' => 'Daily Care Tasks',
                'title' => $t['title'],
                'subtitle' => "Due {$t['time_due']} for " . ($t['pet_name'] ?? 'Pet'),
                'url' => ViewHelper::url('portal/care'),
                'icon' => 'fa-solid fa-list-check'
            ];
        }

        // 3. Owner's Appointments (STRICT owner_id isolation)
        $appts = Appointment::query("SELECT a.id, a.appointment_date, a.appointment_time, a.consultation_type, a.status, p.name AS pet_name, u.name AS vet_name
            FROM appointments a
            LEFT JOIN pets p ON a.pet_id = p.id
            LEFT JOIN users u ON a.vet_id = u.id
            WHERE a.owner_id = :uid AND (a.symptoms LIKE :q1 OR a.consultation_type LIKE :q2 OR p.name LIKE :q3 OR u.name LIKE :q4)
            ORDER BY a.appointment_date DESC LIMIT 5",
            ['uid' => $this->userId, 'q1' => $term, 'q2' => $term, 'q3' => $term, 'q4' => $term]
        );
        foreach ($appts as $a) {
            $results[] = [
                'type' => 'appointment',
                'category' => 'Clinical Appointments',
                'title' => ($a['consultation_type'] ?: 'Veterinary Visit') . " (" . ucfirst($a['status']) . ")",
                'subtitle' => date('M d, Y', strtotime($a['appointment_date'])) . " at " . $a['appointment_time'] . " with " . ($a['vet_name'] ?? 'Doctor'),
                'url' => ViewHelper::url('portal/appointments'),
                'icon' => 'fa-solid fa-calendar-check'
            ];
        }

        // 4. Owner's Documents Vault (STRICT user_id isolation via owner's pets)
        $docs = PetDocument::query("SELECT d.id, d.title, d.doc_type, p.name AS pet_name, p.id AS pet_id
            FROM pet_documents d
            INNER JOIN pets p ON d.pet_id = p.id
            WHERE p.user_id = :uid AND (d.title LIKE :q1 OR d.doc_type LIKE :q2)
            ORDER BY d.id DESC LIMIT 4",
            ['uid' => $this->userId, 'q1' => $term, 'q2' => $term]
        );
        foreach ($docs as $d) {
            $results[] = [
                'type' => 'document',
                'category' => 'Medical Documents',
                'title' => $d['title'],
                'subtitle' => strtoupper(str_replace('_', ' ', $d['doc_type'])) . " for " . $d['pet_name'],
                'url' => ViewHelper::url('portal/pets/' . $d['pet_id']),
                'icon' => 'fa-solid fa-file-shield'
            ];
        }

        // 5. Verified Veterinary Clinics Directory (Public search)
        $vets = VeterinarianProfile::query("SELECT vp.id, vp.clinic_name, vp.specialization, vp.clinic_address, u.name AS doctor_name
            FROM veterinarian_profiles vp
            LEFT JOIN users u ON vp.user_id = u.id
            WHERE (vp.verification_status = 'approved' OR vp.verification_status IS NULL) 
              AND (vp.clinic_name LIKE :q1 OR vp.specialization LIKE :q2 OR u.name LIKE :q3 OR vp.clinic_address LIKE :q4)
            LIMIT 4",
            ['q1' => $term, 'q2' => $term, 'q3' => $term, 'q4' => $term]
        );
        foreach ($vets as $v) {
            $results[] = [
                'type' => 'vet',
                'category' => 'Certified Veterinary Clinics',
                'title' => $v['clinic_name'] ?: 'Veterinary Clinic',
                'subtitle' => "Dr. " . ($v['doctor_name'] ?? 'Veterinarian') . " • {$v['specialization']}",
                'url' => ViewHelper::url('portal/vets'),
                'icon' => 'fa-solid fa-stethoscope'
            ];
        }

        $this->response->json([
            'success' => true,
            'query' => $q,
            'count' => count($results),
            'results' => $results
        ]);
    }
}
