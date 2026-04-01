<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaPerpustakaan extends Model
{
    protected $table = 'kepala_perpustakaans';
    protected $primaryKey = 'id_kepala';

    protected $fillable = [
        'nama',
        'email',
        'password'
    ];
}