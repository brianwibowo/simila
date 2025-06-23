<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Mooc;
use App\Models\MoocScore;
use App\Models\User;
use App\Models\MOOC_Eval;

class MoocController extends Controller
{
    public function index()
    {
        return view('perusahaan.mooc.index', [
            'moocs' => auth()->user()->moocs()->get()
        ]);
    }

    public function create()
    {
        return view('perusahaan.mooc.create');
    }

    public function show(Mooc $mooc)
    {
        $userIds = $mooc->reflections()->where('mooc_id', $mooc->id)->get()
            ->pluck('user_id')
            ->toArray();

        return view('perusahaan.mooc.show', [
            'mooc' => $mooc,
            'modules' => $mooc->modules()->get(),
            'quizzes' => $mooc->quizzes()->get(),
            'reflections' => $mooc->reflections()->get(),
            'participants' => $mooc->nilai()->whereIn('user_id', $userIds)->get()
        ]);
    }   


    public function edit(Mooc $mooc)    
    {
        return view('perusahaan.mooc.edit', [
            'mooc' => $mooc
        ]);
    }
    public function update(Request $request, Mooc $mooc)
    {
        $request->validate([
            'judul_pelatihan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
        ], [
            'judul_pelatihan.required' => 'Judul pelatihan wajib diisi.',
            'deskripsi.required' => 'Deskripsi pelatihan wajib diisi.',
        ]);

        $mooc->judul_pelatihan = $request->judul_pelatihan;
        $mooc->deskripsi = $request->deskripsi;
        $mooc->save();

        return redirect()->route('perusahaan-mooc-index')->with('success', 'Pelatihan MOOC berhasil diperbarui!');
    }

    public function destroy(Mooc $mooc)
    {
        $mooc->delete();
        return redirect()->route('perusahaan-mooc-index')->with('success', 'Data berhasil dihapus');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_pelatihan' => 'required',
            'deskripsi' => 'required',
        ]);

        Mooc::create([
            'judul_pelatihan' => $request->judul_pelatihan,
            'deskripsi' => $request->deskripsi,
            'perusahaan_id' => auth()->user()->id
        ]);

        return redirect()->route('perusahaan-mooc-index')->with('success', 'Data berhasil disimpan');
    }

    
    public function createQuiz(Mooc $mooc){
        return view('perusahaan.mooc.quiz.create', [
            'mooc' => $mooc
        ]);
    }

    public function editQuiz(MOOC_Eval $quiz){
        return view('perusahaan.mooc.quiz.edit', [
            'quiz' => $quiz,
            'mooc' => $quiz->mooc
        ]);
    }

    public function storeQuiz(Request $request, Mooc $mooc){
        $request->validate([
            'mooc_id' => 'required',
            'soal' => 'required',
            'pilihan_jawaban_1' => 'required',
            'pilihan_jawaban_2' => 'required',
            'pilihan_jawaban_3' => 'required',
            'pilihan_jawaban_4' => 'required',
            'jawaban_benar' => 'required',
        ]);

        Mooc_Eval::create([
            'mooc_id' => $request->mooc_id,
            'soal' => $request->soal,
            'pilihan_jawaban_1' => $request->pilihan_jawaban_1,
            'pilihan_jawaban_2' => $request->pilihan_jawaban_2,
            'pilihan_jawaban_3' => $request->pilihan_jawaban_3,
            'pilihan_jawaban_4' => $request->pilihan_jawaban_4,
            'jawaban_benar' => $request->jawaban_benar,
        ]);

        return redirect()->route('perusahaan-mooc-index');
    }

    public function destroyQuiz(MOOC_Eval $quiz){
        $mooc_id = $quiz->mooc_id;
        $quiz->delete();
        return redirect()->route('perusahaan-mooc-show', ['mooc' => $mooc_id])->with('success', 'Data berhasil dihapus');
    }

    public function updateQuiz(Request $request, MOOC_Eval $quiz){
        $quiz->update([
            'soal' => $request->soal,
            'pilihan_jawaban_1' => $request->pilihan_jawaban_1,
            'pilihan_jawaban_2' => $request->pilihan_jawaban_2,
            'pilihan_jawaban_3' => $request->pilihan_jawaban_3,
            'pilihan_jawaban_4' => $request->pilihan_jawaban_4,
            'jawaban_benar' => $request->jawaban_benar,
        ]);
        return redirect()->route('perusahaan-mooc-show', ['mooc' => $quiz->mooc_id])->with('success', 'Data berhasil diperbarui');
    }

    public function uploadSertifikat(Request $request, Mooc $mooc, User $user){
        $request->validate([
            'sertifikat_file' => 'required|file|mimes:pdf',
        ]);

        $moocEvals = MoocScore::where('mooc_id', $mooc->id)->where('user_id', $user->id)->first();

        if($moocEvals){
            $moocEvals->update([
                'file_sertifikat' => $request->file('sertifikat_file')->store('mooc_evals', 'public'),
            ]);
        }
        else{
            MoocScore::create([
                'mooc_id' => $mooc->id,
                'user_id' => $user->id,
                'file_sertifikat' => $request->file('sertifikat_file')->store('mooc_evals', 'public'),
            ]);
        }

        return redirect()->route('perusahaan-mooc-show', ['mooc' => $mooc->id])->with('success', 'Data berhasil disimpan');
    }
}
