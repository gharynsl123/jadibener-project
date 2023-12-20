@extends('layouts.main-view')
@section('title', 'Creating New Instansi')

@section('content')
<style>
.d-flex .line-bottom {
    border-bottom: 1px solid #000;
    padding-bottom: 2px;
    margin-right: 10px;
}
</style>
<div class="d-flex">
    <a href="{{ route('home') }}" class="btn mr-4 btn-secondary">Batalakan</a>

    <div class="d-flex ml-auto btn-group">
        <button class="btn btn-primary" id="prevPage">Previous</button>
        <button class="btn btn-success" id="nextPage">Next</button>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{route('survey.store-data')}}" method="post" enctype="multipart/form-data">
    @csrf


    <div class="instansi-form">
        <div class="card shadow mt-3 p-3 border-left-primary">
            <h2 class="m-0 p-0">Input Data Rumah Sakit / Institusi</h2>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="role">{{ __('Nama Rumah Sakit / Institusi') }}</label>
                    <select class="form-control" name="id_instansi" id="instansi-select">
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="jumlah-bed">Jumlah Bed</label>
                    <input type="number" class="form-control" name="jumlah_kasur" placeholder="0">
                </div>
                
                <div class="form-group col-md-6">
                    <label for="pic">Jenis Instansi</label>
                    <select class="form-control" name="jenis_instansi">
                        <option value="-">Pilih Jenis</option>
                        <option value="pemerintah">pemerintah</option>
                        <option value="swasta">swasta</option>
                        <option value="BUMN">BUMN</option>
                        <option value="TNI/Polri">TNI/Polri</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <input type="file" require class="form-control form-control-file p-0" id="image" name="photo_instansi">
                </div>

                <div class="form-group col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control alamat-auto-form" readonly name="alamat_instansi" rows="3"
                        placeholder="auto"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="pic-form" style="display: none;">
        <div class="card p-3 mt-3 border-left-primary shadow">
            <h2 class="m-0 p-0">Input User PIC</h2>
            <div class="row">

                <div class="form-group col-md-6">
                    <label>{{ __('Name User') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="nama_user"
                        required autocomplete="off" autofocus>
                </div>

                <div class="form-group col-md-6">
                    <label class="">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required
                        autocomplete="off">
                </div>


                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Nomor Telepon') }}</label>
                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                        name="nomor_telepon" required autocomplete="off">

                </div>

                <div class="form-group col-md-6 " id="roleField">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="departemen-select" class="form-control @error('role') is-invalid @enderror"
                        name="user_departement">
                        <option value="">-- Select Role --</option>
                        <option value="Hospital Kitchen">Hospital Kitchen</option>
                        <option value="CSSD">CSSD</option>
                        <option value="Purcashing">Purcashing</option>
                        <option value="IPS-RS">IPS-RS</option>
                    </select>
                </div>


                <div class="form-group col-md-6">
                    <label>{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control @error('role') is-invalid @enderror" name="jenis_kelamin">
                        <option value="">-- Select Gender --</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3 col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="editor" name="alamat_user"
                        placeholder="your alamat in here"></textarea>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" id="btn-submit" class="ml-auto mt-3 btn btn-primary" style="display: none;">Create</button>
</form>
@endsection

@section('custom-js')
<script>
var currentPage = 1;
var totalPages = 2;

// Function to show the current page
function showPage(pageNumber) {
    // Hide all form sections
    $('.pic-form').hide();
    $('#btn-submit').hide();

    // Show the form section for the current page
    if (pageNumber === 1) {
        $('#btn-submit').hide();
        $('.pic-form').hide();
        $('#nextPage').show();
        $('.instansi-form').show();
    } else if (pageNumber === 2) {
        $('.pic-form').show();
        $('.instansi-form').hide();
        $('#btn-submit').show();
        $('#nextPage').hide();
    }

    // Update any other UI elements as needed
}

// Event listener for the "Next" button
$('#nextPage').click(function() {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
});

// Event listener for the "Previous" button
$('#prevPage').click(function() {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
});

document.addEventListener('DOMContentLoaded', function() {

    // Inisialisasi Select2
    var instansiSelect = $('#instansi-select');

    instansiSelect.select2({
        placeholder: '-- Select Rs --',
        allowClear: true,
        ajax: {
            url: function(params) {
                return '/get-data/instansi';
            },
            dataType: 'json',
            processResults: function(data) {
                return {
                    results: data.map(function(instansi) {
                        return {
                            id: instansi.id,
                            text: instansi.nama_instansi,
                            alamat: instansi.alamat_instansi // Sertakan alamat dalam hasil
                        };
                    })
                };
            },
            cache: true
        }
    });

    // Event listener untuk memanggil fillAlamat ketika instansi dipilih
    instansiSelect.on('select2:select', function(e) {
        var selectedInstansiData = e.params.data;

        // Cari textarea dengan kelas 'alamat-auto-form' dan isi dengan alamat yang sesuai
        var alamatTextarea = $('.alamat-auto-form');
        alamatTextarea.val(selectedInstansiData.alamat); // Isi dengan alamat yang sesuai
    });

    // Event listener untuk menghapus isi alamat saat instansi dibatalkan
    instansiSelect.on('select2:unselect', function() {
        var alamatTextarea = $('.alamat-auto-form');
        alamatTextarea.val(''); // Kosongkan alamat
    });
});
</script>
@endsection