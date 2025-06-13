<?php

namespace App\Http\Controllers\WakaHumas;

use App\Http\Controllers\Controller;
use App\Models\GuruTamu;
use Illuminate\Http\Request;

class GuruTamuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guruTamus = GuruTamu::latest()->paginate(10);
        return view('waka_humas.guru_tamu.index', compact('guruTamus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GuruTamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function show(GuruTamu $guru_tamu)
    {
        return view('waka_humas.guru_tamu.show', compact('guru_tamu'));
    }

    /**
     * Approve the specified guru tamu.
     *
     * @param  \App\Models\GuruTamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function approve(GuruTamu $guru_tamu)
    {
        $guru_tamu->update(['status' => 'disetujui']);
        return redirect()->route('waka-humas.guru-tamu.index')
            ->with('success', 'Guru tamu berhasil disetujui');
    }

    /**
     * Reject the specified guru tamu.
     * Karena kolom status hanya menerima 'disetujui' atau 'proses',
     * kita akan mengubah status menjadi 'proses' sebagai penanda ditolak
     *
     * @param  \App\Models\GuruTamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function reject(GuruTamu $guru_tamu)
    {
        $guru_tamu->update(['status' => 'ditolak']);
        return redirect()->route('waka-humas.guru-tamu.index')
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
