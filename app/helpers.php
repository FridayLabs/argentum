<?php

if (! function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}

if (! function_exists('bcrypt')) {
    /**
     * Hash the given value.
     *
     * @param  string  $value
     * @param  array   $options
     * @return string
     */
    function bcrypt($value, $options = [])
    {
        return app('hash')->make($value, $options);
    }
}

if (! function_exists('config_path')) {
    /**
     * Get the configuration path.
     *
     * @param  string $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath() . '/config' . ($path ? '/' . $path : $path);
    }
}

if (!function_exists('path')) {
    function path($path = '')
    {
        if (strpos($path, '::') !== false) {
            list($namespace, $path) = explode('::', $path);
            if (isset(app('extensions')[$namespace])) {
                return [app('extensions')[$namespace]->basePath(), $path];
            }
        }

        return [app()->basePath(), $path];
    }
}

if (!function_exists('resource_path')) {
    function resource_path($path = '')
    {
        $path = path($path);

        return $path[0] . '/resources' . ($path[1] ? '/' . $path[1] : $path[1]);
    }
}

if (!function_exists('node_path')) {
    function node_path($path = '')
    {
        $path = path($path);

        return $path[0] . '/node_modules' . ($path[1] ? '/' . $path[1] : $path[1]);
    }
}

if (!function_exists('vendor_path')) {
    function vendor_path($path = '')
    {
        $path = path($path);

        return $path[0] . '/vendor' . ($path[1] ? '/' . $path[1] : $path[1]);
    }
}

if (!function_exists('file_asset')) {
    function file_asset($pattern, $sourcePath, $name = null, $filters = [])
    {
        $asset = app(\App\Assets\AssetFactory::class)->file($pattern, $sourcePath, $name, $filters);
        app(\App\Assets\AssetManager::class)->addAsset($asset);

        return $asset;
    }
}

if (!function_exists('styles_assets')) {
    function styles_assets()
    {
        return app(\App\Assets\AssetManager::class)->styles();
    }
}

if (!function_exists('scripts_assets')) {
    function scripts_assets()
    {
        return app(\App\Assets\AssetManager::class)->scripts();
    }
}
