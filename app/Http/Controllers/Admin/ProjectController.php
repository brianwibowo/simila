<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::select('*')
            ->selectRaw('DATE(tanggal_mulai) as tanggal_mulai')
            ->selectRaw('DATE(tanggal_selesai) as tanggal_selesai')
            ->get();
            
        return view('admin.project.index', compact('projects'));
    }    public function uploadLaporan(Request $request, Project $project)
    {
        $request->validate([
            'file_laporan' => 'required|file|mimes:pdf,doc,docx|max:10240', // Maksimal 10MB
        ]);

        $today = now();
        $endDate = \Carbon\Carbon::parse($project->tanggal_selesai);
        $isAfterTimeline = $today > $endDate;

        if ($project->file_laporan) {
            Storage::disk('public')->delete($project->file_laporan);
        }

        $path = $request->file('file_laporan')->store('project/laporan', 'public');
        
        $notes = $request->notes;
        if (empty($notes)) {
            $notes = $isAfterTimeline 
                ? 'Laporan diupload oleh admin setelah timeline project berakhir. ' . $endDate->format('d M Y')
                : 'Diupload oleh admin';
        }
        
        $project->update([
            'file_laporan' => $path,
            'is_manual_upload' => true, // Tandai bahwa ini upload manual oleh admin
            'upload_notes' => $notes
        ]);

        $successMessage = $isAfterTimeline 
            ? 'Laporan berhasil diupload. Perhatikan bahwa Guru tidak akan dapat mengubah laporan ini.'
            : 'Laporan berhasil diupload.';

        return redirect()->route('admin-project-index')
            ->with('success', $successMessage);
    }    public function updateLaporan(Request $request, Project $project)
    {
        $request->validate([
            'file_laporan' => 'required|file|mimes:pdf,doc,docx|max:10240',
        ]);

        $today = now();
        $endDate = \Carbon\Carbon::parse($project->tanggal_selesai);
        $isAfterTimeline = $today > $endDate;

        if ($project->file_laporan) {
            Storage::disk('public')->delete($project->file_laporan);
        }

        $path = $request->file('file_laporan')->store('project/laporan', 'public');
        
        $notes = $request->notes;
        if (empty($notes)) {
            $notes = $isAfterTimeline 
                ? 'Laporan diperbarui oleh admin setelah timeline project berakhir. ' . $endDate->format('d M Y')
                : 'Diperbarui oleh admin';
        }
        
        $project->update([
            'file_laporan' => $path,
            'is_manual_upload' => true,
            'upload_notes' => $notes
        ]);

        $successMessage = $isAfterTimeline 
            ? 'Laporan berhasil diperbarui. Perhatikan bahwa Guru tidak akan dapat mengubah laporan ini.'
            : 'Laporan berhasil diperbarui.';

        return redirect()->route('admin-project-index')
            ->with('success', $successMessage);
    }

    public function deleteLaporan(Request $request, Project $project)
    {
        if ($project->file_laporan) {
            Storage::disk('public')->delete($project->file_laporan);
            $project->update([
                'file_laporan' => null,
                'is_manual_upload' => false,
                'upload_notes' => null
            ]);
            
            return redirect()->route('admin-project-index')
                ->with('success', 'Laporan berhasil dihapus');
        }
        
        return redirect()->route('admin-project-index')
            ->with('error', 'Tidak ada laporan yang bisa dihapus');
    }
}
