@extends('layouts.main-view')

@section('title', 'Status Service')

@section('content')
<h2>Status Service</h2>
<div class="table-responsive p-3 mt-4 card shadow border-left-primary">
    <table class="table" id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Id Pengajuan</th>
                <th>dikerjakan oleh</th>
                <th>instansi</th>
                <th>Jadwal</th>
                <th>kategori</th>
                <th>nama produk</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($progressList as $index => $progress)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>
                    <a href="/pengajuan/{{$progress->pengajuan->slug}}"
                        class="btn btn-primary">{{$progress->pengajuan->id_pengenal}}</a>
                </td>
                <td>{{ $progress->users->nama_user }}</td>
                <td>{{ $progress->pengajuan->peralatan->instansi->nama_instansi }}</td>
                <td>{{ $progress->pengajuan->created_at }}</td>
                <td>{{ $progress->pengajuan->peralatan->kategori->nama_kategori }}</td>
                <td>{{ $progress->pengajuan->peralatan->produk->nama_produk }}</td>
                <td>
                    {{ $progress->history->first()->status_history ?? $progress->pengajuan->status_pengajuan }}
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection