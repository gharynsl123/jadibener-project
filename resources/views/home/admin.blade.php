@extends('layouts.main-view')

@section('title', 'Home')

@if (Auth::user()->level == 'pic')

@section('content')
@include('profile.rumah_sakit')
@endsection

@elseif(Auth::user()->level == 'teknisi')

@include('home.surveyor')

@elseif(Auth::user()->level == 'surveyor')

@section('content')
@include('home.surveyor')
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
    <div class="row gap-2">
        <!-- Earnings (Annual) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('status.index')}}" class="text-decoration-none card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Tickets Solved</div>
                            <div id="doneCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <!-- Tasks Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{route('progres.index')}}" class="text-decoration-none card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tickets On Process
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div id="prosesCount" class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="#table-request" class="text-decoration-none card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Tickets Waiting Approval By Admin</div>
                            <div id="pendingCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Tickets Pengajuan Keseluruhan</div>
                            <div id="processTicketCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-1 col-md-6">
            <div class="card shadow">
                Puas Dengan Servicenya
            </div>
        </div>
        <div class="my-1 col-md-6">
            <div class="card shadow">
                Kurang puas dengan servicenya
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
<div class="card shadow mb-4" id="table-request">
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
                    @foreach($pengajuan as $item)
                    <tr>
                        <td>
                            <a href="pengajuan/{{$item->slug}}" class="btn btn-info">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                        </td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->peralatan->instansi->nama_instansi}}</td>
                        <td>{{$item->user->nama_user}}</td>
                        <td>{{$item->peralatan->serial_number}}</td>
                        <td>{{$item->peralatan->kategori->nama_kategori}}</td>
                        <td>{{$item->peralatan->produk->nama_produk}}</td>
                        <td>{{$item->peralatan->produk_dalam_kondisi}}</td>
                        <td>{{$item->status_pengajuan}}</td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <form class="update-form" action="{{ route('pengajuan.update', $item->id) }}"
                                    method="post">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="text" name="status_pengajuan" value="approved" hidden>
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="fa fa-thumbs-up text-white"></i>
                                    </button>
                                </form>
                                <form class="update-form" action="{{ route('pengajuan.update', $item->id) }}"
                                    method="post">
                                    @csrf
                                    {{ method_field('POST') }}
                                    <input type="text" name="status_pengajuan" value="rejected" hidden>
                                    <button type="submit" class="btn btn-sm  btn-danger">
                                        <i class="fa fa-thumbs-down text-white"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Suveyor Request </h1>
</div>

<div class="table-responsive">
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>nama</th>
                <th>nomor telepone</th>
                <th>jenis kelamin</th>
                <th>level saat ini</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataReq as $items)
            <tr>
                <td>
                    {{$items->user->nama_user}}
                </td>
                <td>
                    {{$items->user->nomor_telepon}}
                </td>
                <td>
                    {{$items->user->jenis_kelamin}}
                </td>
                <td>
                    {{$items->user->level}}
                </td>
                <td>
                    <form method="POST" action="{{ route('approve.surveyor', $items->user) }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                    <form method="POST" action="{{ route('reject.surveyor', $items->user) }}">
                        @csrf
                        <button type="submit" class="btn btn-danger">reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@section('custom-js')
<script>
$(document).ready(function() {
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
// Contoh polling setiap 5 detik
// Contoh polling setiap 5 detik
setInterval(() => {
    // Me-refresh halaman saat polling dilakukan setiap 5 detik
    location.reload();
}, 1800000);
</script>
@endsection
@endif