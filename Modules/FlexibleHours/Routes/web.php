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
use Modules\FlexibleHours\Http\Controllers\FlexibleHoursController;

Route::group(['middleware' => 'PlanModuleCheck:FlexibleHours'], function ()
{
    Route::get('/flexible-hour/{id}', [FlexibleHoursController::class,'serviceList'])->name('flexible.hour.view')->middleware(['auth',]);
    Route::get('/flexible-hour/add/{id}/{staff_id}', [FlexibleHoursController::class,'create'])->name('flexible.hour.add')->middleware(['auth',]);
    Route::post('flexible-hour/store',  [FlexibleHoursController::class,'store'])->name('flexible.hour.store')->middleware(['auth',]);
    Route::get('flexible-hour/edit/{id}',  [FlexibleHoursController::class,'edit'])->name('flexible.hour.edit')->middleware(['auth',]);
    Route::put('flexible-hour/update/{id}',  [FlexibleHoursController::class,'update'])->name('flexible.hour.update')->middleware(['auth',]);
    Route::delete('flexible-hour/delete/{id}',  [FlexibleHoursController::class,'destroy'])->name('flexible.hour.delete')->middleware(['auth',]);
    
});
Route::get('/flexible-price', [FlexibleHoursController::class,'flexiblePriceGet'])->name('flexible.price');


