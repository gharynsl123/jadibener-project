@extends('layouts.main-view')

@section('content')
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
                    <label for="role">{{ __('Role') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                        <option value="">-- Select Role --</option>
                        <option value="qizi">Qizi</option>
                        <option value="alkes">Alkes</option>
                        <option value="cssd">CSSD</option>
                        <option value="manager">Manager</option>
                        <option id="roleTeknisi" value="kap_teknisi">Kepala Teknisi</option>
                    </select>
                    <small class="text-muted">jika user hanya teknisi biasa maka kosong kan role ini</small>
                </div>

                <div class=" form-group col-md-6 " id="instansiField" style="display: none;">
                    <label for="pic">PIC INSTANSI</label>
                    <select id="level" class="form-control" name="id_instansi">
                        <option value="">select the level</option>
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
                
                <div class="form-group col-md-6">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control"
                        required autocomplete="new-password">
                </div>

                <div class="input-group form-group col-md-6 mb-auto">
                    <div class="input-group-text form-control" id="gender">
                        <input class="form-check mr-3" type="radio" name="jenis_kelamin" value="laki-laki">
                        Laki-Laki
                    </div>

                    <div class="input-group-text form-control">
                        <input class="form-check mr-3" type="radio" name="jenis_kelamin" value="perempuan">
                        Perempuan
                    </div>

                </div>

                <div class="form-group col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="alamat" name="alamat_user" rows="3"
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
    var roleTeknisi = document.getElementById('roleTeknisi');
    var instansiField = document.getElementById('instansiField');

    levelSelect.addEventListener('change', function() {
            var selectedLevel = levelSelect.value;

            if (selectedLevel === 'teknisi') {
                roleField.style.display = 'block';
                instansiField.style.display = 'none';
                roleTeknisi.style.display = 'block';

            } else if (selectedLevel === 'pic') {
                roleField.style.display = 'block';
                instansiField.style.display = 'block';
                roleTeknisi.style.display = 'none';

            } else {
                roleField.style.display = 'none';
                instansiField.style.display = 'none';
                roleTeknisi.style.display = 'none';
            }
    });


});
</script>
@endsection