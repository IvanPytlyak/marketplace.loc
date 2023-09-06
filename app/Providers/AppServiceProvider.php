<?php

namespace App\Providers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\TelegramController;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Schema::defaultStringLength(191);
        $this->app->when(TelegramController::class)->needs('$token')->give('6007033888:AAHd2EEPqBS_LrZCUsMC5W5hX2R9I3SNECQ');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('routeactive', function ($route) { // @routeactive в blade // $route = 'index' / 'categories'
            return "<?php echo Route::currentRouteNamed($route) ? 'class=\"active\"' : '' ?>";
        });
        Blade::if('admin', function () {
            // return Auth::check() && Auth::user()->isAdmin();
            return Auth::check() && Auth::user()->isAdmin;
        });

        Product::observe(ProductObserver::class); // для включения ProductObserver
    }
}
