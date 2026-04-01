<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';
    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'nama',
        'email',
        'password',
        'alamat',
        'no_telp',
        'status_aktif'
    ];

    public function peminjamans()
    {
        return $this->hasMany(Peminjaman::class, 'id_anggota');
    }
}