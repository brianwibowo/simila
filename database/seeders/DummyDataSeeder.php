<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kurikulum;
use App\Models\PKL;
use App\Models\Logbook;
use App\Models\LogbookContent;
use App\Models\GuruTamu;
use App\Models\Project;
use App\Models\MOOC;
use App\Models\MoocModule;
use App\Models\MoocScore;
use App\Models\MoocReflection;
use App\Models\BeasiswaBatch;
use App\Models\Beasiswa;
use App\Models\ScoutingBatch;
use App\Models\Talent_Scouting;
use App\Models\CertificationExam;
use App\Models\Sertifikasi;
use App\Models\Riset;
use App\Models\Anggota_Riset;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info("🌱 Seeding Dummy Data untuk Seluruh Modul SIMILA...");

        // 1. Ambil User Referensi
        $admin = User::where('email', 'admin@example.com')->first();
        $siswa = User::where('email', 'siswa@example.com')->first();
        $guru = User::where('email', 'guru@example.com')->first();
        $guruProduktif = User::where('email', 'produktif@example.com')->first() ?? $guru;
        $perusahaan = User::where('email', 'perusahaan@example.com')->first();
        $perusahaan2 = User::where('email', 'viantech@example.com')->first() ?? $perusahaan;
        $wakaKurikulum = User::where('email', 'waka_kurikulum@example.com')->first();
        $wakaHumas = User::where('email', 'waka_humas@example.com')->first();
        $alumni = User::where('email', 'alumni@example.com')->first();
        $lsp = User::where('email', 'lsp@example.com')->first();

        // -------------------------------------------------------------
        // 2. Modul Kurikulum Bersama
        // -------------------------------------------------------------
        Kurikulum::firstOrCreate([
            'nama_kurikulum' => 'Kurikulum RPL & Cloud Architecture 2026/2027',
        ], [
            'pengirim_id' => $wakaKurikulum->id,
            'perusahaan_id' => $perusahaan->id,
            'tahun_ajaran' => '2026/2027',
            'deskripsi' => 'Penyelarasan standar kompetensi kejuruan dengan kebutuhan industri bidang Cloud Computing, Microservices, dan DevOps.',
            'file_kurikulum' => 'kurikulum/kurikulum_rpl_cloud_2026.pdf',
            'validasi_sekolah' => 'disetujui',
            'validasi_perusahaan' => 'disetujui',
            'komentar' => 'Sesuai dengan standard tech stack industri saat ini.'
        ]);

        Kurikulum::firstOrCreate([
            'nama_kurikulum' => 'Kurikulum Fullstack Engineering & Cyber Security',
        ], [
            'pengirim_id' => $perusahaan->id,
            'perusahaan_id' => null,
            'tahun_ajaran' => '2026/2027',
            'deskripsi' => 'Usulan kurikulum industri untuk penguatan materi OWASP security, CI/CD pipeline, dan automated testing.',
            'file_kurikulum' => 'kurikulum/kurikulum_fullstack_security.pdf',
            'validasi_sekolah' => 'disetujui',
            'validasi_perusahaan' => 'disetujui',
            'komentar' => 'Disetujui untuk diimplementasikan pada kelas industri semester depan.'
        ]);

        Kurikulum::firstOrCreate([
            'nama_kurikulum' => 'Kurikulum IoT & Embedded Systems VianTech',
        ], [
            'pengirim_id' => $wakaKurikulum->id,
            'perusahaan_id' => $perusahaan2->id,
            'tahun_ajaran' => '2026/2027',
            'deskripsi' => 'Modul ajar mikrokontroler ESP32, MQTT protocol, dan integrasi dashboard web real-time.',
            'file_kurikulum' => 'kurikulum/kurikulum_iot_viantech.pdf',
            'validasi_sekolah' => 'disetujui',
            'validasi_perusahaan' => 'proses',
            'komentar' => 'Sedang dalam review teknis oleh tim engineering.'
        ]);

        $this->command->info("  ✅ Kurikulum Bersama berhasil di-seed.");

        // -------------------------------------------------------------
        // 3. Modul PKL & Logbook Digital
        // -------------------------------------------------------------
        $pkl1 = PKL::firstOrCreate([
            'nama' => 'Praktik Kerja Lapangan - Fullstack Web & Mobile Development',
        ], [
            'perusahaan_id' => $perusahaan->id,
            'pembimbing_id' => $guru->id,
            'tanggal_mulai' => now()->subMonths(1)->toDateString(),
            'tanggal_selesai' => now()->addMonths(2)->toDateString(),
            'status' => 'berjalan',
            'status_waka_humas' => 'disetujui',
            'status_pembimbing' => 'disetujui'
        ]);

        PKL::firstOrCreate([
            'nama' => 'PKL Junior Cloud & DevOps Specialist',
        ], [
            'perusahaan_id' => $perusahaan2->id,
            'pembimbing_id' => $guruProduktif->id,
            'tanggal_mulai' => now()->toDateString(),
            'tanggal_selesai' => now()->addMonths(3)->toDateString(),
            'status' => 'berjalan',
            'status_waka_humas' => 'disetujui',
            'status_pembimbing' => 'proses'
        ]);

        // Hubungkan siswa ke PKL 1
        $siswa->update([
            'pkl_id' => $pkl1->id,
            'pkl_status' => 'disetujui',
            'nilai_pkl' => 94,
            'laporan_pkl' => 'pkl/laporan_final_magang_siswa.pdf'
        ]);

        // Master Logbook & Entri Harian
        $logbook = Logbook::firstOrCreate([
            'siswa_id' => $siswa->id,
            'pkl_id' => $pkl1->id,
        ], [
            'status_validasi_pembimbing' => 'valid',
            'status_validasi_waka_humas' => 'valid',
            'komentar_pembimbing' => 'Seluruh kegiatan harian terdokumentasi dengan sangat rapi dan komprehensif.',
            'komentar_waka_humas' => 'Validasi tuntas.',
            'tanggal_validasi_pembimbing' => now(),
            'tanggal_validasi_waka_humas' => now()
        ]);

        $logEntries = [
            [
                'tanggal' => now()->subDays(10)->toDateString(),
                'nama' => 'Onboarding & Setup Development Environment',
                'detail' => 'Mengikuti orientasi industri, setup workspace Git, Docker container, dan membaca standarisasi kode tim.',
                'dokumentasi' => 'logbook/onboarding_day1.jpg'
            ],
            [
                'tanggal' => now()->subDays(7)->toDateString(),
                'nama' => 'Perancangan Skema Database & REST API',
                'detail' => 'Membuat Entity Relationship Diagram (ERD), skema migrasi database MySQL, dan dokumentasi endpoint Swagger.',
                'dokumentasi' => 'logbook/db_design.jpg'
            ],
            [
                'tanggal' => now()->subDays(4)->toDateString(),
                'nama' => 'Slicing UI & Integrasi Tailwind CSS',
                'detail' => 'Membangun komponen Blade yang responsif, layout dashboard admin, dan interaksi Alpine.js.',
                'dokumentasi' => 'logbook/ui_slicing.jpg'
            ],
            [
                'tanggal' => now()->subDays(1)->toDateString(),
                'nama' => 'Implementasi CRUD & Automated Testing',
                'detail' => 'Menyelesaikan modul manajemen data, error handling, dan menjalankan automated test PHPUnit.',
                'dokumentasi' => 'logbook/crud_testing.jpg'
            ]
        ];

        foreach ($logEntries as $entry) {
            LogbookContent::firstOrCreate([
                'logbook_id' => $logbook->id,
                'nama' => $entry['nama'],
            ], [
                'tanggal' => $entry['tanggal'],
                'detail' => $entry['detail'],
                'dokumentasi' => $entry['dokumentasi']
            ]);
        }

        $this->command->info("  ✅ PKL & Logbook Digital Siswa berhasil di-seed.");

        // -------------------------------------------------------------
        // 4. Modul Guru Tamu (Expert Sharing)
        // -------------------------------------------------------------
        GuruTamu::firstOrCreate([
            'nama_karyawan' => 'Budi Santoso, S.Kom',
            'jabatan' => 'Lead DevOps & Cloud Engineer',
        ], [
            'keahlian' => 'Containerization, CI/CD Pipeline, Kubernetes, AWS Cloud',
            'deskripsi' => 'Workshop praktis implementasi Docker dan deployment otomatis ke VPS untuk siswa kelas XII.',
            'jadwal' => now()->addDays(5),
            'file_cv' => 'gurutamu/cv_budi_santoso.pdf',
            'file_materi' => 'gurutamu/materi_devops_workshop.pdf',
            'status' => 'disetujui',
            'submitted_by' => $perusahaan->id
        ]);

        GuruTamu::firstOrCreate([
            'nama_karyawan' => 'Rina Wijaya, M.T',
            'jabatan' => 'Principal UI/UX Product Designer',
        ], [
            'keahlian' => 'Design Thinking, Figma Prototyping, Usability Testing',
            'deskripsi' => 'Sesi transfer pengetahuan mengenai standar industri dalam merancang antarmuka produk digital.',
            'jadwal' => now()->addDays(12),
            'file_cv' => 'gurutamu/cv_rina_wijaya.pdf',
            'file_materi' => 'gurutamu/materi_uiux_standard.pdf',
            'status' => 'disetujui',
            'submitted_by' => $perusahaan2->id
        ]);

        $this->command->info("  ✅ Guru Tamu berhasil di-seed.");

        // -------------------------------------------------------------
        // 5. Modul Project Mitra (PBL / Teaching Factory)
        // -------------------------------------------------------------
        Project::firstOrCreate([
            'judul' => 'Sistem Presensi Digital Berbasis Geolocation & Face Recognition',
        ], [
            'perusahaan_id' => $perusahaan->id,
            'deskripsi' => 'Project pengembangan aplikasi absensi mobile dan portal admin untuk monitoring kehadiran karyawan lapangan.',
            'file_brief' => 'project/brief/brief_absensi_geofence.pdf',
            'file_laporan' => 'project/laporan/laporan_progress_absensi_final.pdf',
            'tanggal_mulai' => now()->subMonths(1)->toDateString(),
            'tanggal_selesai' => now()->addMonths(1)->toDateString(),
            'is_manual_upload' => true
        ]);

        Project::firstOrCreate([
            'judul' => 'Smart IoT Greenhouse & Hydroponic Automation System',
        ], [
            'perusahaan_id' => $perusahaan2->id,
            'deskripsi' => 'Proyek integrasi sensor suhu, pH air, dan pompa nutrisi otomatis berbasis mikrokontroler dan dashboard web.',
            'file_brief' => 'project/brief/brief_iot_greenhouse.pdf',
            'file_laporan' => null,
            'tanggal_mulai' => now()->toDateString(),
            'tanggal_selesai' => now()->addMonths(2)->toDateString(),
            'is_manual_upload' => true
        ]);

        $this->command->info("  ✅ Project Mitra PBL berhasil di-seed.");

        // -------------------------------------------------------------
        // 6. Modul MOOC & Pelatihan Mandiri Guru
        // -------------------------------------------------------------
        $mooc1 = MOOC::firstOrCreate([
            'judul_pelatihan' => 'Mastering Modern Fullstack Web Architecture & Cloud Native',
        ], [
            'deskripsi' => 'Pelatihan komprehensif bagi pendidik vokasi untuk menguasai arsitektur Laravel modern, RESTful API, Docker, dan DevOps.',
            'perusahaan_id' => $perusahaan->id
        ]);

        $modules = [
            [
                'module_name' => 'Modul 1: Fundamental Docker & Containerization',
                'deskripsi_modul' => 'Mempelajari dasar containerization, Dockerfile, build images, dan manajemen volume.',
                'link_materi' => 'https://www.youtube.com/watch?v=fqMOX6JJhGo',
                'dokumen_materi' => 'mooc/dokumen_modul_1_docker.pdf'
            ],
            [
                'module_name' => 'Modul 2: Desain REST API & Authentication JWT/Sanctum',
                'deskripsi_modul' => 'Implementasi arsitektur RESTful API modern dan token authorization pada Laravel.',
                'link_materi' => 'https://www.youtube.com/watch?v=MFh0ADGZ42A',
                'dokumen_materi' => 'mooc/dokumen_modul_2_api.pdf'
            ],
            [
                'module_name' => 'Modul 3: Automated Testing & CI/CD GitHub Actions',
                'deskripsi_modul' => 'Penerapan pengujian otomatis PHPUnit dan pipeline build/deploy ke server VPS.',
                'link_materi' => 'https://www.youtube.com/watch?v=R8_veQiYErI',
                'dokumen_materi' => 'mooc/dokumen_modul_3_cicd.pdf'
            ]
        ];

        foreach ($modules as $mod) {
            MoocModule::firstOrCreate([
                'mooc_id' => $mooc1->id,
                'module_name' => $mod['module_name'],
            ], [
                'deskripsi_modul' => $mod['deskripsi_modul'],
                'link_materi' => $mod['link_materi'],
                'dokumen_materi' => $mod['dokumen_materi']
            ]);
        }

        MoocScore::firstOrCreate([
            'mooc_id' => $mooc1->id,
            'user_id' => $guru->id,
        ], [
            'score' => 95,
            'file_sertifikat' => 'mooc/certificates/cert_guru_mooc_cloud.pdf'
        ]);

        MoocReflection::firstOrCreate([
            'mooc_id' => $mooc1->id,
            'user_id' => $guru->id,
        ], [
            'reflection' => 'Materi pelatihan sangat aplikatif dan membuka wawasan baru untuk pembaharuan modul ajar kelas industri.'
        ]);

        $this->command->info("  ✅ MOOC & Pelatihan Guru berhasil di-seed.");

        // -------------------------------------------------------------
        // 7. Modul Beasiswa Talent Scout
        // -------------------------------------------------------------
        $batchBeasiswa = BeasiswaBatch::firstOrCreate([
            'batch' => 'Beasiswa Talenta Digital Masa Depan - Batch I 2026',
        ], [
            'perusahaan_id' => $perusahaan->id,
            'tanggal_mulai' => now()->subDays(15)->toDateString(),
            'tanggal_selesai' => now()->addDays(20)->toDateString(),
            'status' => 'open'
        ]);

        Beasiswa::firstOrCreate([
            'user_id' => $siswa->id,
            'batch_id' => $batchBeasiswa->id,
        ], [
            'nama_siswa' => $siswa->name,
            'raport' => 'beasiswa/rapor_siswa_sem1_4.pdf',
            'surat_rekomendasi' => 'beasiswa/surat_rekomendasi_kepsek.pdf',
            'surat_motivasi' => 'beasiswa/essay_motivasi_siswa.pdf',
            'portofolio' => 'beasiswa/portofolio_project_github.pdf',
            'direkomendasikan' => true,
            'catatan_rekomendasi' => 'Siswa memiliki rekam jejak akademik cemerlang dan dedikasi tinggi pada pengembangan software.',
            'tanggal_rekomendasi' => now(),
            'status' => 'lolos'
        ]);

        $this->command->info("  ✅ Beasiswa Talent Scout berhasil di-seed.");

        // -------------------------------------------------------------
        // 8. Modul Talent Scouting (Rekrutmen Alumni)
        // -------------------------------------------------------------
        $batchScouting = ScoutingBatch::firstOrCreate([
            'batch' => 'Talent Scouting Rekrutmen Alumni Software Engineer 2026',
        ], [
            'perusahaan_id' => $perusahaan->id,
            'tanggal_mulai' => now()->subDays(10)->toDateString(),
            'tanggal_selesai' => now()->addDays(30)->toDateString(),
            'status' => 'open'
        ]);

        Talent_Scouting::firstOrCreate([
            'user_id' => $alumni->id,
            'batch_id' => $batchScouting->id,
        ], [
            'file_cv' => 'scouting/cv_alumni_terbaru.pdf',
            'file_ijazah' => 'scouting/ijazah_smk_alumni.pdf',
            'file_pernyataan' => 'scouting/surat_pernyataan_komitmen.pdf',
            'status_seleksi' => 'lolos'
        ]);

        $this->command->info("  ✅ Talent Scouting Alumni berhasil di-seed.");

        // -------------------------------------------------------------
        // 9. Modul Sertifikasi Profesi (LSP)
        // -------------------------------------------------------------
        $exam1 = CertificationExam::firstOrCreate([
            'nama_ujian' => 'Uji Sertifikasi Profesi BNSP - Junior Web Developer',
        ], [
            'deskripsi' => 'Skema sertifikasi nasional okupasi Junior Web Developer berstandar SKKNI dan BNSP.',
            'kompetensi_terkait' => 'PHP, MySQL Database, REST API, Git Version Control, Web Security',
            'pembuat_user_id' => $lsp->id
        ]);

        Sertifikasi::firstOrCreate([
            'user_id' => $siswa->id,
            'certification_exam_id' => $exam1->id,
        ], [
            'lsp_user_id' => $lsp->id,
            'perusahaan_user_id' => $perusahaan->id,
            'kompetensi' => 'Junior Web Developer (SKKNI)',
            'dokumen_persyaratan' => 'sertifikasi/portofolio_ujk_siswa.pdf',
            'nilai' => 92,
            'sertifikat_kelulusan' => 'sertifikasi/certificates/cert_bnsp_2026_001.pdf',
            'status_pendaftaran_ujian' => 'lulus'
        ]);

        $this->command->info("  ✅ Sertifikasi Profesi LSP berhasil di-seed.");

        // -------------------------------------------------------------
        // 10. Modul Riset Terapan & Inovasi Produk
        // -------------------------------------------------------------
        $riset1 = Riset::firstOrCreate([
            'topik' => 'Rancang Bangun Sistem Monitoring Kualitas Air Tambak Pintar Berbasis IoT',
        ], [
            'deskripsi' => 'Pengembangan inovasi sistem otomatisasi pengukur pH, salinitas, dan suhu air secara real-time melalui dashboard cloud.',
            'tim_riset' => ['Drs. Bambang Sudarsono (Ketua)', 'Ir. Hendra (Industri)', 'Siti Nurhaliza (Siswa)'],
            'file_proposal' => 'riset/proposal_iot_water_monitoring.pdf',
            'dokumentasi' => 'riset/dokumentasi_prototype_alat.pdf',
            'status' => 'disetujui'
        ]);

        Anggota_Riset::firstOrCreate([
            'id_risets' => $riset1->id,
            'user_id' => $guru->id
        ]);

        $this->command->info("  ✅ Riset Terapan & Inovasi berhasil di-seed.");
        $this->command->info("🎉 SELURUH DATA SEEDING SIMILA BERHASIL TERISI 100%!");
    }
}
