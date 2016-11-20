<?php


if (!function_exists('node_path')) {
    function node_path($path = '')
    {
        return app()->basePath() . '/node_modules' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

if (!function_exists('vendor_path')) {
    function vendor_path($path = '')
    {
        return app()->basePath() . '/vendor' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}