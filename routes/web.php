<?php

use App\Exports\LogActivityExport;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\RectifierController;
use App\Http\Controllers\LogActivityController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
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
    Route::resource('equipment', EquipmentController::class);
    Route::resource('site', SiteController::class);
    Route::resource('rectifier', RectifierController::class);
    Route::resource('area', AreaController::class);
    Route::resource('user', UserController::class);
    Route::get('/api/site/{id}/rectifiers-count', [RectifierController::class, 'getRectifierCount']);
    Route::get('/logactivity', [LogActivityController::class, 'index'])->name('logactivity.index');
    Route::get('rectifiers/export', [RectifierController::class, 'export'])->name('rectifiers.export');
    Route::get('logactivity/export', [LogActivityController::class, 'export'])->name('logactivity.export');
});