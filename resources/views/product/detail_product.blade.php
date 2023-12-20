@extends('layouts.main-view')

@section('title', 'Detail Produk')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Detail Produk</h2>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-auto d-flex justify-content-center ">
                    <img src="{{ asset('storage/produk/' . $produk->photo_produk) }}" alt="Image Produk"
                        class="img-fluid" style="height:250px;">
                </div>
                <div class="col-md-auto">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <th>Nama Merk</th>
                                <td>{{ $produk->merek->nama_merek }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $produk->kategori->nama_kategori }}</td>
                            </tr>
                            <tr>
                                <th>Kode Produk</th>
                                <td>{{ $produk->kode_produk }}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $produk->nama_produk }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('produk.index') }}" class="btn btn-primary mt-4">Kembali ke Daftar Produk</a>
</div>
@endsection
