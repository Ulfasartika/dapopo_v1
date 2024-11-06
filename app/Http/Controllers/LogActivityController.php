<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class LogActivityController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', 'You do not have access to this page.');
        }
    
        $activities = Activity::latest()->paginate(10);
        return view('modul.logactivity', compact('activities'));
    }
}
