<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class ShelterMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please sign in to access your Shelter portal.');
            $response->redirect('login');
        }

        $role = Auth::role();
        if ($role !== 'shelter' && $role !== 'admin') {
            Flash::error('Access restricted to Animal Shelters.');
            $response->redirect('login');
        }
    }
}
