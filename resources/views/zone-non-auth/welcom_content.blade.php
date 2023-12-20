@extends('welcome')

@section('title-guest', 'Welcome To JadiBener')
@section('guest-view')
<style>
</style>

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
            aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">

        <div class="carousel-item active">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <defs>
                    <linearGradient id="gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color: #001988; stop-opacity: 1" />
                        <stop offset="100%" style="stop-color: #000000; stop-opacity: 1" />
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#gradient)" />
            </svg>

            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Jadibener.com</h1>
                    <p>Kami hadir untuk anda sebagai solusi pentingnya perawatan produk, agar tetap berfungsi secara optimal, kami membantu anda untuk tetap bisa melihat secara rutin kondisi produk yang Anda gunakan di Rumah sakit.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <defs>
                    <linearGradient id="2gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color: #212225; stop-opacity: 1" />
                        <stop offset="100%" style="stop-color: #001988; stop-opacity: 1" />
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#2gradient)" />
            </svg>

            <div class="container">
                <div class="carousel-caption">
                    <h1>Survey Berkala</h1>
                    <p>Apa yang kami lakukan Dalam mewujudkan pencapaian optimal dalam kinerja produk anda adalah dengan mendata secara rinci identitas produk yang digunakan di Rumah Sakit.</p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                <defs>
                    <radialGradient id="3gradient" cx="50%" cy="50%" r="75%" fx="50%" fy="50%">
                        <stop offset="0%" style="stop-color: #000A34; stop-opacity: 1" />
                        <stop offset="100%" style="stop-color: #001988; stop-opacity: 1" />
                    </radialGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#3gradient)" />
            </svg>

            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Program service</h1>
                    <p>Web database untuk melihat kondisi produk anda di Rumah Sakit, permintaan perbaikan dan kondisi update mesin yang Anda gunakan sepenuhnya dapat dilihat dari data yang tersimpan.</p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div class="container marketing">
    <div class="row">
        <div class="col-lg-6">
            @if (Route::has('login'))
            @auth
            <a href="{{route('home')}}" class="text-decoration-none btn d-flex justify-content-center p-3 ">
                kembali ke halamana member
            </a>
            @else
            <a href="{{route('login')}}" class="text-decoration-none d-flex justify-content-center p-3 ">
                <img src="{{ asset('image/login_member.png') }}" alt="Click Here If You're a Member"
                    class="img-thumbnail rounded" style="width: 360px;" srcset="">
            </a>
            @endauth
            @endif

        </div>
        <div class="col-lg-6">
            <a href="{{url('request-as-member')}}" class="d-flex justify-content-center p-3">
                <img src="{{ asset('image/as_guest.png') }}" alt="Click Here If You're not a Member"
                    class="img-thumbnail rounded" style="width: 360px;" srcset="">
            </a>
        </div>
    </div>

    <hr class="featurette-divider">

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var notification = document.getElementById('notification');
    
    if (notification) {
        notification.classList.add('show'); // Menampilkan notifikasi

        // Setelah 3 detik, sembunyikan notifikasi dengan efek slide ke kanan
        setTimeout(function() {
            notification.classList.remove('show');
        }, 3000); // 3000 ms atau 3 detik
    }
});

</script>

@endsection