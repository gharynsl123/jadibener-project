@extends('welcome')
@section('title-guest', 'Spare Part JadiBener')
@section('guest-view')
<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Spare Part</h1>
            <p class="lead text-muted">Kami dengan senang hati menyajikan beragam komponen suku cadang untuk keperluan para anggota kami, dengan tujuan memberikan kemudahan dalam layanan servis kami. 
                Untuk melihat lebih lanjut mengenai koleksi spare part yang kami sediakan, silakan temukan daftarnya di bawah ini</p>
            <p>
                <a href="{{url('/')}}" class="btn btn-primary my-2">Back to Main Page</a>
                <a href="#table-part" class="btn btn-secondary my-2">Learn More <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
            </p>
        </div>
    </div>
</section>

<div class="album py-5 bg-light" id="table-part">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-3">
            @foreach($part as $item)
            <div class="col">
                <div class="card shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                        xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                        preserveAspectRatio="xMidYMid slice" focusable="false">
                        <title>Placeholder</title>
                        <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef"
                            dy=".3em">Thumbnail</text>
                    </svg>

                    <div class="card-body">
                        <h3 class="card-text">{{$item->nama_part}}</h3>
                        <p class="card-text">{{$item->deskripsi}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="btn-group">
                                <a href="{{route('guest-part.show', $item->slug)}}" class="btn btn-sm btn-outline-secondary">view detail</a>
                            </div>
                            <small class="text-muted">{{$item->kategori->nama_kategori}}</small>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection