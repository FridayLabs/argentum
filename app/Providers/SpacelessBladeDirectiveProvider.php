<?php

namespace Argentum\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SpacelessBladeDirectiveProvider extends ServiceProvider
{
    public function register()
    {
        Blade::directive('spaceless', function () {
            return '<?php ob_start() ?>';
        });
        Blade::directive('endspaceless', function () {
            return "<?php echo preg_replace('/>\\s+</', '><', ob_get_clean()); ?>";
        });
    }
}
