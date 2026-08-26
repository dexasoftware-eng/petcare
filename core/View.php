<?php

namespace Core;

use Exception;

class View
{
    private static string $viewsPath = '';
    private static array $globalData = [];

    public static function init(string $viewsPath): void
    {
        self::$viewsPath = rtrim($viewsPath, '/');
    }

    public static function share(string $key, mixed $value): void
    {
        self::$globalData[$key] = $value;
    }

    public static function render(string $view, array $data = [], ?string $layout = 'main'): string
    {
        if (empty(self::$viewsPath)) {
            self::$viewsPath = dirname(__DIR__) . '/views';
        }

        $viewFile = self::$viewsPath . '/' . str_replace('.', '/', $view) . '.php';

        if (!file_exists($viewFile)) {
            throw new Exception("View template [{$view}] not found at {$viewFile}");
        }

        // Merge global shared data with view specific data
        $mergedData = array_merge(self::$globalData, $data);
        extract($mergedData, EXTR_SKIP);

        // Capture view output buffer
        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        // If no layout is specified, return raw content
        if ($layout === null) {
            return $content;
        }

        $layoutFile = self::$viewsPath . '/layouts/' . $layout . '.php';
        if (!file_exists($layoutFile)) {
            throw new Exception("Layout [{$layout}] not found at {$layoutFile}");
        }

        // Capture layout output buffer with $content injected
        ob_start();
        include $layoutFile;
        return ob_get_clean();
    }

    public static function partial(string $partial, array $data = []): void
    {
        if (empty(self::$viewsPath)) {
            self::$viewsPath = dirname(__DIR__) . '/views';
        }

        $partialFile = self::$viewsPath . '/partials/' . str_replace('.', '/', $partial) . '.php';
        if (file_exists($partialFile)) {
            $mergedData = array_merge(self::$globalData, $data);
            extract($mergedData, EXTR_SKIP);
            include $partialFile;
        }
    }
}
