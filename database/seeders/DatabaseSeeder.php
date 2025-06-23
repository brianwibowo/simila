<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

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
            [
                'name' => 'alifian',
                'email' => 'alifian@example.com',
                'password' => 'alifian',
                'role' => 'perusahaan',
            ],
            [
                'name' => 'viantech',
                'email' => 'viantech@example.com',
                'password' => 'viantech',
                'role' => 'perusahaan',
            ],
            [
                'name' => 'guru_produktif',
                'email' => 'produktif@example.com',
                'password' => 'produktif',
                'role' => 'guru',
                'jenis_guru' => 'guru-produktif',
            ],
        ];

        foreach ($usersToCreate as $userData) {
            if (! User::where('email', $userData['email'])->exists()) {
                if($userData['jenis_guru']){                    
                    $user = User::create([
                    'name' => $userData['name'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'jenis_guru' => $userData['jenis_guru']
                    ]);
                    
                } else{   
                    $user = User::create([
                        'name' => $userData['name'],
                        'email' => $userData['email'],
                        'password' => Hash::make($userData['password']), // Gunakan Hash::make() untuk password
                    ]);
                }

                $user->assignRole($userData['role']);

                $this->command->info("User '{$userData['email']}' created and assigned role '{$userData['role']}'.");
            } else {
                $this->command->warn("User '{$userData['email']}' already exists. Skipping creation.");

                $existingUser = User::where('email', $userData['email'])->first();
                if ($existingUser && ! $existingUser->hasRole($userData['role'])) {
                    $existingUser->assignRole($userData['role']);
                    $this->command->info("Assigned role '{$userData['role']}' to existing user '{$userData['email']}'.");
                }
            }
        }
    }
}