@extends('welcome')
@section('title-guest', 'Contact Us')

@section('guest-view')
<style>
.floating {
    width: 100vw;
    position: absolute;
    top: 200px;
}
.card{
    width: auto;
    height: auto;
}
.header{
    width: 100vw;
    height: 250px;
}
</style>
<section class="bg-secondary text-center header text-white container-fluid">
  <div class="container">
    <div class="row py-5">
      <div class="col-lg-12">
        <h1 class="fw-bolder">Get us in touch</h1>
      </div>
    </div>
  </div>

  <div class="floating flex-wrap  justify-content-center d-flex">

    <div class="card p-3">
      <div class="card-body">
        <i class="fa fa-phone" aria-hidden="true"></i>
        <h5 class="card-title align-item-center">Talk with us</h5>
        <p class="card-text">Jalin Komunikasi Bersama Tim Kami dan Mulai Percakapan yang Bermakna serta Produktif</p>
        <p class="card-text">+62 81209384982</p>
      </div>
    </div>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Email</h5>
        <p class="card-text">Alamat Email</p>
        <input type="email" class="form-control" placeholder="Contoh: example@example.com">
        <p class="card-text">Pesan</p>
        <textarea class="form-control" placeholder="Tulis pesan Anda di sini"></textarea>
        <button class="btn btn-primary">Kirim</button>
      </div>
    </div>

  </div>
</section>
@endsection
