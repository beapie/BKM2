<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Stripe\Http\Controllers\StripeController;

Route::prefix('stripe')->group(function() {
    Route::get('/', 'StripeController@index');
});

Route::group(['middleware' => 'PlanModuleCheck:Stripe'], function ()
{
    Route::prefix('stripe')->group(function() {
        Route::post('/setting/store', [StripeController::class,'setting'])->name('stripe.setting.store')->middleware(['auth']);
    });
});

Route::post('/appointment-pay-with-stripe', [StripeController::class, 'appointmentPayWithStripe'])->name('appointment.pay.with.stripe');
Route::get('/appointment/stripe/status/{slug}', [StripeController::class, 'getAppointmentPaymentStatus'])->name('appointment.stripe.status');

Route::post('plan-pay-with/stripe', [StripeController::class, 'planPayWithStripe'])->name('plan.pay.with.stripe');
Route::get('plan-get-payment-status/', [StripeController::class, 'planGetStripeStatus'])->name('plan.get.payment.status');



