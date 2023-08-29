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
                <td>{{ $dataApp->instansi->nama_instansi }}</td>
                <th>Nama Product</th>
                <td>:</td>
                <td>{{$dataApp->produk->nama_produk}}</td>
            </tr>
            <tr>
                <th>Serial Number</th>
                <td>:</td>
                <td>{{ $dataApp->serial_number }}</td>
                <th>Kode Product</th>
                <td>:</td>
                <td>{{ $dataApp->produk->kode_produk }}</td>
            </tr>

            <tr>
                <th>Merek</th>
                <td>:</td>
                <td>{{ $dataApp->merek->nama_merek }}</td>
                <th>Instalasi</th>
                <td>:</td>
                <td>{{ $dataApp->tahun_pemasangan }}</td>
            </tr>
            <tr>
                <th>Status Alat</th>
                <td>:</td>
                <td>{{$dataApp->keterangan}}</td>
            </tr>
        </table>
    </div>
</div>

<!-- buat form untuk atur jadwal teknisi -->
<div class="card shadow border-left-primary">
    <form action="{{route('jadwal.store')}}" method="post" class="p-4">
        @csrf
        <div class="row gap-2">
            <div class="form-group col-md-6">
                <label for="">pilih teknisi yang pergi</label>
                <select name="id_user" id="" class="form-control">
                    <option value="">pilih teknisi</option>
                    @foreach($teknisi as $items)
                    <option value="{{$items->id}}">{{$items->nama_user}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="">tanggal</label>
                <input type="date" name="jadwal" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">instansi</label>
                
                <input type="text" name="id_instansi" value="{{$dataApp->instansi->id}}" readonly hidden>
                <input type="text" name="id_peralatan" value="{{$dataApp->id}}" readonly hidden>
                <input type="text"  value="{{$dataApp->instansi->nama_instansi}}" readonly class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="">keluhan</label>
                <input type="text" name="keluhan" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label for="">renaca tindakan</label>
                <textarea type="text" name="renaca_tindakan" class="form-control"></textarea>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">testing</button>
    </form>
</div>
@endsection