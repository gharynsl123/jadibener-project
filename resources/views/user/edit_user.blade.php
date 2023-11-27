@extends('layouts.main-view')

@section('content')

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="card">
    <div class="card-header">{{ __('Edit User') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="name">{{ __('Name User') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                        name="nama_user" value="{{ $user->nama_user }}" required autocomplete="off" autofocus>
                </div>

                <div class="form-group col-md-6">
                    <label for="email">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email }}" required autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                    <label for="no_telp">{{ __('Nomor Telepon') }}</label>
                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                        name="nomor_telepon" value="{{ $user->nomor_telepon }}" required autocomplete="off">
                </div>

                <div class="form-group col-md-6">
                    <label for="level">{{ __('Level') }}</label>
                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                        <option value="">-- Select Level --</option>
                        <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="pic" {{ $user->level == 'pic' ? 'selected' : '' }}>PIC RS</option>
                        <option value="sub_service" {{ $user->level == 'sub_service' ? 'selected' : '' }}>Sub Divisi
                        </option>
                        <option value="surveyor" {{ $user->level == 'surveyor' ? 'selected' : '' }}>Surveyor</option>
                        <option value="teknisi" {{ $user->level == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
                    </select>
                </div>

                <!-- Other form fields here -->
                <div class="form-group col-md-6 " id="roleField" style="display: none;">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="departement">
                        <option value="">-- Select Role --</option>
                        <option value="Hospital Kitchen" {{$user->departement == 'Hospital Kitchen' ? 'selected' : ''}}>Hospital Kitchen</option>
                        <option value="CSSD" {{$user->departement == 'CSSD' ? 'selected' : ''}} >CSSD</option>
                        <option value="Purcashing" {{$user->departement == 'Purcashing' ? 'selected' : ''}} >Purcashing</option>
                        <option value="IPS-RS" {{$user->departement == 'IPS-RS' ? 'selected' : ''}} >IPS-RS</option>
                    </select>
                </div>

                <div class="form-group col-md-6 " id="teknisiField" style="display: none;">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                        <option value="">-- Select Role --</option>
                        <option id="roleTeknisi" value="kap_teknisi">Kepala Teknisi</option>
                    </select>
                    <small class="text-muted">jika user hanya teknisi biasa maka kosong kan role ini</small>
                </div>

                <div class=" form-group col-md-6 " id="instansiField" style="display: none;">
                    <label for="pic">PIC INSTANSI</label>
                    <select id="instansi-select" class="form-control" name="id_instansi">
                        <!-- jika data pic sebelumnya sudah ada maka tampilan datanya -->
                        <option value="">-- Select instansi --</option>
                        <!-- jika tidak ada maka tampilkan semua datanya -->
                        @foreach($instansi as $instansis)
                        <option value="{{$instansis->id}}" {{ $user->id_instansi == $instansis->id ? 'selected' : '' }}>
                            {{$instansis->nama_instansi}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" autocomplete="new-password">
                </div>


                <div class="form-group col-md-6 ">
                        <label for="role">{{ __('Jenis Kelamin') }}</label>
                        <select id="role" class="form-control @error('role') is-invalid @enderror"
                            name="jenis_kelamin">
                            <option value="">-- Select Gender --</option>
                            <option value="laki-laki" {{ $user->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="perempuan" {{ $user->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                <div class="form-group col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="editor" name="alamat_user" rows="3"
                        placeholder="your alamat in here"
                        value="{{ $user->alamat_user }}">{{$user->alamat_user}}</textarea>
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update User') }}
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
    var roleTeknisi = document.getElementById('roleTeknisi');
    var instansiField = document.getElementById('instansiField');

    $('#instansi-select').select2();

    // ambil data dari level json
    var level = @json($user -> level);

    // inisialisasi tampilan berdasarkan level yang sudah ada
    if (level === 'teknisi') {
        teknisiField.style.display = 'block';
        instansiField.style.display = 'none';
        roleField.style.display = 'none';
        roleTeknisi.style.display = 'block';
    } else if (level === 'pic') {
        roleField.style.display = 'block';
        instansiField.style.display = 'block';
        teknisiField.style.display = 'none';
        roleTeknisi.style.display = 'none';
    } else {
        roleField.style.display = 'none';
        teknisiField.style.display = 'none';
        roleTeknisi.style.display = 'none';
        instansiField.style.display = 'none';
    }

    levelSelect.addEventListener('change', function() {
        var selectedLevel = levelSelect.value;

        if (selectedLevel === 'teknisi') {
            teknisiField.style.display = 'block';
            instansiField.style.display = 'none';
            roleField.style.display = 'none';
            roleTeknisi.style.display = 'block';
        } else if (selectedLevel === 'pic') {
            roleField.style.display = 'block';
            instansiField.style.display = 'block';
            teknisiField.style.display = 'none';
            roleTeknisi.style.display = 'none';
        } else {
            roleField.style.display = 'none';
            instansiField.style.display = 'none';
            teknisiField.style.display = 'none';
            roleTeknisi.style.display = 'none';
        }
    });

});
</script>
@endsection