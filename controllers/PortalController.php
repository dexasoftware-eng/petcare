<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Models\User;
use Models\Pet;
use Models\Appointment;
use Models\Order;
use Models\VeterinarianProfile;
use Models\ShelterProfile;
use Models\AuditLog;
use Models\Inquiry;

class PortalController extends Controller
{
    public function index(): void
    {
        $user = Auth::user();
        if (!$user) {
            $this->redirect('login');
        }

        $role = $user['role'];
        $viewData = [
            'user' => $user,
            'role' => $role,
            'pageTitle' => ucfirst($role) . ' Dashboard — PetGuard'
        ];

        switch ($role) {
            case 'petowner':
                $viewData['pets'] = Pet::getPetsByUser((int)$user['id']);
                $viewData['appointments'] = Appointment::getWithDetailsForOwner((int)$user['id']);
                $viewData['orders'] = Order::getOrdersByUser((int)$user['id']);
                $viewData['vets'] = User::where("role = 'veterinarian' AND status = 'active'", []);
                break;

            case 'veterinarian':
                $viewData['profile'] = VeterinarianProfile::findBy('user_id', (int)$user['id']);
                $viewData['appointments'] = Appointment::getWithDetailsForVet((int)$user['id']);
                break;

            case 'shelter':
                $viewData['profile'] = ShelterProfile::findBy('user_id', (int)$user['id']);
                $viewData['pets'] = Pet::where("user_id = :uid OR is_for_adoption = 1", ['uid' => (int)$user['id']]);
                break;

            case 'admin':
                $viewData['stats'] = [
                    'totalUsers' => User::count(),
                    'totalOwners' => User::count("role = 'petowner'"),
                    'totalVets' => User::count("role = 'veterinarian'"),
                    'totalShelters' => User::count("role = 'shelter'"),
                    'totalPets' => Pet::count(),
                    'totalOrders' => Order::count(),
                    'recentLogsCount' => AuditLog::count()
                ];
                $viewData['users'] = User::all('created_at DESC');
                $viewData['auditLogs'] = AuditLog::where("1=1", [], 'created_at DESC', 15);
                $viewData['inquiries'] = Inquiry::all('created_at DESC');
                $viewData['filters'] = ['role' => '', 'status' => '', 'search' => ''];
                break;
        }

        $this->render('portal.index', $viewData, 'portal');
    }

