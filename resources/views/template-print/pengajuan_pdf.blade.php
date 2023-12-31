<?php
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body>

    <table>
        <tr>
            <td>
                <img src="{{ asset('image/mdh_logo.png') }}" class="image-thumbnail" style="width: 180px;"
                    alt="Gambar">
            </td>
            <td>
                <p class="small mt-4">data di ambil dari www.jadibener.com</p>
            </td>
        </tr>

    </table>

    <hr>


    <h3 class="text-dark">Detail Pengajuan Tikect</h3>
    <!-- informasi peralatan -->
    <div class="card shadow mb-4">
        <div class="card-header bg-info">
            <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT</p>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <th>Instansi</th>
                    <td>:</td>
                    <td>{{ $pengajuan->peralatan->instansi->nama_instansi }}</td>
                    <th>Nama Product</th>
                    <td>:</td>
                    <td>{{$pengajuan->peralatan->produk->nama_produk}}</td>
                </tr>
                <tr>
                    <th>Serial Number</th>
                    <td>:</td>
                    <td>{{ $pengajuan->peralatan->serial_number }}</td>
                    <th>Kode Product</th>
                    <td>:</td>
                    <td>{{ $pengajuan->peralatan->produk->kode_produk }}</td>
                </tr>

                <tr>
                    <th>Merek</th>
                    <td>:</td>
                    <td>{{ $pengajuan->peralatan->merek->nama_merek }}</td>
                    <th>Kategori</th>
                    <td>:</td>
                    <td>{{ $pengajuan->peralatan->kategori->nama_kategori }}</td>
                </tr>
                <tr>
                    <th>usia barang</th>
                    <td>:</td>
                    <td colspan="4">{{ $pengajuan->peralatan->usia_barang }} tahun</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card shadow border-left-primary">
        <div class="card-header ">
            <p class="m-0 text-capitalize"><strong> info keluhan dengan ID Ticket :</strong> {{$pengajuan->id_pengenal}}
            </p>
        </div>
        <div class="card-body">
            <div class="row">
                <p class="col-md-6"><strong>Tanggal Pengajuan :</strong> {{$pengajuan->created_at}}</p>
                <p class="col-md-6"><strong>Diajukan Oleh :</strong> {{$pengajuan->user->nama_user}}</p>

                <p class="col-md-6"><strong>Nama Product :</strong> {{$pengajuan->peralatan->produk->nama_produk}}</p>
                <p class="col-md-6"><strong>Kategori :</strong> {{$pengajuan->peralatan->kategori->nama_kategori}}</p>
                <p class="col-md-6 text-danger"><strong>Masalah :</strong> {{$pengajuan->judul_masalah}}</p>
                <p class="col-md-6 text-danger"><strong>Keterangan Tambahan :</strong> {{$pengajuan->deskripsi_masalah}}</p>
            </div>
        </div>
    </div>

    <div class="card shadow mt-5 border-left-primary">
        <div class="card-header ">
            <p class="m-0">Di proses oleh</p>
        </div>
        <div class="card-body">
            <!-- jika status nya masih pending maka tampilkan tulisan menunggu approval -->
            @if($pengajuan->status_pengajuan == 'pending')
            menunggu approval dari admin
            @elseif($pengajuan->status_pengajuan == 'rejected')
            gagal untuk memproses tiket kamu. kamu di tolak
            @else
            <!-- jika belum ada teknisi yang memproses maka munculkan form untuk mununjuk teknisi -->
            @if($progress == null)
            @if(Auth::user()->level == 'teknisi' || Auth::user()->role == 'kap_teknisi')
            <form action="{{route('progress.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="teknisi">Pilih Teknisi</label>
                    <input type="text" name="id_pengajuan" value="{{$pengajuan->id}}" hidden readonly>
                    <select name="id_user" id="teknisi" class="form-control">
                        <option value="">Pilih Teknisi</option>
                        @foreach($teknisiList as $items)
                        <option value="{{$items->id}}">{{$items->nama_user}}</option>
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
                <p class="col-md-6"><strong>Nama Teknisi : </strong>{{$progress->users->nama_user}}</p>
                <div class="col-md-6">
                    <div class="progress" role="progressbar" aria-label="Animated striped example"
                        aria-valuenow="{{$progress->nilai_pengerjaan}}" aria-valuemin="0"
                        aria-valuemax="{{$progress->nilai_pengerjaan}}">
                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                            style="width: {{$progress->nilai_pengerjaan}}%">
                            @if($progress->nilai_pengerjaan == null)
                            0
                            @else
                            {{$progress->nilai_pengerjaan}}
                            @endif
                        </div>
                    </div>
                </div>
                <p class="col-md-6"><strong>TANGGAL TICKET :</strong>{{$pengajuan->created_at}}</p>
                <p class="col-md-6">

                    <strong>TANGGAL PROSES :</strong>
                    @if($progress->jadwal == null)
                    belum di ajukan jadwal
                    <!-- jika user adalah teknisi yang di tunjuk di form sebelumnnya maka tunjukan form berikut jika tidak jangan tampilkan form berikut nya-->
                    @if(Auth::user()->level == 'teknisi')

                <div class="col-md-12">
                    @if(Auth::user()->id == $progress->id_user)
                    <form action="{{ route('progress.update', $progress->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="date" name="jadwal" class="form-control">
                        <input type="number" name="id_pengajuan" value="{{$pengajuan->id}}" class="d-none">

                        <button class="btn btn-primary" type="submit">save</button>
                    </form>
                    @endif
                </div>

                @endif
                </p>
                @else
                {{$progress->jadwal}}
                @endif
            </div>
            @endif
            @endif
        </div>
    </div>

    @if(Auth::user()->level != 'teknisi' || Auth::user()->role == 'kap_teknisi')
    <!-- history table untuk item itu sendiri dengan relasi dari id_progress -->

    <h3 class="mt-4">Tracking Progress</h3>
    <div class="card shadow">
        <div class="card-body p-0">

            <div class=" d-flex justify-content-start">
                <div class="table-responsive mx-2">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Di Buat Pada</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($historyPengajuan as $items)
                            <tr>
                                <td>{{ $items->created_at }}</td>
                                <td>{{ $items->status_history }}</td>
                                <td>{{ $items->deskripsi }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @endif
</body>
</html>