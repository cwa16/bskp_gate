<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainAppController extends Controller
{
    public function index()
    {
        $title = 'Dashboard';

        return view('dashboard', [
            'title' =>$title
        ]);

        // return view('dashboard', compact('title'));
    }
}
