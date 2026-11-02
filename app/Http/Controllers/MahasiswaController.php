<?php

/*
    Nama        : Vega Lestari
    NIM         : 3202416116
    Nama File   : MahasiswaController.php
    Tanggal Buat: 15 Oktober 2026
*/

namespace App\Http\Controllers;

use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'nim' => 'NIM',
            'nama' => 'Nama Lengkap',
            'angkatan' => 'Angkatan',
            'email' => 'Email',
            'status' => 'Status',
        ];

        $mahasiswa = [
            [
                'nim' => '2401001',
                'nama' => 'Ahmad Fauzi',
                'angkatan' => 2024,
                'email' => 'ahmad.fauzi@contoh.ac.id',
                'status' => 'Aktif',
            ],
            [
                'nim' => '2401002',
                'nama' => 'Siti Rahmawati',
                'angkatan' => 2024,
                'email' => 'siti.rahmawati@contoh.ac.id',
                'status' => 'Aktif',
            ],
            [
                'nim' => '2301005',
                'nama' => 'Budi Santoso',
                'angkatan' => 2023,
                'email' => 'budi.santoso@contoh.ac.id',
                'status' => 'Aktif',
            ],
            [
                'nim' => '2301012',
                'nama' => 'Dewi Lestari',
                'angkatan' => 2023,
                'email' => 'dewi.lestari@contoh.ac.id',
                'status' => 'Drop out',
            ],
            [
                'nim' => '2201020',
                'nama' => 'Rizky Pratama',
                'angkatan' => 2022,
                'email' => 'rizky.pratama@contoh.ac.id',
                'status' => 'Lulus',
            ],
        ];

        return view('mahasiswa.index', compact('kolom', 'mahasiswa'));
    }

    public function show(string $nim): View
    {
        $mahasiswa = [
            '2401001' => [
                'nim' => '2401001',
                'nama' => 'Ahmad Fauzi',
                'angkatan' => 2024,
                'email' => 'ahmad.fauzi@contoh.ac.id',
                'status' => 'Aktif',
            ],
            '2401002' => [
                'nim' => '2401002',
                'nama' => 'Siti Rahmawati',
                'angkatan' => 2024,
                'email' => 'siti.rahmawati@contoh.ac.id',
                'status' => 'Aktif',
            ],
            '2301005' => [
                'nim' => '2301005',
                'nama' => 'Budi Santoso',
                'angkatan' => 2023,
                'email' => 'budi.santoso@contoh.ac.id',
                'status' => 'Aktif',
            ],
            '2301012' => [
                'nim' => '2301012',
                'nama' => 'Dewi Lestari',
                'angkatan' => 2023,
                'email' => 'dewi.lestari@contoh.ac.id',
                'status' => 'Drop out',
            ],
            '2201020' => [
                'nim' => '2201020',
                'nama' => 'Rizky Pratama',
                'angkatan' => 2022,
                'email' => 'rizky.pratama@contoh.ac.id',
                'status' => 'Lulus',
            ],
        ];

        if (!isset($mahasiswa[$nim])) {
            abort(404);
        }

        return view('mahasiswa.show', [
            'data' => $mahasiswa[$nim],
        ]);
    }
}
