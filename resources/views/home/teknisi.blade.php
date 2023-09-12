@section('content')
    <div class="card shadow border-0 rounded-3 border-left-primary">
        <div class="card-body">
            <h3 class="card-title">Costumer Tiket</h3>
            <div class="table-responsive">
                <table class="table table-borderless table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Pemohon</th>
                            <th scope="col">Nama Produk</th>
                            <th scope="col">Instansi</th>
                            <th scope="col">Keluhan</th>
                            @if(Auth::user()->level == 'teknisi' && Auth::user()->role == 'kap_teknisi')
                            @else
                            <th>jadwal</th>
                            <th scope="col">Progress</th>
                            @endif
                            <th scope="col">Kategori</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(Auth::user()->level == 'teknisi' && Auth::user()->role == 'kap_teknisi')
                        @foreach($pengajuan as $p)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $p->user->nama_user }}</td>
                            <td>{{ $p->peralatan->produk->nama_produk }}</td>
                            <td>{{ $p->peralatan->instansi->nama_instansi }}</td>
                            <td>{{ $p->judul_masalah }}</td>
                            <td>{{ $p->peralatan->kategori->nama_kategori }}</td>
                            <td>
                                <!-- For going to detail using resource route-->
                                <a href="/pengajuan/{{$p->slug}}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @elseif(Auth::user()->level == 'teknisi')
                        @foreach($progress as $p)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $p->pengajuan->user->nama_user }}</td>
                            <td>{{ $p->pengajuan->peralatan->produk->nama_produk }}</td>
                            <td>{{ $p->pengajuan->peralatan->instansi->nama_instansi }}</td>
                            <td>{{ $p->pengajuan->judul_masalah }}</td>
                            <td>
                                @if($p->jadwal == null)
                                <p class="text-white badge bg-danger">belum di ajukan</p>
                                @else
                                {{ $p->jadwal }}
                                @endif
                            </td>
                            <td>{{ $p->nilai_pengerjaan }} %</td>
                            <td>{{ $p->pengajuan->peralatan->kategori->nama_kategori }}</td>
                            <td>
                                <!-- For going to detail using resource route-->
                                <a href="/pengajuan/{{$p->pengajuan->slug}}" class="btn btn-primary">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection