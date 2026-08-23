<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\GuruTamu;
use Illuminate\Http\Request;

class GuruTamuController extends Controller
{
    /**
     * Menampilkan daftar program guru tamu dari praktisi industri
     */
    public function index()
    {
        $guruTamus = GuruTamu::with('submitter')
            ->latest()
            ->paginate(10);

        return view('siswa.guru_tamu.index', compact('guruTamus'));
    }

    /**
     * Menampilkan detail sesi guru tamu industri
     */
    public function show(GuruTamu $guru_tamu)
    {
        $guru_tamu->load('submitter');
        return view('siswa.guru_tamu.show', compact('guru_tamu'));
    }
}
