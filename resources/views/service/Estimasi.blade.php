@extends('layouts.main-view')

@section('title', 'Estimasi Biaya')

@section('content')
<div class="card shadow border-left-primary p-2">
    <div class="table-responsive">
        <table class="table" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Instansi</th>
                    <th>Nama Product</th>
                    <th>Serial Number</th>
                    <th>Kode Part</th>
                    <th>Nama Part</th>
                    <th>Harga</th>
                    <th>Quantity</th>
                    <th>Total Harga</th>
                    <th>keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($estimasiData as $index => $estimasi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $estimasi->peralatan->instansi->nama_instansi }}</td>
                    <td>{{ $estimasi->peralatan->produk->nama_produk }}</td>
                    <td>{{ $estimasi->peralatan->serial_number }}</td>
                    <td>{{ $estimasi->part->kode_part }}</td>
                    <td>{{ $estimasi->part->nama_part }}</td>
                    <td>{{ $estimasi->harga }}</td>
                    <td>{{ $estimasi->quantity }}</td>
                    <td>
                        {{ $estimasi->harga * $estimasi->quantity }}
                    </td>
                    <td>{{ $estimasi->keterangan }}</td>
                    <td>
                        <!-- Tambahkan tombol aksi sesuai kebutuhan -->
                        <a href="{{route('estimasi.cetak_pdf', $estimasi->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-file"></i></a>
                        <a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection