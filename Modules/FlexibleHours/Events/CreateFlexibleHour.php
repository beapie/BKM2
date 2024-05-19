<?php

namespace Modules\FlexibleHours\Events;

use Illuminate\Queue\SerializesModels;

class CreateFlexibleHour
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $request;
    public $flexible_hour;

    public function __construct($request, $flexible_hour)
    {
        $this->request = $request;
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
