@extends('layouts.main-view')

@section('title', 'Pengajuan Keluhan')
@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 d-sm-inline-block"> @if (Auth::user()->level == 'admin') List pengajuan @else List
        Pengajuan Mu @endif
    </h1>
    <div class="d-none d-sm-inline-block">
        <a href="{{url('peralatan')}}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-ticket fa-sm text-white-50"></i> Ajukan Perbaikan</a>
    </div>
</div>


<!-- Progress DataTales -->
<div class="card shadow mb-4">
    <div class="p-3">
        <div class="table-responsive">
            <table class="table table-hover table-borderless" id="dataTable" width="100%" cellspacing="0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th class="th-start"></th>
                        <th>Tanggal Proses</th>
                        <th>Instansi</th>
                        <th>Serial number</th>
                        <th>Kategori</th>
                        <th>Product Name</th>
                        <th>report by</th>
                        <th>Status</th>
                        <th class="th-end">feedback</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengajuan->reverse() as $items)
                    <tr>
                        <td>
                            <!-- for go to detail use resouce route-->
                            <a href="/pengajuan/{{$items->slug}}" class="btn btn-sm btn-primary">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                        <td>{{$items->created_at}}</td>
                        <td>{{$items->peralatan->instansi->nama_instansi}}</td>
                        <td>{{$items->peralatan->serial_number}}</td>
                        <td>{{$items->peralatan->kategori->nama_kategori}}</td>
                        <td>{{$items->peralatan->produk->nama_produk}}</td>
                        <td>{{$items->user->nama_user}}</td>
                        <td>{{$items->status_pengajuan}}</td>
                        <td>
                            @if($items->status_pengajuan == 'selesai')
                            <!-- untuk feedback good or bad -->
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-success feedback-btn" data-feedback="good">
                                    <i class="fa fa-thumbs-up text-white"></i>
                                </button>
                                <button class="btn btn-danger feedback-btn" data-feedback="bad">
                                    <i class="fa fa-thumbs-down text-white"></i>
                                </button>
                            </div>
                            @else
                            Belum selesai
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Fungsi untuk mengirim feedback ke server
function sendFeedback(id, feedback) {
    $.ajax({
        type: "POST",
        url: "/send-feedback/" + id,
        data: {
            "_token": "{{ csrf_token() }}",
            "feedback": feedback
        },
        success: function(response) {
            // Handle respon jika diperlukan
            if (response.success) {
                alert("Feedback berhasil dikirim!");
            } else {
                alert("Terjadi kesalahan saat mengirim feedback.");
            }
        }
    });
}

// Menambahkan event listener untuk tombol feedback
$(document).on('click', '.feedback-btn', function() {
    var id = $(this).closest('tr').data('id'); // Dapatkan ID tiket dari baris yang sesuai
    var feedback = $(this).data('feedback'); // Dapatkan jenis feedback (good atau bad)

    sendFeedback(id, feedback); // Kirim feedback ke server
});
</script>

@endsection