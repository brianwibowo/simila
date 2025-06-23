<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Mooc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MoocController extends Controller
{
    public function index()
    {
        return view('guru.mooc.index', [
            'moocs' => Mooc::all(),
        ]);
    }
}
