<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        return view('perusahaan.project_mitra.index', [
            'projects' => Project::all()
        ]);
    }

    public function create()
    {
        return view('perusahaan.project_mitra.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'file_brief' => 'required | file | mimes:pdf'
        ]);

        $file = $request->file('file_brief');
        $fileName = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('project'), $fileName);

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'file_brief' => $fileName,
        ]);

        return redirect()->route('perusahaan-project-index');
    }

    public function show()
    {
        return view('perusahaan.project_mitra.show');
    }

    public function edit()
    {
        return view('perusahaan.project_mitra.edit');
    }

    public function update()
    {
        //
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('perusahaan-project-index');
    }
}
