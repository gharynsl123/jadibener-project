@extends('layouts.main-view')

@section('content')
<style>
.square {
    width: 200px;
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<div class="container">
    <h2>Edit Produk</h2>
    <form action="{{ route('produk.update', $produk->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nama_merk">Nama Merk</label>
                <select class="form-control" id="nama_merk" name="id_merek">
                    <option>-- PILIH --</option>
                    @foreach($mereks as $merek)
                    <option value="{{ $merek->id }}" {{ $produk->id_merek == $merek->id ? 'selected' : '' }}>
                        {{ $merek->nama_merek }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kategori">departement</label>
                <select name="departement" id="departement" class="mb-4 form-control">
                        <option value="">Pilih Departemen</option>
                        <option value="Hospital Kitchen">Hospital Kitchen</option>
                        <option value="CSSD">CSSD</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>-- PILIH --</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" {{ $produk->id_kategori == $kategori->id ? 'selected' : '' }}>
                        {{ $kategori->nama_kategori }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kode_product">Kode Product</label>
                <input type="text" class="form-control" id="kode_product" name="kode_produk" placeholder="Kode Product"
                    value="{{ $produk->kode_produk }}">
            </div>
            <div class="form-group col-md-6">
                <label for="nama_product">Nama Product</label>
                <input type="text" class="form-control" id="nama_product" name="nama_produk" placeholder="Nama Product"
                    value="{{ $produk->nama_produk }}">
            </div>
            <div class="form-group col-md-6">
                <label for="new_image_product">Edit Image Product (Optional)</label>
                <input type="file" class="form-control form-control-file p-0" id="new_image_product" name="photo_produk">
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
    const kategoris = @json($kategoris);  // Data kategori dari controller

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