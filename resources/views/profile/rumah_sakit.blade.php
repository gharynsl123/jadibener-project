@extends('layouts.main-view')

@section('content')
@if($instansi == null)
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block d-flex mb-4">Kamu Belum Menangani Rumah Sakit</h1>
@else
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block mb-4"> Profile Rumah Sakit</h1>

@foreach ($instansi as $items)
<div class="card shadow border-0 ">
    <div class="row">
        <div class="col-md-3 d-flex justify-content-center">
            <img src="{{asset('image/yarsi.jpg')}}" alt="Hospital Logo" class="img-fluid rounded" style="width: 100%;">
        </div>
        <div class="col-md-9 my-4 px-4">
            <h4 class="mb-3">{{$items->instasi}}</h4>
            <p>
                <strong>Alamat:</strong>
                {{$items->alamat}}
            </p>
            <div>
                <strong>PIC:</strong> {{$items->users->name}}
            </div>
            <div class="contact-info">
                <strong>HP:</strong> {{$items->users->no_telp}}<br>
                <strong>Email:</strong> {{$items->users->email}}
            </div>
        </div>
    </div>
</div>

<div class="card border-left-primary mt-5">
    <div class="card-header">BUSINESS INFORMATION</div>
    <div class="card-body">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td>JUMLAH BED</td>
                    <td>:</td>
                    <td>{{$items->jumlah_kasur}}</td>
                </tr>
                <tr>
                    <td>KELAS</td>
                    <td>:</td>
                    <td>{{$items->kelas}}</td>
                </tr>
                <tr>
                    <td>STATUS</td>
                    <td>:</td>
                    <td>{{$items->status}}</td>
                </tr>
                <tr>
                    <td>NO. MEMBER</td>
                    <td>:</td>
                    <td>JKU 0001 RSU</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endif
@endsection
