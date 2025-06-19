<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Siswa;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PKL;

class PklController extends Controller
{
    public function index()
    {
        return view('siswa.pkl.index', [
            'pkls' => PKL::with('perusahaan')->get(),
            'currentStudentPklId' => auth()->user()->pkl_id 
        ]);
    }

    public function show()
    {
        $pkl_id = auth()->user()->pkl_id;
        return view('siswa.pkl.show', [
            'pkl' => PKL::with('perusahaan')->find($pkl_id)
        ]);
    }

    public function register(PKL $pkl){
        auth()->user()->pkl_id = $pkl->id;
        auth()->user()->pkl_status = 'proses';
        auth()->user()->save();
        return redirect()->route('siswa-pkl-index');
    }  
}
