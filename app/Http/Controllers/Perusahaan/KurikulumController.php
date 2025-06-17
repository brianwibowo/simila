<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'deskripsi' => 'required',
            'file' => 'required | mimes:pdf',
        ]);

        $path = $request->file('file')->store('kurikulum/', 'public');

        Kurikulum::create([
            'nama_kurikulum' => $request->nama,
            'pengirim_id' => auth()->user()->id,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'file_kurikulum' => $path,
            'validasi_sekolah' => 'proses',
            'validasi_perusahaan' => 'disetujui'
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }

    public function create()
    {
        return view('perusahaan.kurikulum.create');
    }

    public function index()
    {
        return view('perusahaan.kurikulum.list-diajukan', [
            'kurikulums' => Kurikulum::where('pengirim_id', auth()->user()->id)->get()
        ]);
    }    public function validasi()
    {
        // Get all kurikulums submitted by admin users, regardless of validation status
        return view('perusahaan.kurikulum.list-validasi', [
            'kurikulums' => Kurikulum::whereHas('pengirim', function($query) {
                $query->role('admin');
            })->orderBy('validasi_perusahaan', 'asc') // Show 'proses' status first
              ->orderBy('created_at', 'desc')
              ->get()
        ]);
    }

    public function destroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();
        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }

    public function edit(Kurikulum $kurikulum)
    {
        return view('perusahaan.kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }

    public function update(Request $request, Kurikulum $kurikulum)
    {

        $request->validate([
            'nama' => 'required|string',
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf',
        ]);

        
        if ($request->hasFile('file')) {
            Storage::delete($kurikulum->file_kurikulum);
            $path = $request->file('file')->store('kurikulum/', 'public');
            $kurikulum->file_kurikulum = $path;
            $kurikulum->save();
        }        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'validasi_sekolah' => 'proses', // Reset validation status as it's been modified
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diperbarui. Kurikulum akan kembali ke status Menunggu Validasi.');
    }    public function setuju(Kurikulum $kurikulum)
    {
        // Perusahaan can only validate kurikulum from admin
        if (!$kurikulum->pengirim->hasRole('admin')) {
            return redirect()->route('perusahaan-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari admin sekolah');
        }
        
        $kurikulum->update([
            'validasi_perusahaan' => 'disetujui'
        ]);
        return redirect()->route('perusahaan-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil disetujui');
    }public function tolak(Kurikulum $kurikulum, Request $request)
    {
        // Perusahaan can only validate kurikulum from admin
        if (!$kurikulum->pengirim->hasRole('admin')) {
            return redirect()->route('perusahaan-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari admin sekolah');
        }
        
        $request->validate([
            'komentar' => 'required|string',
        ]);
        
        $kurikulum->update([
            'validasi_perusahaan' => 'tidak_disetujui',
            'komentar' => $request->komentar
        ]);

        return redirect()->route('perusahaan-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil ditolak');
    }
}
