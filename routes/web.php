<?php

use App\Http\Controllers\ChartController;
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
  
Route::get('/', [ChartController::class, 'index'])->name('dashboard.index');
Route::get('/dashboard', [ChartController::class, 'index'])->name('dashboard.index');
  
Route::resource('/equipment', \App\Http\Controllers\EquipmentController::class);
Route::resource('/site', \App\Http\Controllers\SiteController::class);
Route::resource('/rectifier', \App\Http\Controllers\RectifierController::class);
Route::resource('/area', \App\Http\Controllers\AreaController::class);
Route::resource('/user', \App\Http\Controllers\UserController::class);
});