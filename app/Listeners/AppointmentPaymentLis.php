<?php

namespace App\Listeners;

use App\Models\Service;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Business;
use App\Models\Appointment;
use App\Models\User;
use App\Models\AppointmentPayment;
use App\Models\Customer;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Events\CreateAppoinment;
use App\Models\EmailTemplate;
use App\Events\AppointmentPaymentData;

class AppointmentPaymentLis
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event)
    {
        $data = $event->data;
        $attachment = $data['attachment'] ?? null;
        $slug = $event->payment;
        $business = Business::where('slug', $slug)->first();
        $url = null;
        if ($attachment && $attachment->hasFile('attachment')) {
            $filenameWithExt = $attachment->file('attachment')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $attachment->file('attachment')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;

            $upload = upload_file($attachment, 'attachment', $fileNameToStore, 'Appointment');
            if ($upload['flag'] == 1) {
                $url = $upload['url'];
            } else {
                return response()->json(['msg' => 'error', 'error' => $upload['msg']]);
            }
        }
        
        if ($data['type'] == 'new-user') {
            $roles = Role::where('name', 'customer')->where('created_by', $business->created_by)->first();
            if ($roles) {
                $user = User::create(
                    [
                        'name' => !empty($data['name']) ? $data['name'] : null,
                        'email' => !empty($data['email']) ? $data['email'] : null,
                        'mobile_no' => !empty($data['contact']) ? $data['contact'] : null,
                        'email_verified_at' => date('Y-m-d h:i:s'),
                        'password' => !empty($data['password']) ? Hash::make($data['password']) : null,
                        'avatar' => 'uploads/users-avatar/avatar.png',
                        'type' => 'customer',
                        'lang' => 'en',
                        'business_id' => $business->id,
                        'created_by' => $business->created_by,
                        ]
                    );
                    $user->addRole($roles);
                    
                $customer                      = new Customer();
                $customer->name                = $data['name'];
                $customer->user_id             = $user->id;
                $customer->gender              = !empty($data['gender']) ? $data['gender'] : '';
                $customer->dob                 = !empty($data['dob']) ? $data['dob'] : '';
                $customer->description         = !empty($data['description']) ? $data['description'] : '';
                $customer->business_id         = $user->business_id;
                $customer->created_by          = $user->created_by;
                $customer->save();

            }
        }

        if ($data['type'] == 'existing-user') {
            $email = $data['email'];
            $user = User::where('email', $email)->where('type', 'customer')->first();
            if (!empty($data['password']) && !empty($user)) {
                $check_password = Hash::check($data['password'], $user->password);
                if ($check_password) {
                    $customer = Customer::where('user_id', $user->id)->first();
                } else {
                    return response()->json(['msg' => 'error', 'error' => 'Enter correct password']);
                }
            } else {
                return response()->json(['msg' => 'error', 'error' => 'Please enter valid email']);
            }
        }
       
        $Appointment                   = new Appointment();
        if ($data['type'] == 'new-user' || $data['type'] == 'existing-user') {
            $Appointment->customer_id      = !empty($customer) ? $customer->user_id : null;
        } else {
            $Appointment->customer_id      = !empty($data['customer']) ? $data['customer'] : null;
        }
        $Appointment->location_id      = $data['location'];
        $Appointment->service_id       = $data['service'];
        $Appointment->staff_id         = $data['staff'];
        
        if ($data['type'] == 'guest-user') {
            $Appointment->name         = $data['name'];
            $Appointment->email         = $data['email'];
            $Appointment->contact         = $data['contact'];
        }

        $Appointment->date             = !empty($data['appointment_date']) ? $data['appointment_date'] : '';
        $Appointment->time             = !empty($data['duration']) ? $data['duration'] : '';
        $Appointment->notes            = !empty($data['notes']) ? $data['notes'] : '';
        $Appointment->payment_type      = !empty($data['payment_type']) ? $data['payment_type'] : 'Manually';
        $Appointment->appointment_status  = !empty($data['appointment_status']) ? $data['appointment_status'] : 'Pending';
        $Appointment->attachment           = !empty($data['attachment']) ? $url : null;
        $Appointment->custom_field          = !empty($data['values']) ? json_encode($data['values']) : null;
        $Appointment->business_id      = $business->id;
        $Appointment->created_by       = $business->created_by;
        $Appointment->save();
        
        $service = Service::find($data['service']);

        $payment = AppointmentPayment::create([
            'appointment_id' => $Appointment->id,
            'payment_type' => $Appointment->payment_type,
            'amount' => $data['service_price'],
            'payment_date' => now(),
            'business_id' => $business->id,
            'created_by' => $business->created_by,
        ]);
        
        event(new AppointmentPaymentData($data, $payment, $service));

        $appointment_number = Appointment::appointmentNumberFormat($Appointment->id, $business->created_by, $business->id);

        $company_settings = getCompanyAllSetting($Appointment->created_by, $Appointment->business_id);
        $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
        $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;
        //Email notification
        if ((!empty($company_settings['Create Appointment']) && $company_settings['Create Appointment']  == true)) {
            $uArr = [
                'business_name' => $business->name,
                'service' => $Appointment->ServiceData ? $Appointment->ServiceData->name : '-',
                'location' => $Appointment->LocationData ? $Appointment->LocationData->name : '-',
                'staff' => $Appointment->StaffData->user ? $Appointment->StaffData->user->name : '-',
                'appointment_date' => $Appointment->date,
                'appointment_time' => $Appointment->time,
                'appointment_number' => $appointment_number,
            ];
            $resp = EmailTemplate::sendEmailTemplate('Create Appointment', [$Appointment->CustomerData ? $Appointment->CustomerData->customer->email : $Appointment->email], $uArr, $Appointment->created_by);
        }
        event(new CreateAppoinment($Appointment, $data));

        return $Appointment->id;
    }
}
