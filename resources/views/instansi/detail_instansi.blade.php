@extends('layouts.main-view')

@section('content')
<!-- mengabil detail data user mengunakan card-->
<div class="card shadow">
    <div class="card-header bg-info">
        <p class="m-0 text-white font-weight-bolder">Detail Instansi</p>
    </div>
    <div class="card-body">
        @foreach ($user as $items)
        <table class="table table-borderless">
            <tr>
                <th>Nama Instansi</th>
                <td>:</td>
                <td>{{$items->instansi}}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>:</td>
                <td>{{$user->alamat}}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>:</td>
                <td>{{$user->status}}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>:</td>
                <td>{{$user->kelas}}</td>
            </tr>
            <tr>
                <th>Photo</th>
                <td>:</td>
                <td>
                    <img src="" alt="photo rs">
                </td>
            </tr>
        </table>
        @endforeach
    </div>
</div>
@endsection