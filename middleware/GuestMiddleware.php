<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Helpers\Auth;

class GuestMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if (Auth::check()) {
            $role = Auth::role();
            $response->redirect('portal');
        }
    }
}
