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
    
        return view('modul.index', [
            'chartData' => $chartData->toArray()
        ]);
    }
    }
