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
use Modules\WhatsAppMessenger\Http\Controllers\WhatsAppMessengerController;

Route::prefix('whatsappmessenger')->group(function() {
    Route::get('/', 'WhatsAppMessengerController@index');
});

Route::group(['middleware' => 'PlanModuleCheck:WhatsAppMessenger'], function ()
{
    Route::prefix('whatsappmessenger')->group(function() {
        Route::post('/setting/store', [WhatsAppMessengerController::class,'setting'])->name('whatsappmessenger.setting.store')->middleware(['auth']);
    });
});
