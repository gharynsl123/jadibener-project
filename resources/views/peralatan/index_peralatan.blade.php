@extends('layouts.main-view')


@section('content')

@if(Auth::user()->level == 'admin')
<div class="d-none d-sm-inline-block">
    <a href="{{route('peralatan.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data</a>
</div>
@endif

<!-- Progress DataTales -->
<div class="card shadow my-4">
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
                        <th>instalasi</th>
                        <th>Durasi Pemakaian</th>
                        <th>Keterangan</th>
                        <th @if (Auth::user()->level == 'pic_rs')class="th-end"@endif>Kondisi Product</th>
                        @if(Auth::user()->level != 'pic_rs')
                        <th class="th-end">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    <!-- Menampilkan data peralatan -->
                    @foreach($peralatan as $peralatans)
                    <tr>
                        <td>{{ $peralatans->instansi->instasi }}</td>
                        <td>{{ $peralatans->kategori->nama_kategori }}</td>
                        <td>{{ $peralatans->merek->nama_merek }}</td>
                        <td>{{ $peralatans->produk->nama_produk}}</td>
                        <!-- menuju ke detail barang menggunakan a herf -->
                        <td><a href="{{ route('peralatan.show', $peralatans->id) }}">{{ $peralatans->serial_number }}</a></td>
                        <td>{{ $peralatans->tahun_pemasangan }}</td>
                        <td>
                            <span id="selisih-tahun-{{ $peralatans->id }}"></span>
                        </td>

                        <td>Null</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                        @if (Auth::user()->level == 'admin')
                        <td>
                            <a href="{{ route('peralatan.edit', $peralatans->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('peralatan.destroy', $peralatans->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</button>
                            </form>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

    function perbaruiSelisihTahunUntukSemuaPeralatan() {
        @foreach($peralatan as $peralatans)
            perbaruiSelisihTahun({{ $peralatans->id }}, {{ $peralatans->tahun_pemasangan }});
        @endforeach
    }

    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan saat halaman dimuat
    document.addEventListener('DOMContentLoaded', perbaruiSelisihTahunUntukSemuaPeralatan);

    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan setiap tahun (menggunakan setInterval)
    setInterval(perbaruiSelisihTahunUntukSemuaPeralatan, 1000 * 60 * 60 * 24 * 365); // Setiap 1 tahun (dalam milidetik)
</script>


@endsection