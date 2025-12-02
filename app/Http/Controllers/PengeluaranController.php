<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::orderBy('pengeluaran_id','desc')->get();
        return view('pages.pengeluaran', compact('data'));
    }

    public function create()
    {
        return view('pages.pengeluaran');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'nominal' => 'required|numeric',
            'tanggal' => 'required|date',
        ]);

        $file = null;
        if ($request->hasFile('bukti_pengeluaran')) {
            $file = time().'_'.$request->bukti_pengeluaran->getClientOriginalName();
            $request->bukti_pengeluaran->storeAs('bukti_pengeluaran', $file, 'public');
        }

        Pengeluaran::create([
            'no_pengeluaran' => $request->no_pengeluaran,
            'nama_pemohon' => $request->nama_pemohon,
            'keperluan' => $request->keperluan,
            'nominal' => $request->nominal,
            'bukti_pengeluaran' => $file,
            'pencatat_dana' => $request->pencatat_dana,
            'tanggal' => $request->tanggal,
            'no_telp' => $request->no_telp,
            'bentuk_pengeluaran' => $request->bentuk_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Pengeluaran::findOrFail($id);
        return view('pengeluaran.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pengeluaran::findOrFail($id);

        $file = $data->bukti_pengeluaran;
        if ($request->hasFile('bukti_pengeluaran')) {
            $file = time().'_'.$request->bukti_pengeluaran->getClientOriginalName();
            $request->bukti_pengeluaran->storeAs('bukti_pengeluaran', $file, 'public');
        }

        $data->update([
            'no_pengeluaran' => $request->no_pengeluaran,
            'nama_pemohon' => $request->nama_pemohon,
            'keperluan' => $request->keperluan,
            'nominal' => $request->nominal,
            'bukti_pengeluaran' => $file,
            'pencatat_dana' => $request->pencatat_dana,
            'tanggal' => $request->tanggal,
            'no_telp' => $request->no_telp,
            'bentuk_pengeluaran' => $request->bentuk_pengeluaran,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Pengeluaran::findOrFail($id);
        $data->delete();
        return redirect()->route('pengeluaran.index')->with('success', 'Data berhasil dihapus!');
    }
}
