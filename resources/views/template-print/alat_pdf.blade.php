<?php
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html>

<head>
    <title>informasi alat {{$peralatan->produk->nama_produk}}</title>
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
                <h4 class="small mt-4">data diambil dari www.jadibener.com</h4>
            </td>
        </tr>
    </table>
    <hr>

    <p>Tanggal Print:
        <strong>
            <?php echo date("l"); ?>
        </strong>
        <?php echo date("d-m-Y H:i"); ?>
    </p>

    <p>Foto Produk</p>
    @if($peralatan->produk->photo_produk)
    <img src="{{ asset('storage/produk/' . $peralatan->produk->photo_produk) }}" style="width:250px;">
    @else
    belum ada gambar untuk produk
    @endif

    <!-- Keterangan Produk -->
    <div class="card shadow mb-3">
        <div class="card-header bg-info">
            <p class="m-0 text-white font-weight-bolder">KETERANGAN ALAT & KONDISI PRODUK</p>
        </div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Instansi : <strong> {{ $peralatan->instansi->nama_instansi }} </strong> </td>
                    <td>Nama Product : <strong> {{$peralatan->produk->nama_produk}} </strong> </td>
                </tr>
                <tr>
                    <td>Serial Number : <strong> {{ $peralatan->serial_number }} </strong> </td>
                    <td>Kode Product : <strong> {{ $peralatan->produk->kode_produk }} </strong> </td>
                </tr>

                <tr>
                    <td>Merek : <strong> {{ $peralatan->merek->nama_merek }} </strong> </td>
                    <td>Instalasi : <strong> {{ $peralatan->tahun_pemasangan }} </strong> </td>
                </tr>
                <tr>
                    <td>Durasi Pemakaian : <strong> <span>{{ date('Y') - $peralatan->tahun_pemasangan }}
                            tahun</span> </strong> </td>
                    <td>Status Alat : <strong> {{$peralatan->produk_dalam_kondisi}} </strong> </td>
                </tr>
                <tr>
                    <td>Kondisi saat di survey: <strong> {{$peralatan->kondisi_product}} % </strong> </td>
                    <td>Request tahun pergantian : <strong> {{$peralatan->usia_barang}} tahun </strong> </td>
                </tr>
                <tr>
                    <td>Penurunan nilai barang : <strong> {{ round(100 - ((date('Y') - $peralatan->tahun_pemasangan) / $peralatan->usia_barang * 100)) }}%
                        </strong> </td>
                    <td>Tanggal pendataan : <strong> @if($peralatan->update_at != null)
                            {{ $peralatan->update_at->format('Y-m-d') }} @else
                            {{ $peralatan->created_at->format('Y-m-d') }} @endif </strong> 
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Keterangan Produk -->
    <div class="card shadow mb-3">
        <div class="card-header bg-info">
            <p class="m-0 text-white font-weight-bolder">Saran perawatan dan perbaikan</p>
        </div>
        <div class="card-body">
            <p class="mb-3 font-weight-bolder">Nama Surveyor : <strong> {{$peralatan->user->nama_user}}</p>
            <p> {{$peralatan->saran_perbaikan ?? 'belum ada saran' }} </p>
        </div>
    </div>

    <!-- history table -->
    <div class="card shadow mt-3">
        <div class="card-header bg-info">
            <p class="m-0 text-white font-weight-bolder">5 riwayat peralatan terakhir</p>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table  table-borderless">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>STATUS</th>
                            <th>deskripsi</th>
                            <th>tanggal</th>
                            <th>id tiket</th>
                            <th>keluhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        // Hitung jumlah item dalam $history
                        $totalItems = count($history);
                        @endphp
                        @foreach($history->slice(-5) as $items)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$items->status_history}}</td>
                            <td>{{$items->deskripsi}}</td>
                            <td>{{$items->tanggal}}</td>
                            @if($items->pengajuan == null)
                            <td>-</td>
                            <td>-</td>
                            @else
                            <td>
                                <a href="/pengajuan/{{$items->pengajuan->slug}}"
                                    class="btn btn-primary">{{$items->pengajuan->id_pengenal}}</a>
                            </td>
                            <td>{{$items->pengajuan->judul_masalah}}</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
