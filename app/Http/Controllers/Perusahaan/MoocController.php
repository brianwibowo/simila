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
            'mooc' => $mooc,
            'modules' => $mooc->modules()->get()
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
        ], [
            'judul_pelatihan.required' => 'Judul pelatihan wajib diisi.',
            'deskripsi.required' => 'Deskripsi pelatihan wajib diisi.',
        ]);

        $mooc->judul_pelatihan = $request->judul_pelatihan;
        $mooc->deskripsi = $request->deskripsi;
        $mooc->save();

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
        ]);

        Mooc::create([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'perusahaan_id' => auth()->user()->id
        ]);

        return redirect()->route('perusahaan-mooc-index')->with('success', 'Data berhasil disimpan');
    }
}
