<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Keaktifan;
use App\Models\Pendaftar;
use App\Models\Periode;
use App\Models\Setting;
use App\Models\Status;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $pagetitle = 'Katsudo Setting';
        $periodes = Periode::orderBy('tahun_mulai', 'desc')->get();
        $statuses = Status::orderBy('level')->get();
        $departemens = Departemen::orderBy('level')->get();
        $settings = Setting::all();

        return view('auth.katsudomenu.katsudosetting', compact(
            'pagetitle', 'periodes', 'statuses', 'departemens', 'settings'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'angkatan' => 'required|string|max:100',
            'tahun_mulai' => 'required|digits:4|integer|min:2000|max:2100',
        ]);

        $exists = Periode::where('tahun_mulai', $request->tahun_mulai)->first();
        if ($exists) {
            return back()->with('periode_error', 'Periode dengan tahun ' . $request->tahun_mulai . ' sudah ada.');
        }

        $periode = Periode::create([
            'angkatan' => $request->angkatan,
            'tahun_mulai' => $request->tahun_mulai,
        ]);

        // Auto-buat Keaktifan untuk semua Pendaftar yang sudah ada
        $pendaftars = Pendaftar::all();
        foreach ($pendaftars as $pendaftar) {
            $alreadyExists = Keaktifan::where('id_anggota', $pendaftar->id)
                ->where('id_periode', $periode->id)
                ->exists();
            if (!$alreadyExists) {
                Keaktifan::create([
                    'id_anggota' => $pendaftar->id,
                    'id_periode' => $periode->id,
                ]);
            }
        }

        return back()->with('periode_success', 'Periode ' . $request->angkatan . ' (' . $request->tahun_mulai . ') berhasil ditambahkan. Kartu keaktifan dibuat untuk ' . $pendaftars->count() . ' anggota.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Periode $periode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Periode $periode)
    {
        //
    }
}
