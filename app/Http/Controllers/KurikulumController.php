<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    public function perusahaanStore(Request $request)
    {

        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'deskripsi' => 'required',
            'file' => 'required | mimes:pdf',
        ]);

        $file = $request->file('file');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('kurikulum'), $fileName);

        Kurikulum::create([
            'nama_kurikulum' => $request->nama,
            'pengirim_id' => auth()->user()->id,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'file_kurikulum' => $fileName,
            'validasi_sekolah' => 'proses',
            'validasi_perusahaan' => 'disetujui'
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }

    public function perusahaanList()
    {
        return view('perusahaan.kurikulum.list-diajukan', [
            'kurikulums' => Kurikulum::where('pengirim_id', auth()->user()->id)->get()
        ]);
    }

    public function perusahaanValidasi()
    {
        return view('perusahaan.kurikulum.list-validasi', [
            'kurikulums' => Kurikulum::where('pengirim_id','!==', auth()->user()->id)->get()
        ]);
    }

    public function perusahaanDestroy(Kurikulum $kurikulum)
    {
        $kurikulum->delete();
        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }

    public function perusahaanEdit(Kurikulum $kurikulum)
    {
        return view('perusahaan.kurikulum.edit', [
            'kurikulum' => $kurikulum
        ]);
    }

    public function perusahaanUpdate(Request $request, Kurikulum $kurikulum)
    {

        $request->validate([
            'nama' => 'required|string',
            'tahun' => 'required|string',
            'deskripsi' => 'required|string',
            'file' => 'nullable|file|mimes:pdf',
        ]);

        
        if ($request->hasFile('file')) {
            // dd($request->all());
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('kurikulum'), $fileName);
            $kurikulum->file_kurikulum = $fileName;
        }

        $kurikulum->save();

        $kurikulum->update([
            'nama_kurikulum' => $request->nama,
            'tahun_ajaran' => $request->tahun,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('perusahaan-kurikulum-list-diajukan');
    }
    public function perusahaanSetuju(Kurikulum $kurikulum)
    {
        $kurikulum->update([
            'validasi_perusahaan' => 'disetujui'
        ]);
        return redirect()->route('perusahaan-kurikulum-list-validasi');
    }

    public function perusahaanTolak(Kurikulum $kurikulum, Request $request)
    {
        $kurikulum->update([
            'validasi_perusahaan' => 'tidak_disetujui',
            'komentar' => $request->komentar
        ]);

        return redirect()->route('perusahaan-kurikulum-list-validasi');
    }
}
