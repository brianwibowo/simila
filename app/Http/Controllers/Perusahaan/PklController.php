<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\Pkl;

class PklController extends Controller
{
    public function index()
    {
        return view('perusahaan.pkl.index', [
            'pkls' => Pkl::all()
        ]);
    }

    public function show()
    {
        return view('perusahaan.pkl.show');
    }

    public function validasi(Request $request, Pkl $pkl)
    {
        $pkl->status = 'valid';
        $pkl->save();

        return redirect()->route('perusahaan-pkl-index');
    }

    public function tolak(Request $request, Pkl $pkl)
    {
        $pkl->status = 'tolak';
        $pkl->save();

        return redirect()->route('perusahaan-pkl-index');
    }
}
