<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role; // Ini tidak diperlukan di DatabaseSeeder, tapi tidak masalah
use Illuminate\Support\Facades\Hash; // Penting untuk Hash::make()

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Panggil RoleSeeder terlebih dahulu. Pastikan RoleSeeder sudah memiliki pengecekan "exists".
        $this->call(RoleSeeder::class);
        $this->call(GuruTamuSeeder::class);
        $this->call(PklSeeder::class);

        // Daftar pengguna yang ingin Anda buat beserta peran mereka
        $usersToCreate = [
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'admin',
                'role' => 'admin',
            ],
            [
                'name' => 'siswa',
                'email' => 'siswa@example.com',
                'password' => 'siswa',
                'role' => 'siswa',
            ],
            [
                'name' => 'guru',
                'email' => 'guru@example.com',
                'password' => 'guru',
                'role' => 'guru',
            ],
            [
                'name' => 'perusahaan',
                'email' => 'perusahaan@example.com',
                'password' => 'perusahaan',
                'role' => 'perusahaan',
            ],
            [
                'name' => 'waka_kurikulum',
                'email' => 'waka_kurikulum@example.com',
                'password' => 'waka_kurikulum',
                'role' => 'waka_kurikulum',
            ],
            [
                'name' => 'waka_humas',
                'email' => 'waka_humas@example.com',
                'password' => 'waka_humas',
                'role' => 'waka_humas',
            ],
            [
                'name' => 'alumni',
                'email' => 'alumni@example.com',
                'password' => 'alumni',
                'role' => 'alumni',
            ],
            [
                'name' => 'lsp',
                'email' => 'lsp@example.com',
                'password' => 'lsp',
                'role' => 'lsp',
            ],
        ];

        foreach ($usersToCreate as $userData) {
            // Periksa apakah pengguna dengan email ini sudah ada
            if (! User::where('email', $userData['email'])->exists()) {
                $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']), // Gunakan Hash::make() untuk password
                ]);

                // Tetapkan peran kepada pengguna yang baru dibuat
                $user->assignRole($userData['role']);

                $this->command->info("User '{$userData['email']}' created and assigned role '{$userData['role']}'.");
            } else {
                $this->command->warn("User '{$userData['email']}' already exists. Skipping creation.");

                // Opsional: Jika user sudah ada, tapi mungkin perannya belum terassign, Anda bisa tambahkan ini
                $existingUser = User::where('email', $userData['email'])->first();
                if ($existingUser && ! $existingUser->hasRole($userData['role'])) {
                    $existingUser->assignRole($userData['role']);
                    $this->command->info("Assigned role '{$userData['role']}' to existing user '{$userData['email']}'.");
                }
            }
        }
    }
}