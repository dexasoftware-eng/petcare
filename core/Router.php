<?php

namespace Core;

use Exception;

class Router
{
    private Request $request;
    private Response $response;
    private array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, mixed $handler, array $middlewares = []): self
    {
        $this->addRoute('GET', $path, $handler, $middlewares);
        return $this;
    }

    public function post(string $path, mixed $handler, array $middlewares = []): self
    {
        $this->addRoute('POST', $path, $handler, $middlewares);
        return $this;
    }

    public function put(string $path, mixed $handler, array $middlewares = []): self
    {
        $this->addRoute('PUT', $path, $handler, $middlewares);
        return $this;
    }

    public function delete(string $path, mixed $handler, array $middlewares = []): self
    {
        $this->addRoute('DELETE', $path, $handler, $middlewares);
        return $this;
    }

    private function addRoute(string $method, string $path, mixed $handler, array $middlewares = []): void
    {
        $normalizedPath = '/' . trim($path, '/');
        if ($normalizedPath === '//') {
            $normalizedPath = '/';
        }

        // Convert path parameter syntax e.g. :id or {id} into regex named capture group
        $pattern = preg_replace('/\/:([a-zA-Z0-9_]+)/', '/(?P<$1>[^/]+)', $normalizedPath);
        $pattern = preg_replace('/\/\{([a-zA-Z0-9_]+)\}/', '/(?P<$1>[^/]+)', $pattern);
        $regex = '#^' . $pattern . '$#i';

        $this->routes[] = [
            'method' => $method,
            'path' => $normalizedPath,
            'regex' => $regex,
            'handler' => $handler,
            'middlewares' => $middlewares,
        ];
    }

    public function dispatch(): void
    {
        $requestMethod = $this->request->getMethod();
        $requestUri = $this->request->getUri();

        foreach ($this->routes as $route) {
            if ($route['method'] !== $requestMethod) {
                continue;
            }

            if (preg_match($route['regex'], $requestUri, $matches)) {
                // Filter out non-named regex capture matches
                $params = array_filter($matches, function ($key) {
                    return !is_numeric($key);
                }, ARRAY_FILTER_USE_KEY);

                // Run middlewares
                foreach ($route['middlewares'] as $middleware) {
                    $middlewareInstance = is_string($middleware) ? new $middleware() : $middleware;
                    if (method_exists($middlewareInstance, 'handle')) {
                        $middlewareInstance->handle($this->request, $this->response);
                    }
                }

                // Execute handler
                $handler = $route['handler'];

                if (is_callable($handler)) {
                    call_user_func_array($handler, [$this->request, $this->response, $params]);
                    return;
                }

                if (is_array($handler) && count($handler) === 2) {
                    [$controllerClass, $method] = $handler;
                    $controllerInstance = new $controllerClass($this->request, $this->response);
                    call_user_func_array([$controllerInstance, $method], array_values($params));
                    return;
                }

                if (is_string($handler) && str_contains($handler, '@')) {
                    [$controllerClass, $method] = explode('@', $handler);
                    $controllerInstance = new $controllerClass($this->request, $this->response);
                    call_user_func_array([$controllerInstance, $method], array_values($params));
                    return;
                }
            }
        }

        // 404 Handler
        $this->response->setStatusCode(404);
        try {
            echo View::render('pages.not-found', [
                'pageTitle' => '404 - Page Not Found',
                'requestedUri' => $requestUri
            ], 'main');
        } catch (Exception $e) {
            echo "<h1>404 Not Found</h1><p>The requested page <code>{$requestUri}</code> could not be found.</p>";
        }
    }
}
