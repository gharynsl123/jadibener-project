@extends('layouts.main-view')

@section('title', 'Profile User')

@section('content')

<div class="row gap-2">
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
                        <td>{{$user->nama_user}}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>:</td>
                        <!-- if null buat percabangan dalam satu baris-->
                        <td>{!! $user->alamat_user ? $user->alamat_user : 'Belum diisi' !!}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>:</td>
                        <td>{{$user->jenis_kelamin ? $user->jenis_kelamin : 'Belum diisi'}}</td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    @if (Auth::user()->level != 'pic')
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
                        <td>{{$user->nomor_telepon ? $user->nomor_telepon  : 'Belum diisi'}}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>:</td>
                        <td>{{$user->level}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @else
    @if($user->instansi)
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
                        <td>{{ $user->instansi->nama_instansi }}</td>
                    </tr>
                    <tr>
                        <th>No telepon</th>
                        <td>:</td>
                        <td>{{$user->nomor_telepon}}</td>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <td>:</td>
                        <td>{{$user->level}}</td>
                    </tr>
                    <tr>
                        <th>Departement</th>
                        <td>:</td>
                        <td>{{$user->departement}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @else
    User Belum Memegang Rumah Sakit
    @endif
    @endif
</div>

<div class="mt-3">
    @if (Auth::user()->level == 'teknisi')
        @if ($latestRequest && $latestRequest->state == 'pending')
            <button class="btn btn-secondary" disabled>Tunggu Aksi dari Admin</button>
        @else
            <form action="{{ route('req.store', $user->id) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Surveyor Request</button>
            </form>
            <small>dengan menekan tombol ini kamu akan mengirim request ke pada admin untuk menjadi surveyor dalam waktu 12 jam.</small>
        @endif
    @endif
</div>
@endsection 