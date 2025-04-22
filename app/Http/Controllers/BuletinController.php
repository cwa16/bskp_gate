<?php

namespace App\Http\Controllers;

use App\Models\Buletin;
use Illuminate\Http\Request;

class BuletinController extends Controller
{
    public function index()
    {
        $title = 'Buletin';

        $buletins = Buletin::all();

        return view('buletin.index', [
            'title' => $title,
            'buletins' => $buletins
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'uploader' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:20480',
        ]);

        $file = $request->file('file');
        $encryptedName = hash('sha256', $file->getClientOriginalName() . now()->timestamp) . '.' . $file->getClientOriginalExtension();

        $filePath = $file->storeAs('buletins', $encryptedName, 'public');

        $buletin = new Buletin();
        $buletin->judul = $request->judul;
        $buletin->uploader = $request->uploader;
        $buletin->file = $filePath;
        $buletin->save();

        if ($buletin) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Data berhasil ditambahkan!');
            return redirect()->route('buletin.index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Data tidak berhasil ditambahkan!');
            return redirect()->route('buletin.index');
        }
    }
}
