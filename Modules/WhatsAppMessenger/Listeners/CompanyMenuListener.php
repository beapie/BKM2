<?php

namespace Modules\WhatsAppMessenger\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'WhatsAppMessenger';
        $menu = $event->menu;
        $menu->add([
            'title' => 'WhatsAppMessenger',
            'icon' => 'home',
            'name' => 'whatsappmessenger',
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
