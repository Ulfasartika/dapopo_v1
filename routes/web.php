<?php

use App\Exports\RectifierOnlyExport;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\BatteryBrandController;
use App\Http\Controllers\BatteryTypeController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\GensetController;
use App\Http\Controllers\KwhController;
use App\Http\Controllers\RectifierController;
use App\Http\Controllers\LogActivityController;

use App\Http\Controllers\PowerController;

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
    Route::resource('battery_brand', BatteryBrandController::class);
    Route::resource('battery_type', BatteryTypeController::class);
    Route::resource('site', SiteController::class);
    Route::resource('power', PowerController::class);
    Route::resource('rectifier', RectifierController::class);
    Route::resource('genset', GensetController::class);
    Route::resource('kwh', KwhController::class);
    Route::get('kwhs/export', [KwhController::class, 'export'])->name('kwhs.export');
    Route::get('gensets/export', [GensetController::class, 'export'])->name('gensets.export');
    Route::resource('area', AreaController::class);
    Route::resource('user', UserController::class);
    Route::get('/api/site/{id}/rectifiers-count', [RectifierController::class, 'getRectifierCount']);
    Route::get('/logactivity', [LogActivityController::class, 'index'])->name('logactivity.index');
    Route::get('rectifiers/export', [PowerController::class, 'export'])->name('rectifiers.export');
    Route::get('rectifiers/export', [RectifierController::class, 'export'])->name('rectifiers.export');
    Route::put('/rectifier/{id}', [RectifierController::class, 'update']);
    Route::post('site/import', [SiteController::class, 'import_excel'])->name('site.import');

    Route::post('/power/import', [PowerController::class, 'import'])->name('power.import');
    Route::post('/rectifiers/import', [RectifierController::class, 'importExcel'])->name('rectifiers.import');
    Route::post('/genset/import', [GensetController::class, 'importExcel'])->name('gensets.import');
    Route::post('/kwh/import', [KwhController::class, 'importExcel'])->name('kwh.import');
    Route::get('/power/create', [PowerController::class, 'create'])->name('power.create');
    Route::post('/power/store-kwh', [PowerController::class, 'storeKwh'])->name('power.storeKwh');
    Route::post('/power/store-rectifier', [PowerController::class, 'storeRectifier'])->name('power.storeRectifier');
    Route::post('/power/store-genset', [PowerController::class, 'storeGenset'])->name('power.storeGenset');
});
