<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'], // Sesuaikan email jika perlu
            [
                'name' => 'Admin',
                'password' => bcrypt('password'), // Ganti dengan password aman
            ]
        );

        // Tambahkan role admin ke akun
        $admin->assignRole('admin');

        // Membuat akun mahasiswa
        $mahasiswa = User::firstOrCreate(
            ['email' => 'mahasiswa@example.com'], // Sesuaikan email jika perlu
            [
                'name' => 'Mahasiswa',
                'password' => bcrypt('password'), // Ganti dengan password aman
            ]
        );

        // Tambahkan role mahasiswa ke akun
        $mahasiswa->assignRole('mahasiswa');

        // Membuat akun kta
        $jurusan = User::firstOrCreate(
            ['email' => 'jurusan@example.com'], // Sesuaikan email jika perlu
            [
                'name' => 'Jurusan',
                'password' => bcrypt('password'), // Ganti dengan password aman
            ]
        );

        // Tambahkan role mahasiswa ke akun
        $jurusan->assignRole('Jurusan');

        $this->command->info('Akun Admin, Mahasiswa, dan Jurusan berhasil dibuat!');
    }
}
