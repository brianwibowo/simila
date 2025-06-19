<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\PKL;
use App\Models\User;
use App\Models\Logbook;

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

    public function list(){
        $pkl_ids = PKL::where('perusahaan_id', '=', auth()->user()->id)->pluck('id')->toArray();

        $users = User::where('pkl_id', '!=', null)
        ->whereIn('pkl_id', $pkl_ids)
        ->get();

        return view('perusahaan.pkl.list', [
            'siswas' => $users
        ]);
    }

    public function terima(User $user){
        $user->pkl_status = 'disetujui';
        $user->save();

        Logbook::create([
            'siswa_id' => $user->id,
            'pkl_id' => $user->pkl_id,
            'status' => 'proses',
        ]);

        return redirect()->route('perusahaan-pkl-list');
    }

    public function tolak(User $user){
        $user->pkl_status = 'tidak_disetujui';
        $user->pkl_id = null;
        $user->save();
        return redirect()->route('perusahaan-pkl-list');
    }

    public function siswa(User $user){
        $logbooks = $user->logbook->logbookContents()->paginate(10);
        return view('perusahaan.pkl.siswa', [
            'user' => $user,
            'logbooks' => $logbooks
        ]);
    }

    public function nilai(User $user, Request $request){
        $request->validate([
            'nilai' => 'required'
        ]);

        $user->update([
            'nilai_pkl' => $request->nilai
        ]);

        return redirect()->route('perusahaan-pkl-siswa', $user->id);
    }
}