<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Setting;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function show(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kehadiran  $kehadiran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kehadiran $kehadiran)
    {
        //
    }

    public function fscan(){
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Scan Katsudo',
                     'customcss' => $customcss,
                     'pagetitle' => 'Scan Katsudo',
                     'navactive' => 'scannav',
                     'previous' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        return view('katsudo.auth.scankatsudo', [
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function scan(){

    }
}
