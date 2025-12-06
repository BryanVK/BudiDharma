@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengeluaran</h1>
    </div>

    <form action="{{ route('pengeluaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_pemohon">Nama Pemohon</label>
                    <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" placeholder="Masukkan Nama Pemohon" required>
                </div>
                <div class="form-group">
                    <label for="keperluan">Keperluan Pengeluaran</label>
                    <textarea class="form-control" id="keperluan" name="keperluan" rows="3" placeholder="Masukkan Keperluan" required></textarea>
                </div>
                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal" required>
                </div>

                <div class="form-group">
                    <label for="bukti_bayar">Upload Bukti Pengeluaran</label>
                    <input type="file" name="bukti_bayar" class="form-control" required>
                </div>

                <!-- Button Simpan -->
                <button type="submit" class="btn btn-danger mt-3">Simpan</button>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pencatat_dana">Pencatat Dana</label>
                    <input type="text" class="form-control" id="pencatat_dana" name="pencatat_dana" 
                        value="{{ Auth::user()->name }}" required> 
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                </div>

                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" required>
                </div>

                <div class="form-group">
                    <label for="bentuk_pengeluaran">Bentuk Dana</label>
                    <select class="form-control" id="bentuk_pengeluaran" name="bentuk_pengeluaran" required>
                        <option value="">Pilih Bentuk Dana</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
                </div>
            </div>
        </div>
    </form>

</div>

<script>
    const nominalInput = document.getElementById('nominal');

    // Auto format saat mengetik
    nominalInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\D/g, ''); // hapus semua non-digit
        if(value) {
            this.value = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
        } else {
            this.value = '';
        }
    });

    // Strip "Rp" dan titik saat submit agar backend dapat angka murni
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        nominalInput.value = nominalInput.value.replace(/[^0-9]/g,''); 
    });
</script>

@endsection
