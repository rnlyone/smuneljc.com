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
        $pagetitle = 'Status Anggota';
        $pendaftars = Pendaftar::where('tahun_daftar', $tahun)->get();
        $statuses = Status::orderBy('level')->get();
        $settings = Setting::all();

        $existingYears = Pendaftar::distinct('tahun_daftar')
            ->pluck('tahun_daftar')
            ->sort()
            ->values()
            ->toArray();

        return view('auth.katsudomenu.status', [
            'pagetitle'     => $pagetitle,
            'pendaftars'    => $pendaftars,
            'statuses'      => $statuses,
            'tahundaftar'   => $tahun,
            'existingYears' => $existingYears,
            'settings'      => $settings,
        ]);
    }

    public function bulkUbahStatus(Request $request)
    {
        $request->validate([
            'pendaftar_ids'   => 'required|array|min:1',
            'pendaftar_ids.*' => 'integer|exists:pendaftars,id',
            'status_id'       => 'required|integer|exists:statuses,id',
            'tahun'           => 'required',
        ]);

        $count = Pendaftar::whereIn('id', $request->pendaftar_ids)
            ->update(['status' => $request->status_id]);

        $statusNama = Status::find($request->status_id)->status;

        return redirect()->route('status.fadmin', ['tahun' => $request->tahun])
            ->with('success', $count . ' anggota berhasil diubah statusnya menjadi "' . $statusNama . '".');
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
        $request->validate([
            'status' => 'required|string|max:100|unique:statuses,status',
            'level'  => 'required|integer|min:0',
            'img'    => 'nullable|file|mimes:svg,png,gif,webp,jpeg,jpg|max:2048',
        ]);

        $imgPath = null;
        if ($request->hasFile('img')) {
            $file     = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imgPath  = $filename;
        }

        Status::create([
            'status' => $request->status,
            'level'  => $request->level,
            'img'    => $imgPath,
        ]);

        return back()->with('status_success', 'Status "' . $request->status . '" berhasil ditambahkan.');
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

    public function updateAdmin(Request $request, $id)
    {
        $status = Status::findOrFail($id);

        $request->validate([
            'status' => 'required|string|max:100|unique:statuses,status,' . $id,
            'level'  => 'required|integer|min:0',
            'img'    => 'nullable|file|mimes:svg,png,gif,webp,jpeg,jpg|max:2048',
        ]);

        $imgPath = $status->img;
        if ($request->hasFile('img')) {
            // Delete old file only if it was uploaded (not a static default)
            $staticDefaults = ['kaiin.svg','yakuin.svg','hikatsudo.svg','hikoshiki.svg','shuryosei.svg','sotsugyosei.svg'];
            if ($status->img && !in_array($status->img, $staticDefaults)) {
                $oldPath = public_path('images/' . $status->img);
                if (file_exists($oldPath)) {
                    @unlink($oldPath);
                }
            }
            $file     = $request->file('img');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imgPath  = $filename;
        }

        $status->update([
            'status' => $request->status,
            'level'  => $request->level,
            'img'    => $imgPath,
        ]);

        return back()->with('status_success', 'Status berhasil diperbarui.');
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

    public function destroyAdmin($id)
    {
        $status = Status::findOrFail($id);
        $namaStatus = $status->status;
        $status->delete();
        return back()->with('status_success', 'Status "' . $namaStatus . '" berhasil dihapus.');
    }
}
