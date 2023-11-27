@extends('layouts.main-view')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">{{ __('Create User') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="row">
                
                <div class="form-group col-md-6">
                    <label for="name" >{{ __('Name User') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="nama_user"
                        value="{{ old('name') }}" required autocomplete="off" autofocus>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="off">

                </div>

                
                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Nomor Telepon') }}</label>
                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                        name="nomor_telepon" required autocomplete="off">

                </div>

                <div class="form-group col-md-6">
                    <label for="level" class="">{{ __('Level') }}</label>
                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                        <option value="">-- Select Level --</option>
                        <option value="admin">Admin</option>
                        <option value="pic">PIC RS</option>
                        <option value="sub_service">Sub Divisi</option>
                        <option value="surveyor">Surveyor</option>
                        <option value="teknisi">Teknisi</option>
                    </select>
                </div>

                <div class="form-group col-md-6 " id="roleField" style="display: none;">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="departement">
                        <option value="">-- Select Role --</option>
                        <option value="Hospital Kitchen">Hospital Kitchen</option>
                        <option value="CSSD">CSSD</option>
                        <option value="Purcashing">Purcashing</option>
                        <option value="IPS-RS">IPS-RS</option>
                    </select>
                </div>

                <div class="form-group col-md-6 " id="teknisiField" style="display: none;">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                        <option value="">-- Select Role --</option>
                        <option value="kap_teknisi">Kepala Teknisi</option>
                    </select>
                    <small class="text-muted">jika user hanya teknisi biasa maka kosong kan role ini</small>
                </div>

                <div class=" form-group col-md-6 " id="instansiField" style="display: none;">
                    <label for="pic">PIC INSTANSI</label>
                    <select class="form-control" id="instansi-select"name="id_instansi">
                        <option value="">pilih instansi</option>
                        <!-- mengambil data dari instansi -->
                        @foreach($instansi as $instansis)
                        <option value="{{$instansis->id}}">{{$instansis->nama_instansi}}</option>
                        @endforeach
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


                <div class="form-group col-md-6 ">
                    <label for="role">{{ __('Jenis Kelamin') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror"
                        name="jenis_kelamin">
                        <option value="">-- Select Gender --</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group mt-3 col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="editor" name="alamat_user"
                        placeholder="your alamat in here"></textarea>
                </div>
            </div>

            <!-- Add other fields such as 'level' and 'role' if needed -->

            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create User') }}
                    </button>
                    <a href="/users" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var levelSelect = document.getElementById('level');
    var roleField = document.getElementById('roleField');
    var teknisiField = document.getElementById('teknisiField');
    var instansiField = document.getElementById('instansiField');

    levelSelect.addEventListener('change', function() {
            var selectedLevel = levelSelect.value;

            if (selectedLevel === 'teknisi') {
                roleField.style.display = 'none';
                instansiField.style.display = 'none';
                teknisiField.style.display = 'block';

            } else if (selectedLevel === 'pic') {
                roleField.style.display = 'block';
                instansiField.style.display = 'block';
                teknisiField.style.display = 'none';

            } else {
                roleField.style.display = 'none';
                instansiField.style.display = 'none';
                teknisiField.style.display = 'none';
            }
    });

    $('#instansi-select').select2();

});
</script>
@endsection