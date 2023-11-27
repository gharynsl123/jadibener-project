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
                    <th>Download Berkas</th>
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
                    <td> @currency($estimasi->harga) </td>
                    <td>{{ $estimasi->quantity }}</td>
                    <td>
                        @currency($estimasi->harga * $estimasi->quantity)
                    </td>
                    <td>{{ $estimasi->keterangan }}</td>
                    <td>
                        <a href="{{ asset('storage/produk/' . $estimasi->berkas_photo) }}" class="btn btn-sm btn-primary" download>
                            <i class="fa fa-download" aria-hidden="true"></i>
                        </a>
                        
                        @if(Auth::user()->level == 'admin')
                        <form action="{{ route('estimate.delete', ['id' => $estimasi->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Anda yakin ingin menghapus estimasi biaya ini?')">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>

                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection