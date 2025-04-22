<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $title = 'News';
        return view('activity-log.index', [
            'title' => $title
        ]);
    }
}
