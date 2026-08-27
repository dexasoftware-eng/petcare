<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\User;
use Models\VeterinarianProfile;
use Models\Appointment;
use Models\Pet;
use Models\Vaccine;
use Models\PetMedication;
use Models\VetService;
use Models\VetAvailability;
use Models\ConsultationRecord;
use Models\EmergencyEvent;
use Models\AuditLog;

class VetPortalController extends Controller
{
    private function getVetUserId(): int
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
        }
        return (int)$userId;
    }

    /**
     * Practice Dashboard
     */
    public function dashboard(): void
    {
        $vetId = $this->getVetUserId();
        $user = Auth::user();
        $profile = VeterinarianProfile::findBy('user_id', $vetId);

        $kpi = [
            'totalPatients' => Appointment::query("SELECT COUNT(DISTINCT pet_id) as count FROM appointments WHERE vet_id = {$vetId} OR vet_id IS NULL")[0]['count'] ?? 0,
            'todayAppointments' => Appointment::count("(vet_id = {$vetId} OR vet_id IS NULL) AND appointment_date = CURRENT_DATE() AND status != 'cancelled'"),
            'pendingRequests' => Appointment::count("(vet_id = {$vetId} OR vet_id IS NULL) AND status = 'pending'"),
            'completedConsultations' => ConsultationRecord::count("vet_id = {$vetId}"),
            'activeEmergencies' => EmergencyEvent::count("status = 'active' OR status = 'in_triage'")
        ];

        $appointments = Appointment::getWithDetailsForVet($vetId);
        $recentConsultations = ConsultationRecord::getForVet($vetId, 5);
        $services = VetService::getForVet($vetId, true);
        $patients = Pet::query("SELECT p.*, u.name as owner_name, u.email as owner_email, u.phone as owner_phone 
                                FROM `pets` p 
                                JOIN `users` u ON p.user_id = u.id 
                                ORDER BY p.id DESC 
                                LIMIT 4");

        $this->render('portal.vet.dashboard', [
            'pageTitle' => 'Veterinary Practice Dashboard — Pet Guard',
            'user' => $user,
            'profile' => $profile,
            'kpi' => $kpi,
            'appointments' => $appointments,
            'recentConsultations' => $recentConsultations,
            'services' => $services,
            'patients' => $patients
        ], 'portal');
    }

    /**
     * Profile & Clinic Information
     */
    public function profile(): void
    {
        $vetId = $this->getVetUserId();
        $user = Auth::user();
        $profile = VeterinarianProfile::findBy('user_id', $vetId);

        $this->render('portal.vet.profile', [
            'pageTitle' => 'Clinical Profile & Licensing — Pet Guard',
            'user' => $user,
            'profile' => $profile
        ], 'portal');
    }

    public function updateProfile(): void
    {
        $vetId = $this->getVetUserId();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'phone' => 'required|min:6',
            'specialization' => 'required|min:3',
            'experience' => 'required|numeric',
            'clinic_name' => 'required|min:3',
            'clinic_address' => 'required|min:4'
        ]);

        User::update($vetId, [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['clinic_address']
        ]);

        $profile = VeterinarianProfile::findBy('user_id', $vetId);
        $profileData = [
            'specialization' => $data['specialization'],
            'experience' => (int)$data['experience'],
            'clinic_name' => $data['clinic_name'],
            'clinic_address' => $data['clinic_address'],
            'bio' => $this->request->input('bio', ''),
            'license_number' => $this->request->input('license_number', 'VET-DVM-98421')
        ];

        if ($profile) {
            VeterinarianProfile::update($profile['id'], $profileData);
        } else {
            $profileData['user_id'] = $vetId;
            VeterinarianProfile::create($profileData);
        }

        AuditLog::log('VET_PROFILE_UPDATED', 'veterinarian_profiles', $vetId);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Clinical profile updated successfully.');
        } else {
            Flash::success('Clinical profile updated successfully.');
            $this->redirect('vet/profile');
        }
    }

    /**
     * Clinical Services CRUD
     */
    public function services(): void
    {
        $vetId = $this->getVetUserId();
        $services = VetService::getForVet($vetId);

        $this->render('portal.vet.services', [
            'pageTitle' => 'Clinical Services & Pricing — Pet Guard',
            'services' => $services
        ], 'portal');
    }

    public function saveService(): void
    {
        $vetId = $this->getVetUserId();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:150',
            'category' => 'required',
            'price' => 'required|numeric',
            'duration_minutes' => 'required|numeric'
        ]);

        $serviceId = (int)$this->request->input('service_id', 0);
        $payload = [
            'vet_id' => $vetId,
            'name' => $data['name'],
            'category' => $data['category'],
            'price' => (float)$data['price'],
            'duration_minutes' => (int)$data['duration_minutes'],
            'description' => $this->request->input('description', ''),
            'is_active' => (int)$this->request->input('is_active', 1)
        ];

        if ($serviceId > 0) {
            VetService::update($serviceId, $payload);
            $msg = 'Clinical service updated.';
        } else {
            VetService::create($payload);
            $msg = 'New clinical service added.';
        }

        if ($this->request->isAjax()) {
            $this->jsonSuccess($msg);
        } else {
            Flash::success($msg);
            $this->redirect('vet/services');
        }
    }

    public function deleteService(int|string $id): void
    {
        $vetId = $this->getVetUserId();
        $service = VetService::find($id);

        if ($service && (int)$service['vet_id'] === $vetId) {
            VetService::delete((int)$id);
            $this->jsonSuccess('Service deleted.');
        } else {
            $this->jsonError('Service not found or access denied.');
        }
    }

    /**
     * Weekly Availability Schedule
     */
    public function availability(): void
    {
        $vetId = $this->getVetUserId();
        $schedule = VetAvailability::getScheduleForVet($vetId);

        $this->render('portal.vet.availability', [
            'pageTitle' => 'Availability & Slot Management — Pet Guard',
            'schedule' => $schedule
        ], 'portal');
    }

    public function updateAvailability(): void
    {
        $vetId = $this->getVetUserId();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

        foreach ($days as $day) {
            $isAvailable = $this->request->input("avail_{$day}") ? 1 : 0;
            $start = $this->request->input("start_{$day}", '09:00');
            $end = $this->request->input("end_{$day}", '17:00');
            $duration = (int)$this->request->input("duration_{$day}", 30);

            $existing = VetAvailability::firstWhere('vet_id = :vid AND day_of_week = :day', [
                'vid' => $vetId,
                'day' => $day
            ]);

            if ($existing) {
                VetAvailability::update($existing['id'], [
                    'start_time' => $start . ':00',
                    'end_time' => $end . ':00',
                    'slot_duration_minutes' => $duration,
                    'is_available' => $isAvailable
                ]);
            } else {
                VetAvailability::create([
                    'vet_id' => $vetId,
                    'day_of_week' => $day,
                    'start_time' => $start . ':00',
                    'end_time' => $end . ':00',
                    'slot_duration_minutes' => $duration,
                    'is_available' => $isAvailable
                ]);
            }
        }

        AuditLog::log('VET_AVAILABILITY_UPDATED', 'vet_availabilities', $vetId);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Weekly clinical availability saved.');
        } else {
            Flash::success('Weekly clinical availability saved.');
            $this->redirect('vet/availability');
        }
    }

    /**
     * Appointments Queue Management
     */
    public function appointments(): void
    {
        $vetId = $this->getVetUserId();
        $appointments = Appointment::getWithDetailsForVet($vetId);

        $this->render('portal.vet.appointments.index', [
            'pageTitle' => 'Consultations Queue — Pet Guard',
            'appointments' => $appointments
        ], 'portal');
    }

    public function appointmentDetails(int|string $id): void
    {
        $vetId = $this->getVetUserId();
        $appointment = Appointment::find($id);

        if (!$appointment) {
            Flash::error('Appointment not found.');
            $this->redirect('vet/appointments');
        }

        $pet = Pet::find($appointment['pet_id']);
        $owner = User::find($appointment['owner_id']);
        $pastRecords = ConsultationRecord::getForPet((int)$appointment['pet_id']);

        $this->render('portal.vet.appointments.details', [
            'pageTitle' => "Consultation #{$id} — Pet Guard",
            'appointment' => $appointment,
            'pet' => $pet,
            'owner' => $owner,
            'pastRecords' => $pastRecords
        ], 'portal');
    }

    public function updateAppointmentStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        $validStatuses = ['pending', 'confirmed', 'completed', 'cancelled', 'rejected'];

        if (!in_array($status, $validStatuses, true)) {
            $this->jsonError('Invalid appointment status.');
        }

        Appointment::update((int)$id, ['status' => $status]);
        AuditLog::log('APPOINTMENT_STATUS_UPDATE', 'appointments', (int)$id, ['status' => $status]);

        if ($this->request->isAjax()) {
            $this->jsonSuccess("Appointment status updated to {$status}.");
        } else {
            Flash::success("Appointment status updated to {$status}.");
            $this->redirect('vet/appointments');
        }
    }

    /**
     * Patients & Medical Records
     */
    public function patients(): void
    {
        $vetId = $this->getVetUserId();
        $search = trim((string)$this->request->get('search', ''));

        $sql = "SELECT p.*, u.name as owner_name, u.phone as owner_phone, u.email as owner_email
                FROM `pets` p
                JOIN `users` u ON p.user_id = u.id";
        $params = [];

        if (!empty($search)) {
            $sql .= " WHERE p.name LIKE :s OR p.breed LIKE :s OR p.microchip_id LIKE :s OR u.name LIKE :s";
            $params['s'] = "%{$search}%";
        }

        $sql .= " ORDER BY p.id DESC LIMIT 50";
        $patients = Pet::query($sql, $params);

        $this->render('portal.vet.patients.index', [
            'pageTitle' => 'Patients Medical Database — Pet Guard',
            'patients' => $patients,
            'search' => $search
        ], 'portal');
    }

    public function patientDetails(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            Flash::error('Patient record not found.');
            $this->redirect('vet/patients');
        }

        $owner = User::find($pet['user_id']);
        $consultations = ConsultationRecord::getForPet((int)$pet['id']);
        $vaccines = Vaccine::getForPet((int)$pet['id']);
        $medications = PetMedication::getForPet((int)$pet['id']);

        $this->render('portal.vet.patients.details', [
            'pageTitle' => "Patient: {$pet['name']} — Pet Guard",
            'pet' => $pet,
            'owner' => $owner,
            'consultations' => $consultations,
            'vaccines' => $vaccines,
            'medications' => $medications
        ], 'portal');
    }

    /**
     * Clinical Consultations & Prescriptions
     */
    public function createConsultation(): void
    {
        $vetId = $this->getVetUserId();
        $data = $this->validate($this->request->all(), [
            'pet_id' => 'required|numeric',
            'owner_id' => 'required|numeric',
            'diagnosis' => 'required|min:3',
            'treatment_plan' => 'required|min:3'
        ]);

        $recordId = ConsultationRecord::create([
            'appointment_id' => $this->request->input('appointment_id') ? (int)$this->request->input('appointment_id') : null,
            'vet_id' => $vetId,
            'pet_id' => (int)$data['pet_id'],
            'owner_id' => (int)$data['owner_id'],
            'symptoms' => $this->request->input('symptoms', ''),
            'diagnosis' => $data['diagnosis'],
            'treatment_plan' => $data['treatment_plan'],
            'prescription' => $this->request->input('prescription', ''),
            'clinical_notes' => $this->request->input('clinical_notes', ''),
            'follow_up_date' => $this->request->input('follow_up_date') ?: null
        ]);

        // If appointment linked, mark as completed
        if ($this->request->input('appointment_id')) {
            Appointment::update((int)$this->request->input('appointment_id'), ['status' => 'completed']);
        }

        AuditLog::log('CONSULTATION_RECORD_CREATED', 'consultation_records', $recordId);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Clinical consultation record & prescription saved successfully.');
        } else {
            Flash::success('Clinical consultation record saved successfully.');
            $this->redirect('vet/patients/' . $data['pet_id']);
        }
    }

    /**
     * Reviews
     */
    public function reviews(): void
    {
        $this->render('portal.vet.reviews', [
            'pageTitle' => 'Patient Reviews & Accreditations — Pet Guard'
        ], 'portal');
    }
}
