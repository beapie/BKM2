<?php

namespace Modules\Stripe\Providers;

use Illuminate\Support\ServiceProvider;

class PaymentComposer extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */

    public function boot()
    {
        view()->composer(['plans.planpayment', 'plans.marketplace'], function ($view) {
            if (\Auth::check()) {
                $admin_settings = getAdminAllSetting();
                if ((isset($admin_settings['stripe_is_on']) ? $admin_settings['stripe_is_on'] : 'off') == 'on' && !empty($admin_settings['stripe_key']) && !empty($admin_settings['stripe_secret'])) {
                    $view->getFactory()->startPush('company_plan_payment', view('stripe::payment.plan_payment'));
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
