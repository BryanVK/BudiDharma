<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi; // FPDI import
use setasign\Fpdi\PdfReader;

class PemasukanController extends Controller
{
    public function index()
    {
        $data = Pemasukan::orderBy('pemasukan_id','desc')->get();
        return view('pages.pemasukan', compact('data'));
    }

        public function generateTandaTerimaPdf($id)
    {
        $data = Pemasukan::findOrFail($id);

        $pdf = new Fpdi();

        // load template PDF
        $templatePath = public_path('template/tanda_terima.pdf');
        $pageCount = $pdf->setSourceFile($templatePath);
        $tplIdx = $pdf->importPage(1);

        $pdf->AddPage('L'); // 'L' = Landscape, 'P' = Portrait
        $pdf->useTemplate($tplIdx, 0, 0, 297, 210); // A4

        $pdf->SetFont('Helvetica', '', 21);
        $pdf->SetTextColor(0, 0, 0);
        $pageWidth = 297; // A4 landscape = 297mm x 210mm
        $cellWidth = 285; // coba 250mm (lebih kecil dari 297mm A4 landscape)

        // Nama Donatur, rata tengah
        $pdf->SetY(80); // posisi vertikal
        $pdf->SetX(($pageWidth - $cellWidth) / 2 - 5); // geser 5mm ke kiri
        $pdf->Cell($pageWidth, 10, "Yth, " . $data->nama_donatur, 0, 1, 'C');

        // Nominal, rata tengah
        $pdf->SetY(115);
        $pdf->SetX(($pageWidth - $cellWidth) / 2 - 5); // geser 5mm ke kiri
        $pdf->Cell($pageWidth, 10, "Sejumlah Rp. " . number_format($data->nominal,0,',','.'), 0, 1, 'C');

        return $pdf->Output('I', 'TandaTerima_'.$data->nama_donatur.'.pdf');
    }
    
    public function create()
    {
        return view('pages.pemasukan');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nominal' => 'required',
            'tanggal' => 'required|date',
        ]);

        $file = null;

        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar')->store('bukti_pemasukan', 'public');
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
        if ($request->hasFile('bukti')) {
            $file = time().'_'.$request->bukti_bayar->getClientOriginalName();
            $request->bukti_bayar->storeAs('bukti_pemasukan', $file, 'public');
            $filepath = 'bukti_pemasukan/'.$file;
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
