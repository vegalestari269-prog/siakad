<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : AdminSeeder.php
*/

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@siakad.test'],
            [
                'name' => 'Administrator SIAKAD',
                'password' => Hash::make('vega12345'),
                'role' => 'admin',
            ]
        );
    }
}