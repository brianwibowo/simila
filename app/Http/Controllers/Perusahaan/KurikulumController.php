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
            'kurikulums' => Kurikulum::where('pengirim_id','!==', auth()->user()->id)->get()
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
        }


        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }
    public function setuju(Kurikulum $kurikulum)
    {
        $kurikulum->update([
            'validasi_perusahaan' => 'disetujui'
        ]);
        return redirect()->route('perusahaan-kurikulum-list-validasi');
    }

    public function tolak(Kurikulum $kurikulum, Request $request)
    {
        $kurikulum->update([
            'validasi_perusahaan' => 'tidak_disetujui',
            'komentar' => $request->komentar
        ]);

        return redirect()->route('perusahaan-kurikulum-list-validasi');
    }
}
