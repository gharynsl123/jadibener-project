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
                <th>Status Alat</th>
                <td>:</td>
                <td>{{$peralatan->keterangan}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="card shadow p-4">
    <form action="" method="post">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="kategori-select">Kategori</label>
                <select name="kategori" id="kategori-select" class="form-control">
                    <option value="">Pilih</option>
                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6" id="part-group" style="display:none;">
                <label for="part-select">Part</label>
                <select name="part" id="part-select" class="form-control">
                    <option value="">Pilih</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="level">Harga</label>
                <input type="number" name="level" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="level">Quantity</label>
                <input type="number" name="level" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="level">keterangan</label>
                <input type="text" name="level" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Tambahkan</button>
        <a href="/pengajuan/{id}" class="btn btn-secondary">cencel</a>
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