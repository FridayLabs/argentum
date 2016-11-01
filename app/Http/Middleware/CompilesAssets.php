<?php

namespace App\Http\Middleware;

use App\Assets\AssetManager;
use App\Assets\AssetWriter;
use Closure;

class CompilesAssets
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request, $response)
    {
        // TODO for non-extension pages assets will be wrote twice
        if (env('APP_DEBUG', false)) {
            $manager = app(AssetManager::class);
            $writer = app(AssetWriter::class);
            $writer->writeManagerAssets($manager);
        }
        return true;
    }
}