<?php

namespace App\Http\Controllers;

use App\Models\Keaktifan;
use App\Models\Pendaftar;
use App\Models\Periode;
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
        $latestPengurus = Periode::latest()->first();
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
            $pendaftar = Pendaftar::create([
                'NamaLengkap' => $request->NamaLengkap,
                'NISN' => $request->NISN,
                'Kelas' => $request->Kelas,
                'JK' => $request->JK,
                'NoWA' => $request->NoWA,
                'Instagram' => $request->Instagram,
                'PIN' => $request->PIN,
                'tahun_daftar' => $TahunDaftar
            ]);

            Keaktifan::create([
                'id_anggota' => $pendaftar->id,
                'id_periode' => $latestPengurus->id
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


    ##################
    #####KATSUDO#####
    #################




    protected $guard = 'pendaftar'; // Gunakan guard 'pendaftar'

    public function flogin()
    {
        if (auth('pendaftar')->check()) {
            return redirect()->route('katsudo.home');
        }

        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Show Tiket',
                     'customcss' => $customcss,
                     'pagetitle' => 'Show Tiket',
                     'navactive' => '',
                     'baractive' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }


        return view('katsudo.guest.login', [
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function login(Request $request)
    {
        $credentials = request()->validate([
            'NISN' => 'required',
            'PIN' => 'required',
        ]);

        $anggota = Pendaftar::where('NISN', $request->NISN)->first();



        // Coba otentikasi pengguna dengan metode validateCredentials
        if (isset($anggota) && $anggota->NISN == $request->NISN && $anggota->PIN == $request->PIN) {
            if($anggota->sts->status == 'Taikai'){
                return back()->withInput()->withErrors(['NISN' => 'Gomennasai, anda sudah dinyatakan Taikai']);
            }

            // Jika otentikasi berhasil, alihkan ke rute pendaftar yang sesuai
            auth('pendaftar')->login($anggota);
            return redirect()->route('katsudo.home');
        }

        // Jika otentikasi gagal, kembalikan ke halaman login dengan pesan kesalahan
        return back()->withInput()->withErrors(['NISN' => 'Login ga Dekinai. Periksa NISN dan PIN Anda.']);

    }

    public function logout(){
        Auth::guard('pendaftar')->logout();
        return redirect()->route('klogin')->with('sukses', 'logout berhasil');
    }
}
