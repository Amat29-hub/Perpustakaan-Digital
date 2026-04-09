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
        Schema::create('anggotas', function (Blueprint $table) {

            $table->id('id_anggota');

            // relasi ke tabel users
            $table->unsignedBigInteger('user_id')->unique();

            // kode anggota otomatis
            $table->string('kode_anggota')->unique();

            // data utama
            $table->string('nama');
            $table->string('email')->nullable()->unique();
            $table->string('password');

            // tambahan
            $table->string('kelas')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();

            // kontak
            $table->text('alamat')->nullable();
            $table->string('no_telp')->nullable();

            // foto
            $table->string('foto')->nullable();

            // status
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();

            // foreign key
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggotas');
    }
};