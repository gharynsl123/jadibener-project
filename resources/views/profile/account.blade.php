@extends('layouts.main-view')

@section('content')

<div class="row gap-2">
    @foreach ($user as $items)
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">Personal Information</p>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Nama</th>
                        <td>:</td>
                        <td>{{$items->name}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <!-- if null buat percabangan dalam satu baris-->
                        <td>{{ $items->alamat ? $items->alamat : 'Belum diisi' }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>:</td>
                        <td>{{$items->jenis_kelamin ? $items->jenis_kelamin : 'Belum diisi'}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    @endforeach
    @if (Auth::user()->level != 'pic_rs')
    @foreach ($user as $items)
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">Business Information</p>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Instansi</th>
                        <td>:</td>
                        <td>You are not pic here</td>
                    </tr>
                    <tr>
                        <th>No telepon</th>
                        <td>:</td>
                        <td>{{$items->no_telp ? $items->no_telp  : 'Belum diisi'}}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>:</td>
                        <td>{{$items->level}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endforeach
    @foreach ($instansi as $items)
    <div class="col-md-6">
        <div class="card shadow">
            <div class="card-header bg-info">
                <p class="m-0 text-white font-weight-bolder">Business Information</p>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr>
                        <th>Instansi</th>
                        <td>:</td>
                        <td>{{ $items->instasi }}</td>
                    </tr>
                    <tr>
                        <th>No telepon</th>
                        <td>:</td>
                        <td>{{$items->no_telp}}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>:</td>
                        <td>{{$items->level}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    @endforeach
    @endif
</div>

@endsection