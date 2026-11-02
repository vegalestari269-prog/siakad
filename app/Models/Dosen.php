<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : Dosen.php
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nidn',
        'nama',
        'email',
        'telepon',
        'alamat',
		'jabatan_fungsional',
    ];
}