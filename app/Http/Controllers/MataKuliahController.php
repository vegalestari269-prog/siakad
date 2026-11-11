<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    // Menampilkan halaman data mata kuliah
    public function index()
    {
        return view('mata-kuliah.index');
    }

    // Mengambil data untuk DataTables Server-Side
    public function data()
    {
        return DataTables::eloquent(
            MataKuliah::query()->select([
                'id',
                'kode_mk',
                'nama_mk',
                'sks',
            ])
        )
            ->addIndexColumn()
            ->addColumn('aksi', function ($mataKuliah) {
                return view('mata-kuliah._aksi', compact('mataKuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // Menampilkan form tambah mata kuliah
    public function create()
    {
        return view('mata-kuliah.create', [
            'mataKuliah' => new MataKuliah(),
        ]);
    }

    // Menyimpan data mata kuliah
    public function store(Request $request)
    {
        MataKuliah::create($this->validated($request));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan.');
    }

    // Menampilkan detail mata kuliah
    public function show(MataKuliah $mataKuliah)
    {
        return view('mata-kuliah.show', compact('mataKuliah'));
    }

    // Menampilkan form edit mata kuliah
    public function edit(MataKuliah $mataKuliah)
    {
        return view('mata-kuliah.edit', compact('mataKuliah'));
    }

    // Memperbarui data mata kuliah
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        $mataKuliah->update($this->validated($request, $mataKuliah));

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui.');
    }

    // Menghapus data mata kuliah
    public function destroy(MataKuliah $mataKuliah)
    {
        try {
            $mataKuliah->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data mata kuliah berhasil dihapus.',
            ]);

        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data mata kuliah tidak dapat dihapus karena masih digunakan pada KRS.',
            ], 409);
        }
    }

    // Validasi data mata kuliah
    private function validated(
        Request $request,
        ?MataKuliah $mataKuliah = null
    ): array {
        return $request->validate([
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mata_kuliah', 'kode_mk')
                    ->ignore($mataKuliah?->id),
            ],

            'nama_mk' => [
                'required',
                'string',
                'max:100',
            ],

            'sks' => [
                'required',
                'integer',
                'min:1',
                'max:6',
            ],
        ], [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.unique' => 'Kode mata kuliah sudah digunakan.',
            'kode_mk.max' => 'Kode mata kuliah maksimal 10 karakter.',

            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max' => 'Nama mata kuliah maksimal 100 karakter.',

            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'Jumlah SKS harus berupa angka.',
            'sks.min' => 'Jumlah SKS minimal 1.',
            'sks.max' => 'Jumlah SKS maksimal 6.',
        ]);
    }
}