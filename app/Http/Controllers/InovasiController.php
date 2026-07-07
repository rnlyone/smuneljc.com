<?php

namespace App\Http\Controllers;

use App\Models\Inovasi;
use App\Models\Setting;
use Illuminate\Http\Request;

class InovasiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'subjudul'   => 'nullable|string|max:255',
            'link'       => 'nullable|url|max:500',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_link' => 'nullable|url|max:500',
            'urutan'     => 'required|integer|min:0',
        ]);

        $file     = $request->file('image_path');
        $filename = time() . '_' . $file->getClientOriginalName();
        $dest     = public_path('images/inovasi');
        if (!file_exists($dest)) {
            mkdir($dest, 0755, true);
        }
        $file->move($dest, $filename);

        Inovasi::create([
            'judul'      => $request->judul,
            'subjudul'   => $request->subjudul,
            'link'       => $request->link,
            'image_path' => 'images/inovasi/' . $filename,
            'video_link' => $request->video_link,
            'urutan'     => $request->urutan,
        ]);

        return back()->with('inovasi_success', 'Inovasi "' . $request->judul . '" berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $inovasi = Inovasi::findOrFail($id);

        $request->validate([
            'judul'      => 'required|string|max:255',
            'subjudul'   => 'nullable|string|max:255',
            'link'       => 'nullable|url|max:500',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'video_link' => 'nullable|url|max:500',
            'urutan'     => 'required|integer|min:0',
        ]);

        if ($request->hasFile('image_path')) {
            $file     = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dest     = public_path('images/inovasi');
            if (!file_exists($dest)) {
                mkdir($dest, 0755, true);
            }
            $file->move($dest, $filename);
            $inovasi->image_path = 'images/inovasi/' . $filename;
        }

        $inovasi->judul      = $request->judul;
        $inovasi->subjudul   = $request->subjudul;
        $inovasi->link       = $request->link;
        $inovasi->video_link = $request->video_link;
        $inovasi->urutan     = $request->urutan;
        $inovasi->save();

        return back()->with('inovasi_success', 'Inovasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $inovasi = Inovasi::findOrFail($id);
        $judul   = $inovasi->judul;
        $inovasi->delete();
        return back()->with('inovasi_success', 'Inovasi "' . $judul . '" berhasil dihapus.');
    }
}
