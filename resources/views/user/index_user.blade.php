@extends('layouts.main-view')
@section('content')
<style>
    .single-line {
        max-width: 500px;
        max-height: 1.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        }
</style>

@if(Auth::user()->level != 'pic_rs')
<a href="{{route('users.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data User</a>
@endif
<!-- Progress DataTales -->
<div class="card shadow my-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Nama</th>
                        <th>level</th>
                        <th>Role</th>
                        <th>alamat</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>No Telp</th>
                        <th>Instansi</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->reverse() as $users)
                    <tr>
                        <td>{{ $users->name }}</td>
                        <td>{{$users->level}}</td>
                        <td>{{$users->role}}</td>
                        <td class="single-line">{{$users->alamat}}</td>
                        <td>{{$users->email}}</td>
                        <td>{{$users->jenis_kelamin}}</td>
                        <td>
                            {{$users->no_telp}}
                        </td>
                        <!-- jika sudah ada data maka tampilkan jika belum maka tampilkan tulisan belum ada ifelse satu baris -->
                        <td>
                            @if($users->instansi)
                            {{$users->instansi->instasi}}
                            @elseif($users->level != 'pic_rs')
                            User Bukan PIC
                            @else
                            Belum ada
                            @endif
                        </td>
                        <td>
                            <!-- membuat viw untuk mengapusa data beserta actionnya-->
                            <form action="{{ route('users.destroy', $users->id) }}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <a href="{{ route('user.edit', $users->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash text-white"></i>
                                </button>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection