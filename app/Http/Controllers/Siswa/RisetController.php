<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Riset;
use Illuminate\Http\Request;

class RisetController extends Controller
{
    /**
     * Menampilkan daftar riset terapan & inovasi produk bersama DUDI
     */
    public function index()
    {
        $risets = Riset::with('anggota.user')
            ->latest()
            ->paginate(10);

        return view('siswa.riset.index', compact('risets'));
    }

    /**
     * Menampilkan detail riset terapan
     */
    public function show(Riset $riset)
    {
        $riset->load('anggota.user');
        return view('siswa.riset.show', compact('riset'));
    }
}
