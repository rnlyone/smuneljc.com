<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use App\Models\Katsudo;
use App\Models\Keaktifan;
use App\Models\Kehadiran;
use App\Models\Pendaftar;
use App\Models\Periode;
use App\Models\Rekomendasi;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KatsudoController extends Controller
{
    // ─── Helpers ────────────────────────────────────────────────────────────

    private function isKyokucho(): bool
    {
        $user = auth('pendaftar')->user();
        return $user && $user->dpt && $user->dpt->kyokucho == $user->id;
    }

    private function pageSettings(string $title): array
    {
        $settings = ['title' => ': ' . $title, 'customcss' => '',
                     'pagetitle' => $title, 'navactive' => 'usernav', 'previous' => ''];
        foreach (Setting::all() as $s) { $settings[$s->NamaSetting] = $s->Value; }
        return $settings;
    }

    // ─── Profile page (user icon in bottom nav) ──────────────────────────────

    public function index()
    {
        $settings      = $this->pageSettings('Profile');
        $latestPeriode = Periode::latest()->first();
        $keaktifan     = null;
        if ($latestPeriode) {
            $keaktifan = Keaktifan::where('id_anggota', auth('pendaftar')->id())
                ->where('id_periode', $latestPeriode->id)
                ->first();
        }

        return view('katsudo.auth.profile', [
            $settings['navactive'] => '-active-links',
            'stgs'          => $settings,
            'keaktifan'     => $keaktifan,
            'latestPeriode' => $latestPeriode,
        ]);
    }

    // ─── Create katsudo form (kyokucho only) ─────────────────────────────────

    public function create()
    {
        if (!$this->isKyokucho()) {
            return redirect()->route('katsudo.home')->with('error', 'Hanya Kyokucho yang dapat membuat katsudo.');
        }

        $user          = auth('pendaftar')->user();
        $latestPeriode = Periode::latest()->firstOrFail();

        // Cek rekomendasi aktif
        $rekomendasi = Rekomendasi::where('id_departemen', $user->departemen)
            ->where('id_periode', $latestPeriode->id)
            ->where('status', 'aktif')
            ->latest()
            ->first();

        if (!$rekomendasi) {
            return redirect()->route('ktd.rekomendasi')->with('error', 'Belum ada rekomendasi aktif dari Kaichō untuk divisi Anda.');
        }

        $departemens = Departemen::orderBy('level')->get();
        $settings    = $this->pageSettings('Buat Katsudo');

        return view('katsudo.auth.level4.katsudo.make', [
            'stgs'         => $settings,
            'rekomendasi'  => $rekomendasi,
            'departemens'  => $departemens,
            'latestPeriode'=> $latestPeriode,
        ]);
    }

    // ─── Store new katsudo ───────────────────────────────────────────────────

    public function store(Request $request)
    {
        if (!$this->isKyokucho()) {
            abort(403);
        }

        $user          = auth('pendaftar')->user();
        $latestPeriode = Periode::latest()->firstOrFail();

        $rekomendasi = Rekomendasi::where('id_departemen', $user->departemen)
            ->where('id_periode', $latestPeriode->id)
            ->where('status', 'aktif')
            ->latest()
            ->firstOrFail();

        $request->validate([
            'nama'            => 'required|string|max:200',
            'tgl_laksana'     => 'required|date',
            'deskripsi'       => 'required|string',
            'divisi_undangan' => 'nullable|array',
            'divisi_undangan.*' => 'exists:departemens,id',
        ]);

        $katsudo = Katsudo::create([
            'nama'            => $request->nama,
            'ranah'           => $user->departemen,
            'pj'              => $user->id,
            'periode'         => $latestPeriode->id,
            'id_rekomendasi'  => $rekomendasi->id,
            'divisi_undangan' => $request->divisi_undangan ?: null, // null = semua
            'tgl_laksana'     => $request->tgl_laksana,
            'deskripsi'       => $request->deskripsi,
            'token'           => Str::random(32),
            'absensi'         => false,
            'absensi_fase'    => 'belum',
            'khusus'          => false,
            'approve'         => true,
        ]);

        // Konsumsi rekomendasi
        $rekomendasi->update(['status' => 'digunakan', 'used_at' => now()]);

        return redirect()->route('katsudo.show', $katsudo->id)
            ->with('success', 'Katsudo berhasil dibuat!');
    }

    // ─── Show katsudo detail + QR panel ─────────────────────────────────────

    public function show(Katsudo $katsudo)
    {
        $user = auth('pendaftar')->user();

        // Only the pj (kyokucho who created it) can manage attendance
        $isPj = $katsudo->pj == $user->id;

        $settings   = $this->pageSettings($katsudo->nama);
        $kehadirans = $katsudo->kehadirans()->with('anggota')->get();

        return view('katsudo.auth.level4.katsudo.detail', [
            'stgs'      => $settings,
            'katsudo'   => $katsudo,
            'isPj'      => $isPj,
            'kehadirans'=> $kehadirans,
        ]);
    }

    // ─── List katsudos for kyokucho's division ───────────────────────────────

    public function listDivisi()
    {
        if (!$this->isKyokucho()) {
            return redirect()->route('katsudo.home');
        }

        $user          = auth('pendaftar')->user();
        $latestPeriode = Periode::latest()->first();
        $settings      = $this->pageSettings('Katsudo Divisi');

        $katsudos = Katsudo::where('ranah', $user->departemen)
            ->orderBy('tgl_laksana', 'desc')
            ->get();

        // Cek apakah ada rekomendasi aktif
        $hasRekomendasi = $latestPeriode ? Rekomendasi::where('id_departemen', $user->departemen)
            ->where('id_periode', $latestPeriode->id)
            ->where('status', 'aktif')
            ->exists() : false;

        return view('katsudo.auth.level4.katsudo.index', [
            'stgs'          => $settings,
            'katsudos'      => $katsudos,
            'hasRekomendasi'=> $hasRekomendasi,
        ]);
    }

    // ─── Mulai absensi masuk ─────────────────────────────────────────────────

    public function mulaiAbsensi(Katsudo $katsudo)
    {
        if ($katsudo->pj != auth('pendaftar')->id()) abort(403);
        if ($katsudo->absensi_fase !== 'belum') {
            return back()->with('error', 'Absensi sudah dimulai.');
        }

        $katsudo->update([
            'absensi'      => true,
            'absensi_fase' => 'masuk',
            'token'        => Str::random(32),
            'token_at'     => now(),
        ]);

        return back()->with('success', 'Absensi masuk dimulai. QR aktif.');
    }

    /** Switch ke fase keluar */
    public function switchFase(Katsudo $katsudo)
    {
        if ($katsudo->pj != auth('pendaftar')->id()) abort(403);
        if ($katsudo->absensi_fase !== 'masuk') {
            return back()->with('error', 'Fase tidak valid untuk switch.');
        }

        $katsudo->update([
            'absensi_fase' => 'keluar',
            'token'        => Str::random(32),
            'token_at'     => now(),
        ]);

        return back()->with('success', 'Beralih ke fase absensi keluar.');
    }

    /** Refresh token (AJAX, dipanggil setiap 30 detik oleh kyokucho's device) */
    public function refreshToken(Katsudo $katsudo)
    {
        if ($katsudo->pj != auth('pendaftar')->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if (!in_array($katsudo->absensi_fase, ['masuk', 'keluar'])) {
            return response()->json(['error' => 'Absensi tidak aktif'], 400);
        }

        $newToken = Str::random(32);
        $katsudo->update(['token' => $newToken, 'token_at' => now()]);

        return response()->json([
            'token'    => $newToken,
            'fase'     => $katsudo->absensi_fase,
            'payload'  => "KATSUDO:{$katsudo->id}:{$newToken}:{$katsudo->absensi_fase}",
        ]);
    }

    /** Selesai absensi: tutup QR, buat record absen, update keaktifan */
    public function selesaiAbsensi(Katsudo $katsudo)
    {
        if ($katsudo->pj != auth('pendaftar')->id()) abort(403);

        // Tentukan siapa saja yang "diundang"
        $divisiUndangan = $katsudo->divisi_undangan; // null = semua

        if ($divisiUndangan === null) {
            $invitedMembers = Pendaftar::all();
        } else {
            $invitedMembers = Pendaftar::whereIn('departemen', $divisiUndangan)->get();
        }

        // ID member yang sudah hadir (scan masuk)
        $hadirIds = Kehadiran::where('id_katsudo', $katsudo->id)
            ->whereNotNull('masuk_at')
            ->pluck('id_anggota')
            ->toArray();

        $latestPeriode = Periode::findOrFail($katsudo->periode);

        foreach ($invitedMembers as $member) {
            $keaktifan = Keaktifan::where('id_anggota', $member->id)
                ->where('id_periode', $latestPeriode->id)
                ->first();

            if (in_array($member->id, $hadirIds)) {
                // Update keaktifan: hadir
                if ($keaktifan) {
                    $keaktifan->jumlah_th++;
                    $keaktifan->jumlah_th_berturut++;
                    $keaktifan->jumlah_absen_berturut = 0;
                    $keaktifan->save();
                }
            } else {
                // Buat record absen
                $existing = Kehadiran::where('id_katsudo', $katsudo->id)
                    ->where('id_anggota', $member->id)
                    ->first();
                if (!$existing) {
                    Kehadiran::create([
                        'id_katsudo'  => $katsudo->id,
                        'id_anggota'  => $member->id,
                        'status_absen'=> 'absen',
                    ]);
                    if ($keaktifan) {
                        $keaktifan->jumlah_absen++;
                        $keaktifan->jumlah_absen_berturut++;
                        $keaktifan->jumlah_th_berturut = 0;
                        $keaktifan->save();
                    }
                }
            }
        }

        $katsudo->update([
            'absensi'      => false,
            'absensi_fase' => 'selesai',
        ]);

        return back()->with('success', 'Absensi selesai. Keaktifan anggota telah diperbarui.');
    }

    // ─── Unused resource stubs ───────────────────────────────────────────────

    public function edit(Katsudo $katsudo) {}
    public function update(Request $request, Katsudo $katsudo) {}
    public function destroy(Katsudo $katsudo) {}
}


