@extends('layouts.main-view')

@section('content')
<div class="card shadow p-3 border-left-primary">

    <div class="d-flex">
        <div class="">
            <a href="{{ route('instansi.index') }}" class="btn mr-3 btn-secondary">Batalakan</a>
        </div>
        <h2 class="m-0 p-0">Input Data Rumah Sakit / Institusi</h2>
    </div>
    <form action="{{ route('instansi.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nama-rumah-sakit">Nama Rumah Sakit / Institusi</label>
                <input type="text" class="form-control" name="nama_instansi" autocomplete=off
                    placeholder="input disini">
            </div>

            <div class="form-group col-md-6">
                <label for="jumlah-bed">Jumlah Bed</label>
                <input type="number" class="form-control" name="jumlah_kasur" placeholder="0">
            </div>
            <div class="form-group col-md-6">
                <label for="pic">Jenis Instansi</label>
                <input type="text" class="form-control" name="jenis_instansi" placeholder="tulis jenisnya">
            </div>
            <div class="form-group col-md-6">
                <label for="image">Image</label>
                <input type="file" class="form-control form-control-file p-0" id="image" name="photo_instansi">
            </div>
            <div class="form-group col-md-12">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="editor" name="alamat_instansi" rows="3"
                    placeholder="your alamat in here"></textarea>
            </div>
        </div>

    </form>
    <button type="submit" class="btn ml-auto btn-primary">Submit</button>
</div>
@endsection