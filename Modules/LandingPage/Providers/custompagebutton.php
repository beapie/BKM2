<?php
namespace Modules\LandingPage\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Schema;
class custompagebutton extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        view()->composer(['auth.*'], function ($view) {
            if (Schema::hasTable('landing_page_settings')) {
                $settings = \Modules\LandingPage\Entities\LandingPageSetting::settings();
                $view->getFactory()->startPush('authcustombutton', view('landingpage::layouts.buttons', compact('settings')));
            }
        });
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