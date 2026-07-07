<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:255',
            'peran'      => 'required|string|max:255',
            'kutipan'    => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_path')) {
            $file     = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dest     = public_path('images/testimonial');
            if (!file_exists($dest)) {
                mkdir($dest, 0755, true);
            }
            $file->move($dest, $filename);
            $imagePath = 'images/testimonial/' . $filename;
        }

        Testimonial::create([
            'nama'       => $request->nama,
            'peran'      => $request->peran,
            'kutipan'    => $request->kutipan,
            'image_path' => $imagePath,
        ]);

        return back()->with('testimonial_success', 'Testimoni dari "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:255',
            'peran'      => 'required|string|max:255',
            'kutipan'    => 'required|string',
            'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:3072',
        ]);

        if ($request->hasFile('image_path')) {
            $file     = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $dest     = public_path('images/testimonial');
            if (!file_exists($dest)) {
                mkdir($dest, 0755, true);
            }
            $file->move($dest, $filename);
            $testimonial->image_path = 'images/testimonial/' . $filename;
        }

        $testimonial->nama    = $request->nama;
        $testimonial->peran   = $request->peran;
        $testimonial->kutipan = $request->kutipan;
        $testimonial->save();

        return back()->with('testimonial_success', 'Testimoni berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $nama        = $testimonial->nama;
        $testimonial->delete();
        return back()->with('testimonial_success', 'Testimoni dari "' . $nama . '" berhasil dihapus.');
    }
}
