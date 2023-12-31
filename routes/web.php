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
    return view('zone-non-auth.welcom_content');
});

Route::get('/about', function () {
    return view('zone-non-auth.about');
});

Route::get('/contact-us', function () {
    return view('zone-non-auth.contact_us');
});




Auth::routes(['register' => false]);
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');


Route::group(['middleware' => ['auth', 'role:admin,teknisi,surveyor,sub_service']], function () {
    // Definisikan rute yang bisa diakses oleh pengguna dengan peran "admin" atau "teknisi" di sini

    // Instansi Route
    Route::get('/instansi', 'InstansiController@index')->name('instansi.index');
    Route::get('/member-instansi', 'InstansiController@group')->name('instansi.group');
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
    Route::delete('delete-estimasi-biaya/{id}', 'PartController@destroyPart')->name('estimate.delete');
    Route::put('/update-users/{id}', 'UserController@update')->name('users.update');
    Route::delete('/delete-users/{id}', 'UserController@destroy')->name('users.destroy');
    Route::get('/user/{id}/details', 'UserController@getUserDetails');

});

// surveyor route
Route::get('surveyor/create-data', 'SurveyorController@createData')->name('survey.creat-data');
Route::get('surveyor/exist-data/{id}', 'SurveyorController@existData')->name('survey.exist-data');
Route::post('create-new-data/surveyor', 'SurveyorController@storeData')->name('survey.store-data');
Route::post('create-existing-data/surveyor/{id}', 'SurveyorController@existStore')->name('survey.store-exist');
Route::get('add/peralatan/surveyor/{id}', 'SurveyorController@addAlat')->name('survey.create-alat');
Route::post('store-data-alat/survey/{id}', 'SurveyorController@storeAlatSurvey')->name('survey.store-alat');

// Home Route
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/get-process-ticket-count', 'HomeController@getProcessTicketCount');
Route::get('/get-pending-count', 'HomeController@getPendingCount');
Route::get('/get-proses-count', 'HomeController@getProsesCount');
Route::get('/get-selesai-count', 'HomeController@getSolvedCount');

// status Route
Route::resource('status', 'StatusController');

Route::get('/daftar-permohonan-ticket', 'HomeController@ticket');
// Ajax Route Get Data
Route::get('/get-data/merek', 'MerekController@dataMerek')->name('merek.data');
Route::get('/get-data/kondisi', 'KondisiController@dataKondisi')->name('kondisi.data');
Route::get('/get-data/kategori', 'KategoriController@dataKategori')->name('kategori.data');
Route::get('/get-data/part', 'PartController@dataPart')->name('part.data');
Route::get('/get-data/instansi', 'SurveyorController@getAjaxInstansi')->name('instan.data');
Route::get('/get-data/peralatan/instansi', 'PeralatanController@getAjaxInstansi')->name('instan-alat.data');
Route::get('/get-data/departement', 'DepartemenController@getDepartement')->name('departement.get');


// informasi Route
Route::get('/informasi', 'InformasiController@index')->name('informasi.index');
Route::get('/detail-informasi/{id}', 'InformasiController@show')->name('informasi.show');
Route::post('/add-informasi', 'InformasiController@store')->name('informasi.store');
Route::get('/edit-informasi', 'InformasiController@edit')->name('informasi.edit');
Route::delete('/delete-informasi/{id}', 'InformasiController@destroy')->name('informasi.destroy');

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
Route::get('/profile-cetak-pdf', 'PrintController@ProfileRs')->name('profileInstansi.cetak_pdf');

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
Route::post('/update-pengajuan/{id}', 'PengajuanController@update')->name('pengajuan.update');
Route::get('/make/pengajuan/{slug}', 'PengajuanController@create')->name('pengajuan.create');
Route::post('/add-pengajuan', 'PengajuanController@store')->name('pengajuan.store');
Route::delete('/delete-pengajuan/{id}', 'PengajuanController@destroy')->name('pengajuan');
Route::get('/pengajuan/{slug}', 'PengajuanController@show')->name('pengajuan.show');

// Part Route
Route::get('/part', 'PartController@index')->name('part.index');
Route::post('/add-part', 'PartController@store')->name('part.store');
Route::get('/pergantian-part/{slug}', 'PartController@create')->name('part.create');
Route::get('/edit/{slug}', 'PartController@edit')->name('part.edit');
Route::get('/detail/{slug}', 'PartController@show')->name('part.show');
Route::put('/update-part/{id}', 'PartController@update')->name('part.update');
Route::delete('/delete-part/{id}', 'PartController@destroy')->name('part.destroy');


Route::get('/spare-part', 'StoreReqController@viewPart');
Route::get('/{slug}', 'StoreReqController@showPart')->name('guest-part.show');
// request member
Route::get('/approve/{id}', 'ReqMemberContrroller@approve')->name('approve');
Route::get('/reject/{id}', 'ReqMemberContrroller@reject')->name('reject');
Route::get('/detail-member/{id}', 'ReqMemberContrroller@detail')->name('detail.member');


Route::get('/request-as-member', 'StoreReqController@create');
Route::post('/request-member', 'StoreReqController@store');
Route::get('/member-request', 'ReqMemberContrroller@index')->name('service.member_req');

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

// peralatan Route
Route::get('peralatan', 'PeralatanController@index')->name('peralatan.index');
Route::get('make/peralatan', 'PeralatanController@create')->name('peralatan.create');
Route::post('add-data-peralatan', 'PeralatanController@store')->name('peralatan.store');
Route::get('peralatan/{slug}', 'PeralatanController@show')->name('peralatan.show');
Route::get('/edit/peralatan/{slug}', 'PeralatanController@edit')->name('peralatan.edit');
Route::put('peralatan/{id}', 'PeralatanController@update')->name('peralatan.update');
Route::delete('peralatan/{id}', 'PeralatanController@destroy')->name('peralatan.destroy');
Route::get('/peralatan/{id}/details', 'PeralatanController@getAlatDetails');


Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::post('req-store/{id}', 'ProfileController@reqStore')->name('req.store');
Route::post('/approve-surveyor/{user}', 'ProfileController@approveSurveyor')->name('approve.surveyor');
Route::post('/reject-surveyor/{user}', 'ProfileController@rejectSurveyor')->name('reject.surveyor');
