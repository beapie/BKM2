<?php

namespace Modules\AppointmentReview\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'AppointmentReview';
        $menu = $event->menu;
        $menu->add([
            'title' => 'AppointmentReview',
            'icon' => 'home',
            'name' => 'appointmentreview',
            'parent' => null,
            'order' => 2,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'home',
            'module' => $module,
            'permission' => 'manage-dashboard'
        ]);
    }
}
