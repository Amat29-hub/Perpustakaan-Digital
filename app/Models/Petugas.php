<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'user_id',
        'kode_petugas',
        'nama',
        'jabatan',
        'email',
        'password',
        'jenis_kelamin',
        'no_telp',
        'alamat',
        'foto',
        'status'
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_petugas');
    }

    public function pengembalians()
    {
        return $this->hasMany(Pengembalian::class, 'id_petugas');
    }
}