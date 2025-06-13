<?php

namespace App\Http\Controllers\WakaHumas;

use App\Http\Controllers\Controller;
use App\Models\GuruTamu;
use Illuminate\Http\Request;

class GuruTamuController extends Controller
{
    public function index()
    {
        $guruTamus = GuruTamu::latest()->paginate(10);
        return view('waka_humas.guru_tamu.index', compact('guruTamus'));
    }

    public function show(GuruTamu $guru_tamu)
    {
        return view('waka_humas.guru_tamu.show', compact('guru_tamu'));
    }

    public function approve(GuruTamu $guru_tamu)
    {
        $guru_tamu->update(['status' => 'disetujui']);
        return redirect()->route('waka-humas-guru-tamu-index')
            ->with('success', 'Guru tamu berhasil disetujui');
    }

    public function reject(GuruTamu $guru_tamu)
    {
        $guru_tamu->update(['status' => 'ditolak']);
        return redirect()->route('waka-humas-guru-tamu-index')
            ->with('success', 'Guru tamu berhasil ditolak');
    }

    // Method create, store, edit, update, dan destroy tidak digunakan
    // karena tidak diperlukan dalam alur kerja Waka Humas untuk modul Guru Tamu

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
