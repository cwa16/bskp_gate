<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use Illuminate\Http\Request;
use DB;

class ActivityLogController extends Controller
{
    public function index()
    {
        $title = 'Activity Log';
        $logActs = DB::table('log_activities')
            ->join('users', 'log_activities.nik', '=', 'users.nik')
            ->select('users.name', 'users.dept', 'log_activities.*')
            ->orderBy('log_activities.created_at', 'desc')
            ->get();

        return view('activity-log.index', [
            'title' => $title,
            'logActs' => $logActs
        ]);
    }
}
