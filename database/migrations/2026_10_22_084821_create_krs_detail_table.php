<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : create_krs_deatil_table.php
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
		Schema::create('krs_detail', function (Blueprint $table) {
			$table->id();

			$table->foreignId('krs_id')
				  ->constrained('krs')
				  ->cascadeOnDelete();

			$table->foreignId('mata_kuliah_id')
				  ->constrained('mata_kuliah')
				  ->restrictOnDelete();

			$table->timestamps();

			$table->unique(['krs_id', 'mata_kuliah_id']);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('krs_detail');
	}
};
