@extends('layouts.main-view')

@section('content')
<!-- Page Heading -->
<a data-toggle="modal" data-target="#inputKategori" data-target="#inputKategori"
    class="d-sm-inline-block mb-4 btn btn-sm btn-success shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i>Tambahkan Kategori</a>

<!-- Logout Modal-->
<div class="modal fade" id="inputKategori" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Kategori</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('kategori.store')}}" method="post">
                    @csrf
                    <input type="text" name="nama_kategori" class="mb-4 form-control" autocomplete="off"
                        placeholder="Nama Kategori">
                    <button class="btn btn-primary" type="submit">Input</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="card border-left-primary shadow mb-4">
    <div class="p-0">
        <div class="table-responsive">
            <table class="table table-hover m-0" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kategori as $index => $items)
                    <tr data-nomor="{{ $index + 1 }}">
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $items->nama_kategori }}
                        </td>
                        <td>
                            <form action="{{ route('kategori.destroy', $items->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('kategori.edit', $items->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger mt-2" onclick="#">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection