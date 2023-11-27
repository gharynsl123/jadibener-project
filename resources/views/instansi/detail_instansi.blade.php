@extends('layouts.main-view')

@section('title', "Detail {$instansi->nama_instansi}")
@section('content')

<div class="d-flex">
    <div>
        <a href="{{ route('instansi.index') }}" class="btn mr-3 btn-secondary">Kembali</a>
    </div>
    <h2 class="my-0 p-0">Detail Data Rumah Sakit / Institusi</h2>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="form-group">
            @if($instansi->photo_instansi)
            <!-- ambil gambar -->
            <img src="{{ asset('storage/rumahsakit/'.$instansi->photo_instansi) }}" style="height:350px;" class="img-thumbnail"
                alt="Responsive image">
            @else
            <p>No Image Available</p>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="nama-rumah-sakit">Nama Rumah Sakit / Institusi</label>
            <input type="text" class="form-control" value="{{ $instansi->nama_instansi }}" readonly>
        </div>
        <div class="form-group">
            <label for="jumlah-bed">Jumlah Bed</label>
            <input type="text" class="form-control" value="{{ $instansi->jumlah_kasur }}" readonly>
        </div>
        <div class="form-group">
            <label for="pic">Jenis Instansi</label>
            <input type="text" class="form-control" value="{{ ucfirst($instansi->jenis_instansi) }}" readonly>
        </div>
        <label for="" class="m-0">alamat</label>
        <p class="mt-0">{!! $instansi->alamat_instansi !!}</p>
    </div>

    <div class="col-md-12">
        <h4>PIC:</h4>
        <!-- Jika rumah sakit belum memiliki PIC maka tampilan teks, jika sudah tampilkan foreach -->
        @if($user)
        <table class="table">
            <thead>
                <tr>
                    <th>nama</th>
                    <th></th>
                    <th>role</th>
                    <th></th>
                    <th>barang yang terdata</th>
                    <th>action</th>
                </tr>
            </thead>
            @foreach($user as $items)
            <tbody>
                <tr>
                    <td>{{$items->nama_user}}</td>
                    <td>:</td>
                    <td>{{$items->departement}}</td>
                    <td>:</td>
                    <td>
                        {{$jumlahPeralatanPerDepartemen[$items->departement]}} peralatan
                    </td>
                    <td>
                        <a href="{{ route('survey.create-alat', $items->id) }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-plus"></i>
                            Add Barang
                        </a>
                        <a class="btn btn-sm show-peralatan-btn btn-primary" data-departemen="{{ $items->departement }}">
                            <i class="fas fa-eye"></i>
                            Lihat Barang
                        </a>
                    </td>
                </tr>
                </tbody>
            @endforeach
        </table>
        @else
        <p>Belum ada PIC</p>
        @endif

        <div class="table-reponsive peralatan-list" style="display:none;">
            <table class="table table-hover table-borderless" >
                <!-- Kolom-kolom tabel peralatan di sini -->
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Nama Barang</th>
                        <th>Serial Number</th>
                        <th>Instalasi</th>
                        <th>Keterangan</th>
                        <th>departement</th>
                        <th class="th-end">Action</th>
                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($alat as $peralatan)
                    <tr>
                        <td>{{ $peralatan->produk->nama_produk }}</td>
                        <td> <a href="{{ route('peralatan.show', $peralatan->slug) }}">{{ $peralatan->serial_number }}</a></td>
                        <td>{{ $peralatan->tahun_pemasangan }}</td>
                        <td>{{ $peralatan->produk_dalam_kondisi}}</td>
                        <td>{{ $peralatan->departement}}</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="{{ route('peralatan.edit', $peralatan->slug) }}"
                                    class="btn btn-warning btn-sm"><i class="fa fa-pen-to-square text-white"></i></a>
                                <form action="{{ route('peralatan.destroy', $peralatan->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"> <i
                                            class="fa fa-trash text-white"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if(Auth::user()->level == 'surveyor')
        <a href="{{ route('survey.exist-data', $instansi->id) }}" class="btn btn-primary">Create Data PIC</a>
        @endif
    </div>

</div>

<script>
    const showPeralatanButtons = document.querySelectorAll('.show-peralatan-btn');

    showPeralatanButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const departemen = button.getAttribute('data-departemen');
            const peralatanList = document.querySelector(`div.peralatan-list`);

            if (peralatanList) {
                if (peralatanList.style.display === 'none') {
                    // Jika tabel peralatan sedang disembunyikan, tampilkan
                    const allPeralatanLists = document.querySelectorAll('div.peralatan-list');
                    allPeralatanLists.forEach((list) => {
                        list.style.display = 'none';
                    });

                    peralatanList.style.display = 'block';
                    // Di sini, Anda perlu mengisi tabel peralatan berdasarkan departemen yang sesuai
                    const dataPeralatan = getDataPeralatanByDepartemen(departemen);
                    tampilkanPeralatanList(dataPeralatan, peralatanList);
                } else {
                    // Jika tabel peralatan sedang ditampilkan, sembunyikan
                    peralatanList.style.display = 'none';
                }
            }
        });
    });

    // Fungsi untuk mengambil data peralatan sesuai dengan departemen (gantilah ini dengan logika yang sesuai)
    function getDataPeralatanByDepartemen(departemen) {
        // Misalnya, Anda bisa menggunakan AJAX untuk mengambil data peralatan berdasarkan departemen
        // Atau jika data sudah ada dalam variabel, Anda bisa memfilternya
        const dataPeralatan = peralatan.filter(peralatan => peralatan.departemen === departemen);
        return dataPeralatan;
    }
    // Fungsi untuk menampilkan daftar peralatan di dalam peralatan-list (gantilah ini dengan kode HTML yang sesuai)
    function tampilkanPeralatanList(dataPeralatan, peralatanList) {
        const table = peralatanList.querySelector('table');
        const tbody = table.querySelector('tbody');
        tbody.innerHTML = ''; // Kosongkan tbody sebelum menambahkan data baru

        dataPeralatan.forEach(peralatan => {
            const row = tbody.insertRow();
            const cell1 = row.insertCell(0);
            cell1.innerHTML = peralatan.nama; // Gantilah ini sesuai dengan data peralatan yang sesuai
            // Lanjutkan untuk menambahkan kolom-kolom lain
        });
    }
</script>



@endsection
