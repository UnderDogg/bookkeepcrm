<?php

namespace Bookkeeper\Providers;


use Illuminate\Support\ServiceProvider;

class HtmlBuildersServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'reactor.builders.forms',
        ];
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFormsHtmlBuilder();
    }

    /**
     * Registers forms html builder
     */
    protected function registerFormsHtmlBuilder()
    {
        $this->app['reactor.builders.forms'] = $this->app->share(function () {
            return $this->app->make('Bookkeeper\Html\Builders\FormsHtmlBuilder');
        });
    }

}