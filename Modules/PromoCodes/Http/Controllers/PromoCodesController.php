<?php

namespace Modules\PromoCodes\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentPayment;
use App\Models\Business;
use App\Models\Customer;
use App\Models\Service;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Modules\PromoCodes\Entities\PromoCode;
use Modules\PromoCodes\Events\CalculateTax;
use Modules\PromoCodes\Events\FlexibleHoursCount;

class PromoCodesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (Auth::user()->isAbleTo('promocode manage')) {
            $promocodes = PromoCode::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get();

            return view('promocodes::promocode.index', compact('promocodes'));
        } else {
            return redirect()->with('error', 'Permission Denied.');
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        if (Auth::user()->isAbleTo('promocode create')) {
            $services = Service::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get()->prepend(['id' => 0, 'name' => 'All Service'])->select('name', 'id')->pluck('name', 'id');

            $customers = Customer::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get()->prepend(['id' => 0, 'name' => 'All Customers'])->select('name', 'id')->pluck('name', 'id');

            return view('promocodes::promocode.create', compact('services', 'customers'));
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        if (Auth::user()->isAbleTo('promocode create')) {

            $validator = Validator::make(
                $request->all(),
                [
                    'promo_code' => 'required',
                    'discount' => 'required',
                    'flat_rate' => 'required',
                    'discount_type' => 'required',
                    'once_per_customer' => 'required',
                    'services' => 'required',
                    'use_limit' => 'required',
                    'customers' => 'required'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $promo_code = new PromoCode();
            $promo_code->code = $request->promo_code;
            $promo_code->discount_percentage = $request->discount;
            $promo_code->flat_rate = $request->flat_rate;
            $promo_code->discount_type = $request->discount_type == 'on' ? 1 : 0;
            $promo_code->once_per_customer = $request->once_per_customer == 'on' ? 1 : 0;
            $promo_code->services = implode(',', $request->services);
            $promo_code->use_limit = $request->use_limit;
            $promo_code->start_date = $request->start_date;
            $promo_code->end_date = $request->end_date;
            $promo_code->customers = implode(',', $request->customers);
            $promo_code->business_id = getActiveBusiness();
            $promo_code->created_by = creatorId();
            $promo_code->save();

            return redirect()->back()->with('success', 'Promo Code Created Successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $promocodes = AppointmentPayment::where('promo_code_id', $id)->get();

        return view('promocodes::promocode.view', compact('promocodes'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        if (Auth::user()->isAbleTo('promocode edit')) {
            $promocodes = PromoCode::find($id);

            $services = Service::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get()->prepend(['id' => 0, 'name' => 'All Service'])->select('name', 'id')->pluck('name', 'id');

            $customers = Customer::where('business_id', getActiveBusiness())->where('created_by', creatorId())->get()->prepend(['id' => 0, 'name' => 'All Customers'])->select('name', 'id')->pluck('name', 'id');

            return view('promocodes::promocode.edit', compact('promocodes', 'services', 'customers'));
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        if (Auth::user()->isAbleTo('promocode edit')) {
            $validator = Validator::make(
                $request->all(),
                [
                    'promo_code' => 'required',
                    'discount' => 'required',
                    'flat_rate' => 'required',
                    'discount_type' => 'required',
                    'once_per_customer' => 'required',
                    'services' => 'required',
                    'use_limit' => 'required',
                    'customers' => 'required'
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->getMessageBag()->first());
            }

            $promocode = PromoCode::find($id);
            $promocode->code = $request->promo_code;
            $promocode->discount_percentage = $request->discount;
            $promocode->flat_rate = $request->flat_rate;
            $promocode->discount_type = $request->discount_type == 'on' ? 1 : 0;
            $promocode->once_per_customer = $request->once_per_customer == 'on' ? 1 : 0;
            $promocode->services = implode(',', $request->services);
            $promocode->use_limit = $request->use_limit;
            $promocode->start_date = $request->start_date;
            $promocode->end_date = $request->end_date;
            $promocode->customers = implode(',', $request->customers);
            $promocode->business_id = getActiveBusiness();
            $promocode->created_by = creatorId();
            $promocode->save();

            return redirect()->back()->with('success', 'Promo Code Updated Successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        if (Auth::user()->isAbleTo('promocode delete')) {
            $promocode = PromoCode::find($id);
            $promocode->delete();

            return redirect()->back()->with('success', 'Promo Code Deleted Successfully.');
        } else {
            return redirect()->back()->with('error', 'Permission Denied.');
        }
    }

    public function applyPromoCode(Request $request)
    {
        $service = Service::find($request->service);
        
        $promocode = PromoCode::where('code', $request->promocode)->first();
        
        $flexible_amount = event(new FlexibleHoursCount($service->id, $request->staffSelect, $request->selectedDate, $request->selectedSloteTime));
        
        if ($promocode && $promocode != null) {
            $service_data = explode(',', $promocode['services']);
            $user_data = explode(',', $promocode['customers']);
            
            $discount = 0;
            
            if ($service != null && $promocode != null) {
                if ($promocode->once_per_customer == 1) {
                    $check_user = AppointmentPayment::where('promo_code_id', $promocode->id)->get();
                    $appointmentIds = [];

                    foreach ($check_user as $record) {
                        $appointmentId = $record['appointment_id'];
                        if (!in_array($appointmentId, $appointmentIds)) {
                            $appointmentIds[] = $appointmentId;
                        }
                    }
                    $appointment_user = Appointment::whereIn('id', $appointmentIds)->get();
                    $customerIds = [];

                    foreach ($appointment_user as $customer_id) {
                        $customerId = $customer_id['customer_id'];
                        if (!in_array($customerIds, $customerIds)) {
                            $customerIds[] = $customerId;
                        }
                    }

                    if ($request->type == 'existing-user') {
                        $user = User::where('email', $request->email)->first();
                        
                        if($user != null){
                            $customer = Customer::where('user_id', $user->id)->first();

                            if($customer === null){
                                return response()->json([
                                    'error' => 'Customer Not in the List.'
                                ], 404);
                            }
                            if (in_array($customer->user_id, $customerIds)) {
                                return response()->json([
                                    'error' => 'Customer Can only use Promo Code for Once.'
                                ], 404);
                            }
                        }
                        
                    } 

                    if ($request->type == 'guest-user'){
                        $customer = Appointment::where('email', $request->email)->get();
                        
                        if($customer->isNotEmpty()){
                            return response()->json([
                                'error' => 'Customer Can only use Promo Code for Once.'
                            ]);
                        }
                        
                    }
                }
    
                if ($request->type == 'existing-user') {
                    $user = User::where('email', $request->email)->first();
                    if($user != null){
                        $customer = Customer::where('user_id', $user->id)->first();
                        if($customer === null){
                            return response()->json([
                                'error' => 'Promo Code Invalid.'
                            ], 404);
                        }
                    }
                }

                if($request->type == 'guest-user'){
                    if($promocode->customers != 0){
                        return response()->json([
                            'error' => 'Promo Code Invalid.'
                        ], 404);
                    }
                }

                if($request->type == 'new-user'){
                    if($promocode->customers != 0){
                        return response()->json([
                            'error' => 'Promo Code Invalid.'
                        ], 404);
                    }
                }

                $service_price = $service->price;
                
                if(module_is_active('FlexibleHours', $service->business_id) && !empty($flexible_amount)){ 
                    $service_price = $flexible_amount[0];
                }
                if (in_array($request->service, $service_data)) {
                    // for check customer (0 for all)
                    if ($promocode->customers == 0) { // for All Customers
                        if ($promocode->promo_used < $promocode->use_limit) { // check limit
                            if (!empty($promocode->start_date) && !empty($promocode->end_date)) { // check promo start date and end date
                                if ($promocode->discount_type == 1) { // check discount type
                                    $discount = $service_price * $promocode->discount_percentage / 100;
                                } else {
                                    $discount = $promocode->flat_rate;
                                }
                                $final_amount = $service_price - $discount;
                                $promocode->promo_used = $promocode->promo_used + 1;
                                $promocode->save();
                                if(module_is_active('ServiceTax', $service->created_by)){
                                    $data = event(new CalculateTax($service, $final_amount));
                                }
                                return response()->json([
                                    'message' => 'Promo Code Apply Successfully.',
                                    'final_amount' => $final_amount,
                                    'promo_code_id' => $promocode->id,
                                    'after_promo_tax' => isset($data) ? $data : '',
                                    'apply_discount' => $discount
                                ]);
                            } else {
                                return response()->json([
                                    'error' => 'Promo Code Use Duration Expires.'
                                ], 404);
                            }
                        } else { // limit
                            return response()->json([
                                'error' => 'Promo Code Limit Expires.',
                            ], 404);
                        }
                        // $this->calculatePromo($promocode->id, $service->id);
                    } elseif ($customer != null && in_array($customer->id, $user_data)) {
                        // $this->calculatePromo($promocode->id, $service->id);
                        if ($promocode->promo_used < $promocode->use_limit) { // check limit
                            if (!empty($promocode->start_date) && !empty($promocode->end_date)) { // check promo start date and end date
                                if ($promocode->discount_type == 1) { // check discount type
                                    $discount = $service_price * $promocode->discount_percentage / 100;
                                } else {
                                    $discount = $promocode->flat_rate;
                                }
                                $final_amount = $service_price - $discount;
                                $promocode->promo_used = $promocode->promo_used + 1;
                                $promocode->save();
                                if(module_is_active('ServiceTax', $service->created_by)){
                                    $data = event(new CalculateTax($service, $final_amount));
                                }
                                return response()->json([
                                    'message' => 'Promo Code Apply Successfully.',
                                    'final_amount' => $final_amount,
                                    'promo_code_id' => $promocode->id,
                                    'after_promo_tax' => isset($data) ? $data : '',
                                    'apply_discount' => $discount
                                ]);
                            } else {
                                return response()->json([
                                    'error' => 'Promo Code Use Duration Expires.'
                                ], 404);
                            }
                        } else { // limit
                            return response()->json([
                                'error' => 'Promo Code Limit Expires.',
                            ], 404);
                        }
                    } else {
                        return response()->json([
                            'error' => 'User not found in the list.'
                        ], 404);
                    }
                } elseif ($promocode->services == 0){ // for check service is all or not
                    if ($promocode->customers == 0 || $request->type == 'new-user') { // for All Customers
                        // $this->calculatePromo($promocode->id, $service->id);

                        if ($promocode->promo_used < $promocode->use_limit) { // check limit
                            if (!empty($promocode->start_date) && !empty($promocode->end_date)) { // check promo start date and end date
                                if ($promocode->discount_type == 1) { // check discount type
                                    $discount = $service_price * $promocode->discount_percentage / 100;
                                } else {
                                    $discount = $promocode->flat_rate;
                                }
                                $final_amount = $service_price - $discount;
                                $promocode->promo_used = $promocode->promo_used + 1;
                                $promocode->save();
                                if(module_is_active('ServiceTax', $service->created_by)){
                                    $data = event(new CalculateTax($service, $final_amount));
                                }
                                return response()->json([
                                    'message' => 'Promo Code Apply Successfully.',
                                    'final_amount' => $final_amount,
                                    'promo_code_id' => $promocode->id,
                                    'after_promo_tax' => isset($data) ? $data : '',
                                    'apply_discount' => $discount
                                ]);
                            } else {
                                return response()->json([
                                    'error' => 'Promo Code Use Duration Expires.'
                                ], 404);
                            }
                        } else { // limit
                            return response()->json([
                                'error' => 'Promo Code Limit Expires.',
                            ], 404);
                        }
                    } elseif (in_array($customer->id, $user_data)) {
                        // $this->calculatePromo($promocode->id, $service->id);
                        if ($promocode->promo_used < $promocode->use_limit) { // check limit
                            if (!empty($promocode->start_date) && !empty($promocode->end_date)) { // check promo start date and end date
                                if ($promocode->discount_type == 1) { // check discount type
                                    $discount = $service_price * $promocode->discount_percentage / 100;
                                } else {
                                    $discount = $promocode->flat_rate;
                                }
                                $final_amount = $service_price - $discount;
                                $promocode->promo_used = $promocode->promo_used + 1;
                                $promocode->save();
                                if(module_is_active('ServiceTax', $service->created_by)){
                                    $data = event(new CalculateTax($service, $final_amount));
                                }
                                return response()->json([
                                    'message' => 'Promo Code Apply Successfully.',
                                    'final_amount' => $final_amount,
                                    'promo_code_id' => $promocode->id,
                                    'after_promo_tax' => isset($data) ? $data : '',
                                    'apply_discount' => $discount
                                ]);
                            } else {
                                return response()->json([
                                    'error' => 'Promo Code Use Duration Expires.'
                                ], 404);
                            }
                        } else { // limit
                            return response()->json([
                                'error' => 'Promo Code Limit Expires.',
                            ], 404);
                        }
                    } else {
                        return response()->json([
                            'error' => 'User not found in the list.'
                        ], 404);
                    }
                } else {
                    return response()->json([
                        'error' => 'Service not found in the list.'
                    ], 404);
                }
            }
            
        } else {
            return response()->json([
                'error' => 'Promo Code Not Valid.'
            ], 404);
        }
    }
}