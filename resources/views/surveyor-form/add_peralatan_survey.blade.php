@extends('layouts.main-view')

@section('title', 'Tambah Perlatan Untuk')

@section('content')
<form action="{{route('survey.store-alat', $user->id)}}" method="post">
    <a href="{{ route('instansi.index') }}" class="btn mr-4 btn-secondary">Batalakan</a>
    @csrf
    <div class="peralatan-form">
        <div class="card p-3 mt-3 shadow border-left-primary">
            <h2 class="m-0 p-0">Input Data Peralatan</h2>
            <input type="text" class="departemenInput" name="id_departement[]" hidden value="{{$user->departement}}" >
            <input type="text" name="id_instansi[]"hidden value="{{$user->instansi->id}}" >
            <input type="text" name="id_user[]"hidden value="{{ Auth::user()->id }}">
    
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


                <div class="form-group col-md-6 produk-group" style="display: none;">
                    <label for="merk">Nama Product</label>
                    <select class="form-control product-select" id="id-product-select" name="id_product[]">
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
    <button class="mt-3 btn btn-primary" type="submit">create</button>
</form>
@endsection

@section('custom-js')
<script>


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
    
    function addPeralatan() {
        var datamultipleinputalat = `
        <div class="card p-3 mt-3 shadow border-left-primary">
            <h2 class="m-0 p-0">Input Data Peralatan</h2>
            <input type="text" class="departemenInput" name="id_departement[]" hidden value="{{$user->departement}}" >
            <input type="text" name="id_instansi[]" hidden value="{{$user->instansi->id}}" >
            <input type="text" name="id_user[]" hidden value="{{ Auth::user()->id }}">
    
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
            <a class="remove-alat btn ml-auto btn-danger"><i class="fa fa-trash"></i></a>
        </div>
        `;
        $('.peralatan-form').append(datamultipleinputalat);
    
        // Set ulang opsi produk dan kategori untuk elemen yang baru ditambahkan
        setProductAndCategoryOptions();
        limitAgeInput();
    }

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
        const kategoriSelects = document.querySelectorAll('select.kategori-select');
        const productSelects = document.querySelectorAll('select.product-select');
        const formGroupInputs = document.querySelectorAll('.produk-group');
        const departemenInputs = document.querySelectorAll('.departemenInput');
        const kategori = @json($kategori);
        const products = @json($produk);

        // Get the selected departement value from the departemenInput
        const selectedDepartemenId = departemenInputs[departemenInputs.length - 1].value;

        // Kosongkan opsi kategori saat ini di semua select dengan kelas kategori-select
        kategoriSelects.forEach((kategoriSelect, index) => {
            kategoriSelect.innerHTML = '';

            // Tambahkan opsi pertama
            const defaultOption = document.createElement('option');
            defaultOption.text = '-- PILIH --';
            kategoriSelect.add(defaultOption);

            // Filter kategori sesuai dengan departemen yang dipilih
            kategori.forEach(function(kat) {
                if (kat.departement == selectedDepartemenId) {
                    const option = document.createElement('option');
                    option.value = kat.id;
                    option.text = kat.nama_kategori;
                    kategoriSelect.add(option);
                }
            });

            // Panggil event listener untuk mengatur opsi produk dan departemen
            kategoriSelect.dispatchEvent(new Event('change'));
        });

        // Event listener saat kategori dipilih (dalam loop)
        kategoriSelects.forEach((kategoriSelect, index) => {
            kategoriSelect.addEventListener('change', function() {
                const selectedCategoryId = kategoriSelect.value;
                const selectedDepartemenId = departemenInputs[index].value;

                // Clear existing options di semua select dengan kelas product-select
                productSelects[index].innerHTML = '<option>-- PILIH --</option>';

                if (selectedCategoryId === '-- PILIH --') {
                    formGroupInputs[index].style.display = 'none';
                } else {
                    formGroupInputs[index].style.display = 'block';

                    // Filter produk berdasarkan departemen dan kategori yang dipilih
                    products.forEach(function(products) {
                        if (
                            products.id_kategori == selectedCategoryId &&
                            products.departement == selectedDepartemenId
                        ) {
                            const option = document.createElement('option');
                            option.value = products.id;
                            option.text = products.nama_produk;
                            productSelects[index].add(option);
                        }
                    });
                }
            });
        });

        
    }

    // Panggil fungsi-fungsi ini saat dokumen sudah dimuat sepenuhnya
    document.addEventListener('DOMContentLoaded', function() {
        $('.addmultiplealat').click(function() {
            addPeralatan();
        });

        $('#id-product-select').select2();

        $('.peralatan-form').on('click', '.remove-alat', function() {
            $(this).parent().remove();
        });

        // Inisialisasi ketika dokumen dimuat pertama kali
        setProductAndCategoryOptions();
        limitAgeInput();
    });
</script>

@endsection