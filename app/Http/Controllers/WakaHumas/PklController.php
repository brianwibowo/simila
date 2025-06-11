<?php

namespace App\Http\Controllers\WakaHumas;

use App\Http\Controllers\Controller;
use App\Models\Pkl;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PklController extends Controller
{
    /**
     * Display a listing of the PKL reports.
     */
    public function index()
    {
        $pkls = Pkl::with(['siswa', 'pembimbing', 'perusahaan'])
                  ->latest()
                  ->paginate(10);
        
        return view('waka_humas.pkl.index', compact('pkls'));
    }

    /**
     * Display the specified PKL report.
     */
    public function show(Pkl $pkl)
    {
        $pkl->load(['siswa', 'pembimbing', 'perusahaan']);
        return view('waka_humas.pkl.show', compact('pkl'));
    }

    /**
     * Validate the PKL report.
     */
    public function validateReport(Request $request, Pkl $pkl)
    {
        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string|max:1000'
        ]);

        $pkl->update([
            'status_waka_humas' => $validated['status'],
            'catatan_waka_humas' => $validated['catatan'] ?? null,
            'tanggal_validasi_waka_humas' => now()
        ]);

        return redirect()->route('waka-humas.pkl.show', $pkl)
            ->with('success', 'Laporan PKL berhasil divalidasi');
    }

    /**
     * Download the PKL report file.
     */
    public function downloadReport(Pkl $pkl)
    {
        $filePath = 'public/' . $pkl->laporan_akhir;
        
        if (!Storage::exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::download($filePath, 'laporan_pkl_' . $pkl->siswa->name . '.pdf');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showId($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
