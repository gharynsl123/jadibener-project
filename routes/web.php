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
    return view('welcome');
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

    // Urgently Route
    Route::get('/kondisi', 'KondisiController@index')->name('urgently.index');
    Route::post('/add-kondisi', 'KondisiController@store')->name('urgent.store');
    Route::delete('/delete-kondisi/{id}', 'KondisiController@destroy')->name('urgent.destroy');
});

// Home Route
Route::get('/home', 'HomeController@index')->name('home');

// status Route
Route::resource('status', 'StatusController');


// informasi Route
Route::get('/informasi', 'InformasiController@index')->name('informasi.index');
Route::get('/detail-informasi/{id}', 'InformasiController@show')->name('informasi.show');
Route::post('/add-informasi', 'InformasiController@store')->name('informasi.store');

// Merek Route
Route::get('merek', 'MerekController@index')->name('merek.index');
Route::post('/create-data-merek', 'MerekController@store')->name('merek.store');
Route::delete('/delete/{merek}', 'MerekController@destroy')->name('merek.destroy');
Route::get('/edit/{nama_merek}', 'MerekController@edit')->name('merek.edit');

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
Route::get('/pergantian-part/{id}', 'PartController@create')->name('part.create');
Route::get('/edit-part/{id}', 'PartController@edit')->name('part.edit');
Route::post('/add-part', 'PartController@store')->name('part.store');
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

Route::resource('peralatan', 'PeralatanController');


Route::resource('profile', 'ProfileController');
Route::resource('kategori', 'KategoriController');