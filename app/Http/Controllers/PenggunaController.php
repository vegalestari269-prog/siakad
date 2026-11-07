<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        // Menentukan kolom tabel pengguna
        $kolom = [
            'name' => 'Nama',
            'email' => 'Email',
            'role' => 'Peran',
            'last_login_at' => 'Login Terakhir',
        ];

        // Mengambil data pengguna tanpa password
        $pengguna = User::orderBy('name')
            ->get(['name', 'email', 'role', 'last_login_at'])
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                    'last_login_at' => $user->last_login_at
                        ? $user->last_login_at->format('d-m-Y H:i:s')
                        : 'Belum pernah login',
                ];
            })
            ->toArray();

        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}
