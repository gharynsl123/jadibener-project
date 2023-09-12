<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // guest only
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'role:admin,teknisi,surveyor,sub_service']], function () {
    // Definisikan rute yang bisa diakses oleh pengguna dengan peran "admin" atau "teknisi" di sini

    // Instansi Route
    Route::get('/instansi', 'InstansiController@index')->name('instansi.index');
    Route::get('/make/instansi', 'InstansiController@create')->name('instansi.create');
    Route::get('/edit-instansi/{id}', 'InstansiController@edit')->name('instansi.edit');
    Route::put('/update-instansi/{id}', 'InstansiController@update')->name('instansi.update');
    Route::get('/detail-instansi/{id}', 'InstansiController@show')->name('instansi.show');
    Route::post('/add-instansi', 'InstansiController@store')->name('instansi.store');
    Route::delete('/delete-instansi/{id}', 'InstansiController@destroy')->name('instansi.destroy');
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // User Route
    Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/make/users', 'UserController@create')->name('users.create');
    Route::post('/add-users', 'UserController@store')->name('users.store');
    Route::get('/edit-users/{id}', 'UserController@edit')->name('user.edit');
    Route::put('/update-users/{id}', 'UserController@update')->name('users.update');
    Route::delete('/delete-users/{id}', 'UserController@destroy')->name('users.destroy');
});

// Home Route
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-process-ticket-count', 'HomeController@getProcessTicketCount');
Route::get('/get-pending-count', 'HomeController@getPendingCount');
Route::get('/get-proses-count', 'HomeController@getProsesCount');
Route::get('/get-selesai-count', 'HomeController@getSolvedCount');


// status Route
Route::resource('status', 'StatusController');

// Ajax Route Get Data
Route::get('/get-data/merek', 'MerekController@dataMerek')->name('merek.data');
Route::get('/get-data/kondisi', 'KondisiController@dataKondisi')->name('kondisi.data');
Route::get('/get-data/kategori', 'KategoriController@dataKategori')->name('kategori.data');
Route::get('/get-data/part', 'PartController@dataPart')->name('part.data');
Route::get('/get-pengajuan', 'PengajuanController@getPengajuan')->name('pengajuan.get');


// informasi Route
Route::get('/informasi', 'InformasiController@index')->name('informasi.index');
Route::get('/detail-informasi/{id}', 'InformasiController@show')->name('informasi.show');
Route::post('/add-informasi', 'InformasiController@store')->name('informasi.store');

// Merek Route
Route::get('merek', 'MerekController@index')->name('merek.index');
Route::post('/create-data-merek', 'MerekController@store')->name('merek.store');
Route::delete('/delete-merek/{id}', 'MerekController@destroy')->name('merek.destroy');
Route::get('/edit-merek/{id}', 'MerekController@edit')->name('merek.edit');
Route::put('/update-merek/{id}', 'MerekController@update')->name('merek.update');


Route::get('/kategori', 'KategoriController@index')->name('kategori.index');
Route::post('/create-data-kategori', 'KategoriController@store')->name('kategori.store');
Route::delete('/delete-kategori/{id}', 'KategoriController@destroy')->name('kategori.destroy');
Route::get('/edit-kategori/{id}', 'KategoriController@edit')->name('kategori.edit');
Route::put('/update-kategori/{id}', 'KategoriController@update')->name('kategori.update');

// DOM PDF LAPORAN
Route::get('/peralatan-cetak-pdf', 'PrintController@peralatanCetakPdf')->name('peralatan.cetak_pdf');
Route::get('/estimasi-cetak-pdf/{id}', 'PrintController@estimasiCetakPdf')->name('estimasi.cetak_pdf');
Route::get('/instansi-cetak-pdf', 'PrintController@instansiCetakPdf')->name('instansi.cetak_pdf');
Route::get('/laporan-cetak-pdf/{id}', 'PrintController@laporanCetakPdf')->name('laporan.cetak_pdf');
Route::get('/alat-cetak-pdf/{slug}', 'PrintController@alatCetakPdf')->name('alat.cetak_pdf');
Route::get('/pengajuan-cetak-pdf/{slug}', 'PrintController@pengajuanCetakPdf')->name('pengajuan.cetak_pdf');

