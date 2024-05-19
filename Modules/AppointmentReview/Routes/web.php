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
use Modules\AppointmentReview\Http\Controllers\AppointmentReviewController;

Route::group(['middleware' => 'PlanModuleCheck:AppointmentReview'], function () {
    Route::prefix('appointmentreview')->group(function () {
        Route::post('/setting/store', [AppointmentReviewController::class, 'setting'])->name('appointment.review.setting');
        Route::post('/status/store', [AppointmentReviewController::class, 'reviewStatusSetting'])->name('review.status.setting');
    });
});
Route::get('review/{slug}/{appointment?}', [AppointmentReviewController::class, 'appointmentReview'])->name('appointment.review');
Route::post('appointment-review/{id}', [AppointmentReviewController::class, 'reviewStore'])->name('review.store');