<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Setting;
use Illuminate\Http\Request;

class ActivityController extends Controller
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
        $settings = ['title' => ': Aktifitas',
                     'customcss' => $customcss,
                     'pagetitle' => 'Aktifitas',
                     'navactive' => '',
                     'previous' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        return view('katsudo.auth.activity', [
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
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
