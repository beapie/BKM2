<?php

namespace Modules\WhatsAppMessenger\Listeners;

use App\Events\CompanySettingMenuEvent;

class CompanySettingMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanySettingMenuEvent $event): void
    {
        $module = 'WhatsAppMessenger';
        $menu = $event->menu;
        $menu->add([
            'title' => 'WhatsApp Messenger Setting',
            'name' => 'whatsappmessenger',
            'order' => 260,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'home',
            'navigation' => 'whatsappmessenger-sidenav',
            'module' => $module,
            'permission' => 'WhatsAppMessenger manage'
        ]);
    }
}
