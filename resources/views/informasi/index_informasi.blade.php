@extends('layouts.main-view')

@section('content')
<style>
.max-line-5 {
    max-width: 500px;
    max-height: 7rem;
    display: -webkit-box;
    -webkit-line-clamp: 4;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-none d-sm-inline-block"> Informasi Terkini
    </h1>

    <a data-toggle="modal" data-target="#inputinformasi" data-target="#inputinformasi"
        class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahakn Informasi</a>


    <!-- Logout Modal-->
    <div class="modal fade" id="inputinformasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambahkan Informasi Apa? </h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('informasi.store')}}" method="post">
                        @csrf
                        <input type="text" name="judul_informasi" require class="mb-4 form-control" autocomplete="off"
                            placeholder="Judulnya">
                        <!-- text are untuk isi dari informasi -->
                        <textarea id="" require cols="30" rows="10" name="deskripsi_informasi"
                            class="form-control mb-4">input your text here</textarea>
                        <button class="btn btn-primary" type="submit">Input</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row gap-2">
    @foreach($informasi as $items)
    <div class="col-md-6">
        <a href="{{route('informasi.show', $items->id)}}" class="text-decoration-none">
            <div class="card shadow p-2 mb-4">
                <p class="text-dark text-capitalize font-weight-bold">{{$items->judul_informasi}}</p>
                <p class="text-dark isi max-line-5">{{$items->deskripsi_informasi}}</p>
                <div class="d-flex justify-content-end mt-3">
                    <a href="#" class="btn m-1 btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Edit informasi">
                        <i class="fa fa-pen-to-square"></i>
                    </a>
                    <a href="" class="btn m-1 btn-danger" class="btn m-1 btn-primary" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Hapus Info"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection