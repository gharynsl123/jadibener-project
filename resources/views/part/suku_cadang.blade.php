@extends('layouts.main-view')

@section('title', 'Suku Cadang')

@section('content')
<h3>Spare part</h3>
<style>
.square {
    width: 200px;
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>

<div class="card my-4">
    <div class="card-header m-0">
        add new spare part
    </div>
    <div class="card-body p-3">
        <form action="{{route('part.store')}}" method="post">
            @csrf
            <div class="mb-3 d-flex justify-content-center">
                <img src="#" id="imagePreview" class="img-thumbnail card square" alt="Image Preview">
            </div>
            <div class="row gap-2">
    
                <div class="col-md-6">
                        <!-- File Input -->
                        <div class="mb-3">
                            <label for="image" class="form-label">No Image</label>
                            <input type="file" class="form-control" name="photo" id="image" accept="image/*" onchange="previewImage()">
                        </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark" for="">Nama Part</label>
                        <input type="text" class="form-control mb-3" name="nama_part" id="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark" for="">Harga</label>
                        <input type="text" class="form-control mb-3" name="harga" id="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="text-dark" for="">Kode Part</label>
                        <input type="text" class="form-control mb-3" name="kode_part" id="">
                    </div>
                </div>            
                <div class="col-md-6">
                    
                    <div class="form-group">
                        <label class="text-dark" for="id_kategori">Kategori</label>
                        <select class="form-control mb-3" name="id_kategori" id="id_kategori">
                            <option value="">pilih kategori</option>
                            @foreach($kategori as $i)
                            <option value="{{ $i->id }}">{{ $i->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="text-dark" for="">Deskripsi</label>
                        <textarea type="text" class="form-control mb-3" name="deskripsi" id=""></textarea>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn mx-3 btn-primary">Submit</button>
        </form>
    </div>
</div>

<div class="card my-4">
    <div class="card-header m-0">
        Spare Part
    </div>
    
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-borderless" id="dataTable" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <td>Nama Spare Part</td>
                        <td>Kode Spare Part</td>
                        <td>Harga</td>
                        <td>Deskripsi</td>
                        <td>image</td>
                        <td>action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($part as $item)
                    <tr>
                        <td>{{$item->nama_part}}</td>
                        <td> @currency($item->harga)</td>
                        <td class="single-line">{{$item->deskripsi}}</td>
                        <td>{{$item->kode_part}}</td>
                        <td>
                            @if($item->photo_produk)
                            <a href="{{ asset('uploads/part/' . $item->photo_produk) }}" download>
                                <div class="img-thumbnail card square"
                                    style="background-image: url('{{ asset('uploads/part/' . $item->photo) }}');">
                                </div>
                            </a>
                            @else
                            Not Available
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <!-- detail -->
                                <a href="{{route('part.show', $item->slug)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-eye text-white"></i>
                                </a>
                                <!-- Edit -->
                                <a href="{{route('part.edit', $item->slug)}}" class="btn btn-sm btn-warning">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <!-- Membuat form delete -->
                                <form action="{{ route('part.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus {{$item->nama_part}} ini?')">
                                        <i class="fa fa-trash text-white"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function previewImage() {
        const input = document.getElementById('image');
        const preview = document.getElementById('imagePreview');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection