<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index()
    {
        $pemasukan = Pemasukan::orderBy('tanggal', 'desc')->get();
        $pengeluaran = Pengeluaran::orderBy('tanggal', 'desc')->get();

        return view('pages.laporan', compact('pemasukan', 'pengeluaran'));
    }
}
