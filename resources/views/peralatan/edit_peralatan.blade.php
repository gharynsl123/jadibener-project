@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary">
    <p class="card-header ">Edit Daftar Peralatan RS</p>
    <div class="container my-4">
        <form action="{{ route('peralatan.update', $peralatan->id) }}" method="post">
            <div class="row gap-2">
                @csrf
                @method('PUT')
                <input type="text" name="id_user" value="{{ Auth::user()->id }}" hidden readonly>
                <div class="form-group col-md-6">
                    <label for="merk">Nama Instansi</label>
                    <select class="form-control" name="id_instansi">
                        @foreach($instansi as $items)
                        <option value="{{ $items->id }}" @if($peralatan->id_instansi === $items->id) selected @endif>{{ $items->nama_instansi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="merk">Nama Merk</label>
                    <select class="form-control" name="id_merek">
                        @foreach($merek as $merks)
                        <option value="{{ $merks->id }}" @if($peralatan->id_merek === $merks->id) selected @endif>{{ $merks->nama_merek }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="kategori">Nama Kategori</label>
                    <select class="form-control" id="kategori-select" name="id_kategori">
                        @foreach($kategori as $kategoris)
                        <option value="{{ $kategoris->id }}" @if($peralatan->id_kategori === $kategoris->id) selected @endif>{{ $kategoris->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="merk">Nama Product</label>
                    <select class="form-control" name="id_product" id="product-select">
                        @foreach($product as $item)
                        <option value="{{ $item->id }}" @if($peralatan->id_product === $item->id) selected @endif>{{ $item->nama_produk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="merk">Keterangan Product</label>
                    <select class="form-control" name="keterangan">
                        <option value="baik" @if($peralatan->keterangan === 'baik') selected @endif>baik</option>
                        <option value="hilang" @if($peralatan->keterangan === 'hilang') selected @endif>hilang</option>
                        <option value="rusak" @if($peralatan->keterangan === 'rusak') selected @endif>rusak</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="serial-number">Kondisi Product</label>
                    <input type="number" class="form-control" name="kondisi_product" id="kondisi-product" value="{{ $peralatan->kondisi_product }}" placeholder="untuk di tampilan menjadi persent">
                    <small class="text-muted">batas pengisian 100</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="serial-number">Nilai Tahunan</label>
                    <input type="number" class="form-control" id="pertahun-product" name="usia_barang" value="{{ $peralatan->usia_barang }}" placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                    <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="serial-number">Serial Number</label>
                    <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number" value="{{ $peralatan->serial_number }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="tahun-pemasangan">Tahun Pemasangan</label>
                    <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan" placeholder="Tahun Pemasangan" value="{{ $peralatan->tahun_pemasangan }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="tahun-pemasangan">Saran Perbaikan/Rekomendasi</label>
                    <input type="text" class="form-control" name="saran_perbaikan" id="tahun-pemasangan" placeholder="masukan saran" value="{{ $peralatan->saran_perbaikan }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="tahun-pemasangan">serveyor</label>
                    <input type="text" class="form-control" name="saran_perbaikan" id="tahun-pemasangan" placeholder="Tahun Pemasangan" value="{{ $peralatan->user->nama_user }}">
                </div>
                
            </div>            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/peralatan" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kondisiProductInput = document.getElementById('kondisi-product');
        const pertahunProductInput = document.getElementById('pertahun-product');
        
        const productSelect = document.getElementById('product-select');
        const products = @json($product); // Data produk dari controller

        const kategoriSelect = document.getElementById('kategori-select');

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
