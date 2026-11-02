<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : create_mata_kulliah_table.php
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
		Schema::create('mata_kuliah', function (Blueprint $table) {
			$table->id();
			$table->string('kode_mk', 10)->unique();
			$table->string('nama_mk', 100);
			$table->unsignedTinyInteger('sks');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('mata_kuliah');
	}
};
