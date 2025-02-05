<?php

namespace App\Http\Controllers;

use App\Models\AppLink;
use App\Models\Buletin;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'BSKP GATE';

        // $user = Auth::user();
        // dd($user);

        $token = session('jwt_token');

        $links = AppLink::all()->sortBy('name');
        $buletins = Buletin::all();
        $recentActivies = DB::table('recent_activities')
            ->join('log_activities', 'log_activities.nik', '=', 'recent_activities.nik')
            ->join('app_links', 'app_links.id', '=', 'recent_activities.apps_id')
            ->select(
                'recent_activities.*',
                'app_links.name as appsName',
                'app_links.id',
                'log_activities.ip_address',
                'log_activities.login_at',
                'log_activities.logout_at',
            )
            ->offset(0)
            ->limit(5)
            ->get();

            // dd($recentActivies);

        return view('dashboard', [
            'title' => $title,
            'links' => $links,
            'recentActivies' => $recentActivies,
            'buletins' => $buletins,
            'token' => $token
        ]);
    }

    public function accessApp($appId)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah aplikasi ada di tabel app_links
        $app = DB::table('app_links')->where('id', $appId)->first();
        if (!$app) {
            return response()->json(['error' => 'Aplikasi tidak ditemukan'], 404);
        }

        // Ambil role dari tabel role_apps
        $role = DB::table('role_apps')
            ->where('user_id', $user->id)
            ->where('app_id', $appId)
            ->value('role');

        if (!$role) {
            return response()->json(['error' => 'Anda tidak memiliki akses ke aplikasi ini'], 403);
        }

        // Ambil token dari session
        $token = session('jwt_token');
        if (!$token) {
            return response()->json(['error' => 'Token tidak ditemukan, silakan login ulang'], 401);
        }

        // dd($user, $appId, $app, $role, $token);

        // Redirect ke aplikasi dengan token dan role
        return redirect()->away("{$app->url}?token={$token}&role={$role}&nik={$user->nik}&dept={$user->dept}&jabatan={$user->jabatan}");
    }
}
