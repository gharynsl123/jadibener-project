@extends('welcome')

@section('title-guest', 'detail part')

@section('guest-view')
<style>
    .prices{
        border-radius: 0px 10px 0px;
        padding: 0.5rem;
        background-color:red;
        color:white;
    }
</style>
<div class="container mt-4">
    <div class="row gap-3">
        <div class="col-md-auto d-flex justify-content-center">
            <img src="" alt="image part" class="img-thumbnail card" style="height:250px; width: 250px;">
        </div>
        <div class="col-md-9 col-mx-auto px-3">
            <div class="d-flex justify-content-between">
                <div>
                    <h3>{{$part->nama_part}}</h3>
                    <p class="small">kategori : {{$part->kategori->nama_kategori}}</p>
                </div>

                <div>
                    <p class="prices m-0">@currency($part->harga)</p>
                    <p>Price</p>
                </div>
            </div>
            <div class="card p-3 shadow " style="height: 100%; width:100%;">
                <p>{{$part->deskripsi}}</p>
            </div>
        </div>
    </div>
</div>
@endsection