<?php


if (!function_exists('vendor_path')) {
    function vendor_path($path = '')
    {
        return app()->basePath().'/vendor'.($path ? '/'.$path : $path);
    }
}
