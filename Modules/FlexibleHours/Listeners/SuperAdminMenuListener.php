<?php

namespace Modules\FlexibleHours\Listeners;
use App\Events\SuperAdminMenuEvent;

class SuperAdminMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(SuperAdminMenuEvent $event): void
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
