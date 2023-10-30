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
                <p class="small mt-4">Komplek Indra Sentra blok V <br> Jl. Letjen Suprapto, RT.8/RW.3, Cemp. Putih
                    Bar.,
                    <br> Kec. Cemp. Putih, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10520
                </p>
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
                    <td>Kondisi : <strong> {{$peralatan->kondisi_product}} % </strong> </td>
                    <td>Request tahun pergantian : <strong> {{$peralatan->usia_barang}} tahun </strong> </td>
                </tr>
                <tr>
                    <td>Penurunan nilai barang : <strong> {{ 100 - ($peralatan->usia_barang % date('Y')) }}%
                        </strong> </td>
                    <td>Tanggal pendataan : <strong> @if($peralatan->update_at != null)
                            {{ $peralatan->update_at->format('Y-m-d') }} @else
                            {{ $peralatan->created_at->format('Y-m-d') }} @endif </strong> </td>
                </tr>
                <tr>
                    <td>Surveyor : <strong> {{$peralatan->user->nama_user}} </strong> </td>
                    <td>Saran Perbaikan : <strong> {{$peralatan->saran_perbaikan}} </strong> </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- history table -->
    <div class="card shadow mt-3">
        <div class="card-header bg-info">
            <p class="m-0 text-white font-weight-bolder">HISTORY PERALATAN</p>
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
                        @foreach($history as $items)
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