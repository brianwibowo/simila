<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

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

        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ])->assignRole('admin');

        User::create([
            'name' => 'siswa',
            'email' => 'siswa@example.com',
            'password' => bcrypt('siswa'),
        ])->assignRole('siswa');

        User::create([
            'name' => 'guru',
            'email' => 'guru@example.com',
            'password' => bcrypt('guru'),
        ])->assignRole('guru');

        User::create([
            'name' => 'perusahaan',
            'email' => 'perusahaan@example.com',
            'password' => bcrypt('perusahaan'),
        ])->assignRole('perusahaan');

        User::create([
            'name' => 'waka_kurikulum',
            'email' => 'waka_kurikulum@example.com',
            'password' => bcrypt('waka_kurikulum'),
        ])->assignRole('waka_kurikulum');

        User::create([
            'name' => 'waka_humas',
            'email' => 'waka_humas@example.com',
            'password' => bcrypt('waka_humas'),
        ])->assignRole('waka_humas');

        User::create([
            'name' => 'alumni',
            'email' => 'alumni@example.com',
            'password' => bcrypt('alumni'),
        ])->assignRole('alumni');

        User::create([
            'name' => 'lsp',
            'email' => 'lsp@example.com',
            'password' => bcrypt('lsp'),
        ])->assignRole('lsp');
    }
}
