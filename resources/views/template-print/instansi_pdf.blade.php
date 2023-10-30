<!DOCTYPE html>
<html>

<head>
    <title>Laporan Peralatan</title>

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
                <p class="small mt-4">Komplek Indra Sentra blok V <br> Jl. Letjen Suprapto, RT.8/RW.3, Cemp. Putih
                    Bar.,
                    <br> Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10520
                </p>
            </td>
        </tr>

    </table>

    <hr>
    
    <h3 class="text-dark">Daftar Rumah sakit</h3>
    
    <p>Tanggal Print:

        <strong>
            <?php echo date("l"); ?>
        </strong>
        <?php echo date("d-m-Y H:i"); ?>
    </p>

    <div class="table-resposive">
        <table class="table table-borderless">
            @foreach($instansi as $item)
            <tbody>
                <tr>
                    <td>
                        <p class="text-dark">
                            instansi: <strong>{{$item->nama_instansi}}</strong><br>
                            alamat instansi: <strong>{{$item->alamat_instansi}}</strong><br>

                            <!-- Cari data PIC yang sesuai dengan instansi -->
                            @php
                            $pic = App\User::where('id_instansi', $item->id)->get(); // Mencari data PIC berdasarkan
                            @endphp

                            @if($pic->isNotEmpty())
                            <!-- Periksa apakah ada data PIC -->
                            @foreach($pic as $picItem)
                            PIC : <strong> {{$picItem->nama_user}} </strong><br>
                            role : <strong>{{$picItem->departement->nama_departement}} </strong><br>
                            @endforeach
                            @else
                            PIC: <strong>Belum ada PIC </strong><br>
                            @endif
                            jumlah kasur:<strong>{{$item->jumlah_kasur}}</strong> <br>
                            jenis instansi:<strong>{{$item->jenis_instansi}}</strong> <br>
                        </p>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>

</html>
