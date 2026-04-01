<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'bukus';

    protected $primaryKey = 'id_buku';

    protected $fillable = [
        'kode_buku',
        'judul',
        'kategori',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'cover',
        'status'
    ];
}