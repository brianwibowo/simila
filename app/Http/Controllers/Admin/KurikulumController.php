<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    public function index()
    {
        return view('admin.kurikulum.list-diajukan', [
            'kurikulums' => Kurikulum::where('pengirim_id', auth()->user()->id)->get()
        ]);
    }    

    public function validasi()
    {
        return view('admin.kurikulum.list-validasi', [
            'kurikulums' => Kurikulum::whereHas('pengirim', function($query) {
                $query->role('perusahaan');
            })->orderBy('validasi_sekolah', 'asc')
              ->orderBy('created_at', 'desc')
              ->get()
        ]);
    }

    public function monitorWakaKurikulum()
    {
        return view('admin.kurikulum.monitor-waka-kurikulum', [
            'kurikulums' => Kurikulum::whereHas('pengirim', function($query) {
                $query->role('waka_kurikulum');
            })->orderBy('validasi_perusahaan', 'asc') // Show 'proses' status first
              ->orderBy('created_at', 'desc')
              ->get()
        ]);
    }

    public function create()
    {
        return view('admin.kurikulum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:kurikulums,nama_kurikulum',
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'required|mimes:pdf',
        ]);

        $path = $request->file('file')->store('kurikulum/', 'public');

        Kurikulum::create([
            'nama_kurikulum' => $request->nama,
            'pengirim_id' => auth()->user()->id,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'file_kurikulum' => $path,
            'validasi_sekolah' => 'disetujui',
            'validasi_perusahaan' => 'proses'
        ]);

        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diajukan untuk validasi perusahaan');
    }    

    public function edit(Kurikulum $kurikulum)
    {
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('admin-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan mengedit kurikulum ini');
        }
        
        return view('admin.kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }

    public function update(Request $request, Kurikulum $kurikulum)
    {
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('admin-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan mengedit kurikulum ini');
        }

        $request->validate([
            'nama' => 'required|string|unique:kurikulums,nama_kurikulum,'.$kurikulum->id,
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|mimes:pdf',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($kurikulum->file_kurikulum);
            $path = $request->file('file')->store('kurikulum/', 'public');
            $kurikulum->update([
                'file_kurikulum' => $path
            ]);
        }

        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'validasi_perusahaan' => 'proses',
        ]);        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diperbarui. Kurikulum akan kembali ke status Menunggu Validasi.');
    }    

    public function destroy(Kurikulum $kurikulum)
    {
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('admin-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan menghapus kurikulum ini');
        }

        $kurikulum->delete();
        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil dihapus');
    }    public function setuju(Kurikulum $kurikulum)
    {
        if (!$kurikulum->pengirim->hasRole('perusahaan')) {
            return redirect()->route('admin-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari perusahaan');
        }
        
        $kurikulum->update([
            'validasi_sekolah' => 'disetujui',
        ]);
        
        return redirect()->route('admin-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil disetujui');
    }    public function tolak(Request $request, Kurikulum $kurikulum)
    {
        if (!$kurikulum->pengirim->hasRole('perusahaan')) {
            return redirect()->route('admin-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari perusahaan');
        }
        
        $request->validate([
            'komentar' => 'required|string',
        ]);
        
        $kurikulum->update([
            'validasi_sekolah' => 'tidak_disetujui',
            'komentar' => $request->komentar
        ]);

        return redirect()->route('admin-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil ditolak');
    }
}