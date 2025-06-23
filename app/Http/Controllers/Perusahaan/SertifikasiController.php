<?php

namespace App\Http\Controllers\Perusahaan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CertificationExam;
use App\Models\CertificationExamQuestion;
use App\Models\Sertifikasi;
use App\Models\StudentExamAttempt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
// use Illuminate\Support\Str; // Tidak diperlukan di controller jika hanya untuk Blade

class SertifikasiController extends Controller
{
    /**
     * Menampilkan daftar ujian sertifikasi yang dibuat oleh perusahaan ini.
     */
    public function index()
    {
        $perusahaanId = Auth::id();
        $exams = CertificationExam::where('pembuat_user_id', $perusahaanId)->get();
        return view('perusahaan.sertifikasi.index', compact('exams')); // Tidak perlu 'header'
    }

    /**
     * Menampilkan form untuk membuat ujian sertifikasi baru.
     */
    public function create()
    {
        return view('perusahaan.sertifikasi.create');
    }

    /**
     * Menyimpan ujian sertifikasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kompetensi_terkait' => 'nullable|string|max:255',
            'durasi_menit' => 'nullable|integer|min:1',
            'nilai_minimum_lulus' => 'required|integer|min:0',
        ]);

        CertificationExam::create([
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
            'kompetensi_terkait' => $request->kompetensi_terkait,
            'pembuat_user_id' => Auth::id(),
            'durasi_menit' => $request->durasi_menit,
            'nilai_minimum_lulus' => $request->nilai_minimum_lulus,
            'status_ujian' => 'draft',
        ]);

        return redirect()->route('perusahaan-sertifikasi-index')->with('success', 'Ujian sertifikasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail ujian dan daftar soalnya.
     */
    public function show(CertificationExam $certificationExam)
    {
        $questions = $certificationExam->questions;
        $registrations = $certificationExam->registrations()->with('siswa')->get();
        return view('perusahaan.sertifikasi.show', compact('certificationExam', 'questions', 'registrations'));
    }

    /**
     * Menampilkan form untuk mengedit ujian sertifikasi.
     */
    public function edit(CertificationExam $certificationExam)
    {
        return view('perusahaan.sertifikasi.edit', compact('certificationExam'));
    }

    /**
     * Memperbarui ujian sertifikasi.
     */
    public function update(Request $request, CertificationExam $certificationExam)
    {
        $request->validate([
            'nama_ujian' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kompetensi_terkait' => 'nullable|string|max:255',  
            'durasi_menit' => 'nullable|integer|min:1',
            'nilai_minimum_lulus' => 'required|integer|min:0',
            'status_ujian' => ['required', Rule::in(['draft', 'published', 'archived'])],
        ]);

        $certificationExam->update([
            'nama_ujian' => $request->nama_ujian,
            'deskripsi' => $request->deskripsi,
            'kompetensi_terkait' => $request->kompetensi_terkait,
            'durasi_menit' => $request->durasi_menit,
            'nilai_minimum_lulus' => $request->nilai_minimum_lulus,
            'status_ujian' => $request->status_ujian,
        ]);

        return redirect()->route('perusahaan-sertifikasi-index')->with('success', 'Ujian sertifikasi berhasil diperbarui!');
    }

    /**
     * Menghapus ujian sertifikasi.
     */
    public function destroy(CertificationExam $certificationExam)
    {
        $certificationExam->delete();

        return redirect()->route('perusahaan-sertifikasi-index')->with('success', 'Ujian sertifikasi berhasil dihapus!');
    }

    // --- Manajemen Soal Ujian ---

    /**
     * Menampilkan form untuk menambah soal baru ke ujian.
     */
    public function createQuestion(CertificationExam $certificationExam)
    {
        return view('perusahaan.sertifikasi.questions.create', compact('certificationExam'));
    }

