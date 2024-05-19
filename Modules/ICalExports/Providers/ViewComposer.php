<?php

namespace Modules\ICalExports\Providers;

use App\Models\Business;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Nwidart\Modules\Module;

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
            $appointment_id = \Request::segment(3);
            $business = Business::where('slug', $slug)->first();
            $user = User::find($business->created_by);
            if (module_is_active('ICalExports',$user->id)) {
                $view->getFactory()->startPush('iCal_exports', view('icalexports::iCal_exports.button', compact('slug', 'appointment_id')));
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
