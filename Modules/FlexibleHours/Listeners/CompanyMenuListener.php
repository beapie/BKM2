<?php

namespace Modules\FlexibleHours\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'FlexibleHours';
        $menu = $event->menu;
        $menu->add([
            'title' => 'FlexibleHours',
            'icon' => 'home',
            'name' => 'flexiblehours',
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