    /**
     * Menyimpan soal baru ke ujian.
     */
    public function storeQuestion(Request $request, CertificationExam $certificationExam)
    {
        $request->validate([
            'soal' => 'required|string',
            'pilihan_jawaban_1' => 'required|string|max:255',
            'pilihan_jawaban_2' => 'required|string|max:255',
            'pilihan_jawaban_3' => 'required|string|max:255',
            'pilihan_jawaban_4' => 'required|string|max:255',
            'jawaban_benar' => 'required|integer|between:1,4',
            'nilai_akhir' => 'required|integer|min:0',
        ]);

        $certificationExam->questions()->create([
            'soal' => $request->soal,
            'pilihan_jawaban_1' => $request->pilihan_jawaban_1,
            'pilihan_jawaban_2' => $request->pilihan_jawaban_2,
            'pilihan_jawaban_3' => $request->pilihan_jawaban_3,
            'pilihan_jawaban_4' => $request->pilihan_jawaban_4,
            'jawaban_benar' => $request->jawaban_benar,
            'nilai_akhir' => $request->nilai_akhir,
        ]);

        return redirect()->route('perusahaan-sertifikasi-show', $certificationExam)->with('success', 'Soal berhasil ditambahkan!');
    }

    /**
     * Menampilkan form untuk mengedit soal.
     */
    public function editQuestion(CertificationExam $certificationExam, CertificationExamQuestion $question)
    {
        return view('perusahaan.sertifikasi.questions.edit', compact('certificationExam', 'question'));
    }

    /**
     * Memperbarui soal.
     */
    public function updateQuestion(Request $request, CertificationExam $certificationExam, CertificationExamQuestion $question)
    {
        $request->validate([
            'soal' => 'required|string',
            'pilihan_jawaban_1' => 'required|string|max:255',
            'pilihan_jawaban_2' => 'required|string|max:255',
            'pilihan_jawaban_3' => 'required|string|max:255',
            'pilihan_jawaban_4' => 'required|string|max:255',
            'jawaban_benar' => 'required|integer|between:1,4',
            'nilai_akhir' => 'required|integer|min:0',
        ]);

        $question->update($request->all());

        return redirect()->route('perusahaan-sertifikasi-show', $certificationExam)->with('success', 'Soal berhasil diperbarui!');
    }

    /**
     * Menghapus soal.
     */
    public function destroyQuestion(CertificationExam $certificationExam, CertificationExamQuestion $question)
    {
        $question->delete();

        return redirect()->route('perusahaan-sertifikasi-show', $certificationExam)->with('success', 'Soal berhasil dihapus!');
    }

    // --- Manajemen Hasil Ujian & Penerbitan Sertifikat ---

    /**
     * Menampilkan daftar siswa yang sudah mengikuti ujian sertifikasi tertentu
     * atau semua ujian yang dibuat perusahaan ini.
     */
    public function listResults()
    {
        $perusahaanId = Auth::id();
        $registrations = Sertifikasi::whereHas('exam', function ($query) use ($perusahaanId) {
            $query->where('pembuat_user_id', $perusahaanId);
        })->with(['siswa', 'exam'])->get();

        return view('perusahaan.sertifikasi.results.index', compact('registrations'));
    }

    /**
     * Menampilkan form untuk menginput nilai dan mengunggah sertifikat untuk siswa.
     */
    public function giveCertificateForm(Sertifikasi $registration)
    {
        if ($registration->exam->pembuat_user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        $latestAttempt = StudentExamAttempt::where('user_id', $registration->user_id)
                                          ->where('certification_exam_id', $registration->certification_exam_id)
                                          ->orderByDesc('created_at')
                                          ->first();

        return view('perusahaan.sertifikasi.results.give_certificate', compact('registration', 'latestAttempt'));
    }

    /**
     * Menyimpan nilai dan mengunggah sertifikat.
     */
    public function storeCertificate(Request $request, Sertifikasi $registration)
    {
        if ($registration->exam->pembuat_user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki akses untuk tindakan ini.');
        }

        $request->validate([
            'nilai' => 'required|integer|min:0|max:100',
            'sertifikat' => 'nullable|file|mimes:pdf|max:2048',
            'status' => ['required', Rule::in(['lulus', 'tidak_lulus'])],
        ]);

        $registration->nilai = $request->nilai;
        $registration->status_pendaftaran_ujian = $request->status;

        if ($request->hasFile('sertifikat')) {
            if ($registration->sertifikat_kelulusan) {
                Storage::disk('public')->delete($registration->sertifikat_kelulusan);
            }
            $path = $request->file('sertifikat')->store('sertifikat_kelulusan', 'public');
            $registration->sertifikat_kelulusan = $path;
        }

        $registration->save();

        return redirect()->route('perusahaan-sertifikasi-results')->with('success', 'Nilai dan sertifikat berhasil diperbarui.');
    }
}