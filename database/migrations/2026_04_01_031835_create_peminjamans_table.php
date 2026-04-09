<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations
     */
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | PRIMARY KEY
            |--------------------------------------------------------------------------
            */

            $table->id('id_peminjaman');


            /*
            |--------------------------------------------------------------------------
            | RELASI
            |--------------------------------------------------------------------------
            */

            $table->unsignedBigInteger('id_anggota');
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->unsignedBigInteger('id_buku');


            /*
            |--------------------------------------------------------------------------
            | TANGGAL PEMINJAMAN
            |--------------------------------------------------------------------------
            */

            $table->date('tanggal_pinjam');
            $table->date('tanggal_jatuh_tempo');
            $table->date('tanggal_kembali')->nullable();


            /*
            |--------------------------------------------------------------------------
            | DENDA
            |--------------------------------------------------------------------------
            */

            $table->integer('denda')->default(0);


            /*
            |--------------------------------------------------------------------------
            | STATUS PEMINJAMAN
            |--------------------------------------------------------------------------
            */

            $table->enum('status', [
                'menunggu',
                'dipinjam',
                'terlambat',
                'dikembalikan',
                'ditolak'
            ])->default('menunggu');


            /*
            |--------------------------------------------------------------------------
            | TIMESTAMP
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | FOREIGN KEY
            |--------------------------------------------------------------------------
            */

            // Anggota
            $table->foreign('id_anggota')
                ->references('id_anggota')
                ->on('anggotas')
                ->cascadeOnDelete();

            // Petugas
            $table->foreign('id_petugas')
                ->references('id_petugas')
                ->on('petugas')
                ->nullOnDelete();

            // Buku
            $table->foreign('id_buku')
                ->references('id_buku')
                ->on('bukus')
                ->cascadeOnDelete();

        });
    }


    /**
     * Reverse the migrations
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};