@extends('layouts.main-view')

@section('content')
<!-- Page Heading -->
<a data-toggle="modal" data-target="#inputMerek" data-target="#inputMerek"
    class="d-sm-inline-block mb-4 btn btn-sm btn-success shadow-sm">
    <i class="fas fa-plus fa-sm text-white-50"></i>Tambahkan Merek</a>

<!-- Logout Modal-->
<div class="modal fade" id="inputMerek" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Input Merek</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('merek.store')}}" method="post">
                    @csrf
                    <input type="text" name="nama_merek" class="mb-4 form-control" autocomplete="off"
                        placeholder="Nama Merek">
                    <button class="btn btn-primary" type="submit">Input</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="card border-left-primary shadow mb-4">
    <div class="p-0">
        <div class="table-responsive">
            <table class="table table-hover m-0" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Merek</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($merk as $index => $items)
                    <tr data-nomor="{{ $index + 1 }}">
                        <td>
                            {{ $index + 1 }}
                        </td>
                        <td class="text-uppercase">
                            {{ $items->nama_merek }}
                        </td>
                        <td>
                            <form action="{{ route('merek.destroy', $items->id) }}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('merek.edit', $items->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger mt-2" onclick="#">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Content Row -->
<script>
function updateNomorUrut() {
    const rows = document.querySelectorAll('tr[data-nomor]');
    rows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
    });
}

document.addEventListener('DOMContentLoaded', () => {
    updateNomorUrut();
});

// Fungsi ini akan dipanggil ketika data dihapus, contoh: setelah submit form hapus
function onDataDeleted() {
    updateNomorUrut();
}
</script>

@endsection