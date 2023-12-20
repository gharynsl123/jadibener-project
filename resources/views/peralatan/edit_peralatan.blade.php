@extends('layouts.main-view')

@section('title', 'Edit Peralatan')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card border-left-primary p-3">

    <div class="d-flex">
        @if (Auth::user()->level == 'pic')
        <a href="/peralatan" class="btn mr-3 btn-secondary">Cancel</a>
        @else
        <a href="/member-instansi" class="btn mr-3 btn-secondary">Cancel</a>
        @endif
        <h3 class="m-0 p-0">Edit Daftar Peralatan RS</h3>
    </div>
    <form action="{{ route('peralatan.update', $peralatan->id) }}" class="mt-3"method="post">
        <div class="row gap-2">
            @csrf
            @method('PUT')
            <input type="text" name="id_user" value="{{ Auth::user()->id }}" hidden readonly>
            <div class="form-group col-md-6">
                <label for="merk">Nama Instansi</label>
                <select class="form-control" id="instansi-select" name="id_instansi">
                    @foreach($instansi as $items)
                    @if($items->jumlah_kasur)
                    <option value="{{ $items->id }}" {{ $peralatan->id_instansi == $items->id ? 'selected' : '' }}>{{ $items->nama_instansi }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="merk">Nama Merk</label>
                <select class="form-control" name="id_merek">
                    @foreach($merek as $merks)
                    <option value="{{ $merks->id }}" {{$peralatan->id_merek == $merks->id ?'selected' : ''}}>{{ $merks->nama_merek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="kategori">Nama Kategori</label>
                <select class="form-control" id="kategori-select" name="id_kategori">
                    @foreach($kategori as $kategoris)
                    <option value="{{ $kategoris->id }}" {{$peralatan->id_kategori == $kategoris->id ? 'selected' : ''}}>{{ $kategoris->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <input type="text" id="departemenInput" name="departement" hidden readonly
                value="{{$peralatan->departement}}">

            <div class="form-group col-md-6">
                <label for="merk">Nama Product</label>
                <select class="form-control" name="id_product" id="product-select">
                    @foreach($product as $item)
                    <option value="{{ $item->id }}" {{$peralatan->id_product == $item->id ? 'selected' : ''}}>{{ $item->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="merk">Produk Dalam Kondisi</label>
                <select class="form-control" name="produk_dalam_kondisi">
                    <option value="baik" @if($peralatan->keterangan === 'baik') selected @endif>baik</option>
                    <option value="hilang" @if($peralatan->keterangan === 'hilang') selected @endif>hilang</option>
                    <option value="rusak" @if($peralatan->keterangan === 'rusak') selected @endif>rusak</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="serial-number">Produk Dalam Kondisi</label>
                <input type="number" class="form-control" name="kondisi_product" id="kondisi-product"
                    value="{{ $peralatan->kondisi_product }}" placeholder="untuk di tampilan menjadi persent">
                <small class="text-muted">batas pengisian 100</small>
            </div>
            <div class="form-group col-md-6">
                <label for="serial-number">Nilai Tahunan</label>
                <input type="number" class="form-control" id="pertahun-product" name="usia_barang"
                    value="{{ $peralatan->usia_barang }}"
                    placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
            </div>
            <div class="form-group col-md-6">
                <label for="serial-number">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" id="serial-number"
                    placeholder="Serial Number" value="{{ $peralatan->serial_number }}">
            </div>
            <div class="form-group col-md-6">
                <label for="tahun-pemasangan">Tahun Pemasangan</label>
                <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan"
                    placeholder="Tahun Pemasangan" value="{{ $peralatan->tahun_pemasangan }}">
            </div>
            <div class="form-group col-md-6">
                <label for="tahun-pemasangan">Saran Perbaikan/Rekomendasi</label>
                <input type="text" class="form-control" name="saran_perbaikan" id="tahun-pemasangan"
                    placeholder="masukan saran" value="{{ $peralatan->saran_perbaikan }}">
            </div>
            <div class="form-group col-md-6">
                <label for="tahun-pemasangan">serveyor</label>
                <input type="text" class="form-control" id="tahun-pemasangan" value="{{ $peralatan->user->nama_user }}">
            </div>

        </div>
        <button type="submit" class="btn ml-auto btn-primary">Update</button>
    </form>
    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kondisiProductInput = document.getElementById('kondisi-product');
    const pertahunProductInput = document.getElementById('pertahun-product');

    $('#instansi-select').select2();
    $('#product-select').select2();

    const products = @json($product); // Data produk dari controller
    const kategori = @json($kategori); // Data produk dari controller
    
    const productSelect = document.getElementById('product-select');
    const kategoriSelect = document.getElementById('kategori-select');

    // Add an event listener to the kategori select
    kategoriSelect.addEventListener('change', function() {
        const selectedCategoryId = kategoriSelect.value;

        // Clear existing options
        productSelect.innerHTML = '<option>-- PILIH --</option>';

        const selectedCategory = kategori.find(category => category.id == selectedCategoryId);
        console.log(selectedCategory)
        departemenInput.value = selectedCategory.departement;

        // Filter products based on selected category
        const filteredProducts = products.filter(product => product.id_kategori == selectedCategoryId);

        // Add filtered products as options
        filteredProducts.forEach(product => {
            const option = document.createElement('option');
            option.value = product.id;
            option.textContent = product.nama_produk;
            productSelect.appendChild(option);
        });
    });

    // Add an event listener to the input field
    kondisiProductInput.addEventListener('input', function() {
        // Get the entered value and convert it to a number
        let value = parseFloat(kondisiProductInput.value);

        // Check if the entered value is greater than 100
        if (value > 100) {
            // If it's greater, set the input value to 100
            kondisiProductInput.value = 100;
        }
    });
});
</script>
@endsection