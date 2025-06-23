<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikasi extends Model
{
    use HasFactory;

    protected $table = 'sertifikasis'; // Pastikan nama tabel benar

    protected $fillable = [
        'user_id', // Siswa
        'lsp_user_id', // LSP (null jika dari perusahaan)
        'perusahaan_user_id', // Perusahaan (null jika dari LSP)
        'certification_exam_id', // Ujian yang diikuti
        'dokumen_persyaratan',
        'nilai',
        'sertifikat_kelulusan',
        'status_pendaftaran_ujian', // 'terdaftar', 'selesai_ujian', 'lulus', 'tidak_lulus'
        // Kolom `raport`, `surat_rekomendasi`, `surat_motivasi`, `portofolio` HANYA tambahkan jika memang ada di tabel `sertifikasis` kamu.
        // Berdasarkan simila.sql yang diberikan, kolom ini ada di `beasiswas`, bukan `sertifikasis`.
        // Jadi, kemungkinan besar kamu TIDAK PERLU menambahkan ini di sini.
    ];

    protected $casts = [
        'nilai' => 'integer',
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lsp()
    {
        return $this->belongsTo(User::class, 'lsp_user_id');
    }

    public function perusahaan()
    {
        return $this->belongsTo(User::class, 'perusahaan_user_id');
    }

    public function exam()
    {
        return $this->belongsTo(CertificationExam::class, 'certification_exam_id');
    }
}