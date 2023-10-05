@extends('layouts.main-view')

@section('title', 'Peralatan Rumah Sakit')
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

<div class="d-none d-flex justify-content-end mb-3">
    @if(Auth::user()->level != 'pic')
    <a href="{{route('peralatan.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data</a>
    @endif

    <a href="/peralatan-cetak-pdf" target="_blank" class="mx-2 d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-file fa-sm text-white-50"></i> cetak pdf</a>

    <a data-toggle="modal" data-target="#importAlat" data-target="#importAlat"
        class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-file-import fa-sm text-white-50"></i> Import File alat</a>
</div>

<!-- Logout Modal-->
<div class="modal fade" id="importAlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Alat</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import.peralatan') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <input type="file" required name="file">
                        <button class="btn btn-secondary" type="submit">Import Data</button>
                    </div>
                    <small>format file Xsl, CSV</small>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="card shadow my-4 border-left-primary">
    <div class="p-3">
        <label for="kategori-select col-md-3">Shortby Kateg:</label>
        <select id="kategori-select" class="">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $item)
            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
            @endforeach
        </select>
        @if(Auth::user()->level == 'pic' && (Auth::user()->departement->nama_departement == 'Purchasing' || Auth::user()->departement->nama_departement == 'IPS-RS') || Auth::user()->level == 'admin' ||  Auth::user()->level == 'surveyor')
        <label for="departemen-select col-md-3">Shortby Department:</label>
        <select id="departemen-select" class="">
            <option value="">Semua departement</option>
            @foreach($depart as $item)
            <option value="{{ $item->nama_departement }}">{{ $item->nama_departement }}</option>
            @endforeach
        </select>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Instansi</th>
                        <th>Kategori</th>
                        <th style="display:none;">Departement</th>
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
                        <td style="display:none;">{{ $peralatans->kategori->departement ? $peralatans->kategori->departement->nama_departement : 'Belum ada departement'}}</td>
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

                        <td>{{$peralatans->produk_dalam_kondisi}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-valuenow="{{$peralatans->kondisi_product}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$peralatans->kondisi_product}}%">
                                    {{$peralatans->kondisi_product}}</div>
                            </div>
                        </td>
                        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'teknisi' || Auth::user()->level
                        == 'surveyor')
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
    const kategoriSelect = document.getElementById('kategori-select');
    const departemenSelect = document.getElementById('departemen-select'); // Tambahkan ini
    const rows = document.querySelectorAll('#dataTable tbody tr');

    kategoriSelect.addEventListener('change', function() {
        filterData();
    });

    departemenSelect.addEventListener('change', function() { // Tambahkan ini
        filterData();
    });

    function filterData() {
        const selectedKategoriId = kategoriSelect.value;
        const selectedDepartemen = departemenSelect.value; // Tambahkan ini

        rows.forEach(row => {
            const kategoriCell = row.querySelector('td:nth-child(2)');
            const departemenCell = row.querySelector('td:nth-child(3)'); // Tambahkan ini
            if ((selectedKategoriId === '' || kategoriCell.textContent === selectedKategoriId) &&
                (selectedDepartemen === '' || departemenCell.textContent === selectedDepartemen)) { // Tambahkan ini
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }


    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan saat halaman dimuat
    perbaruiSelisihTahunUntukSemuaPeralatan();

    // Panggil fungsi perbaruiSelisihTahunUntukSemuaPeralatan setiap tahun (menggunakan setInterval)
    setInterval(perbaruiSelisihTahunUntukSemuaPeralatan, 1000 * 60 * 60 * 24 *
    365); // Setiap 1 tahun (dalam milidetik)
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
    perbaruiSelisihTahun({{$peralatans -> id}}, {{$peralatans -> tahun_pemasangan}});
    @endforeach
}
console.log(@json($peralatan));

</script>

@endsection