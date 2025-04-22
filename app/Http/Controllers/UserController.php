<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $title = 'User Account';
        $userAccounts = User::all();

        return view('users.account.index', [
            'title' => $title,
            'userAccounts' => $userAccounts
        ]);
    }

    public function create()
    {
        $title = 'User Account - Create';

        return view('users.account.create', [
            'title' => $title,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'dept' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'min:16',
                'regex:/[A-Z]/',      // Minimal satu huruf kapital
                'regex:/[0-9]/',      // Minimal satu angka
                'regex:/[@$!%*#?&]/', // Minimal satu karakter spesial
            ],
            're-password' => 'required|same:password',
        ], [
            'password.min' => 'Password harus minimal 16 karakter.',
            'password.regex' => 'Password harus mengandung minimal satu huruf kapital, satu angka, dan satu karakter spesial (!@#$%^&*).',
            're-password.same' => 'Password dan Re-enter Password harus sama.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $userSave = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'status' => $request->status,
            'dept' => $request->dept,
            'jabatan' => $request->jabatan,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($userSave) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been submited!');
            return redirect()->route('user-account-index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Your Post not submited!');
            return redirect()->route('user-account-index');
        }
    }

    public function edit()
    {
        $title = 'User Account - Update';

        return view('users.account.update', [
            'title' => $title,
        ]);
    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
