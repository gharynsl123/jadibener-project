<?php
date_default_timezone_set('Asia/Jakarta');
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peralatan</title>

    <!-- Custom styles for this template -->
    <link href="{{ public_path('css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>

<body>
    <table>
        <tr>
            <td>
                <img src="{{ public_path('image/medhigen.jpg') }}" class="image-thumbnail" style="width: 180px;"
                    alt="Gambar">
            </td>
            <td>
                <p class="small mt-4">Komplek Indra Sentra blok V <br> Jl. Letjen Suprapto, RT.8/RW.3, Cemp. Putih Bar.,
                    <br> Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10520
                </p>
            </td>
        </tr>

    </table>

    <hr>


    <h3 class="text-dark">
        List Peralatan @if(Auth::user()->level != 'pic')
        Rumah Sakit @else
        {{ $instansi->nama_instansi }} @endif

    </h3>

    <p>Tanggal Print:

        <strong>
            <?php echo date("l"); ?>
        </strong><br>
        <?php echo date("d-m-Y H:i"); ?>
    </p>



    <div class="table-resposive">
        <table class="table table-borderless">
            @foreach($peralatan as $item)
            <thead>
                <tr>
                    <th>nama : {{ $item->produk->nama_produk }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <img src="{{ public_path('storage/produk/' . $item->produk->photo_produk) }}"
                            style="width:100px;">
                    </td>
                    <td>
                        <p class="text-dark">Serial Number: <strong>{{ $item->serial_number }} </strong><br>
                            @if(Auth::user()->level != 'pic')
                            Instansi: <strong>{{ $item->instansi->nama_instansi }}</strong><br>
                            @endif
                            Kategori: <strong>{{ $item->kategori->nama_kategori }}</strong><br>
                            Kondisi Barang: <strong>{{ $item->kondisi_product}} %</strong><br>
                            keterangan barang: <strong> {{ $item->keterangan }}</strong><br>
                            Instalasi: <strong>{{ $item->tahun_pemasangan }}</strong></p>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>

</html>