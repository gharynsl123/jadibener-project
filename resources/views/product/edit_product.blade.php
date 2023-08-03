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
            <div class="form-group col-md-4">
                <label for="image_product">Image Product (Current Image)</label><br>
                @if($produk->photo)
                <div class="img-thumbnail card square" id="imagePreview"
                    style="background-image: url('{{ asset('storage/images/' . $produk->photo) }}');"></div>
                @else
                <p>Image not available</p>
                @endif
            </div>
            <div class="form-group col-md-8">
                <label for="new_image_product">Edit Image Product (Optional)</label>
                <input type="file" class="form-control form-control-file p-0" id="new_image_product" name="photo">
            </div>

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script>
    // Ambil elemen input file
    const inputImage = document.getElementById('new_image_product');
    // Ambil elemen gambar priview
    const imagePreview = document.getElementById('imagePreview');

    // Tambahkan event listener untuk memantau perubahan pada input file
    inputImage.addEventListener('change', function () {
        // Pastikan ada gambar yang dipilih oleh pengguna
        if (this.files && this.files[0]) {
            // Buat objek URL untuk gambar yang dipilih
            const imageURL = URL.createObjectURL(this.files[0]);
            // Tampilkan gambar priview dengan URL gambar yang baru
            imagePreview.style.backgroundImage = `url('${imageURL}')`;
            imagePreview.style.display = 'block'; // Tampilkan elemen gambar
        } else {
            // Jika tidak ada gambar yang dipilih, sembunyikan gambar priview
            imagePreview.style.backgroundImage = '';
            imagePreview.style.display = 'none'; // Sembunyikan elemen gambar
        }
    });
</script>

@endsection