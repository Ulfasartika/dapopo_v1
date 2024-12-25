<?php

namespace App\Http\Controllers;

use App\Exports\LogActivityExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
{
    if (Auth::user()->role == 'user') {
        return redirect('/')->with('error', 'You do not have access to this page.');
    }
    
    $activities = Activity::with(['causer'])
                          ->latest()
                          ->get(); 
    
    return view('modul.logactivity', compact('activities'));
}
}
