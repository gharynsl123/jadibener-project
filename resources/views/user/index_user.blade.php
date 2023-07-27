@extends('layouts.main-view')
@section('content')

<a href="{{route('users.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data User</a>

<!-- Progress DataTales -->
<div class="card shadow my-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Nama PIC</th>
                        <th>level</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->reverse() as $users)
                    <tr>
                        <td>{{ $users->name }}</td>
                        <td>{{$users->level}}</td>
                        <td>{{$users->role}}</td>
                        <td>{{$users->email}}</td>
                        <td>
                            {{$users->no_telp}}
                        </td>
                        <td>
                            <!-- membuat viw untuk mengapusa data beserta actionnya-->
                            <form action="" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <a href="#" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash text-white"></i>
                                </button>
                            </form>

                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection