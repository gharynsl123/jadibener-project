@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary">
    <p class="card-header">Edit Data Peralatan RS</p>
    <div class="container my-4">
        <form action="{{ route('peralatan.update', $peralatan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="merk">Nama Instansi</label>
                <select class="form-control" name="id_instansi">
                    <option>-- PILIH --</option>
                    @foreach($instansi as $instansis)
                        <option value="{{ $instansis->id }}" {{ $peralatan->id_instansi == $instansis->id ? 'selected' : '' }}>
                            {{ $instansis->instasi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="merk">Nama Merk</label>
                <select class="form-control" name="id_merek">
                    <option>-- PILIH --</option>
                    @foreach($merek as $merks)
                        <option value="{{ $merks->id }}" {{ $peralatan->id_merek == $merks->id ? 'selected' : '' }}>
                            {{ $merks->nama_merek }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <select class="form-control" name="id_kategori">
                    <option>-- PILIH --</option>
                    @foreach($kategori as $kategoris)
                        <option value="{{ $kategoris->id }}" {{ $peralatan->id_kategori == $kategoris->id ? 'selected' : '' }}>
                            {{ $kategoris->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="merk">Nama Product</label>
                <select class="form-control" name="id_product">
                    <option>-- PILIH --</option>
                    @foreach($product as $item)
                        <option value="{{ $item->id }}" {{ $peralatan->id_product == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_produk }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Kondisi Product</label>
                <select class="form-control" name="kondisi">
                    <option>-- PILIH --</option>
                    <option value="baik" {{ $peralatan->kondisi == 'baik' ? 'selected' : '' }}>baik</option>
                    <option value="hilang" {{ $peralatan->kondisi == 'hilang' ? 'selected' : '' }}>hilang</option>
                    <option value="rusak" {{ $peralatan->kondisi == 'rusak' ? 'selected' : '' }}>rusak</option>
                </select>
            </div>

            <div class="form-group">
                <label for="serial-number">Serial Number</label>
                <input type="text" class="form-control" name="serial_number" id="serial-number" placeholder="Serial Number" value="{{ $peralatan->serial_number }}">
            </div>

            <div class="form-group">
                <label for="tahun-pemasangan">Tahun Pemasangan</label>
                <input type="text" class="form-control" name="tahun_pemasangan" id="tahun-pemasangan" placeholder="Tahun Pemasangan" value="{{ $peralatan->tahun_pemasangan }}">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="/peralatan" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
