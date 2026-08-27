<?php

namespace Core;

use Helpers\Validator;

abstract class Controller
{
    protected Request $request;
    protected Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function render(string $view, array $data = [], ?string $layout = 'main'): void
    {
        echo View::render($view, $data, $layout);
    }

    protected function json(mixed $data, int $statusCode = 200): void
    {
        $this->response->json($data, $statusCode);
    }

    protected function redirect(string $url, int $statusCode = 302): void
    {
        $this->response->redirect($url, $statusCode);
    }

    protected function back(): void
    {
        $this->response->back();
    }

    protected function validate(array $data, array $rules): array
    {
        $validator = new Validator($data, $rules);
        if (!$validator->passes()) {
            if ($this->request->isAjax()) {
                $this->json([
                    'success' => false,
                    'message' => $validator->firstError() ?: 'Validation failed. Please check your inputs.',
                    'errors' => $validator->errors()
                ], 422);
                exit;
            }
            Session::set('_old_input', $data);
            Session::set('_validation_errors', $validator->errors());
            Session::setFlash('error', $validator->firstError() ?: 'Validation failed. Please correct the highlighted errors.');
            $this->back();
        }
        return $validator->validated();
    }

    protected function jsonSuccess(string $message = 'Operation successful.', array $data = []): void
    {
        $this->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ]);
        exit;
    }

    protected function jsonError(string $message = 'An error occurred.', array $errors = [], int $status = 400): void
    {
        $this->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], $status);
        exit;
    }

    protected function validateCsrf(): void
    {
        $token = $this->request->input('_csrf') 
              ?: $this->request->input('csrf_token') 
              ?: $this->request->input('_token') 
              ?: ($_SERVER['HTTP_X_CSRF_TOKEN'] ?? null) 
              ?: ($_SERVER['HTTP_X_XSRF_TOKEN'] ?? null);

        if (!Session::validateCsrf($token)) {
            if ($this->request->isAjax()) {
                $this->json(['success' => false, 'message' => 'Security token expired. Please refresh the page.'], 419);
                exit;
            }
            \Helpers\Flash::error('Security token expired. Please try submitting the form again.');
            $this->back();
            exit;
        }
    }

    protected function setFlash(string $type, string $message): void
    {
        Session::setFlash($type, $message);
    }
}
