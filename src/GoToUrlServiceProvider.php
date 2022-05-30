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
        $this->app->singleton(Xorth\GoToUrl\GoToUrl::class, function() {
            $request  = request();
            $redirect = redirect();

            return new Xorth\GoToUrl($request, $redirect);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [Xorth\GoToUrl\GoToUrl::class];
    }
}
