<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class OwnerMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please sign in to access your Pet Owner portal.');
            $response->redirect('login');
        }

        $role = Auth::role();
        if ($role !== 'petowner' && $role !== 'admin') {
            Flash::error('Access restricted to Pet Owners.');
            $response->redirect('login');
        }
    }
}
