<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PKL;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class PklRembangSeeder extends Seeder
{
    /**
     * Seed data PKL Teknik Bangunan SMKN 1 Rembang.
     * 32 siswa ditempatkan di 6 mitra PKL, periode 13 Juli - 18 Desember 2026.
     *
     * Jalankan: php artisan db:seed --class=PklRembangSeeder
     */
    public function run(): void
    {
        $this->command->info("🏗️  Seeding Data PKL Teknik Bangunan SMKN 1 Rembang...");

        // Pastikan role ada
        Role::firstOrCreate(['name' => 'guru', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'perusahaan', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'siswa', 'guard_name' => 'web']);

        // =====================================================================
        // 1. GURU PEMBIMBING
        // =====================================================================
        $guru = User::firstOrCreate(
            ['email' => 'agus.setiawan@smkn1rembang.sch.id'],
            [
                'name'     => 'Bp. Agus Setiawan, S.Pd.',
                'password' => Hash::make('gurupembimbing'),
            ]
        );
        if (!$guru->hasRole('guru')) {
            $guru->assignRole('guru');
        }
        $this->command->info("  ✅ Guru Pembimbing: {$guru->name} ({$guru->email})");

        // =====================================================================
        // 2. MITRA PKL (PERUSAHAAN / INSTANSI)
        // =====================================================================
        $mitraData = [
            [
                'name'    => 'CV. Ridho Makmur',
                'email'   => 'ridhomakmur@mitra.sch.id',
                'alamat'  => 'Jl. Selamet Riyadi, Ketanggi, Rembang',
                'mentor'  => 'Bp. Ridho / Staf Teknis',
            ],
            [
                'name'    => 'Dinas PUPR Kab. Rembang',
                'email'   => 'pupr.rembang@mitra.sch.id',
                'alamat'  => 'Jl. Pemuda No. 45, Rembang',
                'mentor'  => 'Bidang Bina Marga / Cipta Karya',
            ],
            [
                'name'    => 'Dinas PKP Kab. Rembang',
                'email'   => 'pkp.rembang@mitra.sch.id',
                'alamat'  => 'Kompleks Kantor Pemkab Rembang',
                'mentor'  => 'Bidang Perumahan',
            ],
            [
                'name'    => 'Kantor Pertanahan (BPN) Rembang',
                'email'   => 'bpn.rembang@mitra.sch.id',
                'alamat'  => 'Jl. Pangeran Diponegoro, Rembang',
                'mentor'  => 'Seksi Pengukuran & Pemetaan',
            ],
            [
                'name'    => 'PT. Rembang Bangun Persada',
                'email'   => 'rbp@mitra.sch.id',
                'alamat'  => 'Jl. Raya Rembang-Blora, Rembang',
                'mentor'  => 'Site Manager / Pengawas',
            ],
            [
                'name'    => 'Sanskerta Arsitektur Rembang',
                'email'   => 'sanskerta@mitra.sch.id',
                'alamat'  => 'Kota Rembang (Studio Swasta)',
                'mentor'  => 'Principal Architect',
            ],
        ];

        $mitraUsers = [];
        foreach ($mitraData as $mitra) {
            $user = User::firstOrCreate(
                ['email' => $mitra['email']],
                [
                    'name'     => $mitra['name'],
                    'password' => Hash::make('mitra123'),
                ]
            );
            if (!$user->hasRole('perusahaan')) {
                $user->assignRole('perusahaan');
            }
            $mitraUsers[$mitra['name']] = [
                'user'   => $user,
                'alamat' => $mitra['alamat'],
                'mentor' => $mitra['mentor'],
            ];
            $this->command->info("  ✅ Mitra: {$user->name} ({$user->email})");
        }

        // =====================================================================
        // 3. ENTRI PKL (6 Program, Periode 13 Jul - 18 Des 2026)
        // =====================================================================
        $tanggalMulai   = '2026-07-13';
        $tanggalSelesai = '2026-12-18';

        $pklEntries = [];
        foreach ($mitraUsers as $mitraName => $mitraInfo) {
            $pkl = PKL::firstOrCreate(
                ['nama' => "PKL Teknik Bangunan - {$mitraName} (13 Jul - 18 Des 2026)"],
                [
                    'perusahaan_id'     => $mitraInfo['user']->id,
                    'pembimbing_id'     => $guru->id,
                    'tanggal_mulai'     => $tanggalMulai,
                    'tanggal_selesai'   => $tanggalSelesai,
                    'alamat_mitra'      => $mitraInfo['alamat'],
                    'mentor_industri'   => $mitraInfo['mentor'],
                    'status'            => 'berjalan',
                    'status_waka_humas' => 'disetujui',
                    'status_pembimbing' => 'disetujui',
                ]
            );
            $pklEntries[$mitraName] = $pkl;
            $this->command->info("  ✅ PKL: {$pkl->nama} (ID: {$pkl->id})");
        }

        // =====================================================================
        // 4. DATA 32 SISWA
        // =====================================================================
        $siswaData = [
            ['nis' => '24001', 'name' => 'Ahmad Rizky Pratama',   'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24002', 'name' => 'Siti Nurhaliza',         'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
            ['nis' => '24003', 'name' => 'Bagas Saputra',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'Dinas PKP Kab. Rembang'],
            ['nis' => '24004', 'name' => 'Anisa Rahmawati',        'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Kantor Pertanahan (BPN) Rembang'],
            ['nis' => '24005', 'name' => 'Diki Wahyudi',           'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'PT. Rembang Bangun Persada'],
            ['nis' => '24006', 'name' => 'Putri Ayu Lestari',      'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Sanskerta Arsitektur Rembang'],
            ['nis' => '24007', 'name' => 'Riyan Hidayat',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24008', 'name' => 'Dewi Sartika',           'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
            ['nis' => '24009', 'name' => 'Fajar Ramadhan',         'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'Dinas PKP Kab. Rembang'],
            ['nis' => '24010', 'name' => 'Mega Utami',             'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Kantor Pertanahan (BPN) Rembang'],
            ['nis' => '24011', 'name' => 'Eko Prasetyo',           'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'PT. Rembang Bangun Persada'],
            ['nis' => '24012', 'name' => 'Sari Indah Permata',     'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Sanskerta Arsitektur Rembang'],
            ['nis' => '24013', 'name' => 'Arif Budiman',           'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24014', 'name' => 'Lani Cahyani',           'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
            ['nis' => '24015', 'name' => 'Hendra Wijaya',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'Dinas PKP Kab. Rembang'],
            ['nis' => '24016', 'name' => 'Rina Amelia',            'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Kantor Pertanahan (BPN) Rembang'],
            ['nis' => '24017', 'name' => 'Dimas Anggara',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'PT. Rembang Bangun Persada'],
            ['nis' => '24018', 'name' => 'Novi Anggraini',         'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Sanskerta Arsitektur Rembang'],
            ['nis' => '24019', 'name' => 'Gilang Permana',         'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24020', 'name' => 'Yulia Fitriani',         'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
            ['nis' => '24021', 'name' => 'Aditya Nugroho',         'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'Dinas PKP Kab. Rembang'],
            ['nis' => '24022', 'name' => 'Sinta Bella',            'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Kantor Pertanahan (BPN) Rembang'],
            ['nis' => '24023', 'name' => 'Rendra Kusuma',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'PT. Rembang Bangun Persada'],
            ['nis' => '24024', 'name' => 'Diana Puspita',          'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Sanskerta Arsitektur Rembang'],
            ['nis' => '24025', 'name' => 'Bambang Pamungkas',      'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24026', 'name' => 'Fitri Handayani',        'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
            ['nis' => '24027', 'name' => 'Taufik Hidayat',         'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'Dinas PKP Kab. Rembang'],
            ['nis' => '24028', 'name' => 'Indah Lestari',          'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Kantor Pertanahan (BPN) Rembang'],
            ['nis' => '24029', 'name' => 'Andika Perkasa',         'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'PT. Rembang Bangun Persada'],
            ['nis' => '24030', 'name' => 'Sri Wahyuni',            'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Sanskerta Arsitektur Rembang'],
            ['nis' => '24031', 'name' => 'Doni Setiawan',          'kompetensi' => 'DPIB (Desain Pemodelan)',             'mitra' => 'CV. Ridho Makmur'],
            ['nis' => '24032', 'name' => 'Rara Ayu',               'kompetensi' => 'Teknik Konstruksi & Perumahan',      'mitra' => 'Dinas PUPR Kab. Rembang'],
        ];

        $countCreated = 0;
        $countSkipped = 0;

        foreach ($siswaData as $data) {
            $email = "{$data['nis']}@smkn1rembang.sch.id";
            $pkl   = $pklEntries[$data['mitra']];

            $siswa = User::firstOrCreate(
                ['email' => $email],
                [
                    'name'                => $data['name'],
                    'nis'                 => $data['nis'],
                    'kompetensi_keahlian' => $data['kompetensi'],
                    'password'            => Hash::make($data['nis']),
                    'pkl_id'              => $pkl->id,
                    'pkl_status'          => 'disetujui',
                ]
            );

            // Jika user sudah ada, update data PKL-nya
            if (!$siswa->wasRecentlyCreated) {
                $siswa->update([
                    'nis'                 => $data['nis'],
                    'kompetensi_keahlian' => $data['kompetensi'],
                    'pkl_id'              => $pkl->id,
                    'pkl_status'          => 'disetujui',
                ]);
                $countSkipped++;
            } else {
                $countCreated++;
            }

            if (!$siswa->hasRole('siswa')) {
                $siswa->assignRole('siswa');
            }
        }

        $this->command->info("  ✅ Siswa: {$countCreated} dibuat, {$countSkipped} sudah ada (diupdate).");

        // =====================================================================
        // 5. REKAP PENEMPATAN
        // =====================================================================
        $this->command->newLine();
        $this->command->info("📋 REKAPITULASI PENEMPATAN PKL TEKNIK BANGUNAN SMKN 1 REMBANG");
        $this->command->info("   Periode: 13 Juli 2026 – 18 Desember 2026");
        $this->command->info("   Guru Pembimbing: {$guru->name} ({$guru->email})");
        $this->command->newLine();

        $headers = ['No', 'Nama Mitra', 'Alamat', 'Mentor Industri', 'Jumlah Siswa'];
        $rows = [];
        $no = 1;
        $totalSiswa = 0;

        foreach ($pklEntries as $mitraName => $pkl) {
            $jumlahSiswa = User::where('pkl_id', $pkl->id)->count();
            $totalSiswa += $jumlahSiswa;
            $rows[] = [
                $no++,
                $mitraName,
                $mitraUsers[$mitraName]['alamat'],
                $mitraUsers[$mitraName]['mentor'],
                $jumlahSiswa,
            ];
        }

        $this->command->table($headers, $rows);
        $this->command->info("   TOTAL SISWA: {$totalSiswa}");
        $this->command->newLine();
        $this->command->info("🎉 Seeding PKL Rembang selesai!");
    }
}
