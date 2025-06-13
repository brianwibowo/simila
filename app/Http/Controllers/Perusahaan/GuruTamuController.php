<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\GuruTamu;

class GuruTamuController extends Controller
{
    public function index()
    {
        return view('perusahaan.guru_tamu.index', [
            'gurutamus' => GuruTamu::where('status', 'proses')->get()
        ]);
    }

    public function create()
    {
        return view('perusahaan.guru_tamu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'keahlian' => 'required',
            'deskripsi' => 'required',
            'jadwal' => 'required',
            'file_materi' => 'required | file | mimes:pdf',
            'file_cv' => 'nullable | file | mimes:pdf'
        ]);

        $path = $request->file('file_materi')->store('guru_tamu/materi/', 'public');

        $gurutamu = GuruTamu::create([
            'nama_karyawan' => $request->nama,
            'jabatan' => $request->jabatan,
            'keahlian' => $request->keahlian,
            'deskripsi' => $request->deskripsi,
            'jadwal' => $request->jadwal,
            'file_materi' => $path,
            'status' => 'proses'
        ]);

        if ($request->hasFile('file_cv')) {
            $path = $request->file('file_cv')->store('guru_tamu/cv/', 'public');
            $gurutamu->file_cv = $path;
            $gurutamu->save();
        }

        return redirect()->route('perusahaan-guru-tamu-index');
    }

    public function list()
    {
        return view('perusahaan.guru_tamu.list', [
            'gurutamus' => GuruTamu::where('status', 'disetujui')->get()
        ]);
    }

    public function edit(GuruTamu $guruTamu)
    {
        return view('perusahaan.guru_tamu.edit', [
            'guruTamu' => $guruTamu
        ]);
    }

    public function update(Request $request, GuruTamu $guruTamu)
    {
        $request->validate([
            'nama' => 'required',
            'jabatan' => 'required',
            'keahlian' => 'required',
            'deskripsi' => 'required',
            'jadwal' => 'required',
            'file_materi' => 'nullable | file | mimes:pdf',
            'file_cv' => 'nullable | file | mimes:pdf'
        ]);

        if ($request->hasFile('file_materi')) {
            Storage::delete($guruTamu->file_materi);
            $path = $request->file('file_materi')->store('guru_tamu/materi/', 'public');
            $guruTamu->file_materi = $path;
            $guruTamu->save();
        }

        if ($request->hasFile('file_cv')) {
            Storage::delete($guruTamu->file_cv);
            $path = $request->file('file_cv')->store('guru_tamu/cv/', 'public');
            $guruTamu->file_cv = $path;
            $guruTamu->save();
        }

        $guruTamu->update([
            'nama_karyawan' => $request->nama,
            'jabatan' => $request->jabatan,
            'keahlian' => $request->keahlian,
            'deskripsi' => $request->deskripsi,
            'jadwal' => $request->jadwal,
        ]);
        return redirect()->route('perusahaan-guru-tamu-index');
    }

    public function destroy(GuruTamu $guruTamu)
    {
        $guruTamu->delete();
        return redirect()->route('perusahaan-guru-tamu-index');
    }
}
