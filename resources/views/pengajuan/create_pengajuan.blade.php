@extends('layouts.main-view')
@section('content')
<!-- Form untuk mengajukan item -->

<form action="{{ route('pengajuan.store') }}" method="post">
<div class="row">
        @csrf
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Informasi Peralatan</h5>
                    <div class="form-group">
                        <label for="instansi">user id</label>
                        <input type="text" class="form-control" id="instansi" name="id_user" value="{{$user->id}}"
                            readonly>
                    </div>
                    <div class="form-group ">
                        <label for="instansi">id barang</label>
                        <input type="text" class="form-control" id="instansi" name="id_peralatan" value="{{$peralatan->id}}"
                            readonly>
                    </div>

                    <div class="form-group">
                        <label for="instansi">Instansi</label>
                        <input type="text" class="form-control" id="instansi" value="{{$peralatan->instansi->instasi}}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="serialNumber">Serial Number</label>
                        <input type="text" class="form-control" id="serialNumber" value="{{$peralatan->serial_number}}"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <input type="text" class="form-control" id="kategori"
                            value="{{$peralatan->kategori->nama_kategori}}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="namaProduk">Nama Product</label>
                        <input type="text" class="form-control" id="namaProduk"
                            value="{{$peralatan->produk->nama_produk}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Pengajuan Item</h5>
                    <div class="form-group">
                        <label for="ugently">Ugently / Kondisi</label>
                        <select class="form-control" name="id_urgensi" id="ugently">
                            <option selected disabled>-- PILIH --</option>
                            @foreach($urgensi as $urgensis)
                            <option value="{{ $urgensis->id }}">{{ $urgensis->nama_kondisi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="subjectMasalah">Subject Masalah</label>
                        <input type="text" class="form-control" name="subject_masalah"id="subjectMasalah"
                            placeholder="Masukkan subject masalah">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan Tambahan</label>
                        <textarea class="form-control" name="keterangan_masalah" id="keterangan" rows="4"
                            placeholder="Masukkan keterangan tambahan"></textarea>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Ajukan Item</button>
                        <a href="{{route('peralatan.show', $peralatan->id)}}" class="btn btn-secondary">Batalkan</a>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
</form>

@endsection