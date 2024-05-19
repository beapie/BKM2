<?php

namespace Modules\FlexibleHours\Listeners;

use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\FlexibleHours\Entities\FlexibleHour;
use Modules\PromoCodes\Events\FlexibleHoursCount as EventsFlexibleHoursCount;

class FlexibleHoursCount
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(EventsFlexibleHoursCount $event)
    {
        $service_id = $event->service;
        $service = Service::find($service_id);
        
        // Check if FlexibleHours module is active for this service's business
        if (module_is_active('FlexibleHours', $service->business_id)) {
            $staff_id = $event->staffSelect;
            $appointment_date = $event->selectedDate;
            $duration = explode('-', $event->selectedSloteTime);
            
            // Retrieve staff details
            $staff = Staff::where('user_id', $staff_id)->first();
            if (!$staff) {
                return false;
            }
            
            // Retrieve flexible hours data based on service, staff, and duration
            $flexible_data = FlexibleHour::where('service_id', $service->id)
            ->where('staff_id', $staff->id)
            ->where('start_time', $duration[0])
            ->where('end_time', $duration[1])
            ->get();

            // Convert appointment date to Carbon instance
            $selectedDate = Carbon::createFromFormat('d-m-Y', $appointment_date);
            $dayName = $selectedDate->format('D');

            // Filter flexible hours data based on the selected day
            $filtered_flexible_data = $flexible_data->filter(function ($flexible_hour) use ($dayName) {
                $day_schedule = json_decode($flexible_hour->days, true);
                return isset($day_schedule[$dayName]) && $day_schedule[$dayName] === 'on';
            })->first();

            // Return price if found, otherwise return false
            return $filtered_flexible_data ? $filtered_flexible_data->price : false;
        }

        // If FlexibleHours module is not active, return false
        return false;
    }
}
