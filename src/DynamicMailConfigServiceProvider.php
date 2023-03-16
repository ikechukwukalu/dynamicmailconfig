<?php

namespace Ikechukwukalu\Dynamicmailconfig;

use Ikechukwukalu\Dynamicmailconfig\Middleware\DynamicMailConfig;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class DynamicMailConfigServiceProvider extends ServiceProvider
{
    public const DB = __DIR__.'/migrations';
    public const CONFIG = __DIR__.'/config/dynamicmailconfig.php';

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('dynamic.mail.config', DynamicMailConfig::class);

       $this->loadMigrationsFrom(self::DB);

        $this->publishes([
            self::CONFIG => config_path('dynamicmailconfig.php'),
        ], 'rp-config');

        $this->publishes([
            self::DB => database_path('migrations'),
        ], 'rp-migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG, 'dynamicmailconfig'
        );
    }
}
