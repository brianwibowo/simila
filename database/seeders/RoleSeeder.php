<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin', 'guard_name' => 'web']);
        Role::create(['name' => 'waka_kurikulum', 'guard_name' => 'web']);
        Role::create(['name' => 'perusahaan', 'guard_name' => 'web']);
        Role::create(['name' => 'siswa', 'guard_name' => 'web']);
        Role::create(['name' => 'guru', 'guard_name' => 'web']);
        Role::create(['name' => 'waka_humas', 'guard_name' => 'web']);
        Role::create(['name' => 'alumni', 'guard_name' => 'web']);
        Role::create(['name' => 'lsp', 'guard_name' => 'web']);
        Role::create(['name' => 'user', 'guard_name' => 'web']);
    }
}
