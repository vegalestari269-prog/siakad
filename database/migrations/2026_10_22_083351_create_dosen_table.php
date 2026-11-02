<?php

/*
    Nama            : Vega Lestari
    NIM             : 3202416116
    Tanggal Pembuat : 22 Oktober 2026
    Nama File       : create_dosen_table.php
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
    Schema::create('dosen', function (Blueprint $table) {
        $table->id();
        $table->string('nidn', 10)->unique();
        $table->string('nama', 100);
        $table->string('email', 100)->unique();
        $table->string('telepon', 20)->nullable();
        $table->text('alamat')->nullable();
        $table->timestamps();
    });
}

	public function down(): void
	{
    Schema::dropIfExists('dosen');
	}
};
