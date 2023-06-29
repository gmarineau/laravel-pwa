<?php

namespace GMarineau\LaravelPwa;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaravelPwaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerConfig();
        $this->registerIcons();
        $this->registerViews();
        $this->registerServiceWorker();
        $this->registerDirective();
        $this->registerCommands();

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('laravelpwa.php'),
        ], 'config');

        $this->mergeConfigFrom(
            __DIR__ . '/../config/config.php',
            'laravelpwa'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/vendor/laravelpwa');

        $sourcePath = __DIR__ . '/../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ], 'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/vendor/laravelpwa';
        }, \Config::get('view.paths')), [$sourcePath]), 'laravelpwa');
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerIcons()
    {
        $iconsPath = public_path('images/icons');

        $sourcePath = __DIR__ . '/../assets/images/icons';

        $this->publishes([
            $sourcePath => $iconsPath
        ], 'icons');
    }

    /**
     * Register serviceworker.js.
     *
     * @return void
     */
    protected function registerServiceWorker()
    {
        $publicPath = public_path();

        $sourcePath = __DIR__ . '/../assets/js';

        $this->publishes([
            $sourcePath => $publicPath
        ], 'serviceworker');
    }

    /**
     * Register directive.
     *
     * @return void
     */
    public function registerDirective()
    {
        Blade::directive('laravelPWA', function () {
            return (new \GMarineau\LaravelPwa\Services\MetaService())->render();
        });
    }

    /**
     * Register the available commands
     *
     * @return void
     */
    public function registerCommands()
    {
        $this->commands([
            \GMarineau\LaravelPwa\Console\Commands\DeployManifest::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
