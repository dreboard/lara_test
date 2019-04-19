<?php

namespace App\Providers;

use App\Http\Classes\TestClassOne;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $test1 = resolve(TestClassOne);
        App::bind(/**
         * @return TestClassOne
         */ 'TestClassOne', function($app){
            return new TestClassOne(null,12345);
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('inputBox', function($field){
            return "<?php echo '<span>Hello World</span>'; ?>";
        });

        View::composer('profile', function($view){
            $view->with('team', Auth::user()->groupable);
        });
    }
}
