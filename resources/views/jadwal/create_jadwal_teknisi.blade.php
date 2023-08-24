@extends('layouts.main-view')

@section('title', 'atur jadwal teknisi')
@section('content') 
<div class="card shadow mb-3">
    <div class="card-header bg-info">
        <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT</p>
    </div>
    <div class="card-body">
        <table class="table table-responsive table-borderless">
            <tr>
                <th>Instansi</th>
                <td>:</td>
                <td>{{ $dataApp->peralatan->instansi->nama_instansi }}</td>
                <th>Nama Product</th>
                <td>:</td>
                <td>{{$dataApp->peralatan->produk->nama_produk}}</td>
            </tr>
            <tr>
                <th>Serial Number</th>
                <td>:</td>
                <td>{{ $dataApp->peralatan->serial_number }}</td>
                <th>Kode Product</th>
                <td>:</td>
                <td>{{ $dataApp->peralatan->produk->kode_produk }}</td>
            </tr>

            <tr>
                <th>Merek</th>
                <td>:</td>
                <td>{{ $dataApp->peralatan->merek->nama_merek }}</td>
                <th>Instalasi</th>
                <td>:</td>
                <td>{{ $dataApp->peralatan->tahun_pemasangan }}</td>
            </tr>
            <tr>
                <th>Status Alat</th>
                <td>:</td>
                <td>{{$dataApp->peralatan->keterangan}}</td>
            </tr>
        </table>
    </div>
</div>
@endsection