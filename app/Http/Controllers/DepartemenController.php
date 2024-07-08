<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Pendaftar;
use App\Models\Periode;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartemenController extends Controller
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

    public function dpt()
    {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Departemen',
                     'customcss' => $customcss,
                     'pagetitle' => 'Departemen',
                     'navactive' => 'deptnav',
                     'previous' => ''];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        $alldept = Departemen::all();
        $latestperiode = Periode::latest()->first()->tahun_mulai;

        if (isset(Auth::guard('pendaftar')->user()->dpt->koor->NamaLengkap)){
            $kyokucho = Auth::guard('pendaftar')->user()->dpt->koor->NamaLengkap;
        } else {
            $kyokucho = NULL;
        }

        if ($kyokucho == NULL){
            $kyokuchopp = 'itsupp.png';
        } elseif (Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->dpt->koor->JK == 'pria'){
            $kyokuchopp = 'itsupp.png';
        } elseif (Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->dpt->koor->JK == 'wanita'){
            $kyokuchopp = 'itsukipp.png';
        } else {
            $kyokuchopp = Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota;
        }



        return view('katsudo.auth.departemen', [
            'alldept' => $alldept,
            'kyokucho' => $kyokucho,
            'kyokuchopp' => $kyokuchopp,
            'latestperiode' => $latestperiode,
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function detail($dpt)
    {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Departemen',
                     'customcss' => $customcss,
                     'pagetitle' => 'Departemen',
                     'navactive' => 'deptnav',
                     'previous' => 'fdpt'];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }
                    //  Auth::guard('pendaftar')->logout();

                    // dd(Auth::guard('pendaftar')->check());

        $latestperiode = Periode::latest()->first()->tahun_mulai;


        $alldept = Departemen::all();

        if (isset(Auth::guard('pendaftar')->user()->dpt->koor->NamaLengkap)){
            $kyokucho = Auth::guard('pendaftar')->user()->dpt->koor->NamaLengkap;
        } else {
            $kyokucho = NULL;
        }

        if ($kyokucho == NULL){
            $kyokuchopp = 'itsupp.png';
        } elseif (Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->dpt->koor->JK == 'pria'){
            $kyokuchopp = 'itsupp.png';
        } elseif (Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota == 'default.jpg' && Auth::guard('pendaftar')->user()->dpt->koor->JK == 'wanita'){
            $kyokuchopp = 'itsukipp.png';
        } else {
            $kyokuchopp = Auth::guard('pendaftar')->user()->dpt->koor->foto_anggota;
        }

        foreach($alldept as $dept){
            if($dept->getSlugAttribute() == $dpt){
                $thisdept = $dept;
            }
        }

        return view('katsudo.auth.detail_departemen', [
            'thisdept' => $thisdept,
            'kyokucho' => $kyokucho,
            'kyokuchopp' => $kyokuchopp,
            'latestperiode' => $latestperiode,
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function dashboard($dpt) {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Departemen',
                     'customcss' => $customcss,
                     'pagetitle' => 'Departemen',
                     'navactive' => 'deptnav',
                     'previous' => 'fdpt'];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }

        if(auth('pendaftar')->user()->sts->level == 4){

            return view('katsudo.auth.level4.departemen.index', [

                $settings['navactive'] => '-active-links',
                'stgs' => $settings
            ]);
        } else {
            return back()->with('error', 'kamu dilarang mengakses halaman ini');
        }
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
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function show(Departemen $departemen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function edit(Departemen $departemen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Departemen $departemen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Departemen  $departemen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Departemen $departemen)
    {
        //
    }


    #### ADMIN ####

    public function fadmin($tahun)
    {
        $pagetitle = 'Detail Pendaftaran';
        $pendaftar = Pendaftar::all();
        $pendaftars = $pendaftar->groupBy('dpt.nama');
        $departemens = Departemen::all();
        $pesandefault = Setting::where('NamaSetting', 'PesanDefault')->first();
        $settings = Setting::all();

        #barchart
        $years = json_encode([2017, 2018, 2019, 2020, 2021]);
        $existingYears = json_decode($years);
        $years = Pendaftar::distinct('tahun_daftar')->pluck('tahun_daftar')->toArray();

        // Tambahkan tahun-tahun unik yang belum ada
        foreach ($years as $year) {
            if (!in_array($year, $existingYears)) {
                $existingYears[] = (int) $year;
            }
        }

        // dd($pendaftars);
        return view('auth.katsudomenu.departemen', [
            'pagetitle' => $pagetitle,
            'pendaftars' => $pendaftars,
            'pesandefault' => $pesandefault,
            'departemens' => $departemens,
            'tahundaftar' => $tahun,
            'existingYears' => $existingYears,
            'settings' => $settings]);
    }

    public function ubahdepartemen($pendaftarId, $departemenId)
    {
        try {
            // Mencari pendaftar berdasarkan ID
            $pendaftar = Pendaftar::findOrFail($pendaftarId);
            $departemen = Departemen::findOrFail($departemenId);

            if ($pendaftar->sts->status == 'Hikōshiki' && $departemen->nama != 'Seinen (青年)')
            {
                $message = 'Status "'.$pendaftar->NamaLengkap.'" masih '.$pendaftar->sts->status.'. Lakukan RKS terlebih Dahulu';
                return redirect()->back()->with('danger', $message);
            }

            // Mengupdate departemen pendaftar
            $pendaftar->dpt()->associate($departemenId);
            $pendaftar->save();

            $message = 'departemen "'.$pendaftar->NamaLengkap.'" telah berubah menjadi '.$pendaftar->dpt->nama;

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Gagal Mengubah.');
        }
    }

    public function ubahkoor($pendaftarId, $departemenId)
    {
        // try {
            // Mencari pendaftar berdasarkan ID
            $pendaftar = Pendaftar::findOrFail($pendaftarId);
            $departemen = Departemen::findOrFail($departemenId);

            if ($pendaftar->dpt->id != $departemen->id)
            {
                $message = 'Departemen "'.$pendaftar->NamaLengkap.'" Berbeda';
                return redirect()->back()->with('danger', $message);
            }

            // Mengupdate departemen pendaftar
            $departemen->koor()->associate($pendaftarId);
            $departemen->save();

            $message = 'Kyoku-chō "'.$departemen->nama.'" telah berubah menjadi '.$pendaftar->NamaLengkap;

            return redirect()->back()->with('success', $message);
        // } catch (\Exception $e) {
        //     return redirect()->back()->with('danger', 'Gagal Mengubah.');
        // }
    }
}
