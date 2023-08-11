@extends('layouts.main-view')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Edit User') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">

                <div class="form-group col-md-6">
                    <label for="name">{{ __('Name User') }}</label>
                    <input class="form-control" type="text" name="name" required autocomplete="off"
                        value="{{$user->name}}">
                </div>




                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control " name="email" value="{{ $user->email}}" required
                        autocomplete="off">

                </div>


                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Nomor Telepon') }}</label>
                    <input id="no_telp" value="{{ $user->no_telp}}" type="number" class="form-control" name="no_telp"
                        required autocomplete="off">

                </div>

                <div class="form-group col-md-6">
                    <label for="level" class="">{{ __('Level') }}</label>
                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                        <option value="{{$user->level}}">{{$user->level}}</option>
                        <option value="admin">Admin</option>
                        <option value="pic_rs">PIC RS</option>
                        <option value="sub_service">Sub Divisi</option>
                        <option value="surveyor">Surveyor</option>
                        <option value="teknisi">Teknisi</option>
                    </select>
                </div>

                
                <!-- jika user yang sedang di edit levelnya bukan pic maka jangan tampilan pilihan instansi-->
                @if($user->level == 'pic_rs')
                <div class="form-group col-md-6 " id="roleField">
                    <label for="role">{{ __('Role') }}</label>
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                        <option value="{{$user->role}}">{{$user->role}}</option>
                        <option value="qizi">Qizi</option>
                        <option value="alkes">Alkes</option>
                        <option value="manager">Manager</option>
                        <option value="cssd">CSSD</option>
                    </select>
                </div>

                <div class=" form-group col-md-6 " id="instansiField">
                    <label for="pic">PIC INSTANSI</label>
                    <select id="level" class="form-control" name="id_instansi">
                        @if($instansi == null)
                        <option value="">belum ada instansi</option>
                        @foreach($instansi as $instansis)
                        <option value="{{$instansis->id}}">{{$instansis->instasi}}</option>
                        @endforeach
                        @else
                        @foreach($instansi as $instansis)
                        <option value="{{$instansis->id}}">{{$instansis->instasi}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                @endif

                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password"  class="form-control" name="password_confirmation"
                    >
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
                    <textarea class="form-control" id="alamat" name="alamat" rows="3"
                        placeholder="your alamat in here" value="{{$user->alamat}}">{{$user->alamat}}</textarea>
                </div>
            </div>

            <!-- Add other fields such as 'level' and 'role' if needed -->

            <div class="form-group row mb-0">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Edit User') }}
                    </button>
                    <a href="/users" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>


<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    var levelSelect = document.getElementById('level');
    var roleField = document.getElementById('roleField');
    var instansiField = document.getElementById('instansiField');

    levelSelect.addEventListener('change', function() {
        if (this.value === 'pic_rs') {
            roleField.style.display = 'block';
            instansiField.style.display = 'block';
        } else {
            roleField.style.display = 'none';
            instansiField.style.display = 'none';
        }
    });
});
</script> -->
@endsection