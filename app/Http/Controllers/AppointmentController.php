<?php

namespace App\Http\Controllers;

use App\Events\CreateAppoinment;
use App\Models\Appointment;
use App\Models\AppointmentPayment;
use App\Models\Location;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Customer;
use App\Models\BusinessHours;
use App\Models\Business;
use App\Models\BusinessHoliday;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use App\Models\File;
use App\Models\CustomField;
use App\Models\EmailTemplate;
use App\Models\CustomStatus;
use App\Models\ThemeSetting;
use App\Models\Testimonial;
use App\Models\Blog;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\TrackingPixel\Entities\PixelFields;
use App\Events\AppointmentStatus;
use Modules\FlexibleHours\Entities\FlexibleHour;
use App\Events\AppointmentPaymentData;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->business) {
            $business_id = $request->business;
        } else {
            $business_id = getActiveBusiness();
        }
        $business = Business::find($business_id);

        $Appointments = Appointment::where('created_by', $business->created_by)->where('business_id', $business_id);

        $service = Service::where('created_by', $business->created_by)->where('business_id', $business_id)->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select Service'])->pluck('name', 'id');

        if ($request->date) {
            $date = date('d-m-Y', strtotime($request->date));
            $Appointments = $Appointments->where('date', $date);
        }

        if ($request->service) {
            $Appointments = $Appointments->where('service_id', $request->service);
        }

        if (Auth::user()->isAbleTo('appointment manage')) {

            $Appointments = $Appointments->get();
            $files = File::where('business_id', getActiveBusiness())->where('created_by', creatorId())->first();
            return view('appointment.index', ['Appointments' => $Appointments, 'date' => $request->date, 'service' => $service, 'type' => $request->service, 'files' => $files]);
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Auth::user()->isAbleTo('appointment create')) {
            $location = Location::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select Location'])->pluck('name', 'id');

            $service = Service::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select Service'])->pluck('name', 'id');

            $customer = Customer::where('created_by', creatorId())->where('business_id', getActiveBusiness())->get()->pluck('name', 'user_id')->prepend('select customer');


            $staff = Staff::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'user_id')->get()->prepend(['user_id' => null, 'name' => 'Select Staff'])->pluck('name', 'user_id');

            $customer = Customer::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'user_id')->get()->prepend(['user_id' => null, 'name' => 'Select Customer'])->pluck('name', 'user_id');


            $busineshours = BusinessHours::where('created_by', creatorId())
                ->where('business_id', getActiveBusiness())
                ->where('day_off', 'on')
                ->select('day_name')
                ->get()
                ->pluck('day_name')
                ->map(function ($day) {
                    return date('w', strtotime($day));
                })
                ->toArray();

            $businesholiday = BusinessHoliday::where('created_by', creatorId())
                ->where('business_id', getActiveBusiness())
                ->pluck('date')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('d-m-Y');
                })
                ->toArray();
            // $combinedArray = array_merge($busineshours, $businesholiday);
            $combinedArray = $busineshours;


            return view('appointment.create', compact('location', 'service', 'staff', 'customer', 'busineshours', 'busineshours', 'businesholiday', 'combinedArray'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAbleTo('appointment create')) {
            $validator = \Validator::make(
                $request->all(),
                [
                    'customer' => 'required',
                    'location' => 'required',
                    'service' => 'required',
                    'staff' => 'required',
                    'appointment_date' => 'required',
                    'duration' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }
            $service = Service::find($request->service);

            $appointment                   = new Appointment();
            $appointment->customer_id      = $request->customer;
            $appointment->location_id      = $request->location;
            $appointment->service_id       = $request->service;
            $appointment->staff_id         = $request->staff;
            $appointment->date             = !empty($request->appointment_date) ? $request->appointment_date : '';
            $appointment->time             = !empty($request->duration) ? $request->duration : '';
            $appointment->notes            = !empty($request->notes) ? $request->notes : '';
            $appointment->appointment_status   = !empty($request->appointment_status) ? $request->appointment_status : 'Pending';
            $appointment->payment_type   = !empty($request->payment_type) ? $request->payment_type : 'Manually';
            $appointment->business_id      = getActiveBusiness();
            $appointment->created_by       = creatorId();
            $appointment->save();

            $payment = AppointmentPayment::create([
                'appointment_id' => $appointment->id,
                'payment_type' => $appointment->payment_type,
                'amount' => $service->price,
                'payment_date' => now(),
                'business_id' => $appointment->business_id,
                'created_by' => $appointment->created_by,
            ]);


            $appointment_number = Appointment::appointmentNumberFormat($appointment->id, $appointment->created_by, $appointment->business_id);
            //Email notification
            $company_settings = getCompanyAllSetting();

            if ((!empty($company_settings['Create Appointment']) && $company_settings['Create Appointment']  == true)) {
                $uArr = [
                    'company_name' => $request->input('name'),
                    'service' => $appointment->ServiceData ? $appointment->ServiceData->name : '-',
                    'location' => $appointment->LocationData ? $appointment->LocationData->name : '-',
                    'staff' => $appointment->StaffData->user ? $appointment->StaffData->user->name : '-',
                    'appointment_date' => $request->input('appointment_date'),
                    'appointment_time' => $request->input('duration'),
                    'appointment_number' => $appointment_number,
                ];

                $resp = EmailTemplate::sendEmailTemplate('Create Appointment', [$appointment->CustomerData->customer->email], $uArr);

                return redirect()->route('appointment.index')->with('success', __('Appointment successfully created.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            }
            event(new CreateAppoinment($appointment, $request));


            return redirect()->back()->with('success', __('Appointment successfully created.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $appointment = Appointment::with('payment')->where('id',$id)->first();
        
        return view('appointment.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if (Auth::user()->isAbleTo('appointment edit')) {
            $location = Location::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select Location'])->pluck('name', 'id');

            $service = Service::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'id')->get()->prepend(['id' => null, 'name' => 'Select Service'])->pluck('name', 'id');

            $customer = Customer::where('created_by', creatorId())->where('business_id', getActiveBusiness())->get()->pluck('name', 'user_id')->prepend('select customer');


            $staff = Staff::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'user_id')->get()->prepend(['user_id' => null, 'name' => 'Select Staff'])->pluck('name', 'user_id');

            $customer = Customer::where('created_by', creatorId())->where('business_id', getActiveBusiness())->select('name', 'user_id')->get()->prepend(['user_id' => null, 'name' => 'Select Customer'])->pluck('name', 'user_id');


            $busineshours = BusinessHours::where('created_by', creatorId())
                ->where('business_id', getActiveBusiness())
                ->where('day_off', 'on')
                ->select('day_name')
                ->get()
                ->pluck('day_name')
                ->map(function ($day) {
                    return date('w', strtotime($day));
                })
                ->toArray();

            $businesholiday = BusinessHoliday::where('created_by', creatorId())
                ->where('business_id', getActiveBusiness())
                ->pluck('date')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('d-m-Y');
                })
                ->toArray();
            // $combinedArray = array_merge($busineshours, $businesholiday);
            $combinedArray = $busineshours;

            $timeSlots = timeSlot($appointment->service_id, $appointment->date);

            return view('appointment.edit', compact('location', 'service', 'staff', 'customer', 'busineshours', 'busineshours', 'appointment', 'timeSlots', 'combinedArray', 'businesholiday'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        if (Auth::user()->isAbleTo('appointment edit')) {

            $validator = \Validator::make(
                $request->all(),
                [
                    'customer' => 'required',
                    'location' => 'required',
                    'service' => 'required',
                    'staff' => 'required',
                    'appointment_date' => 'required',
                    'duration' => 'required',
                ]
            );

            if ($validator->fails()) {
                $messages = $validator->getMessageBag();

                return redirect()->back()->with('error', $messages->first());
            }

            $service = Service::find($request->service);

            $appointment->customer_id      = $request->customer;
            $appointment->location_id      = $request->location;
            $appointment->service_id       = $request->service;
            $appointment->staff_id         = $request->staff;
            $appointment->date             = !empty($request->appointment_date) ? $request->appointment_date : '';
            $appointment->time             = !empty($request->duration) ? $request->duration : '';
            $appointment->notes            = !empty($request->notes) ? $request->notes : '';
            $appointment->save();

            $AppointmentPayment = AppointmentPayment::where('appointment_id',$appointment->id)->first();
            $AppointmentPayment->amount = $service->price;
            $AppointmentPayment->save();

            return redirect()->back()->with('success', __('Appointment updated successfully!'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        if (Auth::user()->isAbleTo('appointment delete')) {
            $appointment->delete();
            return redirect()->back()->with('error', __('Appointment successfully delete.'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function appointmentDuration(Request $request)
    {
        $serive = Service::find($request->service);
        $flexible_data = null;
        if (!empty($request->service) && !empty($request->date)) {
            if(module_is_active('FlexibleHours',$serive->created_by))
            {
                $flexible_data = FlexibleHour::where('staff_id',$request->staff)->orwhere('service_id',$request->service)->get();
            }
            return response()->json(['timeSlots' => timeSlot($request->service, $request->date,$flexible_data), 'result' => 'success']);
        } else {
            return response()->json(['result' => 'error']);
        }
    }

    public function appointmentForm(Request $request,  $slug = null, $appointment = null)
    {

        $slug = $request->slug;

        // $uri = url()->full();
        // if($uri == env('APP_URL'))
        // {
        //     return redirect('login');
        // }
        // else
        // {
        //     $segments = explode('/', str_replace('' . url('') . '', '', $uri));
        //     $segments = $segments[1] ?? null;

        //     if ($segments == null) {
        //         $local = parse_url(config('app.url'))['host'];
        //         // Get the request host
        //         $remote = request()->getHost();
        //         // Get the remote domain

        //         // remove WWW
        //         $remote = str_replace('www.', '', $remote);
        //         $domain = Setting::where('key', '=', 'domains')->where('value', '=', $remote)->first();
        //         if($domain)
        //         {
        //             $enable_domain = Setting::where('key', '=', 'enable_domain')->where('value','on')->where('business',$domain->business)->first();
        //             if($enable_domain)
        //             {
        //                 $business = Business::find($enable_domain->business);
        //             }
        //         }
        //         $sub_domain = Setting::where('key', '=', 'subdomain')->where('value', '=', $remote)->first();
        //         if($sub_domain)
        //         {
        //             $enable_subdomain = Setting::where('key', '=', 'enable_subdomain')->where('value','on')->where('business',$sub_domain->business)->first();
        //             if($enable_subdomain)
        //             {
        //                 $business = Business::find($enable_subdomain->business);
        //             }
        //         }
        //         if($business)
        //         {
        //             $slug = $business->slug;
        //             $services = Service::where('business_id',$business->id)->get();
        //             $locations = Location::where('business_id',$business->id)->get();
        //             $staffs = Staff::where('business_id',$business->id)->get();

        //             $busineshours = BusinessHours::where('created_by', $business->created_by)
        //                             ->where('business_id', $business->id)
        //                             ->where('day_off', 'on')
        //                             ->select('day_name')
        //                             ->get()
        //                             ->pluck('day_name')
        //                             ->map(function ($day) {
        //                                 return date('w', strtotime($day));
        //                             })
        //                             ->toArray();

        //             $businesholiday = BusinessHoliday::where('created_by', $business->created_by)
        //                             ->where('business_id', $business->id)
        //                             ->select('date')
        //                             ->get()
        //                             ->pluck('date')
        //                             ->map(function ($date) {
        //                                 return date('w', strtotime($date));
        //                             })
        //                             ->toArray();
        //             $combinedArray = array_merge($busineshours, $businesholiday);

        //             $company_settings = getCompanyAllSetting($business->created_by,$business->id);
        //             $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
        //             $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;

        //             return view('embeded_appointment.index',compact('slug','business','services','locations','staffs','customCss','customJs','combinedArray'));
        //         }
        //     }
        // }

        $business = Business::where('slug', $slug)->first();
        if ($business) {
            $services = Service::where('business_id', $business->id)->get();
            $locations = Location::where('business_id', $business->id)->get();
            $staffs = Staff::where('business_id', $business->id)->get();

            $busineshours = BusinessHours::where('created_by', $business->created_by)
                ->where('business_id', $business->id)
                ->where('day_off', 'on')
                ->select('day_name')
                ->get()
                ->pluck('day_name')
                ->map(function ($day) {
                    return date('w', strtotime($day));
                })
                ->toArray();

            $businesholiday = BusinessHoliday::where('created_by', $business->created_by)
                ->where('business_id', $business->id)
                ->pluck('date')
                ->map(function ($date) {
                    return Carbon::parse($date)->format('d-m-Y');
                })
                ->toArray();
            // $combinedArray = array_merge($busineshours, $businesholiday);
            $combinedArray = $busineshours;

            $files = File::where('business_id', $business->id)->where('created_by', $business->created_by)->first();

            $company_settings = getCompanyAllSetting($business->created_by, $business->id);
            $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
            $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;

            $custom_field = company_setting('custom_field_enable', $business->created_by, $business->id);

            $custom_fields = CustomField::where('created_by', $business->created_by)->where('business_id', $business->id)->get();

            $workingDays = BusinessHours::where('created_by', $business->created_by)
                            ->where('business_id', $business->id)
                            ->get();

            $pixelScript = [];
            if(module_is_active('TrackingPixel', $business->created_by)){
                $pixels = PixelFields::where('created_by',$business->created_by)->where('business_id',$business->id)->get();
                foreach ($pixels as $pixel) {
                    $pixelScript[] = pixelSourceCode($pixel['platform'], $pixel['pixel_id']);
                }
            }

            $number =  Appointment::appointmentNumberFormat($appointment, $business->id);
            if ($appointment != 'failed' && $appointment != null && (strpos($number, '#APP') === 0)) {
                $appointment_number = $number;
            } elseif ($appointment == 'failed') {
                $appointment_number = 'failed';
            } else {
                $appointment_number = '';
            }

            if ($business->form_type == 'form-layout') {
                return view('form_layout.' . $business->layouts . '.index', compact('slug', 'business', 'services', 'locations', 'staffs', 'customCss', 'customJs', 'combinedArray', 'files', 'custom_field', 'custom_fields', 'businesholiday', 'appointment_number','pixelScript'));
            } else {
                $module = $business->layouts;
                if (module_is_active($business->layouts, $business->created_by)) {
                    $themeSetting = ThemeSetting::where('theme', $module)->where('business_id', $business->id)->pluck('value', 'key');
                    $testimonials = Testimonial::where('business_id', $business->id)->where('theme', $module)->get();
                    $blogs = Blog::where('business_id', $business->id)->where('theme', $module)->get();

                    return view(strtolower($business->layouts) . '::form_layout.index', compact('slug', 'business', 'services', 'locations', 'staffs', 'customCss', 'customJs', 'combinedArray', 'files', 'custom_field', 'custom_fields', 'module', 'themeSetting', 'workingDays', 'testimonials', 'blogs', 'businesholiday', 'appointment_number','pixelScript'));
                } else {
                    return view('web_layouts.module_not_found', compact('module'));
                    //    return redirect()->back()->with('error', __('please activate this module '.$business->layouts));
                }
            }
        }

        // return view('embeded_appointment.index',compact('slug','business','services','locations','staffs','customCss','customJs','combinedArray','files','custom_field','custom_fields'));
    }



    public function appointmentFormSubmit(Request $request)
    {
        if (!empty($request->service) && !empty($request->appointment_date) && !empty($request->email) && !empty($request->business_id) && !empty($request->payment)) {

            $business = Business::find($request->business_id);
            $service = Service::find($request->service);

            
            if ($request->hasFile('attachment')) {
                $filenameWithExt = $request->file('attachment')->getClientOriginalName();
                $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension       = $request->file('attachment')->getClientOriginalExtension();
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;

                $uplaod = upload_file($request, 'attachment', $fileNameToStore, 'Appointment');
                if ($uplaod['flag'] == 1) {
                    $url = $uplaod['url'];
                } else {
                    return response()->json(['msg' => 'error', 'error' => $uplaod['msg']]);
                }
            }

            if ($request->type == 'new-user') {
                $roles = Role::where('name', 'customer')->where('created_by', $business->created_by)->first();
                if ($roles) {
                    $user = User::create(
                        [
                            'name' => !empty($request->name) ? $request->name : null,
                            'email' => !empty($request->email) ? $request->email : null,
                            'mobile_no' => !empty($request->contact) ? $request->contact : null,
                            'email_verified_at' => date('Y-m-d h:i:s'),
                            'password' => !empty($request->password) ? Hash::make($request->password) : null,
                            'avatar' => 'uploads/users-avatar/avatar.png',
                            'type' => 'customer',
                            'lang' => 'en',
                            'business_id' => $business->id,
                            'created_by' => $business->created_by,
                        ]
                    );
                    $user->addRole($roles);

                    $customer                      = new Customer();
                    $customer->name                = $request->name;
                    $customer->user_id             = $user->id;
                    $customer->gender              = !empty($request->gender) ? $request->gender : '';
                    $customer->dob                 = !empty($request->dob) ? $request->dob : '';
                    $customer->description         = !empty($request->description) ? $request->description : '';
                    $customer->business_id         = $user->business_id;
                    $customer->created_by          = $user->created_by;
                    $customer->save();
                }
            }

            if ($request->type == 'existing-user') {
                $email = $request->email;
                $user = User::where('email', $email)->where('type', 'customer')->first();
                if (!empty($request->password) && !empty($user)) {
                    $check_password = Hash::check($request->password, $user->password);
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
            if ($request->type == 'new-user' || $request->type == 'existing-user') {
                $Appointment->customer_id      = !empty($customer) ? $customer->user_id : null;
            } else {
                $Appointment->customer_id      = !empty($request->customer) ? $request->customer : null;
            }
            $Appointment->location_id      = $request->location;
            $Appointment->service_id       = $request->service;
            $Appointment->staff_id         = $request->staff;

            if ($request->type == 'guest-user') {
                $Appointment->name         = $request->name;
                $Appointment->email         = $request->email;
                $Appointment->contact         = $request->contact;
            }

            $Appointment->date             = !empty($request->appointment_date) ? $request->appointment_date : '';
            $Appointment->time             = !empty($request->duration) ? $request->duration : '';
            $Appointment->notes            = !empty($request->notes) ? $request->notes : '';
            $Appointment->payment_type      = !empty($request->payment) ? $request->payment : 'Manually';
            $Appointment->appointment_status  = !empty($request->appointment_status) ? $request->appointment_status : 'Pending';
            $Appointment->attachment           = !empty($request->attachment) ? $url : null;
            $Appointment->custom_field           = !empty($request->values) ? json_encode($request->values) : null;
            $Appointment->business_id      = $business->id;
            $Appointment->created_by       = $business->created_by;
            $Appointment->save();
            
            if(module_is_active('FlexibleHours',$business->created_by) && isset($request->flexible_id))
            {
                $flexible_hour = FlexibleHour::find($request->flexible_id); 
            }
            
            $final_amount = $service->price;
   
            $payment = AppointmentPayment::create([
                'appointment_id' => $Appointment->id,
                'payment_type' => $Appointment->payment_type,
                'amount' => module_is_active('FlexibleHours',$business->id) && !empty($flexible_hour) ? $flexible_hour->price : $service->price,
                'payment_date' => now(),
                'business_id' => $business->id,
                'created_by' => $business->created_by,
            ]);

            event(new AppointmentPaymentData($request->all(), $payment, $service));

            $appointment_number = Appointment::appointmentNumberFormat($Appointment->id, $business->created_by, $business->id);

            $company_settings = getCompanyAllSetting($Appointment->created_by, $Appointment->business_id);
            $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
            $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;
            //Email notification
            if ((!empty($company_settings['Create Appointment']) && $company_settings['Create Appointment']  == true)) {
                $uArr = [
                    'company_name' => $request->input('name'),
                    'service' => $Appointment->ServiceData ? $Appointment->ServiceData->name : '-',
                    'location' => $Appointment->LocationData ? $Appointment->LocationData->name : '-',
                    'staff' => $Appointment->StaffData->user ? $Appointment->StaffData->user->name : '-',
                    'appointment_date' => $Appointment->date,
                    'appointment_time' => $Appointment->time,
                    'appointment_number' => $appointment_number,
                ];
                $resp = EmailTemplate::sendEmailTemplate('Create Appointment', [$Appointment->CustomerData ? $Appointment->CustomerData->customer->email : $Appointment->email], $uArr, $Appointment->created_by);
            }
            event(new CreateAppoinment($Appointment, $request));

            $redirecturl = route("appointments.form", ["slug" => $business->slug, "appointment" => $Appointment->id]);
            return response()->json(['msg' => 'success', 'url' => $redirecturl]);
        }
    }

    public function appointmentStatusChange($id)
    {
        $appointment = Appointment::find($id);

        $CustomStatus = CustomStatus::where('created_by', creatorId())->where('business_id', getActiveBusiness())->pluck('title', 'id')->prepend('Pending', '0');

        return view('appointment.change-status', compact('appointment', 'CustomStatus'));
    }

    public function appointmentStatusUpdate(Request $request)
    {
        $appointment = Appointment::find($request->appointment_id);
        $appointment->appointment_status =  $request->status;
        $appointment->save();
        
        $appointment_number = Appointment::appointmentNumberFormat($appointment->id, $appointment->created_by, $appointment->business_id);
        //Email notification
        $company_settings = getCompanyAllSetting();


        if ((!empty($company_settings['Appointment Status Change']) && $company_settings['Appointment Status Change']  == true)) {
            $uArr = [
                'company_name' => $request->input('name'),
                'service' => $appointment->ServiceData ? $appointment->ServiceData->name : '-',
                'appointment_date' => $appointment->date,
                'appointment_time' => $appointment->time,
                'appointment_number' => $appointment_number,
            ];

            $resp = EmailTemplate::sendEmailTemplate('Appointment Status Change', [$appointment->CustomerData ? $appointment->CustomerData->customer->email : $appointment->email], $uArr);

            // return redirect()->route('appointment.index')->with('success', __('Appointment successfully created.'). ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            return redirect()->back()->with('success', __('Appointment status change successfully.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
        }

        event(new AppointmentStatus($appointment, $request));

        return redirect()->back()->with('success', __('Appointment status change successfully.'));
    }

    public function appointmentDone(Request $request, $slug, $id)
    {
        $appointment = Appointment::find($id);
        if (!empty($appointment)) {
            $company_settings = getCompanyAllSetting($appointment->created_by, $appointment->business_id);
            $customCss = isset($company_settings['custom_css']) ? $company_settings['custom_css'] : null;
            $customJs = isset($company_settings['custom_js']) ? $company_settings['custom_js'] : null;

            $appointment_number = Appointment::appointmentNumberFormat($appointment->id, $appointment->created_by, $appointment->business_id);

            //Email notification
            if ((!empty($company_settings['Create Appointment']) && $company_settings['Create Appointment']  == true)) {
                $uArr = [
                    'company_name' => $request->input('name'),
                    'service' => $appointment->ServiceData ? $appointment->ServiceData->name : '-',
                    'location' => $appointment->LocationData ? $appointment->LocationData->name : '-',
                    'staff' => $appointment->StaffData->user ? $appointment->StaffData->user->name : '-',
                    'appointment_date' => $appointment->date,
                    'appointment_time' => $appointment->time,
                    'appointment_number' => $appointment_number,
                ];
                $resp = EmailTemplate::sendEmailTemplate('Create Appointment', [$appointment->CustomerData ? $appointment->CustomerData->customer->email : $appointment->email], $uArr, $appointment->created_by);
                return view('embeded_appointment.appointment', compact('appointment_number', 'slug', 'customCss', 'customJs'))->with('success', __('Appointment successfully created.') . ((!empty($resp) && $resp['is_success'] == false && !empty($resp['error'])) ? '<br> <span class="text-danger">' . $resp['error'] . '</span>' : ''));
            }
            return view('embeded_appointment.appointment', compact('appointment_number', 'slug', 'customCss', 'customJs'));
        }
    }

    public function appointmentCalendar(Request $request)
    {
        $appointments = Appointment::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get();

        // Map through each appointment and create a new 'title' key without removing 'date'
        $appointments = $appointments->map(function ($appointment) {
            $carbonDate = Carbon::parse($appointment['date']);
            $appointment['title'] = $appointment['time']; // Change the format as needed
            $appointment['date'] = $carbonDate->format('Y-m-d'); // Change the format as needed
            $appointment['url'] = route('appointment.details', $appointment->id);
            return $appointment;
        });

        return view('appointment.calendar', compact('appointments'));
    }

    public function appointmentDetails($id)
    {
        $appointments = Appointment::find($id);
        return view('appointment.appointment_details', compact('appointments'));
    }

    public function appointmentAttachmentDelete($id)
    {
        $appointment = Appointment::find($id);

        if (!empty($appointment->attachment)) {
            delete_file($appointment->$appointment);
            $appointment->attachment = null;
            $appointment->save();
        }
        return redirect()->back()->with('error', __('Attachment successfully delete.'));
    }
}
