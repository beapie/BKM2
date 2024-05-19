<?php

namespace Modules\PWA\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessMenuTabComposer extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['business.manage'], function ($view) {
            if (\Auth::check()) {
                if (module_is_active('PWA')) {
                    $business = $view->business;
                    $pwa_data = $view->pwa_data;
                    $view->getFactory()->startPush('PWA_menu_tab', view('pwa::business.tab_part', compact('pwa_data', 'business')));
                }
            }
        });
    }

    public function register()
    {
        //
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
