<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Pengurus;
use App\Models\Setting;
use Illuminate\Http\Request;

class PengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle = 'Detail Pengurus';
        $pengurus = Pengurus::all();
        $settings = Setting::all();
        return view('auth.pengurus', [
            'pagetitle' => $pagetitle,
            'pengurus' => $pengurus,
            'settings' => $settings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function show(Pengurus $pengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function edit($pengurus)
    {
        $orang = Pengurus::find($pengurus);
        $pagetitle = 'Detail Pengurus';
        $settings = Setting::all();
        return view('auth.detail.pengurus', [
            'pagetitle' => $pagetitle,
            'orang' => $orang,
            'settings' => $settings
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $pengurus)
    {
        $p = Pengurus::find($pengurus);
        $request->validate([
            'NamaLengkap' => 'required|string|max:255',
            'ImagePath' => 'nullable|mimes:jpeg,png,jpg,gif,svg|dimensions:max_width=1100,max_height=1100',
            'LinkedIn' => 'nullable|string|max:255',
            'Discord' => 'nullable|string|max:255',
            'Instagram' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('ImagePath')) {
            $file = $request->file('ImagePath');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            $file->move($destinationPath, $filename);
            $p->ImagePath = 'images/' . $filename;
        }

        $p->NamaLengkap = $request->NamaLengkap;
        $p->LinkedIn = $request->LinkedIn;
        $p->Discord = $request->Discord;
        $p->Instagram = $request->Instagram;

        $p->save();

        return redirect()->route('pengurus.index')->with('success', 'Pengurus updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengurus  $pengurus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengurus $pengurus)
    {
        //
    }
}
