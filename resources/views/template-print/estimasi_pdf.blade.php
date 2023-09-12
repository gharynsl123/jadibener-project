<!DOCTYPE html>
<html>

<head>
    <title>Estimasi Biaya Service Dan Penukaran Part</title>

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

    <p>Tanggal Print:

        <strong>
            <?php echo date("l"); ?>
        </strong><br>
        <?php echo date("d-m-Y H:i"); ?>
    </p>


    <h3 class="text-dark">Estimasi Biaya Service Dan Penukaran Part</h3>
    <div class="table-resposive">
        <table style="color : #000000;" class="table table-borderless">
            <thead>
                <tr>
                    <td>instansi</td>
                    <td>estimasi barang</td>
                    <td>total harga</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$estimasi->instansi->nama_instansi}}</td>
                    <td>
                        <p>
                            nama : {{$estimasi->part->nama_part}} <br>
                            kode part : {{$estimasi->part->kode_part}} <br>
                            quantity part : {{$estimasi->quantity}} <br>
                            harga satuan : {{$estimasi->harga}} <br>
                            keterangan : {{$estimasi->keterangan}} <br>
                        </p>
                    </td>
                    <td><strong>{{ $estimasi->harga * $estimasi->quantity}} </strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>