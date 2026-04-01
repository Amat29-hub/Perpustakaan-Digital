<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalians';
    protected $primaryKey = 'id_pengembalian';

    protected $fillable = [
        'id_petugas',
        'id_peminjaman',
        'tanggal_kembali',
        'jumlah_denda',
        'status_aktif'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class,'id_peminjaman');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class,'id_petugas');
    }
}