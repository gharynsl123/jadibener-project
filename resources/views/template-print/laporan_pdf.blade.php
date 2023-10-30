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
    <h3 class="text-dark">Laporan Teknisi</h3>

    <p>Tanggal Print:

        <strong>
            <?php echo date("l"); ?>
        </strong>
        <?php echo date("d-m-Y H:i"); ?>
    </p>
    <div class="table-resposive">
        <table style="color : #000000;" class="table table-borderless">
            <thead>
                <tr>
                    <th>informasi barang</th>
                    <th>laporan survey</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>
                            Nama : <strong>{{$survey->peralatan->produk->nama_produk}}</strong> <br>
                            Kode : <strong>{{$survey->peralatan->produk->kode_produk}}</strong> <br>
                            Serial Number : <strong>{{$survey->peralatan->serial_number}}</strong> <br>
                            Status : <strong>{{$survey->peralatan->keterangan}}</strong> <br>
                            Merek Barang : <strong>{{$survey->peralatan->merek->nama_merek}}</strong> <br>
                            Instalasi : <strong>{{$survey->peralatan->tahun_pemasangan}}</strong> <br>
                            Kondisi : <strong>{{$survey->peralatan->kondisi_product}} %</strong> <br>
                            Request Tahun Pergantian : <strong>{{$survey->peralatan->usia_barang}}</strong> <br>

                        </p>
                    </td>
                    <td>
                        <p>
                            Untuk Instansi : <strong> {{$survey->instansi->nama_instansi}} </strong><br>
                            Surveyor : <strong>{{$survey->user->nama_user}} </strong><br>
                            Tanggal : <strong>@if($survey->peralatan->update_at !=
                                null){{ $survey->peralatan->update_at->format('Y-m-d') }}@else
                                {{ $survey->peralatan->created_at->format('Y-m-d') }}@endif </strong><br>
                            Informasi Kunjungan : <strong>{{ $survey->hasil_kunjungan }} </strong><br>
                            Kesimpulan : <strong>{{ $survey->kesimpulan_kunjungan }} </strong><br>
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>