<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role' => 'admin', 
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s')
            ],
            [
                'role' => 'calon',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
        ]);

        DB::table('program_studi')->insert([
            [
                'nama' => 'S1 Teknik Informatika',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Sipil',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Akuntansi', 
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Agribisnis',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Manajemen',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Ilmu Komunikasi',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'S1 Ilmu Keperawatan',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],  
            [
                'nama' => 'D4 Keperawatan Anestesiologi',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'nama' => 'Profesi Ners',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
        ]);

        DB::table('seleksi')->insert([
            [
                'status' => 'Tahap Seleksi',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'status' => 'Tidak Diterima',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'status' => 'Diterima',
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
        ]);

        DB::table('biaya_pendaftaran')->insert([
            [
                'biaya' => '150000', 
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
        ]);

        DB::table('users')->insert([
            [
                'id' => Str::uuid(),
                'nama' => 'Admin PMB',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'role_id' => 1,
                'seleksi_id' => null,
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Ronaldo Kereh',
                'email' => 'kreh.whoami@gmail.com',
                'username' => 'kereh',
                'password' => Hash::make('kereh'),
                'role_id' => 2,
                'seleksi_id' => 1,
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Dustin Immanuel',
                'email' => 'dustin@gmail.com',
                'username' => 'dustin',
                'password' => Hash::make('dustin'),
                'role_id' => 2,
                'seleksi_id' => 1,
                'created_at' => now()->format('Y-m-d H:m:s'),
                'updated_at' => now()->format('Y-m-d H:m:s'),
            ],
        ]);
    }
}
