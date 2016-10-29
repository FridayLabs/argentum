<?php


if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        $basePath = app()->basePath();
        return $basePath.'/resources'.($path ? '/'.$path : $path);
    }
}

if (!function_exists('vendor_path')) {
    function vendor_path($path = '')
    {
        return app()->basePath().'/vendor'.($path ? '/'.$path : $path);
    }
}
