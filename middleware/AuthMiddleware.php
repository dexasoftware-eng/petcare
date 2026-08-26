<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class AuthMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            if ($request->isAjax()) {
                $response->json(['success' => false, 'message' => 'Unauthorized. Please log in.'], 401);
            }
            Flash::warning('Please sign in to access this page.');
            $response->redirect('login');
        }

        // Check if account is suspended or disabled
        $user = Auth::user();
        if ($user && in_array($user['status'] ?? 'active', ['suspended', 'disabled'])) {
            Auth::logout();
            Flash::error('Your account has been deactivated. Please contact support.');
            $response->redirect('login');
        }
    }
}
