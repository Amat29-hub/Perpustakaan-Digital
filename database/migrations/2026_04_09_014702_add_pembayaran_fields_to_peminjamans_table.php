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
        Schema::table('peminjamans', function (Blueprint $table) {

            // status pembayaran
            $table->enum('status_bayar', ['belum','sudah'])
                  ->default('belum')
                  ->after('denda');

            // metode pembayaran
            $table->string('metode_bayar')
                  ->nullable()
                  ->after('status_bayar');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamans', function (Blueprint $table) {

            $table->dropColumn('status_bayar');
            $table->dropColumn('metode_bayar');

        });
    }
};