@extends('layouts.main-view')

@section('title', "Detail {$instansi->nama_instansi}")
@section('content')

<div class="d-flex">
    <div class="">
        <a href="{{ route('instansi.index') }}" class="btn mr-3 btn-secondary">Kembali</a>
    </div>
    <h2 class="my-0 p-0">Detail Data Rumah Sakit / Institusi</h2>
</div>
<div class="row mt-4">
    <div class="col-md-6">
        <div class="form-group">
            @if($instansi->photo_instansi)
            <!-- ambil gambar -->
            <img src="{{ asset('storage/rumahsakit/'.$instansi->photo_instansi) }}" style="height:350px;"class="img-thumbnail"
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
                        <a href="{{route('survey.create-alat', $items->id)}}" class="btn btn-secondary">
                            <i class="fas fa-plus"></i>
                            Add Barang
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @else
        <p>Belum ada PIC</p>
        @endif

        @if(Auth::user()->level == 'surveyor')
        <a href="{{ route('survey.exist-data', $instansi->id) }}" class="btn btn-primary">Create Data PIC</a>
        @endif
    </div>
</div>

<script>
// Temukan semua tombol "Lihat Barang"
const showPeralatanButtons = document.querySelectorAll('.show-peralatan-btn');

// Tambahkan event listener untuk masing-masing tombol
showPeralatanButtons.forEach((button) => {
    button.addEventListener('click', () => {
        // Temukan tabel peralatan yang sesuai dengan departemen yang dipilih
        const departemenId = button.getAttribute('data-departemen-id');
        const peralatanTable = document.querySelector(`.table-responsive[data-departemen-id="${departemenId}"]`);

        if (peralatanTable.style.display === 'block') {
            // Jika tabel peralatan sedang ditampilkan, sembunyikan
            peralatanTable.style.display = 'none';
        } else {
            // Jika tabel peralatan sedang disembunyikan atau belum ditampilkan, tampilkan
            // Semua tabel peralatan disembunyikan terlebih dahulu
            const allPeralatanTables = document.querySelectorAll('.table-responsive');
            allPeralatanTables.forEach((table) => {
                table.style.display = 'none';
            });

            // Tampilkan tabel peralatan yang sesuai
            peralatanTable.style.display = 'block';
        }

        hitungSelisihTahun();
        perbaruiSelisihTahun();
        perbaruiSelisihTahunUntukSemuaPeralatan();
    });
});

// Bagian JavaScript
function hitungSelisihTahun(tahunPemasangan) {
    const tahunSekarang = new Date().getFullYear();
    return tahunSekarang - tahunPemasangan;
}

function perbaruiSelisihTahun(idPeralatan, tahunPemasangan) {
    // Periksa apakah tahunPemasangan adalah NaN atau bukan
    if (!isNaN(tahunPemasangan)) {
        const selisihTahun = hitungSelisihTahun(tahunPemasangan);
        const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
        if (elemenSelisihTahun) {
            elemenSelisihTahun.innerText = `${selisihTahun} tahun`;
        }
    } else {
        // Jika tahunPemasangan adalah NaN, tampilkan "0 tahun"
        const elemenSelisihTahun = document.getElementById(`selisih-tahun-${idPeralatan}`);
        if (elemenSelisihTahun) {
            elemenSelisihTahun.innerText = '0 tahun';
        }
    }
}

function perbaruiSelisihTahunUntukSemuaPeralatan() {
    const peralatanData = @json($alat);

    peralatanData.forEach(function (peralatan) {
        perbaruiSelisihTahun(peralatan.id, peralatan.tahun_pemasangan);
    });
}
</script>

@endsection
