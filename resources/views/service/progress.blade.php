@extends('layouts.main-view')

@section('title', 'Pengajuan Keluhan')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Progress Perbaikan
    </h1>
    <div class="d-none d-sm-inline-block">
        <a href="{{url('peralatan')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-ticket fa-sm text-white-50"></i> Ajukan Perbaikan</a>
    </div>
</div>


<!-- Progress DataTales -->
<div class="card shadow mb-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start"></th>
                        <th>Tanggal Proses</th>
                        <th>Instansi</th>
                        <th>Serial number</th>
                        <th>Kategori</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th class="th-end">feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan->reverse() as $items)
                    <tr>
                        <td>
                            <!-- for go to detail -->
                            <a href="#" class="btn btn-info">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                        </td>
                        <td>{{$items->created_at}}</td>
                        <td>{{$items->peralatan->instansi->instasi}}</td>
                        <td>{{$items->peralatan->serial_number}}</td>
                        <td>{{$items->peralatan->kategori->nama_kategori}}</td>
                        <td>{{$items->peralatan->produk->nama_produk}}</td>
                        <td>{{$items->status}}</td>
                        <td>
                            <div class="progress">
                                <div class="progress-bar" style="width: 75%;">75%</div>
                            </div>
                        </td>
                        <td>
                            <!-- untuk feedback good or bad -->
                            <div class="d-flex justify-content-between">
                                <a href="#" class="btn btn-success">
                                    <i class="fa fa-thumbs-up text-white"></i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                    <i class="fa fa-thumbs-down text-white"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection