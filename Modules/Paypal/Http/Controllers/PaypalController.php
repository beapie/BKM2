<?php

namespace Modules\Paypal\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;
use App\Models\Business;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Service;
use App\Models\User;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Support\Facades\Session;
use Modules\FlexibleHours\Entities\FlexibleHour;
use Modules\Paypal\Events\PaypalPaymentStatus;

class PaypalController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('paypal::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('paypal::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('paypal::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('paypal::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function setting(Request $request)
    {
        if (Auth::user()->isAbleTo('paypal manage')) {
            if ($request->has('paypal_payment_is_on')) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'company_paypal_mode' => 'required|string',
                        'company_paypal_client_id' => 'required|string',
                        'company_paypal_secret_key' => 'required|string',
                    ]
                );
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
            }
            $post = $request->all();
            unset($post['_token']);
            unset($post['_method']);
            if ($request->has('paypal_payment_is_on')) {
                foreach ($post as $key => $value) {
                    // Define the data to be updated or inserted
                    $data = [
                        'key' => $key,
                        'business' => getActiveBusiness(),
                        'created_by' => creatorId(),
                    ];

                    // Check if the record exists, and update or insert accordingly
                    Setting::updateOrInsert($data, ['value' => $value]);
                }
            } else {
                // Define the data to be updated or inserted
                $data = [
                    'key' => 'paypal_payment_is_on',
                    'business' => getActiveBusiness(),
                    'created_by' => creatorId(),
                ];

                // Check if the record exists, and update or insert accordingly
                Setting::updateOrInsert($data, ['value' => 'off']);
            }

            // Settings Cache forget
            AdminSettingCacheForget();
            comapnySettingCacheForget();
            return redirect()->back()->with('success', __('Paypal Setting save successfully'));
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function paymentConfig($id = null, $business = Null)
    {
        $company_settings = getCompanyAllSetting($id, $business);
        $this->currancy = isset($company_settings['defult_currancy']) ? $company_settings['defult_currancy'] : '$';
        $this->enable_paypal = isset($company_settings['paypal_payment_is_on']) ? $company_settings['paypal_payment_is_on'] : 'off';

        if ($company_settings['company_paypal_mode'] == 'live') {
            config(
                [
                    'paypal.live.client_id' => isset($company_settings['company_paypal_client_id']) ? $company_settings['company_paypal_client_id'] : '',
                    'paypal.live.client_secret' => isset($company_settings['company_paypal_secret_key']) ? $company_settings['company_paypal_secret_key'] : '',
                    'paypal.mode' => isset($company_settings['company_paypal_mode']) ? $company_settings['company_paypal_mode'] : '',
                ]
            );
        } else {
            config(
                [
                    'paypal.sandbox.client_id' => isset($company_settings['company_paypal_client_id']) ? $company_settings['company_paypal_client_id'] : '',
                    'paypal.sandbox.client_secret' => isset($company_settings['company_paypal_secret_key']) ? $company_settings['company_paypal_secret_key'] : '',
                    'paypal.mode' => isset($company_settings['company_paypal_mode']) ? $company_settings['company_paypal_mode'] : '',
                ]
            );
        }
    }

    public function appointmentPayWithPaypal(Request $request)
    {
        $business = Business::find($request->business_id);
        $service = Service::find($request->service);
        
        $price = $service->price;
        if(module_is_active('PromoCodes', $business->id) && $request->after_promo_price !== null){
            $price = $request->after_promo_price;
        }
        
        if(module_is_active('ServiceTax')){
            $price = $request->final_amount;
        }
        
        if(module_is_active('PromoCodes') && module_is_active('ServiceTax')){
            $price = $request->after_promo_price;
        }

        if ((module_is_active('FlexibleHours',$business->created_by) && $request->flexible_id !== null)) {
            $flexible = FlexibleHour::find($request->flexible_id);
            $price = $flexible->price;
        }

        if (module_is_active('FlexibleHours', $business->created_by) && $request->flexible_id !== null && module_is_active('ServiceTax',$business->created_by)) {
            $price = $request->final_amount;
        }

        if(module_is_active('PromoCodes', $business->created_by) && module_is_active('FlexibleHours',$business->created_by)){
            $price = $request->after_promo_price;
        }
        
        
        $price = floatval(str_replace(',', '', $price));

        // $price = $service->price;
        if ($business) {
            try {
                $this->paymentConfig($business->created_by, $business->id);
                $provider = new PayPalClient;
                
                $provider->setApiCredentials(config('paypal'));
                $get_amount = $price;
                
                $get_amount = number_format((float) $get_amount, 2, '.', '');
                
                $paypalToken = $provider->getAccessToken();
                                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('appointment.paypal.status', [
                            'slug' => $business->slug,
                            'amount' => $get_amount,
                            'request_data' => $request->all(),
                        ]),
                        "cancel_url" => route('appointment.paypal.status', [
                            'slug' => $business->slug,
                            'amount' => $get_amount,
                        ]),
                    ],
                    "purchase_units" => [
                        [
                            "amount" => [
                                "currency_code" => !empty(company_setting('defult_currancy', $business->created_by, $business->id)) ? company_setting('defult_currancy', $business->created_by, $business->id) : '$',
                                "value" => $get_amount
                            ]
                        ]
                    ]
                ]);

                if (isset($response['id']) && $response['id'] != null) {
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return response()->json(['msg' => 'success', 'url' => $links['href']]);
                        }
                    }
                    return redirect()->back()->with('error', $response['message'] ?? 'Something went wrong.');
                } else {
                    return redirect()->back()->with('error', $response['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->back()->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->back()->with('error', __('Business Not found.'));
        }
    }
    public function getAppointmentPaymentStatus(Request $request, $slug)
    {
        try {
            $business = Business::where('slug', $slug)->first();
            $service = Service::find($request->request_data['service']);
            $this->paymentConfig($business->created_by, $business->id);
            if ($service) {
                $provider = new PayPalClient;
                $provider->setApiCredentials(config('paypal'));
                $provider->getAccessToken();
                $response = $provider->capturePaymentOrder($request['token']);
                $payment_id = Session::get('paypal_payment_id');
                
                if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                    $statuses = 'success';
                    $request_data = $request->request_data;

                    $promo_code_id = 0;
                    $final_amount = $service->price;

                    if(module_is_active('PromoCodes') && array_key_exists('after_promo_price', $request_data) && array_key_exists('promo_code_id', $request_data)){
                        $final_amount = $request_data['after_promo_price'];
                        $promo_code_id = $request_data['promo_code_id'];
                    }
                    if(module_is_active('ServiceTax') && array_key_exists('final_amount', $request_data)){
                        $final_amount = $request_data['final_amount'];
                    }
                    if(module_is_active('FlexibleHours',$business->created_by) && isset($request_data['flexible_id']))
                    {
                        $flexible_hour = FlexibleHour::find($request_data['flexible_id']); 
                        $final_amount = $flexible_hour->price;
                    }
                    if(module_is_active('PromoCodes', $business->created_by) && module_is_active('FlexibleHours') && isset($request_data['flexible_id'])){
                        $final_amount = $flexible_hour->price;
                    }

                    // $payment_data = [
                    //     'service' => $request_data['service'],
                    //     'staff' => $request_data['staff'],
                    //     'location' => $request_data['location'],
                    //     'appointment_date' => $request_data['appointment_date'],
                    //     'duration' => $request_data['duration'],
                    //     'name' => $request_data['name'] ?? '',
                    //     'contact' => $request_data['contact'] ?? '',
                    //     'email' => $request_data['email'] ?? '',
                    //     'password' => $request_data['password'] ?? '',
                    //     'type' => $request_data['type'],
                    //     'price' => $service->price,
                    //     'payment_type' => $request_data['payment'],
                    // ];

                    $payment_data = [
                        'service_price' => (module_is_active('FlexibleHours',$business->id) && isset($request_data['flexible_id']) ) ? $final_amount : $service->price,
                        'service' => $request_data['service'],
                        'staff' => $request_data['staff'],
                        'location' => $request_data['location'],
                        'appointment_date' => $request_data['appointment_date'],
                        'duration' => $request_data['duration'],
                        'name' => $request_data['name'] ?? '',
                        'contact' => $request_data['contact'] ?? '',
                        'email' => $request_data['email'] ?? '',
                        'password' => $request_data['password'] ?? '',
                        'final_amount' => $final_amount,
                        'tax_amount' => $request_data['service_tax'] ?? 0,
                        'type' => $request_data['type'],
                        'payment_type' => $request_data['payment'] ?? 'manually',
                        'promo_code_id' => $promo_code_id,
                        'price_after_promo' => $request_data['after_promo_price'] ?? 0,
                    ];
                    $type = 'appointmentpayment';
                    $event = event(new PaypalPaymentStatus($payment_data, $type, $slug));
                    return redirect()->route('appointments.form', ['slug' => $slug, 'appointment' => $event[0]])->withFragment('appointment');
                }
            }
        } catch (\Exception $th) {
            return redirect()->route('appointments.form', ['slug' => $slug, 'appointment' => 'failed'])->withFragment('appointment');
        }
    }



    public function planPayWithPaypal(Request $request)
    {
        $plan = Plan::find($request->plan_id);
        $user_counter = !empty($request->user_counter_input) ? $request->user_counter_input : 0;
        $business_counter = !empty($request->business_counter_input) ? $request->business_counter_input : 0;
        $user_module = !empty($request->user_module_input) ? $request->user_module_input : '0';
        $duration = !empty($request->time_period) ? $request->time_period : 'Month';
        $user_module_price = 0;
        if (!empty($user_module) && $plan->custom_plan == 1) {
            $user_module_array = explode(',', $user_module);
            foreach ($user_module_array as $key => $value) {
                $temp = ($duration == 'Year') ? ModulePriceByName($value)['yearly_price'] : ModulePriceByName($value)['monthly_price'];
                $user_module_price = $user_module_price + $temp;
            }
        }
        $user_price = 0;
        if ($user_counter > 0) {
            $temp = ($duration == 'Year') ? $plan->price_per_user_yearly : $plan->price_per_user_monthly;
            $user_price = $user_counter * $temp;
        }
        $business_price = 0;
        if ($business_counter > 0) {
            $temp = ($duration == 'Year') ? $plan->price_per_business_yearly : $plan->price_per_business_monthly;
            $business_price = $business_counter * $temp;
        }
        $plan_price = ($duration == 'Year') ? $plan->package_price_yearly : $plan->package_price_monthly;
        $counter = [
            'user_counter' => $user_counter,
            'business_counter' => $business_counter,
        ];

        $admin_settings = getAdminAllSetting();
        if ($admin_settings['company_paypal_mode'] == 'live') {
            config(
                [
                    'paypal.live.client_id' => isset($admin_settings['company_paypal_client_id']) ? $admin_settings['company_paypal_client_id'] : '',
                    'paypal.live.client_secret' => isset($admin_settings['company_paypal_secret_key']) ? $admin_settings['company_paypal_secret_key'] : '',
                    'paypal.mode' => isset($admin_settings['company_paypal_mode']) ? $admin_settings['company_paypal_mode'] : '',
                ]
            );
        } else {
            config(
                [
                    'paypal.sandbox.client_id' => isset($admin_settings['company_paypal_client_id']) ? $admin_settings['company_paypal_client_id'] : '',
                    'paypal.sandbox.client_secret' => isset($admin_settings['company_paypal_secret_key']) ? $admin_settings['company_paypal_secret_key'] : '',
                    'paypal.mode' => isset($admin_settings['company_paypal_mode']) ? $admin_settings['company_paypal_mode'] : '',
                ]
            );
        }
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        if ($plan) {
            try {
                if ($request->coupon_code) {
                    $plan_price = CheckCoupon($request->coupon_code, $plan_price);
                }
                $price = $plan_price + $user_module_price + $user_price + $business_price;

                if ($price <= 0) {
                    $assignPlan = DirectAssignPlan($plan->id, $duration, $user_module, $counter, 'PAYPAL', $request->coupon_code);
                    if ($assignPlan['is_success']) {
                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                    } else {
                        return redirect()->route('plans.index')->with('error', __('Something went wrong, Please try again,'));
                    }
                }
                $provider->getAccessToken();
                $response = $provider->createOrder([
                    "intent" => "CAPTURE",
                    "application_context" => [
                        "return_url" => route('plan.get.paypal.status', [
                            $plan->id,
                            'amount' => $price,
                            'user_module' => $user_module,
                            'counter' => $counter,
                            'duration' => $duration,
                            'coupon_code' => $request->coupon_code,
                        ]),
                        "cancel_url" => route('plan.get.paypal.status', [
                            $plan->id,
                            'amount' => $price,
                            'user_module' => $user_module,
                            'counter' => $counter,
                            'duration' => $duration,
                            'coupon_code' => $request->coupon_code,

                        ]),
                    ],
                    "purchase_units" => [
                        0 => [
                            "amount" => [
                                "currency_code" => admin_setting('defult_currancy'),
                                "value" => $price,

                            ]
                        ]
                    ]
                ]);
                if (isset($response['id']) && $response['id'] != null) {
                    // redirect to approve href
                    foreach ($response['links'] as $links) {
                        if ($links['rel'] == 'approve') {
                            return redirect()->away($links['href']);
                        }
                    }
                    return redirect()
                        ->route('plans.index', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))
                        ->with('error', 'Something went wrong. OR Unknown error occurred');
                } else {
                    return redirect()
                        ->route('plans.index', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))
                        ->with('error', $response['message'] ?? 'Something went wrong.');
                }
            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __($e->getMessage()));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetPaypalStatus(Request $request, $plan_id)
    {
        $user = Auth::user();
        $plan = Plan::find($plan_id);
        if ($plan) {
            $admin_settings = getAdminAllSetting();
            if ($admin_settings['company_paypal_mode'] == 'live') {
                config(
                    [
                        'paypal.live.client_id' => isset($admin_settings['company_paypal_client_id']) ? $admin_settings['company_paypal_client_id'] : '',
                        'paypal.live.client_secret' => isset($admin_settings['company_paypal_secret_key']) ? $admin_settings['company_paypal_secret_key'] : '',
                        'paypal.mode' => isset($admin_settings['company_paypal_mode']) ? $admin_settings['company_paypal_mode'] : '',
                    ]
                );
            } else {
                config(
                    [
                        'paypal.sandbox.client_id' => isset($admin_settings['company_paypal_client_id']) ? $admin_settings['company_paypal_client_id'] : '',
                        'paypal.sandbox.client_secret' => isset($admin_settings['company_paypal_secret_key']) ? $admin_settings['company_paypal_secret_key'] : '',
                        'paypal.mode' => isset($admin_settings['company_paypal_mode']) ? $admin_settings['company_paypal_mode'] : '',
                    ]
                );
            }

            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $provider->getAccessToken();
            $response = $provider->capturePaymentOrder($request['token']);
            $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
            try {
                if (isset($response['status']) && $response['status'] == 'COMPLETED') {
                    if ($response['status'] == 'COMPLETED') {
                        $statuses = __('succeeded');
                    }

                    $order = Order::create(
                        [
                            'order_id' => $orderID,
                            'name' => null,
                            'email' => null,
                            'card_number' => null,
                            'card_exp_month' => null,
                            'card_exp_year' => null,
                            'plan_name' => !empty($plan->name) ? $plan->name : 'Basic Package',
                            'plan_id' => $plan->id,
                            'price' => !empty($request->amount) ? $request->amount : 0,
                            'price_currency' => admin_setting('defult_currancy'),
                            'txn_id' => '',
                            'payment_type' => __('PAYPAL'),
                            'payment_status' => $statuses,
                            'receipt' => null,
                            'user_id' => $user->id,
                        ]
                    );
                    $type = 'Subscription';
                    $user = User::find($user->id);
                    $assignPlan = $user->assignPlan($plan->id, $request->duration, $request->user_module, $request->counter);
                    if ($request->coupon_code) {

                        UserCoupon($request->coupon_code, $orderID);
                    }
                    $value = Session::get('user-module-selection');


                    if (!empty($value)) {
                        Session::forget('user-module-selection');
                    }

                    if ($assignPlan['is_success']) {
                        return redirect()->route('plans.index')->with('success', __('Plan activated Successfully.'));
                    } else {
                        return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                    }
                } else {
                    return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
                }
            } catch (\Exception $e) {
                return redirect()->route('plans.index')->with('error', __('Transaction has been failed.'));
            }
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }
}
