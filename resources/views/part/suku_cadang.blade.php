@extends('layouts.main-view')

@section('content')
<!-- Page Heading -->
<a data-toggle="modal" data-target="#inputpart" data-target="#inputpart"
    class="d-sm-inline-block mb-4 btn btn-sm btn-success shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i>Tambahkan part</a>

<!-- Logout Modal-->
<div class="modal fade" id="inputpart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input part</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('part.store')}}" method="post">
                    @csrf
                    <input type="text" name="kode_sukucadang" class="mb-4 form-control" autocomplete="off"
                    placeholder="tuliskan kode partnya">
                    <!-- menginput dropdown utuk kategori yang sudah di relasikan -->
                    <select name="id_kategori" class="form-control mb-4">
                        <option value="">Pilih kategori</option>
                        @foreach($kategori as $items)
                        <option value="{{ $items->id }}">{{ $items->nama_kategori }}</option>
                        @endforeach
                    <input type="text" name="nama_sukucadang" class="mb-4 form-control" autocomplete="off"
                        placeholder="Apa nama partnya">
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
                        <th>Kode part</th>
                        <th>Kategori</th>
                        <th>Nama part</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($part as $index => $items)
                    <tr data-nomor="{{ $index + 1 }}">
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $items->kode_sukucadang }}
                        </td>
                        <td>
                            {{ $items->kategori->nama_kategori }}
                        </td>
                        <td>
                            {{ $items->nama_sukucadang }}
                        </td>
                        <td>
                            <form action="{{ route('part.destroy', $items->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('part.edit', $items->id) }}" class="btn btn-primary">
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