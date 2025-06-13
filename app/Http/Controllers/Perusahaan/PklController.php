<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\PKL;

class PklController extends Controller
{
    public function index()
    {
        return view('perusahaan.pkl.index', [
            'pkls' => auth()->user()->pklPerusahaan()->get()
        ]);
    }

    public function show(PKL $pkl)
    {
        return view('perusahaan.pkl.show', [
            'pkl' => $pkl
        ]);
    }

    public function create(){
        return view('perusahaan.pkl.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        PKL::create([
            'nama' => $request->nama,
            'perusahaan_id' => auth()->user()->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'proses',
            'status_pembimbing' => 'proses',
            'status_waka_humas' => 'proses'
        ]);

        return redirect()->route('perusahaan-pkl-index');
    }

    public function edit(PKL $pkl){
        return view('perusahaan.pkl.edit', [
            'pkl' => $pkl
        ]);
    }

    public function update(Request $request, PKL $pkl){
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        $pkl->update([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);

        return redirect()->route('perusahaan-pkl-index');
    }

    public function destroy(PKL $pkl){
        $pkl->delete();
        return redirect()->route('perusahaan-pkl-index');
    }
}
