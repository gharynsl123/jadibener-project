@extends('layouts.main-view')

@section('content')
<style>
.square {
    width: 100px;
    height: 100px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
<a href="{{route('produk.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Produk</a>

<div class="card shadow mt-4 p-3">
    <div class="table-responsive">
        <table class="table table-bordereless" id="dataTable">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Nama Merk</th>
                    <th>Kategori</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Image Product</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($produk as $item)
                <tr class="text-uppercase">
                    <td>{{ $item->merek->nama_merek }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->kode_produk }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>
                        @if($item->photo)
                        <a href="{{ asset('storage/images/' . $item->photo) }}" download>
                            <div class="img-thumbnail card square"
                                style="background-image: url('{{ asset('storage/images/' . $item->photo) }}');"></div>
                        </a>
                        @else
                        Not Available
                        @endif
                    </td>
                    <td>
                        <!-- form edit dan hapus dan detail -->
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <a href="{{ route('produk.show', $item->id) }}" class="btn btn-info">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                            <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-primary">
                                <i class="fa fa-pen-to-square text-white"></i>
                            </a>
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash text-white"></i>
                            </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection