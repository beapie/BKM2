<?php

namespace Modules\AppointmentReview\Http\Controllers;

use App\Models\Appointment;
use App\Models\Business;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use App\Models\Staff;
use Modules\AppointmentReview\Entities\AppointmentReview;

class AppointmentReviewController extends Controller
{
    public function setting(Request $request)
    {
        if ($request->has('appointment_review_is_on')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'appointment_review_is_on' => 'required',
                ]
            );
            if ($validator->fails()) {
                $messages = $validator->getMessageBag();
                return redirect()->back()->with('error', $messages->first());
            }
            $appointment_review = [];
            $appointment_review['appointment_review_is_on'] =  $request->appointment_review_is_on;

            foreach ($appointment_review as $key => $value) {

                $data = [
                    'key' => $key,
                    'business' => getActiveBusiness(),
                    'created_by' => creatorId(),
                ];


                Setting::updateOrInsert($data, ['value' => $value]);
            }
        } else {

            $data = [
                'key' => 'appointment_review_is_on',
                'business' => getActiveBusiness(),
                'created_by' => creatorId(),
            ];


            Setting::updateOrInsert($data, ['value' => 'off']);
        }

        AdminSettingCacheForget();
        comapnySettingCacheForget();
        return redirect()->back()->with('success', __('Appointment Review Setting saved successfully'));
    }

    public function appointmentReview(Request $request, $slug = null, $id = null)
    {
        $slug = $request->slug;
        $business = Business::where('slug', $slug)->first();
        $Appointments = Appointment::find($id);
        if ($Appointments) {
            $appointment_id = $Appointments->id;
            $business_id = $Appointments->business_id;
            $staff_id = $Appointments->staff_id;
            $appointmentReviews = AppointmentReview::where('business_id', $business->id)->get();
            $staffReviews = Staff::where('business_id', $business->id)->get();
            $staff = Staff::where('id', $staff_id)->where('created_by', $Appointments->created_by)->first();
            $customers = Customer::where('id', $Appointments->customer_id)->where('created_by',$Appointments->created_by)->first();
        
            return view('appointmentreview::review.appointment_review', compact('slug', 'id', 'appointment_id', 'business_id', 'staff_id', 'business', 'appointmentReviews', 'Appointments', 'staff','customers'));
        }else{
            return redirect()->back()->with('error', __('Appointment Not Found'));
        }
    }

    public function reviewStore(Request $request, $id)
    {
        $Appointments = Appointment::find($id);
        $validator = Validator::make(
            $request->all(),
            [
                'review' => 'required',
                'description' => 'required',
            ]
        );
        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }
        if ($Appointments) {
            $review = new AppointmentReview();
            $review->appointment_id = $id;
            $review->business_id = $Appointments->business_id;
            $review->staff_id = $Appointments->staff_id;
            $review->review = $request->input('review') ?? '';
            $review->description = $request->description ?? '';
            $review->created_by = $Appointments->created_by;
            $review->save();

            $staff = Staff::find($review->staff_id);
            if ($staff) {
                $staff->review = $review->review;
                $staff->save();
            }

            return redirect()->back()->with('success', __('Appointment Review saved successfully'));
        } else {
            return redirect()->back()->with('error', __('Appointment Not Found'));
        }
    }

    public function reviewStatusSetting(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'review_status' => 'required',
            ]
        );

        if ($validator->fails()) {
            $messages = $validator->getMessageBag();
            return redirect()->back()->with('error', $messages->first());
        }

        $status = [];
        $status['review_status'] =  $request->review_status;
        foreach ($status as $key => $value) {

            $data = [
                'key' => $key,
                'business' => getActiveBusiness(),
                'created_by' => creatorId(),
            ];


            Setting::updateOrInsert($data, ['value' => $value]);
        }

        AdminSettingCacheForget();
        comapnySettingCacheForget();
        return redirect()->back()->with('success', __('Appointment Review Status saved successfully'));
    }
}
