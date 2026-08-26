<?php

namespace Core;

class App
{
    private static string $rootDir;
    private Router $router;
    private Request $request;
    private Response $response;

    public function __construct(string $rootDir)
    {
        self::$rootDir = rtrim($rootDir, '/\\');
        $this->registerAutoloader();
        $this->bootstrap();
    }

    public static function getRootDir(): string
    {
        return self::$rootDir;
    }

    private function registerAutoloader(): void
    {
        spl_autoload_register(function ($class) {
            // Replace namespace separators with directory separators
            $path = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

            // Check direct root
            $file = self::$rootDir . DIRECTORY_SEPARATOR . $path;
            if (file_exists($file)) {
                require_once $file;
                return;
            }

            // Check lowercase directory variations (e.g. Core -> core, Controllers -> controllers)
            $parts = explode('\\', $class);
            if (count($parts) > 1) {
                $dir = strtolower($parts[0]);
                $file = self::$rootDir . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, array_slice($parts, 1)) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                    return;
                }
            }
        });
    }

    private function bootstrap(): void
    {
        // Load configurations
        $config = require self::$rootDir . '/config/config.php';
        $dbConfig = require self::$rootDir . '/config/database.php';

        // Set Timezone
        date_default_timezone_set($config['timezone'] ?? 'UTC');

        // Init Session
        Session::start();

        // Init Database
        Database::init($dbConfig);

        // Init Views
        View::init(self::$rootDir . '/views');
        View::share('appName', $config['app_name'] ?? 'PetGuard');
        View::share('baseUrl', rtrim($config['app_url'] ?? '', '/'));

        // Init Request, Response, Router
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function run(): void
    {
        $this->router->dispatch();
    }
}
