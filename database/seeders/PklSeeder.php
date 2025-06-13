<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PklSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Cek apakah user sudah ada
        $siswa = User::where('email', 'siswa@example.com')->first();
        $pembimbing = User::where('email', 'guru@example.com')->first();
        $perusahaan = User::where('email', 'perusahaan@example.com')->first();

        // Jika ada user yang belum dibuat, lewati seeding data PKL
        if (!$siswa || !$pembimbing || !$perusahaan) {
            $this->command->warn('Skipping PKL data seeding. Please run DatabaseSeeder first to create required users.');
            return;
        }

        // Pastikan role sudah di-assign
        if (!$siswa->hasRole('siswa')) {
            $siswa->assignRole('siswa');
        }
        if (!$pembimbing->hasRole('guru')) {
            $pembimbing->assignRole('guru');
        }
        if (!$perusahaan->hasRole('perusahaan')) {
            $perusahaan->assignRole('perusahaan');
        }

        $this->command->info('Using existing users from DatabaseSeeder for PKL data');

        $data = [
            [
                'siswa_id' => $siswa->id,
                'pembimbing_id' => $pembimbing->id,
                'perusahaan_id' => $perusahaan->id,
                'laporan_akhir' => 'laporan_siswa_01.pdf',
                'status_pembimbing' => 'disetujui',
                'status_waka_humas' => 'proses',
                'nilai' => 80,
                'catatan_waka_humas' => null,
                'tanggal_validasi_waka_humas' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => $siswa->id,
                'pembimbing_id' => $pembimbing->id,
                'perusahaan_id' => $perusahaan->id,
                'laporan_akhir' => 'laporan_siswa_02.pdf',
                'status_pembimbing' => 'proses',
                'status_waka_humas' => 'proses',
                'nilai' => 0,
                'catatan_waka_humas' => null,
                'tanggal_validasi_waka_humas' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'siswa_id' => $siswa->id,
                'pembimbing_id' => $pembimbing->id,
                'perusahaan_id' => $perusahaan->id,
                'laporan_akhir' => 'laporan_siswa_03.pdf',
                'status_pembimbing' => 'disetujui',
                'status_waka_humas' => 'proses',
                'nilai' => 85,
                'catatan_waka_humas' => null,
                'tanggal_validasi_waka_humas' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($data as $item) {
            DB::table('pkls')->insert($item);
        }
    }
}
