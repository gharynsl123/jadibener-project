@extends('layouts.main-view')

@section('title', 'Instansi')

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
        <a href="{{route('instansi.create')}}" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data RS</a>
        <a href="/instansi-cetak-pdf" target="_blank" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-file fa-sm text-white-50"></i> cetak pdf</a>
        <a data-toggle="modal" data-target="#importdata" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-file-import fa-sm text-white-50"></i> Import Data</a>
    </div>
</div>
@endif

<!-- Logout Modal-->
<div class="modal fade" id="importdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Rumah Sakit</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import.instansi') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex ">
                        <input type="file" required name="file">
                        <button class="btn btn-secondary" type="submit">Import Data</button>
                    </div>
                    <small>format file Xsl, CSV</small>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Progress DataTales -->
<div class="card shadow my-4 border-left-primary">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Nama Instansi</th>
                        <th>province</th>
                        <th>Alamat</th>
                        <th>Jenis</th>
                        <th>Jumlah kasur</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instansi as $items)
                        @if(Auth::user()->level == 'surveyor')
                            @if($items->jumlah_kasur)
                                <tr>
                                    <td>{{$items->nama_instansi}}</td>
                                    <td>{{$items->provinsi}}</td>
                                    <td class="single-line">{!!$items->alamat_instansi!!}</td>
                                    <td>{{$items->jenis_instansi}}</td>
                                    <td>{{$items->jumlah_kasur}}</td>
                                    <td>
                                        <!-- Membuat form delete -->
                                        <form action="{{ route('instansi.destroy', $items->id) }}" method="POST">
                                            @csrf
                                            {{method_field('DELETE')}}
                                            <a href="{{ route('instansi.show', $items->id) }}" class="btn btn-primary">
                                                <i class="fa fa-eye text-white"></i>
                                            </a>
                                            <!-- Edit -->
                                            <a href="{{route('instansi.edit', $items->id)}}" class="btn btn-warning">
                                                <i class="fa fa-pen-to-square"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus {{$items->nama_instansi}} ini?')">
                                                <i class="fa fa-trash text-white"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @else
                            <tr>
                                <td>{{$items->nama_instansi}}</td>
                                 <td>{{$items->provinsi}}</td>
                                <td class="single-line">{!!$items->alamat_instansi!!}</td>
                                <td>{{$items->jenis_instansi}}</td>
                                <td>{{ !empty($items->jumlah_kasur) ? $items->jumlah_kasur : 0 }}</td>
                                <td>
                                    <!-- Membuat form delete -->
                                    <form action="{{ route('instansi.destroy', $items->id) }}" method="POST">
                                        @csrf
                                        {{method_field('DELETE')}}
                                        <a href="{{ route('instansi.show', $items->id) }}" class="btn btn-primary">
                                            <i class="fa fa-eye text-white"></i>
                                        </a>
                                        <!-- Edit -->
                                        <a href="{{route('instansi.edit', $items->id)}}" class="btn btn-warning">
                                            <i class="fa fa-pen-to-square text-white"></i>
                                        </a>
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus {{$items->nama_instansi}} ini?')">
                                            <i class="fa fa-trash text-white"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#dataTable').DataTable({
        "language": {
            "search": "Search by Provinsi / Name:" // Mengganti label pencarian
        }
    });
});
</script>

@endsection