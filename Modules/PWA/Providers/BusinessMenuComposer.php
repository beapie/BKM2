<?php

namespace Modules\PWA\Providers;

use Illuminate\Support\ServiceProvider;

class BusinessMenuComposer extends ServiceProvider
{
    public function boot()
    {
        view()->composer(['business.manage'], function ($view) {
            if (\Auth::check()) {
                if (module_is_active('PWA', $view->business->created_by)) {
                    $view->getFactory()->startPush('PWA_menu', view('pwa::business.menu'));
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
