@extends('layouts.main-view')
@section('title', 'Creating New Instansi')

@section('content')
<style>
.d-flex .line-bottom {
    border-bottom: 1px solid #000;
    padding-bottom: 2px;
    margin-right: 10px;
}
</style>
<div class="d-flex">
    <a href="{{ route('home') }}" class="btn mr-4 btn-secondary">Batalakan</a>

    <div class="d-flex ml-auto btn-group">
        <button class="btn btn-primary" id="prevPage">Previous</button>
        <button class="btn btn-success" id="nextPage">Next</button>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<form action="{{route('survey.store-data')}}" method="post">
    @csrf

    <div class="instansi-form">
        <div class="card shadow mt-3 p-3 border-left-primary">
            <h2 class="m-0 p-0">Input Data Rumah Sakit / Institusi</h2>
            <form action="{{ route('instansi.store') }}" method="POST" class="mt-3" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6 ">
                        <label for="role">{{ __('Nama Rumah Sakit / Institusi') }}</label>
                        <select id="departemen-select" class="form-control @error('role') is-invalid @enderror"
                            name="nama_instansi">
                            <option value="">-- Select Role --</option>
                            @foreach($instansi as $instansi)
                            <option value="{{$instansi->id}}">{{$instansi->nama_instansi}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="jumlah-bed">Jumlah Bed</label>
                        <input type="number" class="form-control" name="jumlah_kasur" placeholder="0">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pic">Jenis Instansi</label>
                        <input type="text" class="form-control" name="jenis_instansi" placeholder="tulis jenisnya">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image">Image</label>
                        <input type="file" class="form-control form-control-file p-0" id="image" name="photo_instansi">
                    </div>
                    <div class="form-group col-md-12">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="editor" name="alamat_instansi" rows="3"
                            placeholder="your alamat in here"></textarea>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="pic-form" style="display:none;">
        <div class="card p-3 mt-3 border-left-primary shadow">
            <h2 class="m-0 p-0">Input User PIC</h2>
            <div class="row">

                <div class="form-group col-md-6">
                    <label>{{ __('Name User') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="nama_user"
                        required autocomplete="off" autofocus>
                </div>

                <div class="form-group col-md-6">
                    <label class="">{{ __('Email') }}</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" required
                        autocomplete="off">
                </div>


                <div class="form-group col-md-6">
                    <label for="email" class="">{{ __('Nomor Telepon') }}</label>
                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror"
                        name="nomor_telepon" required autocomplete="off">

                </div>

                <div class="form-group col-md-6 " id="roleField">
                    <label for="role">{{ __('Departement') }}</label>
                    <select id="departemen-select" class="form-control @error('role') is-invalid @enderror"
                        name="user_departement">
                        <option value="">-- Select Role --</option>
                        @foreach($departement as $dep)
                        <option value="{{$dep->id}}">{{$dep->nama_departement}}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group col-md-6">
                    <label>{{ __('Jenis Kelamin') }}</label>
                    <select class="form-control @error('role') is-invalid @enderror" name="jenis_kelamin">
                        <option value="">-- Select Gender --</option>
                        <option value="laki-laki">Laki-Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mt-3 col-md-12">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" id="editor" name="alamat_user"
                        placeholder="your alamat in here"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="peralatan-form" style="display: none;">
        <div class="card p-3 mt-3 shadow border-left-primary">
            <h2 class="m-0 p-0">Input Data Peralatan</h2>

            <div class="row gap-2">
                <div class="form-group col-md-6">
                    <label for="kategori">Nama Kategori</label>
                    <select class="form-control kategori-select" name="id_kategori[]">
                        <option>-- PILIH --</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="merk">Nama Merk</label>
                    <select class="form-control" name="id_merek[]">
                        <option>-- PILIH --</option>
                        @foreach($merek as $merks)
                        <option value="{{ $merks->id }}">{{ $merks->nama_merek }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="text" class="departemenInput" name="id_departement[]" value="" hidden>
                <input type="text" name="id_user[]" value="{{ Auth::user()->id }}" hidden>

                <div class="form-group col-md-6 produk-group" style="display: none;">
                    <label for="merk">Nama Product</label>
                    <select class="form-control product-select" name="id_product[]">
                        <!-- Opsi produk akan diisi melalui JavaScript -->
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Usia Barang</label>
                    <input type="number" class="form-control pertahun-product" name="usia_barang[]"
                        placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                    <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
                </div>
                <div class="form-group col-md-6">
                    <label>Serial Number</label>
                    <input type="text" class="form-control" name="serial_number[]" placeholder="Serial Number">
                </div>

                <div class="form-group col-md-6">
                    <label>Tahun Pemasangan</label>
                    <input type="text" class="form-control" name="tahun_pemasangan[]" id="tahun-pemasangan"
                        placeholder="Tahun Pemasangan">
                </div>
            </div>
            <a class="addmultiplealat btn ml-auto btn-primary"><i class="fa fa-plus"></i></a>
        </div>

    </div>

    <button type="submit" id="btn-submit" class="ml-auto mt-3 btn btn-primary" style="display: none;">Create</button>
</form>

<script>
// Initialize currentPage and totalPages
var currentPage = 1;
var totalPages = 3; // Update this with the total number of pages

// Function to show the current page
function showPage(pageNumber) {
    // Hide all form sections
    $('.peralatan-form').hide();
    $('#btn-submit').hide();

    // Show the form section for the current page
    if (pageNumber === 1) {
        $('.pic-form').hide();
        $('.instansi-form').show();
        $('.peralatan-form').hide();
        $('#btn-submit').hide();
    } else if (pageNumber === 2) {
        $('.instansi-form').hide();
        $('.pic-form').show();
    } else if (pageNumber === 3) {
        $('.pic-form').hide();
        $('.instansi-form').hide();
        $('.peralatan-form').show();
        $('#btn-submit').show();
    }

    // Update any other UI elements as needed
}

// Event listener for the "Next" button
$('#nextPage').click(function() {
    if (currentPage < totalPages) {
        currentPage++;
        showPage(currentPage);
    }
});

// Event listener for the "Previous" button
$('#prevPage').click(function() {
    if (currentPage > 1) {
        currentPage--;
        showPage(currentPage);
    }
});


// Gabungkan logika pengaturan opsi produk dan kategori dalam satu fungsi
function setOptions(selectElement, options, idField, textField, filterField, filterValue) {
    selectElement.innerHTML = '<option>-- PILIH --</option>';

    options.forEach(option => {
        if (!filterField || option[filterField] == filterValue) {
            const optionElement = document.createElement('option');
            optionElement.value = option[idField];
            optionElement.textContent = option[textField];
            selectElement.appendChild(optionElement);
        }
    });
}


function setProductAndCategoryOptions() {
    const departemenSelect = document.getElementById('departemen-select');
    const kategoriSelects = document.querySelectorAll('select.kategori-select');
    const productSelects = document.querySelectorAll('select.product-select');
    const formGroupInputs = document.querySelectorAll('.produk-group');
    const departemenInputs = document.querySelectorAll('.departemenInput');
    const products = @json($produk);
    const kategori = @json($kategori);

    console.log('Data Produk:', @json($produk));
    console.log('Data Kategori:', @json($kategori));

    // Event listener saat departemen dipilih
    departemenSelect.addEventListener('change', function() {
        const selectedDepartemenId = departemenSelect.value;
        const allowedDepartments = ['purchasing', 'ips rs'];
        console.log(selectedDepartemenId);

        if (allowedDepartments.includes(selectedDepartemenId)) {
            $('#btn-submit').show(); // Menampilkan tombol "Create"
            $('.peralatan-form').show(); // Menampilkan form peralatan
        } else {
            $('#btn-submit').hide(); // Menyembunyikan tombol "Create"
            $('.peralatan-form').hide(); // Menyembunyikan form peralatan
        }

        // Kosongkan opsi kategori saat ini di semua select dengan kelas kategori-select
        kategoriSelects.forEach((kategoriSelect, index) => {
            kategoriSelect.innerHTML = '';

            // Tambahkan opsi pertama
            const defaultOption = document.createElement('option');
            defaultOption.text = '-- PILIH --';
            kategoriSelect.add(defaultOption);

            // Filter kategori sesuai dengan departemen yang dipilih
            kategori.forEach(function(kat) {
                if (kat.id_departement == selectedDepartemenId) {
                    const option = document.createElement('option');
                    option.value = kat.id;
                    option.text = kat.nama_kategori;
                    kategoriSelect.add(option);
                }
            });

            kategoriSelect.addEventListener('change', function() {
                const selectedCategoryId = kategoriSelect.value;

                // Clear existing options di semua select dengan kelas product-select
                productSelects.forEach(productSelect => {
                    productSelect.innerHTML = '<option>-- PILIH --</option>';
                });

                if (selectedCategoryId === '-- PILIH --') {
                    formGroupInputs[index].style.display = 'none';
                } else {
                    formGroupInputs[index].style.display = 'block';

                    // Sekarang kita bisa mendapatkan selectedCategory
                    const selectedCategory = kategori.find(departement => departement.id ==
                        selectedCategoryId);

                    // Panggil setOptions untuk opsi produk
                    setOptions(productSelects[index], products, 'id', 'nama_produk',
                        'id_kategori', selectedCategoryId);

                    departemenInputs[index].value = selectedCategory.id_departement;

                    console.log('ID Kategori yang Dipilih:', selectedCategoryId);
                    console.log('Kategori yang Dipilih:', selectedCategory);
                    console.log('Input Departemen:', departemenInputs[index]);
                    console.log('Valur Departemen:', departemenInputs[index].value);
                    console.log('Product yang Dipilih:', productSelects[index], products, 'id',
                        'nama_produk', 'id_kategori', selectedCategoryId);
                }
            });
        });
    });
}

// Fungsi untuk membatasi nilai input usia produk antara 5 dan 10
function limitAgeInput() {
    const pertahunProductInputs = document.querySelectorAll('.pertahun-product');

    pertahunProductInputs.forEach(pertahunProductInput => {
        pertahunProductInput.addEventListener('input', function() {
            let value = parseFloat(pertahunProductInput.value);

            if (value > 10) {
                pertahunProductInput.value = 10;
            } else if (value < 5) {
                pertahunProductInput.value = 5;
            }
        });
    });
}

function addPelaratan() {
    var datamultipleinputalat = `
    <div class="card p-3 mt-3 shadow border-left-primary">
            <h2 class="m-0 p-0">Input Data Peralatan</h2>
            
            <div class="row gap-2">
                <div class="form-group col-md-6">
                    <label for="kategori">Nama Kategori</label>
                    <select class="form-control kategori-select" name="id_kategori[]" >
                        <option>-- PILIH --</option>
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label for="merk">Nama Merk</label>
                    <select class="form-control" name="id_merek[]">
                        <option>-- PILIH --</option>
                        @foreach($merek as $merks)
                        <option value="{{ $merks->id }}">{{ $merks->nama_merek }}</option>
                        @endforeach
                    </select>
                </div>

                <input type="text" class="departemenInput" name="id_departement[]" value="" hidden>
                <input type="text" name="id_user[]" value="{{ Auth::user()->id }}" hidden>

                <div class="form-group col-md-6 produk-group" style="display: none;">
                    <label for="merk">Nama Product</label>
                    <select class="form-control product-select" name="id_product[]">
                        <!-- Opsi produk akan diisi melalui JavaScript -->
                    </select>
                </div>

                <div class="form-group col-md-6">
                    <label>Usia Barang</label>
                    <input type="number" class="form-control pertahun-product" name="usia_barang[]"
                        placeholder="patokan nnilai ini akan berkurang sasuia tahun nya">
                    <small class="text-muted">Hanya bisa 5 sampai 10 tahun</small>
                </div>
                <div class="form-group col-md-6">
                    <label>Serial Number</label>
                    <input type="text" class="form-control" name="serial_number[]"
                        placeholder="Serial Number">
                </div>

                <div class="form-group col-md-6">
                    <label>Tahun Pemasangan</label>
                    <input type="text" class="form-control" name="tahun_pemasangan[]" id="tahun-pemasangan"
                        placeholder="Tahun Pemasangan">
                </div>
            </div>
            <a class="remove-alat btn ml-auto btn-primary"><i class="fa fa-trash"></i></a>
        </div>`;
    $('.peralatan-form').append(datamultipleinputalat);
    // Set ulang opsi produk dan kategori untuk elemen yang baru ditambahkan
    setProductAndCategoryOptions();
    limitAgeInput();
}


// Panggil fungsi-fungsi ini saat dokumen sudah dimuat sepenuhnya
document.addEventListener('DOMContentLoaded', function() {
    $('.addmultiplealat').click(function() {
        addPelaratan(); // Menggunakan "addPelaratan()" yang benar
    });

    $('.peralatan-form').on('click', '.remove-alat', function() {
        $(this).parent().remove();
    });

    // Inisialisasi ketika dokumen dimuat pertama kali
    setProductAndCategoryOptions();
    limitAgeInput();
});
</script>
@endsection