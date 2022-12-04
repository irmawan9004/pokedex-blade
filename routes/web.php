<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\ProdukController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get("/", [LoginController::class, 'showLoginForm'])->name('login');
Route::get('riwayat', [ProdukController::class, 'join'])->name('join');

Route::prefix("pembeli")->group(function () {
    Route::get('/', [PembeliController::class, 'index'])->name('type.index');
    Route::get('add', [PembeliController::class, 'create'])->name('type.create');
    Route::post('store', [PembeliController::class, 'store'])->name('type.store');
    Route::get('edit/{id}', [PembeliController::class, 'edit'])->name('type.edit');
    Route::post('update/{id}', [PembeliController::class, 'update'])->name('type.update');
    Route::post('delete/{id}', [PembeliController::class, 'delete'])->name('type.delete');
});
Route::prefix("produk")->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('pokemon.index');
    Route::get('add', [ProdukController::class, 'create'])->name('pokemon.create');
    Route::post('store', [ProdukController::class, 'store'])->name('pokemon.store');
    Route::get('edit/{id}', [ProdukController::class, 'edit'])->name('pokemon.edit');
    Route::post('update/{id}', [ProdukController::class, 'update'])->name('pokemon.update');
    Route::post('delete/{id}', [ProdukController::class, 'delete'])->name('pokemon.delete');
    Route::post('recycle/{id}', [ProdukController::class, 'recycle'])->name('pokemon.recycle');
    Route::get('restore/{id}', [ProdukController::class, 'restore'])->name('pokemon.restore');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
