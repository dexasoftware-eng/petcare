<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;
use Helpers\Flash;

class AdminMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (!Auth::check()) {
            Flash::warning('Please log in as an administrator.');
            $response->redirect('login');
        }

        if (Auth::role() !== 'admin') {
            Flash::error('Access denied. Administrator privileges required.');
            $response->redirect('login');
        }
    }
}
