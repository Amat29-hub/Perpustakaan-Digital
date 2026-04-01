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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id('id_peminjaman');
        
            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('id_buku');
        
            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_kembali')->nullable();
        
            $table->double('denda')->default(0);
            $table->string('status');
        
            $table->timestamps();
        
            $table->foreign('id_anggota')->references('id_anggota')->on('anggotas')->cascadeOnDelete();
            $table->foreign('id_petugas')->references('id_petugas')->on('petugas')->cascadeOnDelete();
            $table->foreign('id_buku')->references('id_buku')->on('bukus')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
