<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
            ['role' => 'admin'],
            ['role' => 'calon_mahasiswa'],
        ]);

        DB::table('program_studi')->insert([
            ['nama' => 'S1 Teknik Informatika'],
            ['nama' => 'S1 Sipil'],
            ['nama' => 'S1 Akuntansi'],
            ['nama' => 'S1 Agribisnis'],
            ['nama' => 'S1 Manajemen'],
            ['nama' => 'S1 Ilmu Komunikasi'],
            ['nama' => 'S1 Ilmu Keperawatan'],  
            ['nama' => 'D4 Keperawatan Anestesiologi'],
            ['nama' => 'Profesi Ners'],
        ]);

        DB::table('seleksi')->insert([
            ['status' => 'Tahap Seleksi'],
            ['status' => 'Tidak Diterima'],
            ['status' => 'Diterima'],
        ]);

        DB::table('biaya_pendaftaran')->insert([
            ['biaya' => '150000'],
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
                'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
            ],
            [
                'id' => Str::uuid(),
                'nama' => 'Ronaldo Kereh',
                'email' => 'kreh.whoami@gmail.com',
                'username' => 'kereh',
                'password' => Hash::make('kereh'),
                'role_id' => 2,
                'seleksi_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:m:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:m:s'),
            ]
        ]);
    }
}
