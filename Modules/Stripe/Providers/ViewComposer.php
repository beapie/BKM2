<?php

namespace Modules\Stripe\Providers;

use App\Models\Business;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class ViewComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['web_layouts.appointment-form', 'form_layout.*.index'], function ($view) {
                $slug = \Request::segment(2);
                if(!$slug)
                {
                    $slug = frontend_bussiness_slug();
                }
                $business = Business::where('slug', $slug)->first();
                $admin_settings = getCompanyAllSetting($business->created_by, $business->id);
                if (module_is_active('Stripe', $business->created_by) && (isset($admin_settings['stripe_is_on']) ? $admin_settings['stripe_is_on'] : 'off') == 'on' && !empty($admin_settings['stripe_key']) && !empty($admin_settings['stripe_secret'])) {
                    $view->getFactory()->startPush('appointment_payment', view('stripe::payment.appointment'));
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
