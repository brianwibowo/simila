<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    /**
     * Menampilkan daftar kurikulum yang diselaraskan dengan industri
     */
    public function index()
    {
        $kurikulums = Kurikulum::with(['pengirim', 'perusahaan'])
            ->latest()
            ->paginate(10);

        return view('siswa.kurikulum.index', compact('kurikulums'));
    }

    /**
     * Menampilkan detail kurikulum bersama
     */
    public function show(Kurikulum $kurikulum)
    {
        $kurikulum->load(['pengirim', 'perusahaan']);
        return view('siswa.kurikulum.show', compact('kurikulum'));
    }
}