    public function createPet(): void
    {
        $userId = Auth::id();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'species' => 'required',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'age' => 'required',
            'weight' => 'required'
        ]);

        $qrToken = 'FS-PET-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);

        $petId = Pet::create([
            'user_id' => $userId,
            'name' => $data['name'],
            'species' => $data['species'],
            'breed' => $data['breed'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'microchip_id' => $this->request->input('microchip_id', null),
            'blood_group' => $this->request->input('blood_group', null),
            'is_for_adoption' => 0,
            'care_score' => 90,
            'vaccination_status' => 'Scheduled',
            'avatar' => $data['species'] === 'Cat' ? 'assets/img/cat-1.png' : 'assets/img/dog-1.png',
            'qr_token' => $qrToken
        ]);

        AuditLog::log('PET_REGISTERED', 'pets', $petId, ['name' => $data['name']]);
        Flash::success("Pet {$data['name']} registered successfully!");
        $this->redirect('portal');
    }

    public function deletePet(int|string $id): void
    {
        $userId = Auth::id();
        $pet = Pet::find($id);

        if (!$pet || ($pet['user_id'] != $userId && Auth::role() !== 'admin')) {
            Flash::error('Pet record not found or access denied.');
            $this->redirect('portal');
        }

        Pet::delete($id);
        AuditLog::log('PET_DELETED', 'pets', (int)$id, ['name' => $pet['name']]);
        Flash::success("Pet profile deleted successfully.");
        $this->redirect('portal');
    }

    public function bookAppointment(): void
    {
        $userId = Auth::id();
        $data = $this->validate($this->request->all(), [
            'pet_id' => 'required|numeric',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'consultation_type' => 'required',
            'symptoms' => 'required|min:5'
        ]);

        $pet = Pet::find($data['pet_id']);
        if (!$pet || $pet['user_id'] != $userId) {
            Flash::error('Selected pet was not found in your account.');
            $this->redirect('portal');
        }

        $vetId = $this->request->input('vet_id');

        $apptId = Appointment::create([
            'owner_id' => $userId,
            'vet_id' => !empty($vetId) ? (int)$vetId : null,
            'pet_id' => (int)$data['pet_id'],
            'appointment_date' => $data['appointment_date'],
            'appointment_time' => $data['appointment_time'],
            'consultation_type' => $data['consultation_type'],
            'symptoms' => $data['symptoms'],
            'status' => 'pending'
        ]);

        AuditLog::log('APPOINTMENT_BOOKED', 'appointments', $apptId);
        Flash::success("Appointment booked successfully! Clinic will confirm your slot shortly.");
        $this->redirect('portal');
    }

    public function updateAppointmentStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        if (in_array($status, ['pending', 'confirmed', 'completed', 'cancelled'])) {
            Appointment::update($id, ['status' => $status]);
            AuditLog::log('APPOINTMENT_STATUS_UPDATED', 'appointments', (int)$id, ['status' => $status]);
            Flash::success("Appointment updated to " . ucfirst($status));
        }
        $this->redirect('portal');
    }

    public function createRescuePet(): void
    {
        $userId = Auth::id();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'species' => 'required',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'age' => 'required',
            'weight' => 'required'
        ]);

        $qrToken = 'FS-RESCUE-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);

        $petId = Pet::create([
            'user_id' => $userId,
            'name' => $data['name'],
            'species' => $data['species'],
            'breed' => $data['breed'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'medical_notes' => $this->request->input('medical_notes', 'Vaccinated rescue animal.'),
            'is_for_adoption' => 1,
            'adoption_status' => 'available',
            'care_score' => 95,
            'vaccination_status' => 'Up to Date',
            'avatar' => $data['species'] === 'Cat' ? 'assets/img/cat-1.png' : 'assets/img/dog-1.png',
            'qr_token' => $qrToken
        ]);

        AuditLog::log('RESCUE_PET_LISTED', 'pets', $petId, ['name' => $data['name']]);
        Flash::success("Rescue animal {$data['name']} published for adoption!");
        $this->redirect('portal');
    }

    public function updateAdoptionStatus(int|string $id): void
    {
        $status = $this->request->input('adoption_status');
        if (in_array($status, ['available', 'pending', 'adopted'])) {
            Pet::update($id, ['adoption_status' => $status]);
            AuditLog::log('ADOPTION_STATUS_UPDATED', 'pets', (int)$id, ['adoption_status' => $status]);
            Flash::success("Listing status updated to " . ucfirst($status));
        }
        $this->redirect('portal');
    }

    public function deleteRescuePet(int|string $id): void
    {
        Pet::delete($id);
        AuditLog::log('RESCUE_PET_DELETED', 'pets', (int)$id);
        Flash::success("Listing removed.");
        $this->redirect('portal');
    }

    public function updateUserStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        if (in_array($status, ['active', 'pending', 'suspended', 'disabled'])) {
            User::update($id, ['status' => $status]);
            AuditLog::log('USER_STATUS_UPDATED', 'users', (int)$id, ['status' => $status]);
            Flash::success("User status changed to " . ucfirst($status));
        }
        $this->redirect('portal');
    }

    public function resolveInquiry(int|string $id): void
    {
        Inquiry::update($id, ['status' => 'resolved']);
        AuditLog::log('INQUIRY_RESOLVED', 'inquiries', (int)$id);
        Flash::success("Inquiry marked as resolved.");
        $this->redirect('portal');
    }
}
