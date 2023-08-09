@section('content')
    <div class="card shadow border-0 rounded-3">
        <div class="card-body">
            <h3 class="card-title">Costumer Tiket</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemohon</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Keluhan</th>
                            <th scope="col">Jadwal Kedatangan</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Progress</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($progress as $p)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $p->pengajuan->user->name }}</td>
                            <td>{{ $p->pengajuan->peralatan->produk->nama_produk }}</td>
                            <td>{{ $p->pengajuan->peralatan->instansi->instasi }}</td>
                            <td>{{ $p->pengajuan->subject_masalah }}</td>
                            <td>
                                @if($p->jadwal == null)
                                <p class="text-white badge bg-danger">test</p>
                                @else
                                {{ $p->jadwal }}
                                @endif
                            </td>
                            <td>{{ $p->pengajuan->peralatan->kategori->nama_kategori }}</td>
                            <td>{{ $p->progress }}</td>
                            <td>
                                <!-- For going to detail using resource route-->
                                <a href="/pengajuan/{{$p->pengajuan->slug}}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
