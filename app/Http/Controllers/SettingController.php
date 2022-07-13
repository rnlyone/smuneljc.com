<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        $pagetitle = "Pengaturan";
        return view('auth.setting', [
            'pagetitle' => $pagetitle,
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
        $request->validate([
            "KodeDaftar" => 'required',
            "PesanDefault" => 'required',
        ]);

        try {
            $kode = Setting::find(8);
            $kode->Value = $request->KodeDaftar;
            $kode->save();

            $pesan = Setting::find(9);
            $pesan->Value = $request->PesanDefault;
            $pesan->save();

            return back()->with('success', 'Pengaturan Berhasil Disimpan');
        } catch (\Throwable $th) {
            return back()->with('success', 'Ada Yang Salah');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $kode1 = Setting::find(1);
            $kode1->Value = $request->P1;
            $kode1->save();

            $kode2 = Setting::find(2);
            $kode2->Value = $request->P2;
            $kode2->save();

            $kode3 = Setting::find(3);
            $kode3->Value = $request->P3;
            $kode3->save();

            $kode4 = Setting::find(4);
            $kode4->Value = $request->P4;
            $kode4->save();

            $kode5 = Setting::find(5);
            $kode5->Value = $request->P5;
            $kode5->save();

            $kode6 = Setting::find(6);
            $kode6->Value = $request->P6;
            $kode6->save();

            $kode7 = Setting::find(7);
            $kode7->Value = $request->P7;
            $kode7->save();

            return back()->with('success', 'Pengaturan Berhasil Disimpan');
        } catch (\Throwable $th) {
            return back()->with('success', 'Ada Yang Salah'.$th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
