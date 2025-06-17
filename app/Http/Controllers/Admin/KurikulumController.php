<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    /**
     * Display a listing of kurikulums submitted by the admin
     */
    public function index()
    {
        return view('admin.kurikulum.list-diajukan', [
            'kurikulums' => Kurikulum::where('pengirim_id', auth()->user()->id)->get()
        ]);
    }    /**
     * Display a listing of kurikulums submitted by perusahaan for review
     */
    public function validasi()
    {
        // Get all kurikulums submitted by perusahaan users, regardless of validation status
        return view('admin.kurikulum.list-validasi', [
            'kurikulums' => Kurikulum::whereHas('pengirim', function($query) {
                $query->role('perusahaan');
            })->orderBy('validasi_sekolah', 'asc') // Show 'proses' status first
              ->orderBy('created_at', 'desc')
              ->get()
        ]);
    }

    /**
     * Show the form for creating a new kurikulum
     */
    public function create()
    {
        return view('admin.kurikulum.create');
    }

    /**
     * Store a newly created kurikulum
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|unique:kurikulums,nama_kurikulum',
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'required|mimes:pdf',
        ]);

        $path = $request->file('file')->store('kurikulum/', 'public');

        // Create kurikulum that will be validated by perusahaan
        Kurikulum::create([
            'nama_kurikulum' => $request->nama,
            'pengirim_id' => auth()->user()->id,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'file_kurikulum' => $path,
            'validasi_sekolah' => 'disetujui', // Admin already approves from school side
            'validasi_perusahaan' => 'proses'  // Needs perusahaan validation
        ]);

        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diajukan untuk validasi perusahaan');
    }    /**
     * Show the form for editing the specified kurikulum
     */
    public function edit(Kurikulum $kurikulum)
    {
        // Make sure the user is authorized to edit this kurikulum
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('admin-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan mengedit kurikulum ini');
        }
        
        return view('admin.kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }

    /**
     * Update the specified kurikulum
     */
    public function update(Request $request, Kurikulum $kurikulum)
    {
        // Make sure the user is authorized to update this kurikulum
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

        // Update file if needed
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($kurikulum->file_kurikulum);
            $path = $request->file('file')->store('kurikulum/', 'public');
            $kurikulum->update([
                'file_kurikulum' => $path
            ]);
        }

        // Update kurikulum data
        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'validasi_perusahaan' => 'proses', // Reset validation status as it's been modified
        ]);        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil diperbarui. Kurikulum akan kembali ke status Menunggu Validasi.');
    }    /**
     * Remove the specified kurikulum
     */
    public function destroy(Kurikulum $kurikulum)
    {
        // Make sure the user is authorized to delete this kurikulum
        if ($kurikulum->pengirim_id !== auth()->id()) {
            return redirect()->route('admin-kurikulum-list-diajukan')
                ->with('error', 'Anda tidak diizinkan menghapus kurikulum ini');
        }

        $kurikulum->delete();
        return redirect()->route('admin-kurikulum-list-diajukan')
            ->with('success', 'Kurikulum berhasil dihapus');
    }

    /**
     * Approve a kurikulum
     */
    public function setuju(Kurikulum $kurikulum)
    {
        // Admin can only validate kurikulum from perusahaan
        if (!$kurikulum->pengirim->hasRole('perusahaan')) {
            return redirect()->route('admin-kurikulum-list-validasi')
                ->with('error', 'Anda hanya dapat memvalidasi kurikulum dari perusahaan');
        }
        
        $kurikulum->update([
            'validasi_sekolah' => 'disetujui',
        ]);
        
        return redirect()->route('admin-kurikulum-list-validasi')
            ->with('success', 'Kurikulum berhasil disetujui');
    }

    /**
     * Reject a kurikulum
     */
    public function tolak(Request $request, Kurikulum $kurikulum)
    {
        // Admin can only validate kurikulum from perusahaan
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
