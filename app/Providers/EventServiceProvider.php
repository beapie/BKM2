<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Modules\Stripe\Events\StripePaymentStatus;
use App\Listeners\AppointmentPaymentLis;
use Modules\Paypal\Events\PaypalPaymentStatus;
use Modules\Photography\Listeners\PhotographyDefaultDataLis;
use Modules\Mollie\Events\MolliePaymentStatus;

use Modules\Skrill\Events\SkrillPaymentStatus;
use Modules\Paddle\Events\PaddlePaymentStatus;
use Modules\Paystack\Events\PaystackPaymentStatus;
use Modules\MercadoPago\Events\MercadoPagoPaymentStatus;
use Modules\Coingate\Events\CoingatePaymentStatus;
use Modules\Flutterwave\Events\FlutterwavePaymentStatus;
use Modules\Paytab\Events\PaytabPaymentStatus;
use Modules\Razorpay\Events\RazorpayPaymentStatus;
use Modules\Razorpay\Http\Controllers\RazorpayController;


class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        StripePaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        PaypalPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        MolliePaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        RazorpayPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        SkrillPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        PaddlePaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        MercadoPagoPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        PaystackPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        CoingatePaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        PaytabPaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
        FlutterwavePaymentStatus::class => [
            AppointmentPaymentLis::class
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
