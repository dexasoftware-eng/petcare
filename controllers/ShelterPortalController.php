<?php

declare(strict_types=1);

namespace Controllers;

use Core\Controller;
use Helpers\Auth;
use Helpers\Flash;
use Helpers\ViewHelper;
use Models\User;
use Models\ShelterProfile;
use Models\Pet;
use Models\AdoptionApplication;
use Models\AuditLog;

class ShelterPortalController extends Controller
{
    private function getShelterUserId(): int
    {
        $userId = Auth::id();
        if (!$userId) {
            $this->redirect('login');
        }
        return (int)$userId;
    }

    /**
     * Shelter Dashboard
     */
    public function dashboard(): void
    {
        $shelterId = $this->getShelterUserId();
        $user = Auth::user();
        $profile = ShelterProfile::findBy('user_id', $shelterId);

        $kpi = [
            'totalAnimals' => Pet::count("user_id = {$shelterId} OR is_for_adoption = 1"),
            'availableForAdoption' => Pet::count("(user_id = {$shelterId} OR is_for_adoption = 1) AND passport_status = 'active'"),
            'pendingApplications' => AdoptionApplication::count("shelter_id = {$shelterId} AND (status = 'submitted' OR status = 'under_review')"),
            'successfulAdoptions' => AdoptionApplication::count("shelter_id = {$shelterId} AND status = 'adopted'")
        ];

        $animals = Pet::where("user_id = :uid OR is_for_adoption = 1", ['uid' => $shelterId], 'id DESC', 6);
        $recentApplications = AdoptionApplication::getWithDetails("a.shelter_id = :sid OR a.shelter_id IS NULL", ['sid' => $shelterId], 'a.id DESC LIMIT 5');

        $this->render('portal.shelter.dashboard', [
            'pageTitle' => 'Animal Rescue & Shelter Dashboard — Pet Guard',
            'user' => $user,
            'profile' => $profile,
            'kpi' => $kpi,
            'animals' => $animals,
            'recentApplications' => $recentApplications
        ], 'portal');
    }

    /**
     * Shelter Profile & Facility
     */
    public function profile(): void
    {
        $shelterId = $this->getShelterUserId();
        $user = Auth::user();
        $profile = ShelterProfile::findBy('user_id', $shelterId);

        $this->render('portal.shelter.profile', [
            'pageTitle' => 'Shelter Sanctuary Profile — Pet Guard',
            'user' => $user,
            'profile' => $profile
        ], 'portal');
    }

