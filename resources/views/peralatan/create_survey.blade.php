@extends('layouts.main-view')
@section('content')
<div class="card border-left-primary shadow p-3">
    <form action="{{route('survey.store')}}" method="post">
        @csrf
        <input type="hidden" name="id_peralatan" value="{{$peralatan->id}}">
        <div class="row gap-2">
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>nama instansi</laebl>
                    <input type="text" name="" value="{{$peralatan->instansi->nama_instansi}}" id=""
                        class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>merek</laebl>
                    <input type="text" name="" value="{{$peralatan->merek->nama_merek}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>kategori</laebl>
                    <input type="text" name="" value="{{$peralatan->kategori->nama_kategori}}" id=""
                        class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>nama produk</laebl>
                    <input type="text" name="" value="{{$peralatan->produk->nama_produk}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>serial number</laebl>
                    <input type="text" name="" value="{{$peralatan->serial_number}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>instalasi</laebl>
                    <input type="text" name="" value="{{$peralatan->tahun_pemasangan}}" id="" class="form-control"
                        readonly>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <laebl>kode produk</laebl>
                    <input type="text" name="" value="{{$peralatan->produk->kode_produk}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>nama produk</laebl>
                    <input type="text" name="" value="{{$peralatan->produk->nama_produk}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>Kondisi alat</laebl>
                    <input type="text" name="" value="{{$peralatan->serial_number}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>surveyor</laebl>
                    <input type="text" name="" value="{{$peralatan->user->nama_user}}" id="" class="form-control"
                        readonly>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>teknisi</laebl>
                    <select class="form-control" name="id_user">
                        <option value="">pilih teknisi</option>
                        @foreach($user as $u)
                        <option value="{{$u->id}}">{{$u->nama_user}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <laebl>Hasil Kunjungan Teknisi</laebl>
                    <input type="text" name="hasil_kunjungan" id="" class="form-control">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <laebl>Kesimpulan Bersama</laebl>
                    <textarea type="text" name="kesimpulan_kunjungan" id="" class="mt-1 form-control"></textarea>
                </div>
            </div>

            <div class="col-md-12 d-flex justify-content-end">
                <a href="/peralatan/{{$peralatan->slug}}" class="btn col-md-2 mx-3 btn-secondary">cancel</a>
                <button type="submit" class="btn col-md-3 btn-primary">simpan</button>
            </div>
        </div>
    </form>

</div>
@endsection