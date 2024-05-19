<?php

namespace Modules\LandingPage\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'LandingPage';
        $menu = $event->menu;
        $menu->add([
            'title' => 'LandingPage',
            'icon' => 'home',
            'name' => 'landingpage',
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
