<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Pengajuan</title>
</head>
<body>
    <h2>Pengajuan Baru</h2>
    <p>Pengajuan baru telah diterima:</p>
    
    <h3>Informasi Barang:</h3>
    <ul>
        <li>Nama Barang: {{ $dataPengajuan->peralatan->nama_barang }}</li>
        <li>Serial Number: {{ $dataPengajuan->peralatan->serial_number }}</li>
        <li>Kategori: {{ $dataPengajuan->peralatan->kategori->nama_kategori }}</li>
        <!-- Tambahkan informasi barang lainnya sesuai kebutuhan -->
    </ul>

    <h3>Informasi Pengaju:</h3>
    <ul>
        <li>Nama Pengaju: {{ $dataPengajuan->user->nama_user }}</li>
        <li>Email Pengaju: {{ $dataPengajuan->user->email }}</li>
        <!-- Tambahkan informasi pengaju lainnya sesuai kebutuhan -->
    </ul>

    <p>Segera tinjau pengajuan ini.</p>

    <p>Terima kasih,</p>
    <p>Tim Administrasi</p>
</body>
</html>
