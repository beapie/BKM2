<?php

namespace Modules\SMS\Listeners;

use App\Events\AppointmentStatus as EventsAppointmentStatus;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\SMS\Entities\SendMsg;

class AppointmentStatus
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
    public function handle(EventsAppointmentStatus $event)
    {
        $customer = User::find($event->appoinment->customer_id);
        if (module_is_active('SMS') && company_setting('sms_notification_is' , $customer->id) == 'on'  &&
        !empty(company_setting('SMS Appointment Status Change')) && company_setting('SMS Appointment Status Change') == true && !empty($customer->mobile_no)) {

            $uArr = [
                'user_name' => $customer->name,
            ];

            $to = $customer->mobile_no ?? Auth::user()->mobile_no;

            SendMsg::SendMsgs($to , $uArr , 'Appointment Status Change');
        }
    }
}
