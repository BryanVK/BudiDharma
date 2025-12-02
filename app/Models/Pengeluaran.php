<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran';

    protected $primaryKey = 'pengeluaran_id';

    protected $fillable = [
        'no_pengeluaran',
        'nama_pemohon',
        'keperluan',
        'nominal',
        'bukti_pengeluaran',
        'pencatat_dana',
        'tanggal',
        'no_telp',
        'bentuk_pengeluaran',
        'keterangan',
    ];
}
