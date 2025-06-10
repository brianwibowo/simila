<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

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

        $path = $request->file('file_brief')->store('project/brief/', 'public');

        Project::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'file_brief' => $path,
        ]);

        return redirect()->route('perusahaan-project-index');
    }

    public function show()
    {
        return view('perusahaan.project_mitra.show');
    }

    public function edit(Project $project)
    {
        return view('perusahaan.project_mitra.edit',[
            'project' => $project
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'file_brief' => 'nullable | file | mimes:pdf'
        ]);

        if($request->hasFile('file_brief')) {
            Storage::delete($project->file_brief);
            $path = $request->file('file_brief')->store('project/brief/', 'public');
            $project->file_brief = $path;
            $project->save();
        }

        $project->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
        ]);

        return redirect()->route('perusahaan-project-index');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('perusahaan-project-index');
    }
}
