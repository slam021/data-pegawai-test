<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama_lengkap',
        'nama_panggilan',
        'jabatan',
        'tanggal_lahir',
        'kelamin',
        'alamat',
    ];
}
