<?php

namespace Modules\AppointmentReview\Listeners;

use App\Events\CompanySettingMenuEvent;

class CompanySettingMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanySettingMenuEvent $event): void
    {
        $module = 'AppointmentReview';
        $menu = $event->menu;
        $menu->add([
            'title' => __('Appointment Review'),
            'name' => 'appointmentreview',
            'order' => 400,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'home',
            'navigation' => 'appointment_review_sidenav',
            'module' => $module,
            'permission' => 'appointmentreview manage'
        ]);

        $menu->add([
            'title' => __('Appointment Review Status'),
            'name' => 'appointmentreview',
            'order' => 405,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => '',
            'navigation' => 'review_status_sidenav',
            'module' => $module,
            'permission' => 'appointmentreview manage'
        ]);
    }
}
