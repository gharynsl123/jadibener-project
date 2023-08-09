@extends('layouts.main-view')

@if (Auth::user()->level == 'pic_rs')
@section('content')
@include('profile.rumah_sakit')
@endsection
@elseif (Auth::user()->level == 'surveyor')
@include('home.surveyor')
@elseif(Auth::user()->level == 'teknisi')
@include('home.teknisi')
@else

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-0 text-gray-800 d-sm-inline-block  mb-4"> Status Service</h1>

<div class="row gap-2">
    <div class="col-md-3 my-1">
        <div class="card d-flex text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            <p class="fix-bottom m-0">
                Tickets Solved
            </p>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            <p class="fix-bottom m-0">
                Tickets On Process
            </p>
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            Tickets Waiting Approval By Admin
        </div>
    </div>
    <div class="col-md-3 my-1">
        <div class="card text-center border-left-primary" style="min-height: 150px; padding: 10px;">
            Tickets Waiting Approval Technition
        </div>
    </div>
</div>

<div class="d-sm-flex align-items-center justify-content-between my-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> Request Approval </h1>
    <div class="d-none d-sm-inline-block">
        <a href="{{url('peralatan')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
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
                    @foreach($pengajuan->reverse() as $items)
                    <!-- menampilnkan data yang bersatstus pending saja -->
                    @if($items->status == 'pending')
                    <tr>
                        <td>
                            <!-- for go to detail -->
                            <a href="#" class="btn btn-info">
                                <i class="fa fa-eye text-white"></i>
                            </a>
                        </td>
                        <td>{{$items->created_at}}</td>
                        <td>{{$items->peralatan->instansi->instasi}}</td>
                        <td>{{$items->user->name}}</td>
                        <td>{{$items->peralatan->serial_number}}</td>
                        <td>{{$items->peralatan->kategori->nama_kategori}}</td>
                        <td>{{$items->peralatan->produk->nama_produk}}</td>
                        <td>{{$items->urgent->nama_kondisi}}</td>
                        <td>{{$items->status}}</td>
                        <td>
                            <!-- untuk feedback good or bad -->
                            <div class="d-flex justify-content-between">
                                <form action="{{route('pengajuan.update', $items->id)}}" method="post">
                                    @csrf
                                    {{method_field('POST')}}
                                    <input type="text" name="status" value="approved" hidden>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-thumbs-up text-white"></i>
                                    </button>
                                </form>
                                <form action="{{route('pengajuan.update', $items->id)}}" method="post">
                                    @csrf
                                    {{method_field('POST')}}
                                    <input type="text" name="status" value="rejected" hidden>
                                    <button type="submit"  class="btn btn-danger">
                                        <i class="fa fa-thumbs-down text-white"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>

    var pengajuanData = @json($pengajuan); // Mengambil data pengajuan dari controller
    // Mengambil semua elemen baris pada tabel
    var rows = document.querySelectorAll("#dataTable tbody tr");

    // Iterasi melalui setiap baris
    rows.forEach(function(row, index) {
        // Mengambil elemen sel yang berisi status
        var statusCell = row.querySelector("td:nth-child(8)");

        // Mengambil teks status dari sel
        var status = statusCell.textContent.trim();
        
        // Membandingkan status dengan data dari pengajuan
        if (status != pengajuanData[index]->status) {
            dd
        }
    });
</script>


@endsection

@endif