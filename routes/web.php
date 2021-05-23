<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LmasukController;
use App\Http\Controllers\LkeluarController;
use App\Models\Transaksi;

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
    return view('auth.login');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Route
Route::get('admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');

//Route User
Route::get('admin/user', [ProfileController::class, 'index'])
    ->name('admin.user')
    ->Middleware('is_admin');

//route tambah
Route::post('admin/user', [ProfileController::class, 'add_user'])
    ->name('admin.user.submit')
    ->middleware('is_admin');

//route edit
Route::patch('admin/user/update', [ProfileController::class, 'update_user'])
    ->name('admin.user.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', [ProfileController::class, 'getDataUser']);

//route delete
Route::delete('admin/user/delete', [ProfileController::class, 'destroy'])
    ->name('admin.user.delete')
    ->middleware('is_admin');

//Route Categories
Route::get('admin/kategori', [CategoriesController::class, 'index'])
    ->name('admin.kategori')
    ->middleware('is_admin');
//Route add Categories
Route::post('admin/kategori', [CategoriesController::class, 'add_categories'])
    ->name('admin.kategori.submit')
    ->middleware('is_admin');
//route edit categories
Route::patch('admin/kategori/update', [CategoriesController::class, 'update_categories'])
    ->name('admin.kategori.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCategories/{id}', [CategoriesController::class, 'getDataCategories']);

//route delete categories
Route::delete('admin/kategori/delete', [CategoriesController::class, 'delete_categories'])
    ->name('admin.kategori.delete')
    ->middleware('is_admin');


//ROUTE UTAMA BRANDS
Route::get('admin/merek', [App\Http\Controllers\BrandsController::class, 'index'])
    ->name('admin.merek')
    ->middleware('is_admin');

//route tambah brands
Route::post('admin/merek', [BrandsController::class, 'add_brand'])
    ->name('admin.brand.submit')
    ->middleware('is_admin');

//route edit brands
Route::patch('admin/merek/update', [BrandsController::class, 'update_brands'])
    ->name('admin.brand.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataBrands/{id}', [BrandsController::class, 'getDataBrands']);

//route delete brands
Route::delete('admin/merek/delete', [BrandsController::class, 'delete_brands'])
    ->name('admin.brand.delete')
    ->middleware('is_admin');


//ROUTE PRODUCT
Route::get('admin/kelola_barang', [ProductController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

Route::get('admin/laporan_masuk', [ProductController::class, 'laporan_masuk'])
->name('admin.laporan')
->middleware('is_admin');

//tambah data
Route::post('admin/kelola_barang', [ProductController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

//edit data
Route::patch('admin/kelola_barang/update', [ProductController::class, 'edit_product'])
    ->name('admin.product.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataProduct/{id}', [ProductController::class, 'getDataProduct']);

//delete data
Route::delete('admin/kelola_barang/delete',[ProductController::class, 'destroy'])
->name('admin.product.delete')
->middleware('is_admin');

//print pdf barang masuk
Route::get('admin/laporan_masuk/print_produk', [ProductController::class, 'print_produk'])
    ->name('admin.print.produk')
    ->middleware('is_admin');

//route transaksi
Route::get('admin/transaksi', [TransaksiController::class, 'index'])
->name('admin.transaksi')
->middleware('is_admin');

Route::get('admin/laporan_keluar', [TransaksiController::class, 'laporan_keluar'])
->name('admin.laporan')
->middleware('is_admin');

//tambah data
Route::post('admin/transaksi',[TransaksiController::class, 'add_transaction'])
->name('admin.transaksi.submit')
->middleware('is_admin');

//edit data
Route::patch('admin/transaksi/update',[TransaksiController::class, 'update_transaction'])
->name('admin.transaksi.update')
->middleware('is_admin');
Route::get('admin/ajaxadmin/dataTransaksi/{id}',[TransaksiController::class, 'getDataTransaksi']);

//delete data
Route::delete('admin/transaksi/delete', [TransaksiController::class, 'destroy'])
->name('admin.transaksi.delete')
->middleware('is_admin');

Route::get('admin/print_produk', [TransaksiController::class, 'print_produk'])
->name('admin.print.produk')
->middleware('is_admin');

// BARANG MASUK
Route::get('admin/masuk', [LmasukController::class, 'index'])
    ->name('admin.masuk')
    ->middleware('is_admin');

// route tambah barang masuk
Route::post('admin/masuk', [LmasukController::class, 'tambah_comes'])
    ->name('admin.masuk.submit')
    ->middleware('is_admin');

//route edit barang masuk
Route::patch('admin/masuk/update', [LmasukController::class, 'update_comes'])
    ->name('admin.masuk.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataComes/{id}', [LmasukController::class, 'getDataComes']);

//route delete barang masuk
Route::delete('admin/masuk/delete', [LmasukController::class, 'delete_comes'])
    ->name('admin.masuk.delete')
    ->middleware('is_admin');

Route::get('admin/print_masuk', [LmasukController::class, 'print_masuk'])
    ->name('admin.print.masuk')
    ->middleware('is_admin');

// BARANG KELUAR
Route::get('admin/keluar', [LkeluarController::class, 'index'])
    ->name('admin.keluar')
    ->middleware('is_admin');

// route tambah barang keluar
Route::post('admin/keluar', [LkeluarController::class, 'tambah_closes'])
    ->name('admin.keluar.submit')
    ->middleware('is_admin');

//route edit barang keluar
Route::patch('admin/keluar/update', [LkeluarController::class, 'update_closes'])
    ->name('admin.keluar.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCloses/{id}', [ClosesController::class, 'getDataCloses']);

//route delete barang keluar
Route::delete('admin/keluar/delete', [LkeluarController::class, 'delete_closes'])
    ->name('admin.keluar.delete')
    ->middleware('is_admin');

Route::get('admin/print_keluar', [LkeluarController::class, 'print_keluar'])
    ->name('admin.print.keluar')
    ->middleware('is_admin');
