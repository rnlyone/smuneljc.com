<?php

namespace App\Http\Controllers;

use App\Models\Pendaftar;
use App\Models\Setting;
use App\Models\Status;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isNull;

class StatusController extends Controller
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

    public function fadmin($tahun)
    {
        $pagetitle = 'Detail Pendaftaran';
        $pendaftar = Pendaftar::all();
        $pendaftars = $pendaftar->groupBy('sts.status');
        $statuses = Status::all();
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
        return view('auth.katsudomenu.status', [
            'pagetitle' => $pagetitle,
            'pendaftars' => $pendaftars,
            'pesandefault' => $pesandefault,
            'statuses' => $statuses,
            'tahundaftar' => $tahun,
            'existingYears' => $existingYears,
            'settings' => $settings]);
    }

    public function ubahstatus($pendaftarId, $statusId)
    {
        try {
            // Mencari pendaftar berdasarkan ID
            $pendaftar = Pendaftar::findOrFail($pendaftarId);

            // Mengupdate status pendaftar
            $pendaftar->sts()->associate($statusId);
            $pendaftar->save();

            $message = 'status '.$pendaftar->NamaLengkap.' telah berubah menjadi '.$pendaftar->sts->status;

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('success', 'Gagal Mengubah.');
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
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        //
    }
}
