<?php

namespace Modules\FlexibleHours\Events;

use Illuminate\Queue\SerializesModels;

class DestroyFlexibleHour
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $flexible_hour;

    public function __construct($flexible_hour)
    {
        $this->flexible_hour = $flexible_hour;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
