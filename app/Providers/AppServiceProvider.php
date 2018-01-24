<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager as FractalManager;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory;
use Storage;
use Schema;
use DB;
use Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if ($this->app->environment() !== 'production') {
            DB::listen(function ($query) {
                $sql = str_replace('?', "'%s'", $query->sql);
                foreach ($query->bindings as &$binding) {
                    $binding = (string)$binding;
                }
                $sql = sprintf($sql, ...$query->bindings);
                Log::info('sql', ["$sql\n", $query->time, url()->current()]);
            });
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
