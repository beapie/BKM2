<?php

namespace App\Listeners;

use App\Events\CompanyMenuEvent;

class CompanyMenuListener
{
    /**
     * Handle the event.
     */
    public function handle(CompanyMenuEvent $event): void
    {
        $module = 'Base';
        $menu = $event->menu;
        $menu->add([
            'title' => __('Dashboard'),
            'icon' => 'home',
            'name' => 'dashboard',
            'parent' => null,
            'order' => 1,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'dashboard',
            'module' => $module,
            'permission' => ''
        ]);
        $menu->add([
            'title' => __('User Management'),
            'icon' => 'users',
            'name' => 'user-management',
            'parent' => null,
            'order' => 50,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => '',
            'module' => $module,
            'permission' => 'user manage'
        ]);
        $menu->add([
            'title' => __('User'),
            'icon' => '',
            'name' => 'user',
            'parent' => 'user-management',
            'order' => 10,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'users.index',
            'module' => $module,
            'permission' => 'user manage'
        ]);
        $menu->add([
            'title' => __('Role'),
            'icon' => '',
            'name' => 'role',
            'parent' => 'user-management',
            'order' => 20,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'roles.index',
            'module' => $module,
            'permission' => 'roles manage'
        ]);
        $menu->add([
            'title' => __('Business'),
            'icon' => 'credit-card',
            'name' => 'business',
            'parent' => null,
            'order' => 100,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => '',
            'module' => $module,
            'permission' => 'business manage'
        ]);
        $menu->add([
            'title' => __('Create Business'),
            'icon' => '',
            'name' => 'role',
            'parent' => 'business',
            'order' => 10,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => '',
            'module' => $module,
            'permission' => 'business create',
        ]);
        $menu->add([
            'title' => __('Edit Business'),
            'icon' => '',
            'name' => 'role',
            'parent' => 'business',
            'order' => 20,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'manage.business',
            'module' => $module,
            'permission' => 'business update',
        ]);
        $menu->add([
            'title' => __('Businesses'),
            'icon' => '',
            'name' => 'role',
            'parent' => 'business',
            'order' => 30,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'business.index',
            'module' => $module,
            'permission' => 'business manage',
        ]);

        $menu->add([
            'title' => __('Customers'),
            'icon' => 'user',
            'name' => 'customers',
            'parent' => null,
            'order' => 150,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'customer.index',
            'module' => $module,
            'permission' => 'customer manage'
        ]);
        $menu->add([
            'title' => __('Custom Status'),
            'icon' => 'tag',
            'name' => 'custom-status',
            'parent' => null,
            'order' => 170,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'custom-status.index',
            'module' => $module,
            'permission' => 'status manage'
        ]);
        $menu->add([
            'title' => __('Appointments'),
            'icon' => 'credit-card',
            'name' => 'appointments',
            'parent' => null,
            'order' => 200,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'appointment.index',
            'module' => $module,
            'permission' => 'appointment manage'
        ]);
        $menu->add([
            'title' => __('Appointment Calendar'),
            'icon' => 'calendar',
            'name' => 'appointment-calendar',
            'parent' => null,
            'order' => 210,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'appointment.calendar',
            'module' => $module,
            'permission' => 'appointment manage'
        ]);
        $menu->add([
            'title' => __('Contacts'),
            'icon' => 'phone',
            'name' => 'contacts',
            'parent' => null,
            'order' => 270,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'contacts.index',
            'module' => $module,
            'permission' => 'contact manage'
        ]);
        $menu->add([
            'title' => __('Subscribers'),
            'icon' => 'mail',
            'name' => 'subscribers',
            'parent' => null,
            'order' => 280,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'subscribes.index',
            'module' => $module,
            'permission' => 'subscriber manage'
        ]);
        $menu->add([
            'title' => __('Settings'),
            'icon' => 'settings',
            'name' => 'settings',
            'parent' => null,
            'order' => 2000,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => '',
            'module' => $module,
            'permission' => 'setting manage'
        ]);
        $menu->add([
            'title' => __('System Settings'),
            'icon' => '',
            'name' => 'system-settings',
            'parent' => 'settings',
            'order' => 10,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'settings.index',
            'module' => $module,
            'permission' => 'setting manage'
        ]);
        $menu->add([
            'title' => __('Setup Subscription Plan'),
            'icon' => '',
            'name' => 'setup-subscription-plan',
            'parent' => 'settings',
            'order' => 20,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'plans.index',
            'module' => $module,
            'permission' => 'plan manage'
        ]);
        $menu->add([
            'title' => __('Order'),
            'icon' => '',
            'name' => 'order',
            'parent' => 'settings',
            'order' => 30,
            'ignore_if' => [],
            'depend_on' => [],
            'route' => 'plan.order.index',
            'module' => $module,
            'permission' => 'plan orders'
        ]);
    }
}
