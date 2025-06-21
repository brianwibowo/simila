<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\ScoutingBatch;

class ScoutingController extends Controller
{
    public function index()
    {
        return view('perusahaan.scoutings.index', [
            'batches' => auth()->user()->batch()->get()
        ]);
    }

    public function create()
    {
        return view ('perusahaan.scoutings.create');
    }

    public function show(ScoutingBatch $scouting)
    {
        return view('perusahaan.scoutings.show', [
            'scouting' => $scouting
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        ScoutingBatch::create([
            'batch' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'perusahaan_id' => auth()->user()->id,
            'status' => 'open'
        ]);

        return redirect()->route('perusahaan-scouting-index')->with('success', 'Batch berhasil ditambahkan');
    }

    public function edit(ScoutingBatch $scouting)
    {
        return view('perusahaan.scoutings.edit', [
            'scouting' => $scouting
        ]);
    }

    public function update(Request $request, ScoutingBatch $scouting)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $scouting->update([
            'batch' => $request->nama,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('perusahaan-scouting-index')->with('success', 'Batch berhasil diperbarui');
    }

    public function destroy (ScoutingBatch $scouting)
    {
        $scouting->delete();
        return redirect()->route('perusahaan-scouting-index')->with('success', 'Batch berhasil dihapus');
    }
}
