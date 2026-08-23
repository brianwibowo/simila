<?php

namespace App\Http\Controllers\WakaHumas;

use App\Http\Controllers\Controller;
use App\Models\PKL;
use App\Models\Logbook;
use App\Models\User;
use App\Models\LogbookContent;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class PklController extends Controller
{
    /**
     * Display a listing of the PKL reports.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $query = PKL::with(['siswas', 'pembimbing', 'perusahaan']);
        
        $pkls = $query->latest()->paginate(10);
        
        return view('waka_humas.pkl.index', compact('pkls'));
    }

    /**
     * Display the specified PKL report.
     *
     * @param PKL $pkl
     * @return View
     */
    public function show(PKL $pkl): View
    {
        $pkl->load(['siswas', 'pembimbing', 'perusahaan']);
        return view('waka_humas.pkl.show', compact('pkl'));
    }

    /**
     * Validate the PKL report.
     *
     * @param Request $request
     * @param PKL $pkl
     * @return RedirectResponse
     */
    public function validateReport(Request $request, PKL $pkl): RedirectResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
            'catatan' => 'nullable|string|max:1000'
        ]);

        $pkl->update([
            'status_waka_humas' => $validated['status'],
            'catatan_waka_humas' => $validated['catatan'] ?? null,
            'tanggal_validasi_waka_humas' => now()
        ]);

        return redirect()->route('waka-humas-pkl-show', $pkl)
            ->with('success', 'Laporan PKL berhasil divalidasi');
    }

    /**
     * Download the PKL report file.
     *
     * @param PKL $pkl
     * @return RedirectResponse
     */
    public function downloadReport(PKL $pkl): RedirectResponse
    {
        $siswa = $pkl->siswas->first();
        if (!$siswa) {
            abort(404, 'Data siswa tidak ditemukan');
        }
        
        if (!$siswa->laporan_pkl) {
            abort(404, 'Laporan PKL belum diunggah');
        }
        
        // Redirect to the public storage URL instead of forcing a download
        return redirect('/storage/' . $siswa->laporan_pkl);
    }

    /**
     * Show student logbook for validation.
     *
     * @param User $siswa
     * @return View|RedirectResponse
     */
    public function siswaLogbook(User $siswa)
    {
        $logbook = Logbook::where('siswa_id', $siswa->id)->first();
        
        if (!$logbook) {
            return redirect()->route('waka-humas-pkl-logbook-validation-index')->with('error', 'Logbook tidak ditemukan');
        }
        
        // Get logbook contents ordered by date (newest first)
        $logbookContents = $logbook->logbookContents()->orderBy('tanggal', 'desc')->paginate(10);
        
        return view('waka_humas.pkl.siswa_logbook', compact('siswa', 'logbook', 'logbookContents'));
    }

    /**
     * Display a listing of the PKL programs for assignment.
     *
     * @return View
     */
    public function assignIndex(): View
    {
        $pkls = PKL::with(['perusahaan', 'pembimbing'])->paginate(10);
        return view('waka_humas.pkl.assign.index', compact('pkls'));
    }

    /**
     * Show the form for assigning a pembimbing to PKL.
     *
     * @param PKL $pkl
     * @return View
     */
    public function assignForm(PKL $pkl): View
    {
        // Get all users with guru role and jenis_guru = 'guru pembimbing'
        $pembimbings = User::role('guru')
            ->where('jenis_guru', 'guru pembimbing')
            ->get();
            
        return view('waka_humas.pkl.assign.form', compact('pkl', 'pembimbings'));
    }

    /**
     * Assign a pembimbing to the PKL.
     *
     * @param Request $request
     * @param PKL $pkl
     * @return RedirectResponse
     */
    public function assignStore(Request $request, PKL $pkl): RedirectResponse
    {
        $request->validate([
            'pembimbing_id' => 'required|exists:users,id'
        ]);

        $pkl->update([
            'pembimbing_id' => $request->pembimbing_id
        ]);

        return redirect()->route('waka-humas-pkl-assign-index')
            ->with('success', 'Pembimbing berhasil ditugaskan ke program PKL.');
    }

    /**
     * Show the PKL details with assigned pembimbing.
     *
     * @param PKL $pkl
     * @return View
     */
    public function assignShow(PKL $pkl): View
    {
        $pkl->load(['perusahaan', 'pembimbing', 'siswas']);
        return view('waka_humas.pkl.assign.show', compact('pkl'));
    }

    /**
     * Remove the assignment of pembimbing from PKL.
     *
     * @param PKL $pkl
     * @return RedirectResponse
     */
    public function assignRemove(PKL $pkl): RedirectResponse
    {
        $pkl->update([
            'pembimbing_id' => null
        ]);

        return redirect()->route('waka-humas-pkl-assign-index')
            ->with('success', 'Pembimbing berhasil dihapus dari program PKL.');
    }

    /**
     * Display logbooks that need validation.
     *
     * @return View
     */
    public function logbookValidationIndex(): View
    {
        // Get all logbooks with their relationships
        $logbooks = Logbook::with(['siswa', 'pkl'])->paginate(10);
        
        return view('waka_humas.pkl.logbook_validation', compact('logbooks'));
    }
}
