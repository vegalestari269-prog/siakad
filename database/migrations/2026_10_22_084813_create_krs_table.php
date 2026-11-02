<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : create_krs_table.php
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
	{
		Schema::create('krs', function (Blueprint $table) {
			$table->id();

			$table->foreignId('mahasiswa_id')
				  ->constrained('mahasiswa')
				  ->cascadeOnDelete();

			$table->string('tahun_akademik', 9);
			$table->enum('semester', ['Ganjil', 'Genap']);
			$table->enum('status', [
				'draft', 'diajukan', 'disetujui', 'ditolak'
			])->default('draft');

			$table->timestamps();

			$table->unique([
				'mahasiswa_id',
				'tahun_akademik',
				'semester'
			]);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('krs');
	}
};
