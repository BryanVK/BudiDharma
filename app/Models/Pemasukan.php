<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';
    protected $primaryKey = 'pemasukan_id';
    protected $fillable = [
        'nama_donatur',
        'alamat_donatur',
        'nominal',
        'bukti_bayar',
        'pencatat_dana',
        'tanggal',
        'no_telp',
        'bentuk_dana',
        'keterangan'
    ];
}
