<!DOCTYPE html>
<html>

<head>
    <title>Estimasi Biaya Service Dan Penukaran Part</title>

    <!-- Custom styles for this template -->
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
        <table style="color : #000000" class="table table-bordered">
            <thead>
                <tr>
                    <th colspan="6">{{$estimasi->instansi->nama_instansi}} <br> {{$estimasi->peralatan->produk->nama_produk}}</th>
                </tr>
                <tr>
                    <th>No.</th>
                    <th>Nama Part</th>
                    <th>Harga Satuan</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{$estimasi->part->nama_part}} <br> {{$estimasi->part->kode_part}}</td>
                    <td>{{$estimasi->harga}}</td>
                    <td>{{$estimasi->quantity}}</td>
                    <td>{{$estimasi->harga * $estimasi->quantity}} </td>
                    <td>{{$estimasi->keterangan}}</td>
                </tr>
                <!-- Tambahkan baris data tambahan sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</body>

</html>