<?php

namespace Kemetech\Cart;

use Illuminate\Support\ServiceProvider;
use Kemetech\Cart\Services\Cart;
use Kemetech\Cart\Services\Database;
use Kemetech\Cart\Services\Session;

class ShoppingCartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        
        if ($this->getStorageService() == 'session')
         {
             $this->app->singleton('cart', function($app) {
                 return new Session($app['session'], $app['events']);
             });
         } else
         {
             $this->app->singleton('cart', function($app) {
                 return new Database();
             });
         }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/config/cart.php' =>  config_path('cart.php'),
         ], 'config');

     
    }

    /**
     *  Get the storage settings based on config file
     *
     * @return string
     */
    public function getStorageService()
    {
        $class = $this->app['config']->get('cart.storage','session');

        switch ($class)
        {
            case 'session':
                return 'session';
            break;
            case 'database':
                return 'database';
            break;
            default:
                return 'session';
            break;
        }
    }

}
