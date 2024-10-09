<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('modul.index');
});

Route::resource('/battery', \App\Http\Controllers\BatteryController::class);
Route::resource('/battery_type', \App\Http\Controllers\BatteryTypeController::class);
Route::resource('/kwh', \App\Http\Controllers\KwhController::class);
Route::resource('/equipment', \App\Http\Controllers\EquipmentController::class);
Route::resource('/site', \App\Http\Controllers\SiteController::class);
Route::resource('/rectifier', \App\Http\Controllers\RectifierController::class);





