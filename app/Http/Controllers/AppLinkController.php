<?php

namespace App\Http\Controllers;

use App\Models\AppLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppLinkController extends Controller
{
    public function index()
    {
        $title = 'App Link';
        $apps = AppLink::all();

        return view('app.index', [
            'title' => $title,
            'apps' => $apps
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $slug = Str::slug($request->get('name'), '-');
        $data = $request->all();
        $data['slug'] = $slug;
        $appSave = AppLink::create($data);

        if ($appSave) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been submited!');
            return redirect()->route('app-link-index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Your Post not submited!');
            return redirect()->route('app-link-index');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $dataApp = AppLink::find($id);
        $slug = Str::slug($request->get('name'), '-');

        if ($dataApp->update([
            'name' => $request->name,
            'url' => $request->url,
            'slug' => $slug,
            'color' => $request->color,
        ])) {
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been edited!');
            return redirect()->route('app-link-index');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Failed to edit your Post');
            return redirect()->route('app-link-index');
        }
    }

    public function delete($id, Request $request)
    {
        $appLink = AppLink::find($id);

        if ($appLink) {
            $appLink->delete();
            toastr()->closeOnHover(true)->closeDuration(10)->success('Your Post as been deleted!');
        } else {
            toastr()->closeOnHover(true)->closeDuration(10)->error('Failed to delete your Post');
        }

        return redirect()->route('app-link-index');
    }
}
