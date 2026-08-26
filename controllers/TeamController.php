<?php

namespace Controllers;

use Core\Controller;
use Models\Team;

class TeamController extends Controller
{
    public function details(int|string $id = 1): void
    {
        $member = Team::find($id);

        if (!$member) {
            $member = Team::firstWhere('1=1') ?: [
                'name' => 'Dr. Sarah Jenkins, DVM',
                'role' => 'Chief Veterinary Officer',
                'img' => 'assets/img/team-1.jpg',
                'bio' => 'Experienced clinician specializing in veterinary medicine and surgery.',
                'phone' => '+1-555-019-2834',
                'email' => 'dr.jenkins@petguard.com',
                'skills' => '[{"label":"Surgical Procedures","percentage":95},{"label":"Immunology","percentage":98}]'
            ];
        }

        $this->render('pages.team-details', [
            'pageTitle' => "{$member['name']} — Staff Profile",
            'member' => $member
        ]);
    }
}
