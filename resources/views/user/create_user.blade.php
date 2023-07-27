@extends('layouts.main-view')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Create User') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                <div class="col-md-6">
                    <input id="email" type="number" class="form-control @error('email') is-invalid @enderror"
                        name="no_telp" required autocomplete="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="level" class="col-md-4 col-form-label text-md-right">{{ __('Level') }}</label>
                <div class="col-md-6">
                    <select id="level" class="form-control @error('level') is-invalid @enderror" name="level" required>
                        <option value="">-- Select Level --</option>
                        <option value="admin">Admin</option>
                        <option value="pic_rs">PIC RS
                        </option>
                        <option value="sub_service">
                            Sub Divisi</option>
                        <option value="surveyor">Surveyor
                        </option>
                        <option value="teknisi">Teknisi
                        </option>
                    </select>
                    @error('level')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>


            <div class="form-group row" id="roleField" style="display: none;">
                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                <div class="col-md-5">
                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role">
                        <option value="">-- Select Role --</option>
                        <option value="qizi">Qizi</option>
                        <option value="alkes">Alkes</option>
                        <option value="manager">Manager</option>
                        <option value="cssd">CSSD</option>
                    </select>
                    @error('role')
                    <div class="invalid-feedback">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm"
                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>

            <!-- Add other fields such as 'level' and 'role' if needed -->

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create User') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    var levelSelect = document.getElementById('level');
    var roleField = document.getElementById('roleField');

    levelSelect.addEventListener('change', function() {
        if (this.value === 'pic_rs') {
            roleField.style.display = 'block';
        } else {
            roleField.style.display = 'none';
        }
    });
});
</script>
@endsection