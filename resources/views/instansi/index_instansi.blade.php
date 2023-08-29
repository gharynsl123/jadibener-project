@extends('layouts.main-view')

@section('content')
<style>
.single-line {
    max-width: 300px;
    max-height: 1.09rem;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>

@if(Auth::user()->level == 'admin')


<div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 d-none text-gray-800 d-sm-inline-block">Data Rumah Sakit</h1>
    <div class=" d-sm-inline-block">
        <a href="{{route('instansi.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data RS</a>
    </div>
</div>

<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" class="form-control">
    <br>
    <button class="btn btn-success">Import User Data</button>
</form>

<!-- Progress DataTales -->
<div class="card shadow my-4 border-left-primary">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Nama Instansi</th>
                        <th>Alamat</th>
                        <th>Jenis</th>
                        <th>Jumlah kasur</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instansi->reverse() as $items)
                    <!-- Add '->reverse()' after '$instansi' to reverse the order -->
                    <tr>
                        <td>{{$items->nama_instansi}}</td>
                        <td class="single-line">{{$items->alamat_instansi}}</td>
                        <td>{{$items->jenis_instansi}}</td>
                        <td>{{$items->jumlah_kasur}}</td>
                        <td>
                            <!-- membuat form delet -->
                            <form action="{{ route('instansi.destroy', $items->id) }}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <a href="{{ route('instansi.show', $items->id) }}" class="btn btn-primary">
                                    <i class="fa fa-eye text-white"></i>
                                </a>
                                <!-- edit -->
                                <a href="{{route('instansi.edit', $items->id)}}" class="btn btn-warning">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
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
</div>
@endif

@endsection