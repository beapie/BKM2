<?php

namespace Modules\SMS\Listeners;

use App\Events\CreateAppoinment;
use App\Models\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\SMS\Entities\SendMsg;

class CreateAppoinmentListener
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
    public function handle(CreateAppoinment $event)
    {

        $appointment = $event->appoinment;

        if($event->appoinment->customer_id == null){
            $mobile_no = $appointment->contact;
            $custName = $appointment->name;

        }else {
            $customer = User::find($event->appoinment->customer_id);
            $mobile_no = $customer->mobile_no;
            $custName = $customer->name;
        }

        if (module_is_active('SMS') && company_setting('sms_notification_is' , $appointment->created_by) == 'on'  &&
        !empty(company_setting('SMS Create Appointment')) && company_setting('SMS Create Appointment') == true && !empty($mobile_no)) {

            $uArr = [
                'appointment_name' => $custName,
                'date' => $appointment->date,
                'time' => $appointment->time,
            ];

            $to = $mobile_no ?? Auth::user()->mobile_no;

            SendMsg::SendMsgs($to , $uArr , 'Create Appointment',$appointment->created_by);
        }
    }
}
