<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/*
    Nama        : Vega Lestari
    NIM         : 3202416116
    Nama File   : DosenController.php
    Tanggal Buat: 15 Oktober 2026
*/

class DosenController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'nidn' => 'NIDN',
            'nama' => 'Nama Dosen',
            'email' => 'Email',
            'bidang' => 'Bidang Keahlian',
        ];

        $dosen = [
            [
                'nidn' => '0012345678',
                'nama' => 'Budi Santoso',
                'email' => 'budi@polnep.ac.id',
                'bidang' => 'Pemrograman',
            ],
            [
                'nidn' => '0012345679',
                'nama' => 'Siti Aminah',
                'email' => 'siti@polnep.ac.id',
                'bidang' => 'Basis Data',
            ],
            [
                'nidn' => '0012345680',
                'nama' => 'Andi Wijaya',
                'email' => 'andi@polnep.ac.id',
                'bidang' => 'Jaringan Komputer',
            ],
        ];

        return view('dosen.index', compact('kolom', 'dosen'));
    }
}
