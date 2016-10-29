<?php

namespace App\Providers;

use App\Extensions\Extension;
use Illuminate\Support\ServiceProvider;

class ExtensionServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('extensions', function () {
            $this->app->configure('extensions');
            $extensions = [];
            foreach (config('extensions') as $extensionClass) {
                $ext = new $extensionClass($this->app);
                if (!$ext instanceof Extension) {
                    throw new \Exception($ext.' should extend '.Extension::class.' class');
                }
                $extensions[] = $ext;
            }

            return $extensions;
        });
    }

    public function boot()
    {
        /**
         * @var Extension[]
         */
        $extensions = $this->app->make('extensions');
        foreach ($extensions as $extension) {
            $extension->boot();
        }
    }
}
