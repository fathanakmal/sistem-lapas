<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Superadmin
        \App\Models\User::create([
            'name' => 'Bapak Kalapas',
            'email' => 'superadmin@lapas.go.id',
            'password' => \Illuminate\Support\Facades\Hash::make('rahasia123'),
            'role' => 'superadmin',
        ]);

        // 2. Akun Supervisor
        \App\Models\User::create([
            'name' => 'Komandan Jaga',
            'email' => 'supervisor@lapas.go.id',
            'password' => \Illuminate\Support\Facades\Hash::make('rahasia123'),
            'role' => 'supervisor',
        ]);

        // 3. Akun Petugas Biasa
        \App\Models\User::create([
            'name' => 'Sipir Blok A',
            'email' => 'petugas@lapas.go.id',
            'password' => \Illuminate\Support\Facades\Hash::make('rahasia123'),
            'role' => 'petugas',
        ]);
        \App\Models\Napi::factory(35)->create();
    }
}