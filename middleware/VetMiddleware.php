<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class VetMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please sign in to access your Veterinarian portal.');
            $response->redirect('login');
        }

        $role = Auth::role();
        if ($role !== 'veterinarian' && $role !== 'admin') {
            Flash::error('Access restricted to Veterinarians.');
            $response->redirect('login');
        }
    }
}
