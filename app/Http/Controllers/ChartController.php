<?php

namespace App\Http\Controllers;

use App\Models\Rectifier;
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
        $jumlahBateraiData = Rectifier::select('battery_quantity', DB::raw('count(*) as total'))
            ->groupBy('battery_quantity')
            ->get();

        $totalBaterai = Rectifier::count();

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
        $chartBackupTime = $batteryBackupTime->map(function($item) use ($totalBackupTime){
            return[
                'name' => $item->backup_time . ' Hour',
                'y' => $totalBackupTime > 0 ? ($item->total/ $totalBackupTime) * 100:0
            ];
        });

        return view('modul.index', [
            'chartData' => $chartData->toArray(),
            'chartDataApr' => $chartDataApr->toArray(),
            'chartDataBaterai'=>$chartDataBaterai->toArray(),
            'chartBackupTime' =>$chartBackupTime->toArray()
        ]);
    }
}
