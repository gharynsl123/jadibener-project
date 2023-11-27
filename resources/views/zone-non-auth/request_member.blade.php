@extends('welcome')
@section('title-guest', 'Request become Member')

@section('guest-view')
@if (session('success'))
    <div class="alert mt-5 alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container card mb-5 mt-5 p-0">
    <div class="card-header">{{ __('Pengajuan Pembuatan Data Baru') }}</div>

    <div class="card-body">
        <form method="POST" action="{{url('request-member')}}">
            @csrf
            <div class="row">
                <div class="form-group col-md-6">
                    <label>{{ __('Nama User') }}</label>
                    <input type="text" placeholder="nama kamu" class="form-control @error('nama_user') is-invalid @enderror" name="nama_user"
                        value="{{ old('nama_user') }}" required autocomplete="off" autofocus>
                        <small class="text-danger">*ini akan menjadi id untuk kamu masuk nanti</small>
                </div>

                <div class="form-group col-md-6">
                    <label>{{ __('Password') }}</label>
                    <input type="password" placeholder="******" class="form-control @error('password') is-invalid @enderror" name="password"
                        value="{{ old('password') }}" required autocomplete="off" autofocus>
                        <small class="text-danger">*mohon untuk mengingat password ini</small>
                </div>

                <div class="form-group col-md-6">
                    <label class="">{{ __('Email') }}</label>
                    <input type="email" placeholder="example@gmail.com" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                    <label class="">{{ __('Nomor Telepon') }}</label>
                    <input placeholder="nomor mu" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                        name="nomor_telepon" required autocomplete="off">
                </div>

                <div class="form-group col-md-6 " id="roleField">
                    <label>{{ __('Departemen') }}</label>
                    <select class="form-control @error('departement') is-invalid @enderror" name="departement">
                        <option value="">-- Pilih Departemen --</option>
                        <option value="Hospital Kitchen">Hospital Kitchen</option>
                        <option value="CSSD">CSSD</option>
                        <option value="Purchasing">Purchasing</option>
                        <option value="IPS-RS">IPS-RS</option>
                    </select>
                </div>

                <div class=" form-group col-md-6 " id="instansiField">
                    <label for="id_instansi">PIC Instansi</label>
                    <input id="email" type="text" class="form-control"
                        name="instansi" placeholder="nama instansi" required autocomplete="off">
                </div>

                <div class="form-group col-md-6 ">
                    <label>{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror"
                        name="jenis_kelamin">
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group mt-3 col-md-12">
                    <label for="alamat_user">Alamat Rumah Sakit</label>
                    <textarea class="form-control" id="alamat_user" name="alamat_instansi"
                        placeholder="Alamat Anda di sini"></textarea>
                </div>

                <div class="form-group mt-3 col-md-12" id="form-keluhan" style="display:none;">
                    <label for="alamat_user">Laporkan Keluhan</label>
                    <textarea class="form-control" id="editor" name="ajukan_permasalahan"
                        placeholder="Keluhan yang ingin di sampaikan"></textarea>
                </div>
            </div>

            
            <div class="form-group mt-3 row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Ajukan Pembuatan Data') }}
                    </button>
                    <a href="#" id="btn-keluhan" class="btn btn-success">Laporan keluhan</a>
                    <a href="/" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var keluhanButton = document.getElementById('btn-keluhan');
        var formKeluhan = document.getElementById('form-keluhan');
        var editor = CKEDITOR.instances.editor;
        console.log(editor);
        
        keluhanButton.addEventListener('click', function(e) {
            e.preventDefault(); // Mencegah link dari berpindah ke halaman lain
            
            if (formKeluhan.style.display === 'none' || formKeluhan.style.display === '') {
                formKeluhan.style.display = 'block';
            } else {
                formKeluhan.style.display = 'none';
                editor.setData('');
            }
        });
    });
    CKEDITOR.replace('editor');
</script>

@endsection
