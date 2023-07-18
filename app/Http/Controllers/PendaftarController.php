<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
        $settings = Setting::all();
        return view('auth.pendaftar', [
            'pagetitle' => $pagetitle,
            'pendaftars' => $pendaftars,
            'pesandefault' => $pesandefault,
            'settings' => $settings]);
    }

    public function coming_soon()
    {
        return view('coming-soon');
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
        $TahunDaftar = Setting::where('NamaSetting', 'Tahun')->first()->Value;
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
                'tahun_daftar' => $TahunDaftar
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
    public function edit($nisn)
    {
        $form = Pendaftar::where('NISN', $nisn)->first();
        $pagetitle = 'Edit Formulir';
        $settings = Setting::all();
        return view('auth.editform', ['pagetitle' => $pagetitle,'form' => $form, 'settings' => $settings]);
    }

    public function update(Request $request, $nisn)
    {
        $form = Pendaftar::where('NISN', $nisn)->first();
        $rules = [
            'NISN' => [
                'unique:App\Models\Pendaftar,NISN,'.$form->id,
            ],
        ];

        $messages = [
            'unique' => 'Gomen, Kamu Sudah Terdaftar Sebelumnya',
        ];

        $this->validate($request, $rules, $messages);
        try {
            $form->NamaLengkap = $request->NamaLengkap;
            $form->NISN = $request->NISN;
            $form->Kelas = $request->Kelas;
            $form->JK = $request->JK;
            $form->NoWA = $request->NoWA;
            $form->Instagram = $request->Instagram;

            $form->save();
            if (Auth::user()) {
                return redirect()->route('daftar.index')->with('success', 'Yay, Formulir Berhasil diedit.');
            } else {
                return redirect()->route('daftar.form')->with('success', 'Yay, Formulir Kamu Berhasil diedit.');
            }

        } catch (\Throwable $th) {
            return back()->with('error', 'Maaf, Terdapat Kesalahan', $th);
        }
    }

    public function destroy($nisn)
    {
        Pendaftar::where('NISN', $nisn)->first()->delete();
        if (Auth::user()) {
            return redirect()->route('daftar.index')->with('success', 'Yay, Formulir Berhasil dihapus.');
        } else {
            return redirect()->route('daftar.form')->with('success', 'Yay, Formulir Kamu Berhasil dihapus.');
        }
    }

    public function pinauth(Request $request, $nisn)
    {
        $form = Pendaftar::where('NISN', $nisn)->first();

        $validator = Validator::make($request->all(), [
            'PIN' => [
                'in:'.$form->PIN
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->route('daftar.form')
                        ->withErrors($validator)
                        ->withInput();
        }

        if ($form->PIN == $request->PIN) {
            $pagetitle = 'Edit Formulir';
            $settings = Setting::all();
            return view('auth.editform', ['pagetitle' => $pagetitle,'form' => $form, 'settings' => $settings]);
        } else {
            return back();
        }
    }
}
