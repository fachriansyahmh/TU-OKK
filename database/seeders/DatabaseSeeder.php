<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat atau memperbarui pengguna default (Admin)
        User::updateOrCreate(
            ['email' => 'admin@laravolt.com'], // Kunci unik untuk mencari pengguna
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Mengatur informasi umum aplikasi menggunakan service container
        $settings = app('setting');
        $settings->set('app.name', 'Aplikasi TU-OKK');
        $settings->set('app.description', 'Sistem Informasi Tata Usaha dan Kearsipan');
        $settings->set('app.logo', '/LogoTU.png');
        $settings->save();
    }
}
