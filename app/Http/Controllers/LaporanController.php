<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class LaporanController extends Controller
{
    public function index() {
        $pemasukan = Pemasukan::all();
        $pengeluaran = Pengeluaran::all();

        return view('laporan.index', compact('pemasukan', 'pengeluaran'));
    }
}
