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
        // Pastikan ada minimal 3 user dengan role yang sesuai
        $siswa = User::where('email', 'siswa@example.com')->first();
        $pembimbing = User::where('email', 'guru@example.com')->first();
        $perusahaan = User::where('email', 'perusahaan@example.com')->first();

        if (!$siswa || !$pembimbing || !$perusahaan) {
            // Jika user tidak ditemukan, buat user baru
            $siswa = User::create([
                'name' => 'Siswa Contoh',
                'email' => 'siswa@example.com',
                'password' => bcrypt('password'),
            ]);
            $siswa->assignRole('siswa');

            $pembimbing = User::create([
                'name' => 'Guru Pembimbing',
                'email' => 'guru@example.com',
                'password' => bcrypt('password'),
            ]);
            $pembimbing->assignRole('guru');

            $perusahaan = User::create([
                'name' => 'Perusahaan Contoh',
                'email' => 'perusahaan@example.com',
                'password' => bcrypt('password'),
            ]);
            $perusahaan->assignRole('perusahaan');

            $this->command->info('Created sample users for PKL data');
        }

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
