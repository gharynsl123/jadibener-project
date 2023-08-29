@extends('layouts.main-view')
@section('content')

<!-- table menggunakan dataTable -->
<div class="card p-2 shadow border-left-primary">
    <div class="table-responsive">
        <table class="table table-borderless table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>instansi</th>
                    <th>keluhan</th>
                    <th>teknisi yang di pilih</th>
                    <th>datang pada tanggal</th>
                    <th>rencana tindakan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jadwal as $items)
                <tr>
                    <td>{{$items->peralatan->instansi->nama_instansi}}</td>
                    <td>{{$items->keluhan}}</td>
                    <td>{{$items->user->nama_user}}</td>
                    <td>{{$items->jadwal}}</td>
                    <td>{{$items->renaca_tindakan}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection