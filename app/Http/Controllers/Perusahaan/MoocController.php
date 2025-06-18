<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Mooc;

class MoocController extends Controller
{
    public function index()
    {
        return view('perusahaan.mooc.index', [
            'moocs' => auth()->user()->moocs()->get()
        ]);
    }

    public function create()
    {
        return view('perusahaan.mooc.create');
    }

    public function show(Mooc $mooc)
    {
        return view('perusahaan.mooc.show', [
            'mooc' => $mooc
        ]);
    }

    public function edit(Mooc $mooc)    
    {
        return view('perusahaan.mooc.edit', [
            'mooc' => $mooc
        ]);
    }
    public function update(Request $request, Mooc $mooc)
    {
        $request->validate([
            'judul_pelatihan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link_materi' => 'nullable|url|max:255',
            'dokumen_materi' => 'nullable|file|mimes:pdf|max:2048', // Nullable karena opsional
        ], [
            'judul_pelatihan.required' => 'Judul pelatihan wajib diisi.',
            'deskripsi.required' => 'Deskripsi pelatihan wajib diisi.',
            'link_materi.url' => 'Format link materi tidak valid.',
            'dokumen_materi.file' => 'Input harus berupa file.',
            'dokumen_materi.mimes' => 'Dokumen materi harus berformat PDF',
            'dokumen_materi.max' => 'Ukuran dokumen materi maksimal 2MB.',
        ]);

        if ($request->hasFile('dokumen_materi')) {
            if ($mooc->dokumen_materi && Storage::disk('public')->exists($mooc->dokumen_materi)) {
                Storage::disk('public')->delete($mooc->dokumen_materi);
            }

            $dokumenPath = $request->file('dokumen_materi')->store('public/mooc');
            $dokumenPath = str_replace('public/', '', $dokumenPath);
            $mooc->dokumen_materi = $dokumenPath;
        }

        $mooc->judul_pelatihan = $request->judul_pelatihan;
        $mooc->deskripsi = $request->deskripsi;
        $mooc->link_materi = $request->link_materi; // Pastikan ini juga diperbarui
        $mooc->save(); // Simpan perubahan

        return redirect()->route('perusahaan-mooc-index')->with('success', 'Pelatihan MOOC berhasil diperbarui!');
    }

    public function destroy(Mooc $mooc)
    {
        $mooc->delete();
        return redirect()->route('perusahaan-mooc-index')->with('success', 'Data berhasil dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
            'link_materi' => 'required',
            'dokumen_materi' => 'required | file | mimes:pdf'
        ]);

        Mooc::create([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'link_materi' => $request->link_materi,
            'dokumen_materi' => $request->file('dokumen_materi')->store('mooc/', 'public'),
            'perusahaan_id' => auth()->user()->id
        ]);

        return redirect()->route('perusahaan-mooc-index')->with('success', 'Data berhasil disimpan');
    }
}
