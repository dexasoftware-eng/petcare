<?php

namespace Models;

use Core\Model;

class VetAvailability extends Model
{
    protected static string $table = 'vet_availabilities';

    public static function getScheduleForVet(int $vetId): array
    {
        return self::where('vet_id = :vid', ['vid' => $vetId], "FIELD(day_of_week, 'monday','tuesday','wednesday','thursday','friday','saturday','sunday')");
    }

    public static function isSlotAvailable(int $vetId, string $date, string $time): bool
    {
        $dayOfWeek = strtolower(date('l', strtotime($date)));
        $availability = self::firstWhere('vet_id = :vid AND day_of_week = :day AND is_available = 1', [
            'vid' => $vetId,
            'day' => $dayOfWeek
        ]);

        if (!$availability) {
            return false;
        }

        // Check against booked appointments to prevent double booking
        $booked = Appointment::count("vet_id = :vid AND appointment_date = :adate AND appointment_time = :atime AND status NOT IN ('cancelled', 'rejected')", [
            'vid' => $vetId,
            'adate' => $date,
            'atime' => $time
        ]);

        return $booked === 0;
    }
}
