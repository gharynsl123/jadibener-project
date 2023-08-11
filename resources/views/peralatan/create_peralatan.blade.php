@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary">
    <p class="card-header ">Tambah Daftar Peralatan RS</p>
    <div class="container my-4">
        <form action="{{route('peralatan.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="merk">Nama Instansi</label>
                <select class="form-control" name="id_instansi">
                    <option>-- PILIH --</option>
                    @foreach($instansi as $instansis)
                    <option value="{{ $instansis->id }}">{{ $instansis->instasi }}</option>
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
            <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <select class="form-control" name="id_kategori" id="kategori-select">
                    <option>-- PILIH --</option>
                    @foreach($kategori as $kategoris)
                    <option value="{{ $kategoris->id }}">{{ $kategoris->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group " id="product-group" style="display: none;">
                <label for="merk">Nama Product</label>
                <select class="form-control" name="id_product" id="product-select">
                    <option>-- PILIH --</option>
                    @foreach($product as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                    @endforeach
                    <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Keterangan Product</label>
                <select class="form-control" name="keterangan">

                    <option value="baik">baik</option>
                    <option value="hilang">hilang</option>
                    <option value="rusak">rusak</option>

                    Tambahkan opsi merk lainnya sesuai kebutuhan
                </select>
            </div>
            <div class="form-group">
                <label for="serial-number">Kondisi Product</label>
                <input type="number" class="form-control" name="kondisi_product" id="kondisi-product"
                    placeholder="untuk di tampilan menjadi persent">
                <small class="text-muted">batas pengisian 100</small>
            </div>
            <div class="form-group">
                <label for="serial-number">Nilai Tahunan</label>
                <input type="number" class="form-control" name="nilai_tahun" id="pertahun-product"
                    placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
            </div>
            <div class="form-group">
                <label for="serial-number">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" id="serial-number"
                    placeholder="Serial Number">
            </div>

            <div class="form-group">
                <label for="tahun-pemasangan">Tahun Pemasangan</label>
                <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan"
                    placeholder="Tahun Pemasangan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/peralatan" class="btn btn-secondary">Batalkan</a>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const kondisiProductInput = document.getElementById('kondisi-product');
    const pertahunProductInput = document.getElementById('pertahun-product');

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
<script>
document.addEventListener('DOMContentLoaded', function() {
    const kategoriSelect = document.getElementById('kategori-select');
    const productSelect = document.getElementById('product-select');
    const groupProduct = document.getElementById('product-group');
    const products = @json($product); // Data produk dari controller

    // jika kategori di pilih maka product akan muncul jika tidak maka tidak muncul
    kategoriSelect.addEventListener('change', function() {
        if (kategoriSelect.value != "-- PILIH --") {
            groupProduct.style.display = "block";
        } else {
            groupProduct.style.display = "none";
        }
    });

    // Add an event listener to the kategori select
    kategoriSelect.addEventListener('change', function() {
        const selectedCategoryId = kategoriSelect.value;

        // Clear existing options
        productSelect.innerHTML = '<option>-- PILIH --</option>';

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
        // ... (existing code to limit input to 100)
    });
});
</script>

@endsection