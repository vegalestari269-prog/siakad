<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MataKuliahController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'kode' => 'Kode Mata Kuliah',
            'nama' => 'Nama Mata Kuliah',
            'sks' => 'SKS',
            'semester' => 'Semester',
        ];

        $matakuliah = [
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

        return view('mata-kuliah.index', compact('kolom', 'matakuliah'));
    }
}
