<?php

namespace Modules\PromoCodes\Listeners;

use App\Models\AppointmentPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Modules\PromoCodes\Entities\PromoCode;
use Modules\PromoCodes\Events\FlexibleHoursCount;

class StoreAppointmentPaymentData
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
    public function handle($event)
    {
        $service = $event->service;
        $request = $event->request;
        
        if(module_is_active('PromoCodes', $service->created_by) && $request['promo_code_id'] != null){
            $appointment_payment = $event->appointment_payment;
            $promo_code = $request['promo_code_id'];
            $promoCode = PromoCode::find($promo_code);

            $service_amount = $service->price;

            $flexible_price = event(new FlexibleHoursCount($request['service'], $request['staff'], $request['appointment_date'], $request['duration']));

            if($flexible_price != null && module_is_active('FlexibleHours', $service->created_by)){
                $service_amount = $flexible_price[0];
            }
            
            if($promoCode->discount_type == 1){
                $amount = $service_amount * $promoCode->discount_percentage / 100;
            } else {
                $amount = $service_amount - $promoCode->flat_rate;
            }
            
            $payment = AppointmentPayment::find($appointment_payment->id);

            $after_promo_price = $service_amount - $amount;
            
            $payment->update([
                'coupon_amount' => $amount,
                'final_amount' => $after_promo_price,
                'promo_code_id' => $promoCode->id,
            ]);
        }
    }
}
