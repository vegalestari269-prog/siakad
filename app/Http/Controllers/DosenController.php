<?php

/*
    Nama	  	: Vega Lestari
	NIM		  	: 3202416116
	Nama File	: DosenController.php
    Tanggal Buat: 15 Oktober 2026
*/

namespace App\Http\Controllers;

class DosenController extends Controller
{
    public function index()
    {
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

        return view('dosen.index', compact('dosen'));
    }
}
