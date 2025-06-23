<?php

namespace App\Http\Controllers\Perusahaan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use App\Models\PKL;
use App\Models\User;
use App\Models\Logbook;

class PklController extends Controller
{    public function index()
    {
        return view('perusahaan.pkl.index', [
            'pkls' => auth()->user()->pklPerusahaan()->with('pembimbing')->get()
        ]);
    }public function show(PKL $pkl)
    {
        $pkl->load(['pembimbing', 'siswas', 'perusahaan']);
        return view('perusahaan.pkl.show', [
            'pkl' => $pkl
        ]);
    }

    public function create(){
        return view('perusahaan.pkl.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required'
        ]);

        PKL::create([
            'nama' => $request->nama,
            'perusahaan_id' => auth()->user()->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status' => 'proses',
            'status_pembimbing' => 'proses',
            'status_waka_humas' => 'proses'
        ]);

        return redirect()->route('perusahaan-pkl-index');
    }

    public function edit(PKL $pkl){
        return view('perusahaan.pkl.edit', [
            'pkl' => $pkl
        ]);
    }    public function update(Request $request, PKL $pkl){
        $request->validate([
            'nama' => 'required',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai'
        ], [
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.'
        ]);

        // Check if this PKL has enrolled students and dates are being changed significantly
        $hasEnrolledStudents = $pkl->siswas()->count() > 0;
        $isChangingDatesSignificantly = false;
        
        // Only perform this check if we have enrolled students
        if ($hasEnrolledStudents) {
            $newStartDate = \Carbon\Carbon::parse($request->tanggal_mulai);
            $newEndDate = \Carbon\Carbon::parse($request->tanggal_selesai);
            $oldStartDate = $pkl->tanggal_mulai;
            $oldEndDate = $pkl->tanggal_selesai;
            
            // If changing start date by more than 7 days or shortening the duration significantly
            if ($newStartDate->diffInDays($oldStartDate) > 7 || 
                ($oldEndDate->diffInDays($oldStartDate) - $newEndDate->diffInDays($newStartDate) > 7)) {
                $isChangingDatesSignificantly = true;
            }
        }
        
        // Update the PKL
        $pkl->update([
            'nama' => $request->nama,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai
        ]);
        
        // Provide appropriate success message
        if ($hasEnrolledStudents && $isChangingDatesSignificantly) {
            return redirect()->route('perusahaan-pkl-index')
                ->with('warning', 'PKL berhasil diupdate, tetapi perubahan tanggal signifikan telah dilakukan. Mohon informasikan perubahan ini kepada siswa dan pembimbing.');
        }
        
        return redirect()->route('perusahaan-pkl-index')
            ->with('success', 'PKL berhasil diupdate.');
    }    public function destroy(PKL $pkl){
        // Check if there are students enrolled in this PKL
        $hasEnrolledStudents = $pkl->siswas()->count() > 0;
        
        if ($hasEnrolledStudents) {
            return redirect()->route('perusahaan-pkl-index')
                    ->with('error', 'PKL tidak dapat dihapus karena sudah ada siswa yang terdaftar.');
        }
        
        $pkl->delete();
        return redirect()->route('perusahaan-pkl-index')
                ->with('success', 'PKL berhasil dihapus.');
    }    public function list(){
        $pkl_ids = PKL::where('perusahaan_id', '=', auth()->user()->id)->pluck('id')->toArray();

        $users = User::where('pkl_id', '!=', null)
        ->whereIn('pkl_id', $pkl_ids)
        ->with('pklSiswa.pembimbing')  // Eager load the PKL with pembimbing relationship
        ->get();

        return view('perusahaan.pkl.list', [
            'siswas' => $users
        ]);
    }public function terima(User $user){
        $user->pkl_status = 'disetujui';
        $user->save();

        // Create logbook for the student
        Logbook::create([
            'siswa_id' => $user->id,
            'pkl_id' => $user->pkl_id,
            'status' => 'proses',
        ]);
        
        // Update PKL status to 'berjalan' when student is approved
        $pkl = PKL::find($user->pkl_id);
        if ($pkl) {
            $pkl->status = 'berjalan';
            $pkl->save();
        }

        return redirect()->route('perusahaan-pkl-list')->with('success', 'Siswa berhasil disetujui untuk mengikuti PKL');
    }

    public function tolak(User $user){
        $user->pkl_status = 'tidak_disetujui';
        
        // Store the PKL ID before nulling it (for message display)
        $pklId = $user->pkl_id;
        $user->pkl_id = null;
        $user->save();
        
        return redirect()->route('perusahaan-pkl-list')->with('success', 'Siswa berhasil ditolak dari PKL');
    }    public function siswa(User $user){
        // Explicitly load the PKL relationship with pembimbing to ensure we have all data
        $user->load(['pklSiswa.pembimbing', 'logbook']);
        
        $logbooks = $user->logbook ? $user->logbook->logbookContents()->paginate(10) : collect();
        return view('perusahaan.pkl.siswa', [
            'user' => $user,
            'logbooks' => $logbooks
        ]);
    }

    public function nilai(User $user, Request $request){
        $request->validate([
            'nilai' => 'required'
        ]);

        $user->update([
            'nilai_pkl' => $request->nilai
        ]);

        return redirect()->route('perusahaan-pkl-siswa', $user->id);
    }
}