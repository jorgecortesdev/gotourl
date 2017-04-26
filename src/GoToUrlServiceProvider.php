<?php

namespace Xorth\GoToUrl;

use Illuminate\Support\ServiceProvider;

class GoToUrlServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('gotourl', function() {
            $session  = $this->app->make('Illuminate\Session\Store');
            $redirect = $this->app->make('Illuminate\Routing\Redirector');

            return new Xorth\GoToUrl($session, $redirect);
        });
    }
}