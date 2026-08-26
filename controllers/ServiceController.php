<?php

namespace Controllers;

use Core\Controller;
use Models\Service;

class ServiceController extends Controller
{
    public function index(): void
    {
        $services = Service::all('is_highlight DESC, id ASC');

        $this->render('pages.services', [
            'pageTitle' => 'Clinical Services & Specialized Care — PetGuard',
            'services' => $services
        ]);
    }

    public function details(string $slug): void
    {
        $service = Service::findBySlug($slug);

        if (!$service) {
            $this->redirect('services');
        }

        $allServices = Service::all('id ASC');

        $this->render('pages.service-details', [
            'pageTitle' => "{$service['title']} — PetGuard",
            'service' => $service,
            'allServices' => $allServices
        ]);
    }
}
