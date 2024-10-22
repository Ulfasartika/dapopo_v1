<?php

namespace App\Http\Controllers;

use App\Models\Rectifier;
use App\Models\Site;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $totalSites = Site::count();
        // Distribusi KWH berdasarkan daya
        $power_distribution = [
            '7_7_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 7.7);
            })->count(),
            
            '10_5_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 10.5);
            })->count(),
            
            '13_2_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 13.2);
            })->count(),
            
            '16_5_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 16.5);
            })->count(),
            
            '23_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 23);
            })->count(),
            
            '33_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', 33);
            })->count(),
            
            'more_than_33_kva' => Site::whereHas('rectifiers', function($query) {
                $query->where('daya', '>', 33);
            })->count(),
        ];

        // Persentase distribusi
        $power_percent = [];
        foreach ($power_distribution as $key => $count) {
            $power_percent[$key] = $totalSites > 0 ? ($count / $totalSites) * 100 : 0;
        }
        return view('modul.index', compact('power_distribution', 'power_percent'));
    }
}
