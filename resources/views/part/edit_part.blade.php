@extends('layouts.main-view')
@section('title', 'edit part')
@section('content')

<form action="{{ route('part.update', $part->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Isi input dengan data yang sudah ada -->
    <div class="mb-3 d-flex justify-content-center">
        <img src="#" id="imagePreview" class="img-thumbnail card square" alt="Image Preview">
    </div>
    <div class="row gap-2">
        <!-- File Input -->
        <div class="col-md-6 mb-3">
            <label for="image" class="form-label">No Image</label>
            <input type="file" class="form-control" id="image" accept="image/*" onchange="previewImage()">
        </div>

        <!-- Nama Part -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark" for="nama_part">Nama Part</label>
                <input type="text" class="form-control mb-3" name="nama_part" id="nama_part" value="{{ $part->nama_part }}">
            </div>
        </div>

        <!-- Harga -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark" for="harga">Harga</label>
                <input type="text" class="form-control mb-3" name="harga" id="harga" value="{{ $part->harga }}">
            </div>
        </div>

        <!-- Kode Part -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark" for="kode_part">Kode Part</label>
                <input type="text" class="form-control mb-3" name="kode_part" id="kode_part" value="{{ $part->kode_part }}">
            </div>
        </div>

        <!-- Kategori -->
        <div class="col-md-6">
            <div class="form-group">
                <label class="text-dark" for="id_kategori">Kategori</label>
                <select class="form-control mb-3" name="id_kategori" id="id_kategori">
                    <option value="">pilih kategori</option>
                    @foreach($kategori as $i)
                        <option value="{{ $i->id }}" {{ $part->id_kategori == $i->id ? 'selected' : '' }}>{{ $i->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="col-md-12">
            <div class="form-group">
                <label class="text-dark" for="deskripsi">Deskripsi</label>
                <textarea class="form-control mb-3" name="deskripsi" id="deskripsi">{{ $part->deskripsi }}</textarea>
            </div>
        </div>
    </div>

    <button type="submit" class="btn  btn-primary">Update</button>
    <a href="/part" class="btn  btn-secondary">cancel</a>
</form>
@endsection
