<?php
date_default_timezone_set('Asia/Jakarta');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peralatan</title>

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<style>
    .text-cotummen {
        font-size: 12px;
    }
</style>

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

    <h3 class="text-dark">
        @if(Auth::user()->level != 'pic') Rumah Sakit @else <br> {{ $instansi->nama_instansi }} @endif List Peralatan
    </h3>

    <p>Tanggal Print:
        <strong>
            <?php echo date("l"); ?>
        </strong><br>
        <?php echo date("d-m-Y H:i"); ?>
    </p>

    <p>
        @if(Auth::user()->level == 'pic') Departement:{{$user->departement}} @endif
    </p>

    <div class="table-resposive">
        <table class="table table-borderless">
            @foreach($peralatan as $item)
            <tbody>
                <tr>
                    <td>
                        <p class="text-dark ">
                            Nama : <strong> {{ $item->produk->nama_produk }} </strong> <br>
                            <span class="text-cotummen">Serial Number: <strong>{{ $item->serial_number }} </strong><br>
                            @if(Auth::user()->level != 'pic')
                            Instansi: <strong>{{ $item->instansi->nama_instansi }}</strong><br>
                            @endif
                            Kategori: <strong>{{ $item->kategori->nama_kategori }}</strong><br>
                            request user barang: <strong>{{ $item->usia_barang }}</strong><br>
                            Kondisi Barang: <strong> {{ max(0, round(100 - ((date('Y') - $item->tahun_pemasangan) / $item->usia_barang * 100))) }}%</strong><br>
                            Keterangan barang: <strong> {{ $item->produk_dalam_kondisi }}</strong><br>
                            Instalasi: <strong>{{ $item->tahun_pemasangan }}</strong></span></p>
                    </td>
                    @if($item->produk->photo_produk === null)
                        <p>Tidak ada gambar untuk produk ini</p>
                    @else
                        <td>
                            <img src="{{ asset('storage/produk/' . $item->produk->photo_produk) }}" style="width:100px;">
                        </td>
                    @endif
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>
</html>
