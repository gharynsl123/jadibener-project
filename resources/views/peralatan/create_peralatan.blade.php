@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary">
    <p class="card-header ">Tambah Daftar Peralatan RS</p>
    <div class="container my-4">
        <form action="{{route('peralatan.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="merk">Nama Instansi</label>
                <select class="form-control" name="id_instansi">
                    <option>-- PILIH --</option>
                    @foreach($instansi as $instansis)
                    <option value="{{ $instansis->id }}">{{ $instansis->instasi }}</option>
                    @endforeach
                    <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Nama Merk</label>
                <select class="form-control" name="id_merek">
                    <option>-- PILIH --</option>
                    @foreach($merek as $merks)
                    <option value="{{ $merks->id }}">{{ $merks->nama_merek }}</option>
                    @endforeach
                    <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <select class="form-control" name="id_kategori">
                    <option>-- PILIH --</option>
                    @foreach($kategori as $kategoris)
                    <option value="{{ $kategoris->id }}">{{ $kategoris->nama_kategori }}</option>
                    @endforeach
                    <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Nama Product</label>
                <select class="form-control" name="id_product">
                    <option>-- PILIH --</option>
                    @foreach($product as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_produk }}</option>
                    @endforeach
                    <!-- Tambahkan opsi merk lainnya sesuai kebutuhan -->
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Keterangan Product</label>
                <select class="form-control" name="keterangan">
                    
                    <option value="baik">baik</option>
                    <option value="hilang">hilang</option>
                    <option value="rusak">rusak</option>

                   Tambahkan opsi merk lainnya sesuai kebutuhan
                </select>
            </div>
            <div class="form-group">
                <label for="serial-number">Kondisi Product</label>
                <input type="number" class="form-control" name="kondisi_product" id="serial-number" placeholder="untuk di tampilan menjadi persent">
            </div>
            <div class="form-group">
                <label for="serial-number">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number">
            </div>
            
            <div class="form-group">
                <label for="tahun-pemasangan">Tahun Pemasangan</label>
                <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan" placeholder="Tahun Pemasangan">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="/peralatan" class="btn btn-secondary">Batalkan</a>
        </form>
    </div>
</div>
@endsection