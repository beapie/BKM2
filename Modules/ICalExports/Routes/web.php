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
use Modules\ICalExports\Http\Controllers\ICalExportsController;
use Modules\Mailchimp\Http\Controllers\MailchimpController;

Route::group(['middleware' => 'PlanModuleCheck:icalexports'], function () {
});
Route::prefix('icalexports')->group(function () {
    Route::get('/appointments/{slug}/{appointment?}', [ICalExportsController::class, 'index'])->name('icalexport');
});