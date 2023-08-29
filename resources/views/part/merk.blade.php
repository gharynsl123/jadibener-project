@extends('layouts.main-view')

@section('content')
<!-- Content Row -->
<div class="row gap-2">
    <div class="col-md-5 mb-4">
        <input type="text" id="searchInput" class="form-control mb-4" placeholder="Search by Name">
        <div class="card shadow">
            <div class="card-header mb-2" id="title-card">Add New Merek</div>
            <div class="card-body p-3">
                <form>
                    <input type="text" name="nama_merek" id="nama_merek" class="mb-4 form-control" autocomplete="off" placeholder="Nama Merek">
                    <button class="btn btn-primary" id="addDataBtn" type="button" onclick="addData()">Input</button>
                    <button class="btn btn-success" id="updateDataBtn" type="button" onclick="updateData()">Edit</button>
                    <button class="btn btn-secondary" id="cancelBtn" type="button" onclick="cancelEdit()">Cancel</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-7 ">
        <div class="card border-left-primary shadow ">
            <div class="p-0">
                <div class="table-responsive">
                    <table id="merekTable" class="table table-hover m-0" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Merek</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="data_merek">
                            <!-- Data akan diisi melalui AJAX -->
                        </tbody>
                    </table>
                </div>
                <div id="pagination" class="m-2"></div>
            </div>
        </div>
    </div>
</div>
<script>
const itemsPerPage = 5; // Jumlah item per halaman
let currentPage = 1; // Halaman saat ini

$('#searchInput').on('input', function() {
    const searchTerm = $(this).val().toLowerCase();
    const filteredData = data.filter(item => item.nama_merek.toLowerCase().includes(searchTerm));

    displayData(filteredData);
    updatePagination(filteredData);
});

function updateNomorUrut() {
    const rows = document.querySelectorAll('tr[data-nomor]');
    rows.forEach((row, index) => {
        row.querySelector('td:first-child').textContent = index + 1;
    });
}

$('#updateDataBtn').hide();
$('#cancelBtn').hide();

document.addEventListener('DOMContentLoaded', () => {
    updateNomorUrut();
});

function displayData(data) {
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    const dataToDisplay = data.slice(startIndex, endIndex);

    let tableRows = '';
    dataToDisplay.forEach((value, key) => {
        tableRows += `
                    <tr>
                        <td>${key + 1}</td>
                        <td>${value.nama_merek}</td>
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

    $('.data_merek').html(tableRows);
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
        url: "/get-data/merek",
        success: function(response) {
            data = response; // Simpan data di variabel global
            displayData(data);
            updatePagination(data);

            // Menambah event listener pada form penghapusan
            $('.delete-form').on('submit', function(event) {
                event.preventDefault();
                let deleteUrl = $(this).data('delete-url');
                $.ajax({
                    type: 'DELETE',
                    url: deleteUrl,
                    success: function() {
                        getAllData(); // Memuat ulang data setelah penghapusan berhasil
                    }
                });
            });
        }
    });
}

function addData() {
    var namaMerek = $('#nama_merek').val();

    $.ajax({
        type: "POST",
        url: "{{ route('merek.store') }}",
        data: {
            "_token": "{{ csrf_token() }}", // Pastikan token CSRF disertakan
            "nama_merek": namaMerek
        },
        success: function(response) {
            // Panggil fungsi getAllData() untuk mereload data
            getAllData();
            // Kosongkan input setelah data berhasil ditambahkan
            $('#nama_merek').val('');
        }
    });
}

function editData(id) {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/edit-merek/" + id,
        success: function(response) {
            $('#nama_merek').val(response.nama_merek);

            $('#updateDataBtn').click(function () {
                updateData(response.id); // Berikan parameter id dari response
            });

            // Ubah tombol dan fungsi pada form input
            $('#updateDataBtn').show();
            $('#cancelBtn').show();
            $('#title-card').html('Edit Merek');
            $('#addDataBtn').hide();
        }
    });
}

function updateData() {
    var namaMerek = $('#nama_merek').val();

    $.ajax({
        type: "PUT",
        url: "/update-merek/" + id,
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_merek": namaMerek
        },
        success: function(response) {
            getAllData();
            $('#nama_merek').val('');

            cancelEdit();
            $('#updateDataBtn').hide();
            $('#addDataBtn').show();
        }
    });
}


function cancelEdit() {
    editingCategoryId = null;
    $('#nama_merek').val('');
    $('#updateDataBtn').hide();
    $('#cancelBtn').hide();
    $('#title-card').html('Add New kategori');
    $('#addDataBtn').show();
}

function updateData(id) {
    var namaMerek = $('#nama_merek').val();

    $.ajax({
        type: "PUT",
        url: "/update-merek/" + id,
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_merek": namaMerek
        },
        success: function(response) {
            getAllData();
            $('#nama_merek').val('');
            $('#title-card').html('Add New Merek');

            $('#updateDataBtn').hide();
            $('#addDataBtn').show();
        }
    });
}

function deleteData(id) {
    if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
        $.ajax({
            type: "DELETE",
            url: "/delete-merek/" + id,
            data: {
                "_token": "{{ csrf_token() }}"
            },
            success: function(response) {
                getAllData();
            }
        });
    }
}
</script>
@endsection
