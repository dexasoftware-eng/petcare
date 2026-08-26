<?php

namespace Middleware;

use Core\Request;
use Core\Response;
use Core\Session;
use Helpers\Flash;

class CsrfMiddleware
{
    public function handle(Request $request, Response $response): void
    {
        if ($request->isPost()) {
            $token = $request->input('_csrf') ?: $request->input('csrf_token') ?: ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null);
            if (!Session::validateCsrf($token)) {
                if ($request->isAjax()) {
                    $response->json(['success' => false, 'message' => 'CSRF token mismatch. Please reload the page.'], 419);
                }
                Flash::error('Security token expired. Please try submitting the form again.');
                $response->back();
            }
        }
    }
}
