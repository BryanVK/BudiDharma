@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Laporan</h1>

    {{-- Search Filter --}}
    <form method="GET" action="{{ url('/laporan') }}" class="mb-3">
    <div class="d-flex gap-2">

        {{-- Search --}}
        <input type="text" name="search" class="form-control"
               placeholder="Cari data..." value="{{ request('search') }}"
               style="max-width: 250px;">


        <button class="btn btn-primary">Search</button>

    </div>
    </form>

        <ul class="nav nav-tabs mb-3" id="laporanTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activeTab == 'pemasukan' ? 'active' : '' }}" 
            id="pemasukan-tab" data-bs-toggle="tab" data-bs-target="#pemasukan" role="tab">
            Pemasukan
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activeTab == 'pengeluaran' ? 'active' : '' }}" 
            id="pengeluaran-tab" data-bs-toggle="tab" data-bs-target="#pengeluaran" role="tab">
            Pengeluaran
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link {{ $activeTab == 'total' ? 'active' : '' }}" 
            id="total-tab" data-bs-toggle="tab" data-bs-target="#total" role="tab">
            Total
            </a>
        </li>
    </ul>


    <div class="tab-content">

        {{-- =================== PEMASUKAN =================== --}}
        <div class="tab-pane fade {{ $activeTab == 'pemasukan' ? 'show active' : '' }}" id="pemasukan" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Donatur</th>
                            <th>No Telp</th>
                            <th>Alamat Donatur</th>
                            <th>Nominal</th>
                            <th>Bentuk Dana</th>
                            <th>Pencatat Dana</th>
                            <th>Keterangan</th>
                            <th>Download Bukti</th>
                            <th>Download Tanda Terima</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemasukan as $p)
                            <tr>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->nama_donatur }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ $p->alamat_donatur }}</td>
                                <td>{{ number_format($p->nominal,0,',','.') }}</td>
                                <td>{{ $p->bentuk_dana }}</td>
                                <td>{{ $p->pencatat_dana }}</td>
                                <td>{{ $p->keterangan }}</td>
                                <td>
                                    @if($p->bukti_bayar)
                                        <a href="{{ asset('storage/'.$p->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-success">Lihat Bukti</a>
                                    @endif
                                </td>
                                <td>
                                    @if($p->pemasukan_id)
                                        <a href="{{ route('pemasukan.tandaTerimaPdf', $p->pemasukan_id) }}" target="_blank" class="btn btn-sm btn-warning">Download PDF</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Pemasukan --}}
                {{ $pemasukan->appends(request()->query())->appends(['tab' => 'pemasukan'])->links('pagination::bootstrap-5') }}

                <div class="mt-2 font-weight-bold">
                    Total Pemasukan: Rp {{ number_format($pemasukan->sum('nominal'),0,',','.') }}
                </div>
            </div>
        </div>

        {{-- =================== PENGELUARAN =================== --}}
        <div class="tab-pane fade {{ $activeTab == 'pengeluaran' ? 'show active' : '' }}" id="pengeluaran" role="tabpanel">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama Pemohon</th>
                            <th>No Telp</th>
                            <th>Nominal</th>
                            <th>Bentuk Pengeluaran</th>
                            <th>Keperluan</th>
                            <th>Pencatat Dana</th>
                            <th>Keterangan</th>
                            <th>Download Bukti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengeluaran as $p)
                            <tr>
                                <td>{{ $p->tanggal }}</td>
                                <td>{{ $p->nama_pemohon }}</td>
                                <td>{{ $p->no_telp }}</td>
                                <td>{{ number_format($p->nominal,0,',','.') }}</td>
                                <td>{{ $p->bentuk_pengeluaran }}</td>
                                <td>{{ $p->keperluan }}</td>
                                <td>{{ $p->pencatat_dana }}</td>
                                <td>{{ $p->keterangan }}</td>
                                <td>
                                    @if($p->bukti_bayar)
                                        <a href="{{ asset('storage/'.$p->bukti_bayar) }}" target="_blank" class="btn btn-sm btn-success">Lihat Bukti</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Pagination Pengeluaran --}}
                {{ $pengeluaran->appends(request()->query())->appends(['tab' => 'pengeluaran'])->links('pagination::bootstrap-5') }}

                <div class="mt-2 font-weight-bold">
                    Total Pengeluaran: Rp {{ number_format($pengeluaran->sum('nominal'),0,',','.') }}
                </div>
            </div>
        </div>

        {{-- =================== TOTAL =================== --}}
        <div class="tab-pane fade {{ $activeTab == 'total' ? 'show active' : '' }}" id="total" role="tabpanel">
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
                            <td>Rp {{ number_format($pemasukan->sum('nominal'),0,',','.') }}</td>
                            <td>Rp {{ number_format($pengeluaran->sum('nominal'),0,',','.') }}</td>
                            <td>Rp {{ number_format($pemasukan->sum('nominal') - $pengeluaran->sum('nominal'),0,',','.') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