    public function updateProfile(): void
    {
        $shelterId = $this->getShelterUserId();
        $data = $this->validate($this->request->all(), [
            'shelter_name' => 'required|min:2|max:150',
            'contact_person' => 'required|min:2|max:100',
            'phone' => 'required|min:6',
            'address' => 'required|min:4',
            'capacity' => 'required|numeric'
        ]);

        User::update($shelterId, [
            'name' => $data['shelter_name'],
            'phone' => $data['phone'],
            'address' => $data['address']
        ]);

        $profile = ShelterProfile::findBy('user_id', $shelterId);
        $profileData = [
            'shelter_name' => $data['shelter_name'],
            'contact_person' => $data['contact_person'],
            'capacity' => (int)$data['capacity'],
            'website' => $this->request->input('website', '')
        ];

        if ($profile) {
            ShelterProfile::update($profile['id'], $profileData);
        } else {
            $profileData['user_id'] = $shelterId;
            ShelterProfile::create($profileData);
        }

        AuditLog::log('SHELTER_PROFILE_UPDATED', 'shelter_profiles', $shelterId);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Shelter profile updated.');
        } else {
            Flash::success('Shelter profile updated.');
            $this->redirect('shelter/profile');
        }
    }

    /**
     * Rescue Animals Management CRUD
     */
    public function animals(): void
    {
        $shelterId = $this->getShelterUserId();
        $animals = Pet::where("user_id = :uid OR is_for_adoption = 1", ['uid' => $shelterId], 'id DESC');

        $this->render('portal.shelter.animals.index', [
            'pageTitle' => 'Rescue Animals Catalog — Pet Guard',
            'animals' => $animals
        ], 'portal');
    }

    public function createAnimalView(): void
    {
        $this->render('portal.shelter.animals.create', [
            'pageTitle' => 'List Rescue Animal for Adoption — Pet Guard'
        ], 'portal');
    }

    public function createAnimal(): void
    {
        $shelterId = $this->getShelterUserId();
        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'species' => 'required',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'age' => 'required',
            'weight' => 'required'
        ]);

        $qrToken = 'PG-SHELTER-' . strtoupper(substr(uniqid(), -6)) . '-' . rand(100, 999);

        // Handle Photo Upload
        $avatarPath = $data['species'] === 'Cat' ? 'assets/img/cat-1.png' : 'assets/img/dog-1.png';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
                $filename = 'pet_' . uniqid() . '.' . $ext;
                $dest = dirname(__DIR__) . '/assets/img/' . $filename;
                if (move_uploaded_file($_FILES['photo']['tmp_name'], $dest)) {
                    $avatarPath = 'assets/img/' . $filename;
                }
            }
        }

        $petId = Pet::create([
            'user_id' => $shelterId,
            'name' => $data['name'],
            'species' => $data['species'],
            'breed' => $data['breed'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'microchip_id' => $this->request->input('microchip_id', null),
            'is_for_adoption' => 1,
            'care_score' => 95,
            'vaccination_status' => $this->request->input('vaccination_status', 'Up to Date'),
            'avatar' => $avatarPath,
            'qr_token' => $qrToken,
            'passport_status' => 'active',
            'diet_instructions' => $this->request->input('temperament_notes', 'Gentle and social')
        ]);

        AuditLog::log('RESCUE_PET_LISTED', 'pets', $petId, ['name' => $data['name']]);

        if ($this->request->isAjax()) {
            $this->jsonSuccess("Animal {$data['name']} added to adoption listings.", ['pet_id' => $petId]);
        } else {
            Flash::success("Rescue animal {$data['name']} listed for adoption!");
            $this->redirect('shelter/animals');
        }
    }

    public function animalDetails(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            Flash::error('Rescue animal not found.');
            $this->redirect('shelter/animals');
        }

        $applications = AdoptionApplication::getWithDetails("a.pet_id = :pid", ['pid' => (int)$pet['id']]);

        $this->render('portal.shelter.animals.details', [
            'pageTitle' => "Rescue Profile: {$pet['name']} — Pet Guard",
            'pet' => $pet,
            'applications' => $applications
        ], 'portal');
    }

    public function editAnimalView(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            Flash::error('Rescue animal not found.');
            $this->redirect('shelter/animals');
        }

        $this->render('portal.shelter.animals.edit', [
            'pageTitle' => "Edit Rescue Animal: {$pet['name']} — Pet Guard",
            'pet' => $pet
        ], 'portal');
    }

    public function updateAnimal(int|string $id): void
    {
        $pet = Pet::find($id);
        if (!$pet) {
            $this->jsonError('Rescue animal not found.');
        }

        $data = $this->validate($this->request->all(), [
            'name' => 'required|min:2|max:100',
            'species' => 'required',
            'breed' => 'required',
            'gender' => 'required|in:Male,Female',
            'age' => 'required',
            'weight' => 'required'
        ]);

        $payload = [
            'name' => $data['name'],
            'species' => $data['species'],
            'breed' => $data['breed'],
            'gender' => $data['gender'],
            'age' => $data['age'],
            'weight' => $data['weight'],
            'microchip_id' => $this->request->input('microchip_id', $pet['microchip_id']),
            'vaccination_status' => $this->request->input('vaccination_status', $pet['vaccination_status']),
            'diet_instructions' => $this->request->input('temperament_notes', $pet['diet_instructions'])
        ];

        Pet::update((int)$id, $payload);
        AuditLog::log('RESCUE_PET_UPDATED', 'pets', (int)$id);

        if ($this->request->isAjax()) {
            $this->jsonSuccess('Rescue animal details updated.');
        } else {
            Flash::success('Rescue animal details updated.');
            $this->redirect('shelter/animals/' . $id);
        }
    }

    public function deleteAnimal(int|string $id): void
    {
        $pet = Pet::find($id);
        if ($pet) {
            Pet::delete((int)$id);
            $this->jsonSuccess('Animal removed from shelter directory.');
        } else {
            $this->jsonError('Animal not found.');
        }
    }

    /**
     * Adoption Applications Workflow
     */
    public function applications(): void
    {
        $shelterId = $this->getShelterUserId();
        $applications = AdoptionApplication::getWithDetails("a.shelter_id = :sid OR a.shelter_id IS NULL", ['sid' => $shelterId], 'a.id DESC');

        $this->render('portal.shelter.applications.index', [
            'pageTitle' => 'Adoption Applications Workflow — Pet Guard',
            'applications' => $applications
        ], 'portal');
    }

    public function applicationDetails(int|string $id): void
    {
        $app = AdoptionApplication::find($id);
        if (!$app) {
            Flash::error('Application not found.');
            $this->redirect('shelter/applications');
        }

        $pet = Pet::find($app['pet_id']);
        $applicant = User::find($app['applicant_id']);

        $this->render('portal.shelter.applications.details', [
            'pageTitle' => "Application #{$id} — Pet Guard",
            'app' => $app,
            'pet' => $pet,
            'applicant' => $applicant
        ], 'portal');
    }

    public function updateApplicationStatus(int|string $id): void
    {
        $status = $this->request->input('status');
        $valid = ['submitted', 'under_review', 'interview', 'approved', 'rejected', 'adopted'];

        if (!in_array($status, $valid, true)) {
            $this->jsonError('Invalid application state.');
        }

        $notes = $this->request->input('reviewer_notes', '');
        AdoptionApplication::update((int)$id, [
            'status' => $status,
            'reviewer_notes' => $notes
        ]);

        // If marked adopted, update pet status
        $app = AdoptionApplication::find($id);
        if ($status === 'adopted' && $app) {
            Pet::update((int)$app['pet_id'], ['is_for_adoption' => 0]);
        }

        AuditLog::log('ADOPTION_APPLICATION_STATUS', 'adoption_applications', (int)$id, ['status' => $status]);

        if ($this->request->isAjax()) {
            $this->jsonSuccess("Application status updated to {$status}.");
        } else {
            Flash::success("Application status updated to {$status}.");
            $this->redirect('shelter/applications/' . $id);
        }
    }

    /**
     * Interviews & Video Calls
     */
    public function interviews(): void
    {
        $shelterId = $this->getShelterUserId();
        $interviews = AdoptionApplication::getWithDetails("(a.shelter_id = :sid OR a.shelter_id IS NULL) AND a.status = 'interview'", ['sid' => $shelterId]);

        $this->render('portal.shelter.interviews', [
            'pageTitle' => 'Adoption Video Interviews — Pet Guard',
            'interviews' => $interviews
        ], 'portal');
    }
}
