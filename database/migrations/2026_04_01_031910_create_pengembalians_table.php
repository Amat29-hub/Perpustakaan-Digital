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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id('id_pengembalian');
        
            $table->unsignedBigInteger('id_petugas');
            $table->unsignedBigInteger('id_peminjaman');
        
            $table->date('tanggal_kembali');
            $table->integer('jumlah_denda')->default(0);
            $table->boolean('status_aktif')->default(true);
        
            $table->timestamps();
        
            $table->foreign('id_petugas')
                  ->references('id_petugas')
                  ->on('petugas')
                  ->cascadeOnDelete();
        
            $table->foreign('id_peminjaman')
                  ->references('id_peminjaman')
                  ->on('peminjamans')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
