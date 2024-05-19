<?php

namespace Modules\Stripe\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;
use Modules\PromoCodes\Entities\PromoCode;
use Modules\Stripe\Events\StripePaymentStatus;
use App\Models\Setting;
use App\Models\Business;
use App\Models\Order;
use App\Models\Plan;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Modules\FlexibleHours\Entities\FlexibleHour;

class StripeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('stripe::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('stripe::create');
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
        return view('stripe::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('stripe::edit');
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
        if (Auth::user()->isAbleTo('stripe manage')) {
            if ($request->has('stripe_is_on')) {
                $validator = Validator::make($request->all(), [
                    'stripe_key' => 'required|string',
                    'stripe_secret' => 'required|string'
                ]);
                if ($validator->fails()) {
                    $messages = $validator->getMessageBag();

                    return redirect()->back()->with('error', $messages->first());
                }
            }
            $getActiveBusiness = getActiveBusiness();
            $creatorId = creatorId();
            if ($request->has('stripe_is_on')) {
                $post = $request->all();
                unset($post['_token']);
                foreach ($post as $key => $value) {
                    // Define the data to be updated or inserted
                    $data = [
                        'key' => $key,
                        'business' => $getActiveBusiness,
                        'created_by' => $creatorId,
                    ];

                    // Check if the record exists, and update or insert accordingly
                    Setting::updateOrInsert($data, ['value' => $value]);
                }
            } else {
                $data = [
                    'key' => 'stripe_is_on',
                    'business' => $getActiveBusiness,
                    'created_by' => $creatorId,
                ];
                // Check if the record exists, and update or insert accordingly
                Setting::updateOrInsert($data, ['value' => 'off']);
            }
            // Settings Cache forget
            AdminSettingCacheForget();
            comapnySettingCacheForget();
            return redirect()->back()->with('success', 'Stripe setting save sucessfully.');
        } else {
            return redirect()->back()->with('error', __('Permission denied.'));
        }
    }

    public function payment_setting($id = null, $business = Null)
    {
        if (!empty($id) && empty($business)) {
            $company_settings = getCompanyAllSetting($id);
        } elseif (!empty($id) && !empty($business)) {
            $company_settings = getCompanyAllSetting($id, $business);
        } else {
            $company_settings = getCompanyAllSetting();
        }
        $this->currancy  = !empty($company_settings['defult_currancy']) ? $company_settings['defult_currancy'] : 'INR';
        $this->is_stripe_enabled = ($company_settings['stripe_is_on']) ? $company_settings['stripe_is_on'] : 'off';
        $this->stripe_key        = ($company_settings['stripe_key']) ? $company_settings['stripe_key'] : '';
        $this->stripe_secret     = ($company_settings['stripe_secret']) ? $company_settings['stripe_secret'] : '';
    }

    public function appointmentPayWithStripe(Request $request)
    {
        $business = Business::find($request->business_id);
        $service = Service::find($request->service);

        $service_price = $service->price;
        if (module_is_active('PromoCodes', $business->created_by) && $request->after_promo_price !== null) {
            $service_price = $request->after_promo_price;
        }

        if (module_is_active('ServiceTax', $business->created_by)) {
            $service_price = $request['final_amount'];
        }

        if ((module_is_active('FlexibleHours',$business->created_by) && $request->flexible_id !== null)) {
            $flexible = FlexibleHour::find($request->flexible_id);
            $service_price = $flexible->price;
        }

        if (module_is_active('PromoCodes', $business->created_by) && module_is_active('FlexibleHours',$business->created_by)) {
            $service_price = $request->after_promo_price;
        }

        if (module_is_active('PromoCodes', $business->created_by) && module_is_active('ServiceTax', $business->created_by)) {
            $service_price = $request->after_promo_price;
        }

        if (module_is_active('FlexibleHours', $business->created_by) && $request->flexible_id !== null && module_is_active('ServiceTax',$business->created_by)) {
            $service_price = $request['final_amount'];
        }
        $price = $service_price;

        $price = floatval(str_replace(',', '', $price));

        self::payment_setting($business->created_by, $business->id);

        if (isset($this->is_stripe_enabled) && $this->is_stripe_enabled == 'on' && !empty($this->stripe_key) && !empty($this->stripe_secret)) {
            // try {

            $stripe_formatted_price = in_array(
                company_setting('defult_currancy', $business->created_by, $business->id),
                ['MGA', 'BIF', 'CLP', 'PYG', 'DJF', 'RWF', 'GNF', 'UGX', 'JPY', 'VND', 'VUV', 'XAF', 'KMF', 'KRW', 'XOF', 'XPF',]
            ) ? number_format($price, 2, '.', '') : number_format($price, 2, '.', '') * 100;

            $return_url_parameters = function ($return_type) {
                return '&return_type=' . $return_type;
            };

            /* Initiate Stripe */
            \Stripe\Stripe::setApiKey(company_setting('stripe_secret', $business->created_by, $business->id));
            $code = '';

            $comapany_stripe_data = \Stripe\Checkout\Session::create(
                [
                    'payment_method_types' => ['card'],
                    'line_items' => [
                        [
                            'name' => 'booking',
                            'amount' => (int) $stripe_formatted_price,
                            'currency' => $this->currancy,
                            'quantity' => 1,
                        ],
                    ],
                    'metadata' => [
                        'user_id' => isset($user->name) ? '' : 0,
                        'package_id' => $business->slug,
                        'code' => $code,
                    ],
                    'success_url' => route(
                        'appointment.stripe.status',
                        [
                            'slug' => $business->slug,
                            'request_data' => $request->all(),
                            $return_url_parameters('success'),
                        ]
                    ),
                    'cancel_url' => route(
                        'appointments.form',
                        [
                            'slug' => $business->slug,
                            $return_url_parameters('cancel'),
                        ]
                    ),
                ]
            );


            $data = [
                'amount' => $price,
                'slug' => $business->slug,
                'currency' => $this->currancy,
                'request_data' => $request->all(),
                'stripe' => $comapany_stripe_data,
            ];

            $request->session()->put('comapany_stripe_data', $data);
            session()->put($request->all(), $business->slug);
            $comapany_stripe_data = $comapany_stripe_data ?? false;
            // return new RedirectResponse($comapany_stripe_data->url);
            return response()->json([
                'msg' => 'success',
                'url' => $comapany_stripe_data->url,
            ]);
        } else {
            return redirect()->back()->with('error', __('Please Enter Stripe Details.'));
        }
    }

    public function getAppointmentPaymentStatus(Request $request, $slug)
    {
        if ($request->return_type == 'success') {
            $business   = Business::where('slug', $slug)->first();
            $service    = Service::find($request->request_data['service']);

            if (!empty($business)) {
                $session_data   = $request->session()->get('comapany_stripe_data');
                $amount         = $session_data['amount'];
                try {
                    $stripe = new \Stripe\StripeClient(!empty(company_setting('stripe_secret', $business->created_by, $business->id)) ? company_setting('stripe_secret', $business->created_by, $business->id) : '');

                    $paymentIntents = $stripe->paymentIntents->retrieve(
                        $session_data['stripe']->payment_intent,
                        []
                    );
                    $receipt_url = $paymentIntents->charges->data[0]->receipt_url;
                } catch (\Exception $exception) {
                    $receipt_url = "";
                }
                if ($business) {
                    try {
                        if ($request->return_type == 'success') {
                            $request_data = $request->request_data;

                            $promo_code_id = 0;
                            $final_amount = $service->price;

                            if (module_is_active('PromoCodes') && array_key_exists('after_promo_price', $request_data) && array_key_exists('promo_code_id', $request_data)) {
                                $final_amount = $request_data['after_promo_price'];
                                $promo_code_id = $request_data['promo_code_id'];
                            }
                            if (module_is_active('ServiceTax') && array_key_exists('final_amount', $request_data)) {
                                $final_amount = $request_data['final_amount'];
                            }
                            if (module_is_active('FlexibleHours', $business->created_by) && isset($request_data['flexible_id'])) {
                                $flexible_hour = FlexibleHour::find($request_data['flexible_id']);
                                $final_amount = $flexible_hour->price;
                            }
                            $payment_data = [
                                'service_price' => module_is_active('FlexibleHours', $business->id) && !empty($flexible_hour) ? $flexible_hour->price  : $service->price,
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
                            $event = event(new StripePaymentStatus($payment_data, $type, $slug));
                            return redirect()->route('appointments.form', ['slug' => $slug, 'appointment' => $event[0]])->withFragment('appointment')->with('success', __('Payment added Successfully'));
                        } else {
                            return redirect()->route('appointments.form', $slug)->with('error', __('Transaction has been failed!'));
                        }
                    } catch (\Exception $e) {
                        return redirect()->route('appointments.form', $slug)->with('error', __('Transaction has been failed!'));
                    }
                } else {
                    return redirect()->route('appointments.form', $slug)->with('error', __('Invoice not found.'));
                }
            } else {
                return redirect()->route('appointments.form', $slug)->with('error', __('Invoice not found.'));
            }
        } else {
            return redirect()->route('appointments.form', ['slug' => $slug, 'appointment' => 'failed'])->withFragment('appointment');
        }
    }

    public function planPayWithStripe(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $plan = Plan::find($request->plan_id);
        $admin_settings = getAdminAllSetting();
        $admin_currancy = !empty($admin_settings['defult_currancy']) ? $admin_settings['defult_currancy'] : 'INR';
        $authuser = Auth::user();
        $user_counter = !empty($request->user_counter_input) ? $request->user_counter_input : 0;
        $business_counter = !empty($request->business_counter_input) ? $request->business_counter_input : 0;
        $user_module = !empty($request->user_module_input) ? $request->user_module_input : '';
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
        $stripe_session = '';
        $orderID = strtoupper(str_replace('.', '', uniqid('', true)));
        if ($plan) {
            /* Check for code usage */
            $plan->discounted_price = false;
            $payment_frequency = $plan->duration;
            if ($request->coupon_code) {
                $plan_price = CheckCoupon($request->coupon_code, $plan_price);
            }
            $price = $plan_price + $user_module_price + $user_price + $business_price;
            if ($price <= 0) {
                $assignPlan = DirectAssignPlan($plan->id, $duration, $user_module, $counter, 'STRIPE', $request->coupon_code);
                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                } else {
                    return redirect()->route('plans.index')->with('error', __('Something went wrong, Please try again,'));
                }
            }

            try {

                $payment_plan = $duration;
                $payment_type = 'onetime';
                /* Payment details */
                $code = '';

                $product = 'Basic Package';

                /* Final price */
                $stripe_formatted_price = in_array(
                    $admin_currancy,
                    [
                        'MGA',
                        'BIF',
                        'CLP',
                        'PYG',
                        'DJF',
                        'RWF',
                        'GNF',
                        'UGX',
                        'JPY',
                        'VND',
                        'VUV',
                        'XAF',
                        'KMF',
                        'KRW',
                        'XOF',
                        'XPF',
                    ]
                ) ? number_format($price, 2, '.', '') : number_format($price, 2, '.', '') * 100;
                $return_url_parameters = function ($return_type) use ($payment_frequency, $payment_type) {
                    return '&return_type=' . $return_type . '&payment_processor=stripe&payment_frequency=' . $payment_frequency . '&payment_type=' . $payment_type;
                };
                /* Initiate Stripe */
                \Stripe\Stripe::setApiKey(isset($admin_settings['stripe_secret']) ? $admin_settings['stripe_secret'] : '');
                $stripe_session = \Stripe\Checkout\Session::create(
                    [
                        'payment_method_types' => ['card'],
                        'line_items' => [
                            [
                                'price_data' => [
                                    'currency' => $admin_currancy,
                                    'unit_amount' => (int) $stripe_formatted_price,
                                    'product_data' => [
                                        'name' => !empty($plan->name) ? $plan->name : 'Basic Package',
                                        'description' => $payment_plan,
                                    ],
                                ],
                                'quantity' => 1,
                            ],
                        ],
                        'mode' => 'payment',
                        'metadata' => [
                            'user_id' => $authuser->id,
                            'package_id' => $plan->id,
                            'payment_frequency' => $payment_frequency,
                            'code' => $code,
                        ],
                        'success_url' => route(
                            'plan.get.payment.status',
                            [
                                'order_id' => $orderID,
                                'plan_id' => $plan->id,
                                'user_module' => $user_module,
                                'duration' => $duration,
                                'counter' => $counter,
                                'coupon_code' => $request->coupon_code,
                                $return_url_parameters('success'),
                            ]
                        ),
                        'cancel_url' => route(
                            'plan.get.payment.status',
                            [
                                'plan_id' => $orderID,
                                'order_id' => $plan->id,
                                $return_url_parameters('cancel'),
                            ]
                        ),
                    ]
                );
                Order::create(
                    [
                        'order_id' => $orderID,
                        'name' => null,
                        'email' => null,
                        'card_number' => null,
                        'card_exp_month' => null,
                        'card_exp_year' => null,
                        'plan_name' => !empty($plan->name) ? $plan->name : 'Basic Package',
                        'plan_id' => $plan->id,
                        'price' => !empty($price) ? $price : 0,
                        'price_currency' => $admin_currancy,
                        'txn_id' => '',
                        'payment_type' => __('STRIPE'),
                        'payment_status' => 'pending',
                        'receipt' => null,
                        'user_id' => $authuser->id,
                    ]
                );
                $request->session()->put('stripe_session', $stripe_session);
                $stripe_session = $stripe_session ?? false;
            } catch (\Exception $e) {
                \Log::debug($e->getMessage());
                return redirect()->route('plans.index')->with('error', $e->getMessage());
            }
            return view('stripe::plan.request', compact('stripe_session'));
        } else {
            return redirect()->route('plans.index')->with('error', __('Plan is deleted.'));
        }
    }

    public function planGetStripeStatus(Request $request)
    {
        \Log::debug((array) $request->all());
        $admin_settings = getAdminAllSetting();
        try {
            $stripe = new \Stripe\StripeClient(!empty($admin_settings['stripe_secret']) ? $admin_settings['stripe_secret'] : '');
            $paymentIntents = $stripe->paymentIntents->retrieve(
                $request->session()->get('stripe_session')->payment_intent,
                []
            );
            $receipt_url = $paymentIntents->charges->data[0]->receipt_url;
        } catch (\Exception $exception) {
            $receipt_url = "";
        }
        \Session::forget('stripe_session');
        $request->session()->forget('stripe_session');

        try {
            if ($request->return_type == 'success') {
                $Order = Order::where('order_id', $request->order_id)->first();
                $Order->payment_status = 'succeeded';
                $Order->receipt = $receipt_url;
                $Order->save();

                $user = User::find(\Auth::user()->id);
                $plan = Plan::find($request->plan_id);
                $assignPlan = $user->assignPlan($plan->id, $request->duration, $request->user_module, $request->counter);
                if ($request->coupon_code) {
                    UserCoupon($request->coupon_code, $request->order_id);
                }
                $type = 'Subscription';
                // event(new StripePaymentStatus($plan, $type, $Order));
                $value = Session::get('user-module-selection');
                if (!empty($value)) {
                    Session::forget('user-module-selection');
                }
                if ($assignPlan['is_success']) {
                    return redirect()->route('plans.index')->with('success', __('Plan activated Successfully!'));
                } else {
                    return redirect()->route('plans.index')->with('error', __($assignPlan['error']));
                }
            } else {
                return redirect()->route('plans.index')->with('error', __('Your Payment has failed!'));
            }
        } catch (\Exception $exception) {
            return redirect()->route('plans.index')->with('error', $exception->getMessage());
        }
    }
}
