@extends('layouts.main-view')

@section('content')
<div class="container mt-5">
    <h2>Detail Data Rumah Sakit / Institusi</h2>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="image">Image</label>
                @if($instansi->photo_instansi)
                <!-- ambil gambar -->
                <img src="{{ asset('storage/rumahsakit/'.$instansi->photo_instansi) }}" class="img-thumbnail"
                    alt="Responsive image">
                @else
                <p>No Image Available</p>
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nama-rumah-sakit">Nama Rumah Sakit / Institusi</label>
                <input type="text" class="form-control" value="{{ $instansi->nama_instansi }}" readonly>
            </div>
            <div class="form-group">
                <label for="jumlah-bed">Jumlah Bed</label>
                <input type="text" class="form-control" value="{{ $instansi->jumlah_kasur }}" readonly>
            </div>
            <div class="form-group">
                <label for="pic">Jenis Instansi</label>
                <input type="text" class="form-control" value="{{ ucfirst($instansi->jenis_instansi) }}" readonly>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" rows="3" readonly>{{ $instansi->alamat_instansi }}</textarea>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <h4>PIC:</h4>
                    <!-- jika rumah sakit belum memiliki pic maka tampilan text jika sudah tampilan foreach -->
                    @if($user)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="">nama</th>
                                <th scope=""></th>
                                <th scope="">role</th>
                            </tr>
                        </thead>
                        @foreach($user as $items)
                        <tbody>
                            <tr>
                                <td>{{$items->nama_user}}</td>
                                <td>:</td>
                                <td>{{$items->role}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                    <p>Belum ada PIC</p>
                    @endif
                </div>
            </div>
        </div>
    </div>



    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection