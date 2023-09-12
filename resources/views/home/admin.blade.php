@extends('layouts.main-view')

@if (Auth::user()->level == 'pic')

@section('content')
@include('profile.rumah_sakit')
@endsection

@elseif(Auth::user()->level == 'teknisi')

@include('home.teknisi')

@elseif(Auth::user()->level == 'surveyor')

@section('content')
@include('peralatan.index_peralatan')
@endsection

@else
@section('content')
<!-- Page Heading -->
<div class="d-flex justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Status Service</h1>
    <button id="button-gate" class="btn d-flex align-items-center">
        <small class="mx-3">hide</small>
        <i class="fa fa-arrow-up"></i>
    </button>
</div>
<div id="gate-service">
    <marquee behavior="" direction="">tetststets</marquee>
    <div class="row gap-2">
        <div class="col-md-3 my-1">
            <div class="card d-flex text-center border-left-success" style="min-height: 150px; padding: 10px;">
                <h3 id="doneCount">0</h3>
                <p class="fix-bottom m-0">
                    Tickets Solved
                </p>
            </div>
        </div>
        <div class="col-md-3 my-1">
            <div class="card text-center border-left-warning" style="min-height: 150px; padding: 10px;">
                <h3 id="prosesCount">0</h3>
                <p class="fix-bottom m-0">
                    Tickets On Process
                </p>
            </div>
        </div>

        <div class="col-md-3 my-1">
            <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
                <h3 id="pendingCount">0</h3>
                Tickets Waiting Approval By Admin
            </div>
        </div>

        <div class="col-md-3 my-1">
            <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
                <h3 id="processTicketCount">0</h3>
                <p class="fix-bottom m-0">
                    Tickets Pengajuan Keseluruhan
                </p>
            </div>
        </div>
    </div>
</div>

<div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Request Approval </h1>
    <div class="d-none d-sm-inline-block">
        <a href="{{url('/progress')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-ticket fa-sm text-white-50"></i> all list Tikect</a>
    </div>
</div>

<!-- table untuk mengabil data pengajuan -->
<div class="card shadow mb-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start"></th>
                        <th>Tanggal Proses</th>
                        <th>Instansi</th>
                        <th>reported by</th>
                        <th>Serial number</th>
                        <th>Kategori</th>
                        <th>Product Name</th>
                        <th>Status</th>
                        <th>kondisi</th>
                        <th class="th-end">approve</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data akan dimuat melalui AJAX -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {

    function getPengajuan() {
        $.ajax({
            type: "GET",
            url: "/get-pengajuan",
            success: function(data) {
                $('#dataTable tbody').empty();

                console.log(data)
                $.each(data, function(index, item) {
                    var row = `
                        <tr>
                            <td>
                                <a href="/peralatan/${item.slug}" class="btn btn-info">
                                    <i class="fa fa-eye text-white"></i>
                                </a>
                            </td>
                            <td>${item.created_at}</td>
                            <td>${item.nama_instansi}</td>
                            <td>${item.nama_user}</td>
                            <td>${item.serial_number}</td>
                            <td>${item.nama_kategori}</td>
                            <td>${item.nama_produk}</td>
                            <td>${item.nama_kondisi}</td>
                            <td>${item.status_pengajuan}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <form class="update-form" action="{{ route('pengajuan.update', '') }}/${item.id}" method="post">
                                        @csrf
                                        {{ method_field('POST') }}
                                        <input type="text" name="status_pengajuan" value="approved" hidden>
                                        <button type="submit" class="btn btn-success">
                                            <i class="fa fa-thumbs-up text-white"></i>
                                        </button>
                                    </form>
                                    <form class="update-form" action="{{ route('pengajuan.update', '') }}/${item.id}" method="post">
                                        @csrf
                                        {{ method_field('POST') }}
                                        <input type="text" name="status_pengajuan" value="rejected" hidden>
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-thumbs-down text-white"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>`;
                    $('#dataTable tbody').append(row);
                });

            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat mengambil data pengajuan.');
            }
        });
    }

    // Panggil fungsi untuk pertama kali saat halaman dimuat
    getPengajuan();

    $('.update-form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                alert('Status pengajuan berhasil diperbarui.');
                getPengajuan();

            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat mengupdate status pengajuan.');
            }
        });
    });

    function updatePendingCount() {
        $.ajax({
            type: "GET",
            url: "/get-pending-count",
            success: function(response) {
                $('#pendingCount').text(response.count + ' ticket');
            }
        });
    }

    updatePendingCount();

    function updateDoneCount() {
        $.ajax({
            type: "GET",
            url: "/get-selesai-count",
            success: function(response) {
                $('#doneCount').text(response.count + ' ticket');
            }
        });
    }

    updateDoneCount();

    function updateProsesCount() {
        $.ajax({
            type: "GET",
            url: "/get-proses-count",
            success: function(response) {
                $('#prosesCount').text(response.count + ' ticket');
            }
        });
    }

    updateProsesCount();

    function updateProcessTicketCount() {
        $.ajax({
            type: "GET",
            url: "/get-process-ticket-count",
            success: function(response) {
                $('#processTicketCount').text(`${response.count} ticket`);
            }
        });
    }

    updateProcessTicketCount();

    var buttonGate = document.getElementById("button-gate");
    var gateService = document.getElementById("gate-service");

    buttonGate.addEventListener("click", function() {
        if (gateService.style.display === "none") {
            gateService.style.display = "block";
            gateService.style.maxHeight = null;
            buttonGate.innerHTML = '<small class="mx-3">hide</small><i class="fa fa-arrow-up"></i>';
        } else {
            gateService.style.display = "none";
            gateService.style.maxHeight = gateService.scrollHeight + "px";
            buttonGate.innerHTML = '<small class="mx-3">show</small><i class="fa fa-arrow-down"></i>';
        }
    });
});
</script>
@endsection
@endif
