<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('petugas', function (Blueprint $table) {

            $table->id('id_petugas');

            // relasi ke users
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('kode_petugas')->unique();
            $table->string('nama');
            $table->string('jabatan')->nullable();

            $table->string('email')->unique();
            $table->string('password');

            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable();
            $table->string('no_telp')->nullable();
            $table->text('alamat')->nullable();

            $table->string('foto')->nullable();

            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('petugas');
    }
};