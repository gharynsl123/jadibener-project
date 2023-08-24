@extends('layouts.main-view')

@section('content')
<!-- Style Css -->
<style>
    .hide-when-checklist-shown {
        display: block;
    }

    .show-when-checklist-shown {
        display: none;
    }

    .checklist-shown .hide-when-checklist-shown {
        display: none;
    }

    .checklist-shown .show-when-checklist-shown {
        display: block;

    border-top-right-radius: 10px !important;
    border-bottom-right-radius: 10px !important;
    }

    /* Tambahan CSS untuk tampilan Checklist yang normal */
    .checklist-checkbox-label {
        display: flex;
        align-items: center;
    }

    .checklist-checkbox {
        margin-right: 8px;
    }
</style>

<div class="d-none d-flex @if(Auth::user()->level == 'pic') justify-content-end @else justify-content-between @endif mb-3">
    @if(Auth::user()->level != 'pic')
    <a href="{{route('peralatan.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data</a>
    @endif
</div>

<!-- Progress DataTales -->
<div class="card shadow my-4 border-left-primary">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Instansi</th>
                        <th>Kategori</th>
                        <th>Merk</th>
                        <th>Product</th>
                        <th>Serial Number</th>
                        <th>Instalasi</th>
                        <th>Durasi Pemakaian</th>
                        <th>Keterangan</th>
                        <th class="@if (Auth::user()->level == 'pic') th-end @endif">Kondisi Product</th>
                        @if (Auth::user()->level != 'pic')
                        <th class="th-end">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <!-- Menampilkan data peralatan di reverse agar data yang baru di tambah muncul di atas -->
                    @foreach($peralatan->reverse() as $peralatans)
                    <tr>
                        <td>{{ $peralatans->instansi->nama_instansi }}</td>
                        <td>{{ $peralatans->kategori->nama_kategori }}</td>
                        <td>{{ $peralatans->merek->nama_merek }}</td>
                        <td>{{ $peralatans->produk->nama_produk}}</td>
                        <!-- menuju ke detail barang menggunakan a herf -->
                        <td><a
                                href="{{ route('peralatan.show', $peralatans->slug) }}">{{ $peralatans->serial_number }}</a>
                        </td>
                        <td>{{ $peralatans->tahun_pemasangan }}</td>
                        <td>
                            <span id="selisih-tahun-{{ $peralatans->id }}"></span>
                        </td>

                        <td>{{$peralatans->keterangan}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuenow="{{$peralatans->kondisi_product}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$peralatans->kondisi_product}}%">
                                    {{$peralatans->kondisi_product}}</div>
                            </div>
                        </td>
                        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'teknisi')
                        <td class="hide-when-checklist-shown">
                            <a href="{{ route('peralatan.edit', $peralatans->slug) }}" class="btn btn-warning btn-sm"><i
                                    class="fa fa-pen-to-square text-white"></i></a>
                            <form action="{{ route('peralatan.destroy', $peralatans->id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"> <i
                                        class="fa fa-trash text-white"></i></button>
                            </form>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan saat halaman dimuat
    perbaruiSelisihTahunUntukSemuaPeralatan();

    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan setiap tahun (menggunakan setInterval)
    setInterval(perbaruiSelisihTahunUntukSemuaPeralatan, 1000 * 60 * 60 * 24 * 365); // Setiap 1 tahun (dalam milidetik)
});

function hitungSelisihTahun(tahunPemasangan) {
    const tahunSekarang = new Date().getFullYear();
    return tahunSekarang - tahunPemasangan;
}

function perbaruiSelisihTahun(idPeralatan, tahunPemasangan) {
    const selisihTahun = hitungSelisihTahun(tahunPemasangan);
    const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
    elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
}

function perbaruiSelisihTahunUntukSemuaPeralatan() {
    @foreach($peralatan as $peralatans)
    perbaruiSelisihTahun({{ $peralatans->id }}, {{ $peralatans->tahun_pemasangan }});
    @endforeach
}
</script>

@endsection
