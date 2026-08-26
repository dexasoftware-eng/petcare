<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class RoleMiddleware
{
    protected array $allowedRoles = [];

    public function __construct(array $allowedRoles = [])
    {
        $this->allowedRoles = $allowedRoles;
    }

    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please log in to continue.');
            $response->redirect('login');
        }

        $userRole = Auth::role();

        // Admin always has access to all routes
        if ($userRole === 'admin') {
            return;
        }

        if (!empty($this->allowedRoles) && !in_array($userRole, $this->allowedRoles, true)) {
            Flash::error('You do not have permission to access that area.');
            $response->redirect('login');
        }
    }
}
