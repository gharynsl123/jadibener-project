@extends('layouts.main-view')

@section('title', 'User Configuration')

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
    
<a data-toggle="modal" data-target="#importUser" class="d-sm-inline-block btn btn-sm btn-success shadow-sm">
    <i class="fas fa-file-import fa-sm text-white-50"></i> Import Data User</a>
@endif

<!-- Logout Modal-->
<div class="modal fade" id="importUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data User</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('import.user') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                    @csrf
                    <div class="d-flex">
                        <input type="file" required name="file">
                        <button class="btn btn-secondary" type="submit">Import Data</button>
                    </div>
                    <small>format file Xsl, CSV</small>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card shadow my-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">detail</th>
                        <th>Nama</th>
                        <th>Level</th>
                        <th>Role/Departemen</th>
                        <th>Email</th>
                        <th>Instansi</th>
                        <th class="th-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($user->reverse() as $users)
                    <tr>
                        <td>
                        <a class="btn-de" data-id="{{ $users->id }}">
                            <i class="fas fa-angle-right"></i>
                        </a>
                        </td>
                        
                        <td>
                            {{ $users->nama_user }}
                        </td>
                        <td>{{ $users->level }}</td>
                        <td>
                            @if($users->role)
                                {{ $users->role }}
                            @elseif($users->departement)
                                {{ $users->departement }}
                            @elseif(in_array($users->level, ['pic', 'teknisi']))
                                Belum ada
                            @else
                                <p class="text-danger">Default user tidak memiliki role</p>
                            @endif
                        </td>
                        <td>{{ $users->email }}</td>
                        <td>
                            @if($users->instansi)
                                {{ $users->instansi->nama_instansi }}
                            @elseif($users->level != 'pic')
                                <p class="text-danger">User Bukan PIC</p>
                            @else
                                Belum ada
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $users->id) }}" method="POST">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('user.edit', $users->id) }}" class="btn btn-warning">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus {{$users->nama_user}} ini?')" class="btn btn-danger">
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
<script>
$(document).ready(function () {
    var table = $('#dataTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": -1 } // Menonaktifkan pengurutan pada kolom terakhir (tombol lihat)
        ],
    });

    $('#dataTable tbody').on('click', 'a.btn-de', function () {
        var row = table.row($(this).parents('tr'));
        var userId = $(this).data('id');

        if (row.child.isShown()) {
            // Tutup child row jika sudah terbuka
            row.child.hide();
            $(this).find('i').removeClass('fa-angle-down').addClass('fa-angle-right');
        } else {
            // Ambil informasi tambahan dari server (misalnya, dengan AJAX)
            $.ajax({
                url: '/user/' + userId + '/details', // Ganti dengan URL yang sesuai
                method: 'GET',
                success: function (data) {
                    // Tampilkan informasi tambahan dalam child row
                    row.child(data).show();
                },
            });
            $(this).find('i').removeClass('fa-angle-right').addClass('fa-angle-down');
        }
    });
});
</script>

@endsection
