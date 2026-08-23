<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Menampilkan daftar Project Mitra (PBL / Teaching Factory)
     */
    public function index()
    {
        $projects = Project::with('perusahaan')
            ->select('*')
            ->selectRaw('DATE(tanggal_mulai) as tanggal_mulai')
            ->selectRaw('DATE(tanggal_selesai) as tanggal_selesai')
            ->latest()
            ->paginate(10);

        return view('siswa.project.index', compact('projects'));
    }

    /**
     * Menampilkan detail project mitra
     */
    public function show(Project $project)
    {
        $project->load('perusahaan');
        return view('siswa.project.show', compact('project'));
    }
}
