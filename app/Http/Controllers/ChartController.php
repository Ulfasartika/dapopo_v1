<?php

namespace App\Http\Controllers;

use App\Models\Rectifier;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $totalRectifier = Rectifier::count();

        $power_distribution = [
            '7_7_kva' => Rectifier::where('daya', 7)->count(),    
            '10_5_kva' => Rectifier::where('daya', 10)->count(),         
            '13_2_kva' => Rectifier::where('daya', 13)->count(),           
            '16_5_kva' => Rectifier::where('daya', 16)->count(),          
            '23_kva' => Rectifier::where('daya', 23)->count(),          
            '33_kva' => Rectifier::where('daya', 33)->count(),          
            'more_than_33_kva' => Rectifier::where('daya', '>', 33)->count()
        ];

        $power_percent = [];
        foreach ($power_distribution as $key => $count) {
            $power_percent[$key] = $totalRectifier > 0 ? ($count / $totalRectifier) * 100 : 0;
        }
        return view('modul.index', compact('power_distribution', 'power_percent'));
    }    
}
