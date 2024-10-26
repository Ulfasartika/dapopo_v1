<?php

use App\Http\Controllers\RectifierController;
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

Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('modul.index');
    });

    Route::resource('/equipment', \App\Http\Controllers\EquipmentController::class);
    Route::resource('/site', \App\Http\Controllers\SiteController::class);

    Route::resource('/rectifier', RectifierController::class);
});
