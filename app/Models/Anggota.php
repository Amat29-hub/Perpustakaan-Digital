<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggotas';

    protected $primaryKey = 'id_anggota';

    protected $fillable = [
        'user_id',
        'kode_anggota',
        'nama',
        'email',
        'password',
        'kelas',
        'jenis_kelamin',
        'alamat',
        'no_telp',
        'foto',
        'status'
    ];
}