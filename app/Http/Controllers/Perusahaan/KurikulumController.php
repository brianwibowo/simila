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
    }    
      public function validasi()
    {
        return view('perusahaan.kurikulum.list-validasi', [
            'kurikulums' => Kurikulum::where(function($query) {
                $query->whereHas('pengirim', function($q) {
                    $q->whereHas('roles', function($innerQ) {
                        $innerQ->whereIn('name', ['admin', 'waka_kurikulum']);
                    });
                })->where(function($q) {
                    // Hanya menampilkan kurikulum yang ditujukan ke perusahaan ini
                    $q->where('perusahaan_id', auth()->user()->id)
                      ->orWhereNull('perusahaan_id'); // Backward compatibility untuk data lama
                });
            })->orderBy('validasi_perusahaan', 'asc') // Show 'proses' status first
              ->orderBy('created_at', 'desc')
              ->get()
        ]);
    }    public function destroy(Kurikulum $kurikulum)
    {
        // Tidak dapat menghapus kurikulum yang telah disetujui
        if ($kurikulum->validasi_sekolah == 'disetujui' && $kurikulum->validasi_perusahaan == 'disetujui') {
            return redirect()->route('perusahaan-kurikulum-list-diajukan')
                ->with('error', 'Kurikulum yang telah disetujui tidak dapat dihapus');
        }
        
        // Hanya dapat menghapus kurikulum sendiri
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('perusahaan-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan menghapus kurikulum ini');
        }
        
        $kurikulum->delete();
        return redirect()->route('perusahaan-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil dihapus');
    }public function edit(Kurikulum $kurikulum)
    {
        // Tidak dapat mengedit kurikulum yang telah disetujui
        if ($kurikulum->validasi_sekolah == 'disetujui' && $kurikulum->validasi_perusahaan == 'disetujui') {
            return redirect()->route('perusahaan-kurikulum-list-diajukan')
                ->with('error', 'Kurikulum yang telah disetujui tidak dapat diubah');
        }
        
        // Hanya dapat mengedit kurikulum sendiri
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('perusahaan-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan mengedit kurikulum ini');
        }
        
        return view('perusahaan.kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }public function update(Request $request, Kurikulum $kurikulum)
    {
        // If kurikulum is already fully approved, don't allow edit
        if ($kurikulum->validasi_sekolah == 'disetujui' && $kurikulum->validasi_perusahaan == 'disetujui') {
            return redirect()->route('perusahaan-kurikulum-list-diajukan')
                ->with('error', 'Kurikulum yang telah disetujui tidak dapat diubah');
        }

        $request->validate([
            'nama' => 'required|string',
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf',
        ]);        if ($request->hasFile('file')) {
            // Generate a unique filename to avoid overwriting existing files
            $filename = uniqid() . '_' . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('kurikulum', $filename, 'public');
            $kurikulum->file_kurikulum = $path;
            $kurikulum->save();
        }
        
        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'validasi_sekolah' => 'proses',
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diperbarui. Kurikulum akan kembali ke status Menunggu Validasi.');
    }    
    
    public function setuju(Kurikulum $kurikulum)
    {
        if (!$kurikulum->pengirim->hasAnyRole(['admin', 'waka_kurikulum'])) {
            return redirect()->route('perusahaan-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari admin atau waka kurikulum');
        }
        
        $kurikulum->update([
            'validasi_perusahaan' => 'disetujui'
        ]);
        return redirect()->route('perusahaan-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil disetujui');
    }    
    
    public function tolak(Kurikulum $kurikulum, Request $request)
    {
        if (!$kurikulum->pengirim->hasAnyRole(['admin', 'waka_kurikulum'])) {
            return redirect()->route('perusahaan-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari admin sekolah atau waka kurikulum');
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
