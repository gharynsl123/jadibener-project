@extends('layouts.main-view')
@section('title', 'Tambahkan Alat')
@section('content')
<div class="card border-left-success p-3">

    <div class="d-flex">
        <a href="/peralatan" class="btn mr-3 btn-secondary">Batalkan</a>
        <h3 class="m-0 p-0 ">Tambah Daftar Peralatan RS</h3>
    </div>
    <form action="{{route('peralatan.store')}}" class="mt-3" method="post">
        @csrf
        <div class="form-group">
            <label for="merk">Nama Instansi</label>
            <select class="form-control" name="id_instansi">
                <option>-- PILIH --</option>
                @foreach($instansi as $items)
                <option value="{{ $items->id }}">{{ $items->nama_instansi }}</option>
                @endforeach
                <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
            </select>
        </div>
        <div class="form-group">
            <label for="merk">Nama Merk</label>
            <select class="form-control" name="id_merek">
                <option>-- PILIH --</option>
                @foreach($merek as $merks)
                <option value="{{ $merks->id }}">{{ $merks->nama_merek }}</option>
                @endforeach
                <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
            </select>
        </div>

        <!-- pengisian id user dengan user yang sedang login-->
        <input type="text" name="id_user" value="{{ Auth::user()->id }}" hidden readonly>

        <div class="form-group">
            <label for="kategori">Nama Kategori</label>
            <select class="form-control" name="id_kategori" id="kategori-select">
                <option>-- PILIH --</option>
                @foreach($kategori as $kategoris)
                <option value="{{ $kategoris->id }}">{{ $kategoris->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <input type="text" id="departemenInput" name="id_departement" hidden readonly >

        <div class="form-group" id="produk-group" style="display: none;">
            <label for="merk">Nama Product</label>
            <select class="form-control" name="id_product" id="product-select">
                <option>-- PILIH --</option>
                <!-- Opsi produk akan diisi melalui JavaScript -->
            </select>
        </div>

        <div class="form-group">
            <label for="serial-number">Usia Barang</label>
            <input type="number" class="form-control" name="usia_barang" id="pertahun-product"
                placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
            <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
        </div>
        <div class="form-group">
            <label for="serial-number">Serial Number</label>
            <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number">
        </div>

        <div class="form-group">
            <label for="tahun-pemasangan">Tahun Pemasangan</label>
            <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan"
                placeholder="Tahun Pemasangan">
        </div>
        <button type="submit" class="ml-auto btn btn-primary">Submit</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const pertahunProductInput = document.getElementById('pertahun-product');

    const kategoriSelect = document.getElementById('kategori-select');
    const productSelect = document.getElementById('product-select');
    const formGroupInput = document.getElementById('produk-group');
    const products = @json($product); // Data produk dari controller
    const kategori = @json($kategori); // Data produk dari controller
    var departemenInput = document.getElementById('departemenInput');

    // Add an event listener to the kategori select
    kategoriSelect.addEventListener('change', function() {
        const selectedCategoryId = kategoriSelect.value;

        // Clear existing options
        productSelect.innerHTML = '<option>-- PILIH --</option>';

        // jika kategori tidak dipilih mmaka hilangkan opsi produk. jika di pilih maka muncul kan opsi produk
        if (selectedCategoryId === '-- PILIH --') {
            formGroupInput.style.display = 'none';
            return;
        } else {
            formGroupInput.style.display = 'block';
        }

        // Di sini, kita akan mengambil ID departemen yang terkait dengan kategori yang dipilih.
        const selectedCategory = kategori.find(departement => departement.id == selectedCategoryId);
        console.log(selectedCategory)
        departemenInput.value = selectedCategory.id_departement;

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

    pertahunProductInput.addEventListener('input', function() {
        // Get the entered value and convert it to a number
        let value = parseFloat(pertahunProductInput.value);

        // Check if the entered value is greater than 100
        if (value > 10) {
            // If it's greater, set the input value to 100
            pertahunProductInput.value = 10;
        } else if (value < 5) {
            // if it's small than 5, set the input value to 5
            pertahunProductInput.value = 5;
        }
    });

});
</script>
@endsection