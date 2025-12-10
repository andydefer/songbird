<?php
// helpers.php du package (optionnel, juste pour l'éditeur)

if (!function_exists('config_path')) {
    function config_path($path = '')
    {
        return $path ? 'config/' . $path : 'config';
    }
}

if (!function_exists('database_path')) {
    function database_path($path = '')
    {
        return $path ? 'database/' . $path : 'database';
    }
}

if (!function_exists('base_path')) {
    function base_path($path = '')
    {
        return $path ? __DIR__ . '/../' . $path : __DIR__ . '/../';
    }
}
