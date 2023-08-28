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

<!-- buat form untuk atur jadwal teknisi -->
<div class="card shadow border-left-primary">
    <form action="" method="post" class="p-4">
        <div class="row gap-2">
            <div class="form-group col-md-6">
                <label for="">pilih teknisi yang pergi</label>
                <input type="text" name="id_user" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">test</label>
                <input type="date" name="jadwal" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">test</label>
                <input type="text" name="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">test</label>
                <input type="text" name="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">test</label>
                <input type="text" name="" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">test</label>
                <input type="text" name="" class="form-control">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">testing</button>
            </div>
        </div>
    </form>
</div>
@endsection