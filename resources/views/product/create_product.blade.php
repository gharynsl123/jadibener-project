@extends('layouts.main-view')

@section('content')
<div class="container">
    <h2>Tambah Produk</h2>
    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nama_merk">Nama Merk</label>
                <select class="form-control" id="nama_merk" name="id_merek">
                    <option>-- PILIH --</option>
                    @foreach($mereks as $merek)
                    <option value="{{ $merek->id }}">{{ $merek->nama_merek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kategori">departement</label>
                <select class="form-control" id="departemen" name="id_departement">
                    <option>-- PILIH --</option>
                    @foreach($departement as $dep)
                    <option value="{{ $dep->id }}">{{ $dep->nama_departement }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6" id="kategori-group" style="display:none;">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>-- PILIH --</option>

                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kode_product">Kode Product</label>
                <input type="text" class="form-control" id="kode_product" name="kode_produk" placeholder="Kode Product">
            </div>
            <div class="form-group col-md-6">
                <label for="nama_product">Nama Product</label>
                <input type="text" class="form-control" id="nama_product" name="nama_produk" placeholder="Nama Product">
            </div>
            <div class="form-group col-md-12">
                <label for="image_product">Image Product (Link Image)</label>
                <input type="file" class="form-control form-control-file p-0" id="photo_produk" name="photo_produk">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const departemenSelect = document.getElementById('departemen');
    const kategoriSelect = document.getElementById('kategori');
    const groupKategori = document.getElementById('kategori-group');
    const kategoris = @json($kategoris); // Data kategori dari controller

    departemenSelect.addEventListener('change', function() {
        const selectedDepartemenId = departemenSelect.value;

        // Clear existing options
        kategoriSelect.innerHTML = '<option>-- PILIH --</option>';

        if (selectedDepartemenId === '-- PILIH --') {
            groupKategori.style.display = 'none';
        } else {
            groupKategori.style.display = 'block';
        }


        // Filter kategori based on selected departemen
        const filteredKategoris = kategoris.filter(kategori => kategori.id_departement ==
            selectedDepartemenId);
        console.log(filteredKategoris)

        // Add filtered kategoris as options
        filteredKategoris.forEach(kategori => {
            const option = document.createElement('option');
            option.value = kategori.id;
            option.textContent = kategori.nama_kategori;
            kategoriSelect.appendChild(option);
        });
    });
});
</script>

@endsection