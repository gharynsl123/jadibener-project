@extends('layouts.main-view')

@section('content')
<a href="{{route('produk.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Produk</a>

    <div class="card shadow mt-4 p-3">
<div class="table-responsive">
    <table class="table table-bordereless" id="dataTable">
        <thead>
            <tr>
                <th>Nama Merk</th>
                <th>Kategori</th>
                <th>Kode Produk</th>
                <th>Nama Produk</th>
                <th>Image Product</th>
            </tr>
        </thead>
        <tbody>
            @foreach($produk as $item)
            <tr>
                <td>{{ $item->merek->nama_merek }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->kode_produk }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>
                    @if($item->photo)
                    <img src="{{ asset('storage/' . $item->photo) }}" alt="Image Product" style="max-width: 100px;">
                    @else
                    Not Available
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

    </div>
@endsection