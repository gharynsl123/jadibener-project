@extends('layouts.main-view')

@section('title', 'Peralatan Rumah Sakit')
@section('content')
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

    .checklist-checkbox-label {
        display: flex;
        align-items: center;
    }

    .checklist-checkbox {
        margin-right: 8px;
    }
</style>

<div class="d-flex justify-content-end mb-3">
    @if(Auth::user()->level != 'pic')
    <a href="{{route('peralatan.create')}}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data</a>
    @endif
    <a href="/peralatan-cetak-pdf" target="_blank" class="mx-2 btn btn-primary shadow-sm">
        <i class="fas fa-file fa-sm text-white-50"></i> cetak pdf</a>
    <a data-toggle="modal" data-target="#importAlat" class="btn btn-success shadow-sm">
        <i class="fas fa-file-import fa-sm text-white-50"></i> Import File alat</a>
</div>

<div class="modal fade" id="importAlat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

@if(Auth::user()->departement || Auth::user()->level != 'pic')
<div class="card my-4 border-left-primary">
    <div class="p-3">
        <label for="col-md-3">Shortby Kateg:</label>
        <select id="kategori-select">
            <option value="">Semua Kategori</option>
            @foreach($kategori as $item)
            <option value="{{ $item->nama_kategori }}">{{ $item->nama_kategori }}</option>
            @endforeach
        </select>
        @if(Auth::user()->level == 'pic' && (Auth::user()->departement == 'Purcashing' || Auth::user()->departement == 'IPS-RS') || Auth::user()->level == 'admin' ||  Auth::user()->level == 'surveyor' ||  Auth::user()->level == 'teknisi')
        <label for="col-md-3">Shortby Department:</label>
        <select id="departemen-select">
            <option value="">Semua departemen</option>
            <option value="Hospital Kitchen">Hospital Kitchen</option>
            <option value="CSSD">CSSD</option>
        </select>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">detail</th>
                        <th>Instansi</th>
                        <th class="d-none">Kategori</th>
                        <th class="d-none">Departement</th>
                        <th class="d-none">Merk</th>
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
                    @foreach($peralatan as $peralatans)
                    <tr>
                        <td>
                            <a class="btn-de" data-id="{{ $peralatans->id }}">
                                <i class="fas fa-angle-right"></i>
                            </a>
                        </td>
                        <td>{{ $peralatans->instansi->nama_instansi }}</td>
                        <td class="d-none">{{ $peralatans->kategori->nama_kategori }}</td>
                        <td class="d-none">{{ $peralatans->kategori->departement ? $peralatans->kategori->departement : 'Belum ada departement'}}</td>
                        <td class="d-none">{{ $peralatans->merek->nama_merek }}</td>
                        <td>{{ $peralatans->produk->nama_produk}}</td>
                        <td>
                            <a href="{{ route('peralatan.show', $peralatans->slug) }}">{{ $peralatans->serial_number }}</a>
                        </td>
                        <td>{{ $peralatans->tahun_pemasangan }}</td>
                        <td>
                            <span id="selisih-tahun-{{ $peralatans->id }}"></span>
                        </td>
                        <td>{{$peralatans->produk_dalam_kondisi}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    role="progressbar" aria-valuenow="{{$peralatans->kondisi_product}}" aria-valuemin="0"
                                    aria-valuemax="100" style="width: {{$peralatans->kondisi_product}}%">
                                    {{$peralatans->kondisi_product}}</div>
                            </div>
                        </td>
                        @if (Auth::user()->level == 'admin' || Auth::user()->level == 'teknisi' || Auth::user()->level
                        == 'surveyor')
                        <td class="hide-when-checklist-shown">
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('peralatan.edit', $peralatans->slug) }}"
                                    class="btn btn-warning btn-sm"><i class="fa fa-pen-to-square text-white"></i></a>
                                <form action="{{ route('peralatan.destroy', $peralatans->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"> <i
                                            class="fa fa-trash text-white"></i></button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else
Kamu Belum Memiliki Departemen. Hubungi Admin kami untuk mendapatkan akses.
@endif
@endsection

@section('custom-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var table = $('#dataTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": -1 } // Menonaktifkan pengurutan pada kolom terakhir (tombol lihat)
        ],
    });

    $('#dataTable tbody').on('click', 'a.btn-de', function () {
        var row = table.row($(this).parents('tr'));
        var peralatanID = $(this).data('id');

        if (row.child.isShown()) {
            // Tutup child row jika sudah terbuka
            row.child.hide();
            $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
            // Ambil informasi tambahan dari server (misalnya, dengan AJAX)
            $.ajax({
                url: '/peralatan/' + peralatanID + '/details', // Ganti dengan URL yang sesuai
                method: 'GET',
                success: function (data) {
                    // Tampilkan informasi tambahan dalam child row
                    row.child(data).show();
                },
            });
            $(this).find('i').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
    });

    const kategoriSelect = document.getElementById('kategori-select');
    const departemenSelect = document.getElementById('departemen-select'); 
    const rows = document.querySelectorAll('#dataTable tbody tr');

    kategoriSelect.addEventListener('change', filterData);
    departemenSelect.addEventListener('change', filterData);

    function filterData() {
        const selectedKategori = kategoriSelect.value;
        const selectedDepartemen = departemenSelect.value;

        rows.forEach(row => {
            const kategoriCell = row.querySelector('td:nth-child(3)'); // Mengganti indeks kolom sesuai urutan kolom pada tabel
            const departemenCell = row.querySelector('td:nth-child(4)'); // Mengganti indeks kolom sesuai urutan kolom pada tabel

            const isKategoriMatch = selectedKategori === '' || kategoriCell.textContent === selectedKategori;
            const isDepartemenMatch = selectedDepartemen === '' || departemenCell.textContent === selectedDepartemen;

            if (isKategoriMatch && isDepartemenMatch) {
                row.style.display = 'table-row';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function hitungSelisihTahun(tahunPemasangan) {
        const tahunSekarang = new Date().getFullYear();
        return tahunSekarang - tahunPemasangan;
    }

    function perbaruiSelisihTahun(idPeralatan, tahunPemasangan) {
        if (!isNaN(tahunPemasangan)) {
            const selisihTahun = hitungSelisihTahun(tahunPemasangan);
            const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
            elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
        } else {
            const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
            elemenSelisihTahun.innerText = '0 tahun';
        }
    }

    function perbaruiSelisihTahunUntukSemuaPeralatan() {
        const peralatanData = @json($peralatan);

        peralatanData.forEach(function (peralatan) {
            perbaruiSelisihTahun(peralatan.id, peralatan.tahun_pemasangan);
        });
    }

    perbaruiSelisihTahunUntukSemuaPeralatan();
    setInterval(perbaruiSelisihTahunUntukSemuaPeralatan, 1000 * 60 * 60 * 24 * 365); // Setiap 1 tahun (dalam milidetik)
});
</script>
@endsection
