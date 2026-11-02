<?php

/*
    Nama        : Vega Lestari
    NIM         : 3202416116
    Nama File   : DashboardController.php
    Tanggal Buat: 15 Oktober 2026
*/

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Data sementara untuk kartu statistik dashboard.
        $statistik = [
            [
                'judul' => 'Mahasiswa',
                'jumlah' => 1250,
                'ikon' => 'bi-mortarboard-fill',
                'warna' => 'primary',
            ],
            [
                'judul' => 'Dosen',
                'jumlah' => 68,
                'ikon' => 'bi-person-badge-fill',
                'warna' => 'success',
            ],
            [
                'judul' => 'Mata Kuliah',
                'jumlah' => 94,
                'ikon' => 'bi-book-half',
                'warna' => 'warning',
            ],
            [
                'judul' => 'KRS Aktif',
                'jumlah' => 842,
                'ikon' => 'bi-journal-check',
                'warna' => 'info',
            ],
            [
                'judul' => 'Rata-rata SKS per KRS',
                'jumlah' => 21,
                'ikon' => 'bi-calculator-fill',
                'warna' => 'secondary',
            ],
        ];

        // Kolom untuk tabel KRS terbaru.
        $kolomKrs = [
            'nim' => 'NIM',
            'nama' => 'Nama Mahasiswa',
            'sks' => 'SKS',
            'status' => 'Status',
        ];

        // Data contoh KRS terbaru.
        $krsTerbaru = [
            [
                'nim' => '2401001',
                'nama' => 'Ahmad Fauzi',
                'sks' => 22,
                'status' => 'Disetujui',
            ],
            [
                'nim' => '2401002',
                'nama' => 'Siti Rahmawati',
                'sks' => 20,
                'status' => 'Disetujui',
            ],
            [
                'nim' => '2301005',
                'nama' => 'Budi Santoso',
                'sks' => 24,
                'status' => 'Menunggu',
            ],
            [
                'nim' => '2301012',
                'nama' => 'Dewi Lestari',
                'sks' => 18,
                'status' => 'Menunggu',
            ],
            [
                'nim' => '2201020',
                'nama' => 'Rizky Pratama',
                'sks' => 21,
                'status' => 'Disetujui',
            ],
        ];

        // Data persentase status KRS.
        $statusKrs = [
            [
                'label' => 'Disetujui',
                'persen' => 70,
                'warna' => 'success',
            ],
            [
                'label' => 'Menunggu',
                'persen' => 22,
                'warna' => 'warning',
            ],
            [
                'label' => 'Ditolak',
                'persen' => 8,
                'warna' => 'danger',
            ],
        ];

        // Mengirim data ke halaman dashboard.
        return view('dashboard', compact(
            'statistik',
            'kolomKrs',
            'krsTerbaru',
            'statusKrs'
        ));
    }
}
