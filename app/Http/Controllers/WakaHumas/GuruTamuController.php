<?php

namespace App\Http\Controllers\WakaHumas;

use App\Http\Controllers\Controller;
use App\Models\Guru_Tamu;
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
        $guruTamus = Guru_Tamu::latest()->paginate(10);
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
     * @param  \App\Models\Guru_Tamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function show(Guru_Tamu $guru_tamu)
    {
        return view('waka_humas.guru_tamu.show', compact('guru_tamu'));
    }

    /**
     * Approve the specified guru tamu.
     *
     * @param  \App\Models\Guru_Tamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function approve(Guru_Tamu $guru_tamu)
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
     * @param  \App\Models\Guru_Tamu  $guru_tamu
     * @return \Illuminate\Http\Response
     */
    public function reject(Guru_Tamu $guru_tamu)
    {
        // Karena kolom status hanya menerima 'disetujui' atau 'proses',
        // kita akan mengubah status menjadi 'proses' sebagai penanda ditolak
        $guru_tamu->update(['status' => 'proses']);
        return redirect()->route('waka-humas.guru-tamu.index')
            ->with('success', 'Guru tamu berhasil ditandai sebagai proses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

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
