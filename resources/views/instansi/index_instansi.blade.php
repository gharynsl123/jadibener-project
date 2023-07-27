@extends('layouts.main-view')

@section('content')

@if(Auth::user()->level == 'admin')
<div class="d-none d-sm-inline-block mb-4">
    <a href="{{route('instansi.create')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Tambahkan Data RS</a>
</div>


<p>Data Instansi</p>
<!-- Progress DataTales -->
<div class="card shadow my-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Instansi</th>
                        <th>Alamat</th>
                        <th>PIC</th>
                        <th>Email</th>
                        <th>No Telp</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($instansi->reverse() as $instansi)
                    <!-- Add '->reverse()' after '$instansi' to reverse the order -->
                    <tr>
                        <td>{{$instansi->instasi}}</td>
                        <td>{{$instansi->alamat}}</td>
                        <td>{{$instansi->users->name}}</td>
                        <td>{{$instansi->users->email}}</td>
                        <td>
                            098712638
                        </td>
                        <td>
                            <!-- membuat form delet -->
                            <form action="{{ route('instansi.destroy', $instansi->id) }}" method="POST">
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
@endif

@endsection