<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Logbook;
use App\Models\LogbookContent;

class LogbookController extends Controller
{
    public function index()
    {
        if (auth()->user()->logbook === null) {
            return redirect()->route('siswa-pkl-index');    
        };

        $logbooks = auth()->user()->logbook->logbookContents()->paginate(10);

        return view('siswa.pkl.logbook.index', [
            'logbooks' => $logbooks,
            'pkl' => auth()->user()->pklSiswa->nama
        ]);
    }

    public function create()
    {
        return view('siswa.pkl.logbook.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required',
            'nama' => 'required',
            'detail' => 'required',
            'dokumentasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $dokumentasiPath = $request->file('dokumentasi')->store('public/logbook');
        $dokumentasiPath = str_replace('public/', '', $dokumentasiPath);
        
        LogbookContent::create([
            'tanggal' => $request->tanggal,
            'nama' => $request->nama,
            'detail' => $request->detail,
            'dokumentasi' => $dokumentasiPath,
            'logbook_id' => auth()->user()->logbook->id
        ]);

        return redirect()->route('siswa-logbook-index');
    }

    public function edit()
    {
        $pkl_id = auth()->user()->pkl_id;
        return view('siswa.logbook.edit', [
            'pkl' => PKL::with('perusahaan')->find($pkl_id)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logbook' => 'required|mimes:pdf'
        ]);

        $user = auth()->user();

        $user->update([
            'logbook' => $request->file('logbook')->store('logbook/', 'public')
        ]);

        return redirect()->route('siswa-logbook-index');
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->update([
            'logbook' => null
        ]);
        return redirect()->route('siswa-logbook-index');
    }
}
