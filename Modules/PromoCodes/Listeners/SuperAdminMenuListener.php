<?php

namespace Modules\PromoCodes\Listeners;
use App\Events\SuperAdminMenuEvent;

class SuperAdminMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(SuperAdminMenuEvent $event): void
    {
        $module = 'PromoCodes';
        $menu = $event->menu;
        $menu->add([
            'title' => 'PromoCodes',
            'icon' => 'home',
            'name' => 'promocodes',
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
