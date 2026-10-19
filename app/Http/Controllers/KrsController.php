<?php

/*
    Nama	  	: Vega Lestari
	NIM		  	: 3202416116
	Nama File	: KrsController.php
    Tanggal Buat: 15 Oktober 2026
*/

namespace App\Http\Controllers;

class KrsController extends Controller
{
    public function index()
    {
        $krs = [
            [
                'id' => 1,
                'nim' => '3202416001',
                'nama_mahasiswa' => 'Andi Saputra',
                'semester' => 1,
                'total_sks' => 20,
            ],
            [
                'id' => 2,
                'nim' => '3202416002',
                'nama_mahasiswa' => 'Siti Aminah',
                'semester' => 1,
                'total_sks' => 22,
            ],
            [
                'id' => 3,
                'nim' => '3202416003',
                'nama_mahasiswa' => 'Budi Santoso',
                'semester' => 1,
                'total_sks' => 21,
            ],
        ];

        return view('krs.index', compact('krs'));
    }
}
