@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pemasukan</h1>
    </div>

    <form action="{{ route('pemasukan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <!-- Kiri -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nama_donatur">Nama Donatur</label>
                    <input type="text" class="form-control" id="nama_donatur" name="nama_donatur" placeholder="Masukkan Nama Donatur">
                </div>
                <div class="form-group">
                    <label for="alamat_donatur">Alamat Donatur</label>
                    <textarea class="form-control" id="alamat_donatur" name="alamat_donatur" rows="3" placeholder="Masukkan Alamat"></textarea>
                </div>
                <div class="form-group">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukkan Nominal">
                </div>

                <script>
                    const nominalInput = document.getElementById('nominal');

                    nominalInput.addEventListener('input', function(e) {
                        let value = this.value.replace(/\D/g, ''); // hilangkan semua selain angka
                        if(value) {
                            value = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(value);
                            this.value = value;
                        } else {
                            this.value = '';
                        }
                    });
                </script>

                <div class="form-group">
                    <label for="bukti_bayar">Upload Bukti Bayar</label>
                    <input type="file" class="form-control-file" id="bukti_bayar" name="bukti_bayar">
                </div>
                <!-- Button Simpan -->
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            </div>

            <!-- Kanan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pencatat_dana">Pencatat Dana</label>
                    <input type="text" class="form-control" id="pencatat_dana" name="pencatat_dana" placeholder="Masukkan Pencatat Dana">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                </div>
                <div class="form-group">
                    <label for="no_telp">No Telp</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp" placeholder="Masukkan No Telp">
                </div>
                <div class="form-group">
                    <label for="bentuk_dana">Bentuk Dana</label>
                    <select class="form-control" id="bentuk_dana" name="bentuk_dana">
                        <option value="">Pilih Bentuk Dana</option>
                        <option value="tunai">Tunai</option>
                        <option value="transfer">Transfer</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan Keterangan"></textarea>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection
