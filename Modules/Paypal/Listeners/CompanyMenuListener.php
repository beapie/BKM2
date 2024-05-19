<?php

namespace Modules\Paypal\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'Paypal';
        $menu = $event->menu;
        $menu->add([
            'title' => 'Paypal',
            'icon' => 'home',
            'name' => 'paypal',
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
