<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : create_mahasiswa_table.php
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
		Schema::create('mahasiswa', function (Blueprint $table) {
			$table->id();
			$table->string('nim', 15)->unique();
			$table->string('nama', 100);
			$table->enum('jenis_kelamin', ['L', 'P']);
			$table->string('email', 100)->unique();
			$table->unsignedSmallInteger('angkatan');
			$table->string('program_studi', 100)
				  ->default('D3 Teknik Informatika');
			$table->timestamps();
		});
	}

	public function down(): void
	{
    Schema::dropIfExists('mahasiswa');
	}
};
