@extends('layouts.main-view')
@section('title', 'Departement Config')

@section('content')
<div class="row gap-2">
    <div class="col-md-5 ">
        <form id="departement-form" class="card shadow p-3">
            <div class="form-group">
                <label for="nama_departement">Nama Departement:</label>
                <input type="text" class="form-control" id="nama_departement" name="nama_departement">
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn">Simpan</button>
            <button type="button" class="btn btn-success" id="update-btn" style="display: none;">Update</button>
            <button type="button" class="btn btn-secondary" id="cancel-btn" style="display: none;">Cancel</button>
        </form>
    </div>
    <div class="col-md-7 card shadow border-left-primary p-0">
        <div class="table-responsive">
            <table class="table table-borderless table-striped" id="table-depart">
                <thead>
                    <tr>
                        <th>Nama Departement</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="departement-data">
                    <!-- di isi dengan ajax -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
// Fungsi untuk menampilkan data departemen
function displayDepartement(data) {
    let tableRows = '';
    data.forEach((value, key) => {
        tableRows += `
            <tr>
                <td>${value.nama_departement}</td>
                <td>
                    <button onclick="editDepartement(${value.id})" class="btn btn-primary">
                        Edit
                    </button>
                    <button onclick="deleteDepartement(${value.id})" class="btn btn-danger">
                        Hapus
                    </button>
                </td>
            </tr>
        `;
    });

    $('#departement-data').html(tableRows);
}

function deleteDepartement(id) {
    if (confirm("Anda yakin ingin menghapus departemen ini?")) {
        $.ajax({
            type: "DELETE",
            url: `/delete-departement/${id}`, // Sesuaikan dengan rute yang benar
            data: {
                "_token": "{{ csrf_token() }}",
            },
            success: function(response) {
                getAllDepartement(); // Muat ulang data departemen setelah penghapusan
            }
        });
    }
}


// Fungsi untuk mengisi formulir dengan data departemen yang akan diedit
function editDepartement(id) {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: `/edit-departement/${id}`, // Sesuaikan dengan rute yang benar
        success: function(response) {
            $('#nama_departement').val(response.nama_departement);
            $('#submit-btn').hide(); // Sembunyikan tombol simpan
            $('#update-btn').show(); // Tampilkan tombol update
            $('#cancel-btn').show(); // Tampilkan tombol cancel
            $('#update-btn').click(function() {
                updateDepartement(id);
            });
            $('#cancel-btn').click(function() {
                cancelEdit();
            });
        }
    });
}

// Fungsi untuk mengirim data departemen yang diedit
function updateDepartement(id) {
    const nama_departement = $('#nama_departement').val();

    $.ajax({
        type: "PUT",
        url: `/update-departement/${id}`, // Sesuaikan dengan rute yang benar
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_departement": nama_departement,
        },
        success: function(response) {
            // Setelah berhasil menyimpan, kosongkan formulir dan tampilkan tombol simpan
            $('#nama_departement').val('');
            $('#submit-btn').show();
            $('#update-btn').hide();
            $('#cancel-btn').hide();
            getAllDepartement(); // Muat ulang data departemen
        }
    });
}

// Fungsi untuk membatalkan edit
function cancelEdit() {
    $('#nama_departement').val('');
    $('#submit-btn').show();
    $('#update-btn').hide();
    $('#cancel-btn').hide();
}

// Fungsi untuk memuat semua data departemen
function getAllDepartement() {
    $.ajax({
        type: "GET",
        dataType: 'json',
        url: "/get-data/departement", // Sesuaikan dengan rute yang benar
        success: function(response) {
            displayDepartement(response);
        }
    });
}

// Panggil fungsi getAllDepartement() saat halaman dimuat
$(document).ready(function() {
    getAllDepartement();
});

// Fungsi untuk menangani submit form
$('#departement-form').submit(function(e) {
    e.preventDefault();
    const nama_departement = $('#nama_departement').val();

    $.ajax({
        type: "POST",
        url: "submit-data/departement", // Sesuaikan dengan rute yang benar
        data: {
            "_token": "{{ csrf_token() }}",
            "nama_departement": nama_departement,
        },
        success: function(response) {
            $('#nama_departement').val('');
            getAllDepartement(); // Muat ulang data departemen
        }
    });
});
</script>
@endsection