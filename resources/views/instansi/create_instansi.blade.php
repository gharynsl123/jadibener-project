@extends('layouts.main-view')

@section('content')
<div class="container mt-5">
    <h2>Input Data Rumah Sakit / Institusi</h2>
    <form action="{{ route('instansi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="form-group col-md-6">
                <label for="nama-rumah-sakit">Nama Rumah Sakit / Institusi</label>
                <input type="text" class="form-control" name="instansi" id="nama-rumah-sakit" placeholder="RSUD KOJA">
            </div>
            
            <div class="form-group col-md-6">
                <label for="jumlah-bed">Jumlah Bed</label>
                <input type="number" class="form-control" id="jumlah-bed" name="jumlah_kasur" placeholder="0">
            </div>
            <div class="form-group col-md-6">
                <label for="kelas-rumah-sakit">Kelas Rumah Sakit</label>
                <input type="text" class="form-control" name="kelas" id="kelas-rumah-sakit" placeholder="TYPE B">
            </div>
            <div class="form-group col-md-6">
                <label for="pic">Status Rumah sakit</label>
                <select class="form-control" id="pic" name="status">
                    <option value="">-- Pilih status --</option>
                    <option value="pemerintah">Pemerintah</option>
                    <option value="suasta">Suasta</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="image">Image</label>
                <input type="file" class="form-control form-control-file p-0" id="image" name="image">
            </div>
            <div class="form-group col-md-12">
                <label for="alamat">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="your alamat in here"></textarea>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="submit" class="btn btn-secondary">Batalakan</button>
    </form>
</div>

@endsection
