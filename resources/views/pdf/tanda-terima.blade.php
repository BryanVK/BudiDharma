<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tanda Terima</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("{{ public_path('images/template-tanda-terima.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100%;
        }

        .content {
            position: absolute;
            top: 150px; /* sesuaikan posisi */
            left: 100px; /* sesuaikan posisi */
            width: 500px;
        }

        .content p {
            font-size: 18px;
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="content">
        <p>Nama Donatur: {{ $data->nama_donatur }}</p>
        <p>Alamat Donatur: {{ $data->alamat_donatur }}</p>
        <p>No Telp: {{ $data->no_telp }}</p>
        <p>Nominal: Rp {{ number_format($data->nominal, 0, ',', '.') }}</p>
        <p>Tanggal: {{ $data->tanggal }}</p>
        <p>Pencatat Dana: {{ $data->pencatat_dana }}</p>
        <p>Keterangan: {{ $data->keterangan }}</p>
    </div>
</body>
</html>
