<?php

/*
    Nama	  	: Vega Lestari
	NIM		  	: 3202416116
	Nama File	: MataKuliahController.php
    Tanggal Buat: 15 Oktober 2026
*/

namespace App\Http\Controllers;

class MataKuliahController extends Controller
{
    public function index()
    {
        $mataKuliah = [
            [
                'kode' => 'IF101',
                'nama' => 'Algoritma dan Pemrograman',
                'sks' => 3,
                'semester' => 1,
            ],
            [
                'kode' => 'IF102',
                'nama' => 'Basis Data',
                'sks' => 3,
                'semester' => 2,
            ],
            [
                'kode' => 'IF103',
                'nama' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 3,
            ],
        ];

        return view('mata-kuliah.index', compact('mataKuliah'));
    }
}
