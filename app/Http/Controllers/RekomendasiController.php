<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Periode;
use App\Models\Rekomendasi;
use App\Models\Setting;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    /** Helper: cek kaicho (level >= 5) */
    private function isKaicho(): bool
    {
        $user = auth('pendaftar')->user();
        return $user && $user->sts && $user->sts->level >= 5;
    }

    /** Helper: cek kyokucho (user adalah coordinator divisinya) */
    private function isKyokucho(): bool
    {
        $user = auth('pendaftar')->user();
        return $user && $user->dpt && $user->dpt->kyokucho == $user->id;
    }

    /**
     * Halaman rekomendasi:
     * - Kaicho: lihat semua + form buat baru
     * - Kyokucho: lihat rekomendasi untuk divisinya
     */
    public function index()
    {
        $user = auth('pendaftar')->user();

        $jmlsetting = Setting::all();
        $settings = ['title' => ': Rekomendasi Katsudo', 'customcss' => '',
                     'pagetitle' => 'Rekomendasi', 'navactive' => '', 'previous' => ''];
        foreach ($jmlsetting as $s) { $settings[$s->NamaSetting] = $s->Value; }

        $latestPeriode = Periode::latest()->first();
        $departemens   = Departemen::orderBy('level')->get();

        if ($this->isKaicho()) {
            $rekomendasis = Rekomendasi::with(['departemen', 'kaicho'])
                ->where('id_periode', optional($latestPeriode)->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('katsudo.auth.rekomendasi', [
                'stgs'          => $settings,
                'rekomendasis'  => $rekomendasis,
                'departemens'   => $departemens,
                'latestPeriode' => $latestPeriode,
                'isKaicho'      => true,
            ]);
        }

        if ($this->isKyokucho()) {
            $rekomendasis = Rekomendasi::with(['kaicho'])
                ->where('id_departemen', $user->departemen)
                ->where('id_periode', optional($latestPeriode)->id)
                ->orderBy('created_at', 'desc')
                ->get();

            return view('katsudo.auth.rekomendasi', [
                'stgs'          => $settings,
                'rekomendasis'  => $rekomendasis,
                'departemens'   => $departemens,
                'latestPeriode' => $latestPeriode,
                'isKaicho'      => false,
            ]);
        }

        return redirect()->route('katsudo.home')->with('error', 'Akses tidak diizinkan.');
    }

    /** Kaicho: buat rekomendasi baru untuk divisi */
    public function store(Request $request)
    {
        if (!$this->isKaicho()) {
            abort(403, 'Hanya Kaichō yang dapat memberikan rekomendasi.');
        }

        $request->validate([
            'id_departemen' => 'required|exists:departemens,id',
            'catatan'       => 'nullable|string|max:500',
        ]);

        $latestPeriode = Periode::latest()->firstOrFail();

        // Cek sudah ada rekomendasi aktif untuk divisi ini di periode ini
        $existing = Rekomendasi::where('id_departemen', $request->id_departemen)
            ->where('id_periode', $latestPeriode->id)
            ->where('status', 'aktif')
            ->exists();

        if ($existing) {
            return back()->with('rek_error', 'Divisi ini sudah memiliki rekomendasi aktif untuk periode ini.');
        }

        Rekomendasi::create([
            'id_departemen' => $request->id_departemen,
            'id_kaicho'     => auth('pendaftar')->id(),
            'id_periode'    => $latestPeriode->id,
            'catatan'       => $request->catatan,
            'status'        => 'aktif',
        ]);

        return back()->with('rek_success', 'Rekomendasi berhasil dikirim ke divisi.');
    }

    /** Kaicho: cabut rekomendasi */
    public function cabut($id)
    {
        if (!$this->isKaicho()) {
            abort(403);
        }

        $rek = Rekomendasi::findOrFail($id);

        if ($rek->status === 'digunakan') {
            return back()->with('rek_error', 'Rekomendasi yang sudah digunakan tidak dapat dicabut.');
        }

        $rek->update(['status' => 'dicabut']);

        return back()->with('rek_success', 'Rekomendasi berhasil dicabut.');
    }
}
