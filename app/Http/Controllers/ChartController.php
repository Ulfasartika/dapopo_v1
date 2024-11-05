<?php

namespace App\Http\Controllers;

use App\Models\Battery;
use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
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

        //chart2
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

        //chart3
        $jumlahBateraiData = Battery::select('battery_quantity', DB::raw('count(*) as total'))
            ->groupBy('battery_quantity')
            ->get();

        // Menghitung total semua baterai
        $totalBaterai = Battery::count();

        // Menghitung persentase dan membentuk data chart
        $chartDataBaterai = $jumlahBateraiData->map(function ($item) use ($totalBaterai) {
            return [
                'name' => $item->battery_quantity . ' Battery',
                'y' => $totalBaterai > 0 ? ($item->total / $totalBaterai) * 100 : 0
            ];
        });

        //chart4
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

        //chart5

        $sites = Site::select(
            'areas.id as area_id',
            'areas.area as area_name',
            DB::raw('COUNT(sites.id) as total_sites'),
            DB::raw('SUM(CASE WHEN recti_site.rectifier_id IS NOT NULL THEN 1 ELSE 0 END) as filled_sites'),
            DB::raw('SUM(CASE WHEN recti_site.rectifier_id IS NULL THEN 1 ELSE 0 END) as unfilled_sites')
        )
            ->leftJoin('recti_site', 'sites.id', '=', 'recti_site.site_id')
            ->leftJoin('area_site', 'sites.id', '=', 'area_site.site_id')
            ->leftJoin('areas', 'area_site.area_id', '=', 'areas.id')
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

        return view('modul.index', [
            'chartData' => $chartData->toArray(),
            'chartDataApr' => $chartDataApr->toArray(),
            'chartDataBaterai' => $chartDataBaterai->toArray(),
            'chartBackupTime' => $chartBackupTime->toArray(),
            'chartDataSite' => $chartDataSite->toArray()
        ]);
    }
}
