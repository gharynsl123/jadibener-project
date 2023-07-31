@extends('layouts.main-view')

@section('content')

<div class="row">
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT</p>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-borderless">
                    <tr>
                        <th>Instansi</th>
                        <td>:</td>
                        <td>{{ $peralatan->instansi->instasi }}</td>
                    </tr>
                    <!-- Tambahkan detail lainnya sesuai dengan properti yang ada di objek $peralatan -->
                    <tr>
                        <th>Nama Product</th>
                        <td>:</td>
                        <td>{{$peralatan->produk->nama_produk}}</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td>:</td>
                        <td>{{ $peralatan->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Merk</th>
                        <td>:</td>
                        <td>{{ $peralatan->merek->nama_merek }}</td>
                    </tr>

                    <tr>
                        <th>Serial Number</th>
                        <td>:</td>
                        <td>{{ $peralatan->serial_number }}</td>
                    </tr>
                    <tr>
                        <th>Tahun Pemasangan</th>
                        <td>:</td>
                        <td>{{ $peralatan->tahun_pemasangan }}</td>
                    </tr>
                    <tr>
                        <th>Durasi Pemakaian</th>
                        <td>:</td>
                        <td><span id="selisih-tahun-{{ $peralatan->id }}"></span></td>
                    </tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>:</td>
                        <td>Null</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">KONDISI PRODUK</p>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-borderless">
                    <tr>
                        <th>KONDISI</th>
                        <td>:</td>
                        <td>70%</td>
                    </tr>
                    <tr>
                        <th>70 % (Percent)</th>
                        <td>:</td>
                        <td>BERJALAN BAIK</td>
                    </tr>
                    <tr>
                        <th>SARAN</th>
                        <td>:</td>
                        <td>RUTIN PEMBERSIHAN</td>
                    </tr>
                    <tr>
                        <th>TAHUN PEMASANGAN</th>
                        <td>:</td>
                        <td>{{ $peralatan->tahun_pemasangan }}</td>
                    </tr>
                    <tr>
                        <th>TANGGAL KUNJUNGAN</th>
                        <td>:</td>
                        <td>2023-03-06</td>
                    </tr>
                    <tr>
                        <th>SURVEYOR</th>
                        <td>:</td>
                        <td>IRWAN</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Tombol-tombol di bawah card -->
<div class="row mt-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-between">
            @if(Auth::user()->level == 'admin')
            <button type="button" class="btn btn-primary">Input / Edit Status Peralatan</button>
            <button type="button" class="btn btn-success">Ajukan Survey / Perbaikan</button>
            <button type="button" class="btn btn-info">Input Estimasi Biaya</button>
            <button type="button" class="btn btn-warning">Atur Jadwal Teknisi</button>
            <button type="button" class="btn btn-danger">Input Hasil Kunjungan Teknisi</button>
            @elseif(Auth::user()->level == 'pic_rs')
            <button type="button" class="btn btn-success">Ajukan Survey / Perbaikan</button>
            @endif
        </div>
    </div>
</div>

<script>
function hitungSelisihTahun(tahunPemasangan) {
    const tahunSekarang = new Date().getFullYear();
    return tahunSekarang - tahunPemasangan;
}

function perbaruiSelisihTahun(idPeralatan, tahunPemasangan) {
    const selisihTahun = hitungSelisihTahun(tahunPemasangan);
    const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
    elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
}

// Panggil fungsi perbaruiSelisihTahun saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    perbaruiSelisihTahun({
        {
            $peralatan - > id
        }
    }, {
        {
            $peralatan - > tahun_pemasangan
        }
    });
});

// Panggil fungsi perbaruiSelisihTahun setiap tahun (menggunakan setInterval)
setInterval(function() {
    perbaruiSelisihTahun({
        {
            $peralatan - > id
        }
    }, {
        {
            $peralatan - > tahun_pemasangan
        }
    });
}, 1000 * 60 * 60 * 24 * 365); // Setiap 1 tahun (dalam milidetik)
</script>
@endsection