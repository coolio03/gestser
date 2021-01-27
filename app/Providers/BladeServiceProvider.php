<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('csrf', function () {
            return '<?php echo csrf_field() ; ?>';
            
        });
        Blade::directive('method', function ($method) {
            return '<input type="hidden" name= "_method" value="<?php echo strtoupper('.$method. ');?>" >';
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
