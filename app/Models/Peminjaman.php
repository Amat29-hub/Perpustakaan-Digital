<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjamans';
    protected $primaryKey = 'id_peminjaman';

    protected $fillable = [
        'id_anggota',
        'id_petugas',
        'id_buku',
        'tanggal_pinjam',
        'tanggal_jatuh_tempo',
        'tanggal_kembali',
        'denda',
        'status'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class,'id_buku');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class,'id_petugas');
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class,'id_peminjaman');
    }
}