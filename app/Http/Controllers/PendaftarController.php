<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Setting;
use Illuminate\Http\Request;

class PendaftarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle = 'Detail Pendaftaran';
        $pendaftars = Pendaftar::all();
        $pesandefault = Setting::where('NamaSetting', 'PesanDefault')->first();
        return view('auth.pendaftar', [
            'pagetitle' => $pagetitle,
            'pendaftars' => $pendaftars,
            'pesandefault' => $pesandefault]);
    }

    public function indexForm()
    {
        $pagetitle = 'Formulir Pendaftaran';
        $pendaftars = Pendaftar::all();
        $settings = Setting::all();
        return view('tamu.daftar', ['pagetitle' => $pagetitle, 'pendaftars' => $pendaftars, 'settings' => $settings]);
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
        // dd($request);

        $KodeDaftar = Setting::where('NamaSetting', 'KodeDaftar')->first()->Value;
        $rules = [
            'PIN' => [
                'min:6'
            ],
            'NISN' => [
                'unique:App\Models\Pendaftar,NISN',

            ],
            'KodeDaftar' => [
                'in:'.$KodeDaftar,
            ],
        ];

        $messages = [
            'min' => 'Gomen, PIN Kamu harus 6 Digit',
            'unique' => 'Gomen, Kamu Sudah Terdaftar Sebelumnya',
            'in' => 'Gomen, Kode Pendaftar Kamu Salah'
        ];

        $this->validate($request, $rules, $messages);

        try {
            Pendaftar::create([
                'NamaLengkap' => $request->NamaLengkap,
                'NISN' => $request->NISN,
                'Kelas' => $request->Kelas,
                'JK' => $request->JK,
                'NoWA' => $request->NoWA,
                'Instagram' => $request->Instagram,
                'PIN' => $request->PIN,
            ]);
            return back()->with('success', 'Yay, Formulir Kamu Terkirim.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan', $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function show(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendaftar $pendaftar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pendaftar  $pendaftar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendaftar $pendaftar)
    {
        //
    }
}
