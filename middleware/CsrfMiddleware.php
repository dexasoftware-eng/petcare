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
            $headers = function_exists('getallheaders') ? getallheaders() : [];
            $headerToken = $_SERVER['HTTP_X_CSRF_TOKEN'] 
                        ?? $_SERVER['HTTP_X_XSRF_TOKEN'] 
                        ?? $headers['X-CSRF-Token'] 
                        ?? $headers['X-Csrf-Token'] 
                        ?? $headers['x-csrf-token'] 
                        ?? null;

            $token = $request->input('_csrf') 
                  ?: $request->input('csrf_token') 
                  ?: $request->input('_token') 
                  ?: $headerToken;

            if (!Session::validateCsrf($token)) {
                if ($request->isAjax()) {
                    $response->json(['success' => false, 'message' => 'Security token expired. Please refresh the page.'], 419);
                    exit;
                }
                Flash::error('Security token expired. Please try submitting the form again.');
                $response->back();
                exit;
            }
        }
    }
}
