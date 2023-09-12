@extends('layouts.main-view')

@section('content')
<!-- Content Row -->
<div class="row gap-2">
    <div class="col-md-5 mb-4">
        <input type="text" id="searchInput" class="form-control mb-4" placeholder="Search by Name">
        <div class="card shadow">
            <div class="card-header mb-2" id="title-card">Add New part</div>
            <div class="card-body p-3">
                <form>
                    <input type="text" name="kode_part" id="kode_part" class="mb-4 form-control" autocomplete="off" placeholder="tuliskan kode partnya">
                    <select name="id_kategori" id="id_kategori" class="form-control mb-4">
                        <option value="">Pilih kategori</option>
                        @foreach($kategori as $items)
                        <option value="{{ $items->id }}">{{ $items->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="nama_part" id="nama_part" class="mb-4 form-control" autocomplete="off"
                        placeholder="Apa nama partnya">
                    <button class="btn btn-primary" id="addDataBtn" type="button" onclick="addData()">Input</button>
                    <button class="btn btn-success" id="updateDataBtn" type="button"
                        onclick="updateData()">Edit</button>
                    <button class="btn btn-secondary" id="cancelBtn" type="button"
                        onclick="cancelEdit()">Cancel</button>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-7">
        <div class="card border-left-primary shadow">
            <div class="p-0">
                <div class="table-responsive">
                    <table id="partTable" class="table table-hover m-0" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode part</th>
                                <th>Nama part</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="data_part">
                            <!-- Data akan diisi melalui AJAX -->
                        </tbody>
                    </table>
                </div>
                <div id="pagination" class="m-2"></div>
            </div>
        </div>
    </div>
</div>

<!-- CRUD AJAX Script -->
<script>
const itemsPerPage = 5; // Jumlah item per halaman
let currentPage = 1; // Halaman saat ini
let editingCategoryId = null; // ID part yang sedang diedit

$('#updateDataBtn').hide();
$('#cancelBtn').hide();


function editData(id) {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/edit-part/" + id,
        success: function(response) {
            $('#kode_part').val(response.kode_part);
            $('#id_kategori').val(response.id_kategori);
            $('#nama_part').val(response.nama_part);

            $('#updateDataBtn').click(function() {
                updateData(response.id);
            });

            $('#updateDataBtn').show();
            $('#cancelBtn').show();
            $('#title-card').html('Edit part');
            $('#addDataBtn').hide();
        }
    });
}


function cancelEdit() {
    editingCategoryId = null;
    $('#kode_part').val('');
    $('#id_kategori').val('');
    $('#nama_part').val('');
    $('#updateDataBtn').hide();
    $('#cancelBtn').hide();
    $('#title-card').html('Add New part');
    $('#addDataBtn').show();
}

function deleteData(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        $.ajax({
            type: "DELETE",
            url: "/delete-part/" + id,
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                getAllData();
            }
        });
    }
}

function displayData(data) {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    const dataToDisplay = data.slice(startIndex, endIndex);

    let tableRows = '';
    dataToDisplay.forEach((value, key) => {
        tableRows += `
                    <tr>
                        <td>${key + 1}</td>
                        <td>${value.kode_part}</td>
                        <td>${value.nama_part}</td>
                        <td>
                            <button onclick="editData(${value.id})" class="btn btn-primary">
                                <i class="fa fa-pen-to-square text-white"></i>
                            </button>
                            <button onclick="deleteData(${value.id})" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                `;
    });

    $('.data_part').html(tableRows);
    updateNomorUrut();
}

function updatePagination(data) {
    const totalPages = Math.ceil(data.length / itemsPerPage);
    let paginationButtons = '';

    for (let i = 1; i <= totalPages; i++) {
        paginationButtons += `
            <button class="btn" onclick="changePage(${i})">${i}</button>
        `;
    }

    $('#pagination').html(paginationButtons);
}

function changePage(page) {
    currentPage = page;
    displayData(data);
}

getAllData();

function getAllData() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/get-data/part",
        success: function(response) {
            data = response; // Simpan data di variabel global
            displayData(data);
            updatePagination(data);
        }
    });
}

function addData() {
    var nama_part = $('#nama_part').val();
    var id_kategori = $('#id_kategori').val();
    var kode_part = $('#kode_part').val(); // Tambahkan baris ini

    $.ajax({
        type: "POST",
        url: "{{ route('part.store') }}",
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_part": nama_part,
            "id_kategori": id_kategori,
            "kode_part": kode_part // Tambahkan ini
        },
        success: function(response) {
            getAllData();
            $('#nama_part').val('');
            $('#id_kategori').val('');
            $('#kode_part').val(''); // Kosongkan input kode_part
        }
    });
}

function updateData(id) {
    var nama_part = $('#nama_part').val();
    var id_kategori = $('#id_kategori').val();
    var kode_part = $('#kode_part').val();

    $.ajax({
        type: "PUT",
        url: `/update-part/${id}`, // Anda perlu mengirimkan ID sebagai bagian dari URL
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_part": nama_part,
            "id_kategori": id_kategori,
            "kode_part": kode_part
        },
        success: function(response) {
            getAllData();
            $('#nama_part').val('');
            $('#id_kategori').val('');
            $('#kode_part').val('');
            cancelEdit();
        }
    });
}

</script>
@endsection