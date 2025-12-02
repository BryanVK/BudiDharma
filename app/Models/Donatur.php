<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_donatur',
        'nama_donatur',
        'alamat_donatur',
        'nominal',
        'bukti_bayar',
        'pencatat_dana',
        'tanggal',
        'no_telp',
        'bentuk_dana',
        'keterangan',
    ];
}
