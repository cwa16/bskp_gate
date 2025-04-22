<?php

namespace App\Http\Controllers;

use App\Models\AppLink;
use App\Models\RoleApp;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class RoleAppController extends Controller
{
    public function index()
    {
        $title = 'User Account';
        $roles = DB::table('role_apps')
            ->join('users', 'role_apps.user_id', '=', 'users.id')
            ->join('app_links', 'role_apps.app_id', '=', 'app_links.id')
            ->select(
                'users.id as userid',
                'users.name',
                'users.nik',
                'users.email',
                'app_links.name as appname',
                'role_apps.user_id',
                'role_apps.app_id',
                'role_apps.role',
                'role_apps.id as roleid'
            )
            ->get();
        $listUsersAdd = User::all()->sortBy('name');
        $listAppsAdd = AppLink::all()->sortBy('name');
        $lisUsersUpdate = User::all();
        $listAppsUpdate = AppLink::all();

        return view('users.role.index', [
            'title' => $title,
            'roles' => $roles,
            'listUsersAdd' => $listUsersAdd,
            'listAppsAdd' => $listAppsAdd,
            'lisUsersUpdate' => $lisUsersUpdate,
            'listAppsUpdate' => $listAppsUpdate
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'app_id' => 'required',
            'role' => 'required'
        ]);

        $roleAppSave = RoleApp::create([
            'user_id' => $request->user_id,
            'app_id' => $request->app_id,
            'role' => $request->role,
        ]);

        if ($roleAppSave) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been submited!');
            return redirect()->route('user-role-index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Your Post not submited!');
            return redirect()->route('user-role-index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|string|max:255',
            'app_id' => 'required',
            'role' => 'required'
        ]);

        $dataRole = RoleApp::find($id);

        if ($dataRole->update([
            'user_id' => $request->user_id,
            'app_id' => $request->app_id,
            'role' => $request->role,
        ])) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been edited!');
            return redirect()->route('user-role-index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Failed to edit your Post');
            return redirect()->route('user-role-index');
        }
    }

    public function delete()
    {

    }
}
