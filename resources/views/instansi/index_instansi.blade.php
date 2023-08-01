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
                        <th>status</th>
                        <th>kelas</th>
                        <th>photo</th>
                        <th class="th-end">action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($instansi->reverse() as $instansis)
                    <!-- Add '->reverse()' after '$instansi' to reverse the order -->
                    <tr>
                        <td>{{$instansis->instasi}}</td>
                        <td>{{$instansis->alamat}}</td>
                        <td>{{$instansis->status}}</td>
                        <td>{{$instansis->kelas}}</td>
                        <td>
                            <img src="" alt="photo rs">
                        </td>
                        <td>
                            <!-- detail -->
                            <!-- membuat form delet -->
                            <form action="{{ route('instansi.destroy', $instansis->id) }}" method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <a href="{{ route('instansi.show', $instansis->id) }}" class="btn btn-info">
                                    <i class="fa fa-eye text-white"></i>
                                </a>
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