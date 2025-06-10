<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class GuruTamuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('guru_tamus')->insert([
            [
                'nama_karyawan' => 'Andi Saputra',
                'jabatan' => 'Software Engineer',
                'keahlian' => 'Backend Development',
                'deskripsi' => 'Berpengalaman membangun REST API dan microservice.',
                'jadwal' => '2025-07-01 09:00:00',
                'file_cv' => 'cv_andi.pdf',
                'file_materi' => 'materi_backend.pdf',
                'status' => 'proses',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'nama_karyawan' => 'Rina Oktavia',
                'jabatan' => 'Data Scientist',
                'keahlian' => 'Machine Learning',
                'deskripsi' => 'Mahir dalam analisis data dan pembuatan model prediktif.',
                'jadwal' => '2025-07-10 14:00:00',
                'file_cv' => 'cv_rina.pdf',
                'file_materi' => 'materi_ml.pdf',
                'status' => 'proses',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
