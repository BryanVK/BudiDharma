<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $perPage = $request->get('per_page', 5); // jumlah baris per halaman (default 10)
        $activeTab = $request->get('tab', 'pemasukan'); // default = pemasukan


        // ============ PEMASUKAN ============
        $pemasukan = Pemasukan::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('tanggal', 'LIKE', "%$search%")
                      ->orWhere('nama_donatur', 'LIKE', "%$search%")
                      ->orWhere('no_telp', 'LIKE', "%$search%")
                      ->orWhere('alamat_donatur', 'LIKE', "%$search%")
                      ->orWhere('nominal', 'LIKE', "%$search%")
                      ->orWhere('bentuk_dana', 'LIKE', "%$search%")
                      ->orWhere('pencatat_dana', 'LIKE', "%$search%")
                      ->orWhere('keterangan', 'LIKE', "%$search%");
                });
            })
            ->orderBy('tanggal', 'desc')
            ->paginate($perPage, ['*'], 'pemasukan_page');

        // ============ PENGELUARAN ============
        $pengeluaran = Pengeluaran::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($s) use ($search) {
                    $s->where('tanggal', 'LIKE', "%$search%")
                      ->orWhere('nama_pemohon', 'LIKE', "%$search%")
                      ->orWhere('no_telp', 'LIKE', "%$search%")
                      ->orWhere('nominal', 'LIKE', "%$search%")
                      ->orWhere('bentuk_pengeluaran', 'LIKE', "%$search%")
                      ->orWhere('keperluan', 'LIKE', "%$search%")
                      ->orWhere('pencatat_dana', 'LIKE', "%$search%")
                      ->orWhere('keterangan', 'LIKE', "%$search%");
                });
            })
            ->orderBy('tanggal', 'desc')
            ->paginate($perPage, ['*'], 'pengeluaran_page');

        return view('pages.laporan', compact('pemasukan', 'pengeluaran', 'search', 'perPage', 'activeTab'));
    }
}
