@extends('layouts.main-view')

@section('content')
<div class="d-flex ">

    <a href="/informasi" class="btn btn-primary shadow">
        <i class="fas fa-arrow-left fa-sm "></i>
        <span>back</span>
    </a>
    
    <p class="mx-4 my-0 h3">{{$informasi->judul}}</p>
</div>
<p class="card p-3 mt-5 shadow">{{$informasi->isi_informasi}}</p>
@endsection