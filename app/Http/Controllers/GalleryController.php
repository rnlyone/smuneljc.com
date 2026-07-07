<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $pagetitle = 'Galeri';
        $galeri = Gallery::latest()->get();
        $settings = Setting::all();
        return view('auth.galeri', compact('pagetitle', 'galeri', 'settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Author'   => 'required|string|max:255',
            'Title'    => 'required|string|max:255',
            'Category' => 'required|string|max:100',
            'ImagePath' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $file     = $request->file('ImagePath');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('gallery'), $filename);

        Gallery::create([
            'Author'    => $request->Author,
            'Title'     => $request->Title,
            'Category'  => $request->Category,
            'ImagePath' => 'gallery/' . $filename,
        ]);

        return back()->with('success', 'Karya "' . $request->Title . '" berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'Author'    => 'required|string|max:255',
            'Title'     => 'required|string|max:255',
            'Category'  => 'required|string|max:100',
            'ImagePath' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        if ($request->hasFile('ImagePath')) {
            $file     = $request->file('ImagePath');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('gallery'), $filename);
            $gallery->ImagePath = 'gallery/' . $filename;
        }

        $gallery->Author   = $request->Author;
        $gallery->Title    = $request->Title;
        $gallery->Category = $request->Category;
        $gallery->save();

        return back()->with('success', 'Karya berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $judul   = $gallery->Title;
        $gallery->delete();
        return back()->with('success', 'Karya "' . $judul . '" berhasil dihapus.');
    }
}
