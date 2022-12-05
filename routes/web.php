<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KopiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// rute untuk mengelola tampilan beranda di MenuController
Route::get('/',[MenuController::class,'beranda']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// rute group untuk autentikasi user login dan terdaftar sebagai owner
Route::middleware(['auth', 'admin'])->group(function () {
    // rute untuk mengelola CRUD user di UserController
    Route::resource('user',UserController::class);
});

// rute group untuk autentikasi user login
Route::middleware(['auth'])->group(function () {
    // rute untuk mengelola CRUD kategori di KategoriController
    Route::resource('kategori',KategoriController::class);
    // rute untuk mengelola CRUD menu di MenuController
    Route::resource('menu',MenuController::class);
    // rute untuk mengelola halaman Dashboard di KopiController
    Route::resource('home', KopiController::class);
});
