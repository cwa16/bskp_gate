<?php

namespace App\Http\Controllers;

use App\Models\RecentActivity;
use Illuminate\Http\Request;

use DB;

class RecentActivityController extends Controller
{
    public function index()
    {
        $title = 'Recent Activity';
        $recentActivies = RecentActivity::all();

        $recentActivies = DB::table('recent_activities')
            ->join('log_activities', 'log_activities.nik', '=', 'recent_activities.nik')
            ->join('app_links', 'app_links.id', '=', 'recent_activities.apps_id')
            ->select(
                'recent_activities.*',
                'app_links.name as appsName',
                'log_activities.ip_address',
                'log_activities.login_at',
                'log_activities.logout_at',
            )
            ->get();

        return view('recent-activities.index', [
            'title' => $title,
            'recentActivies' => $recentActivies
        ]);
    }
}
