<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 04 November 2026
    Nama File       : DosenController.php
*/

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DosenController extends Controller
{
    // Menampilkan halaman daftar dosen
    public function index(): View
    {
        return view('dosen.index');
    }

    // Mengambil data dosen untuk Yajra DataTables
    public function data(): JsonResponse
    {
        $query = Dosen::query()->select([
            'id',
            'nidn',
            'nama',
            'email',
            'telepon',
            'alamat',
            'jabatan_fungsional'
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function (Dosen $dosen) {
                return view(
                    'dosen._aksi',
                    compact('dosen')
                )->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // Menampilkan form tambah dosen
    public function create(): View
    {
        return view('dosen.create', [
            'dosen' => new Dosen()
        ]);
    }

    // Menyimpan data dosen baru
    public function store(Request $request): RedirectResponse
    {
        $dosen = Dosen::create(
            $this->validated($request)
        );

        return redirect()
            ->route('dosen.index')
            ->with(
                'success',
                'Data dosen ' . $dosen->nama .
                ' berhasil ditambahkan.'
            );
    }

    // Menampilkan detail dosen
    public function show(Dosen $dosen): View
    {
        return view('dosen.show', compact('dosen'));
    }

    // Menampilkan form edit dosen
    public function edit(Dosen $dosen): View
    {
        return view('dosen.edit', compact('dosen'));
    }

    // Memperbarui data dosen
    public function update(
        Request $request,
        Dosen $dosen
    ): RedirectResponse {
        $dosen->update(
            $this->validated($request, $dosen)
        );

        return redirect()
            ->route('dosen.index')
            ->with(
                'success',
                'Data dosen ' . $dosen->nama .
                ' berhasil diperbarui.'
            );
    }

    // Menghapus data dosen
    public function destroy(Dosen $dosen): JsonResponse
    {
        try {
            $nama = $dosen->nama;

            $dosen->delete();

        } catch (QueryException $e) {
            return response()->json([
                'message' =>
                    'Data dosen tidak dapat dihapus: masih dipakai data lain.'
            ], 409);
        }

        return response()->json([
            'message' =>
                'Data dosen ' . $nama .
                ' berhasil dihapus.'
        ]);
    }

    // Validasi data dosen
    private function validated(
        Request $request,
        ?Dosen $dosen = null
    ): array {
        return $request->validate([

            'nidn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('dosen', 'nidn')
                    ->ignore($dosen?->id),
            ],

            'nama' => [
                'required',
                'string',
                'max:120',
            ],

            'email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('dosen', 'email')
                    ->ignore($dosen?->id),
            ],

            'telepon' => [
                'nullable',
                'string',
                'max:20',
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:500',
            ],

            'jabatan_fungsional' => [
                'nullable',
                'string',
                'max:100',
            ],

        ], [

            'nidn.required' =>
                'NIDN wajib diisi.',

            'nidn.max' =>
                'NIDN maksimal 20 karakter.',

            'nidn.unique' =>
                'NIDN sudah dipakai dosen lain.',

            'nama.required' =>
                'Nama dosen wajib diisi.',

            'nama.max' =>
                'Nama dosen maksimal 120 karakter.',

            'email.required' =>
                'Email wajib diisi.',

            'email.email' =>
                'Format email tidak valid.',

            'email.max' =>
                'Email maksimal 120 karakter.',

            'email.unique' =>
                'Email sudah dipakai dosen lain.',

            'telepon.max' =>
                'Nomor telepon maksimal 20 karakter.',

            'alamat.max' =>
                'Alamat maksimal 500 karakter.',

            'jabatan_fungsional.max' =>
                'Jabatan fungsional maksimal 100 karakter.',

        ]);
    }
}