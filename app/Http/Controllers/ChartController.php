<?php

namespace App\Http\Controllers;

use App\Models\DetailBattery;
use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        // Chart 1: Persentase daya berdasarkan Rectifier
        $rectifiers = Rectifier::select('daya', DB::raw('count(*) as total'))
            ->groupBy('daya')
            ->get();

        $totalRectifiers = Rectifier::count();

        $chartData = $rectifiers->map(function ($item) use ($totalRectifiers) {
            return [
                'name' => $item->daya . ' kVA',
                'y' => $totalRectifiers > 0 ? ($item->total / $totalRectifiers) * 100 : 0
            ];
        });

        // Chart 2: Persentase jumlah Modul APR
        $modulAprData = Rectifier::select('apr_quantity', DB::raw('count(*) as total'))
            ->groupBy('apr_quantity')
            ->get();

        $totalModulApr = Rectifier::count();

        $chartDataApr = $modulAprData->map(function ($item) use ($totalModulApr) {
            return [
                'name' => $item->apr_quantity . ' Modul APR',
                'y' => $totalModulApr > 0 ? ($item->total / $totalModulApr) * 100 : 0
            ];
        });

        // Chart 3: Persentase jumlah Battery dari DetailBattery
        $jumlahBateraiData = DetailBattery::select('battery_quantity', DB::raw('count(*) as total'))
            ->groupBy('battery_quantity')
            ->get();

        $totalBaterai = DetailBattery::count();

        $chartDataBaterai = $jumlahBateraiData->map(function ($item) use ($totalBaterai) {
            return [
                'name' => $item->battery_quantity . ' Battery',
                'y' => $totalBaterai > 0 ? ($item->total / $totalBaterai) * 100 : 0
            ];
        });

        // Chart 4: Persentase Backup Time
        $batteryBackupTime = Rectifier::select('backup_time', DB::raw('count(*) as total'))
            ->groupBy('backup_time')
            ->get();

        $totalBackupTime = Rectifier::count();

        $chartBackupTime = $batteryBackupTime->map(function ($item) use ($totalBackupTime) {
            return [
                'name' => $item->backup_time . ' Hour',
                'y' => $totalBackupTime > 0 ? ($item->total / $totalBackupTime) * 100 : 0
            ];
        });

        // Chart 5: Site data for filled and unfilled based on area
        $sites = Site::select(
            'areas.id as area_id',
            'areas.area as area_name',
            DB::raw('COUNT(sites.id) as total_sites'),
            DB::raw('SUM(CASE WHEN rectifiers.id IS NOT NULL THEN 1 ELSE 0 END) as filled_sites'),
            DB::raw('SUM(CASE WHEN rectifiers.id IS NULL THEN 1 ELSE 0 END) as unfilled_sites')
        )
            ->leftJoin('rectifiers', 'sites.id', '=', 'rectifiers.id_site')
            ->leftJoin('areas', 'sites.area_id', '=', 'areas.id')
            ->groupBy('areas.id', 'areas.area')
            ->get();

        $chartDataSite = $sites->map(function ($site) {
            return [
                'area_id' => $site->area_id,
                'area_name' => $site->area_name,
                'filled' => $site->filled_sites,
                'unfilled' => $site->unfilled_sites
            ];
        });

        $activityData = DB::table('activity_log')
        ->join('users', 'activity_log.causer_id', '=', 'users.id')
        ->select('users.name as user_name', 'causer_id as user_id',
                 DB::raw('SUM(description LIKE "%created%") as submit_count'),
                 DB::raw('SUM(description LIKE "%updated%") as update_count'))
        ->where('log_name', 'rectifier')
        ->groupBy('causer_id', 'users.name')
        ->get();
    
    $chartDataActivity = $activityData->map(function ($item) {
        return [
            'name' => $item->user_name,
            'submit' => (int) $item->submit_count,
            'update' => (int) $item->update_count,
        ];
    });
    

        return view('modul.index', [
            'chartData' => $chartData->toArray(),
            'chartDataApr' => $chartDataApr->toArray(),
            'chartDataBaterai' => $chartDataBaterai->toArray(),
            'chartBackupTime' => $chartBackupTime->toArray(),
            'chartDataSite' => $chartDataSite->toArray(),
            'chartDataActivity' => $chartDataActivity->toArray()
        ]);
    }
}
