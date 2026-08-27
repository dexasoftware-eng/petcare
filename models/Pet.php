<?php

namespace Models;

use Core\Model;

class Pet extends Model
{
    protected static string $table = 'pets';

    public static function getPetsByUser(int $userId): array
    {
        return self::where('user_id = :uid', ['uid' => $userId], 'id DESC');
    }

    public static function getAdoptionListings(): array
    {
        return self::where('is_for_adoption = 1 AND adoption_status = "available"', [], 'id DESC');
    }

    public static function getVaccines(int $petId): array
    {
        return Vaccine::where('pet_id = :pid', ['pid' => $petId], 'administered_date DESC');
    }

    public static function getCareTasks(int $petId): array
    {
        return CareTask::getTasksForPet($petId);
    }

    public static function getMedications(int $petId): array
    {
        return PetMedication::getMedicationsForPet($petId);
    }

    public static function getWeights(int $petId): array
    {
        return PetWeight::getWeightsForPet($petId);
    }

    public static function getDocuments(int $petId): array
    {
        return PetDocument::getDocsForPet($petId);
    }

    public static function getFamilyMembers(int $petId): array
    {
        return PetFamilyAccess::getFamilyForPet($petId);
    }

    public static function getEmergencyContacts(int $petId): array
    {
        return PetEmergencyContact::getContactsForPet($petId);
    }

    public static function getAppointments(int $petId): array
    {
        return Appointment::query("SELECT a.*, u.name AS vet_name, vp.clinic_name, vp.clinic_address
            FROM appointments a
            LEFT JOIN users u ON a.vet_id = u.id
            LEFT JOIN veterinarian_profiles vp ON u.id = vp.user_id
            WHERE a.pet_id = :pid
            ORDER BY a.appointment_date DESC", ['pid' => $petId]);
    }

    public static function getHealthTimeline(int $petId): array
    {
        $events = [];

        // 1. Vaccines
        $vaccines = self::getVaccines($petId);
        foreach ($vaccines as $v) {
            $events[] = [
                'type' => 'vaccine',
                'title' => 'Vaccination: ' . ($v['vaccine_name'] ?? 'Dose'),
                'description' => 'Administered by ' . ($v['administering_vet'] ?? 'Clinic') . ' (' . ($v['dose_number'] ?? 'Dose') . ')',
                'date' => $v['administered_date'],
                'icon' => 'fa-syringe',
                'badge' => 'bg-success'
            ];
        }

        // 2. Appointments
        $appts = self::getAppointments($petId);
        foreach ($appts as $a) {
            $events[] = [
                'type' => 'appointment',
                'title' => 'Clinical Consultation: ' . ($a['consultation_type'] ?? 'Checkup'),
                'description' => 'Status: ' . ucfirst($a['status']) . ($a['prescription'] ? ' • Rx Prescribed' : ''),
                'date' => $a['appointment_date'],
                'icon' => 'fa-stethoscope',
                'badge' => $a['status'] === 'completed' ? 'bg-primary' : 'bg-info'
            ];
        }

        // 3. Weight logs
        $weights = self::getWeights($petId);
        foreach ($weights as $w) {
            $events[] = [
                'type' => 'weight',
                'title' => 'Weight Recorded: ' . $w['weight_kg'] . ' kg',
                'description' => $w['notes'] ?: 'Regular health logging',
                'date' => $w['recorded_date'],
                'icon' => 'fa-weight-scale',
                'badge' => 'bg-warning text-dark'
            ];
        }

        // 4. Medications
        $meds = self::getMedications($petId);
        foreach ($meds as $m) {
            $events[] = [
                'type' => 'medication',
                'title' => 'Medication Started: ' . $m['name'],
                'description' => 'Dosage: ' . $m['dosage'] . ' (' . $m['frequency'] . ')',
                'date' => $m['start_date'],
                'icon' => 'fa-pills',
                'badge' => 'bg-danger'
            ];
        }

        // Sort descending by date
        usort($events, fn($a, $b) => strcmp($b['date'], $a['date']));
        return $events;
    }
}
