@extends('layouts.main-view')
@section('title', 'detail')
@section('content')

<div class="card shadow border-left-primary">
    <div class="card-header ">
        <p class="m-0"><strong>ID Ticket :</strong> {{$progress}}</p>
    </div>
    <div class="card-body">
        <div class="row">
            <p class="col-md-6"><strong>Tanggal progress :</strong> {{$progress->created_at}}</p>
            <p class="col-md-6"><strong>Diajukan Oleh :</strong> {{$progress->user->name}}</p>

            <p class="col-md-6"><strong>Nama Product :</strong> {{$progress->peralatan->produk->nama_produk}}</p>
            <p class="col-md-6"><strong>Kategori :</strong> {{$progress->peralatan->kategori->nama_kategori}}</p>
            <p class="col-md-6 text-danger"><strong>Masalah :</strong> {{$progress->subject_masalah}}</p>
        </div>
    </div>
</div>

<div class="card shadow mt-5 border-left-primary">
    <div class="card-header ">
        <p class="m-0">Di proses oleh</p>
    </div>
    <div class="card-body">
        <!-- jika status nya masih pending maka tampilkan tulisan menunggu approval -->
        @if($progress->status == 'pending')
        menunggu approval dari admin
        @elseif($progress->status == 'rejected')
        gagal untuk memproses tiket kamu. kamu di tolak
        @else
        @if($progress == null )
        <!-- form oengisian teknsi-->
        <form action="{{route('progress.store')}}" method="post">
            @csrf
            <!-- dropdown user yang berlevel tiknisi -->
            <div class="form-group">
                <label for="merk">Nama Teknisi</label>
                <select class="form-control" name="id_user">
                    <option>-- PILIH --</option>
                    @foreach($teknisiList as $users)
                    <option value="{{ $users->id }}">{{ $users->name }}</option>
                    @endforeach
                </select>
            </div>
            <!-- input hidden untuk mengirim id progress -->
            <input type="text" name="id_progress" value="{{$progress->id}}" hidden>
            <button type="submit" class="btn btn-primary">
                Oke
            </button>
        </form>
        @else
        <div class="row">
            <p class="col-md-6"><strong>Nama Teknisi :</strong>{{$progress->users->name}}</p>
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
            <p class="col-md-6"><strong>TANGGAL TICKET :</strong>{{$progress->created_at}}</p>
            <p class="col-md-6"><strong>TANGGAL PROSES :</strong> 2023-07-20 16:38:54</p>
        </div>
        @endif
        @endif
    </div>
</div>

@endsection