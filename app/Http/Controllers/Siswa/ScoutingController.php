<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\ScoutingBatch;
use App\Models\Talent_Scouting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoutingController extends Controller
{
    /**
     * Menampilkan daftar peluang Talent Scouting untuk Siswa / Calon Lulusan
     */
    public function index()
    {
        $userId = Auth::id();
        $batches = ScoutingBatch::with('perusahaan')
            ->orderByDesc('created_at')
            ->get();

        $appliedBatchIds = Talent_Scouting::where('user_id', $userId)
            ->pluck('batch_id')
            ->toArray();

        return view('siswa.scoutings.index', compact('batches', 'appliedBatchIds'));
    }

    /**
     * Menampilkan form pendaftaran Talent Scouting
     */
    public function registration(ScoutingBatch $scouting)
    {
        return view('siswa.scoutings.register', compact('scouting'));
    }

    /**
     * Menyimpan lamaran Talent Scouting oleh Siswa
     */
    public function apply(ScoutingBatch $scouting, Request $request)
    {
        $request->validate([
            'cv' => 'required|file|mimes:pdf|max:2048',
            'ijazah' => 'nullable|file|mimes:pdf|max:2048',
            'pernyataan' => 'required|file|mimes:pdf|max:2048'
        ]);

        $userId = Auth::id();

        // Cegah pendaftaran ganda
        $alreadyApplied = Talent_Scouting::where('user_id', $userId)
            ->where('batch_id', $scouting->id)
            ->exists();

        if ($alreadyApplied) {
            return redirect()->route('siswa-scouting-index')->with('error', 'Anda sudah mendaftar pada batch talent scouting ini.');
        }

        Talent_Scouting::create([
            'batch_id' => $scouting->id,
            'user_id' => $userId,
            'file_cv' => $request->file('cv')->store('talent_scoutings/cv', 'public'),
            'file_ijazah' => $request->hasFile('ijazah') ? $request->file('ijazah')->store('talent_scoutings/ijazah', 'public') : null,
            'file_pernyataan' => $request->file('pernyataan')->store('talent_scoutings/pernyataan', 'public'),
            'status_seleksi' => 'proses',
        ]);

        return redirect()->route('siswa-scouting-index')->with('success', 'Pendaftaran Talent Scouting berhasil dikirim!');
    }

    /**
     * Menampilkan status pendaftaran Talent Scouting Siswa
     */
    public function status()
    {
        $talents = Talent_Scouting::with('batch.perusahaan')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('siswa.scoutings.status', compact('talents'));
    }
}
