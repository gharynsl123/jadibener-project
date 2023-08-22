@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary">
    <p class="card-header ">Edit Daftar Peralatan RS</p>
    <div class="container my-4">
        <form action="{{ route('peralatan.update', $peralatan->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="merk">Nama Instansi</label>
                <select class="form-control" name="id_instansi">
                    @foreach($instansi as $items)
                    <option value="{{ $items->id }}" @if($peralatan->id_instansi === $items->id) selected @endif>{{ $items->nama_instansi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Nama Merk</label>
                <select class="form-control" name="id_merek">
                    @foreach($merek as $merks)
                    <option value="{{ $merks->id }}" @if($peralatan->id_merek === $merks->id) selected @endif>{{ $merks->nama_merek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="kategori">Nama Kategori</label>
                <select class="form-control" name="id_kategori">
                    @foreach($kategori as $kategoris)
                    <option value="{{ $kategoris->id }}" @if($peralatan->id_kategori === $kategoris->id) selected @endif>{{ $kategoris->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Nama Product</label>
                <select class="form-control" name="id_product">
                    @foreach($product as $item)
                    <option value="{{ $item->id }}" @if($peralatan->id_product === $item->id) selected @endif>{{ $item->nama_produk }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="merk">Keterangan Product</label>
                <select class="form-control" name="keterangan">
                    <option value="baik" @if($peralatan->keterangan === 'baik') selected @endif>baik</option>
                    <option value="hilang" @if($peralatan->keterangan === 'hilang') selected @endif>hilang</option>
                    <option value="rusak" @if($peralatan->keterangan === 'rusak') selected @endif>rusak</option>
                </select>
            </div>
            <div class="form-group">
                <label for="serial-number">Kondisi Product</label>
                <input type="number" class="form-control" name="kondisi_product" id="kondisi-product" value="{{ $peralatan->kondisi_product }}" placeholder="untuk di tampilan menjadi persent">
                <small class="text-muted">batas pengisian 100</small>
            </div>
            <div class="form-group">
                <label for="serial-number">Nilai Tahunan</label>
                <input type="number" class="form-control" id="pertahun-product" name="nilai_tahun" value="{{ $peralatan->nilai_tahun }}" placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kondisiProductInput = document.getElementById('kondisi-product');
        const pertahunProductInput = document.getElementById('pertahun-product');

        pertahunProductInput.addEventListener('input', function() {
            // Get the entered value and convert it to a number
            let value = parseFloat(pertahunProductInput.value);

            // Check if the entered value is greater than 100
            if ( value > 10) {
                // If it's greater, set the input value to 100
                pertahunProductInput.value = 10;
            }else if(value < 5){
                // if it's small than 5, set the input value to 5
                pertahunProductInput.value = 5;
            }
        });

        // Add an event listener to the input field
        kondisiProductInput.addEventListener('input', function() {
            // Get the entered value and convert it to a number
            let value = parseFloat(kondisiProductInput.value);

            // Check if the entered value is greater than 100
            if (value > 100) {
                // If it's greater, set the input value to 100
                kondisiProductInput.value = 100;
            }
        });
    });
</script>
@endsection
