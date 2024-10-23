<?php

namespace App\Http\Controllers;

use App\Models\Rectifier;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        $data_apr = $this->chartApr();
        // $data_battery = $this->chartBattery();
        // $data_backup_time = $this->chartBackupTime();
        // $data_site = $this->chartSite();
        $totalRectifier = Rectifier::count();
        $power_distribution = [
            '7_7_kva' => Rectifier::where('daya', 7.7)->count(),    
            '10_5_kva' => Rectifier::where('daya', 10.5)->count(),         
            '13_2_kva' => Rectifier::where('daya', 13.2)->count(),           
            '16_5_kva' => Rectifier::where('daya', 16.5)->count(),          
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

    public function chartApr()
    {
        $totalRectifier = Rectifier::count();

        $apr_distribution = [
            '1_mod_apr' => Rectifier::where('apr_quantity', 1)->count(),    
            '2_mod_apr' => Rectifier::where('apr_quantity', 2)->count(),         
            '3_mod_apr' => Rectifier::where('apr_quantity', 3)->count(),           
            '4_mod_apr' => Rectifier::where('apr_quantity', 4)->count(),          
            '5_mod_apr' => Rectifier::where('apr_quantity', 5)->count(),          
            '6_mod_apr' => Rectifier::where('apr_quantity', 6)->count(),          
            'more_than_6_mod_apr' => Rectifier::where('apr_quantity', '>', 6)->count()
        ];

        $apr_percent = [];
        foreach ($apr_distribution as $key => $count) {
            $apr_percent[$key] = $totalRectifier > 0 ? ($count / $totalRectifier) * 100 : 0;
        }
        return view('modul.index', compact('apr_distribution', 'apr_percent'));
    }
}
