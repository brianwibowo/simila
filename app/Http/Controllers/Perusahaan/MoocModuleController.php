<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Mooc;
use App\Models\MoocModule;
class MoocModuleController extends Controller
{
    public function create(Mooc $mooc){
        return view('perusahaan.mooc.module.create', [
            'mooc' => $mooc
        ]);
    }

    public function edit(MoocModule $module){
        return view('perusahaan.mooc.module.edit', [
            'module' => $module
        ]);
    }

    public function show(MoocModule $module){
        return view('perusahaan.mooc.module.show', [
            'module' => $module
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'module_name' => 'required',
            'link_materi' => 'required',
            'dokumen_materi' => 'required|mimes:pdf',
            'question' => 'required',
            'pilihan_jawaban_1' => 'required',
            'pilihan_jawaban_2' => 'required',
            'pilihan_jawaban_3' => 'required',
            'pilihan_jawaban_4' => 'required',
            'answer' => 'required',
            'mooc_id' => 'required',
        ]);

        MoocModule::create([
            'module_name' => $request->module_name,
            'link_materi' => $request->link_materi,
            'dokumen_materi' => $request->file('dokumen_materi')->store('mooc_modules', 'public'),
            'question' => $request->question,
            'pilihan_jawaban_1' => $request->pilihan_jawaban_1,
            'pilihan_jawaban_2' => $request->pilihan_jawaban_2,
            'pilihan_jawaban_3' => $request->pilihan_jawaban_3,
            'pilihan_jawaban_4' => $request->pilihan_jawaban_4,
            'answer' => $request->answer,
            'mooc_id' => $request->mooc_id
        ]);

        return redirect()->route('perusahaan-mooc-show', ['mooc' => $request->mooc_id])->with('success', 'Data berhasil disimpan');
    }

    public function destroy(MoocModule $module){
        Storage::disk('public')->delete($module->dokumen_materi);
        $module->delete();
        return redirect()->route('perusahaan-mooc-show', ['mooc' => $module->mooc_id])->with('success', 'Data berhasil dihapus');
    }

    public function update(Request $request, MoocModule $module){
        //
    }
}
