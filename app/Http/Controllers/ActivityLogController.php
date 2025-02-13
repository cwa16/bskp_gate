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

    public function detail($id)
    {
        $title = 'Activity Log - Detail';

        $logActsDetails = DB::table('log_activity_details')
            ->join('app_links', 'app_links.id', '=', 'log_activity_details.accessing_app')
            ->join('log_activities', 'log_activities.id', '=', 'log_activity_details.activity_log_id')
            ->select(
                'app_links.name',
                'log_activity_details.accessing_at',
                'log_activity_details.accessing_until',
            )
            ->where('log_activities.id', $id)
            ->get();

        return view('activity-log.detail', [
            'title' => $title,
            'logActsDetails' => $logActsDetails
        ]);
    }
}
