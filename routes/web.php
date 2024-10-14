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

Route::get('/', function () {
    return view('modul.index');
});

Route::resource('/equipment', \App\Http\Controllers\EquipmentController::class);
Route::resource('/site', \App\Http\Controllers\SiteController::class);
Route::controller(RectifierController::class)->group(function () {
    Route::get('rectifier','index')->name('rectifier.index');
    Route::get('rectifier/create-step-one','createStepOne')->name('rectifier.create.step.one');
    Route::post('rectifier/create-step-one','postCreateStepOne')->name('rectifier.create.step.one.post');
    Route::get('rectifier/create-step-two','createStepTwo')->name('rectifier.create.step.two');
    Route::post('rectifier/create-step-two','postCreateStepTwo')->name('rectifier.create.step.two.post');
    Route::get('rectifier/create-step-three','createStepThree')->name('rectifier.create.step.three');
    Route::post('rectifier/create-step-three','postCreateStepThree')->name('rectifier.create.step.three.post');
});




