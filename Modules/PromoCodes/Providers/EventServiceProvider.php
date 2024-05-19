<?php

namespace Modules\PromoCodes\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as Provider;
use App\Events\AppointmentPaymentData;
use Modules\PromoCodes\Listeners\StoreAppointmentPaymentData;

class EventServiceProvider extends Provider
{
    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    protected $listen = [
        AppointmentPaymentData::class => [
            StoreAppointmentPaymentData::class
        ],
    ];

    public function shouldDiscoverEvents()
    {
        return true;
    }

    /**
     * Get the listener directories that should be used to discover events.
     *
     * @return array
     */
    protected function discoverEventsWithin()
    {
        return [
            __DIR__ . '/../Listeners',
        ];
    }
}
