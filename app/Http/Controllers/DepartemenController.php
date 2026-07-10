<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Keaktifan;
use App\Models\Pendaftar;
use App\Models\Periode;
use App\Models\Rekomendasi;
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

        $thisdept = null;
        foreach($alldept as $dept){
            if($dept->getSlugAttribute() == $dpt){
                $thisdept = $dept;
            }
        }
        abort_if($thisdept === null, 404);

        // Katsudo departemen ini — dipisah akan datang & sebelumnya
        $now = now();
        $katsudos = $thisdept->katsudos()
            ->with(['pj'])
            ->where('approve', true)
            ->orderBy('tgl_laksana')
            ->get();

        $deptUpcoming = $katsudos
            ->filter(fn ($k) => $k->tgl_laksana && $k->tgl_laksana->gte($now))
            ->sortBy('tgl_laksana')
            ->values();

        $deptSebelumnya = $katsudos
            ->filter(fn ($k) => $k->tgl_laksana && $k->tgl_laksana->lt($now))
            ->sortByDesc('tgl_laksana')
            ->take(5)
            ->values();

        $deptTerdekat = $deptUpcoming->first();
        $deptAkanDatang = $deptUpcoming->slice(1)->values();

        return view('katsudo.auth.detail_departemen', [
            'thisdept'       => $thisdept,
            'kyokucho'       => $kyokucho,
            'kyokuchopp'     => $kyokuchopp,
            'latestperiode'  => $latestperiode,
            'deptTerdekat'   => $deptTerdekat,
            'deptAkanDatang' => $deptAkanDatang,
            'deptSebelumnya' => $deptSebelumnya,
            $settings['navactive'] => '-active-links',
            'stgs' => $settings]);
    }

    public function dashboard($dpt) {
        #page_setup
        $customcss = '';
        $jmlsetting = Setting::all();
        $settings = ['title' => ': Dashboard Departemen',
                     'customcss' => $customcss,
                     'pagetitle' => 'Dashboard Departemen',
                     'navactive' => 'deptnav',
                     'previous' => 'fdpt'];
                    foreach ($jmlsetting as $i => $set) {
                        $settings[$set->NamaSetting] = $set->Value;
                     }

        // Resolve lewat departemen milik user sendiri (bukan loop-scan semua
        // departemen by slug) — beberapa baris Departemen berbagi nama/slug
        // yang sama, jadi pencocokan by slug saja bisa salah ambil baris.
        $user     = auth('pendaftar')->user();
        $thisdept = $user->dpt;

        abort_if($thisdept === null, 404);

        $isKyokucho = $thisdept->getSlugAttribute() === $dpt && $thisdept->kyokucho == $user->id;

        if (!$isKyokucho) {
            return back()->with('error', 'Kamu dilarang mengakses halaman ini.');
        }

        $latestPeriode = Periode::latest()->first();

        $katsudos = $thisdept->katsudos()->orderBy('tgl_laksana', 'desc')->get();
        $now = now();

        $totalKatsudo    = $katsudos->count();
        $katsudoAkanDatang = $katsudos->filter(fn ($k) => $k->tgl_laksana && $k->tgl_laksana->gte($now))->count();
        $katsudoSelesai    = $katsudos->where('absensi_fase', 'selesai')->count();

        $anggotas = $thisdept->anggotas()->orderBy('NamaLengkap')->get();

        $keaktifans = collect();
        if ($latestPeriode) {
            $keaktifans = Keaktifan::whereIn('id_anggota', $anggotas->pluck('id'))
                ->where('id_periode', $latestPeriode->id)
                ->get()
                ->keyBy('id_anggota');
        }

        $anggotaStats = $anggotas->map(function ($a) use ($keaktifans) {
            $k = $keaktifans->get($a->id);
            return [
                'anggota'      => $a,
                'hadir'        => $k->jumlah_th ?? 0,
                'absen'        => $k->jumlah_absen ?? 0,
                'absen_berturut' => $k->jumlah_absen_berturut ?? 0,
            ];
        })->sortByDesc('hadir')->values();

        $hasRekomendasi = $latestPeriode ? Rekomendasi::where('id_departemen', $thisdept->id)
            ->where('id_periode', $latestPeriode->id)
            ->where('status', 'aktif')
            ->exists() : false;

        return view('katsudo.auth.level4.departemen.index', [
            $settings['navactive'] => '-active-links',
            'stgs'            => $settings,
            'thisdept'        => $thisdept,
            'totalKatsudo'    => $totalKatsudo,
            'katsudoAkanDatang' => $katsudoAkanDatang,
            'katsudoSelesai'  => $katsudoSelesai,
            'anggotaStats'    => $anggotaStats,
            'latestPeriode'   => $latestPeriode,
            'hasRekomendasi'  => $hasRekomendasi,
        ]);
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

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'nama'  => 'required|string|max:100',
            'level' => 'required|integer|min:0',
            'icon'  => 'nullable|string|max:100',
            'img'   => 'nullable|file|mimes:svg,png,gif,webp,jpeg,jpg|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $file    = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(public_path('images/dept'))) {
                mkdir(public_path('images/dept'), 0755, true);
            }
            $file->move(public_path('images/dept'), $filename);
            $imgPath = 'dept/' . $filename;
        }

        Departemen::create([
            'nama'  => $request->nama,
            'level' => $request->level,
            'icon'  => $request->icon,
            'img'   => $imgPath,
        ]);

        return back()->with('departemen_success', 'Departemen "' . $request->nama . '" berhasil ditambahkan.');
    }

    public function updateAdmin(Request $request, $id)
    {
        $dept = Departemen::findOrFail($id);

        $request->validate([
            'nama'  => 'required|string|max:100',
            'level' => 'required|integer|min:0',
            'icon'  => 'nullable|string|max:100',
            'img'   => 'nullable|file|mimes:svg,png,gif,webp,jpeg,jpg|max:2048',
        ]);

        $imgPath = $dept->img;
        if ($request->hasFile('img')) {
            // Delete old file only if it was uploaded to our folder
            if ($dept->img && str_starts_with($dept->img, 'dept/')) {
                $oldPath = public_path('images/' . $dept->img);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file     = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            if (!file_exists(public_path('images/dept'))) {
                mkdir(public_path('images/dept'), 0755, true);
            }
            $file->move(public_path('images/dept'), $filename);
            $imgPath = 'dept/' . $filename;
        }

        $dept->update([
            'nama'  => $request->nama,
            'level' => $request->level,
            'icon'  => $request->icon ?? $dept->icon,
            'img'   => $imgPath,
        ]);

        return back()->with('departemen_success', 'Departemen berhasil diperbarui.');
    }

    public function destroyAdmin($id)
    {
        $dept = Departemen::findOrFail($id);
        $nama = $dept->nama;
        $dept->delete();
        return back()->with('departemen_success', 'Departemen "' . $nama . '" berhasil dihapus.');
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
        $pagetitle = 'Departemen Anggota';
        $pendaftars = Pendaftar::where('tahun_daftar', $tahun)->get();
        $departemens = Departemen::orderBy('level')->get();
        $settings = Setting::all();

        $existingYears = Pendaftar::distinct('tahun_daftar')
            ->pluck('tahun_daftar')
            ->sort()
            ->values()
            ->toArray();

        return view('auth.katsudomenu.departemen', [
            'pagetitle'     => $pagetitle,
            'pendaftars'    => $pendaftars,
            'departemens'   => $departemens,
            'tahundaftar'   => $tahun,
            'existingYears' => $existingYears,
            'settings'      => $settings,
        ]);
    }

    public function bulkUbahdepartemenBulk(Request $request)
    {
        $request->validate([
            'pendaftar_ids'   => 'required|array|min:1',
            'pendaftar_ids.*' => 'integer|exists:pendaftars,id',
            'departemen_id'   => 'required|integer|exists:departemens,id',
            'tahun'           => 'required',
        ]);

        $count = Pendaftar::whereIn('id', $request->pendaftar_ids)
            ->update(['departemen' => $request->departemen_id]);

        $deptNama = Departemen::find($request->departemen_id)->nama;

        return redirect()->route('departemen.fadmin', ['tahun' => $request->tahun])
            ->with('success', $count . ' anggota berhasil dipindahkan ke departemen "' . $deptNama . '".');
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
