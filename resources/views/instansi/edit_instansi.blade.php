@extends('layouts.main-view')

@section('content')
<div class="container mt-5">
    <h2>Edit Data Rumah Sakit / Institusi</h2>
    <form action="{{ route('instansi.update', $instansi->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nama-rumah-sakit">Nama Rumah Sakit / Institusi</label>
                <input type="text" class="form-control" name="nama_instansi" autocomplete="off" value="{{ $instansi->nama_instansi }}" placeholder="input disini">
            </div>
            
            <div class="form-group col-md-6">
                <label for="jumlah-bed">Jumlah Bed</label>
                <input type="number" class="form-control" name="jumlah_kasur" value="{{ $instansi->jumlah_kasur }}" placeholder="0">
            </div>
            <div class="form-group col-md-6">
                <label for="pic">Jenis Instansi</label>
                <select class="form-control" id="pic" name="jenis_instansi">
                    <option value=""> Pilih </option>
                    <option value="pemerintah" @if($instansi->jenis_instansi == 'pemerintah') selected @endif>Pemerintah</option>
                    <option value="swasta" @if($instansi->jenis_instansi == 'swasta') selected @endif>Swasta</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="image">Image</label>
                <input type="file" class="form-control form-control-file p-0" id="image" name="photo_instansi">
            </div>
            <div class="form-group col-md-12">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat_instansi" rows="3" placeholder="your alamat in here">{{ $instansi->alamat_instansi }}</textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('instansi.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>

@endsection
