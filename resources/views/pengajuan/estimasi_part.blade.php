@extends('layouts.main-view')
@section('title', 'Pengajuan Pergantian Part')
@section('content')
<!-- Keterangan Produk -->
<div class="card shadow mb-3">
    <div class="card-header bg-info">
        <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT</p>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-borderless">
            <tr>
                <th>Instansi</th>
                <td>:</td>
                <td>{{ $dataApp->instansi->nama_instansi }}</td>
                <th>Nama Product</th>
                <td>:</td>
                <td>{{$dataApp->produk->nama_produk}}</td>
            </tr>
            <tr>
                <th>Serial Number</th>
                <td>:</td>
                <td>{{ $dataApp->serial_number }}</td>
                <th>Kode Product</th>
                <td>:</td>
                <td>{{ $dataApp->produk->kode_produk }}</td>
            </tr>
            <tr>
                <th>Merek</th>
                <td>:</td>
                <td>{{ $dataApp->merek->nama_merek }}</td>
                <th>Instalasi</th>
                <td>:</td>
                <td>{{ $dataApp->tahun_pemasangan }}</td>
            </tr>
            <tr>
                <th>Status Alat</th>
                <td>:</td>
                <td>{{$dataApp->keterangan}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card shadow p-4">
    <form action="{{route('estimate.store')}}" method="post">
        @csrf
        <div class="row">
            <input name="id_instansi" value="{{$dataApp->instansi->id}}" hidden>
            <input name="id_peralatan" value="{{$dataApp->id}}" hidden>
            <div class="form-group col-md-6">
                <label for="kategori-select">Kategori</label>
                <select name="id_kategori" id="kategori-select" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6" id="part-group" style="display:none;">
                <label for="part-select">Part</label>
                <select name="id_part" id="part-select" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="level">Harga</label>
                <input type="number" name="harga" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="level">Quantity</label>
                <input type="number" name="quantity" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="level">keterangan</label>
                <input type="text" name="keterangan" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan</button>
        <a href="{{route('peralatan.index')}}" class="btn btn-secondary">cencel</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategori-select');
    const partSelect = document.getElementById('part-select');
    const formGroupInput = document.getElementById('part-group');
    const parts = @json($part); // Data part dari controller

    kategoriSelect.addEventListener('change', function() {
        const selectedCategoryId = kategoriSelect.value;

        partSelect.innerHTML = '<option value="">Pilih</option>';

        if (selectedCategoryId === '') {
            formGroupInput.style.display = 'none';
            return;
        } else {
            formGroupInput.style.display = 'block';
        }

        const filteredParts = parts.filter(part => part.id_kategori == selectedCategoryId);

        filteredParts.forEach(part => {
            const option = document.createElement('option');
            option.value = part.id;
            option.textContent = part.nama_part;
            partSelect.appendChild(option);
        });
    });
});
</script>
@endsection