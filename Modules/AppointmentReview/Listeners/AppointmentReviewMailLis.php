<?php

namespace Modules\AppointmentReview\Listeners;

use App\Events\AppointmentStatus;
use App\Models\Business;
use App\Models\CustomStatus;
use App\Models\EmailTemplate;

class AppointmentReviewMailLis
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
    public function handle(AppointmentStatus $event)
    {
        $status = CustomStatus::findOrFail($event->request->status);
        $statusTitle = $status->title;
        $company_settings = getCompanyAllSetting();
        if($company_settings['review_status'] == $statusTitle){
            $business = Business::where('id', getActiveBusiness())->first();
            if ((!empty($company_settings['Appointment Review']) && $company_settings['Appointment Review']  == true)) {
                $uArr = [
                    'business_name'  => $event->appoinment->business_id,
                    'staff_name' => $event->appoinment->StaffData->name,
                    'company_name' => $event->request->input('name'),
                    'review_url' => '<a href="' . route('appointment.review', ['slug' => $business->slug, 'appointment' => $event->appoinment->id]) . '">Review Link</a>',
                ];
                $resp = EmailTemplate::sendEmailTemplate('Appointment Review', [$event->appoinment->CustomerData ? $event->appoinment->CustomerData->customer->email : $event->appoinment->email], $uArr);
            }
        }
    }
}