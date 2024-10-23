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

        return view('modul.index', [
            'chartData' => $chartData->toArray(),
            'chartDataApr' => $chartDataApr->toArray()
        ]);    }
}
