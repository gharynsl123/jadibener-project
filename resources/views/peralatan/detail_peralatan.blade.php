@extends('layouts.main-view')

@section('title',"Detail {$peralatan->serial_number}")
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

<div class="mb-4">
<a href="{{ route('peralatan.index') }}" class="btn  btn-primary">Kembali</a>

<a href="{{route('alat.cetak_pdf', $peralatan->slug)}}" target="_blank" class="btn my-2 btn-secondary">Cetak PDF</a>
<a href="{{route('pengajuan.create', $peralatan->slug)}}" type="button" class="my-1 btn btn-success">Ajukan Survey / Perbaikan</a>

@if(Auth::user()->level != 'pic')
<a href="{{route('part.create', $peralatan->slug)}}" class="btn my-2 btn-info">Input Estimasi Biaya</a>
@if(Auth::user()->level == 'surveyor' || Auth::user()->level == 'admin')
<a href="{{route('jadwal.create', $peralatan->slug)}}" class="btn my-2 btn-warning">Atur Jadwal Teknisi</a>
@endif
<a href="{{route('survey.create', $peralatan->id)}}" class="btn my-1 btn-danger">Input Hasil Kunjungan Teknisi</a>
@endif

</div>

<div class="row">
    <div class="col-md-3 ">
        <div class="text-center mb-3 d-flex justify-content-centera">
            <div class="img-thumbnail card square" id="imagePreview" style="background-image: url('{{ asset('storage/produk/' . $peralatan->produk->photo_produk) }}');"></div>
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
                        <td>{{ $peralatan->instansi->nama_instansi }}</td>
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
                        <td>{{$peralatan->produk_dalam_kondisi}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card shado mt-2">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">KONDISI PRODUK</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table  table-borderless">
                        <tr>
                            <th>KONDISI</th>
                            <td>:</td>
                            <td>
                                <div class="progress vw-90">
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
                            <td>{{$peralatan->usia_barang}} tahun</td>
                        </tr>
                        <tr>
                            <th>Penurunan nilai barang</th>
                            <td>:</td>
                            <td>
                                <div class="progress">
                                <div  id="progress-bar-{{$peralatan->id}}" class="progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: {{round($peralatan->kondisi_product)}}%">
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>TANGGAL pendataan</th>
                            <td>:</td>
                            @if($peralatan->update_at != null)
                            <td>{{ $peralatan->update_at->format('Y-m-d') }}</td>
                            @else
                            <td>{{ $peralatan->created_at->format('Y-m-d') }}</td>
                            @endif
                        </tr>
                        <tr>
                            <th>SURVEYOR</th>
                            <td>:</td>
                            <td>{{$peralatan->user->nama_user}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card shado mt-2">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">Saran perawatan dan perbaikan</p>
            </div>
            <div class="card-body">
                <p>{{ $peralatan->saran_perbaikan ?? 'belum ada saran' }}</p>
            </div>
        </div>
    </div>
   
</div>

<!-- history table -->
<div class="card shadow mt-3">
    <div class="card-header bg-info">
        <p class="m-0 text-white font-weight-bolder">Riwayat Peralatan</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="historyTable" class="table table-borderless">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>STATUS</th>
                        <th>deskripsi</th>
                        <th>tanggal</th>
                        <th>id tiket</th>
                        <th>keluhan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $items)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$items->status_history}}</td>
                        <td>{{$items->deskripsi}}</td>
                        <td>{{$items->tanggal}}</td>
                        @if($items->pengajuan)
                        <td>
                            <a href="/pengajuan/{{$items->pengajuan->slug}}" class="btn btn-primary">{{$items->pengajuan->id_pengenal}}</a>
                        </td>
                        <td>{{$items->pengajuan->judul_masalah}}</td>
                        {{$items->estimasibiaya}}
                        @elseif($items->estimasibiaya)
                        <td>
                            <!-- Tambahkan tombol aksi sesuai kebutuhan -->
                            <a href="{{route('estimasi.cetak_pdf', $items->estimasibiaya->id)}}" target="_blank" class="btn btn-sm btn-primary"><i class="fa fa-file"></i></a>
                        </td>
                        <td>-</td>
                        @else
                        <td>-</td>
                        <td>-</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="pagination" class="mt-3">
                <ul id="pagination-list" class="pagination"></ul>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const table = document.getElementById("historyTable");
    const itemsPerPage = 5; // Number of items to display per page
    let currentPage = 1; // Current page
    let totalItems = table.tBodies[0].rows.length;
    const totalPages = Math.ceil(totalItems / itemsPerPage);

    function displayPage(page) {
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;

        for (let i = 0; i < totalItems; i++) {
            if (i >= start && i < end) {
                table.tBodies[0].rows[i].style.display = "";
            } else {
                table.tBodies[0].rows[i].style.display = "none";
            }
        }
    }

    function updatePagination() {
        $('#pagination-list').twbsPagination({
            totalPages: totalPages,
            visiblePages: 5,
            onPageClick: function(event, page) {
                currentPage = page;
                displayPage(currentPage);
            }
        });
    }

    displayPage(currentPage);
    updatePagination();


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
    const idPeralatan = '{{ $peralatan->id }}';
    const tahunPemasangan = '{{ $peralatan->tahun_pemasangan }}';
    const nilaiTahun = '{{ $peralatan->usia_barang }}';

    // Hitung selisih tahun dan kondisi berdasarkan nilai tahun dan durasi
    const selisihTahun = isNaN(hitungSelisihTahun(tahunPemasangan)) ? 0 : hitungSelisihTahun(tahunPemasangan);
    const kondisiPengurangan = Math.max(0, 100 - (selisihTahun * (100 / nilaiTahun)));

    // Perbarui progress bar dan teks kondisi
    const progressBar = document.getElementById(`progress-bar-${idPeralatan}`);
    progressBar.style.width = `${kondisiPengurangan}%`;
    progressBar.setAttribute('aria-valuenow', kondisiPengurangan);
    progressBar.innerText = `${kondisiPengurangan.toFixed(2)}%`;

    // Perbarui selisih tahun pada tampilan
    const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
    // jika hasilnya 0 maka munculkan angka 0 
    elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
}

</script>
@endsection