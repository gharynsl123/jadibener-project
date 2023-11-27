@extends('layouts.main-view')
@section('title', 'Permintaan menjadi member')
@section('content')
<style>
    .notification-slide-right {
    position: fixed;
    top: 80px;
    right: -100%; /* Mengatur awal posisi di luar layar */
    transition: right 0.3s ease-in-out; /* Efek slide selama 0.3 detik */
    z-index: 9999;
}

.notification-slide-right.show {
    right: 0; /* Muncul ke posisi 0 */
}

</style>


<div id="notification" class="notification-slide-right">
    @if(session('success'))
        <div class="btn btn-sm me-5 btn-success alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
</div>

<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block">Request Member</h1>
</div>
<div class="card shadow border-left-primary">
    <div class="table-responsive p-3">
        <table class="table table-hover" id="dataTable">
            <thead>
                <tr>
                    <th>Instansi</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Kelamin</th>
                    <th>Departement</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($member as $item)
                <tr>
                    <td>{{$item->instansi}}</td>
                    <td>{{$item->nama_user}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->nomor_telepon}}</td>
                    <td>{{$item->jenis_kelamin}}</td>
                    <td>{{$item->departement}}</td>
                    <td style="display: flex; gap: 5px">
                        <a href="{{ route('approve', $item->id) }}" class="btn btn-sm btn-primary">ok</a>
                        <a href="{{ route('reject', $item->id) }}" class="btn btn-sm btn-primary">no</a>
                        <a data-toggle="modal" data-target="#memberUser" href="{{ route('detail.member', $item->id) }}" class="btn btn-sm btn-primary btn-detail" data-member-id="{{ $item->id }}">Detail</a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>



<!-- Modal Member -->
<div class="modal fade" id="memberUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail dari member</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="memberDetail">
                    <h4>Nama: <span id="detailNama"></span></h4>
                    <p>password: <span id="password"></span></p>
                    <p>Email: <span id="detailEmail"></span></p>
                    <p>Nomor Telepon: <span id="detailNomorTelepon"></span></p>
                    <p>Jenis Kelamin: <span id="detailJenisKelamin"></span></p>
                    <p>alamat: <span id="alamatRs"></span></p>
                    <p>Departemen: <span id="detailDepartemen"></span></p>
                    <p>Masalah: <span id="detailMasalah"></span></p>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Menangani klik tombol "detail" dan mengambil data detail dari server
$(document).on('click', 'a.btn-detail', function (e) {
    e.preventDefault();

    var memberId = $(this).data('member-id');
    var url = "/detail-member/" + memberId; // Atur URL dengan benar

    // Lakukan permintaan AJAX untuk mengambil data detail member
    $.ajax({
        url: url,
        method: "GET",
        success: function (data) {
            $('#detailNama').text(data.nama_user);
            $('#password').text(data.password);
            $('#detailEmail').text(data.email);
            $('#detailNomorTelepon').text(data.nomor_telepon);
            $('#detailJenisKelamin').text(data.jenis_kelamin);
            $('#detailDepartemen').text(data.departement);
            $('#detailMasalah').text(data.ajukan_permasalahan ?? 'tidak ada');
            $('#alamatRs').text(data.alamat_instansi ?? 'tidak ada');

            $('#memberUser').modal('show');
        }
    });

});


</script>
@endsection