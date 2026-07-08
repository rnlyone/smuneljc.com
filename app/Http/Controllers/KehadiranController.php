<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Katsudo;
use App\Models\Setting;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index() {}
    public function create() {}
    public function store(Request $request) {}
    public function show(Kehadiran $kehadiran) {}
    public function edit(Kehadiran $kehadiran) {}
    public function update(Request $request, Kehadiran $kehadiran) {}
    public function destroy(Kehadiran $kehadiran) {}

    public function fscan()
    {
        $settings = ['title' => ': Scan Katsudo', 'customcss' => '',
                     'pagetitle' => 'Scan Katsudo', 'navactive' => 'scannav', 'previous' => ''];
        foreach (Setting::all() as $s) { $settings[$s->NamaSetting] = $s->Value; }

        return view('katsudo.auth.scankatsudo', [
            $settings['navactive'] => '-active-links',
            'stgs' => $settings,
        ]);
    }

    /**
     * Proses scan QR.
     * Payload QR: "KATSUDO:{id}:{token}:{fase}"
     */
    public function scan(Request $request)
    {
        $request->validate(['payload' => 'required|string']);

        $parts = explode(':', $request->payload);
        if (count($parts) !== 4 || $parts[0] !== 'KATSUDO') {
            return response()->json(['status' => 'error', 'message' => 'QR tidak valid.'], 400);
        }

        [, $katsudoId, $token, $fase] = $parts;

        $katsudo = Katsudo::find($katsudoId);
        if (!$katsudo) {
            return response()->json(['status' => 'error', 'message' => 'Katsudo tidak ditemukan.'], 404);
        }

        // Validasi token (harus cocok persis — sudah tidak bisa dipakai ulang karena token terus berubah)
        if ($katsudo->token !== $token) {
            return response()->json(['status' => 'error', 'message' => 'QR sudah kadaluwarsa. Scan ulang QR terbaru.'], 400);
        }

        if (!$katsudo->absensi || !in_array($katsudo->absensi_fase, ['masuk', 'keluar'])) {
            return response()->json(['status' => 'error', 'message' => 'Absensi tidak sedang aktif.'], 400);
        }

        if ($katsudo->absensi_fase !== $fase) {
            return response()->json(['status' => 'error', 'message' => "QR ini untuk fase {$fase}, tapi absensi sekarang di fase {$katsudo->absensi_fase}."], 400);
        }

        $user = auth('pendaftar')->user();

        // Cek apakah member diundang (berdasarkan divisi)
        if (!$katsudo->isDivisiBerlaku($user->departemen)) {
            return response()->json(['status' => 'error', 'message' => 'Divisi kamu tidak diundang dalam katsudo ini.'], 403);
        }

        $kehadiran = Kehadiran::where('id_katsudo', $katsudo->id)
            ->where('id_anggota', $user->id)
            ->first();

        if ($fase === 'masuk') {
            if ($kehadiran && $kehadiran->masuk_at) {
                return response()->json(['status' => 'info', 'message' => 'Kamu sudah scan masuk sebelumnya.', 'nama' => $user->NamaLengkap]);
            }
            // Buat atau update
            Kehadiran::updateOrCreate(
                ['id_katsudo' => $katsudo->id, 'id_anggota' => $user->id],
                ['status_absen' => 'hadir', 'masuk_at' => now()]
            );
            return response()->json(['status' => 'success', 'message' => 'Absensi masuk berhasil!', 'nama' => $user->NamaLengkap, 'fase' => 'masuk']);
        }

        if ($fase === 'keluar') {
            if (!$kehadiran || !$kehadiran->masuk_at) {
                return response()->json(['status' => 'error', 'message' => 'Kamu belum scan masuk. Scan masuk terlebih dahulu.'], 400);
            }
            if ($kehadiran->keluar_at) {
                return response()->json(['status' => 'info', 'message' => 'Kamu sudah scan keluar sebelumnya.', 'nama' => $user->NamaLengkap]);
            }
            $kehadiran->update(['keluar_at' => now()]);
            return response()->json(['status' => 'success', 'message' => 'Absensi keluar berhasil!', 'nama' => $user->NamaLengkap, 'fase' => 'keluar']);
        }

        return response()->json(['status' => 'error', 'message' => 'Fase tidak dikenal.'], 400);
    }
}


