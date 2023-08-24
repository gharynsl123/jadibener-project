@extends('layouts.main-view')

@section('content')
<!-- Content Row -->
<div class="row gap-2">
    <div class="col-md-7">
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
                        <tbody id="data_merek">
                            <!-- Data akan diisi melalui AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header mb-2">testing app</div>
            <div class="card-body p-3">
                <form action="{{ route('merek.store') }}" method="post">
                    @csrf
                    <input type="text" name="nama_merek" class="mb-4 form-control" autocomplete="off" placeholder="Nama Merek">
                    <button class="btn btn-primary" type="submit">Input</button>
                    <button class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
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

function getAllData() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/get-data/merek",
        success: function(response) {
            let data = "";
            $.each(response, function(key, value) {
                data += `
                    <tr>
                        <td>${key + 1}</td>
                        <td>${value.nama_merek}</td>
                        <td>
                            <form action="{{ route('merek.destroy', '') }}/${value.id}" method="post">
                                @csrf
                                {{ method_field('DELETE') }}
                                <a href="{{ route('merek.edit', '') }}/${value.id}" class="btn btn-primary">
                                    <i class="fa fa-pen-to-square text-white"></i>
                                </a>
                                <button type="submit" class="btn btn-danger mt-2">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                `;
            });
            $('#data_merek').html(data);
            updateNomorUrut();
        }
    });
}

getAllData();

</script>


@endsection
