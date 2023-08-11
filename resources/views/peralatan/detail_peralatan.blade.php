@extends('layouts.main-view')

@section('content')
<style>
.square {
    width: 350px;
    height: 300px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<!-- Tombol-tombol di atas card -->
<a href="{{ route('peralatan.index') }}" class="btn mb-4 btn-primary">Kembali</a>

<div class="row">

    <!-- Gambar Produk -->
    <div class="col-md-3">
        <!-- photo produk yang di klik sesuai dengan tada yang di ambil dari table produk -->
        <div class="text-center d-flex justify-content-center flex-column">
            <div class="img-thumbnail card square" id="imagePreview" style="background-image: url('{{ asset('storage/images/' . $peralatan->produk->photo) }}');"></div>
            <a href="{{route('pengajuan.create', $peralatan->id)}}" type="button" class="my-3 btn btn-success">Ajukan Survey / Perbaikan</a>
        </div>
    </div>

    <!-- Keterangan Produk -->
    <div class="col-md-9">
        <div class="card shadow mb-3">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT</p>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-borderless">
                    <tr>
                        <th>Instansi</th>
                        <td>:</td>
                        <td>{{ $peralatan->instansi->instasi }}</td>
                        <th>Nama Product</th>
                        <td>:</td>
                        <td>{{$peralatan->produk->nama_produk}}</td>
                    </tr>
                    <tr>
                        <th>Serial Number</th>
                        <td>:</td>
                        <td>{{ $peralatan->serial_number }}</td>
                        <th>Kode Product</th>
                        <td>:</td>
                        <td>{{ $peralatan->produk->kode_produk }}</td>
                    </tr>

                    <tr>
                        <th>Merek</th>
                        <td>:</td>
                        <td>{{ $peralatan->merek->nama_merek }}</td>
                        <th>Instalasi</th>
                        <td>:</td>
                        <td>{{ $peralatan->tahun_pemasangan }}</td>
                    </tr>
                    <tr>
                        <th>Durasi Pemakaian</th>
                        <td>:</td>
                        <td>
                            <span id="selisih-tahun-{{ $peralatan->id }}"></span>
                        </td>
                        <th>Status Alat</th>
                        <td>:</td>
                        <td>{{$peralatan->keterangan}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">KONDISI PRODUK</p>
            </div>
            <div class="card-body">
                <table class="table table-responsive table-borderless">
                    <tr>
                        <th>KONDISI</th>
                        <td>:</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuenow="{{$peralatan->kondisi_product}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$peralatan->kondisi_product}}%">
                                    {{$peralatan->kondisi_product}}</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Request tahun pergantian</th>
                        <td>:</td>
                        <td>{{$peralatan->nilai_tahun}}</td>
                    </tr>
                    <tr>
                        <th>Penurunan nilai barang</th>
                        <td>:</td>
                        <td>
                            <div class="progress">
                            <div  id="progress-bar-{{$peralatan->id}}" class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{$peralatan->kondisi_product}}%">
                                </div>
                            </div>
                        </td>
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
            <button type="button" class="btn btn-info">Input Estimasi Biaya</button>
            <button type="button" class="btn btn-warning">Atur Jadwal Teknisi</button>
            <button type="button" class="btn btn-danger">Input Hasil Kunjungan Teknisi</button>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Panggil fungsi perbaruiSelisihTahun saat halaman dimuat
    perbaruiSelisihTahun();

    // Panggil fungsi perbaruiSelisihTahun setiap tahun (menggunakan setInterval)
    setInterval(perbaruiSelisihTahun, 1000 * 60 * 60 * 24 * 365); // Setiap 1 tahun (dalam milidetik)
});

function hitungSelisihTahun(tahunPemasangan) {
    const tahunSekarang = new Date().getFullYear();
    return tahunSekarang - tahunPemasangan;
}

function perbaruiSelisihTahun() {
    const idPeralatan = {{ $peralatan->id }};
    const tahunPemasangan = {{ $peralatan->tahun_pemasangan }};
    const nilaiTahun = {{ $peralatan->nilai_tahun }};

    // Hitung selisih tahun dan kondisi berdasarkan nilai tahun dan durasi
    const selisihTahun = hitungSelisihTahun(tahunPemasangan);
    const kondisiPengurangan = Math.max(0, 100 - (selisihTahun * (100 / nilaiTahun)));

    // Perbarui progress bar dan teks kondisi
    const progressBar = document.getElementById(`progress-bar-${idPeralatan}`);
    progressBar.style.width = `${kondisiPengurangan}%`;
    progressBar.setAttribute('aria-valuenow', kondisiPengurangan);
    progressBar.innerText = `${kondisiPengurangan.toFixed(2)}%`;

    // Perbarui selisih tahun pada tampilan
    const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
    elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
}
</script>

@endsection