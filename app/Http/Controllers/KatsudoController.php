<?php

namespace App\Http\Controllers;

use App\Models\Katsudo;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatsudoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Profile',
                     'customcss' => $customcss,
                     'pagetitle' => 'Profile',
                     'navactive' => 'usernav',
                     'previous' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        return view('katsudo.auth.profile', [
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
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
     * @param  \App\Models\Katsudo  $katsudo
     * @return \Illuminate\Http\Response
     */
    public function show(Katsudo $katsudo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Katsudo  $katsudo
     * @return \Illuminate\Http\Response
     */
    public function edit(Katsudo $katsudo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Katsudo  $katsudo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Katsudo $katsudo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Katsudo  $katsudo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Katsudo $katsudo)
    {
        //
    }
}
