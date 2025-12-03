<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index()
    {
        $data = Pemasukan::orderBy('pemasukan_id','desc')->get();
        return view('pages.pemasukan', compact('data'));
    }


    public function create()
    {
        return view('pages.pemasukan');
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            'nominal' => 'required',
            'tanggal' => 'required|date',
        ]);

        $file = null;
        if ($request->hasFile('bukti_bayar')) {
            $file = time().'_'.$request->bukti_bayar->getClientOriginalName();
            $request->bukti_bayar->storeAs('bukti_pemasukan', $file, 'public');
        }
        $nominal = preg_replace('/[^0-9]/', '', $request->nominal);
        Pemasukan::create([
            'nama_donatur' => $request->nama_donatur,
            'alamat_donatur' => $request->alamat_donatur,
            'nominal' => $nominal,
            'bukti_bayar' => $file,
            'pencatat_dana' => $request->pencatat_dana,
            'tanggal' => $request->tanggal,
            'no_telp' => $request->no_telp,
            'bentuk_dana' => $request->bentuk_dana,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('pemasukan.index')->with('success', 'Data berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Pemasukan::findOrFail($id);
        return view('pemasukan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Pemasukan::findOrFail($id);

        $file = $data->bukti_bayar;
        if ($request->hasFile('bukti_bayar')) {
            $file = time().'_'.$request->bukti_bayar->getClientOriginalName();
            $request->bukti_bayar->storeAs('bukti_pemasukan', $file, 'public');
        }

        $nominal = preg_replace('/[^0-9]/', '', $request->nominal);

    $data->update([
        'nama_donatur' => $request->nama_donatur,
        'alamat_donatur' => $request->alamat_donatur,
        'nominal' => $nominal,
        'bukti_bayar' => $file,
        'pencatat_dana' => $request->pencatat_dana,
        'tanggal' => $request->tanggal,
        'no_telp' => $request->no_telp,
        'bentuk_dana' => $request->bentuk_dana,
        'keterangan' => $request->keterangan,
    ]);


        return redirect()->route('pemasukan.index')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = Pemasukan::findOrFail($id);
        $data->delete();
        return redirect()->route('pemasukan.index')->with('success', 'Data berhasil dihapus!');
    }
}
