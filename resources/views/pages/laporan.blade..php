@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan</h1>

    <ul class="nav nav-tabs mb-3" id="laporanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pemasukan-tab" data-toggle="tab" href="#pemasukan" role="tab" aria-controls="pemasukan" aria-selected="true">Pemasukan</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pengeluaran-tab" data-toggle="tab" href="#pengeluaran" role="tab" aria-controls="pengeluaran" aria-selected="false">Pengeluaran</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="total-tab" data-toggle="tab" href="#total" role="tab" aria-controls="total" aria-selected="false">Total Dana</a>
        </li>
    </ul>

    <div class="tab-content" id="laporanTabContent">
        <div class="tab-pane fade show active" id="pemasukan" role="tabpanel" aria-labelledby="pemasukan-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No Donatur</th>
                            <th>Tanggal</th>
                            <th>Nama Donatur</th>
                            <th>No Telp</th>
                            <th>Alamat Donatur</th>
                            <th>Nominal</th>
                            <th>Bentuk Dana</th>
                            <th>Pencatat Dana</th>
                            <th>Keterangan</th>
                            <th>Download Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemasukan as $d)
                        <tr>
                            <td>{{ $d['no_donatur'] }}</td>
                            <td>{{ $d['tanggal'] }}</td>
                            <td>{{ $d['nama_donatur'] }}</td>
                            <td>{{ $d['no_telp'] }}</td>
                            <td>{{ $d['alamat_donatur'] }}</td>
                            <td>{{ number_format($d['nominal'],0,',','.') }}</td>
                            <td>{{ $d['bentuk_dana'] }}</td>
                            <td>{{ $d['pencatat_dana'] }}</td>
                            <td>{{ $d['keterangan'] }}</td>
                            <td>
                                @if($d['bukti_bayar'])
                                    <a href="{{ asset('storage/'.$d['bukti_bayar']) }}" target="_blank" class="btn btn-sm btn-success">Download</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2 font-weight-bold">
                    Total Pemasukan: Rp {{ number_format(collect($pemasukan)->sum('nominal'),0,',','.') }}
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pengeluaran" role="tabpanel" aria-labelledby="pengeluaran-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>No Pengeluaran</th>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>No Telp</th>
                            <th>Nominal</th>
                            <th>Bentuk Pengeluaran</th>
                            <th>Keperluan</th>
                            <th>Pencatat Dana</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengeluaran as $p)
                        <tr>
                            <td>{{ $p['no_pengeluaran'] }}</td>
                            <td>{{ $p['tanggal'] }}</td>
                            <td>{{ $p['nama_pemohon'] }}</td>
                            <td>{{ $p['no_telp'] }}</td>
                            <td>{{ number_format($p['nominal'],0,',','.') }}</td>
                            <td>{{ $p['bentuk_pengeluaran'] }}</td>
                            <td>{{ $p['keperluan'] }}</td>
                            <td>{{ $p['pencatat_dana'] }}</td>
                            <td>{{ $p['keterangan'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-2 font-weight-bold">
                    Total Pengeluaran: Rp {{ number_format(collect($pengeluaran)->sum('nominal'),0,',','.') }}
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="total" role="tabpanel" aria-labelledby="total-tab">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Total Pemasukan</th>
                            <th>Total Pengeluaran</th>
                            <th>Total Dana Terkumpul</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Rp {{ number_format(collect($pemasukan)->sum('nominal'),0,',','.') }}</td>
                            <td>Rp {{ number_format(collect($pengeluaran)->sum('nominal'),0,',','.') }}</td>
                            <td>Rp {{ number_format(collect($pemasukan)->sum('nominal') - collect($pengeluaran)->sum('nominal'),0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
