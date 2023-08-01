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


Route::group(['middleware' => ['auth', 'role:admin,teknisi']], function () {
    // Definisikan rute yang bisa diakses oleh pengguna dengan peran "admin" atau "teknisi" di sini
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    // Definisikan rute yang hanya bisa diakses oleh pengguna dengan peran "admin" di sini
});

// Home Route
Route::get('/home', 'HomeController@index')->name('home');

// Instansi Route
Route::get('/instansi', 'InstansiController@index')->name('instansi.index');
Route::get('/make/instansi', 'InstansiController@create')->name('instansi.create');
Route::get('/edit-instansi/{id}', 'InstansiController@edit')->name('instansi.edit');
Route::put('/update-instansi/{id}', 'InstansiController@update')->name('instansi.update');
Route::get('/detail-instansi/{id}', 'InstansiController@show')->name('instansi.show');
Route::post('/add-instansi', 'InstansiController@store')->name('instansi.store');
Route::delete('/delete-instansi/{id}', 'InstansiController@destroy')->name('instansi.destroy');

// User Route
Route::get('/users', 'UserController@index')->name('users.index');
Route::get('/make/users', 'UserController@create')->name('users.create');
Route::post('/add-users', 'UserController@store')->name('users.store');
Route::get('/edit-users/{id}', 'UserController@edit')->name('user.edit');
Route::put('/update-users/{id}', 'UserController@update')->name('users.update');
Route::delete('/delete-users/{id}', 'UserController@destroy')->name('users.destroy');

// informasi Route
Route::get('/informasi', 'InformasiController@index')->name('informasi.index');
Route::post('/add-informasi', 'InformasiController@store')->name('informasi.store');

// sukujadang Route
Route::get('/part/{part}', 'SukuCadangController@show')->name('part.show');

// Urgently Route
Route::get('/urgently', 'UrgentController@index')->name('urgently.index');
Route::post('/add-urgently', 'UrgentController@store')->name('urgent.store');
Route::delete('/delete-user/{id}', 'UrgentController@destroy')->name('urgent.destroy');

// Merek Route
Route::get('merek', 'MerekController@index')->name('merek.index');
Route::post('/create-data-merek', 'MerekController@store')->name('merek.store');
Route::delete('/delete/{merek}', 'MerekController@destroy')->name('merek.destroy');
Route::get('/edit/{nama_merek}', 'MerekController@edit')->name('merek.edit');

// produk Route
Route::get('/produk', 'ProdukController@index')->name('produk.index');
Route::get('/make/produk', 'ProdukController@create')->name('produk.create');
Route::post('/create-data-produk', 'ProdukController@store')->name('produk.store');

// Pengajuan Route
Route::get('/pengajuan', 'PengajuanController@index')->name('pengajuan.index');
Route::get('/make/pengajuan/{id}', 'PengajuanController@create')->name('pengajuan.create');
Route::post('/add-pengajuan', 'PengajuanController@store')->name('pengajuan.store');

// Progress Route
Route::get('/progress', 'ProgressController@index')->name('progres.index');

Route::resource('peralatan', 'PeralatanController');


Route::resource('profile', 'ProfileController');
Route::resource('kategori', 'KategoriController');
Route::resource('part', 'SukuCadangController');
