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
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori" name="id_kategori">
                    <option>-- PILIH --</option>
                    @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
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
                <input type="file" class="form-control form-control-file p-0" id="image_product" name="image_product">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
