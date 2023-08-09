@extends('layouts.main-view')
@section('title', 'detail')
@section('content')

<div class="card shadow border-left-primary">
    <div class="card-header ">
        <p class="m-0"><strong>ID Ticket :</strong> {{$pengajuan->idTikect}}</p>
    </div>
    <div class="card-body">
        <div class="row">
            <p class="col-md-6"><strong>Tanggal Pengajuan :</strong> {{$pengajuan->created_at}}</p>
            <p class="col-md-6"><strong>Diajukan Oleh :</strong> {{$pengajuan->user->name}}</p>

            <p class="col-md-6"><strong>Nama Product :</strong> {{$pengajuan->peralatan->produk->nama_produk}}</p>
            <p class="col-md-6"><strong>Kategori :</strong> {{$pengajuan->peralatan->kategori->nama_kategori}}</p>
            <p class="col-md-6 text-danger"><strong>Masalah :</strong> {{$pengajuan->subject_masalah}}</p>
        </div>
    </div>
</div>

<div class="card shadow mt-5 border-left-primary">
    <div class="card-header ">
        <p class="m-0">Di proses oleh</p>
    </div>
    <div class="card-body">
        <!-- jika status nya masih pending maka tampilkan tulisan menunggu approval -->
        @if($pengajuan->status == 'pending')
        menunggu approval dari admin
        @elseif($pengajuan->status == 'rejected')
        gagal untuk memproses tiket kamu. kamu di tolak
        @else
        <!-- jika belum ada teknisi yang memproses maka munculkan form untuk mununjuk teknisi -->
        @if($progress == null)
        @if(Auth::user()->level == 'admin')
        <form action="{{route('progress.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="teknisi">Pilih Teknisi</label>
                <input type="text" name="id_pengajuan" value="{{$pengajuan->id}}" hidden readonly>
                <select name="id_user" id="teknisi" class="form-control">
                    <option value="">Pilih Teknisi</option>
                    @foreach($teknisiList as $items)
                    <option value="{{$items->id}}">{{$items->name}}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Proses</button>
        </form>
        @else
        <p class="text-danger">Belum ada teknisi yang memproses tiket kamu</p>
        @endif
        @else
        <div class="row">
            <p class="col-md-6"><strong>Nama Teknisi : </strong>{{$progress->users->name}}</p>
            <div class="col-md-6">
                <div class="progress" role="progressbar" aria-label="Animated striped example"
                    aria-valuenow="{{$progress->progress}}" aria-valuemin="0" aria-valuemax="{{$progress->progress}}">
                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                        style="width: {{$progress->progress}}%">
                        @if($progress->progress == null)
                        0
                        @else
                        {{$progress->progress}}
                        @endif
                    </div>
                </div>
            </div>
            <p class="col-md-6"><strong>TANGGAL TICKET :</strong>{{$pengajuan->created_at}}</p>
            <p class="col-md-6">
                <strong>TANGGAL PROSES :</strong>
                @if($progress->jadwal == null)
                belum di ajukan jadwal
                @if(Auth::user()->level == 'teknisi' || Auth::user()->level == 'admin')
                <!-- form pengupdate untuk menetukan jadwalnya sesuai id progress -->

            <div class="col-md-12">
                <form action="{{ route('progress.update', $progress->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="date" name="jadwal" class="form-control">

                    <button class="btn btn-primary" type="submit">save</button>
                </form>
            </div>

            @endif
            </p>
            @else
            {{$progress->jadwal}}
            @endif

            @if(Auth::user()->level == 'teknisi')
            <div class="col-md-6">
                @if($progress->jadwal)
                <form action="{{ route('progress.update', $progress->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input name="progress" type="number" class="form-control my-3" required>
                    <textarea name="keterangan" class="form-control mb-3" rows="2" required></textarea>
                    <button type="submit" class="btn btn-primary">Update Progress</button>
                </form>
                @endif
            </div>
            @endif
        </div>
        @endif
        @endif
    </div>
</div>

<!-- history table untuk item itu sendiri dengan relasi dari id_progress -->
<div class="card shadow mt-5 border-left-primary">
    <div class="card-header ">
        <p class="m-0">History</p>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start">Tanggal</th>
                        <th>Status</th>
                        <th>Deskripsi</th>
                        <th class="th-end">by</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $items)
                    <tr>
                        <td>{{$items->progress->id}}</td>
                        <td>{{$items->created_at}}</td>
                        <td>{{$items->status}}</td>
                        <td>{{$items->progress->keterangan}}</td>
                        <td>{{$items->deskripsi}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection