<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class VendorMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please sign in to access your vendor store dashboard.');
            $response->redirect('login');
        }

        $role = Auth::role();
        if ($role !== 'vendor' && $role !== 'admin') {
            Flash::error('Unauthorized access. This area is reserved for registered Pet Guard vendors.');
            $response->redirect('login');
        }
    }
}
