<?php

namespace Modules\SMS\Listeners;

use App\Events\CreateUser;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Modules\SMS\Entities\SendMsg;

class CreateUserLisnter
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
    public function handle(CreateUser $event)
    {
        $user = $event->user;
        if (module_is_active('SMS') && company_setting('sms_notification_is' , $event->user->business) == 'on'  &&
        !empty(company_setting('SMS Create User')) && company_setting('SMS Create User') == true && !empty($event->request->mobile_no)) {

            $uArr = [
                'user_name' => $user->name,
            ];

            $to = $event->request->mobile_no ?? Auth::user()->mobile_no;

            SendMsg::SendMsgs($to , $uArr , 'Create User');


        }
    }
}
