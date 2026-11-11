<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\MataKuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    // Menampilkan halaman daftar KRS
    public function index()
    {
        return view('krs.index');
    }

    // Mengambil data KRS untuk DataTables
    public function data()
    {
        $query = Krs::with([
            'mahasiswa',
            'details.mataKuliah'
        ])->select('krs.*');

        return DataTables::eloquent($query)
            ->addIndexColumn()

            ->addColumn('mahasiswa', function ($krs) {
                return $krs->mahasiswa
                    ? $krs->mahasiswa->nim . ' - ' . $krs->mahasiswa->nama
                    : '-';
            })

            ->addColumn('mata_kuliah', function ($krs) {
                return $krs->details
                    ->map(fn ($detail) => $detail->mataKuliah?->nama_mk)
                    ->filter()
                    ->implode(', ');
            })

            ->addColumn('total_sks', function ($krs) {
                return $krs->details->sum(
                    fn ($detail) => $detail->mataKuliah?->sks ?? 0
                );
            })
			
			// Menampilkan status KRS dengan badge warna
			->editColumn('status', function ($krs) {
				$warna = [
					'draft' => 'secondary',
					'diajukan' => 'primary',
					'disetujui' => 'success',
					'ditolak' => 'danger',
				];

				$label = ucfirst($krs->status);
				$kelas = $warna[$krs->status] ?? 'secondary';

				return '<span class="badge bg-' . $kelas . '">' .
					$label .
					'</span>';
			})
			
			//Tombol Aksi
            ->addColumn('aksi', function ($krs) {
                return view('krs._aksi', compact('krs'))->render();
            })
			
			
			// Mengizinkan HTML badge dan tombol aksi
            ->rawColumns(['aksi', 'status'])
            ->toJson();
    }

    // Menampilkan form tambah KRS
    public function create()
    {
        $krs = new Krs();

        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();

        return view('krs.create', compact(
            'krs',
            'mahasiswa',
            'mataKuliah'
        ));
    }

    // Menyimpan data KRS
    public function store(Request $request)
    {
        $validated = $this->validated($request);

        DB::transaction(function () use ($validated) {

            $krs = Krs::create([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            foreach ($validated['mata_kuliah_ids'] as $id) {
                $krs->details()->create([
                    'mata_kuliah_id' => $id,
                ]);
            }
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    // Menampilkan detail KRS
    public function show(Krs $kr)
    {
        $kr->load([
            'mahasiswa',
            'details.mataKuliah'
        ]);

        return view('krs.show', ['krs' => $kr]);
    }

    // Menampilkan form edit KRS
    public function edit(Krs $kr)
    {
        $kr->load('details');

        $krs = $kr;

        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        $mataKuliah = MataKuliah::orderBy('nama_mk')->get();

        $selectedMataKuliah = $kr->details
            ->pluck('mata_kuliah_id')
            ->toArray();

        return view('krs.edit', compact(
            'krs',
            'mahasiswa',
            'mataKuliah',
            'selectedMataKuliah'
        ));
    }

    // Memperbarui data KRS
    public function update(Request $request, Krs $kr)
    {
        $validated = $this->validated($request, $kr);

        DB::transaction(function () use ($validated, $kr) {

            $kr->update([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            // Memperbarui daftar mata kuliah
            $kr->details()->delete();

            foreach ($validated['mata_kuliah_ids'] as $id) {
                $kr->details()->create([
                    'mata_kuliah_id' => $id,
                ]);
            }
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    // Menghapus data KRS
    public function destroy(Krs $kr)
    {
        try {
            $kr->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data KRS berhasil dihapus.'
            ]);

        } catch (\Throwable $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data KRS gagal dihapus.'
            ], 500);
        }
    }

    // Validasi data KRS
    private function validated(Request $request, ?Krs $kr = null)
	{
		$validated = $request->validate([
			'mahasiswa_id' => ['required', 'exists:mahasiswa,id'],
			'tahun_akademik' => ['required', 'string', 'size:9'],
			'semester' => ['required', Rule::in(['Ganjil', 'Genap'])],
			'status' => ['required', Rule::in([
				'draft', 'diajukan', 'disetujui', 'ditolak'
			])],
			'mata_kuliah_ids' => ['required', 'array', 'min:1'],
			'mata_kuliah_ids.*' => [
				'required',
				'distinct',
				'exists:mata_kuliah,id'
			],
		], [
			'mahasiswa_id.required' => 'Mahasiswa wajib dipilih.',
			'mahasiswa_id.exists' => 'Mahasiswa tidak ditemukan.',
			'tahun_akademik.required' => 'Tahun akademik wajib diisi.',
			'tahun_akademik.size' => 'Tahun akademik harus berformat YYYY/YYYY.',
			'semester.required' => 'Semester wajib dipilih.',
			'status.required' => 'Status KRS wajib dipilih.',
			'mata_kuliah_ids.required' => 'Mata kuliah wajib dipilih.',
			'mata_kuliah_ids.min' => 'Pilih minimal satu mata kuliah.',
			'mata_kuliah_ids.*.distinct' => 'Mata kuliah tidak boleh dipilih lebih dari satu kali.',
			'mata_kuliah_ids.*.exists' => 'Mata kuliah yang dipilih tidak ditemukan.',
		]);

		// Menghitung total SKS mata kuliah yang dipilih
		$totalSks = MataKuliah::whereIn(
			'id',
			$validated['mata_kuliah_ids']
		)->sum('sks');

		// Membatasi maksimal 24 SKS
		if ($totalSks > 24) {
			throw \Illuminate\Validation\ValidationException::withMessages([
				'mata_kuliah_ids' => 'Total SKS yang dipilih adalah ' .
					$totalSks . ' SKS. Maksimal pengambilan adalah 24 SKS.'
			]);
		}

		return $validated;
	}
}
