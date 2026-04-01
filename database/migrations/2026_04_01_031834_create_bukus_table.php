<?php

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
        Schema::create('bukus', function (Blueprint $table) {

            $table->id('id_buku'); // Primary key

            $table->string('kode_buku')->unique(); // Kode buku otomatis

            $table->string('judul');

            $table->string('kategori')->nullable();

            $table->string('penulis');

            $table->string('penerbit');

            $table->year('tahun_terbit');

            $table->integer('stok')->default(0);

            $table->string('cover')->nullable();

            $table->enum('status', ['tersedia', 'tidak_tersedia'])->default('tersedia');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};