<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BeasiswaBatch;
use App\Models\Beasiswa;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeasiswaScoutingController extends Controller
{
    public function index()
    {
        $batches = BeasiswaBatch::where('perusahaan_id', Auth::id())->latest()->get();
        return view('perusahaan.beasiswas.index', compact('batches'));
    }

    public function create()
    {
        return view('perusahaan.beasiswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        BeasiswaBatch::create([
            'batch'           => $request->nama,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'perusahaan_id'   => Auth::id(),
            'status'          => 'open',
        ]);

        return redirect()->route('perusahaan-beasiswa-index')->with('success', 'Batch berhasil ditambahkan');
    }

    public function show(BeasiswaBatch $beasiswa)
    {
        $this->guard($beasiswa);
        $pendaftar = Beasiswa::where('batch_id', $beasiswa->id)->get();

        return view('perusahaan.beasiswas.show', [
            'beasiswa' => $beasiswa,
            'pendaftar' => $pendaftar
        ]);
    }

    public function edit(BeasiswaBatch $beasiswa)
    {
        $this->guard($beasiswa);
        return view('perusahaan.beasiswas.edit', compact('beasiswa'));
    }

    public function update(Request $request, BeasiswaBatch $beasiswa)
    {
        $this->guard($beasiswa);

        $request->validate([
            'nama' => 'required',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ]);

        $beasiswa->update([
            'batch' => $request->nama,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return redirect()->route('perusahaan-beasiswa-index')->with('success', 'Batch berhasil diperbarui');
    }

    public function destroy(BeasiswaBatch $beasiswa)
    {
        $this->guard($beasiswa);
        $beasiswa->delete();
        return redirect()->route('perusahaan-beasiswa-index')->with('success', 'Batch berhasil dihapus');
    }

    public function siswa(User $user, BeasiswaBatch $beasiswa)
    {
        $this->guard($beasiswa);

        $pendaftar = Beasiswa::where('user_id', $user->id)
            ->where('batch_id', $beasiswa->id)
            ->first();

        return view('perusahaan.beasiswas.siswa', compact('pendaftar', 'beasiswa'));
    }

    public function seleksi(Request $request, Beasiswa $pendaftar)
    {
        $this->guard($pendaftar->batch);

        $request->validate([
            'status' => 'required|in:diterima,ditolak',
            'batch'  => 'required'
        ]);

        $pendaftar->update([
            'status' => $request->status
        ]);

        return redirect()->route('perusahaan-beasiswa-siswa', [
            'user' => $pendaftar->user_id,
            'beasiswa' => $request->batch
        ])->with('success', 'Status pelamar diperbarui');
    }

    protected function guard(BeasiswaBatch $batch)
    {
        abort_if($batch->perusahaan_id !== Auth::id(), 403);
    }
}
