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
            'nominal' => 'required',
            'tanggal' => 'required|date',
        ]);

        $file = null;

        $file = null;
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar')->store('bukti_pengeluaran', 'public');
        }
        
        $nominal = preg_replace('/[^0-9]/', '', $request->nominal);

        Pengeluaran::create([
            'nama_pemohon' => $request->nama_pemohon,
            'keperluan' => $request->keperluan,
            'nominal' => $nominal,
            'bukti_bayar' => $file, // <--- ganti di sini
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

        $file = $data->bukti_bayar;
        if ($request->hasFile('bukti')) {
            $file = time().'_'.$request->bukti_bayar->getClientOriginalName();
            $request->bukti_bayar->storeAs('bukti_pengeluaran', $file, 'public');
            $filepath = 'bukti_pengeluaran/'.$file;
        }

        $nominal = preg_replace('/[^0-9]/', '', $request->nominal);

        $data->update([
            'nama_pemohon' => $request->nama_pemohon,
            'keperluan' => $request->keperluan,
            'nominal' => $nominal,
            'bukti_bayar' => $file,
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
