<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class SpacelessBladeDirectiveProvider extends ServiceProvider
{
    public function register()
    {
        app('blade.compiler')->directive('spaceless', function () {
            return '<?php ob_start() ?>';
        });
        app('blade.compiler')->directive('endspaceless', function () {
            return "<?php echo preg_replace('/>\\s+</', '><', ob_get_clean()); ?>";
        });
    }
}
