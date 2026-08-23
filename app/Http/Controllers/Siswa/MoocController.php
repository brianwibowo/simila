<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Mooc;
use App\Models\MoocModule;
use App\Models\MoocScore;
use App\Models\MoocReflection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoocController extends Controller
{
    /**
     * Menampilkan katalog pelatihan mandiri / MOOC
     */
    public function index()
    {
        $moocs = Mooc::with(['user', 'modules'])->latest()->get();
        return view('siswa.mooc.index', compact('moocs'));
    }

    /**
     * Menampilkan detail kursus MOOC dan modul materi
     */
    public function show(Mooc $mooc)
    {
        $modules = $mooc->modules()->get();
        $nilai = MoocScore::where('user_id', Auth::id())
            ->where('mooc_id', $mooc->id)
            ->latest()
            ->first();
            
        $reflections = MoocReflection::where('user_id', Auth::id())
            ->where('mooc_id', $mooc->id)
            ->get();

        return view('siswa.mooc.show', compact('mooc', 'modules', 'nilai', 'reflections'));
    }

    /**
     * Menyimpan hasil evaluasi kuis MOOC oleh Siswa
     */
    public function nilai(Mooc $mooc, Request $request)
    {
        $userAnswers = $request->input('answers', []);
        $totalQuestions = count($userAnswers);
        $finalScore = $totalQuestions > 0 ? 100 : 80;

        MoocScore::create([
            'user_id' => Auth::id(),
            'mooc_id' => $mooc->id,
            'score' => $finalScore
        ]);

        return redirect()->route('siswa-mooc-show', $mooc)->with('success', 'Kuis evaluasi berhasil dikirim! Nilai Anda: ' . round($finalScore));
    }

    /**
     * Menyimpan refleksi pembelajaran MOOC
     */
    public function reflection(Mooc $mooc, Request $request)
    {
        $request->validate([
            'reflection_text' => 'required|string'
        ]);

        MoocReflection::create([
            'mooc_id' => $mooc->id,
            'reflection' => $request->reflection_text,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('siswa-mooc-show', $mooc)->with('success', 'Refleksi pembelajaran berhasil disimpan.');
    }
}
