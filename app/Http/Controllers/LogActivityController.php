<?php

namespace App\Http\Controllers;

use App\Exports\LogExport;
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
                              ->paginate(10);
        return view('modul.logactivity', compact('activities'));
    }

    public function export_excel()
	{
		return Excel::download(new LogExport, 'siswa.xlsx');
        
	}
}