// import route
Route::post('/import-instansi', 'InstansiController@import')->name('import.instansi');
Route::post('/import-produk', 'ProdukController@import')->name('import.produk');
Route::post('/import-kategori', 'KategoriController@import')->name('import.kategori');
Route::post('/import-user', 'UserController@import')->name('import.user');
Route::post('/import-peralatan', 'PeralatanController@import')->name('import.peralatan');

// jadwal teknisi Route
Route::get('/atur/jadwal-teknisi/{slug}', 'JadwalController@create')->name('jadwal.create');
Route::get('/jadwal-teknisi', 'JadwalController@index')->name('jadwal.index');
Route::post('/add-jadwal-teknisi/{slug}', 'JadwalController@store')->name('jadwal.store');


// produk Route
Route::get('/produk', 'ProdukController@index')->name('produk.index');
Route::get('/detail-produk/{id}', 'ProdukController@show')->name('produk.show');
Route::get('/make/produk', 'ProdukController@create')->name('produk.create');
Route::get('/edit-produk/{slug}', 'ProdukController@edit')->name('produk.edit');
Route::put('/update-produk/{id}', 'ProdukController@update')->name('produk.update');
Route::post('/create-data-produk', 'ProdukController@store')->name('produk.store');
Route::delete('/delete-data-produk/{id}', 'ProdukController@destroy')->name('produk.destroy');

// Pengajuan Route
// Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuan.index');
Route::post('/update-pengajuan/{id}', 'PengajuanController@update')->name('pengajuan.update');
Route::get('/make/pengajuan/{slug}', 'PengajuanController@create')->name('pengajuan.create');
Route::post('/add-pengajuan', 'PengajuanController@store')->name('pengajuan.store');
Route::delete('/delete-pengajuan/{id}', 'PengajuanController@destroy')->name('pengajuan');
Route::get('/pengajuan/{slug}', 'PengajuanController@show')->name('pengajuan.show');

// Part Route
Route::get('/part', 'PartController@index')->name('part.index');
Route::post('/add-part', 'PartController@store')->name('part.store');
Route::get('/pergantian-part/{slug}', 'PartController@create')->name('part.create');
Route::get('/edit-part/{id}', 'PartController@edit')->name('part.edit');
Route::put('/update-part/{id}', 'PartController@update')->name('part.update');
Route::delete('/delete-part/{id}', 'PartController@destroy')->name('part.destroy');

// Estimate Route
Route::post('/add-estimate-part', 'PartController@storePart')->name('estimate.store');
Route::get('estimasi-biaya', 'PartController@estimasi')->name('estimate.index');


// Survey Route
Route::get('survey/peralatan/{id}', 'SurveyController@create')->name('survey.create');
Route::get('laporan/survey', 'SurveyController@index')->name('survey.index');
Route::post('/add-data-survey', 'SurveyController@store')->name('survey.store');

// Progress Route
Route::get('/progress', 'ProgressController@index')->name('progres.index');
Route::post('/add-progress', 'ProgressController@store')->name('progress.store');
Route::get('/detail-progress/{slug}', 'ProgressController@show')->name('progress.show');
Route::put('/progress/{id}', 'ProgressController@updateProgress')->name('progress.update');

Route::get('/test', function () {
    // guest only
    return view('test');
});
// peralatan Route
Route::get('peralatan', 'PeralatanController@index')->name('peralatan.index');
Route::get('make/peralatan', 'PeralatanController@create')->name('peralatan.create');
Route::post('add-data-peralatan', 'PeralatanController@store')->name('peralatan.store');
Route::get('peralatan/{slug}', 'PeralatanController@show')->name('peralatan.show');
Route::get('/edit/peralatan/{slug}', 'PeralatanController@edit')->name('peralatan.edit');
Route::put('peralatan/{id}', 'PeralatanController@update')->name('peralatan.update');
Route::delete('peralatan/{id}', 'PeralatanController@destroy')->name('peralatan.destroy');


Route::resource('profile', 'ProfileController');