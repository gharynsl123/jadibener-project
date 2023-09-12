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

<a data-toggle="modal" data-target="#importUser" data-target="#importUser"
    class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
    <i class="fas fa-file-import fa-sm text-white-50"></i>Tambahkan Data Produk</a>

<div class="modal fade" id="importUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Produk</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import.produk') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <input type="file" required name="file">
                        <button class="btn btn-secondary" type="submit">Import Data</button>
                    </div>
                    <small>format file Xsl, CSV</small>
                </form>
            </div>
        </div>
    </div>
</div>

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
                @foreach($produk->reverse() as $item)
                <tr class="text-uppercase">
                    <td>{{ $item->merek->nama_merek }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>{{ $item->kode_produk }}</td>
                    <td>{{ $item->nama_produk }}</td>
                    <td>
                        @if($item->photo_produk)
                        <a href="{{ asset('storage/produk/' . $item->photo_produk) }}" download>
                            <div class="img-thumbnail card square"
                                style="background-image: url('{{ asset('storage/produk/' . $item->photo_produk) }}');">
                            </div>
                        </a>
                        @else
                        Not Available
                        @endif
                    </td>
                    <td>

                        <a href="{{ route('produk.show', $item->id) }}" class="btn btn-primary">
                            <i class="fa fa-eye text-white"></i>
                        </a>
                        <a href="{{ route('produk.edit', $item->id) }}" class="btn btn-warning">
                            <i class="fa fa-pen-to-square text-white"></i>
                        </a>
                        <!-- form edit dan hapus dan detail -->
                        <form action="{{ route('produk.destroy', $item->id) }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash text-white"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection