@extends('layouts.main-view')
@section('title', 'laporan page')
@section('content')

<div class="card shadow p-3">
    <div class="table-responsive p-3">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td>Instansi</td>
                    <td>tanggal Kunjungan</td>
                    <td>serial number</td>
                    <td>Teknisi</td>
                    <td>Informasi Kunjungan</td>
                    <td>Kesimpulan</td>
                    <td>action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($survey as $s)
                <tr>
                    <td>{{$s->peralatan->instansi->nama_instansi}}</td>
                    @if($s->peralatan->update_at != null)
                    <td>{{ $s->peralatan->update_at->format('Y-m-d') }}</td>
                    @else
                    <td>{{ $s->peralatan->created_at->format('Y-m-d') }}</td>
                    @endif
                    <td>{{$s->peralatan->serial_number}}</td>
                    <td>{{$s->user->nama_user}}</td>
                    <td>{{$s->hasil_kunjungan}}</td>
                    <td>{{$s->kesimpulan_kunjungan}}</td>
                    <td>
                        <a href="#" class="btn btn-primary">edit</a>
                        <form action="#" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection