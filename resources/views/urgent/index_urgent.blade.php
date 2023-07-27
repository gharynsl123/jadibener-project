@extends('layouts.main-view')
@section('content')
<!-- Page Heading -->
<a data-toggle="modal" data-target="#inputUrgently" data-target="#inputUrgently"
    class="d-sm-inline-block mb-4 btn btn-sm btn-success shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i>Tambahkan Urgently</a>

<!-- Logout Modal-->
<div class="modal fade" id="inputUrgently" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Urgently</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('urgent.store')}}" method="post">
                    @csrf
                    <input type="text" name="nama_kondisi" class="mb-4 form-control" autocomplete="off"
                        placeholder="Nama Kondisi">
                    <input type="text" name="waktu" class="mb-4 form-control" autocomplete="off"
                        placeholder="Berikan Waktu">
                    <button class="btn btn-primary" type="submit">Input</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- table untuk menambilkan datany -->
<div class="card border-left-primary shadow mb-4">
    <div class="p-0">
        <div class="table-responsive">
            <table class="table table-hover m-0" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Urgently</th>
                        <th>Waktu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($urgent as $index => $items)
                    <tr data-nomor="{{ $index + 1 }}">
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td>
                            {{ $items->nama_kondisi}} 
                        </td>
                        <td>
                            {{ $items->waktu }} hari
                        </td>
                        <td>
                            <form action="{{ route('urgent.destroy', $items->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger">
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