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
    <a href="{{ route('instansi.index') }}" class="btn mr-4 btn-secondary">Batalakan</a>
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

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{route('survey.store-exist', $instansi->id)}}" method="post">
    @csrf

    <div class="pic-form">
        <div class="card p-3 mt-3 border-left-primary shadow">
            <h2 class="m-0 p-0">Input User PIC</h2>
            <div class="row">


                <div class="form-group col-md-6">
                    <label >{{ __('Name User') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="nama_user" value="{{$instansi->nama_instansi}}"required readonly>
                </div>

                <div class="form-group col-md-6">
                    <label >{{ __('Name User') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                        name="nama_user" required autocomplete="off" autofocus>
                </div>

                <div class="form-group col-md-6">
                    <label class="">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" required autocomplete="off">
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
                        @foreach($departement as $dep)
                        <option value="{{$dep->id}}">{{$dep->nama_departement}}</option>
                        @endforeach
                    </select>
                </div>

                
                <div class="form-group col-md-6">
                    <label>{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control @error('role') is-invalid @enderror"
                    name="jenis_kelamin">
                    <option value="">-- Select Gender --</option>
                    <option value="laki-laki">Laki-Laki</option>
                    <option value="perempuan">Perempuan</option>
                </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password"
                        class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password">

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

    <button type="submit" id="btn-submit" class="ml-auto mt-3 btn btn-primary">Create</button>
</form>

@endsection